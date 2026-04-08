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
@include('includes.bread-crumbs')
<section class="innerPage-content investorPages-container page-investors-notices">
	<div class="media-kit-blk">
		<h4 class="investor-pagesTitle theme-gradient-alpha gradient-text">Media Kit</h4>
		<p style="margin-bottom: 3rem; font-size: 17px;">
            For any queries please email on: <a href="mailto:brand.communications@nayaraenergy.com" style="color: #14c7a3b3">brand.communications@nayaraenergy.com</a>
        </p>
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
	{{--<div class="media-kit-blk committee-page">
		<section class="board_section board_member_category1">
			<h4 class="investor-pagesTitle theme-gradient-alpha gradient-text">Spokesperson Information</h4>
		    <div class="board_inner_sec">
		        <div class="board_person_blk_big">
		            <div class="board_person_blk_inner" data-index="0">
		                <div class="board_person_img_blk_big">
		                    <img src="{{Voyager::image($spokesperson->image)}}" alt="{{$spokesperson->img_alt}}" title="{{$spokesperson->img_title}}">
		                </div>
		                <div class="board_person_content_blk_big">
		                    <div class="board_person_ttl_big">
		                        {{ $spokesperson->name }}
		                    </div>
		                    <div class="board_person_designation_big">
		                        - {{ $spokesperson->designation }}
		                    </div>
		                    <div class="board_person_content">
		                        {!! substr($spokesperson->description, 0, 160) !!} ...
		                    </div>
		                    <div class="board_person_pop_btn_big">
		                        <a href="javascript:void(0);" class="cta gradient-cta theme-gradient">
		                            <span class="gradient-cta-overlay gradient-text theme-gradient">know more</span>
		                        </a>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
    	</section>
    	<section class="board_committee_modal board_member_category1_modal">
		    <div class="board_committee_popup">
		        <div class="modal_slider">
		            <div class="modal_slide" data-index="0">
		                <div class="close_modal">&times;</div>
		                <div class="modal_img">
		                    <img src="{{Voyager::image($spokesperson->image)}}" alt="{{$spokesperson->img_alt}}" title="{{$spokesperson->img_title}}">
		                </div>
		                <div class="modal_person_name center">
		                    {{ $spokesperson->name }}
		                </div>
		                <div class="modal_person_desgn center">
		                    {{ $spokesperson->designation }}
		                </div>
		                <div class="modal_person_brand center">
		                    Nayara Energy Limited
		                </div>
		                <div class="modal_person_content">
		                    {!! $spokesperson->description !!}
		                </div>
		            </div>
		        </div>
		    </div>
		</section>
	</div>--}}
	{!! $page[0]->body !!}
	
</section>
@stop
