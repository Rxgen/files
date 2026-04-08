<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\FranchiseState;
use App\FranchiseDistrict;
use App\Page;
use App\Blogpost;
use App\ManagementTeam;
use App\SustainableDevelopment;
use DB;
//use SMS;
use App\Facades\Sms;
use App\RetailOnlineLead;
use App\Test;
use App\Pump;
use App\Faq;
use App\NewsRoom;
use App\CampaignLead;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Event;
use App\EnquiryLead;



class StaticPageController extends Controller
{
	
	public function staticPageContent(Request $request) {
		if (!preg_match('/^[a-zA-Z0-9\-]+$/', $request->slug)) {
        abort(404);
    }
		$page = Page::where('slug', $request->slug)->where('status',1)->get();
		//$pageSchema=$page->first()->page_schema;
		
		
		if(count($page) == 0) {
			return response()->view('exceptions.error_404');
		}
		switch ($request->slug) {
			case 'vadinar-refinery':
				$path = $request->path();
				return view('pages.refinery')->with(compact(['page','path']));
				break;
			case 'awards':
                $dates = NewsRoom::select('date')->where('news_room_section', 'awards')->where('status', 1)->distinct()->orderBy('date','DESC')->get();                
                $awards = NewsRoom::where('news_room_section', 'awards')->where('status', 1)->orderBy('date','DESC')->get()->groupBy('date')->map(function ($group) {
					return $group->sortByDesc('order');
				});
                return view('pages.awards')->with(compact(['page', 'dates', 'awards']));
				case 'blog':
                    $blogposts=BlogPost::where('status', 1)->orderBy('created_at', 'desc')->get();
                    $latestblogs = BlogPost::where('status', 1)->orderBy('order_id','DESC')->limit(2)->get();
                    return view('pages.blog')->with(compact(['page','blogposts','latestblogs']));
					
				case 'petrochemicals':
                    return view('petrochemicals.pages.home')->with(compact(['page']));
                    break;
					
				case 'privacy-notice':
					return view('pages.privacy-notice')->with(compact(['page']));
					break;
			    case 'mahabachat-utsav':
				     return view('pages.scheme-promotion')->with(compact(['page']));
			         break;

			    case 'terms-condition':
				    return view('pages.terms-condition')->with(compact(['page']));
		            break;

				//case 'scheme-promotion':
						//return view('pages.scheme-terms-condition')->with(compact(['page']));
						//break;
				case 'events':
						$events=Event::Where('status','=','1')->get();
						
						return view('pages.events')->with(compact(['page','events']));
						break;
				case 'institutional-business':
					  return view('InstitutionalBusiness.Pages.index')->with(compact(['page']));
						break;	
				case 'fleet-plus':
					   return view('pages.fleet-plus')->with(compact(['page']));
						break;
				case 'exhibition-enquiry':
							return view('pages.qrcode')->with(compact(['page']));
						break;									
					
			default:
				return view('pages.contact')->with(compact(['page','pageSchema']));
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
			return response()->view('exceptions.error_404');
		}
		switch ($request->slug) {
			case 'petrol-pump-dealership-faqs':
				$faqs = Faq::where('status', 1)->get();
				return view('pages.faqs')->with(compact(['page','faqs']));

			case 'petrol-pump-dealership-eligibility':
					return view('pages.dealership-eligibility')->with(compact(['page']));	
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
	
	/*public function searchResults() {
		$page = Page::where('slug', 'search-results')->where('status', 1)->get();
		return view('pages.search-results')->with(compact(['page']));
	}*/
	public function searchResults(Request $request) 
    {
        $usersearchdata = $request->input('search_field');
        $page = Page::where('slug', 'search-results')->where('status', 1)->get();
        $users= Page::where('slug','LIKE',"%{$usersearchdata}%")->get();
        $dynamicslug=$users['0']->page_url;
        $baseUrl = config('app.url');
        $pageUrl=$baseUrl."/".$dynamicslug; 
        return view('pages.search-results')->with(compact(['page','pageUrl','users']));
    }

    public function autosearch(Request $request) 
    {
    $usersearquery = $request->input('query');
    $data= Page::where('banner_title','LIKE',"%{$usersearquery}%")->pluck('slug');
     
    return response()->json($data);
    }
		
	public function applyOnlineFormSubmit(Request $request){
		
		Log::debug("Test");
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
		try {
			$valid = $this->validate($request, [ 
				'name' => 'required|string|max:255',
				'mobile' => 'required|min:10|numeric|unique:retail_online_leads',
				'email' => 'required|email|unique:retail_online_leads',
				'source' => 'required|string',
				'state_id' => 'required|string',
				'district_id' => 'required|string',
			]);
		} catch (\Illuminate\Validation\ValidationException $e) {
			return response()->json(['status' => 'error', 'errors' => $e->errors()]);
		}
		
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

		$mobile=$request->mobile;
		$msg = config('sms.enquiry_sms_template');
		$msg = str_replace(['+', '%'], ' ', $msg);
		$templateId = config('sms.enquiry_sms_dlt_temp_id');
		Log::debug($msg);
		Log::debug($templateId);
		Log::debug("API Testing");
		$messagesent = Sms::Enquirysms($mobile, $msg, $templateId);
		Log::debug("message from the API".$messagesent);
		Log::debug("After API CAll");
		  /* if($messagesent){
			return response()->json(['status' => 1]);
		}else {
			return response()->json(['status' => 0]);
		}   */

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

    public function getRo(Request $request)
   {
	
	try {
		$db_ext = \DB::connection('sqlsrv1');
	} catch (\Exception $e) {
		
		die(1);
	}

	
	
    $thresholdRadius = 5; // Fixed threshold radius in kilometers
	$routeCoordinates = $request->route_coordinates; 
	$foundPumps = []; // Track already found pumps
	$uniquePumps = []; // To store unique pumps in the result

	Log::info('Fetching petrol pumps within threshold radius', [
		'threshold_radius' => $thresholdRadius,
		'route_coordinates_count' => count($routeCoordinates),
	]);

    $timestamp = strtotime(date('Y-m-d')) * 1000;
    $timestamp1 = time() * 1000;
    $pumps = $db_ext->table('essar_outlet')
	    ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->whereRAW("ISNUMERIC(latitude) =  1") 
		->whereRAW("ISNUMERIC(longitude) =  1")
		->whereRAW('CAST(latitude as FLOAT) != 0')
		->whereRAW('CAST(longitude as FLOAT) != 0')
        ->get();

             

// Iterate through each route coordinate
foreach ($routeCoordinates as $coordinate) {
	$lat = $coordinate['lat'];
	$lng = $coordinate['lng'];

	foreach ($pumps as $pump) {
		$model_latitude = (float)$pump->latitude;
		$model_longitude = (float)$pump->longitude;

		// Skip already found pumps
		$pumpId = $pump->id;
		if (isset($foundPumps[$pumpId])) {
			continue;
		}

		// Check if the pump is within the fixed threshold radius
		$distance = $this->calculateDistance($lat, $lng, $model_latitude, $model_longitude);
		if ($distance <= $thresholdRadius) {
			// Fetch fuel prices
			$petrol_price = $this->getFuelPrice($pump->outlet_cmscode, 'PETROL');
			$diesel_price = $this->getFuelPrice($pump->outlet_cmscode, 'DIESEL');

			// Add the pump to the result
			$uniquePumps[] = [
				'ro_name' => $pump->outlet_name,
				'cms_code' => $pump->outlet_cmscode,
				'address' => $pump->address_line2,
				'address1' => $pump->address_line1,
				'latitude' => $pump->latitude,
				'longitude' => $pump->longitude,
				'efp' => $pump->Is_Fleet_Operation == 1 ? 'YES' : 'NO',
				'distance' => $distance,
				'PETROL' => $petrol_price,
				'DIESEL' => $diesel_price,
			];

			$foundPumps[$pumpId] = true;
		}
	}
}

Log::info('Found unique pumps along the route', [
	'unique_pump_count' => count($uniquePumps),
]);

// Return the unique pumps
return response()->json(array_values($uniquePumps)); 
}

private function calculateDistance($lat1, $lon1, $lat2, $lon2)
{
    // Radius of the Earth in kilometers
    $earth_radius = 6371;

    $lat1_rad = deg2rad($lat1);
    $lon1_rad = deg2rad($lon1);
    $lat2_rad = deg2rad($lat2);
    $lon2_rad = deg2rad($lon2);

    // Haversine formula
    $dlat = $lat2_rad - $lat1_rad;
    $dlon = $lon2_rad - $lon1_rad;

    $a = sin($dlat / 2) * sin($dlat / 2) +
         cos($lat1_rad) * cos($lat2_rad) *
         sin($dlon / 2) * sin($dlon / 2);

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    // Distance in kilometers
    $distance = $earth_radius * $c;

    return $distance;
}

private function getFuelPrice($cms_code, $fuel_type)
{
	try {
		$db_ext = \DB::connection('sqlsrv1');
	} catch (\Exception $e) {
		die(1);
	}
    
    $price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', $fuel_type)
        ->where('outlet_cmscode', $cms_code)
        ->value('price');

    return $price ?: ''; 
}
	

public function getRoRadius(Request $request)
{
 
 try {
	 $db_ext = \DB::connection('sqlsrv1');
 } catch (\Exception $e) {
	 
	 die(1);
 }

 
 
 $radius = $request->radius;
 $curr_latitude = $request->curr_lat ?: 19.0760;  
 $curr_longitude = $request->curr_long ?: 72.8777; 

 Log::info('Fetching petrol pumps within radius', [
	 'radius' => $radius,
	 'current_latitude' => $curr_latitude,
	 'current_longitude' => $curr_longitude
 ]);

 $timestamp = strtotime(date('Y-m-d')) * 1000;
 $timestamp1 = time() * 1000;
 $pumps = $db_ext->table('essar_outlet')
	 ->whereNotNull('latitude')
	 ->whereNotNull('longitude')
	 ->whereRAW("ISNUMERIC(latitude) =  1") 
	 ->whereRAW("ISNUMERIC(longitude) =  1")
	 ->whereRAW('CAST(latitude as FLOAT) != 0')
	 ->whereRAW('CAST(longitude as FLOAT) != 0')
	 ->get()
	 ->map(function ($pump) use ($curr_latitude, $curr_longitude, $radius, $timestamp, $timestamp1) {
		 $model_latitude = (float)$pump->latitude;
		 $model_longitude = (float)$pump->longitude;

		 /* Log::info('Checking pump', [
			 'outlet_name' => $pump->outlet_name,
			 'latitude' => $model_latitude,
			 'longitude' => $model_longitude,
			 'address' => $pump->address_line1
		 ]); */

		 if ($model_latitude == 0 || $model_longitude == 0) {
			 Log::warning('Pump has invalid coordinates', [
				 'outlet_name' => $pump->outlet_name,
				 'latitude' => $model_latitude,
				 'longitude' => $model_longitude
			 ]);
			 return null;
		 }

		 // Calculate distance between current location (or default) and pump
		 $distance = $this->calculateDistance($curr_latitude, $curr_longitude, $model_latitude, $model_longitude);

		 // If the pump is within the radius, fetch the fuel prices and return the pump data
		 if ($distance <= $radius) {
			 $petrol_price = $this->getFuelPrice($pump->outlet_cmscode, 'PETROL' );
			 $diesel_price = $this->getFuelPrice($pump->outlet_cmscode, 'DIESEL');

			 return [
				 'ro_name' => $pump->outlet_name,
				 'cms_code' => $pump->outlet_cmscode,
				 'address' => $pump->address_line2,
				 'address1' => $pump->address_line1,
				 'latitude' => $pump->latitude,
				 'longitude' => $pump->longitude,
				 'efp' => $pump->Is_Fleet_Operation == 1 ? 'YES' : 'NO',
				 'distance' => $distance,
				 'PETROL' => $petrol_price,
				 'DIESEL' => $diesel_price
			 ];
		 }

		 return null;
	 })
	 ->filter()
	 ->toArray();

	 Log::info('Found pumps within the radius', [
	 'pump_count' => count($pumps)
 ]);

 return array_values($pumps); // Reindex the array and return the results
}


public function getCodeRo(Request $request)
{
	try {
		$db_ext = \DB::connection('sqlsrv1');
	} catch (\Exception $e) {
		die(1);
	}
    $pumps = [];
    $ro_code = $request->ro_code;
    if (!$ro_code) {
        return response()->json(['error' => 'RO code is required'], 400);
    }


    $pump = $db_ext->table('essar_outlet')->where('outlet_cmscode', $ro_code)->first();

    if (!$pump) {
        return response()->json(['error' => 'Pump not found'], 404);
    }

    $timestamp = strtotime(date('Y-m-d')) * 1000;
    $timestamp1 = time() * 1000;

    
    $petrol_price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', 'PETROL')
        ->where('outlet_cmscode', $ro_code)
        ->value('price');

    $diesel_price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', 'DIESEL')
        ->where('outlet_cmscode', $ro_code)
        ->value('price');

    
    $pumps[] = [
        'ro_name' => $pump->outlet_name,
        'cms_code' => $pump->outlet_cmscode,
        'address' => $pump->address_line2,
        'address1' => $pump->address_line1,
        'latitude' => $pump->latitude,
        'longitude' => $pump->longitude,
        'efp' => $pump->Is_Fleet_Operation == 1 ? 'YES' : 'NO',
        'PETROL' => $petrol_price ?: 'Not Available', 
        'DIESEL' => $diesel_price ?: 'Not Available', 
    ];

    return response()->json($pumps);
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

    	$page = Page::where('slug', 'petrol-pump-dealership-apply')->where('status', 1)->get();

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
	public function clearAllCache($param = null)
    {

        Cache::flush();
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        echo 'Cache cleared successfully.';
    }
	public function EventContent(Request $request) {
		$page = Page::where('slug', 'events')->where('status',1)->get();
		$eventdetails=Event::where('event_slug','=',$request->slug)->Where('status','=','1')->orderBy("order_by")->first();
		 $eventSchemaCode=$eventdetails->schema;
        return view('pages.event-details')->with(compact(['page','eventdetails','eventSchemaCode']));
	}

	public function EnquiryLeads(Request $request ) {
		
	    $Enquiry = new EnquiryLead();
		$Enquiry->companyname = $request->companyname;
		$Enquiry->mobile = $request->mobilenumber;
		$Enquiry->email = $request->email;
		$Enquiry->category= $request->category;
		$Enquiry->category2= $request->category2;
		$Enquiry->tradingComment= $request->tradingComment;
		$Enquiry->refineryComment= $request->refineryComment;
		$Enquiry->otherComment= $request->otherComment;
		$Enquiry->country= $request->country;
		$Enquiry->contact_person= $request->contactperson;
        $Enquiry->save();

		try {
			if ($Enquiry->id) {
				$responseData = [
					'status' => 1,
					'category' => $request->category, 
				];
			}
			return response()->json($responseData);
		} catch (\Exception $e) {
			Log::error('Error fetching enquiry: ' . $e->getMessage());
		     return response()->json([
				'status' => 0,
				'message' => 'An error occurred while processing your request. Please try again later.'
			]);
		}
	}
}
