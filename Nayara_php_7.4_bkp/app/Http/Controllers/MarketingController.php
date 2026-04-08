<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ZonalOffice;
use App\Page;
use App\JobLocation;
use App\DivisionalOffice;

class MarketingController extends Controller
{
    public function officeLocation(Request $request) {
    	//dd($request->slug);
    	$page = Page::where('slug', 'contact-us-office-locations')->where('status',1)->get();
		if(count($page) == 0) {
			return response()->view('exceptions.error_404');
			//return response()->view('exceptions.error', ['message'=>'Sorry, the requested page could not be found', 'error_code'=>'404'], 404);
		}
    	$offices = ZonalOffice::where('status', 1)->get();
    	return view('pages.zonal-office')->with(compact(['page','offices']));

    }

    public function divisionalOffice(Request $request) {
    	$page = Page::where('slug', 'contact-us-divisional-office')->where('status',1)->get();
		if(count($page) == 0) {
			return redirect()->route('home.homepage');
			//return response()->view('exceptions.error', ['message'=>'Sorry, the requested page could not be found', 'error_code'=>'404'], 404);
		}
		$cities = DivisionalOffice::select('job_locations.district','job_locations.id')->join('job_locations', 'job_locations.id', 'divisional_offices.city')->orderBy('job_locations.district', 'ASC')->get();

		return view('pages.divisional-office')->with(compact(['page', 'cities']));

    }

    public function ajaxDivisional(Request $request) {
    	$city_id = $request->city_id;
    	$divisional_address = DivisionalOffice::join('job_locations', 'job_locations.id', 'divisional_offices.city')->where('city', $city_id)->where('divisional_offices.status', 1)->get();
    	//dd($divisional_address);
    	if(count($divisional_address) > 0){
    		$address = '<div class="contact-address-block">
			                <div class="contact-address-title">
			                    '.$divisional_address[0]->district.'
			                </div>
			                <div class="company-name-title">
			                    '.$divisional_address[0]->add_title.'
			                </div>

			                <address>
			                    '.$divisional_address[0]->address.'
			                </address>
			                <div class="phone-contact">Telephone: <span><a href="tel:'.str_replace(' ', '', $divisional_address[0]->tel_line_1).'">'.$divisional_address[0]->tel_line_1.'</a></span></div>

			                <a class="zonal_location" href="'.$divisional_address[0]->location_url.'" target="_blank"> 
			                    <span>View Location</span> 
			                </a>
			            </div>';
    	}
    	else{
    		$address = 0;
    	}
    	return $address;

    }
}
