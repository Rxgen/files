@extends('layouts.newstatic')
@section('content')
@if(count($page) > 0)
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="Apply Online for petrol pump franchisee" class="innerBanner-img">
    </picture>
    <h1 class="innerBanner-title">{!! $page[0]->banner_title !!}</h1>
</section>
@endif
@include('includes.bread-crumbs')
<div class="innerPage-content committee-page board-committees">
    <section class="board_section board_section_audit">
        <h3 class="board_ttl">Audit Committee</h3>
        @if(count($team['audit_team']) == 5 || count($team['audit_team']) == 6)
        <div class="board_inner_sec board_inner_sec_5">
        @else
        <div class="board_inner_sec">
        @endif
        @php $counter = 0; @endphp 
        	@foreach($team['audit_team'] as $audit_team)
            <div class="board_person_blk">
                <div class="board_person_blk_inner" data-index="{{$counter}}">
                    <div class="board_person_img_blk">
                        <img src="{{Voyager::image($audit_team->image)}}" alt="{{$audit_team->name}}">
                    </div>
                    <div class="board_person_content_blk">
                        <div class="board_person_ttl">
                            {{$audit_team->name}}
                        </div>
                        <div class="board_person_designation">
                            - {{$audit_team->designation}}
                        </div>
                        <div class="board_person_pop_btn">
                            <ul>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @php $counter++; @endphp
            @endforeach
        </div>
    </section>
    <section class="board_section board_section_nomination">
        <h3 class="board_ttl">Nomination & Remuneration Committee</h3>
        @if(count($team['nomination_team']) == 5 || count($team['nomination_team']) == 6)
        <div class="board_inner_sec board_inner_sec_5">
        @else
        <div class="board_inner_sec">
        @endif
        @php $counter = 0; @endphp
        @foreach($team['nomination_team'] as $nomination_team)
            <div class="board_person_blk">
                <div class="board_person_blk_inner" data-index="{{$counter}}">
                    <div class="board_person_img_blk">
                        <img src="{{Voyager::image($nomination_team->image)}}" alt="{{$nomination_team->name}}">
                    </div>
                    <div class="board_person_content_blk">
                        <div class="board_person_ttl">
                            {{$nomination_team->name}}
                        </div>
                        <div class="board_person_designation">
                            - {{$nomination_team->designation}}
                        </div>
                        <div class="board_person_pop_btn">
                            <ul>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @php $counter++; @endphp
            @endforeach
        </div>
    </section>
    <section class="board_section board_section_Stakeholders">
        <h3 class="board_ttl">Stakeholders Relationship Committee</h3>
        @if(count($team['stakeholder_team']) == 5 || count($team['stakeholder_team']) == 6)
        <div class="board_inner_sec board_inner_sec_5">
        @else
        <div class="board_inner_sec">
        @endif
        @php $counter = 0; @endphp
        @foreach($team['stakeholder_team'] as $stakeholder_team)
            <div class="board_person_blk">
                <div class="board_person_blk_inner" data-index="{{$counter}}">
                    <div class="board_person_img_blk">
                        <img src="{{Voyager::image($stakeholder_team->image)}}" alt="{{$stakeholder_team->name}}">
                    </div>
                    <div class="board_person_content_blk">
                        <div class="board_person_ttl">
                            {{$stakeholder_team->name}}
                        </div>
                        <div class="board_person_designation">
                            - {{$stakeholder_team->designation}}
                        </div>
                        <div class="board_person_pop_btn">
                            <ul>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @php $counter++; @endphp
            @endforeach
        </div>
    </section>
    <section class="board_section board_section_csr">
        <h3 class="board_ttl">CSR and Sustainability Committee</h3>
        @if(count($team['csr_team']) == 5 || count($team['csr_team']) == 6)
        <div class="board_inner_sec board_inner_sec_5">
        @else
        <div class="board_inner_sec">
        @endif
        @php $counter = 0; @endphp
        @foreach($team['csr_team'] as $csr_team)
            <div class="board_person_blk">
                <div class="board_person_blk_inner" data-index="{{$counter}}">
                    <div class="board_person_img_blk">
                        <img src="{{Voyager::image($csr_team->image)}}" alt="{{$csr_team->name}}">
                    </div>
                    <div class="board_person_content_blk">
                        <div class="board_person_ttl">
                            {{$csr_team->name}}
                        </div>
                        <div class="board_person_designation">
                            - {{$csr_team->designation}}
                        </div>
                        <div class="board_person_pop_btn">
                            <ul>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @php $counter++; @endphp
            @endforeach
        </div>
    </section>

    <section class="board_section board_section_hse">
        <h3 class="board_ttl">Risk & HSE Committee</h3>
        @if(count($team['hse_team']) == 5 || count($team['hse_team']) == 6)
        <div class="board_inner_sec board_inner_sec_5">
        @else
        <div class="board_inner_sec">
        @endif
        @php $counter = 0; @endphp
        @foreach($team['hse_team'] as $hse_team)
            <div class="board_person_blk">
                <div class="board_person_blk_inner" data-index="{{$counter}}">
                    <div class="board_person_img_blk">
                        <img src="{{Voyager::image($hse_team->image)}}" alt="{{$hse_team->name}}">
                    </div>
                    <div class="board_person_content_blk">
                        <div class="board_person_ttl">
                            {{$hse_team->name}}
                        </div>
                        <div class="board_person_designation">
                            - {{$hse_team->designation}}
                        </div>
                        <div class="board_person_pop_btn">
                            <ul>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @php $counter++; @endphp
            @endforeach
        </div>
    </section>

    <section class="board_section board_section_trading">
        <h3 class="board_ttl">Trading & Risk Committee</h3>
        @if(count($team['trading_team']) == 5 || count($team['trading_team']) == 6)
        <div class="board_inner_sec board_inner_sec_5">
        @else
        <div class="board_inner_sec">
        @endif
        @php $counter = 0; @endphp
        @foreach($team['trading_team'] as $trading_team)
            <div class="board_person_blk">
                <div class="board_person_blk_inner" data-index="{{$counter}}">
                    <div class="board_person_img_blk">
                        <img src="{{Voyager::image($trading_team->image)}}" alt="{{$trading_team->name}}">
                    </div>
                    <div class="board_person_content_blk">
                        <div class="board_person_ttl">
                            {{$trading_team->name}}
                        </div>
                        <div class="board_person_designation">
                            - {{$trading_team->designation}}
                        </div>
                        <div class="board_person_pop_btn">
                            <ul>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @php $counter++; @endphp
            @endforeach
        </div>
    </section>

    <section class="board_section board_section_banking">
        <h3 class="board_ttl">Banking & Finance Committee</h3>
        @if(count($team['banking_team']) == 5 || count($team['banking_team']) == 6)
        <div class="board_inner_sec board_inner_sec_5">
        @else
        <div class="board_inner_sec">
        @endif
        @php $counter = 0; @endphp
        @foreach($team['banking_team'] as $banking_team)
            <div class="board_person_blk">
                <div class="board_person_blk_inner" data-index="{{$counter}}">
                    <div class="board_person_img_blk">
                        <img src="{{Voyager::image($banking_team->image)}}" alt="{{$banking_team->name}}">
                    </div>
                    <div class="board_person_content_blk">
                        <div class="board_person_ttl">
                            {{$banking_team->name}}
                        </div>
                        <div class="board_person_designation">
                            - {{$banking_team->designation}}
                        </div>
                        <div class="board_person_pop_btn">
                            <ul>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @php $counter++; @endphp
            @endforeach
        </div>
    </section>

    <section class="board_committee_modal board_audit_modal">
        <div class="board_committee_popup">
            <div class="modal_slider">
            	@php $counter = 0; @endphp
            	@foreach($team['audit_team'] as $audit_popup)
                <div class="modal_slide" data-index="{{$counter}}">
                    <div class="close_modal">&times;</div>
                    <div class="modal_img">
                        <img src="{{Voyager::image($audit_popup->image)}}" alt="chin">
                    </div>
                    <div class="modal_person_name center">
                        {{$audit_popup->name}}
                    </div>
                    <div class="modal_person_desgn center">
                        {{$audit_popup->designation}} 
                    </div>
                    <div class="modal_person_brand center">
                        Nayara Energy Limited
                    </div>
                    <div class="modal_person_content">
                        {!! $audit_popup->description !!}
                    </div>
                </div>
                @php $counter++; @endphp
                @endforeach
            </div>
        </div>
    </section>
    <section class="board_committee_modal board_nomination_modal">
        <div class="board_committee_popup">
            <div class="modal_slider">
            	@php $counter = 0; @endphp
            	@foreach($team['nomination_team'] as $nomination_popup)
                <div class="modal_slide" data-index="{{$counter}}">
                    <div class="close_modal">&times;</div>
                    <div class="modal_img">
                        <img src="{{Voyager::image($nomination_popup->image)}}" alt="chin">
                    </div>
                    <div class="modal_person_name center">
                        {{$nomination_popup->name}}
                    </div>
                    <div class="modal_person_desgn center">
                        {{$nomination_popup->designation}} 
                    </div>
                    <div class="modal_person_brand center">
                        Nayara Energy Limited
                    </div>
                    <div class="modal_person_content">
                        {!! $nomination_popup->description !!}
                    </div>
                </div>
                @php $counter++; @endphp
                @endforeach
            </div>
        </div>
    </section>
    <section class="board_committee_modal board_Stakeholders_modal">
        <div class="board_committee_popup">
            <div class="modal_slider">
            	@php $counter = 0; @endphp
            	@foreach($team['stakeholder_team'] as $stakeholder_popup)
                <div class="modal_slide" data-index="{{$counter}}">
                    <div class="close_modal">&times;</div>
                    <div class="modal_img">
                        <img src="{{Voyager::image($stakeholder_popup->image)}}" alt="chin">
                    </div>
                    <div class="modal_person_name center">
                        {{$stakeholder_popup->name}}
                    </div>
                    <div class="modal_person_desgn center">
                        {{$stakeholder_popup->designation}} 
                    </div>
                    <div class="modal_person_brand center">
                        Nayara Energy Limited
                    </div>
                    <div class="modal_person_content">
                        {!! $stakeholder_popup->description !!}
                    </div>
                </div>
                @php $counter++; @endphp
                @endforeach
            </div>
        </div>
    </section>
    <section class="board_committee_modal board_csr_modal">
        <div class="board_committee_popup">
            <div class="modal_slider">
            	@php $counter = 0; @endphp
            	@foreach($team['csr_team'] as $csr_popup)
                <div class="modal_slide" data-index="{{$counter}}">
                    <div class="close_modal">&times;</div>
                    <div class="modal_img">
                        <img src="{{Voyager::image($csr_popup->image)}}" alt="chin">
                    </div>
                    <div class="modal_person_name center">
                        {{$csr_popup->name}}
                    </div>
                    <div class="modal_person_desgn center">
                        {{$csr_popup->designation}} 
                    </div>
                    <div class="modal_person_brand center">
                        Nayara Energy Limited
                    </div>
                    <div class="modal_person_content">
                        {!! $csr_popup->description !!}
                    </div>
                </div>
                @php $counter++; @endphp
                @endforeach
            </div>
        </div>
    </section>
    <section class="board_committee_modal board_hse_modal">
        <div class="board_committee_popup">
            <div class="modal_slider">
            	@php $counter = 0; @endphp
            	@foreach($team['hse_team'] as $hse_popup)
                <div class="modal_slide" data-index="{{$counter}}">
                    <div class="close_modal">&times;</div>
                    <div class="modal_img">
                        <img src="{{Voyager::image($hse_popup->image)}}" alt="chin">
                    </div>
                    <div class="modal_person_name center">
                        {{$hse_popup->name}}
                    </div>
                    <div class="modal_person_desgn center">
                        {{$hse_popup->designation}} 
                    </div>
                    <div class="modal_person_brand center">
                        Nayara Energy Limited
                    </div>
                    <div class="modal_person_content">
                        {!! $hse_popup->description !!}
                    </div>
                </div>
                @php $counter++; @endphp
                @endforeach
            </div>
        </div>
    </section>

    <section class="board_committee_modal board_trading_modal">
        <div class="board_committee_popup">
            <div class="modal_slider">
            	@php $counter = 0; @endphp
            	@foreach($team['trading_team'] as $trading_popup)
                <div class="modal_slide" data-index="{{$counter}}">
                    <div class="close_modal">&times;</div>
                    <div class="modal_img">
                        <img src="{{Voyager::image($trading_popup->image)}}" alt="{{$trading_popup->name}}">
                    </div>
                    <div class="modal_person_name center">
                        {{$trading_popup->name}}
                    </div>
                    <div class="modal_person_desgn center">
                        {{$trading_popup->designation}} 
                    </div>
                    <div class="modal_person_brand center">
                        Nayara Energy Limited
                    </div>
                    <div class="modal_person_content">
                        {!! $trading_popup->description !!}
                    </div>
                </div>
                @php $counter++; @endphp
                @endforeach
            </div>
        </div>
    </section>

    <section class="board_committee_modal board_banking_modal">
        <div class="board_committee_popup">
            <div class="modal_slider">
            	@php $counter = 0; @endphp
            	@foreach($team['banking_team'] as $banking_popup)
                <div class="modal_slide" data-index="{{$counter}}">
                    <div class="close_modal">&times;</div>
                    <div class="modal_img">
                        <img src="{{Voyager::image($banking_popup->image)}}" alt="{{$banking_popup->name}}">
                    </div>
                    <div class="modal_person_name center">
                        {{$banking_popup->name}}
                    </div>
                    <div class="modal_person_desgn center">
                        {{$banking_popup->designation}} 
                    </div>
                    <div class="modal_person_brand center">
                        Nayara Energy Limited
                    </div>
                    <div class="modal_person_content">
                        {!! $banking_popup->description !!}
                    </div>
                </div>
                @php $counter++; @endphp
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection