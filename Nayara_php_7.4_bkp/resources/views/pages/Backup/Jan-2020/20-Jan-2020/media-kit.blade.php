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
<section class="innerPage-content investorPages-container page-investors-notices">
	<div class="media-kit-blk">
		<h4 class="investor-pagesTitle theme-gradient-alpha gradient-text">Media Kit</h4>
		<div class="media-kit-container all-reports-listingBlock ">
			@if(count($kits) > 0)
			@foreach($kits as $kit)
			@php
                $file = json_decode($kit->file);
            @endphp
			<div class="pdfDownload-data">
					<img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon">
					<div class="pdfdata-block">
							<div class="pdf-name-title">
									{{$kit->title}}                                       </div>
							<a href="{{URL::to(Storage::url($file[0]->download_link))}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta" target="blank">
									<span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
							</a>
					</div>
			</div>
			@endforeach
			@endif
		</div>
	</div>
	<div class="media-kit-blk">
		<h4 class="investor-pagesTitle theme-gradient-alpha gradient-text">Media Resources</h4>
		<div class="media-kit-slider">
			<div class="media-kit-slider-inner">
				<ul class="flip-items">
					@if(count($resources) > 0)
					@foreach($resources as $resource)
					<li class="media-kit-slide">
						<picture>
							<source media="(max-width: 767px)" srcset="{{ Voyager::image($resource->getThumbnail($resource->image, 'cropped')) }}" />
							<img src="{{Voyager::image($resource->image)}}" class="media-kit-slide-img" alt="" />
						</picture>
					</li>
					@endforeach
					@endif
				</ul>
			</div>
		</div>
	</div>
</section>
@stop



 {{--@foreach(json_decode($careers[0]['gallery']) as $image)

                                        <img src="{{ Voyager::image($careers[0]->getThumbnail($image, 'cropped')) }}" class="img-fluid"/>

                                        @endforeach--}}
