<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\PressRelease;
use App\MediaCoverageCurrent;
use App\MediaCoverageHistorical;
use App\MediaKit;
use App\MediaResource;
use App\NewsRoom;
use App\GalleryType;
use App\MediaGallery;
use App\ManagementTeam;

class MediaController extends Controller
{
    public function mediaContent(Request $request) {
    	$page = Page::where('slug', $request->slug)->where('status', 1)->get();
    	if(count($page) == 0) {
			return response()->view('exceptions.error_404');
        }
    	switch ($request->slug) {
			case 'press-release':
				$releases = NewsRoom::where('news_room_section', 'press_release')->where('status', 1)->orderBy('created_at','desc')->get();
                //dd($releases);
                return view('pages.press-release')->with(compact(['page','releases']));
                break;
			case 'in-the-news':
                //$current_year = date('Y');
                //$dates = NewsRoom::select('date')->where('news_room_section', 'in_the_news')->orderBy('date', 'DESC')->where('status', 1)->distinct()->get();
                //$current_year = $dates[0]->date;
                //dd($dates);
                //$in_the_news = NewsRoom::where('news_room_section', 'in_the_news')->where('status', 1)->where('date', $current_year)->get();
				$in_the_news = NewsRoom::where('news_room_section', 'in_the_news')->where('status', 1)->orderBy('created_at','desc')->get();
                // $historicals = array();
                // $historical = MediaCoverageHistorical::where('status', 1)->get();
                // foreach ($historical as $key => $value) {
                    // if($value->type == 'crop'){
                        // $historicals['crop'][$key] = $value;
                    // }
                    // else if($value->type == 'enrollment'){
                        // $historicals['enrollment'][$key] = $value;
                    // }
                    // else if($value->type == 'health'){
                        // $historicals['health'][$key] = $value;
                    // }
                    // else if($value->type == 'nutrition'){
                        // $historicals['nutrition'][$key] = $value;
                    // }
                    // else if($value->type == 'outlook'){
                        // $historicals['outlook'][$key] = $value;
                    // }
                    // else if($value->type == 'safety'){
                        // $historicals['safety'][$key] = $value;
                    // }
                // }
                // //dd($historicals);
                // return view('pages.in-the-news')->with(compact(['page','current_year', 'dates', 'in_the_news','historicals']));
				return view('pages.in-the-news')->with(compact(['page','in_the_news']));
                break;
            case 'media-coverage-current':
                //dd($page);
                $current = MediaCoverageCurrent::where('status', 1)->where('year',2018)->get();
                return view('pages.media-coverage-current')->with(compact(['page','current']));
                break;
            case 'media-coverage-historical':
                $historical = MediaCoverageHistorical::where('status', 1)->get();
                foreach ($historical as $key => $value) {
                    if($value->type == 'crop'){
                        $historicals['crop'][$key] = $value;
                    }
                    else if($value->type == 'enrollment'){
                        $historicals['enrollment'][$key] = $value;
                    }
                    else if($value->type == 'health'){
                        $historicals['health'][$key] = $value;
                    }
                    else if($value->type == 'nutrition'){
                        $historicals['nutrition'][$key] = $value;
                    }
                    else if($value->type == 'outlook'){
                        $historicals['outlook'][$key] = $value;
                    }
                    else if($value->type == 'safety'){
                        $historicals['safety'][$key] = $value;
                    }
                }
                return view('pages.media-coverage-historical')->with(compact(['page','historicals']));
                break;
            case 'kits-and-resources':
                $kits = MediaKit::where('status', 1)->get();
                $spokesperson = ManagementTeam::where('status', 1)->where('board', 'Senior')->orderBy('order')->first();
                //dd($spokesperson);

                //$resources = MediaResource::where('status', 1)->get();
                //dd($resources);
                return view('pages.media-kit')->with(compact(['page','kits','spokesperson']));
                break;
			case 'gallery':
                $gallery_type = GalleryType::where('status', 1)->get();
                foreach ($gallery_type as $key => $value) {
                    $gallery = MediaGallery::where('status', 1)->where('gallery_type', $value->id)->get();
                    $value->galleries = $gallery;
                }
                //dd($gallery_type);

                //dd($gallery);

                //$resources = MediaResource::where('status', 1)->get();
                //dd($resources);
                return view('pages.gallery')->with(compact(['page','gallery_type','gallery']));
                break;
		}
    }
	
	public function ajaxNews(Request $request) {
        
        $request->validate([
            'year' => 'required'
        ]);

        $year = $request->year;
        $page = $request->page;
        //dd($year, $page);
        $in_the_news = NewsRoom::where('news_room_section', $page)->where('status', 1)->where('date', $year)->get();
        //dd($in_the_news);
        return view('pages.ajax-news')->with(compact(['in_the_news']));
    }
}
