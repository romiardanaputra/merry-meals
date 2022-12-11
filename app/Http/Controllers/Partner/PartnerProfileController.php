<?php

namespace App\Http\Controllers\Partner;

use App\Models\Partner;
use App\Http\Controllers\Controller;
use App\Http\Requests\Partner\PartnerProfileReq;
use App\Http\Requests\Partner\PartnerUpdateProfile;

class PartnerProfileController extends Controller
{
    public function index()
    {
        return view('partner.dashboard', [
            'title_page' => 'partner profile',
            'dashboard_info' => 'partner profile'
        ]);
    }

    public function create()
    {
        return view('partner.profile', [
            'title_page' => 'Create Profile',
            'dashboard_info' => 'partner profile',
        ]);
    }

    public function store(PartnerProfileReq $request)
    {
        $partners = $request->validated();
        $partners = new Partner;
        $partners->userID = auth()->user()->id;
        $partners->ownerName = $request->ownerName;
        $partners->restaurantName = $request->restaurantName;
        $partners->restaurantContact = $request->restaurantContact;
        $partners->restaurantAddress = $request->restaurantAddress;
        $partners->foodType = $request->foodType;
        $partners->restaurantImage = ($request->hasFile('restaurantImage'))
            ? $request->file('restaurantImage')->store('restaurant-images')
            : back();
        $partners->save();
        return to_route('partner.index')->with('data_partner', $partners);
    }

    public function edit(Partner $partner)
    {
        return view('partner.profileEdit', [
            'partners' => $partner,
            'dashboard_info' => 'partner edit profile',
            'title_page' => 'partner edit profile',
        ]);
    }

    public function show(Partner $partner){
        return view('partner.profileShow',[
            'partners' => $partner,
        ]);
    }

    public function update(PartnerUpdateProfile $request)
    {
        $partners = $request->validated();
        $partners->userID = auth()->user()->id;
        $partners->ownerName = $request->ownerName;
        $partners->restaurantName = $request->restaurantName;
        $partners->restaurantContact = $request->restaurantContact;
        $partners->restaurantAddress = $request->restaurantAddress;
        $partners->foodType = $request->foodType;
        $partners->restaurantImage = ($request->hasFile('restaurantImage'))
            ? $request->file('restaurantImage')->store('restaurant-images')
            : back();
        $partners->save();
        return to_route('partner_handler.index');
    }

    public function destroy(Partner $partner)
    {
        $partners = $partner->id;
        $partners->delete();
    }
}
