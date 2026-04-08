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
                $notices['Nayara Energy Limited'][0]['Current Notices/ Announcements'] = array();
                $notices['Nayara Energy Limited'][1]['Historical Notices / Announcements'] = array();
                //$notices['Nayara Energy Limited'][2]['Merger of Vadinar Power Company Limited and Nayara Energy Properties Limited with Nayara Energy Limited'] = array();
                $notices['Vadinar Oil Terminal Limited'][0]['Current Notices/ Announcements'] = array();
                $notices['Vadinar Oil Terminal Limited'][1]['Historical Notices / Announcements'] = array();
                //$notices['Vadinar Oil Terminal Limited'][2]['Merger of Vadinar Power Company Limited and Nayara Energy Properties Limited with Nayara Energy Limited'] = array();
    			foreach ($notice as $key => $value) {
    				if($value->category == 'nayara') {
                        /*if($value->sub_category == 'merger') {
                            $notices['Nayara Energy Limited'][2]['Merger of Vadinar Power Company Limited and Nayara Energy Properties Limited with Nayara Energy Limited'][$key] = $value;
                        }*/
                        if ($value->sub_category == 'current') {
                            $notices['Nayara Energy Limited'][0]['Current Notices/ Announcements'][$key] = $value;
                        }
                        elseif ($value->sub_category == 'historical') {
                            $notices['Nayara Energy Limited'][1]['Historical Notices / Announcements'][$key] = $value; 
                        }
                    }
                    elseif ($value->category == 'vadinar') {
                        /*if($value->sub_category == 'merger') {
                            $notices['Vadinar Oil Terminal Limited'][2]['Merger of Vadinar Power Company Limited and Nayara Energy Properties Limited with Nayara Energy Limited'][$key] = $value;
                        }*/
                        if ($value->sub_category == 'current') {
                            $notices['Vadinar Oil Terminal Limited'][0]['Current Notices/ Announcements'][$key] = $value;
                        }
                        elseif ($value->sub_category == 'historical') {
                            $notices['Vadinar Oil Terminal Limited'][1]['Historical Notices / Announcements'][$key] = $value; 
                        }
                    }
    			}
                ksort($notices['Nayara Energy Limited']);
                ksort($notices['Vadinar Oil Terminal Limited']);
    			return view('pages.investor-notices')->with(compact(['page','notices']));
    			break;
    		case 'information':
    			//$contact = InvestorContact::where('status', 1)->get();
    			//dd($contact);
    			return view('pages.investor-contact')->with(compact(['page','contact']));
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
        if($request->year == 0){
            $reports = AnnualReport::where('status',1)->get();
        }
        else{
		    $reports = AnnualReport::where('year', $request->year)->where('status',1)->get();
        }
		return view('pages.ajax-reports')->with(compact(['reports']));
		//dd($reports);
	}

    public function ajaxSubsidiary(Request $request) {
        if($request->year == 0){
            $reports = AnnualReport::where('is_subsidiaries', 1)->where('status',1)->get();    
        }
        else{
            $reports = AnnualReport::where('year', $request->year)->where('is_subsidiaries', 1)->where('status',1)->get();
        }
        return view('pages.ajax-subsidiary')->with(compact(['reports']));
        //dd($reports);
    }
}
