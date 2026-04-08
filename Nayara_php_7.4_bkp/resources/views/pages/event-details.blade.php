@extends('layouts.welcome')
@section('content')
        <section class="innerPage-banner-container">
            <picture>
                <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
                <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="Media" class="innerBanner-img">
            </picture>
            <h2 class="innerBanner-title">Event Detail</h2>
        </section>
        <section class="innerPage-content investorPages-container page-investors-notices event_section">
            <div class="event_detail">
                <div class="event_text">
                    <div class="event_title">
                      <h1> {{$eventdetails->event_title}} </h1> </div>
                    {!! $eventdetails->long_description !!}
                         @php
                         $date = \Carbon\Carbon::createFromFormat('Y-m-d', $eventdetails->date);
                         @endphp
                    <div class="event_date">{{ strtoupper($date->format('F d, Y')) }}</div>
                </div>
                <div class="event_detail_swiper">
                    <div style="" class="swiper mySwiper2">
                        <div class="swiper-wrapper">
                          <div class="swiper-slide">
                            <img src="{{Voyager::image($eventdetails->event_image1)}}" alt="{{$eventdetails->event_image1_alt}}"/>
                          </div>
                          <div class="swiper-slide">
                            <img src="{{Voyager::image($eventdetails->event_image2)}}" alt="{{$eventdetails->event_image2_alt}}"/>
                          </div>
                          <div class="swiper-slide">
                            <img src="{{Voyager::image($eventdetails->event_image3)}}" alt="{{$eventdetails->event_image3_alt}}"/>
                          </div> 
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="prev_btn"><img src="{{asset('images/arrow-left.png')}}" alt="" width="128" height="128"></a>
                    <a href="javascript:void(0)" class="next_btn"><img src="{{asset('images/arrow-left.png')}}" alt="" width="128" height="128"></a>
                    <div thumbsSlider="" class="swiper mySwiper">
                      <div class="swiper-wrapper">
                        <div class="swiper-slide">
                          <img src="{{Voyager::image($eventdetails->event_image1)}}" alt="{{$eventdetails->event_image1_alt}}"/>
                        </div>
                        <div class="swiper-slide">
                          <img src="{{Voyager::image($eventdetails->event_image2)}}" alt="{{$eventdetails->event_image2_alt}}"/>
                        </div>
                        <div class="swiper-slide">
                          <img src="{{Voyager::image($eventdetails->event_image3)}}" alt="{{$eventdetails->event_image3_alt}}"/>
                        </div>
                         
                      </div>
                    </div>
                </div>
            </div>
        </section>
@stop 





	