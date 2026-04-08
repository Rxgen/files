<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'admin', 'middleware' => ['active_user']], function () {

    Voyager::routes();

});

/*Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});*/

Route::get('/test-email', function () {
    try {
        // Send a test email
        Mail::raw('This is a test email from Laravel.', function ($message) {
            $message->to('omkar.chudekar@webmaffia.com')  // Ensure valid recipient email
                    ->subject('Test Email')
                    ->from('investors@nayaraenergy.com');  // Set sender email address
        });

        return 'Test email sent successfully!';
    } catch (\Swift_TransportException $e) {
        // Handle transport issues
        Log::error('SMTP Transport Error: ' . $e->getMessage());
        return 'Error: SMTP Transport Error. Please check the server configuration.';
    } catch (\Exception $e) {
        // Handle general errors
        Log::error('Error: ' . $e->getMessage());
        return 'Error: ' . $e->getMessage();
    }
});

Route::group(['prefix' => 'admin'],function () {
Route::get('clear-all-cache/{param?}', 'StaticPageController@clearAllCache')->name('all_cache.clear');    
});

// New campiagn routes start
Route::get('/essar/retail/apply-online/RSA', 'StaticPageController@campaignPage')->name('campaignPage');

Route::post('/export-campaign-leads', 'StaticPageController@exportCampaignLeads')->name('export.campaign-leads');
Route::post('/campaign-form-submit', 'StaticPageController@campaignFormSubmit')->name('camp_form_url');
Route::get('/essar/retail/apply-online/RSA/thankyou', function() {

	if (\Request::session()->exists('thankyou-redirect')) {

		\Request::session()->forget('thankyou-redirect');

		$randomString = \Str::random(16);

		return view('pages.campaign-thanku')->with(compact(['randomString']));
	}
	else{

		return redirect()->route('campaignPage');
	}

})->name('camp.thankyou');
// New campiagn route ends

Route::get('/api-key', function () {
    return response()->json(['key' => env('GOOGLE_MAPS_API_KEY')]);
});

Route::get('/', 'NewHomeController@index')->name('home.homepage');
Route::get('/retail/petrol-pump-dealership-apply/thankyou', 'StaticPageController@retailThankYou')->name('retail.thankyou');
//Route::get('/', 'HomeController@index')->name('home.homepage');
Route::post('/current-fuel-price', 'HomeController@currentFuelPrice')->name('current_fuel_price');
Route::post('/append-state', 'StaticPageController@populateStates')->name('populate_states');
Route::post('/append-district', 'StaticPageController@populateDistrict')->name('populate_district');
Route::get('/lat-lng', 'StaticPageController@latlng');
Route::post('/apply-online-form-submit', 'StaticPageController@applyOnlineFormSubmit')->name('form_url');
Route::get('/search-results', 'StaticPageController@searchResults')->name('search_result'); //Added On 25-Nov-2019 For Search Functionality
Route::get('/search', 'StaticPageController@autosearch')->name('auto_search');
Route::get('/testprocedure', 'StaticPageController@testprocedure');

Route::post('/newsletter-subscription', 'HomeController@newsletterSubscription')->name('newsletter_subscription');

// Career Page Routes
//Route::get('/career-opening', 'CareerController@career')->name('career');
Route::redirect('/career-opening', 'https://fa-escq-saasfaprod1.fa.ocs.oraclecloud.com/hcmUI/CandidateExperience/en/sites/CX_1001#');

//Perspective Page Routes
Route::get('/perspective', 'PerspectiveController@perspective')->name('perspective');
Route::get('/perspective/{slug}', 'PerspectiveController@perspectiveDetail')->name('perspective_detail');

//Marketing Contact Page Route
Route::get('/contact-us-divisional-office', 'MarketingController@divisionalOffice')->name('divisional_office');
Route::post('/divisional-office-data', 'MarketingController@ajaxDivisional')->name('ajax_divisional_office');
Route::get('/contact-us-office-locations', 'MarketingController@officeLocation')->name('office_location');

// Static Page Routes
Route::get('/coming-soon', function() {
	return View::make('pages.coming-soon');
});

Route::get('/trading', function() {
	return View::make('pages.coming-soon');
});

