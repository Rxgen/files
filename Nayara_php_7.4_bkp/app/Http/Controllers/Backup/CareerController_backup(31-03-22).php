<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobDepartment;
use App\JobLocation;
use App\JobOpening;
use App\Page;
use DB;
use Illuminate\Support\Facades\Cookie;

class CareerController extends Controller
{
    public function career(Request $request) {
    	//dd($request->location, $request->department);
    	$department_id = '';
    	$location_id = '';
    	$page = Page::where('slug', 'career-opening')->where('status',1)->get();
		if(count($page) == 0) {
			return response()->view('exceptions.error', ['message'=>'Sorry, the requested page could not be found', 'error_code'=>'404'], 404);
		}
		if(!empty($request->location) || !empty($request->department)){
    		$location_id = JobLocation::where('district', $request->location)->where('status', 1)->get();
    		if(count($location_id) > 0){
    			$location_id = $location_id[0]->id;
    		}
    		else{
    			$location_id = null;	
    		}
    		$department_id = JobDepartment::where('department', $request->department)->where('status', 1)->get();
    		if(count($department_id) > 0){
    			$department_id = $department_id[0]->id;
    		}
    		else{
    			$department_id = null;
    		}
    		//dd($location_id, $department_id);
    	}

		if (!empty($location_id)) {
    		$jobs_id = DB::table('job_location_job_opening')->where('job_location_id', $location_id)->get();
    		$jobsId = array();
    		foreach ($jobs_id as $key => $value) {
    			array_push($jobsId, $value->job_opening_id);
    		}
    	}
    	if(empty($department_id) && empty($location_id)){
    		$jobs = JobOpening::where('job_openings.status', 1); 
    	}
    	elseif(!empty($department_id) && empty($location_id)) {
            //echo 1;
    		$jobs = JobOpening::where('job_openings.status', 1)->where('job_openings.department', $department_id); 	
    	}
    	elseif (empty($department_id) && !empty($location_id)) {
    		$jobs = JobOpening::where('job_openings.status', 1)->whereIn('job_openings.id', $jobsId);	
    	}
    	elseif(!empty($department_id) && !empty($location_id)){
    		$jobs = JobOpening::where('job_openings.status', 1)->where('job_openings.department', $department_id)->whereIn('job_openings.id', $jobsId);
    	}
		$jobs = $jobs->with('job_locations')->with('job_departments')->paginate(10);
        $last_page = $jobs->lastPage();
        if(count($jobs) > 0){

        }else{
            $jobs = array();
        }
        //dd($jobs);
		$jobs_id = DB::table('job_openings')->get();
		$jobsId = array();
		foreach ($jobs_id as $key => $value) {
			array_push($jobsId, $value->id);
		}
		//dd($jobsId);

    	$cities = DB::table('job_location_job_opening')->select('job_locations.id','job_locations.district')->join('job_locations','job_locations.id','job_location_job_opening.job_location_id')->whereIn('job_location_job_opening.job_opening_id', $jobsId)->distinct()->get(['job_location_job_opening.job_location_id'])->toArray();
    	//dd($cities);
    	$departments = JobDepartment::get();
    	if ($request->ajax()) {
			return view('pages.career-ajax', compact(['jobs']));
		}

		Cookie::queue('cookie', 'fruad alert', 2628000);
    	return view('pages.career')->with(compact(['page','jobs','departments','cities','location_id','department_id','last_page']));
    	
    }
}
