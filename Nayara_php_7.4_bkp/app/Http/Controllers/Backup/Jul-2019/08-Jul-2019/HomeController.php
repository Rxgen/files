<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Blog;
use App\News;
use App\HomeBlock;
use App\HomeImage;
use App\Product;
use App\Mail\NewsletterSubscription;
use Storage;
use File;

class HomeController extends Controller
{
    public function index(){
    	//return view('pages.home');
    	$blogs = Blog::select('blog_image','blog_title','blog_footer','description','cta_name','cta_url','img_title','img_alt')->where('status',1)->get();
    	//dd($blogs);
    	$front_news = News::select('news_image','news_title','news_date','news_source','img_title','img_alt','news_url')->where('on_front',1)->where('status',1)->get();
    	$slider_news = News::select('news_image','news_title','news_date','news_source','news_url')->where('on_front',0)->where('status',1)->get();
    	$products = Product::select('product_name','product_description','image','cta_name','cta_url','img_alt','img_title')->where('business','Marketing')->where('status',1)->get();
    	//dd($products);
    	$home_blocks = HomeBlock::select('type','title','sub_title','cta_name','cta_url')->where('status',1)->get();
    	$home_images = HomeImage::select('type','desktop_image','mobile_image','img_alt','img_title')->where('status',1)->get();
    	//dd($home_images);
    	return view('pages.home')->with(compact(['blogs','front_news','slider_news','products','home_blocks','home_images']));
    }


    public function check(){
        // dd(storage_path());
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        var_dump(json_encode(File::get($storagePath."/check.csv")));
        exit();
        $csv = array_map('str_getcsv', File::get($storagePath."/check.csv"));
        dd($csv);
    }

    public function newsletterSubscription(Request $request){

        $validation = $this->newsletter_email_validator($request->all())->validate();

        $email = $request->email;
        $date = date('Y-m-d H:i:s');
        $newsletter_update = DB::table('newsletter_subscriptions')
        ->insert([
            'email' => $email,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
        if($newsletter_update){
            $mail = Mail::to($email)->send(new NewsletterSubscription());
            if( count(Mail::failures()) > 0 ){
                echo 1;
            }else{
                echo 0;
            }
        }

    }

    protected function newsletter_email_validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255', 
        ]);
    }
}
