@extends('layouts.welcome')
@section('content')
<main class="wrapper">
        <div class="page_container">
            <div class="not_found_container">
                <img src="{{asset('images/404_new.png')}}"  alt="404 Page" class="page_img" width="841" height="624">
                <div class="page_text">
                    <div class="page_title">Sorry, page not found</div>
                    <p>
                        Mistakes happen, but so do new discoveries. While <br>
                        you're here, why not explore some of our other pages and <br>
                        undiscover something unexpected?
                    </p>
                    <a class="cta cta_404" href="{{url('/')}}"><span>Back to Homepage</span></a>
                    
                </div>
            </div>
            
        </div>
    </main>
@stop