@extends('layouts.welcome')
@section('content')
<section class="innerPage-banner-container fleetBanner investors-governance-banner">
            <picture>
                <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
                <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="Fleet Plus" class="innerBanner-img" width="1920" height="419" />
            </picture>
            <h1 class="innerBanner-title "><img src="{{asset('images/fleet_plus/banner_logo.webp')}}" alt="Fleet Plus" width="929" height="140" class="fleet_logo" /> {!! $page[0]->banner_title !!}</h1>
        </section>
        @include('includes.bread-crumbs')
    <section class="fleet_features">
            <div class="fleet_title">Save Upto &#x20b9; 2</div>
            <div class="fleet_sub_title">per litre on diesel</div>
            <div class=""></div>
            <div class="board_section board_member_category2">
                <div class="board_inner_sec">
                    <div class="board_person_blk ia-circle_blk">
                        <div class="board_person_blk_inner assets-inner" data-index="0">
                            <div class="retail-network-join__cta">
                                <img src="{{ asset('/images/fleet_plus/icons/img_1.webp') }}" alt="Image1" srcset="" width="102" height="95">
                            </div>
                            <p>Effortless Transactions Based <br />On Vehicle Number Plate</p>
                        </div>
                    </div>
                    
                    <div class="board_person_blk ia-circle_blk">
                        <div class="board_person_blk_inner assets-inner" data-index="1">
                            <div class="retail-network-join__cta">
                                <img src="{{ asset('/images/fleet_plus/icons/img_2.webp') }}" alt="img_2" srcset="" width="102" height="95">
                            </div>
                            <p>Diesel Expense <br />Management</p>
                        </div>
                    </div>
    
                    <div class="board_person_blk ia-circle_blk">
                        <div class="board_person_blk_inner assets-inner" data-index="2">
                            <div class="retail-network-join__cta">
                                <img src="{{ asset('images/fleet_plus/icons/img_3.webp') }}" alt="image3" srcset="" width="102" height="95">
                            </div>
                            <p>Multiple Payment <br />Modes</p>
                        </div>
                    </div>
                    
                    <div class="board_person_blk ia-circle_blk">
                        <div class="board_person_blk_inner assets-inner" data-index="3">
                            <div class="retail-network-join__cta">
                                <img src="{{ asset('images/fleet_plus/icons/img_4.webp') }}" alt="Image4" srcset="" width="102" height="95">
                            </div>
                            <p>Retail Automation Based <br />Billing</p>
                        </div>
                    </div>
    
                    <div class="board_person_blk ia-circle_blk">
                        <div class="board_person_blk_inner assets-inner" data-index="4">
                            <div class="retail-network-join__cta">
                                <img src="{{ asset('images/fleet_plus/icons/img_5.webp') }}" alt="Image5" srcset="" width="102" height="95">
                            </div>
                            <p>Redeem Fuel Against <br />Points</p>
                        </div>
                    </div>
                    
            </div>
        </section>
        <section class="reward_structure">
            <h2 class="reward_title">Reward Structure</h2>
            <div class="table-wrap">
                <table class="reward_table">
                    <tr>
                        <th>MONTHLY CONSUMPTION KL</th>
                        <td>5-10</td>
                        <td>10-25</td>
                        <td>25-50</td>
                        <td>50-150</td>
                        <td>
                            KEY ACCOUNTS <br />
                            (150 & ABOVE)
                        </td>
                    </tr>
                    <tr>
                        <th>
                            BASE REWARDS <br />
                            ( PER LITRE-MONTHLY)
                        </th>
                        <td>0.75</td>
                        <td>0.80</td>
                        <td>0.85</td>
                        <td>1.00</td>
                        <td>2.00</td>
                    </tr>
                    <tr>
                        <th>
                            BONUS REWARDS <br />
                            ( PER LITRE-QUARTERLY)
                        </th>
                        <td>-</td>
                        <td>0.20</td>
                        <td>0.50</td>
                        <td>0.50</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <th>
                            TOTAL REWARDS <br />
                            ( PER LITRE)
                        </th>
                        <td>0.75</td>
                        <td>1.00</td>
                        <td>1.35</td>
                        <td>1.50</td>
                        <td>2.00</td>
                    </tr>
                </table>
            </div>
            <div class="reward_description">Rewards value per litre is subject to monthly fuel purchase. T&C apply.</div>
        </section>

        <section class="fleet_reward">
           <div class="reward_text">
               <span class="textBlue">Fleet<span class="textGreen">PIus</span></span> is a diesel expense management program for fleet <br />
               owners, their office managers and drivers.
           </div>
           <h2 class="reward_title">How to Earn Rewards</h2>
           <div class="reward_img">
               <img src="{{ asset('images/fleet_plus/rewards.webp') }}" alt="rewards" class="" width="1348" height="615" />
           </div>
        </section>


        <section class="fleet_contact">
            <div class="reward_text">
                TO KNOW HOW <span class="textBlue">Fleet<span class="textGreen">PIus</span></span> <br />
                CAN HELP YOU CALL
           </div>
           <a href="tel:+1800 1200 330" class="call_link">1800 1200 330</a>
           <div class="office_time">9:00 AM - 11:30 PM (Monday - Saturday)</div>
           <div class="fleet_scanner">
               <img src="{{ asset('images/fleet_plus/fleet_qr.webp') }}" alt="Fleet Qr" width="435" height="435" class="fleet_qr" />
               <div class="scanner_text">AVAILABLE ON PLAYSTORE</div>
           </div>
        </section>   
@stop