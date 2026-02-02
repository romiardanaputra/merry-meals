<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

/**
 * Superadmin Donation Management Controller
 * View and manage all donations
 */
class DonationController extends Controller
{
    /**
     * Display list of all donations
     */
    public function index(Request $request)
    {
        $query = Donation::latest();

        // Filter by date range
        if ($request->has('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->has('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $donations = $query->paginate(15);
        
        // Stats
        $totalDonations = Donation::sum('donationAmount');
        $donationCount = Donation::count();

        return view('features.superadmin.donations.index', compact(
            'donations',
            'totalDonations',
            'donationCount'
        ));
    }

    /**
     * Display specific donation details
     */
    public function show(Donation $donation)
    {
        return view('features.superadmin.donations.show', compact('donation'));
    }

    /**
     * Export donations to CSV
     */
    public function export(Request $request)
    {
        $donations = Donation::latest()->get();

        $filename = 'donations_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($donations) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Email', 'Amount', 'Date']);

            foreach ($donations as $donation) {
                fputcsv($file, [
                    $donation->id,
                    $donation->donatorName ?? 'Anonymous',
                    $donation->donatorEmail ?? '-',
                    $donation->donationAmount,
                    $donation->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
