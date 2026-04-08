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
use App\Faq;
use App\NewsRoom;
use App\CampaignLead;

class StaticPageController extends Controller
{

	public function staticPageContent(Request $request) {
		//dd($request->slug);
		$page = Page::where('slug', $request->slug)->where('status',1)->get();
		if(count($page) == 0) {
			return redirect()->route('home.homepage');
			return response()->view('exceptions.error', ['message'=>'Sorry, the requested page could not be found', 'error_code'=>'404'], 404);
		}
		switch ($request->slug) {
			case 'refinery':
				$path = $request->path();
				return view('pages.refinery')->with(compact(['page','path']));
				break;
			case 'awards':
                $dates = NewsRoom::select('date')->where('news_room_section', 'awards')->where('status', 1)->distinct()->get();
				$current_year = $dates[0]->date;				
                $awards = NewsRoom::where('news_room_section', 'awards')->where('status', 1)->where('date', $current_year)->get();
                return view('pages.awards')->with(compact(['page','current_year', 'dates', 'awards']));
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
			return redirect()->route('home.homepage');
			return response()->view('exceptions.error', ['message'=>'Sorry, the requested page could not be found', 'error_code'=>'404'], 404);
		}
		switch ($request->slug) {
			case 'faqs':
				$faqs = Faq::where('status', 1)->get();
				return view('pages.faqs')->with(compact(['page','faqs']));
			default:
			
				$num1 = rand(10, 100);
				$num2 = rand(10, 100);
				$random = $num1 + $num2;

				$request->session()->put('form_captcha', $random);
				return view('pages.contact')->with(compact(['page', 'num1','num2']));
				break;

				//return view('pages.contact')->with(compact(['page']));
				//break;
		}
	}

	public function campaignPage(Request $request) {

		$num1 = rand(10, 100);
		$num2 = rand(10, 100);
		$random = $num1 + $num2;
		$request->session()->put('thankyou-redirect', true);
		$request->session()->put('camp_form_captcha', $random);
		return view('pages.campaign-page')->with(compact(['num1','num2']));
	}

	public function campaignFormSubmit(Request $request){
		
		$name = $request->name;
		$mobile = $request->mobile;
		$email = $request->email;
		$source = $request->source;
		$state_id = $request->state_id;
		$district_id = $request->district_id;
		$utm_source = $request->utm_source;
		$utm_medium = $request->utm_medium;
		$utm_campaign = $request->utm_campaign;
		$date = date('Y-m-d H:i:s');

		$this->validate($request, [ 
			'name' => 'required|string|max:255',
			'mobile' => 'required|min:10|numeric', 
			'source' => 'required|string',
			'state_id' => 'required|string',
			'district_id' => 'required|string', 
		]);
		
		if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
			return response()->json(['status' => 2]);
		}

		$captcha = $request->captcha;
		$value = $request->session()->pull('camp_form_captcha', '');
		if($captcha != $value) {
			$num1 = rand(10, 100);
			$num2 = rand(10, 100);
			$random = $num1 + $num2;

			$request->session()->put('camp_form_captcha', $random);
			return json_encode(array('status' => 0, 
									 'captcha'=> 0, 
									 'num1' => $num1,
									 'num2' => $num2,
									));   
		}

		$online_lead = DB::table('campaign_leads')
		->insert([
			'name' => $name,
			'email' => $email,
			'mobile' => $mobile,
			'source' => $source,
			'state' => $state_id,
			'district' => $district_id,
			'utm_source' => $utm_source,
			'utm_medium' => $utm_medium,
			'utm_campaign' => $utm_campaign,
			'created_at' => $date,
			'updated_at' => $date,
		]);

		$db_ext = \DB::connection('sqlsrv');

    	$conn = $db_ext -> getPdo();

    	//$name = $name;
		$contact = $mobile;
		//$email = "rahul@webmaffia.com";
		$district = $district_id;
		$state = $state_id;
		//$source = "Social media";
		$app_status_id = 0;
		$mode_of_receipt = "online";

    	//$pst = $conn -> prepare("DECLARE @OutP varchar(100) = 'test'; SELECT @OutP as OutP");
    	
		/** code for sp_AddEditFranchiseeInquiry1 start  **/

