<?php

namespace App\Http\Controllers\Partner;

use App\Models\Partner;
use App\Models\Geolocation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Partner\PartnerProfileReq;
use App\Http\Requests\Partner\PartnerUpdateProfile;

class PartnerProfileController extends Controller
{
    // display partner dashboard
    public function index()
    {
        return view('features.partner.profileShow', [
            'title_page' => 'partner profile',
            'dashboard_info' => '',
            'partners' => Partner::all(),
        ]);
    }

    // display form create partner profile
    public function create()
    {
        return view('features.partner.profileCreate', [
            'title_page' => 'Create Profile',
            'dashboard_info' => 'partner profile',
        ]);
    }

    // store partner profile
    public function store(PartnerProfileReq $request)
    {
        $partners = $request->validated();
        $partners['userID'] = auth()->user()->id;
        $partners['restaurantImage'] = ($request->hasFile('restaurantImage'))
            ? $request->file('restaurantImage')->store('restaurant-images')
            : back();
        $dataPartners = Partner::create($partners);
        self::partnerLocation($dataPartners, $partners['userID']);
        return to_route('partner.index');
    }

    // update partner location after creating partner profile
    public static function partnerLocation($dataPartners, $id){
        $loc['partnerID'] = $dataPartners['id'];
        Geolocation::where('id',$id)->update($loc);
    }

    // edit partner based on auth user
    public function edit()
    {
        $partner = auth()->user()->partner;
        if (!$partner) return to_route('partner.create');
        
        return view('features.partner.profileEdit', [
            'partner' => $partner,
            'dashboard_info' => 'Edit Profile',
            'title_page' => 'Edit Profile',
        ]);
    }

    // show partner profile based on auth user
    public function show(Partner $partner){
         return view('features.partner.profileShow',[
            'partners' => $partner, // View expects 'partners' variable? The loop in show view suggests collection. I will check view logic.
         ]);
    }

    // update partner profile
    public function update(PartnerUpdateProfile $request)
    {
        $partner = auth()->user()->partner;
        $data = $request->validated();
        
        if ($request->hasFile('restaurantImage')) {
            $data['restaurantImage'] = $request->file('restaurantImage')->store('restaurant-images', 'public');
        }

        $partner->update($data);
        return to_route('partner.index')->with('success', 'Profile updated successfully');
    }

    public function destroy($id)
    {
        Partner::where('id', $id)->delete();
    }
}
