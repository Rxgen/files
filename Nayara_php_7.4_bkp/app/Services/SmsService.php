<?php

namespace App\Services;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class SmsService
{
	// *********** API documentaion => https://onlysms.co.in/api/sms.aspx? **********
/*	public function send($contact_number, $message, $dlt_temp_id)
	{
		try {
			$api_url	= config('sms.api_url');
			$user_id	= config('sms.credentials.user_id');
			$password	= config('sms.credentials.password');
			$gsm_id	    = config('sms.credentials.gsm_id');
			$pe_id	    = config('sms.credentials.pe_id');
			$message	= urlencode($message); // urlencode message as per API documentation

			$curlUrl = $api_url;
			$curlUrl .= "UserID=$user_id";
			$curlUrl .= "&UserPass=$password";
			$curlUrl .= "&MobileNo=$contact_number";
			$curlUrl .= "&GSMID=$gsm_id";
			$curlUrl .= "&PEID=$pe_id";
			$curlUrl .= "&Message=$message";
			$curlUrl .= "&TEMPID=$dlt_temp_id";
			$curlUrl.="&UNICODE=TEXT";

			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, $curlUrl);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			$curlRes = curl_exec($c);
			if (curl_errno($c)) {
				$error_msg = curl_error($c);
			}
			curl_close($c);			
			if (Str::startsWith($curlRes, '100=')) {
				return true;
			}else {
				return false;
			}	
		} catch (\Exception $e) {
			report($e);
			return false;
		}
	}	*/

	public function FulcroApi($name,$contact_number, $email, $state,$district,$utmsource,$utmmedium,$utmcampaign,$utmterm,$utmcontent)
	{
		try {
			$api_url = "https://nayaraenergy-enquiry.allsocialassets.com/api/enquiry?";
			
			$curlUrl  = $api_url;
			$curlUrl .= "name=$name";
			$curlUrl .= "&mobileNo=$contact_number";
			$curlUrl .= "&emailAddress=$email";
			$curlUrl .= "&state=$state";
			$curlUrl .= "&district=$district";
			$curlUrl .= "&utm_source=$utmsource";
			$curlUrl .= "&utm_medium=$utmmedium";
			$curlUrl .= "&utm_campaign=$utmcampaign";
			$curlUrl .= "&utm_term=$utmterm";
			$curlUrl .= "&utm_content=$utmcontent";
			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, $curlUrl);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			$curlRes = curl_exec($c);
			if (curl_errno($c)) {
				$error_msg = curl_error($c);
			}
			curl_close($c);	
			return true;		
		} catch (\Exception $e) {
			report($e);
			return false;
		}
	}

	public function Enquirysms($contact_number, $message, $dlt_temp_id)
	{
		try {
			$api_url	= config('sms.api_url');
			$user_id	= config('sms.credentials.user_id');
			$password	= config('sms.credentials.password');
			$gsm_id	    = config('sms.credentials.gsm_id');
			$pe_id	    = config('sms.credentials.pe_id');
			//$message = str_replace(['+', '%'], ' ', $message);
			$message	= urlencode($message); // urlencode message as per API documentation

			$curlUrl = $api_url;
			$curlUrl .= "UserID=$user_id";
			$curlUrl .= "&UserPass=$password";
			$curlUrl .= "&MobileNo=$contact_number";
			$curlUrl .= "&GSMID=$gsm_id";
			$curlUrl .= "&PEID=$pe_id";
			$curlUrl .= "&Message=$message";
			$curlUrl .= "&TEMPID=$dlt_temp_id";
			$curlUrl.="&UNICODE=TEXT";
			Log::debug("API URL :". $curlUrl);
			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, $curlUrl);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			/* $certificate_location = "C:\Program Files\ssl\cacert.pem";
            curl_setopt($c, CURLOPT_SSL_VERIFYHOST, $certificate_location);
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, $certificate_location); */


			$curlRes = curl_exec($c);
			Log::debug("API Response: ". $curlRes);
			if (curl_errno($c)) {
				$error_msg = curl_error($c);
				Log::error("API CURL ERORROR: ". $error_msg);
			}
			curl_close($c);			
			if (Str::startsWith($curlRes, '100=')) {
				Log::debug("API Pass");
				return true;
			}else {
				Log::debug("No Pass");
				return false;
			}	
		} catch (\Exception $e) {
			report($e);
			return [
				'status' => false,
				'error' => $e->getMessage() ?: 'Something went wrong API.',
				'error_code' => $e->getCode() ?: 500
			];
		}
	}

	public function IepfSms($contact_number, $message, $dlt_temp_id)
	{
		try {
			$api_url	= config('iepfsms.api_url');
			$user_id	= config('iepfsms.credentials.user_id');
			$password	= config('iepfsms.credentials.password');
			$gsm_id	    = config('iepfsms.credentials.gsm_id');
			$pe_id	    = config('iepfsms.credentials.pe_id');
			$message	= urlencode($message); // urlencode message as per API documentation

			$curlUrl = $api_url;
			$curlUrl .= "UserID=$user_id";
			$curlUrl .= "&UserPass=$password";
			$curlUrl .= "&MobileNo=$contact_number";
			$curlUrl .= "&GSMID=$gsm_id";
			$curlUrl .= "&PEID=$pe_id";
			$curlUrl .= "&Message=$message";
			$curlUrl .= "&TEMPID=$dlt_temp_id";
			$curlUrl.="&UNICODE=TEXT";
			Log::info("IEPF SMS API URL " .$curlUrl);

			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, $curlUrl);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			$curlRes = curl_exec($c);
			if (curl_errno($c)) {
				$error_msg = curl_error($c);
			}
			curl_close($c);			
			if (Str::startsWith($curlRes, '100=')) {
				return true;
			}else {
				return false;
			}	
		} catch (\Exception $e) {
			report($e);
			return false;
		}
	}	
}
