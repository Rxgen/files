@foreach($site_details as $site_detail)
@php 
        	$file = json_decode($site_detail->file);
            
        	@endphp
<div class="pdfDownload-data">
                            <img src="https://www.nayaraenergy.com/images/pdf-img.png" alt="pdf" class="pdfIcon">
                            <div class="pdfdata-block">
                                
                                <div class="pdf-name-title">
                                <span>{{ $site_detail->site_name }}</span>
                                Bio Medical Waste Management Annual Report</div>
                                
                                
                                <a href="{{ asset(Storage::url($file[0]->download_link))}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                                    <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                                </a>
                                
                            </div>
                        </div>
@endforeach