@extends('layouts.static')
@section('content')
@if(count($page) > 0)
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="Apply Online for petrol pump franchisee" class="innerBanner-img">
    </picture>
    <h2 class="innerBanner-title">{!! $page[0]->banner_title !!}</h2>
</section>
@endif
@include('includes.bread-crumbs')
@if(count($team) > 0)
<div class="innerPage-content committee-page senior-managements">
    @php $counter = 0; @endphp
    @foreach($team as $senior_team)
    @if($senior_team->order == 1)
    <section class="board_section board_member_category1">
        <div class="board_inner_sec">
            <div class="board_person_blk_big">
                <div class="board_person_blk_inner" data-index="0">
                    <div class="board_person_img_blk_big">
                        <img src="{{Voyager::image($senior_team->image)}}" alt="Tony Fountain">
                    </div>
                    <div class="board_person_content_blk_big">
                        <div class="board_person_ttl_big">
                            {{ $senior_team->name }}
                        </div>
                        <div class="board_person_designation_big">
                            - {{ $senior_team->designation }}
                        </div>
                        <div class="board_person_content">
                            {!! substr($senior_team->description, 0, 160) !!} ...
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
    <section class="board_section board_member_category2">
        <div class="board_inner_sec">
            @else
            @if($senior_team->order == 2)
            @php $counter = 0; @endphp
            @endif
            <div class="board_person_blk">
                <div class="board_person_blk_inner" data-index="{{$counter}}">
                    <div class="board_person_img_blk">
                        <img src="{{Voyager::image($senior_team->image)}}" alt="Deepak kapoor">
                    </div>
                    <div class="board_person_content_blk">
                        <div class="board_person_ttl">
                            {{ $senior_team->name }}
                        </div>
                        <div class="board_person_designation">
                            - {{ $senior_team->designation }}
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
            @endif
            @php $counter++; @endphp
            @endforeach
        </div>
    </section>
    @php $counter = 0; @endphp
    @foreach($team as $senior_team)
    @if($senior_team->order == 1)
    <section class="board_committee_modal board_member_category1_modal">
        <div class="board_committee_popup">
            <div class="modal_slider">
                <div class="modal_slide" data-index="0">
                    <div class="close_modal">&times;</div>
                    <div class="modal_img">
                        <img src="{{Voyager::image($senior_team->image)}}" alt="chin">
                    </div>
                    <div class="modal_person_name center">
                        {{ $senior_team->name }}
                    </div>
                    <div class="modal_person_desgn center">
                        {{ $senior_team->designation }}
                    </div>
                    <div class="modal_person_brand center">
                        Nayara Energy Limited
                    </div>
                    <div class="modal_person_content">
                        {!! $senior_team->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="board_committee_modal board_member_category2_modal">
        <div class="board_committee_popup">
            <div class="modal_slider">
                @else
                @if($senior_team->order == 2)
                @php $counter = 0; @endphp
                @endif
                <div class="modal_slide" data-index="{{$counter}}">
                    <div class="close_modal">&times;</div>
                    <div class="modal_img">
                        <img src="{{Voyager::image($senior_team->image)}}" alt="chin">
                    </div>
                    <div class="modal_person_name center">
                        {{ $senior_team->name }}
                    </div>
                    <div class="modal_person_desgn center">
                        {{ $senior_team->designation }} 
                    </div>
                    <div class="modal_person_brand center">
                        Nayara Energy Limited
                    </div>
                    <div class="modal_person_content">
                        {!! $senior_team->description !!}
                    </div>
                </div>
                @endif
                @php $counter++; @endphp
                @endforeach
            </div>
        </div>
    </section>
</div>
@endif