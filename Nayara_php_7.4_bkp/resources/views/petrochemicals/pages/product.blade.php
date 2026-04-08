   <div class="innerPage-content page-investors-notices investorPages-container">
     <h4 class="investor-pagesTitle theme-gradient-alpha gradient-text">Polypropylene</h4>
                <div class="notices-container p-accordion">
                    <div class="notices-wrapper">
                    @foreach($petrochemicalsProducts as $product)
                        <h5 class="notices-heading">{{$product->name}}<div class="arrow-title"></div>
                        </h5>
                        <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear ">
                            <p>{{$product->description}}</p>
                            <div class="table-wrapper">
                                <table style="width:100%">
                                    <tr>
                                        <th>Grade</th>
                                        <th>MFI</th>
                                        <th>Description</th>
                                        <th>TDS</th>
                                        <th>MSDS</th>
                                        <th>Regulatory Documents</th>
                                    </tr>
                                    @foreach($product->product_types as $productchild)
                                    <tr>
                                        <td>{{$productchild->grade}}</td>
                                        <td>{{$productchild->mfi}}</td>
                                        <td>{{$productchild->description}}</td>
                                        <td>
                                            <div class="pdfDownload-data">
                                                <img src="assets/images/pdf-img.png" alt="pdf" class="pdfIcon">
                                                <div class="pdfdata-block">
                                                    <div class="pdf-name-title">
                                                    </div>
                                                    @foreach(json_decode($productchild->tds) as $value)
                                                        
                                                    <a href= "{{(Storage::url($value->download_link))}}" 
                                                        class="cta gradient-cta theme-gradient form-cta steps-form-cta" download >
                                                        <span
                                                            class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                                                    </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="pdfDownload-data">
                                                <img src="assets/images/pdf-img.png" alt="pdf" class="pdfIcon">
                                                <div class="pdfdata-block">
                                                    <div class="pdf-name-title">
                                                    </div>
                                                    @foreach(json_decode($productchild->msds) as $value)
                                                    <a href="{{(Storage::url($value->download_link))}}"
                                                        class="cta gradient-cta theme-gradient form-cta steps-form-cta" download>
                                                        <span
                                                            class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                                                    </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="pdfDownload-data">
                                                <img src="assets/images/pdf-img.png" alt="pdf" class="pdfIcon">
                                                <div class="pdfdata-block">
                                                    <div class="pdf-name-title">
                                                    </div>
                                                    @foreach(json_decode($productchild->regulatory_document) as $value)
                                                    <a href="{{(Storage::url($value->download_link))}}"
                                                        class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                                                        <span
                                                            class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                                                    </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach   
                                </table>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
 </div>
