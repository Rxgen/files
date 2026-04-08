@extends('layouts.welcome')
@section('content')
	<section class="home-banner">
            <div class="home-3d-logo-wrapper active">
                <div class="home-3d-logo-container">
                    <img data-video="home/3d.mov" src="{{asset('images/nayara-3d.png')}}" class="home-3d-logo" alt="Nayara Energy" />

                    <div class="skip-3d">Skip</div>
                </div>
            </div>
            <div class="homeLogo-animation-block">
                <img src="{{asset('images/animate-logo.png')}}" alt="animation" class="animationLogo-img">
            </div>
            @if(count($top_banners) > 0) 
            <div class="home-banner-wrapper hide-wrapper">
            @else
            <div class="home-banner-wrapper">
            @endif
                <div class="banner-counter">
                    <svg class="banner-timeline-container" viewBox="0 0 800 800">
                        <path id="banner-timeline" fill-rule="evenodd"  stroke-width="1px" stroke="rgb(255, 255, 255)" fill-opacity="0" opacity="0.55" fill="rgb(0, 0, 0)" d="M400.000,3.500 C618.981,3.500 796.500,181.019 796.500,400.000 C796.500,618.981 618.981,796.500 400.000,796.500 C181.019,796.500 3.500,618.981 3.500,400.000 C3.500,181.019 181.019,3.500 400.000,3.500 Z" />
                        <path fill-rule="evenodd"  stroke-width="1px" stroke="rgb(255, 255, 255)" fill-opacity="0" opacity="0.12" fill="rgb(0, 0, 0)" d="M400.000,3.500 C618.981,3.500 796.500,181.019 796.500,400.000 C796.500,618.981 618.981,796.500 400.000,796.500 C181.019,796.500 3.500,618.981 3.500,400.000 C3.500,181.019 181.019,3.500 400.000,3.500 Z" />
                    </svg>

                    <div class="banner-timeline-stop excel"><div class="banner-timeline-stop-circle"></div></div>
                    <div class="banner-timeline-stop energetic"><div class="banner-timeline-stop-circle"></div></div>
                    <div class="banner-timeline-stop extraordinary"><div class="banner-timeline-stop-circle"></div></div>
                    <div class="banner-timeline-stop courageous"><div class="banner-timeline-stop-circle"></div></div>
                    <div class="banner-timeline-stop ethical"><div class="banner-timeline-stop-circle"></div></div>
                    <div class="banner-timeline-stop lead"><div class="banner-timeline-stop-circle"></div></div>

                    <div class="banner-timeline-text energetic">
                        <div class="banner-timeline-text__alpha">
                            <div class="banner-timeline-text__prefix">Here to be</div>
                            <div class="banner-timeline-text__alphabet">E<span class="banner-timeline-text__word">nergetic</span></div>
                            <div class="banner-timeline-text__suffix">In the new era of energy</div>
                        </div>
                    </div>
                    <div class="banner-timeline-text extraordinary">
                        <div class="banner-timeline-text__alpha">
                            <div class="banner-timeline-text__prefix">Here for the</div>
                            <div class="banner-timeline-text__alphabet">X<span class="banner-timeline-text__word">traordinary</span></div>
                            <div class="banner-timeline-text__suffix">In the new era of energy</div>
                        </div>
                    </div>
                    <div class="banner-timeline-text courageous">
                        <div class="banner-timeline-text__alpha">
                            <div class="banner-timeline-text__prefix">Here to be</div>
                            <div class="banner-timeline-text__alphabet">C<span class="banner-timeline-text__word">ourageos</span></div>
                            <div class="banner-timeline-text__suffix">In the new era of energy</div>
                        </div>
                    </div>
                    <div class="banner-timeline-text ethical">
                        <div class="banner-timeline-text__alpha">
                            <div class="banner-timeline-text__prefix">Here to be</div>
                            <div class="banner-timeline-text__alphabet">E<span class="banner-timeline-text__word">thical</span></div>
                            <div class="banner-timeline-text__suffix">In the new era of energy</div>
                        </div>
                    </div>
                    <div class="banner-timeline-text lead">
                        <div class="banner-timeline-text__alpha">
                            <div class="banner-timeline-text__prefix">Here to</div>
                            <div class="banner-timeline-text__alphabet">L<span class="banner-timeline-text__word">ead</span></div>
                            <div class="banner-timeline-text__suffix">In the new era of energy</div>
                        </div>
                    </div>
                    <div class="banner-timeline-text excel">
                        <div class="banner-timeline-text__alpha">
                            <div class="banner-timeline-text__prefix">Here to</div>
                            <div class="banner-timeline-text__alphabet">Excel</div>
                            <div class="banner-timeline-text__suffix">In the new era of energy</div>
                        </div>
                    </div>
                </div>

                <div class="banner-video-container">
                    <div class="home-banner-video-wrapper energetic active" data-src="home/energetic.mp4"></div>
                    <div class="home-banner-video-wrapper extraordinary" data-src="home/extraordinary.mp4"></div>
                    <div class="home-banner-video-wrapper courageous" data-src="home/courageous.mp4"></div>
                    <div class="home-banner-video-wrapper ethical" data-src="home/ethical.mp4"></div>
                    <div class="home-banner-video-wrapper lead" data-src="home/lead.mp4"></div>
                    <div class="home-banner-video-wrapper excel" data-src="home/excel.mp4"></div>
                </div>
                <a href="{{url('/ethos')}}" class="banner_know_more_cta">
                    <span class="">know more</span>
                </a>
            </div>
            @if(count($top_banners) > 0)
            <div class="homeBannerSliderWrapper">
            @else
            <div class="homeBannerSliderWrapper hide-wrapper">
            @endif
                <div class="homeBannerSlider">
                    @foreach($top_banners as $top_banner)
                    @php $video = json_decode($top_banner->video); @endphp
                    @if(!empty($top_banner->youtube_link))
                    <a href="https://www.google.co.in" class="homeBannerSlides">
                        <iframe class="youtubeBannerVideo" style="height: 100%; width: 100%;" src="{{$top_banner->youtube_link}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media;" allowfullscreen></iframe>
                        <div class="banner_youtube_click"></div>
                    </a>
                    @elseif(!empty($video))
                    <a href="https://www.google.co.in" class="homeBannerSlides">
                        <video class="hmslide_bannerVideo" autoplay muted>
                            <source src="{{url(Storage::url($video[0]->download_link))}}" type="video/mp4">
                        </video>
                    </a>
                    @elseif(!empty($top_banner->desktop_image))
                    <a href="javascript:;" class="homeBannerSlides">
                        <picture>
                            <source media="(max-width: 767px)" srcset="{{Voyager::image($top_banner->mobile_image)}}" />
                            <img src="{{Voyager::image($top_banner->desktop_image)}}" alt="Locate a Pump" class="homeBanner_slide_img">
                        </picture>
                    </a>
                    @endif
                    @endforeach
                </div>
            </div>
        </section>
    <section class="home-refinery">
        @if(count($home_blocks) > 0)
        <div class="generic-slider-content">
            <h4 class="generic-slider-heading">{{$home_blocks[0]->title}} <br /><span class="theme-gradient-alpha gradient-text generic-slider-text">refinery</span></h4>
            <p class="generic-slider-text-caption">{{$home_blocks[0]->sub_title}}</p>
            <a class="cta gradient-cta theme-gradient">
                <span class="gradient-cta-overlay gradient-text theme-gradient">{{$home_blocks[0]->cta_name}}</span>
            </a>
        </div>
        @endif
        <div class="generic-img-slider">
            @if(count($home_images) > 0 )
            @foreach($home_images as $images)
            @if($images->type == "Refinery")
            <figure class="generic-img-slide">
                <img src="{{Voyager::image($images->desktop_image)}}" class="generic-img desktop" alt="{{$images->img_alt}}" title="{{$images->img_title}}" />
                <img src="{{Voyager::image($images->mobile_image)}}" class="generic-img mobile" alt="{{$images->img_alt}}" title="{{$images->img_title}}" />
            </figure>
            @endif
            @endforeach
            @endif
        </div>
    </section>

    <section class="home-our-business">
        @php $counter = 0; @endphp
        <div class="home-our-business__title">Marketing Operations</div>
        @if(count($products) > 0)
        @foreach($products as $product)
        <a href="{{$product->cta_url}}" class="home-business activeTextContainer">
            <figure >
                <img src="{{Voyager::image($product->image)}}" class="home-business__img" alt="{{$product->img_alt}}" title="{{$product->img_title}}" />
                <figcaption class="home-business__caption generic-transition generic-transition-delay-{{$counter}}">
                    <div class="home-business__caption_container">
                        <h4 class="home-business__caption_heading">{{$product->product_name}}</h4>
                        <p class="home-business__caption_text activeText">{{$product->product_description}}</p>
                    </div>
                    <div class="home-business__caption_container activeText">
                        <div  class="cta"><span>{{$product->cta_name}}</span></div>
                    </div>
                </figcaption>
            </figure>
        </a>
        @php $counter++; @endphp
        @endforeach
        @endif 
    </section>

    <section class="home-community">
        @if(count($home_blocks) > 0)
        <div class="generic-slider-content">
            <h4 class="generic-slider-heading">{{$home_blocks[1]->title}} <br /><span class="theme-gradient-alpha gradient-text generic-slider-text">Community</span></h4>
            <p class="generic-slider-text-caption">{{$home_blocks[1]->sub_title}}</p>
            <a href="{{url('/sustainable-development')}}" class="cta gradient-cta theme-gradient">
                <span class="gradient-cta-overlay gradient-text theme-gradient">{{$home_blocks[1]->cta_name}}</span>
            </a>
        </div>
        @endif
        <div class="generic-img-slider">
            @if(count($home_images) > 0)
            @foreach($home_images as $images)
            @if($images->type == "Community")
            <figure class="generic-img-slide">
                <img src="{{Voyager::image($images->desktop_image)}}" class="generic-img desktop" alt="{{$images->img_alt}}" title="{{$images->img_title}}" />
                <img src="{{Voyager::image($images->mobile_image)}}" class="generic-img mobile" alt="{{$images->img_alt}}" title="{{$images->img_title}}" />
            </figure>
            @endif
            @endforeach
            @endif
        </div>
    </section>
    <section class="home-news">
        <div class="home-news__title-container">
            <h4 class="home-news__title theme-gradient-alpha-light gradient-text">news</h4>
        </div>

        <div class="home-news__items">
            @if(count($front_news) > 0)
            @foreach($front_news as $frontNews)
            @if(!empty($frontNews->news_image))
            <a href="{{$frontNews->news_url}}" class="home-news__item">
                <img class="home-news__item_img" src="{{Voyager::image($frontNews->news_image)}}" alt="{{$frontNews->img_alt}}" title="{{$frontNews->img_title}}" />
                <div class="home-news__item_text">
                    <div class="home-news__item_text_date">{{$frontNews->news_date}}</div>
                    <b class="home-news__item_text_caption">{{$frontNews->news_title}}</b>
                    <span class="home-news__item_text_by">{{$frontNews->news_source}}</span>
                </div>
            </a>
            @endif
            @endforeach
            @endif
            @if(count($slider_news) > 0)
            <div class="home-news__item slider">
                @foreach($slider_news as $sliderNews)
                <a href="{{$sliderNews->news_url}}" class="home-news__item_text">
                    <div class="home-news__item_text_date">{{$sliderNews->news_date}}</div>
                    <b class="home-news__item_text_caption">{!! $sliderNews->news_title !!}</b>
                    <span class="home-news__item_text_by">{{$sliderNews->news_source}}</span>
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    {{-- <section class="home-blog">
        <div class="home-blog-bg-ttl">
            perspective
        </div>
        <div class="home-blog-wrap">
            @if(count($blogs) > 0)
            @foreach($blogs as $blog)
            <a href="{{$blog->cta_url}}" class="home-blog-item">
                <img src="{{Voyager::image($blog->blog_image)}}" alt="{{$blog->img_alt}}" title="{{$blog->img_title}}" class="blog-img">
                <div class="home_blog__content">
                    <div class="home_blog_details">{{ $blog->blog_title }}</div>
                    <div class="home_blog_foo">
                        {{$blog->blog_footer}}
                    </div>
                </div>
                <div class="home_blog__content_hover">
                    <div class="blog__content_inner">
                        <div class="home_blog_details">{{ $blog->blog_title }}</div>
                        <div class="home_blog_details_hover">{{ $blog->description }}</div>
                        <button class="cta home_blog_cta"><span>{{$blog->cta_name}}</span></button>
                    </div>
                    <div class="home_blog_foo">
                        {{$blog->blog_footer}}
                    </div>
                </div>
            </a>
            @endforeach
            @endif
            <div class="blog_overlay"></div>
        </div>
    </section> --}}
    {{-- <section class="home-newsLetter">
        <div class="newsletterTtl theme-gradient-alpha-light gradient-text ">
        newsletter
        </div>
        <div class="newsletterText">
            Stay up-to-date on the new era of energy with our latest newsletters.
        </div>
        <form class="newsletter_form">
            <div class="form_input-group">
                <input type="text" class="newsletter_email" placeholder="Your email">
                <input type="hidden" class="newsletter_url" value="{{route('newsletter_subscription')}}">
            </div>
            <button class="cta gradient-cta theme-gradient newsletter_btn">
                <span class="gradient-cta-overlay gradient-text theme-gradient">apply</span>
            </button>
            <div class="form-thank-you">Thank you for submitting the form.<br />We will get in touch with you shortly</div>
        </form>
    </section> --}}
@stop