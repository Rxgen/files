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
@php $counter = 0; @endphp
<div class="innerPage-content committee-page board-members">
    <section class="board_section board_member_category2">
        <div class="board_inner_sec">
            @foreach($team as $team_key => $team_value)
            <div class="board_person_blk">
                <div class="board_person_blk_inner" data-index="{{$team_key}}">
                    <div class="board_person_img_blk">
                        <img src="{{Voyager::image($team_value->image)}}" alt="Deepak kapoor">
                    </div>
                    <div class="board_person_content_blk">
                        <div class="board_person_ttl">
                            {{$team_value->name}}
                        </div>
                        <div class="board_person_designation">
                            - {{$team_value->designation}}
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
            @endforeach
        </div>
    </section>
    <section class="board_committee_modal board_member_category2_modal">
        <div class="board_committee_popup">
            <div class="modal_slider">
                @foreach($team as $team_popKey => $team_popValue)
                <div class="modal_slide" data-index="{{$team_popKey}}">
                    <div class="close_modal">&times;</div>
                    <div class="modal_img">
                        <img src="{{Voyager::image($team_popValue->image)}}" alt="chin">
                    </div>
                    <div class="modal_person_name center">
                        {{$team_popValue->name}}
                    </div>
                    <div class="modal_person_desgn center">
                        {{$team_popValue->designation}} 
                    </div>
                    <div class="modal_person_brand center">
                        Nayara Energy Limited
                    </div>
                    <div class="modal_person_content">
                        {!! $team_popValue->description !!}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>    
</div>
@endsection