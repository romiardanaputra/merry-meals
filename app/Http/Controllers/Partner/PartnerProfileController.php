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

    public function partnerProfile(Partner $partner){
        return view('partner.profileShow',[
            'partner' => $partner,
        ]);
    }

    public function store(PartnerProfileReq $request)
    {
        $partners = $request->validated();
        $partners = new Partner;
        $partners->userID = auth()->user()->id;
        $partners->owner_name = $request->owner_name;
        $partners->restaurant_name = $request->restaurant_name;
        $partners->restaurant_contact = $request->restaurant_contact;
        $partners->restaurant_address = $request->restaurant_address;
        $partners->food_type = $request->food_type;
        $partners->restaurant_image = ($request->hasFile('restaurant_image'))
            ? $request->file('restaurant_image')->store('restaurant-images')
            : back();
        $partners->save();
        return to_route('partner');
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

    public function update(PartnerUpdateProfile $request, Partner $partner)
    {
        $partners = $request->validated();
        $partners = $partner->id;
        $partners->owner_name = $request->owner_name;
        $partners->restaurant_name = $request->restaurant_name;
        $partners->restaurant_contact = $request->restaurant_contact;
        $partners->restaurant_address = $request->restaurant_address;
        $partners->food_type = $request->food_type;
        $partners->restaurant_image = ($request->hasFile('restaurant_image'))
            ? $request->file('restaurant_image')->store('restaurant-images')
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
