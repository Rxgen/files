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
	<div class="media-kit-blk">
		<h4 class="investor-pagesTitle theme-gradient-alpha gradient-text">Awards</h4>
		<div class="sustainability-container bio-medical-waste-report">                 
                    <div class="report-container">
                        <table class="table-bordered table-striped table-condensed cf">
                            <thead class="cf">
                                <tr>
                                    <th style="width:50%;">
                                        Award
                                    </th>
                                    <th>
                                    Organised by
                                    </th>
                                    <th class="numeric" id="tdMonth">
                                    Year
                                    </th>
                                </tr>
                            </thead>
							@if(count($awards) > 0)
			@foreach($awards as $award)
			
                            <tbody>
                                <tr class="yellowbg">
                                    <td class="mobg" data-title="Locations" id="tdSite">
									{{$award->title}}
                                    </td>
                                    <td data-title="Biomedical Wastes Categories">
                                    {{$award->organized_by}}
									
                                    </td>
                                    <td class="numeric" data-title="Jan-19" id="tdYellow">
                                        
                                        {{$award->date}}
                                    </td>
                                </tr>
                                
                            </tbody>
							@endforeach
			@endif
                        </table>
                    </div>
                </div>
		
		
		
		
	</div>
	{!! $page[0]->body !!}
	
</section>
@stop