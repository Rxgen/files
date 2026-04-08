@extends('layouts.static')
@section('content')
@if(count($page) > 0)
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="{{$page[0]->img_alt}}" title="{{$page[0]->img_title}}" class="innerBanner-img">
    </picture>
    <h2 class="innerBanner-title">{!! $page[0]->banner_title !!}</h2>
</section>
@endif
@include('includes.bread-crumbs')
<section class="innerPage-content career-openings-container page-career-current-openings">
    <div class="job-search-form__container">
        <h3 class="job-search-form__title career-title">Job Search</h3>

        <form class="job-search-form__inputs">
            <select name="department" id="department" class="job-search__input select">
                <option value="">Department</option>
                @if(count($departments) > 0)
                @foreach($departments as $department)
                @if($department->id == $department_id)
                <option value="{{$department->department}}" selected>{{$department->department}}</option>
                @else
                <option value="{{$department->department}}">{{$department->department}}</option>
                @endif
                @endforeach
                @endif
            </select>
            <select name="location" id="location" class="job-search__input select">
                <option value="">Location</option>
                @if(count($cities) > 0)
                @foreach($cities as $city)
                @if($city->id == $location_id)
                <option value="{{$city->district}}" selected>{{$city->district}}</option>
                @else
                <option value="{{$city->district}}">{{$city->district}}</option>
                @endif
                @endforeach
                @endif 
            </select>
            <input type="hidden" id="page-id" value="1">
            <input type="hidden" id="last-page-id" value="{{$last_page}}">
            <input type="hidden" id="career-route" value="{{route('career')}}">
            <button class="cta gradient-cta theme-gradient job-search__cta">
                <span class="gradient-cta-overlay gradient-text theme-gradient">Search</span>
            </button>
        </form>
    </div>
    <div class="open-positions__container">
        <h3 class="open-positions__title career-title">Open Positions <span class="open-positions__title_caption">(ALL)</span></h3>

        <div class="open-positions__wrapper">
        	@if(count($jobs) > 0)
        	@foreach($jobs as $job)
            <div class="open-position">
                <div class="open-position-info">
                    <div class="open-position__title">{{$job->job_departments['department']}}</div>
                    <div class="open-position__dept">{{$job->title}}</div>
                    @php 
                    	$count = count($job->job_locations);
                    	$count1 = 1;
                    @endphp
                    <div class="open-position__location">
                    	@foreach($job->job_locations as $location)
                    	@if($count1 < $count)
                    	{{$location->district}}, 
                    	@elseif($count <= $count1)
                    	{{$location->district}}
                    	@endif
                    	@php $count1++; @endphp
                    	@endforeach
                    </div>
                    <button class="open-position__cta theme-gradient"></button>
                </div>

                <div class="open-position__details">
                    <h3 class="open-position__detail_title">{{$job->job_departments['department']}}</h3>

                    <div class="open-position__detail_info title">
                        <div class="open-position__detail_info_title">Title:</div>
                        <div class="open-position__detail_info_data">{{$job->title}}</div>
                    </div>
                    @if(!empty($job->description))
                    <div class="open-position__detail_info responsibility">
                        <div class="open-position__detail_info_title">Responsibilities:</div>
                        <div class="open-position__detail_info_data">
                            {!! $job->description !!}
                        </div>
                    </div>
                    @endif
                    @if(!empty($job->eligiblity))
                    <div class="open-position__detail_info eligibility">
                        <div class="open-position__detail_info_title">Eligibility:</div>
                        <div class="open-position__detail_info_data">{{$job->eligiblity}}</div>
                    </div>
                    @endif
                    @if(!empty($job->level))
                    <div class="open-position__detail_info level">
                        <div class="open-position__detail_info_title">Level:</div>
                        <div class="open-position__detail_info_data">{{$job->level}}</div>
                    </div>
                    @endif
                    @if(!empty($job->experience))
                    <div class="open-position__detail_info experience">
                        <div class="open-position__detail_info_title">Experience:</div>
                        <div class="open-position__detail_info_data">{{$job->experience}}</div>
                    </div>
                    @endif
                    @if(!empty($job->no_of_position))
                    <div class="open-position__detail_info no_of_position">
                        <div class="open-position__detail_info_title">No. Of Position:</div>
                        <div class="open-position__detail_info_data">{{$job->no_of_position}}</div>
                    </div>
                    @endif
                    <div class="open-position__detail_info location">
                        <img src="{{asset('images/location-pin-big.png')}}" class="open-position__detail_info_icon" alt="" />
                        @php 
		                	$count = count($job->job_locations);
		                	$count1 = 1;
		                @endphp
                        <div class="open-position__detail_info_data">
                        	@foreach($job->job_locations as $location)
		                	@if($count1 < $count)
		                	{{$location->district}}, 
		                	@elseif($count <= $count1)
		                	{{$location->district}}
		                	@endif
		                	@php $count1++; @endphp
		                	@endforeach
                        </div>
                    </div>
                    <div class="open-position__detail_info apply">Apply with detailed CV, mentioning the post applied for in the subject line to <a class="open-position__detail_info_link" href="mailto:aspire@nayaraenergy.com">aspire@nayaraenergy.com</a></div>
                    @if(!empty($job->job_url))
                    <a href="{{$job->job_url}}" class="cta gradient-cta theme-gradient open-position__detail_info_cta">
                        <span class="gradient-cta-overlay gradient-text theme-gradient">Apply Now</span>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
            @else
            <div class="open-position-info">
                <div class="open-position__title">no jobs found.</div>
            </div>
            @endif
        </div>
    </div>
</section>
@stop