@extends('layouts.static')
@section('content')
<section class="home-refinery" data-section="first-fold">
    <div class="heroSlider">
          @foreach($top_banners as $top_banner)
          <div class="heroSlider-item">
          @if($top_banner->cta != 'scheme')
              <div class="generic-slider-content">
                    <div class="generic-slider-heading">{!! $top_banner->title !!}<span
                            class="theme-gradient-alpha gradient-text generic-slider-text">{!! $top_banner->sub_title !!}</span></div>
                            {!! $top_banner->description !!}
                    <a href="{{$top_banner->cta_url}}" class="cta gradient-cta theme-gradient {{ empty($top_banner->title) ? 'save_cta' : '' }}
">
                        <span class="gradient-cta-overlay gradient-text theme-gradient">{!! $top_banner->cta !!}</span>
                    </a>
            </div>
            @endif
                <div class="generic-img-slider img-height">
                    <figure class="generic-img-slide">
                    <img  src="{{ Voyager::image($top_banner->desktop_image)}}" class="generic-img desktop" alt="{{$top_banner->image_alt}}" title="{{$top_banner->image_alt}}" width="1920" height="632" />
                <img  src="{{ Voyager::image($top_banner->mobile_image) }}" class="generic-img mobile" alt="{{$top_banner->image_alt}}" title="{{$top_banner->image_alt}}" width="361" height="531"  />
                    </figure>
                </div>
        </div>
          @endforeach
          </div>  
</section>

<section class="home-our-business" data-section="how-we-fuel">
     <div class="home-our-business__title grediant-added"><h1>How We Fuel India</h1></div>
            @if(count($products) > 0)
             @foreach($products as $product)
            <a href="{{ $product->cta_url }}" class="home-business activeTextContainer">
                <img loading="lazy" src="{{Voyager::image($product->image)}}" class="home-business__img" alt="{{$product->img_title}}" title="{{$product->img_title}}" width="644" height="716"/>
                <figcaption class="home-business__caption generic-transition">
                    <div class="home-business__caption_container">
                        <h2 class="home-business__caption_heading">{!! $product->product_name !!}
                        </h2>
                    </div>
                    <div class="home-business__caption_container activeText ">
                    <div  class="cta gradient-cta theme-gradient normal-cta">
                        <span class="gradient-cta-overlay gradient-text theme-gradient">{{$product->cta_name}}</span>
                       </div>
                    </div>
                </figcaption>
            </a>
            @endforeach
        @endif
        </section>
    <section class="home-refinery" data-section="energy">
            <div class="generic-slider-content">
                <h2 class="generic-slider-heading">Energy To Realise<span
                        class="theme-gradient-alpha gradient-text generic-slider-text">Your Dreams</span></h2>
                <p class="generic-slider-text-caption">Coined from “Naya” (new) and “Era”-Nayara Energy, the name truly
                    stands for the vision of bringing in a new era in the energy sector riding on a wave of excellence.
                    Delivering value for all our stakeholders is at the very core of our beliefs and we are committed to providing the energy that fuels the dreams of our customers, partners and communities”</p>
                <a href="{{ url('/about-us')}}" class="cta gradient-cta theme-gradient">
                    <span class="gradient-cta-overlay gradient-text theme-gradient">KNOW MORE</span>
                </a>
            </div>
            <div class="video-container">
                <video id="nayaraVideo" onclick="control()" poster="{{asset('images/v2/Homepage-banner-new.webp')}}">
                    <source src="{{asset('videos/home/Nayara_2023.mp4')}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </section>
    
        <div class="homegrid">
            <a href="{{url('/career-opening')}}" class="grid-item potential">
               <div class="v2-container">
                    <img loading="lazy" src="{{asset('images/v2/p-icon.webp')}}" class="profile-icon" alt="Profile icon" title="P-icon" width="124" height="124" srcset="">
                    <h2 class="subheading-v2">
                    Explore Opportunities<br>
                     At Nayara Energy.
                    </h2>
                    <div class="cta gradient-cta theme-gradient normal-cta">
                        <span class="gradient-cta-overlay gradient-text theme-gradient">APPLY NOW</span>
                    </div>
                </div>
            </a>
            <a href="{{ url('/petrol-pump-near-me')}}" class="grid-item gredient-new section-2">
                <div class="v2-container">
                    <h2 class="mainHeading-v2">
                        Nayara<br>
                        Fuel Station<br>
                        Locator
                    </h2>
                    <p>Find the nearest petrol pump<br> and plan your route</p>
                    <div class="cta gradient-cta theme-gradient normal-cta">
                        <span class="gradient-cta-overlay gradient-text theme-gradient">KNOW MORE</span>
                    </div>
                </div>

                <img loading="lazy" src="{{asset('images/v2/map-icon.webp')}}" class="map-icon" alt="Map-icon" width="273" height="301" srcset="">
             </a>
            <a href="{{ url('/blog')}}" class="grid-item gredient-new section-3">
                <div class="v2-container">
                    <h2 class="mainHeading-v2">
                    Voice of Nayara
                    </h2>
                    <div class="subheading-v2">
                    Find more engaging reads in our blog section
                    </div>
                    <!-- <p>Lorem ipsum dolor sit amet, adipiscing<br>
                        elit, sed do eiusmod tempor incididunt ut<br> labore et dolore magna aliqua.</p> -->
                    <div   class="cta gradient-cta theme-gradient normal-cta">
                        <span class="gradient-cta-overlay gradient-text theme-gradient">READ MORE</span>
                     </div>
                </div>
            </a>
            <a href="{{ url('/sustainable-development')}}" class="grid-item sustainability section-4">
                <div class="v2-container">
                    <h2 class="mainHeading-v2">
                        Sustainability
                    </h2>

                    <p>A strong sense of social responsibility is an <br>integral part of our value system. Our commitment <br>extends beyond just fuelling India’s energy requirements’</p>
                    <div class="cta gradient-cta theme-gradient normal-cta">
                        <span class="gradient-cta-overlay gradient-text theme-gradient">KNOW MORE</span>
                    </div>
                </div>
                </a>
            </div>

@stop