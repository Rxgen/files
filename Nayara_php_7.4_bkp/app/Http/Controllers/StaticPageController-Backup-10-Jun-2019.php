<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\FranchiseState;
use App\FranchiseDistrict;
use App\Page;
use App\ManagementTeam;
use App\SustainableDevelopment;
use DB;
use App\RetailOnlineLead;
use App\Test;
use App\Pump;

class StaticPageController extends Controller
{

	public function staticPageContent(Request $request) {
		//dd($request->slug);
		$page = Page::where('slug', $request->slug)->where('status',1)->get();
		if(count($page) == 0) {
			return response()->view('exceptions.error', ['message'=>'Sorry, the requested page could not be found', 'error_code'=>'404'], 404);
		}
		switch ($request->slug) {
			case 'refinery':
				return view('pages.refinery')->with(compact(['page']));
				break;
			
			default:
				return view('pages.contact')->with(compact(['page']));
				break;
		}
	}	

	/*public function ethos() {
		$page = Page::where('id', 2)->where('status',1)->get();
		return view('pages.ethos')->with(compact(['page']));
	}*/

	public function staticPageRetailContent(Request $request) {
		$page = Page::where('slug', $request->slug)->where('status', 1)->get();
		if(count($page) == 0) {
			return response()->view('exceptions.error', ['message'=>'Sorry, the requested page could not be found', 'error_code'=>'404'], 404);
		}
		return view('pages.contact')->with(compact(['page']));
	}

	public function applyOnlineFormSubmit(Request $request){
		$name = $request->name;
		$mobile = $request->mobile;
		$email = $request->email;
		$source = $request->source;
		$state_id = $request->state_id;
		$district_id = $request->district_id;
		$date = date('Y-m-d H:i:s');
		//dd($state_id, $district_id);

		$validation = $this->apply_online_validator($request->all())->validate();

		$online_lead = DB::table('retail_online_leads')
		->insert([
			'name' => $name,
			'email' => $email,
			'mobile' => $mobile,
			'source' => $source,
			'state' => $state_id,
			'district' => $district_id,
			'created_at' => $date,
			'updated_at' => $date,
		]);

		if($online_lead){
			return 1;
		}
		else{
			return 0;	
		}

	}


	public function boardTeamContent(Request $request) {
		$audit_team = [];
		$nomination_team = [];
		$csr_team = [];
		$stakeholder_team = [];
		//dd($audit_team);
		$page = Page::where('slug', $request->slug)->where('status', 1)->get();
		if(count($page) == 0) {
			return response()->view('exceptions.error', ['message'=>'Sorry, the requested page could not be found', 'error_code'=>'404'], 404);
		}
		switch ($request->slug) {
			case 'board-committee':
				$team = ManagementTeam::where('board', 'committee')->where('status', 1)->orderBy('order', 'ASC')->get();
				foreach ($team as $key => $value) {
					if($value->commitee == 'audit'){
						$audit_team[$value->order] = $value;
					}
					elseif ($value->commitee == 'nomination') {
						$nomination_team[$value->order] = $value; 
					}
					elseif ($value->commitee == 'stakeholder') {
						$stakeholder_team[$value->order] = $value;
					}
					elseif ($value->commitee == 'csr') {
						$csr_team[$value->order] = $value;
					}
				}
				$team = array();
				$team['audit_team'] = $audit_team;
				$team['nomination_team'] = $nomination_team;
				$team['stakeholder_team'] = $stakeholder_team;
				$team['csr_team'] = $csr_team;
				//dd($team);
				return view('pages.board-committee')->with(compact(['page','team']));
				break;
			case 'board-members':
				$team = ManagementTeam::where('board', 'Members')->where('status', 1)->orderBy('order', 'ASC')->get();
				//dd($team);
				/*$count = 1;
				foreach ($team as $key => $value) {
					if(!empty($value->cta_name) && $count <= 2){
						$top[$key] = $value;
					}
					elseif(empty($value->cta_name) && $count <= 9){
						$middle[$key] = $value;
					}
					elseif (empty($value->cta_name) && $count > 9) {
						$bottom[$key] = $value;
					}
					$count++;
				}*/
				//dd($top, $middle, $bottom);
				/*$team = array();
				$team['top_team'] = $top;
				$team['middle_team'] = $middle;
				$team['bottom_team'] = $bottom;*/
				//dd($team);
				return view('pages.board-member')->with(compact(['page','team']));
				//dd($page, $team);
				break;
			case 'senior-management':
				$team = ManagementTeam::where('board', 'Senior')->where('status', 1)->orderBy('order', 'ASC')->get();
				//dd($team[0]->description, $page);
				return view('pages.senior-management')->with(compact(['page','team']));
				break;
			
			default:
				# code...
				break;
		}
	}

