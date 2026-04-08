@extends('layouts.newstatic')
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
<section class="investorPages-container profit-container">
	<div class="gallery-tabs-wrapper">
		<a id="refinery" href="javascript:;" class="active gallery-tab">Refinery</a>
		<a id="retailoutlet" href="javascript:;" class="gallery-tab">RO (Retail Outlet)</a>
		<a id="csr" href="javascript:;" class="gallery-tab">CSR</a>
		<a id="people" href="javascript:;" class="gallery-tab">People</a>						
	</div>
	@if(count($gallery_type) > 0)
	<div class="slider_wrapper">
		@php $count = 1; @endphp
		@foreach($gallery_type as $galleries)
		<div class="gallery_slider {{ $count == 1 ? 'active' : ''}}">
			@foreach($galleries->galleries as $gallery)
			<div>
				<div class="gallery_slider_image">
					<a class="download" download href="{{ Voyager::image($gallery->download_image)}}"><div>Download</div></a>
					<picture>
						<source media="(max-width: 767px)" srcset="{{ Voyager::image($gallery->mobile_image)}}" />
						<img src="{{ Voyager::image($gallery->desktop_image)}}" alt="gallery pic">
					</picture>
				</div>
			</div>
			@endforeach
		</div>
		@php $count++; @endphp
		@endforeach
	</div>
	@endif
</section>
@stop