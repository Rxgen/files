@extends('layouts.static')
@section('content')
@if(count($page) > 0)
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="Apply Online for petrol pump franchisee" class="innerBanner-img">
    </picture>
    <h2 class="innerBanner-title">{{$page[0]->banner_title}}</h2>
</section>
@endif
@include('includes.bread-crumbs')
@if(count($page) > 0)
{!! $page[0]->body !!}
@endif
<section class="wrap-clear refin_flexibility">
    <h3 class="flexibility_ttl">Flexibility in raw materials</h3>
    <div class="refin_flexiblity_row">
        <div class="refin_flexbility_col">
            <div class="inner_refin_flexib">
                <div class="cirulr_percent_blk">
                    <svg xmlns="http://www.w3.org/2000/svg" class="cirular_progres_svg" viewBox="0 0 180 180">
                    <defs>
                        <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#00bc9b" />
                            <stop offset="100%" stop-color="#5eaefd" />
                        </linearGradient>
                    </defs>
                        <circle class="cirular_progres_path" r="62" cx="90" cy="90"></circle>
                        <circle class="cirular_progres" stroke="url(#gradient)" r="62" cx="90" cy="90" data-percentage='65'></circle>
                    </svg>
                    <div class="svg-percent"></div>
                </div>
                <div class="circular_progress_ttl">
                    Ultra Heavy
                </div>
            </div>
        </div>
        <div class="refin_flexbility_col">
            <div class="inner_refin_flexib">

                <div class="cirulr_percent_blk">
                    <svg class="cirular_progres_svg" viewBox="0 0 180 180">
                        <circle class="cirular_progres_path" r="62" cx="90" cy="90"></circle>
                        <circle class="cirular_progres" stroke="url(#gradient)" r="62" stroke="black" cx="90" cy="90" data-percentage='26'></circle>
                    </svg>
                    <div class="svg-percent"></div>
                </div>
                <div class="circular_progress_ttl">
                    Heavy
                </div>
            </div>
        </div>
        <div class="refin_flexbility_col">
            <div class="inner_refin_flexib">

                <div class="cirulr_percent_blk">
                    <svg class="cirular_progres_svg" viewBox="0 0 180 180">&nbsp;
                        <circle class="cirular_progres_path" r="62" cx="90" cy="90">&nbsp;</circle>
                        <circle class="cirular_progres" stroke="url(#gradient)" r="62" stroke="black" cx="90" cy="90" data-percentage='09'>&nbsp;</circle>
                    </svg>
                    <div class="svg-percent"></div>
                </div>
                <div class="circular_progress_ttl">
                    Light
                </div>
            </div>
        </div>
        <div class="refin_flexbility_col">
            <div class="inner_refin_flexib">

                <div class="cirulr_percent_blk">
                    <svg class="cirular_progres_svg" viewBox="0 0 180 180">&nbsp;
                        <circle class="cirular_progres_path" r="62" cx="90" cy="90">&nbsp;</circle>
                        <circle class="cirular_progres" stroke="url(#gradient)" r="62" stroke="black" cx="90" cy="90" data-percentage='56'>&nbsp;</circle>
                    </svg>
                    <div class="svg-percent"></div>
                </div>
                <div class="circular_progress_ttl">
                    High- Margin Basket
                </div>
            </div>
        </div>
        <div class="refin_flexbility_col">
            <div class="inner_refin_flexib">

                <div class="cirulr_percent_blk">
                    <svg class="cirular_progres_svg" viewBox="0 0 180 180">&nbsp;
                        <circle class="cirular_progres_path" r="62" cx="90" cy="90">&nbsp;</circle>
                        <circle class="cirular_progres" stroke="url(#gradient)" r="62" stroke="black" cx="90" cy="90" data-percentage='27'>&nbsp;</circle>
                    </svg>
                    <div class="svg-percent"></div>
                </div>
                <div class="circular_progress_ttl">
                    Diesel and medium distillates
                </div>
            </div>
        </div>
        <div class="refin_flexbility_col">
            <div class="inner_refin_flexib">

                <div class="cirulr_percent_blk">
                    <svg class="cirular_progres_svg" viewBox="0 0 180 180">&nbsp;
                        <circle class="cirular_progres_path" r="62" cx="90" cy="90">&nbsp;</circle>
                        <circle class="cirular_progres" stroke="url(#gradient)" r="62" stroke="black" cx="90" cy="90" data-percentage='17'>&nbsp;</circle>
                    </svg>
                    <div class="svg-percent"></div>
                </div>
                <div class="circular_progress_ttl">
                    Gasoline and light distillates
                </div>
            </div>
        </div>
    </div>
</section>
@stop