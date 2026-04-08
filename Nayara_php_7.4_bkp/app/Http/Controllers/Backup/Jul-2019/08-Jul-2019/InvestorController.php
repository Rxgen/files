<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\AnnualReport;
use App\InvestorNotice;
use App\InvestorContact;

class InvestorController extends Controller
{
    public function investorContent(Request $request) {
        $page = Page::where('slug', $request->slug)->where('status', 1)->get();
        if(count($page) == 0) {
            return response()->view('exceptions.error', ['message'=>'Sorry, the requested page could not be found', 'error_code'=>'404'], 404);
        }
    	switch ($request->slug) {
    		case 'presentation':
				return view('pages.contact')->with(compact(['page']));
    			break;
			case 'annual-reports':
    			$reports = AnnualReport::where('status',1)->get();
    			$report_years = AnnualReport::where('status',1)->selectRaw("MAX(year) AS max_year, MIN(year) AS min_year")->get();
    			//dd($report_years);
				return view('pages.annual-reports')->with(compact(['page','reports','report_years']));
    			break;
			case 'notices':
    			$notice = InvestorNotice::where('status', 1)->get();
    			foreach ($notice as $key => $value) {
    				if($value->type == 'merger') {
    					$notices['Merger of Vadinar Power Company Limited and Nayara Energy Properties Limited with Nayara Energy Limited'][$key] = $value;
    				}
    				elseif ($value->type == 'current') {
    					$notices['Current Notices/ Announcements'][$key] = $value;
    				}
    				elseif ($value->type == 'historical') {
    					$notices['Historical Notices / Announcements'][$key] = $value; 
    				}
    			}
    			return view('pages.investor-notices')->with(compact(['page','notices']));
    			break;
    		case 'information':
    			//$contact = InvestorContact::where('status', 1)->get();
    			//dd($contact);
    			return view('pages.investor-contact')->with(compact(['page']));
    			break;
			case 'corporate-governance':
				return view('pages.contact')->with(compact(['page']));
				break;
    		default:
    			# code...
    			break;
    	}	
		//dd($page);
	}

	public function ajaxReport(Request $request) {
		$reports = AnnualReport::where('year', $request->year)->where('status',1)->get();
		return view('pages.ajax-reports')->with(compact(['reports']));
		//dd($reports);
	}

    public function ajaxSubsidiary(Request $request) {
        $reports = AnnualReport::where('year', $request->year)->where('is_subsidiaries', 1)->where('status',1)->get();
        return view('pages.ajax-subsidiary')->with(compact(['reports']));
        //dd($reports);
    }
}