    	/*$pst = $conn -> prepare("DECLARE @returnregcode varchar(50); EXEC sp_AddEditFranchiseeInquiry1 ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,@returnregcode OUT; SELECT @returnregcode as [RegCode];"
    	);

    	$pst -> execute(array(null, null, null, $name, $contact, $email, 0, 0, null, null, null, null, null, null, $district, $state, null, null, null, $source, null, $app_status_id, null, null, $mode_of_receipt, null, null, null, null, null, null, null, null, null, null));

    	$pst -> nextRowset();
    	$results = $pst -> fetchAll(\PDO::FETCH_ASSOC);*/
    	/** end here **/
		
		/** code for sp_AddEditFranchiseeInquiry_FromWebsite  **/

    	$pst = $conn -> prepare("EXEC sp_AddEditFranchiseeInquiry_FromWebsite ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?;");

    	$pst -> execute(array(null, null, null, $name, $contact, $email, 0, 0, null, null, null, null, null, null, $district, $state, null, null, null, $source, null, $app_status_id, null, null, $mode_of_receipt, null, null, null, null, null, null, null, null, null, null,0,null,null,0,0,null,null,null,null,null));


    	/** end here **/
		
		//$results = $pst -> fetchAll(\PDO::FETCH_ASSOC);

		if($pst){
			return response()->json(['status' => 1]);
		}
		else{
			return response()->json(['status' => 0]);	
		}

	}
	
	public function searchResults() {
		$page = Page::where('slug', 'search-results')->where('status', 1)->get();
		return view('pages.search-results')->with(compact(['page']));
	}
	
	public function applyOnlineFormSubmit(Request $request){
		
		/*$captcha = $request->captcha;
		$value = $request->session()->pull('form_captcha', '');
		if($captcha != $value) {
			$num1 = rand(10, 100);
			$num2 = rand(10, 100);
			$random = $num1 + $num2;

			$request->session()->put('form_captcha', $random);
			return json_encode(array('status' => 0, 
									 'captcha'=> 0, 
									 'num1' => $num1,
									 'num2' => $num2,
									));   
		}*/

		$name = $request->name;
		$mobile = $request->mobile;
		$email = $request->email;
		$source = $request->source;
		$state_id = $request->state_id;
		$district_id = $request->district_id;
		$date = date('Y-m-d H:i:s');
		//dd($state_id, $district_id);

		$test_data = RetailOnlineLead::where('email','=',$email) ->get();
		dd($test_data);

		//$validation = $this->apply_online_validator($request->all())->validate();

		$this->validate($request, [ 
			'name' => 'required|string|max:255',
			'mobile' => 'required|min:10|numeric', 
			'source' => 'required|string',
			'state_id' => 'required|string',
			'district_id' => 'required|string', 
		]);
		
		if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
			return response()->json(['status' => 2]);
		}

		$captcha = $request->captcha;
		$value = $request->session()->pull('form_captcha', '');
		if($captcha != $value) {
			$num1 = rand(10, 100);
			$num2 = rand(10, 100);
			$random = $num1 + $num2;

			$request->session()->put('form_captcha', $random);
			return json_encode(array('status' => 0, 
									 'captcha'=> 0, 
									 'num1' => $num1,
									 'num2' => $num2,
									));   
		}

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

		

		$db_ext = \DB::connection('sqlsrv');

    	$conn = $db_ext -> getPdo();

    	//$name = $name;
		$contact = $mobile;
		//$email = "rahul@webmaffia.com";
		$district = $district_id;
		$state = $state_id;
		//$source = "Social media";
		$app_status_id = 0;
		$mode_of_receipt = "online";

    	//$pst = $conn -> prepare("DECLARE @OutP varchar(100) = 'test'; SELECT @OutP as OutP");
    	
		/** code for sp_AddEditFranchiseeInquiry1 start  **/

    	/*$pst = $conn -> prepare("DECLARE @returnregcode varchar(50); EXEC sp_AddEditFranchiseeInquiry1 ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,@returnregcode OUT; SELECT @returnregcode as [RegCode];"
    	);

    	$pst -> execute(array(null, null, null, $name, $contact, $email, 0, 0, null, null, null, null, null, null, $district, $state, null, null, null, $source, null, $app_status_id, null, null, $mode_of_receipt, null, null, null, null, null, null, null, null, null, null));

    	$pst -> nextRowset();
    	$results = $pst -> fetchAll(\PDO::FETCH_ASSOC);*/
    	/** end here **/
		
		/** code for sp_AddEditFranchiseeInquiry_FromWebsite  **/

    	$pst = $conn -> prepare("EXEC sp_AddEditFranchiseeInquiry_FromWebsite ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?;");

    	$pst -> execute(array(null, null, null, $name, $contact, $email, 0, 0, null, null, null, null, null, null, $district, $state, null, null, null, $source, null, $app_status_id, null, null, $mode_of_receipt, null, null, null, null, null, null, null, null, null, null,0,null,null,0,0,null,null,null,null,null));


    	/** end here **/
		
		//$results = $pst -> fetchAll(\PDO::FETCH_ASSOC);

		if($pst){
			return response()->json(['status' => 1]);
		}
		else{
			return response()->json(['status' => 0]);	
		}

	}

	public function roPumps(){

		$db_ext = \DB::connection('sqlsrv1');
		
		//As Dicussed With Taabish Added Below Lines On 07-Aug-2019
		$date = date('Y-m-d');
		$timestamp = strtotime($date);
		$timestamp = $timestamp*1000;

		$timestamp1 = time();
		$timestamp1 = $timestamp1*1000;
		
		//As Dicussed With Taabish commented Below Lines On 22-Aug-2019
		//$pumps = $db_ext->table('essar_outlet')/*->join('essar_outlet_product_price','essar_outlet.outlet_cmscode','essar_outlet_product_price.outlet_cmscode')*/->get();
		
		//As Dicussed With Taabish added Below Lines On 22-Aug-2019
		$pumps = $db_ext->table('essar_outlet')/*->join('essar_outlet_product_price','essar_outlet.outlet_cmscode','essar_outlet_product_price.outlet_cmscode')*/->get()->toArray();
		foreach ($pumps as $key => $value) {
			
			//Commnetd Old COde
			//$petrol_price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', 'PETROL')->where('outlet_cmscode', $value->outlet_cmscode)->get();
			//$diesel_price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', 'DIESEL')->where('outlet_cmscode', $value->outlet_cmscode)->get();
			
			//As Dicussed With Taabish Added Below Lines On 12-Aug-2019
			$petrol_price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', 'PETROL')->where('outlet_cmscode', $value->outlet_cmscode)->where('from_dt', '>=', $timestamp)->where('from_dt', '<=', $timestamp1)->get();
			$diesel_price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', 'DIESEL')->where('outlet_cmscode', $value->outlet_cmscode)->where('from_dt', '>=', $timestamp)->where('from_dt', '<=', $timestamp1)->get();
			
			if(count($petrol_price) > 0){
                $value->petrol_price = $petrol_price[0]->price;
            }
            else{
                $value->petrol_price = '';
            }
            if(count($diesel_price) > 0){
                $value->diesel_price = $diesel_price[0]->price;
            }
            else{
                $value->diesel_price = '';    
            }
			
			if($value->diesel_price == '' && $value->petrol_price = ''){
				unset($pumps[$key]);
			}
		}
		return $pumps;
	}

	public function boardTeamContent(Request $request) {
		$audit_team = [];
		$nomination_team = [];
		$csr_team = [];
		$stakeholder_team = [];
		$hse_team = [];
		$trading_team = [];
		$banking_team = [];
		//dd($audit_team);
		$page = Page::where('slug', $request->slug)->where('status', 1)->get();
		if(count($page) == 0) {
			return redirect()->route('home.homepage');
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
					elseif ($value->commitee == 'hse') {
						$hse_team[$value->order] = $value;
					}
					elseif ($value->commitee == 'trading') {
						$trading_team[$value->order] = $value;
					}
					elseif ($value->commitee == 'banking') {
						$banking_team[$value->order] = $value;
					}
				}
				$team = array();
				$team['audit_team'] = $audit_team;
				$team['nomination_team'] = $nomination_team;
				$team['stakeholder_team'] = $stakeholder_team;
				$team['csr_team'] = $csr_team;
				$team['hse_team'] = $hse_team;
				$team['trading_team'] = $trading_team;
				$team['banking_team'] = $banking_team;
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
				//dd($team, $page);
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
            'state_id'=> 'required|string',
            'district_id'=> 'required|string',
        ]);
    }

    public function populateStates() {
    	//$states = FranchiseState::with('franchise_districts')->get()->toArray();
    	try{
    		$db_ext = \DB::connection('sqlsrv');
    	}
    	catch(\Exception $e){
    		die(1);
    	}
    	$states = $db_ext->table('State_Mst')/*->join('District_Mst', 'District_Mst.StateId', 'State_Mst.State_id')*/->get();
    	//dd($states);
    	return $states;
    }

    public function populateDistrict(Request $request) {
    	$state = $request->state;
    	//$states = FranchiseState::with('franchise_districts')->get()->toArray();
    	try{
    		$db_ext = \DB::connection('sqlsrv');
    	}
    	catch(\Exception $e){
    		die(1);
    	}
    	//$state = $db_ext->table('State_Mst')->where('State_Name', $state)->get();
    	//dd($state);
		$district = $db_ext->table('District_Mst')->where('StateId', $state)->get();
    	//dd($district);
    	return $district;
    }

    public function exportLeads(Request $request,$model='RetailOnlineLead') {
    	$nameSpace = '\\App\\';
    	$model_object = app($nameSpace . $model);
    	$from_date = $request->from_date;
    	$to_date = $request->to_date;
    	if(!empty($from_date) && !empty($to_date)){
    		$leads = $model_object::whereDate('created_at', '>=', date($from_date))->whereDate('created_at', '<=', date($to_date))->get();
    	}
    	else{
    		$leads = $model_object::/*join('franchise_states', 'franchise_states.id', 'retail_online_leads.district')->join('franchise_districts', 'franchise_districts.id', 'retail_online_leads.state' )->*/get();
    		//dd($leads);
    	}
    	if(count($leads) > 0){
				 
            $export_leads="id,name,email,mobile,source,state,district,created_at\n";

	        foreach($leads as $lead){
	            $export_leads.=$lead->id.','.$lead->name.','.$lead->email.','.$lead->mobile.','.$lead->source.','.$lead->state.','.$lead->district.','.$lead->created_at."\n";
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

    public function exportCampaignLeads(Request $request) {
    	$from_date = $request->from_date;
    	$to_date = $request->to_date;
    	if(!empty($from_date) && !empty($to_date)){
    		$leads = CampaignLead::whereDate('created_at', '>=', date($from_date))->whereDate('created_at', '<=', date($to_date))->get();
    	}
    	else{
    		$leads = CampaignLead::/*join('franchise_states', 'franchise_states.id', 'retail_online_leads.district')->join('franchise_districts', 'franchise_districts.id', 'retail_online_leads.state' )->*/get();
    		//dd($leads);
    	}
    	if(count($leads) > 0){
				 
            $export_leads="id,name,email,mobile,source,state,district,utm_source,utm_medium,utm_campaign\n";

	        foreach($leads as $lead){
	            $export_leads.=$lead->id.','.$lead->name.','.$lead->email.','.$lead->mobile.','.$lead->source.','.$lead->state.','.$lead->district.','.$lead->utm_source.','.$lead->utm_medium.','.$lead->utm_campaign."\n";
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
    	try{
    		$db_ext = \DB::connection('sqlsrv1');
    	}
    	catch(\Exception $e){
    		die(1);
    	}
		//As Dicussed With Taabish Added Below Lines On 07-Aug-2019
		$date = date('Y-m-d');
		$timestamp = strtotime($date);
		$timestamp = $timestamp*1000;

		$timestamp1 = time();
		$timestamp1 = $timestamp1*1000;

		
    	$radius = $request->radius;
    	$location = $request->location;
    	$curr_latitude = $request->curr_lat;
    	$curr_longitude = $request->curr_long;
    	$pump = $db_ext->table('essar_outlet')->get();
    	$pumps = array();
    	//dd($pump);
    	foreach ($pump as $key => $value) {
    		$model_latitude = (float)$value->latitude;
    		$model_longitude = (float)$value->longitude;
    		if(is_numeric($model_latitude) && is_numeric($model_longitude)){
	            $theta = $curr_longitude - $model_longitude; 
		        $dist = sin(deg2rad($curr_latitude)) * sin(deg2rad($model_latitude)) +  cos(deg2rad($curr_latitude)) * cos(deg2rad($model_latitude)) * cos(deg2rad($theta)); 
		        $dist = acos($dist); 
		        $dist = rad2deg($dist); 
		        $miles = $dist * 60 * 1.1515 * 1.609344;
		        if($miles < $radius) {
		        	$pumps[$key]['ro_name'] = $value->outlet_name;
		        	$pumps[$key]['cms_code'] = $value->outlet_cmscode;
		        	$pumps[$key]['address'] = $value->address_line2;
		        	$pumps[$key]['address1'] = $value->address_line1;
		        	$pumps[$key]['latitude'] = $value->latitude;
		        	$pumps[$key]['longitude'] = $value->longitude;
					if($value->Is_Fleet_Operation == 1){
		        		$pumps[$key]['efp'] = 'YES';
		        	}
		        	else{
		        		$pumps[$key]['efp'] = 'NO';
		        	}
		        }
    		}
    	}
    	foreach ($pumps as $key1 => $value1) {
			//Comment Old Lines.
    		//$petrol_price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', 'PETROL')->where('outlet_cmscode', $value1['cms_code'])->get();
    		//$diesel_price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', 'DIESEL')->where('outlet_cmscode', $value1['cms_code'])->get();
			
			//As Dicussed With Taabish Deployed Below Lines On 07-Aug-2019
			//$petrol_price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', 'PETROL')->where('outlet_cmscode', $value1['cms_code'])->where('from_dt', '>=', $timestamp)->get();
			//$diesel_price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', 'DIESEL')->where('outlet_cmscode', $value1['cms_code'])->where('from_dt', '>=', $timestamp)->get();
    		
			//As Dicussed With Taabish Deployed Below Lines On 07-Aug-2019
			$petrol_price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', 'PETROL')->where('outlet_cmscode', $value1['cms_code'])->where('from_dt', '>=', $timestamp)->where('from_dt', '<=', $timestamp1)->get();
			$diesel_price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', 'DIESEL')->where('outlet_cmscode', $value1['cms_code'])->where('from_dt', '>=', $timestamp)->where('from_dt', '<=', $timestamp1)->get();

			//dd($petrol_price, $diesel_price);
    		if(count($petrol_price) == 1){
    			$pumps[$key1][$petrol_price[0]->fuel_type] = $petrol_price[0]->price;
    		}
    		else{
    			$pumps[$key1]['PETROL'] = '';
    		}
    		if(count($diesel_price) == 1){
    			$pumps[$key1][$diesel_price[0]->fuel_type] = $diesel_price[0]->price;
    		}
    		else{
    			$pumps[$key1]['DIESEL'] = '';	
    		}
			
			if($pumps[$key1]['DIESEL'] == '' && $pumps[$key1]['PETROL'] == ''){
				unset($pumps[$key1]);
			}
    	}
    	//dd($pumps);	
    	return $pumps;
    }

    public function getCodeRo(Request $request) {

    	$pumps = array();
    	try{
    		$db_ext = \DB::connection('sqlsrv1');
    	}
    	catch(\Exception $e){
    		die(1);
    	}
		
		//As Dicussed With Taabish Added Below Lines On 12-Aug-2019
		$date = date('Y-m-d');
		$timestamp = strtotime($date);
		$timestamp = $timestamp*1000;

		$timestamp1 = time();
		$timestamp1 = $timestamp1*1000;
		
    	$pump = $db_ext->table('essar_outlet')->where('outlet_cmscode', $request->ro_code)->get();

    	$pumps[0]['ro_name'] = $pump[0]->outlet_name;
    	$pumps[0]['cms_code'] = $pump[0]->outlet_cmscode;
    	$pumps[0]['address'] = $pump[0]->address_line2;
    	$pumps[0]['address1'] = $pump[0]->address_line1;
    	$pumps[0]['latitude'] = $pump[0]->latitude;
    	$pumps[0]['longitude'] = $pump[0]->longitude;
		if($pump[0]->Is_Fleet_Operation == 1){
    		$pumps[0]['efp'] = 'YES';
    	}
    	else{
    		$pumps[0]['efp'] = 'NO';
    	}
    	$petrol_price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', 'PETROL')->where('outlet_cmscode', $request->ro_code)->where('from_dt', '>=', $timestamp)->where('from_dt', '<=', $timestamp1)->get();
    	$diesel_price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', 'DIESEL')->where('outlet_cmscode', $request->ro_code)->where('from_dt', '>=', $timestamp)->where('from_dt', '<=', $timestamp1)->get();
    	//dd($petrol_price, $diesel_price);
    	if(count($petrol_price) == 1){
			$pumps[0][$petrol_price[0]->fuel_type] = $petrol_price[0]->price;
		}
		else{
			$pumps[0]['PETROL'] = '';
		}
		if(count($diesel_price) == 1){
			$pumps[0][$diesel_price[0]->fuel_type] = $diesel_price[0]->price;
		}
		else{
			$pumps[0]['DIESEL'] = '';	
		}		
		
		if($pumps[0]['DIESEL'] == '' && $pumps[0]['PETROL'] == ''){
			unset($pumps[0]);
		}
		
		return $pumps;

    	/*$pump = Pump::where('cms_code', $request->ro_code)->get();
    	if(count($pump) > 0){
    		return $pump;
    	}
    	else{
    		return 0;
    	}*/
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


    public function retailThankYou() {

    	$page = Page::where('slug', 'apply-online')->where('status', 1)->get();

    	$num1 = rand(10, 100);
		$num2 = rand(10, 100);
		$random = $num1 + $num2;

		//$request->session()->put('form_captcha', $random);
		return view('pages.thankyou')->with(compact(['page', 'num1','num2']));
		
    }

    public function applyOnlineDealershipFormSubmit(Request $request){
		
		/*$captcha = $request->captcha;
		$value = $request->session()->pull('form_captcha', '');
		if($captcha != $value) {
			$num1 = rand(10, 100);
			$num2 = rand(10, 100);
			$random = $num1 + $num2;

			$request->session()->put('form_captcha', $random);
			return json_encode(array('status' => 0, 
									 'captcha'=> 0, 
									 'num1' => $num1,
									 'num2' => $num2,
									));   
		}*/

		$name = $request->name;
		$mobile = $request->mobile;
		$email = $request->email;
		$source = $request->source;
		$state_id = $request->state_id;
		$district_id = $request->district_id;
		$date = date('Y-m-d H:i:s');
		//dd($state_id, $district_id);

		//$validation = $this->apply_online_validator($request->all())->validate();

		$this->validate($request, [ 
			'name' => 'required|string|max:255',
			'mobile' => 'required|min:10|numeric', 
			'source' => 'required|string',
			'state_id' => 'required|string',
			'district_id' => 'required|string', 
		]);
		
		if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
			return response()->json(['status' => 2]);
		}

		$captcha = $request->captcha;
		$value = $request->session()->pull('form_captcha', '');
		if($captcha != $value) {
			$num1 = rand(10, 100);
			$num2 = rand(10, 100);
			$random = $num1 + $num2;

			$request->session()->put('form_captcha', $random);
			return json_encode(array('status' => 0, 
									 'captcha'=> 0, 
									 'num1' => $num1,
									 'num2' => $num2,
									));   
		}

		$online_lead = DB::table('distributor_online_leads')
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

		$db_ext = \DB::connection('sqlsrv');

    	$conn = $db_ext -> getPdo();

    	//$name = $name;
		$contact = $mobile;
		//$email = "rahul@webmaffia.com";
		$district = $district_id;
		$state = $state_id;
		//$source = "Social media";
		$app_status_id = 0;
		$mode_of_receipt = "online";
		
		/** code for sp_AddEditFranchiseeInquiry_FromWebsite  **/

    	$pst = $conn -> prepare("EXEC sp_AddEditFranchiseeInquiry_FromWebsite ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?;");

    	$pst -> execute(array(null, null, null, $name, $contact, $email, 0, 0, null, null, null, null, null, null, $district, $state, null, null, null, $source, null, $app_status_id, null, null, $mode_of_receipt, null, null, null, null, null, null, null, null, null, null,0,null,null,0,0,null,null,null,null,null));

    	/** end here **/
    	//$pst = true;
		if($pst){
			return response()->json(['status' => 1]);
		}
		else{
			return response()->json(['status' => 0]);	
		}

	}

	public function distributorThankYou() {

    	$page = Page::where('slug', 'apply-online')->where('status', 1)->get();

    	$num1 = rand(10, 100);
		$num2 = rand(10, 100);
		$random = $num1 + $num2;

		//$request->session()->put('form_captcha', $random);
		return view('pages.thankyou')->with(compact(['page', 'num1','num2']));
		
    }
}
