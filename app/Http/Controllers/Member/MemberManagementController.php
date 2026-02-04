<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\StoreOrderRequest;
use App\Http\Requests\Member\StoreSurveyRequest;
use App\Models\Meal;
use App\Models\Order;
use App\Services\DashboardCacheService;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Member Management Controller
 * Handles member dashboard, meals browsing, orders, and surveys
 */
class MemberManagementController extends Controller
{
    public function __construct(
        protected DashboardCacheService $cacheService,
        protected OrderService $orderService
    ) {}

    /**
     * Display member dashboard with optimized queries
     */
    public function index(): View
    {
        $user = auth()->user();

        // Get cached stats (single optimized query)
        $stats = $this->cacheService->getMemberStats($user->id);

        // Eager load relationships to prevent N+1
        $orders = Order::with(['meal', 'partner'])
            ->where('userID', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('features.member.dashboard', [
            'title_page' => 'Member Dashboard',
            'dashboard_info' => 'Your Activity Overview',
            'orders' => $orders,
            'stats' => $stats,
        ]);
    }

    /**
     * Store new order with validated request
     */
    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->orderService->placeOrder([
            'userID' => auth()->id(),
            'mealID' => $validated['mealID'],
            'partnerID' => $validated['partnerID'],
            'mealPackage' => $validated['package'],
            'range' => OrderController::range($validated['partnerID']),
            'foodTemperature' => OrderController::foodTemperature(
                OrderController::range($validated['partnerID'])
            ),
        ]);

        return to_route('member.meals.order.success');
    }

    /**
     * Update order status
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'orderStatus' => ['required', 'string'],
        ]);

        Order::where('id', $id)
            ->where('userID', auth()->id())
            ->update(['status' => $request->orderStatus]);

        return back()->with('success', 'Order status updated.');
    }

    /**
     * Display meal detail
     */
    public function menuDetailShow(int $id): View
    {
        return view('features.member.meals.detail', [
            'title_page' => 'Meal Detail',
            'meal' => Meal::with('partner')->findOrFail($id),
        ]);
    }

    /**
     * Display package selection
     */
    public function packageFood(int $id): View
    {
        return view('features.member.meals.package', [
            'title_page' => 'Select Package',
            'meal' => Meal::with('partner')->findOrFail($id),
        ]);
    }

    /**
     * Display meals menu with eager loaded partner
     */
    public function menuMealShow(): View
    {
        return view('features.member.meals.menu', [
            'title_page' => 'Browse Meals',
            'dashboard_info' => 'Explore Nutritious Meals',
            'meals' => Meal::with('partner')
                ->where('mealAvailability', 'available')
                ->latest()
                ->paginate(9),
        ]);
    }

    /**
     * Display survey form
     */
    public function surveyShow(): View
    {
        return view('features.member.survey', [
            'title_page' => 'Service Feedback',
        ]);
    }

    /**
     * Store survey with validated request
     */
    public function surveyStore(StoreSurveyRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        \App\Models\Survey::create([
            'userID' => auth()->id(),
            'questionOne' => $validated['q1'],
            'questionTwo' => $validated['q2'],
            'questionThree' => $validated['q3'],
            'questionFour' => $validated['q4'],
            'questionFive' => $validated['q5'],
            'questionSix' => $validated['q6'],
            'questionSeven' => $validated['q7'],
            'questionEight' => $validated['q8'],
            'overall' => $validated['overall'],
        ]);

        return redirect()
            ->route('member.dashboard')
            ->with('success', 'Thank you for your feedback! It helps us improve Merry Meals.');
    }
}
