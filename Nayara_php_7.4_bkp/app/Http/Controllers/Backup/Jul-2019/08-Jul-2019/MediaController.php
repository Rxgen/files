<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\PressRelease;

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
		}
    }
}
