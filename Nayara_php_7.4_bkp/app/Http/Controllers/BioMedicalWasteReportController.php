<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BioMedicalWasteReport;

class BioMedicalWasteReportController extends Controller
{
    //Getting year values
    public function getYearForReport(Request $request)
    {
        $years =  BioMedicalWasteReport::where('status', '=', 1)
        ->where('report_type','=',$request->type)
        ->orderBY('year','asc')
        ->distinct()
        ->get(['year']);

        return response()->json([
            'years_html' => view('bio-medical-waste-reports.year', compact('years'))->render()
        ], 200);
    }

    //getting month values
    public function getMonthForReport(Request $request){
        $months = BioMedicalWasteReport::where('status','=','1')
        ->where('report_type','=',$request->type)
        ->where('year','=',$request->year)
        ->distinct()
        ->get(['month']);

        return response()->json([
            'months_html' => view('bio-medical-waste-reports.month',compact('months'))->render()
        ], 200);
        


    }
    
    //getting site names
    public function getSiteForReport(Request $request){
        
        if($request->type === 'monthly'){
        $sites = BioMedicalWasteReport::where('status','=','1')
        ->where('report_type','=',$request->type)
        ->where('month','=',$request->month)
		->where('year','=',$request->year)
        ->orderBy('site_name','asc')
        ->distinct()
        ->get();

        return response()->json([
            'sites_html' => view('bio-medical-waste-reports.site-name',compact('sites'))->render()
        ], 200);
    }
    else{
        $sites = BioMedicalWasteReport::where('status','=','1')
        ->where('report_type','=',$request->type)
        ->where('year','=',$request->year)
        ->orderBy('site_name','asc')
        ->distinct()
        ->get();

        return response()->json([
            'sites_html' => view('bio-medical-waste-reports.site-name',compact('sites'))->render()
        ], 200);
        
    }

    }
    
    //getting site details
    public function getDetailForReport(Request $request){
        if($request->type === 'monthly'){
        $site_details = BioMedicalWasteReport::where('status','=','1')
        ->where('report_type','=',$request->type)
        ->where('month','=',$request->month)
		->where('year','=',$request->year)
        ->where('site_name','=',$request->site)
        ->get();
        
        return response()->json([
            'site_details_html' => view('bio-medical-waste-reports.site-detail',compact('site_details'))->render()
        ], 200);
    }
    else{
        $site_details = BioMedicalWasteReport::where('status','=','1')
        ->where('report_type','=',$request->type)
        ->where('site_name','=',$request->site)
        ->get();
        
        return response()->json([
            'site_details_html_pdf' => view('bio-medical-waste-reports.site-detail-pdf',compact('site_details'))->render()
        ], 200);

}
}
    
}
