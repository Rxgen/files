<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\HomePageTopBanner;
use Illuminate\Support\Facades\Cache;

class NewHomeController extends Controller
{
    public function index() { 
        
        $top_banners = Cache::remember(
            'banners:exists',
            config('nayara.cache_remember'),
            function () {
                return HomePageTopBanner::where('status', 1)->orderBy('order', 'ASC')->get();
            }
        );

        $products = Cache::remember(
            'product:exists',
            config('nayara.cache_remember'),
            function () {
                return Product::where('business','Marketing')->where('status',1)->orderBy('order_id', 'ASC')->get();
            }
        );
        return view('pages.nayara_home_page')->with(compact(['top_banners','products']));
    }   
}
