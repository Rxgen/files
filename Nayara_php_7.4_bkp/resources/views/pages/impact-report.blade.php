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
@if(isset($reports) && !empty($reports))
<section class="investorPages-container">
    <h3 class="impact-policyTitle">Sustainability</h3>
    <div class="sustainability-container ec-compliance">
        <div class="sustainbility-title">Environment Clearance (EC) Compliance</div>
        <div class="governance-pdf-container all-reports-listingBlock wrap-clear">
        	@if(count($reports) > 0)
        	@foreach($reports as $report)
        	@php 
        	$file = json_decode($report->file);
        	@endphp
            <div class="pdfDownload-data">
                <img src="{{asset('images/pdf-img.png')}}" alt="pdf" class="pdfIcon">
                <div class="pdfdata-block">
                    <div class="pdf-name-title">
                    <span>Nayara Energy Limited </span>
                    {{$report->title}}</div>
                    <a href="{{ asset(Storage::url($file[0]->download_link))}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                        <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                    </a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    

    
            
                <div class="sustainability-container bio-medical-waste-report">
                    <div class="sustainbility-title">Bio-Medical Waste Reports</div>

                    <div class="data-filter-container">
                        <div class="data-filter type-container">
                            <!--<label for="bm-type">Select type</label>-->
                            <select name="type" id="bm-type" class="type select" data-year-api-route="{{ route('bio_medical_waste_report.get_year') }}">
                                <option value="select type" disabled selected>Select Type</option>
                                <option value="annual">annual</option>
                                <option value="monthly">monthly</option>
                            </select>
                        </div>

                        <div class="data-filter year-container hide-option" id='year-container'>
                            <!--<label for="bm-year">Select year</label>-->
                            <!-- <select name="year" id="bm-year" class="year">
                                <option value="select year" disabled selected>Select Year</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                            </select> -->
                        </div>

                        <div class="data-filter month-container hide-option" id='month-container'>
                            <!--<label for="bm-month">Select month</label>-->
                            <!-- <select name="month" id="bm-month" class="month">
                                <option value="select Month" disabled selected>Select month</option>
                                <option value="jan">Jan</option>
                                <option value="feb">Feb</option>
                                <option value="mar">Mar</option>
                                <option value="april">April</option>
                                <option value="may">May</option>
                                <option value="june">June</option>
                                <option value="july">July</option>
                                <option value="aug">Aug</option>
                                <option value="sept">Sept</option>
                                <option value="oct">Oct</option>
                                <option value="nov">Nov</option>
                                <option value="dec">dec</option>
                            </select> -->
                        </div>

                        <div class="data-filter site-container hide-option" id='site-container'>
                            <!--<label for="bm-site">Select site</label>-->
                            <!-- <select name="site" id="bm-site" class="site">
                                <option value="select site" disabled selected>Select Site</option>
                                
                                <option value="Nayara Energy Limited"></option>
                                
                            </select> -->
                        </div>
                    </div>

                    <div class="pdf-container governance-pdf-container all-reports-listingBlock wrap-clear hide-option" id="pdf-container">
                        <!-- <div class="pdfDownload-data">
                            <img src="https://www.nayaraenergy.com/images/pdf-img.png" alt="pdf" class="pdfIcon">
                            <div class="pdfdata-block">
                                <div class="pdf-name-title">
                                <span>Nayara Energy Limited</span>
                                Bio-Medical Waste Management Rules-2016</div>
                                <a href="/storage/bio-medical-waste-reports\March2021\P95ydu9e454MH7PSBSao.pdf" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                                    <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                                </a>
                            </div>
                        </div> -->
                    </div>
                    
                    <div class="report-container hide-option" id="report-container">
                        <!-- <table class="table-bordered table-striped table-condensed cf">
                            <thead class="cf">
                                <tr>
                                    <th style="width:50%;">
                                        Locations
                                    </th>
                                    <th>
                                        Biomedical Wastes Categories
                                    </th>
                                    <th class="numeric" id="tdMonth">
                                        Mar-2020<br>(kg)
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="yellowbg">
                                    <td class="mobg" data-title="Locations" id="tdSite" rowspan="4">
                                        KGD6 (Occupational Health Centre)
                                    </td>
                                    <td data-title="Biomedical Wastes Categories">
                                        <span class="yellow"></span>Yellow
                                    </td>
                                    <td class="numeric" data-title="Jan-19" id="tdYellow">0.70</td>
                                </tr>
                                <tr>
                                    <td class="redbg" data-title="Biomedical Wastes Categories">
                                        <span class="red"></span>Red</td>
                                    <td class="numeric redbg" data-title="Jan-19" id="tdRed">3.94</td>
                                </tr>
                                <tr class="whitebg">
                                    <td data-title="Biomedical Wastes Categories">
                                        <span class="white"></span>White</td>
                                    <td class="numeric" data-title="Jan-19" id="tdWhite">0.17</td>
                                </tr>
                                <tr class="bluebg1">
                                    <td data-title="Biomedical Wastes Categories">
                                        <span class="blue"></span>Blue</td>
                                    <td class="numeric" data-title="Jan-19" id="tdBlue">0.03</td>
                                </tr>
                            </tbody>
                        </table> -->
                    </div>
                </div>
            </div>
        </section>
</section>
@endif
@stop