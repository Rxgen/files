@extends('layouts.newstatic')
@section('content')
@if(count($page) > 0)
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="{{$page[0]->img_alt}}" title="{{$page[0]->img_title}}" class="innerBanner-img">
    </picture>
    <h1 class="innerBanner-title innerBannerLeft">{!! $page[0]->banner_title !!}</h1>
</section>
@endif
@include('includes.bread-crumbs')
<section class="blog-page-container blog-page blogDetail_page">
            <h4 class="innerPageTitle theme-gradient-alpha gradient-text">Awards</h4>
            <div class="awardsWrapper">
                <div class="awardYear">
                    <div class="arrows" id="prev">
                        <img src="{{asset('images/chervon-left.png')}}" alt="" class="leftArrow">   
                    </div>
                    <div class="arrows" id="next">
                        <img src="{{asset('images/chervon-left.png')}}" alt="" class="rightArrow">
                    </div>
                    <div class="yearSlider">
                        @foreach($dates as $key =>$date)
                        <div class="awardsYear {{($key == '0') ? 'activeYearParent' : ' '}}" data-year="year-{{$date->date}}">
                            <div>
                                <div class="yearCircle yearPosition"></div>{{$date->date}}<div class="yearLine yearPosition"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="yearPatch"></div>
                </div>
                
             <div class="awardSection">
                    @foreach($awards as $key => $award)
                    <div class="awardContent" id="year-{{$key}}"> 
                        @foreach($award as $item)
                        <div class="awardItem">
                            <img src="{{Voyager::image($item->image)}}" alt="{{$item->image_alt}}">
                            <div class="itemText">
                                <h6>{{$item->title}}</h6>
                                <h4>{{$item->sub_title}}</h4>
                            </div>
                        </div>
                        @endforeach                   
                </div>
            @endforeach
            </div>
        </section>
@stop