<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\PressRelease;
use App\MediaCoverageCurrent;
use App\MediaCoverageHistorical;
use App\MediaKit;
use App\MediaResource;

class MediaController extends Controller
{
    public function mediaContent(Request $request) {
    	$page = Page::where('slug', $request->slug)->where('status', 1)->get();
    	if(count($page) == 0) {
            return response()->view('exceptions.error', ['message'=>'Sorry, the requested page could not be found', 'error_code'=>'404'], 404);
        }
    	switch ($request->slug) {
			case 'press-release':
				$releases = PressRelease::where('status', 1)->get();
				return view('pages.press-release')->with(compact(['page','releases']));
				break;
            case 'media-coverage-current':
                //dd($page);
                $current = MediaCoverageCurrent::where('status', 1)->where('year', date('Y')-1)->get();
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
                $resources = MediaResource::where('status', 1)->get();
                //dd($resources);
                return view('pages.media-kit')->with(compact(['page','kits','resources']));
                break;
            //dd($historicals);
		}
    }
}
