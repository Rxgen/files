<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\AnnualReport;
use App\InvestorNotice;
use App\InvestorContact;
use App\QuarterlyFinancialResult;
use App\CorporateAnnouncement;
use App\InvestorInformation;
use SMS;
use App\IepfDetail;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvestorDetails;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;


class InvestorController extends Controller
{
    public function investorContent(Request $request) {
        $page = Page::where('slug', $request->slug)->where('status', 1)->get();
        if(count($page) == 0) {
			return response()->view('exceptions.error_404');
        }
    	switch ($request->slug) {
    		case 'presentation':
				return view('pages.contact')->with(compact(['page']));
    			break;
			case 'financial-performance':
    			//$reports = AnnualReport::where('status',1)->get(); As Dicussed With Simran And Sam Commented On 23-Aug-2019 
				$reports = AnnualReport::where('status',1)->orderBy('year', 'DESC')->get(); //As Dicussed With Simran And Sam Added On 23-Aug-2019 
                //dd($reports);
    			$report_years = AnnualReport::where('status',1)->selectRaw("MAX(year) AS max_year, MIN(year) AS min_year")->get();
    			//dd($report_years);

                $quarterly_results = QuarterlyFinancialResult::where('status',1)->orderBy('created_at', 'DESC')->get();

                $quarterly_results_years = QuarterlyFinancialResult::where('status',1)->selectRaw("MAX(year) AS max_year, MIN(year) AS min_year")->get();

				return view('pages.annual-reports')->with(compact(['page','reports','report_years' , 'quarterly_results' , 'quarterly_results_years']));
    			break;
			case 'notices':
    			$notice = InvestorNotice::where('status', 1)->get();
                $notices['Nayara Energy Limited'][0]['Current Notices/ Announcements'] = array();
                //$notices['Nayara Energy Limited'][1]['Historical Notices / Announcements'] = array();
                //$notices['Nayara Energy Limited'][2]['Merger of Vadinar Power Company Limited and Nayara Energy Properties Limited with Nayara Energy Limited'] = array();
                /*$notices['Vadinar Oil Terminal Limited'][0]['Current Notices/ Announcements'] = array();
                $notices['Vadinar Oil Terminal Limited'][1]['Historical Notices / Announcements'] = array();*/
                //$notices['Vadinar Oil Terminal Limited'][2]['Merger of Vadinar Power Company Limited and Nayara Energy Properties Limited with Nayara Energy Limited'] = array();
    			foreach ($notice as $key => $value) {
    				if($value->category == 'nayara') {
                        /*if($value->sub_category == 'merger') {
                            $notices['Nayara Energy Limited'][2]['Merger of Vadinar Power Company Limited and Nayara Energy Properties Limited with Nayara Energy Limited'][$key] = $value;
                        }*/
                        if ($value->sub_category == 'current') {
                            $notices['Nayara Energy Limited'][0]['Current Notices/ Announcements'][$key] = $value;
                        }
                        //elseif ($value->sub_category == 'historical') {
                           // $notices['Nayara Energy Limited'][1]['Historical Notices / Announcements'][$key] = $value; 
                        //}
                    }
                    /*elseif ($value->category == 'vadinar') {
                        /*if($value->sub_category == 'merger') {
                            $notices['Vadinar Oil Terminal Limited'][2]['Merger of Vadinar Power Company Limited and Nayara Energy Properties Limited with Nayara Energy Limited'][$key] = $value;
                        }
                        if ($value->sub_category == 'current') {
                            $notices['Vadinar Oil Terminal Limited'][0]['Current Notices/ Announcements'][$key] = $value;
                        }
                        elseif ($value->sub_category == 'historical') {
                            $notices['Vadinar Oil Terminal Limited'][1]['Historical Notices / Announcements'][$key] = $value; 
                        }
                    }*/
    			}
                ksort($notices['Nayara Energy Limited']);
                //ksort($notices['Vadinar Oil Terminal Limited']);
    			return view('pages.investor-notices')->with(compact(['page','notices']));
    			break;
    		case 'information':
    			$contacts = InvestorInformation::active()->orderBy('weight', 'ASC')->get();
    			
                // return view('pages.investor-contact')->with(compact(['page']));
                return view('pages.investor-contact-new')->with(compact(['page' , 'contacts']));
    			break;
			case 'corporate-governance':
				return view('pages.contact')->with(compact(['page']));
                break;
            case 'corporate-announcements':
                $reports = CorporateAnnouncement::where('status',1)->latest('date')->get();
                return view('pages.corporate-announcements')->with(compact(['page','reports']));
                break;
				case 'employees-pension-scheme':
                    $notice = InvestorNotice::where('status', 1)->orderBy('order_id', 'ASC')->get();
                    //$notices['Employee Pension Scheme'] = array();
                    foreach ($notice as $key => $value) {
                        if($value->category == 'nayara') {
                            if ($value->sub_category == 'employee-pension-scheme') {
                                $notices['Employee Pension Scheme'][$key] = $value;
                            }
                         }
                      }

                    //ksort($notices['Nayara Energy Limited']);
                    return view('pages.employees-pension')->with(compact(['page','notices']));
                    break;
                    
                    case 'iepf':
                    
                        $folio_number = $request->session()->get('folio_number');
                        $folio_number_time = $request->session()->get('folio_number_time');
                        
                        $dmatnumber = $request->session()->get('demat_number');
                        $dmatnumber_time = $request->session()->get('demat_number_time');
    
                        if ($folio_number_time instanceof \Carbon\Carbon) {
                            $folio_number_time = $folio_number_time->timestamp; 
                        }
                        if ($dmatnumber_time instanceof \Carbon\Carbon) {
                            $dmatnumber_time = $dmatnumber_time->timestamp;
                        }
    
                        $latest = null;
    
                        if ($folio_number_time && $dmatnumber_time) {
                            if ($folio_number_time > $dmatnumber_time) {
                                $latest = 'folio_number';
                            } else {
                                $latest = 'demat_number';
                            }
                        } elseif ($folio_number_time) {
                            $latest = 'folio_number';
                        } elseif ($dmatnumber_time) {
                            $latest = 'demat_number';
                        }
    
                        $query = IepfDetail::query(); 
                        if ($latest === 'folio_number' && $folio_number) {
                            $query->where('folio_no', $folio_number);
                            $Iepfusers = $query->get();
                        } elseif ($latest === 'demat_number' && $dmatnumber) {
                            $query->where('dp_id', $dmatnumber);
                            $Iepfusers = $query->get();
                        }
    
                        
                        $investorDetails = $query
                            ->select('investor_firstname', 'investor_middlename', 'investor_lastname', 'address')
                            ->distinct()
                            ->first();
    
                        return view('pages.iepfuserdetails')->with(compact(['page','Iepfusers','investorDetails']));
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

    public function ajaxQuarterlyResult(Request $request) {
        if($request->year == 0){
            $quarterly_results = QuarterlyFinancialResult::where('status',1)->get();
        }
        else{
		    $quarterly_results = QuarterlyFinancialResult::where('year', $request->year)->where('status',1)->orderBy('created_at', 'DESC')->get();
        }
		return view('pages.ajax-quarterly-result')->with(compact(['quarterly_results']));
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

    public function isShareholder(Request $request) {

        session()->put('isShareholder', true);

        return response()->json(['status' => 'success']);
    }

    public function checkLogin(Request $request)
    {

        if(isset($request->folionumber) && $request->foilonumber !=='')
        try {
            
            $users = IepfDetail::where('folio_no', '=', $request->folionumber)->first();
            $request->session()->put('folio_number', $request->folionumber);
            $request->session()->put('folio_number_time', now());
            if ($users) {
                log::info("User Folio Number success");
                $resp['success'] = true;
                $resp['message'] = 'Success';
                $statusCode = 200;
            }else {
                throw ValidationException::withMessages([
                    'folionumbererror' => ['No records are available for the Folio Number / Demat Account Number entered by you. 
                            For further information, please contact our Registrar and Transfer Agents – Link Intime India Private Limited at 
                            <a href="mailto:rnt.helpdesk@linkintime.co.in" class="showMail">rnt.helpdesk@linkintime.co.in</a> with a copy to us at 
                            <a href="mailto:investors@nayaraenergy.com" class="showMail">investors@nayaraenergy.com</a> 
                            with details of your holding.'],
                ]);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        } else  {

            try {
                $users = IepfDetail::where('dp_id', '=', $request->demat_number)->first();
                $request->session()->put('demat_number', $request->demat_number);
                $request->session()->put('demat_number_time', now());
                if ($users) {
                    log::info("User Demat Number success");
                    $resp['success'] = true;
                    $resp['message'] = 'Success';
                    $statusCode = 200;
                }else {
                    throw ValidationException::withMessages([
                        'folionumbererror' => ['No records are available for the Folio Number / Demat Account Number entered by you. 
                                For further information, please contact our Registrar and Transfer Agents – Link Intime India Private Limited at 
                                <a href="mailto:rnt.helpdesk@linkintime.co.in" class="showMail">rnt.helpdesk@linkintime.co.in</a> with a copy to us at 
                                <a href="mailto:investors@nayaraenergy.com" class="showMail">investors@nayaraenergy.com</a> 
                                with details of your holding.'],
                    ]);
                }
            } catch (ValidationException $e) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors(),
                ], 422);

            }        

        }
        return response()->json($resp, $statusCode);   
    }
    
    public function Login(Request $request)
	{
        $otp = rand(100000, 999999);
        Cache::put('otp_key', $otp, now()->addMinutes(3));

		if (isset($request->mobile) && $request->mobile !== '') {
            $resp = $statusCode = null;
            $mobile = $request->mobile;	
            $msg = config('iepfsms.otp_sms_template');
            $msg = str_replace('{#OTP#}', $otp, $msg);
            $templateId = config('iepfsms.otp_sms_dlt_temp_id');
            $otpSent = SMS::IepfSms($mobile, $msg, $templateId);
            Log::debug("OTP", ['otp' => $otp]);
        
            if ($otpSent) {
                $resp['success'] = 'mobile';
                $resp['mobile'] = $request->mobile;
                $resp['message'] = 'A one-time password (OTP) verification code has been sent to your number';
                $statusCode = 200;
            } else {
                throw new \Exception('Something went wrong.', 500);
            }
        } elseif (isset($request->pan_number) && $request->pan_number !== '') {
            try {
                $folio_number = $request->session()->get('folio_number');
                $demat_number = $request->session()->get('demat_number');
                
                $users = IepfDetail::where('pan_number', '=', $request->pan_number)
                ->where(function ($query) use ($folio_number, $demat_number) {
                $query->where('folio_no', '=', $folio_number)
               ->orWhere('dp_id', '=', $demat_number);
               })->first();

            if ($users) {
                return response()->json([
                    'success' => 'pan_number',
                    'redirect_url' => route('investors.content', ['slug' => 'iepf'])
                ], 200);
            }else {
                throw ValidationException::withMessages([
                    'pan_number_error' => ['The credentials entered by you are not registered with the Company. However, the Folio Number / Demat Account Number provided by you matches with the records and you may have unclaimed entitlement with the Company which would be transferred to IEPF as per the applicable timelines. 
                    For receiving your unclaimed entitlement, please contact our Registrar and Transfer Agents – Link Intime India Private Limited at <a href="mailto:rnt.helpdesk@linkintime.co.in" class="showMail">rnt.helpdesk@linkintime.co.in</a> with a copy to us at 
                     <a href="mailto:investors@nayaraenergy.com" class="showMail">investors@nayaraenergy.com</a> 
                    with details of your holding.'],
                ]);
            }
    
            }catch (ValidationException $e) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors(),
                ], 422);
            }
            
        } elseif (isset($request->email) && $request->email !== '') {
            $folio_number = $request->session()->get('folio_number');
            $demat_number = $request->session()->get('demat_number');
            $email = $request->email;
            $user = IepfDetail::where('email_id', '=', $email)
                ->where(function ($query) use ($folio_number, $demat_number) {
                    $query->where('folio_no', '=', $folio_number)
                          ->orWhere('dp_id', '=', $demat_number);
                })
                ->first();
                Log::debug("OTP sent before Mail", ['otp' => $otp, 'email' => $email]);

             if ($user) {
        Mail::send('emails.investor-details', ['otp' => $otp], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('OTP Verification Code');
        });
        Log::debug("OTP sent to email", ['otp' => $otp, 'email' => $email]);
        $resp['success'] = 'email';
        $resp['email'] = $email;
        $resp['message'] = 'A one-time password (OTP) verification code has been sent to your email address.';
        $statusCode = 200;
    } else {
        throw ValidationException::withMessages([
            'email_error' => [
                'The email address you entered does not match the Folio Number or Demat Account Number registered with the Company. Please verify the details and try again.',
            ],
        ]);
    }
} else {
    $resp['success'] = false;
    $resp['message'] = 'No valid email address provided.';
    $statusCode = 400;
}

return response()->json($resp, $statusCode);
	}
    
    public function otpverify(Request $request)
    {
        try {
            $otp = $request->digit1 . $request->digit2 . $request->digit3 . $request->digit4.$request->digit5.$request->digit6;
            Log::info("OTP From User ",['OTP' => $otp]); 
            $storedOtp = Cache::get('otp_key');
             Log::debug("OTP",['otp' => $storedOtp]); 
                if ($storedOtp && $storedOtp==$otp) {
                    return response()->json([
                        'success' => true,
                        'redirect_url' => route('investors.content', ['slug' => 'iepf'])
                    ], 200);
                }else {
                    throw ValidationException::withMessages([
                        'InvalidOtp' => ['Enter a valid OTP'],
                    ]);
                }

        }catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        }    
    }
    
    public function checkSession(Request $request)
    {
        if ($request->session()->has('folio_number')) {
            return response()->json(['session' => true]);
        } else {
            return response()->json(['redirect_url' => route('investors.content', ['slug' => 'information'])]);
        }
    }

    public function logout(Request $request) {
        $request->session()->flush();
        return redirect()->route('investors.content', ['slug' => 'information']);
    }    
}
