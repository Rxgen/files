@extends('layouts.welcome')
@section('content')
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="$page[0]->img_alt" class="innerBanner-img">
    </picture>
    <h2 class="innerBanner-title">{!! $page[0]->banner_title !!}</h2>
</section>
@include('includes.bread-crumbs')
<section class="investor_education_container">
 <div class="investor_title">Details of amounts unclaimed by investors and due to be transferred to Investor Education and protection Fund (IEPF).</div>     
<div class="table-wrap">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <th>Name of Investor</th>
                    <td>{{ $investorDetails->investor_firstname }}
                    @if (!empty($investorDetails->investor_middlename))
                               {{ $investorDetails->investor_middlename }}
                    @endif
                        @if (!empty($investorDetails->investor_lastname))
                                   {{ $investorDetails->investor_lastname }}
                   @endif  </td>
                    
                </tr>
                <tr>
                    <th>Registered Address</th>
                    <td>{{ $investorDetails->address }}</td>   
                </tr>
            </tbody>
        </table>
    </div>
    <div class="table-wrap">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <th>Nature Of Amount</th>
                    <th>Amount entitled to Investor as on March 31, 2024</th>
                    <th>Due date of transfer of amount to IEPF</th>
                </tr>
                @foreach($Iepfusers as $Iepfuser)
                <tr>
                    <td>{{ $Iepfuser->investment_type}}</td>
                    <td>{{ $Iepfuser->amount_transferred}}</td>
                    <td>{{ $Iepfuser->proposed_date}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="user_end">
        <p>For claiming the aforesaid amount, please contact our Registrar and Transfer Agents – Link Intime India Private Limited at 
<a href="mailto:rnt.helpdesk@linkintime.co.in" class="showMail">rnt.helpdesk@linkintime.co.in</a> 
with a copy to us at  
<a href="mailto:investors@nayaraenergy.com" class="showMail">investors@nayaraenergy.com</a>. </p>
    
        <p>Please note that Company will transfer the aforesaid amount to IEPF as per the due dates stated above.</p>
    </div>
</section>
@stop