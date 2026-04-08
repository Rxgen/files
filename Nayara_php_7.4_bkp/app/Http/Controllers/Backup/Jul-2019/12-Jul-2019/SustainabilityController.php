<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\SustainableDevelopment;
use App\ImpactReport;

class SustainabilityController extends Controller
{
    public function sustainabilityContent(Request $request) {
    	$page = Page::where('slug', $request->slug)->where('status', 1)->get();
    	if(count($page) == 0) {
			return response()->view('exceptions.error', ['message'=>'Sorry, the requested page could not be found', 'error_code'=>'404'], 404);
		}
    	//dd($page);
    	switch ($request->slug) {
			case 'report':
				$reports = ImpactReport::where('status', 1)->get();
				return view('pages.impact-report')->with(compact(['page','reports']));
				break;
			default:
				return view('pages.contact')->with(compact(['page']));
				break;
		}
    }

    public function sustainablePageContent(Request $request) {
		$page = Page::where('slug', $request->slug)->where('status',1)->get();
		if(count($page) == 0) {
			return response()->view('exceptions.error', ['message'=>'Sorry, the requested page could not be found', 'error_code'=>'404'], 404);
		}
		switch ($request->slug) {
			case 'livelihood':
				$content = SustainableDevelopment::where('development_type', 'livelihood')->where('status', 1)->get();
				break;
			case 'education':
				$content = SustainableDevelopment::where('development_type', 'education')->where('status', 1)->get();
				break;
			case 'health-sanitation':
				$content = SustainableDevelopment::where('development_type', 'health')->where('status', 1)->get();
				break;
			default:
				# code...
				break;
		}
		return view('pages.sustainable-development')->with(compact(['page','content']));
	}
}
