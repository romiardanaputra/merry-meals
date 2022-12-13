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
        return view('partner.profileShow', [
            'title_page' => 'partner profile',
            'dashboard_info' => 'partner profile',
            'partners' => Partner::all(),
        ]);
    }

    // display form create partner profile
    public function create()
    {
        return view('partner.profileCreate', [
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

    // edit partner based on partner id
    public function edit(Partner $partner)
    {
        return view('partner.profileEdit', [
            'partners' => $partner,
            'dashboard_info' => 'partner edit profile',
            'title_page' => 'partner edit profile',
        ]);
    }

    // show partner profile based on partner id 
    public function show(Partner $partner){
        return view('partner.profileShow',[
            'partners' => $partner,
        ]);
    }

    // update partner profile based on partner id
    public function update(PartnerUpdateProfile $request, $id)
    {
        $partners = $request->validated();
        $partners['userID'] = auth()->user()->id;
        $partners['restaurantImage'] = ($request->hasFile('restaurantImage'))
            ? $request->file('restaurantImage')->store('restaurant-images')
            : back();
        Partner::where('id', $id)->update($partners);
        return to_route('partner_handler.index');
    }

    public function destroy($id)
    {
        Partner::where('id', $id)->delete();
    }
}
