<?php

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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::get('/', 'HomeController@index')->name('home.homepage');
Route::post('/current-fuel-price', 'HomeController@currentFuelPrice')->name('current_fuel_price');
Route::post('/append-state', 'StaticPageController@populateStates')->name('populate_states');
Route::post('/append-district', 'StaticPageController@populateDistrict')->name('populate_district');
Route::get('/lat-lng', 'StaticPageController@latlng');
Route::post('/apply-online-form-submit', 'StaticPageController@applyOnlineFormSubmit')->name('form_url');

Route::get('/testprocedure', 'StaticPageController@testprocedure');

Route::post('/newsletter-subscription', 'HomeController@newsletterSubscription')->name('newsletter_subscription');

// Career Page Routes
Route::get('/career-opening', 'CareerController@career')->name('career');

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
Route::post('/get-ro', 'StaticPageController@getRo')->name('get.ro');
Route::post('/ro-pumps', 'StaticPageController@roPumps')->name('ro.pumps');
Route::post('/get-code-ro', 'StaticPageController@getCodeRo')->name('get.code-ro');
Route::get('/{slug}', 'StaticPageController@staticPageContent')->name('static.contact');
Route::get('/retail/{slug}', 'StaticPageController@staticPageRetailContent')->name('static.retail');
Route::get('/board/{slug}', 'StaticPageController@boardTeamContent')->name('board.content');
Route::post('/export-leads', 'StaticPageController@exportLeads')->name('export.leads');

//Investor Page Routes
Route::get('/investors/{slug}', 'InvestorController@investorContent')->name('investors.content');
Route::post('/report-by-year', 'InvestorController@ajaxReport')->name('ajax.report');
Route::post('/subsidiaryReport-by-year', 'InvestorController@ajaxSubsidiary')->name('ajax.subsidiary');

//Sustainability Page Routes
Route::get('/sustainability/{slug}', 'SustainabilityController@sustainabilityContent')->name('sustainability.content');
Route::get('/sustainable-development/{slug}', 'SustainabilityController@sustainablePageContent')->name('sustainable.content');

//Media Page Route
Route::get('/media/{slug}', 'MediaController@mediaContent')->name('media.content');
//Route::get('/contact', 'StaticPageController@contact')->name('static.contact');
//Route::get('/ethos', 'StaticPageController@ethos')->name('static.ethos');

Route::get('/perspective', function() {
return View::make('pages.stay-tuned');
});

