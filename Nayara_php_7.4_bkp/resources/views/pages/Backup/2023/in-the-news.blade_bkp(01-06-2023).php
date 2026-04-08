@extends('layouts.static')
@section('content')
@if(count($page) > 0)
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="{{$page[0]->img_alt}}" title="{{$page[0]->img_title}}" class="innerBanner-img">
    </picture>
    <h1 class="innerBanner-title">{!! $page[0]->banner_title !!}</h1>
</section>
@endif

@include('includes.bread-crumbs')

<section class="innerPage-content investorPages-container page-investors-notices">
    <div style="clear:both;width:100%">
        <h4 id="news_year" class="investor-pagesTitle theme-gradient-alpha gradient-text" style="float:left;">{{ $current_year }}</h4>
        <div class="search-block" style="float:right">
		
            @if(count($dates) > 0)
            <select id="year-change" class="yearSelection-annualReport">
                <option value="">Select Year</option>
                @foreach($dates as $date)
                <option value="{{ $date->date }}">{{ $date->date }}</option>
                @endforeach
            </select>
            @endif
            <input type="hidden" data-page='in_the_news' id="ajax-url" value="{{ route('news.ajax') }}">
        </div>
    
    </div>
	
    @if(count($in_the_news) > 0)
    <div class="notices-container" style="clear: both">
        <div id="news_section" class="all-reports-listingBlock notice-lisitingBlock media_cover_cur_year_listingblk wrap-clear" style="display: flex;">
            @foreach($in_the_news as $news)
            @php $file = json_decode($news->file); @endphp
            <div class="pdfDownload-data">
                <!--<img src="assets/images/pdf-img.png" alt="pdf" class="pdfIcon">-->
                <div class="pdfdata-block">
                    <img src="{{ Voyager::image($news->image) }}" alt="{{ $news->img_alt }}" title="{{ $news->img_title }}" class="news-image">
                    <div class="pdf-name-title">
                        <span>{{ $news->title }}</span> {{$news->sub_title}} </div>
					@if(count($file) > 0)
                    <a href="{{url(Storage::url($file[0]->download_link))}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                        <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                    </a>
					@endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    <h5 class="history-ttl theme-gradient-alpha gradient-text">Historical</h5>
    <div class="notices-container">
        <div class="notices-wrapper active">
            <h5 class="notices-heading">Crop Cultivation <div class="arrow-title"></div>
            </h5>
            <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear">
                @if(isset($historicals['crop']) && count($historicals['crop']) > 0)
                @foreach($historicals['crop'] as $historical)
                @php $file = json_decode($historical->file); @endphp
                <div class="pdfDownload-data">
                    <!-- <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon"> -->
                    <div class="pdfdata-block">
                        <img src="{{ Voyager::image($historical->image)}}" class="news-image">
                        <div class="pdf-name-title">
                            <span>{{$historical->title}}</span> {{$historical->subtitle}}</div>
                        <a href="{{url(Storage::url($file[0]->download_link))}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                            <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                        </a>
                    </div>
                </div>
                @endforeach
                @endif   
            </div>
        </div> 
        <div class="notices-wrapper">
            <h5 class="notices-heading">Enrollment Drive <div class="arrow-title"></div>
            </h5>

            <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear">
                @if(isset($historicals['enrollment']) && count($historicals['enrollment']) > 0)
                @foreach($historicals['enrollment'] as $historical)
                @php $file = json_decode($historical->file); @endphp
                <div class="pdfDownload-data">
                    <!-- <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon"> -->
                    <div class="pdfdata-block">
                        <img src="{{ Voyager::image($historical->image)}}" class="news-image">
                        <div class="pdf-name-title">
                            <span>{{$historical->title}} </span> {{$historical->subtitle}}</div>
                        <a href="{{url(Storage::url($file[0]->download_link))}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                            <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                        </a>
                    </div>
                </div>
                @endforeach
                @endif
            </div>

        </div>
        <div class="notices-wrapper">
            <h5 class="notices-heading">Health Training Camp <div class="arrow-title"></div>
            </h5>

            <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear">
                @if(isset($historicals['health']) && count($historicals['health']) > 0)
                @foreach($historicals['health'] as $historical)
                @php $file = json_decode($historical->file); @endphp
                <div class="pdfDownload-data">
                    <!-- <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon"> -->
                    <div class="pdfdata-block">
                        <img src="{{ Voyager::image($historical->image)}}" class="news-image">
                        <div class="pdf-name-title">
                            <span>{{$historical->title}} </span> {{$historical->subtitle}}</div>
                        <a href="{{url(Storage::url($file[0]->download_link))}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                            <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                        </a>
                    </div>
                </div>
                @endforeach
                @endif 
            </div>

        </div>
        <div class="notices-wrapper">
            <h5 class="notices-heading">Nutrition <div class="arrow-title"></div>
            </h5>

            <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear">
                @if(isset($historicals['nutrition']) && count($historicals['nutrition']) > 0)
                @foreach($historicals['nutrition'] as $historical)
                @php $file = json_decode($historical->file); @endphp
                <div class="pdfDownload-data">
                    <!-- <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon"> -->
                    <div class="pdfdata-block">
                        <img src="{{ Voyager::image($historical->image)}}" class="news-image">
                        <div class="pdf-name-title">
                            <span>{{$historical->title}} </span> {{$historical->subtitle}}</div>
                        <a href="{{url(Storage::url($file[0]->download_link))}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                            <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                        </a>
                    </div>
                </div>
                @endforeach
                @endif 
            </div>

        </div>
        <div class="notices-wrapper">
            <h5 class="notices-heading">Outlook Coverage <div class="arrow-title"></div>
            </h5>

            <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear">
                @if(isset($historicals['outlook']) && count($historicals['outlook']) > 0)
                @foreach($historicals['outlook'] as $historical)
                @php $file = json_decode($historical->file); @endphp
                <div class="pdfDownload-data">
                    <!-- <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon"> -->
                    <div class="pdfdata-block">
                        <img src="{{ Voyager::image($historical->image)}}" class="news-image">
                        <div class="pdf-name-title">
                            <span>{{$historical->title}} </span> {{$historical->subtitle}}</div>
                        <a href="{{url(Storage::url($file[0]->download_link))}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                            <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                        </a>
                    </div>
                </div>
                @endforeach
                @endif 
            </div>

        </div>
        <div class="notices-wrapper">
            <h5 class="notices-heading">Safety Week  <div class="arrow-title"></div>
            </h5>

            <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear">
                @if(isset($historicals['safety']) && count($historicals['safety']) > 0)
                @foreach($historicals['safety'] as $historical)
                @php $file = json_decode($historical->file); @endphp
                <div class="pdfDownload-data">
                    <!-- <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon"> -->
                    <div class="pdfdata-block">
                        <img src="{{ Voyager::image($historical->image)}}" class="news-image">
                        <div class="pdf-name-title">
                            <span>{{$historical->title}} </span> {{$historical->subtitle}}</div>
                        <a href="{{url(Storage::url($file[0]->download_link))}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                            <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                        </a>
                    </div>
                </div>
                @endforeach
                @endif 
            </div>

        </div>

    </div>
</section>
@stop