	protected function apply_online_validator(array $data)
    {
        //dd($data);

        return Validator::make($data, [

            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'mobile'=> 'required|numeric|min:10',
            'source'=> 'required|string|max:255',
            'state_id'=> 'required|numeric',
            'district_id'=> 'required|numeric',
        ]);
    }

    public function populateStates() {
    	$states = FranchiseState::with('franchise_districts')->get()->toArray();
    	//dd($states[1]);
    	/*$options = "";
    	foreach ($states as $key => $value) {
    		$options .= "<option value='".$value->id."'>".$value->states."</option>";
    	}*/
    	// return $options;
    	return $states;
    }

    public function exportLeads(Request $request) {
    	$from_date = $request->from_date;
    	$to_date = $request->to_date;
    	if(!empty($from_date) && !empty($to_date)){
    		$leads = RetailOnlineLead::whereDate('created_at', '>=', date($from_date))->whereDate('created_at', '<=', date($to_date))->get();
    	}
    	else{
    		$leads = RetailOnlineLead::get();
    	}
    	if(count($leads) > 0){
				 
            $export_leads="id,name,email,mobile,source,state_id,district_id\n";

	        foreach($leads as $lead){
	            $export_leads.=$lead->id.','.$lead->name.','.$lead->email.','.$lead->mobile.','.$lead->source.','.$lead->state.','.$lead->district."\n";
	            //dd($value->first_name);
	        }


	        return response($export_leads)
	        ->header('Content-Type','application/csv')               
	        ->header('Content-Disposition', 'attachment; filename="applyOnlineLead.csv"')
	        ->header('Pragma','no-cache')
	        ->header('Expires','0'); 
			

		}
		else{

			return redirect()->back()->withErrors(['Leads not found to export']);

		}
    }

    public function getRo(Request $request) {
    	$radius = $request->radius;
    	$location = $request->location;
    	$curr_latitude = $request->curr_lat;
    	$curr_longitude = $request->curr_long;
    	//dd($radius);
    	$pump = Pump::get();
    	//dd(gettype($pump[6]->curr_longitude));
    	$pumps = array();
    	foreach ($pump as $key => $value) {
    		$model_latitude = (float)$value->latitude;
    		$model_longitude = (float)$value->longitude;
    		if(is_numeric($model_latitude) && is_numeric($model_longitude)){
	            $theta = $curr_longitude - $model_longitude; 
		        $dist = sin(deg2rad($curr_latitude)) * sin(deg2rad($model_latitude)) +  cos(deg2rad($model_latitude)) * cos(deg2rad($model_latitude)) * cos(deg2rad($theta)); 
		        $dist = acos($dist); 
		        $dist = rad2deg($dist); 
		        $miles = $dist * 60 * 1.1515 * 1.609344;
		        if($miles < $radius) {
		        	$pumps[$key] = $value;
		        	$pumps[$key]['distance'] = $miles;
		        }
    		}
    	}
    	//dd($pumps);
    	return $pumps;
    	//dd($pump);

    	//dd($radius, $location, $curr_longitude, $curr_latitude);
    }

    public function getCodeRo(Request $request) {
    	$pump = Pump::where('cms_code', $request->ro_code)->get();
    	if(count($pump) > 0){
    		return $pump;
    	}
    	else{
    		return 0;
    	}
    }

    public function latlng(Request $request) {
    	$data = Pump::where('id', '>', 1388)->get();
    	$count = 0;
    	$fail = 0;
    	//dd($data[0]);
    	foreach ($data as $key => $value) {
	    	$address = $value->address; // Google HQ
	        $prepAddr = str_replace(' ','+',$address);
	        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyCOSVMcXnqT4201iOaZe_TtxdkmTR-FoFY&address='.$prepAddr.'&sensor=false');
	        $output= json_decode($geocode);
	        dd($output);
	        $latitude = !empty($output->results[0]) ? $output->results[0]->geometry->location->lat : null;
	        $longitude = !empty($output->results[0]) ? $output->results[0]->geometry->location->lng : null;

	        $update = Pump::whereId($value->id)->update([
	        	'latitude' => $latitude,
	        	'longitude' => $longitude
	        ]);
	        if($update){
	        	$count++;
	        }
	        else{
	        	$fail++;
	        }
	        //dd($latitude, $longitude);
    	}
    	dd($count, $fail);
    }
}
