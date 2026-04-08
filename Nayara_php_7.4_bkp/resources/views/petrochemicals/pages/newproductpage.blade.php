<section class="investorPages-container" style="margin-bottom: 7vw;">
<div class="innerPage-content page-investors-notices">
    <h2 class="investor-pagesTitle theme-gradient-alpha gradient-text">Polypropylene Grades</h2>
    <div class="all-reports- wrap-clear heading-para-content para-padding ">
    @foreach($petrochemicalsProducts as $product)
        <p>{{$product->description}}</p>
         <div class="table-wrap">
            <table style="width:100%">
                <tr>
                    <th>Application</th>
                    <th>Grade <br> name</th>
                    <th>MFI <br><span style="color:black;font-size:10px;">(230&deg; C/2.16 kg) in g/10 min</span></th>
                    <th>Typical applications</th>
                    <th>TDS</th>
                    <th>Regulatory Document</th>
                </tr>
                @foreach($product->product_types as $productchild)
                <tr>
                    <td>{{$productchild->description}}</td>
                    <td>{{$productchild->grade}}</td>
                    <td>{{$productchild->mfi}}</td>
                    <td>{{$productchild->typical_application}}</td>
                    <td>
                        <div class="pdfDownload-dat pdfdata-block">
                            <div class="pdf-name-title">
                            </div>
                            @foreach(json_decode($productchild->tds) as $value)
                            <a href="{{(url(Storage::url($value->download_link)))}}" class="cta gradient-cta theme-gradient form-cta steps-form-cta" download="{{ $value->original_name }}">
                                <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                            </a>
                            @endforeach
                        </div>
                </div>
            </td>
            <td>
    <div class="pdfDownload-dat pdfdata-block">
        <div class="pdf-name-title">
        </div>
        @php
            $decodedDocuments = json_decode($productchild->regulatory_document);
        @endphp
        
        @if(!empty($productchild->regulatory_document) && (is_array($decodedDocuments) || is_object($decodedDocuments)))
            @foreach($decodedDocuments as $value)
                <a href="{{ url(Storage::url($value->download_link)) }}" class="cta gradient-cta theme-gradient form-cta steps-form-cta" download="{{ $value->original_name }}">
                    <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                </a>
            @endforeach
        @endif
    </div>
</td>
             </tr>
             @endforeach
        </table>
    </div>
    @endforeach
</div>
<a style="color: #054289;margin-top:20px;display: inline-block;" href="{{asset('MSDS_Polyproylene_Homopolymer.pdf')}}" target="_blank" rel="noopener"> MSDS - Nayara PP Homopolymer</a>

<a style="color: #054289;margin-top:20px;display: block;" href="{{asset('NAYARA_PP SHELF_LIFE_DECLARATION.pdf')}}" target="_blank" rel="noopener"> Shelf Life declaration - Nayara PP Homopolymer</a>
</section>