Route::get('/get-year-for-report', 'BioMedicalWasteReportController@getYearForReport')->name('bio_medical_waste_report.get_year');
Route::get('/get-month-for-report', 'BioMedicalWasteReportController@getMonthForReport')->name('bio_medical_waste_report.get_month');
Route::get('/get-site-for-report', 'BioMedicalWasteReportController@getSiteForReport')->name('bio_medical_waste_report.get_site');
Route::get('/get-detail-for-report', 'BioMedicalWasteReportController@getDetailForReport')->name('bio_medical_waste_report.get_detail');


Route::post('/get-ro', 'StaticPageController@getRo')->name('get.ro');
Route::post('/ro-pumps', 'StaticPageController@roPumps')->name('ro.pumps');
Route::post('/get-code-ro', 'StaticPageController@getCodeRo')->name('get.code-ro');
Route::post('/get-code-ro-radius', 'StaticPageController@getRoRadius')->name('get.ro.radius');
Route::get('/{slug}', 'StaticPageController@staticPageContent')->name('static.contact');
Route::get('/blog/{slug}', 'BlogController@blogDetails')->name('blog.detail');
Route::POST('/like','BlogController@ajaxlike')->name('ajax');
Route::get('/retail/{slug}', 'StaticPageController@staticPageRetailContent')->name('static.retail');
Route::get('/board/{slug}', 'StaticPageController@boardTeamContent')->name('board.content');
Route::post('/export-leads/{id?}', 'StaticPageController@exportLeads')->name('export.leads');
Route::get('/events/{slug}', 'StaticPageController@EventContent')->name('event.contact');

Route::post('/enquiryleads', 'StaticPageController@EnquiryLeads')->name('enquiry.leads');

//Investor Page Routes
Route::get('/investors/{slug}', 'InvestorController@investorContent')->name('investors.content')->middleware('auth.shareholder');
Route::post('/is-shareholder', 'InvestorController@isShareholder')->name('investors.shareholder');
Route::post('/report-by-year', 'InvestorController@ajaxReport')->name('ajax.report');
Route::post('/result-by-year', 'InvestorController@ajaxQuarterlyResult')->name('ajax.quarterlyresult');
Route::post('/subsidiaryReport-by-year', 'InvestorController@ajaxSubsidiary')->name('ajax.subsidiary');

//Investor Login Functionality check 
Route::post('/otpsend', 'InvestorController@Login')->name('investors.otp');
Route::post('/checkuser', 'InvestorController@checkLogin')->name('investors.usercheck');
Route::post('/iepfuser', 'InvestorController@otpverify')->name('investors.userverify');
Route::post('/logout', 'InvestorController@logout')->name('investors.logout');

//Sustainability Page Routes
Route::get('/sustainability/{slug}', 'SustainabilityController@sustainabilityContent')->name('sustainability.content');
Route::get('/sustainable-development/{slug}', 'SustainabilityController@sustainablePageContent')->name('sustainable.content');




//Media Page Route
Route::get('/media/{slug}', 'MediaController@mediaContent')->name('media.content');
Route::post('/news-by-year', 'MediaController@ajaxNews')->name('news.ajax');
//Route::get('/contact', 'StaticPageController@contact')->name('static.contact');
//Route::get('/ethos', 'StaticPageController@ethos')->name('static.ethos');

Route::get('/perspective', function() {
return View::make('pages.stay-tuned');
});

Route::post('/apply-online-for-dealership-form-submit', 'StaticPageController@applyOnlineDealershipFormSubmit')->name('dealership.form_url');

Route::get('/retail/apply-online-for-dealership/thankyou', 'StaticPageController@distributorThankYou')->name('dealership.thankyou');

//Route::get('/{primarySlug}/{secondarySlug}', 'PetroChemicalsStaticPageController@index');
Route::get('/{primarySlug}/{secondarySlug}', 'PetroChemicalsStaticPageController@index')->name('static.petrochemicals');
Route::post('/business-enquiry', 'PetroChemicalsStaticPageController@EnquiryFormSubmit')->name('form_submit');
Route::fallback(function () {
	return response()->view('exceptions.error_404');
});



