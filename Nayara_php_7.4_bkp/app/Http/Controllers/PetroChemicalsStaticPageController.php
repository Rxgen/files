<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\PetrochemicalsPage;
use App\PetrochemicalsProduct;
use App\PetrochemicalsProductType;
use App\PetrochemicalsBusinessEnquiry;


class PetroChemicalsStaticPageController extends Controller
{
	public function index(Request $request, $primarySlug, $secondarySlug)
	{
		
		$page = PetrochemicalsPage::where('primary_slug', '=', $primarySlug)
			->where('secondary_slug', '=', $secondarySlug)
			->where('status', '=', 1)
			->first();
        if(is_null($page)){
			return response()->view('exceptions.error_404');
		}
			

		$additionalHtml = $this->loadAdditionalHtml($page);


		$breadcrumbs = $this->breadcrumbs($primarySlug, $secondarySlug);
		return view('petrochemicals.pages.index', compact('page','breadcrumbs','additionalHtml'));
	}

	 private function loadAdditionalHtml($page)
	{
		switch ($page->id) {
			case 67: // Contact Us page
				return view('petrochemicals.pages.contact-us')->render();
				break;

				case 68: // Petrochemicals products page
					$petrochemicalsProducts = PetrochemicalsProduct::where('status', '=', 1)
					->with(['product_types'=> function ($query) {
                         $query->where('status', '=', 1)->orderBy('sort_id', 'ASC');
					}])
					->get();
					return view('petrochemicals.pages.newproductpage',compact('petrochemicalsProducts'))->render();
					break;

			    case 69: // Thank You  page
						return view('petrochemicals.pages.thankyou')->render();
						break;
			
			default:
				break;
		}
	} 



	private function breadcrumbs($primarySlug, $secondarySlug)
	{
		$primaryTitle = (str_replace( array( '\'', '-', ',' , ';', '<', '>' ), ' ', $primarySlug));
		$secondaryTitle =str_replace( array( '\'', '-', ',' , ';', '<', '>' ), ' ',$secondarySlug);
		$breadcrumb = [
			['url' => '','title' => $primaryTitle,'active'=>false],
			['url' => '','title' => $secondaryTitle,'active'=>true ]
		];
         return $breadcrumb;
      }

	  public function EnquiryFormSubmit(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'orgname' => 'required|string|max:255',
			'mobile' => 'required|min:10|numeric',
			'email' => 'required|string',
			'state' => 'required|string',
			'district' => 'required|string',
			'query' => 'required|string|max:255',
		]);

		$business = new PetrochemicalsBusinessEnquiry;
		$business->name = $request->name;
		$business->org_name = $request->orgname;
		$business->mobile = $request->mobile;
		$business->email = $request->email;
		$business->state = $request->state;
		$business->district = $request->district;
		$business->query = $request->input('query');
		$business->save();

		if ($business->id) {
			return response()->json(['status' => 1]);
		}
		return response()->json(['status' => 0]);
	}

}


