@extends('layouts.static')
@section('content')
@if(count($page) > 0)
<section class="innerPage-banner-container">
    <picture>
        <source media="(max-width: 767px)" srcset="{{Voyager::image($page[0]->mobile_banner)}}" />
        <img src="{{Voyager::image($page[0]->desktop_banner)}}" alt="{{$page[0]->img_alt}}" title="{{$page[0]->img_title}}" class="innerBanner-img">
    </picture>
    <h2 class="innerBanner-title">{!! $page[0]->banner_title !!}</h2>
</section>
@endif
@include('includes.bread-crumbs')
<section class="innerPage-content investorPages-container page-investors-notices">
    <h4 class="investor-pagesTitle theme-gradient-alpha gradient-text">Investors</h4>

    <div class="notices-container">
        <div class="notices-wrapper active">
            <h5 class="notices-heading">Nayara Energy Limited<div class="arrow-title"></div></h5>
            <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear">
            <div class="panTitle-heading">
               <span>ISIN No. - INE011A01019</span>
               <span>PAN No. - AAACE0890P</span> 
            </div>  
                <div class="investor-contactContent-block">
                    <h3 class="investor-addressTitle">Registered Office </h3>
                    <!-- <div class="investor-small-para">Name : Nayara Energy Ltd.</div> -->
                    <div class="investorContact-detailContainer wrap-clear">
                        <div class="investorAddress-block">
                            <div class="investorAddress-title">Nayara Energy Limited</div>
                            <address>
                                Khambhalia Post, P O Box 24, District Devbhumi<br>
                                Dwarka - 361 305, <br>
                                Gujarat, India<br>
                            </address>
                        </div>
                        <div class="investorMiddle-block">

                            <div class="investorPhone-block investorIcons-block"> <img src="https://www.nayaraenergy.com/storage/pages/May2019/investor-phone.png" alt="phone" class="investorIcon"> 
                                <div  class="investorIcons_content">
                                    <div class="investorIcons-title">Telephone</div> 
                                    <div class="investorIcons-data">
                                        <a href="tel:02833661444">02833 661 444</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="investor-contactContent-block">
                    <h3 class="investor-addressTitle">Corporate Office </h3>
                    <!-- <div class="investor-small-para">Name : Nayara Energy Ltd.</div> -->
                    <div class="investorContact-detailContainer wrap-clear">
                        <div class="investorAddress-block">
                            <div class="investorAddress-title">Nayara Energy Limited</div>
                            <address>
                                5th Floor, Jet Airways Godrej BKC, <br>
                                Plot No. C-68, G Block, <br>
                                Bandra Kurla Complex, Bandra East, <br>
                                Mumbai - 400 051, Maharashtra, India
                            </address>
                        </div>
                    </div>
                </div>


                <div class="investor-contactContent-block">
                    <h3 class="investor-addressTitle">Company Secretary (Nodal Officer for IEPF)</h3>
                    <!-- <div class="investor-small-para">Name : Nayara Energy Limited </div> -->
                    <div class="investorContact-detailContainer wrap-clear">
                        <div class="investorAddress-block">
                            <div class="investorAddress-title">Nayara Energy Limited</div>
                            <address>
                            5th Floor, Jet Airways Godraj BKC, <br>
                            Bandra Kurla Complex, Bandra East, <br>
                            Mumbai – 400051 <br>
                            Maharashtra, India
                            </address>
                        </div>
                        <div class="investorMiddle-block">
                            
                            <div class="investorPhone-block investorIcons-block"> <img src="https://www.nayaraenergy.com/storage/pages/May2019/investor-phone.png" alt="phone" class="investorIcon"> 
                            <div  class="investorIcons_content">
                                <div class="investorIcons-title">Telephone</div> 
                                <div class="investorIcons-data">
                                    <a href="tel:+912266121800">+91-22-66121800 </a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="investorLast-block">
                            
                            <div class="investorEmail-block investorIcons-block"> <img src="https://www.nayaraenergy.com/storage/pages/May2019/investor-email.png" alt="email" class="investorIcon">
                                <div class="investorIcons_content">  
                                    <div class="investorIcons-title">Email:</div>
                                    <div class="investorIcons-data">  
                                        <a href="mailto:Nayaraenergy@datamaticsbpm.com">companysec@nayaraenergy.com</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="investor-contactContent-block">
                    <h3 class="investor-addressTitle">Registrar and Share Transfer Agent (w.e.f. October 1, 2019):</h3>
                    <!-- <div class="investor-small-para">Name : Datamatics Business Solutions Limited</div> -->
                    <div class="investorContact-detailContainer wrap-clear">
                        <div class="investorAddress-block">
                            <div class="investorAddress-title">Link Intime India Pvt Ltd</div>
                            <address>
                                C-101,247 Park, LBS Marg <br>
                                Vikhroli (West), Mumbai 400 083
                            </address>
                        </div>
                        <div class="investorMiddle-block">
                            <!-- <div class="investorWebsite-block investorIcons-block"> <img src="http://182.76.150.26/nayara-energy/public//storage/pages/May2019/investor-web.png" alt="web" class="investorIcon">
                                <div  class="investorIcons_content">
                                    <div class="investorIcons-data">
                                        <a href="https://www.datamaticsbpm.com/" target="_blank">www.datamaticsbpm.com</a>
                                    </div>
                                </div>
                            </div> -->
                            <div class="investorPhone-block investorIcons-block"> <img src="https://www.nayaraenergy.com/storage/pages/May2019/investor-phone.png" alt="phone" class="investorIcon"> 
                            <div  class="investorIcons_content">
                                <div class="investorIcons-title">Telephone</div> 
                                <div class="investorIcons-data">
                                    <a href="tel:+91 22 4918 6000">+91 22 4918 6000 </a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="investorLast-block">
                            <div class="investorFax-block investorIcons-block"><img src="https://www.nayaraenergy.com/storage/pages/May2019/investor-fax.png" alt="fax" class="investorIcon">
                                <div class="investorIcons_content"> 
                                    <div class="investorIcons-title">Fax:</div>
                                    <div class="investorIcons-data"> 
                                        <a href="javascript:;">+91 22 4918 6060
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="investorEmail-block investorIcons-block"> <img src="https://www.nayaraenergy.com/storage/pages/May2019/investor-email.png" alt="email" class="investorIcon">
                                <div class="investorIcons_content">  
                                    <div class="investorIcons-title">Email:</div>
                                    <div class="investorIcons-data">  
                                        <a href="mailto:rnt.helpdesk@linkintime.co.in">rnt.helpdesk@linkintime.co.in</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="investor-contactContent-block">
                    <h3 class="investor-addressTitle">Shareholder’s Contact</h3>
                    <div class="investor-small-para">Name : Mr P Radhakrishnan Unnithan: Jt. General Manager – Secretarial</div>
                    <div class="investorContact-detailContainer wrap-clear">
                        <div class="investorAddress-block">
                            <div class="investorAddress-title">Nayara Energy Limited (Formerly known as Essar Oil Limited)</div>
                            <address>
                            5th Floor, Jet Airways Godraj BKC,<br>
                            Bandra Kurla Complex, Bandra East,<br>
                            Mumbai – 400051<br>
                            Maharashtra, India 
                            </address>
                        </div>
                        <div class="investorMiddle-block">
                            <!-- <div class="investorWebsite-block investorIcons-block"> <img src="http://182.76.150.26/nayara-energy/public//storage/pages/May2019/investor-web.png" alt="web" class="investorIcon">
                                <div  class="investorIcons_content">
                                    <div class="investorIcons-data">
                                        <a href="https://www.datamaticsbpm.com/" target="_blank">www.datamaticsbpm.com</a>
                                    </div>
                                </div>
                            </div> -->
                            <div class="investorPhone-block investorIcons-block"> <img src="https://www.nayaraenergy.com/storage/pages/May2019/investor-phone.png" alt="phone" class="investorIcon"> 
                            <div  class="investorIcons_content">
                                <div class="investorIcons-title">Telephone</div> 
                                <div class="investorIcons-data">
                                    <a href="tel:+91-22-66121800">+91-22-66121800</a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="investorLast-block">
                            
                            <div class="investorEmail-block investorIcons-block"> <img src="https://www.nayaraenergy.com/storage/pages/May2019/investor-email.png" alt="email" class="investorIcon">
                                <div class="investorIcons_content">  
                                    <div class="investorIcons-title">Email:</div>
                                    <div class="investorIcons-data">  
                                        <a href="mailto:investors@nayaraenergy.com">investors@nayaraenergy.com</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="notices-wrapper ">
            <h5 class="notices-heading">Vadinar Oil Terminal Limited<div class="arrow-title"></div></h5>
           
            <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear">
                <div class="panTitle-heading">
                    <span>ISIN No. - INE463G01019</span>
                    <span>PAN No. - AABCV2626D</span> 
                </div> 
                <div class="investor-contactContent-block">
                    <h3 class="investor-addressTitle">Registered Office </h3>
                    <!-- <div class="investor-small-para">Name : Vadinar Oil Terminal Ltd.</div> -->
                    <div class="investorContact-detailContainer wrap-clear">
                        <div class="investorAddress-block">
                            <div class="investorAddress-title">Vadinar Oil Terminal Ltd.</div>
                            <address>
                                Khambhalia Post, P O Box 24, District Devbhumi<br> 
                                Dwarka - 361 305, <br>
                                Gujarat, India<br>
                            </address>
                        </div>
                        <div class="investorMiddle-block">

                            <div class="investorPhone-block investorIcons-block"> <img src="https://www.nayaraenergy.com/storage/pages/May2019/investor-phone.png" alt="phone" class="investorIcon"> 
                                <div  class="investorIcons_content">
                                    <div class="investorIcons-title">Telephone</div> 
                                    <div class="investorIcons-data">
                                        <a href="tel:02833 661 444">02833 661 444</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="investor-contactContent-block">
                    <h3 class="investor-addressTitle">Corporate Office </h3>
                    <!-- <div class="investor-small-para">Name : Vadinar Oil Terminal Limited</div> -->
                    <div class="investorContact-detailContainer wrap-clear">
                        <div class="investorAddress-block">
                            <div class="investorAddress-title">Vadinar Oil Terminal Limited</div>
                            <address>
                                5th Floor, Jet Airways Godrej BKC, <br>
                                Plot No. C-68, G Block,<br> 
                                Bandra Kurla Complex, Bandra East,<br> 
                                Mumbai - 400 051, Maharashtra, India
                            </address>
                        </div>
                    </div>
                </div>


                <div class="investor-contactContent-block">
                    <h3 class="investor-addressTitle">Company Secretary</h3>
                    <!-- <div class="investor-small-para">Name : Vadinar Oil Terminal Limited </div> -->
                    <div class="investorContact-detailContainer wrap-clear">
                        <div class="investorAddress-block">
                            <div class="investorAddress-title">Vadinar Oil Terminal Limited</div>
                            <address>
                            5th Floor, Jet Airways Godraj BKC,<br> 
                            Bandra Kurla Complex, Bandra East,<br> 
                            Mumbai – 400051 <br> 
                            Maharashtra, India<br> 
                            </address>
                        </div>
                        <div class="investorMiddle-block">
                            
                            <div class="investorPhone-block investorIcons-block"> <img src="https://www.nayaraenergy.com/storage/pages/May2019/investor-phone.png" alt="phone" class="investorIcon"> 
                            <div  class="investorIcons_content">
                                <div class="investorIcons-title">Telephone</div> 
                                <div class="investorIcons-data">
                                    <a href="tel:+91-22-66121800">+91-22-66121800 </a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="investorLast-block">
                            
                            <div class="investorEmail-block investorIcons-block"> <img src="https://www.nayaraenergy.com/storage/pages/May2019/investor-email.png" alt="email" class="investorIcon">
                                <div class="investorIcons_content">  
                                    <div class="investorIcons-title">Email:</div>
                                    <div class="investorIcons-data">  
                                        <a href="mailto:votlcosec@nayaraenergy.com">votlcosec@nayaraenergy.com</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="investor-contactContent-block">
                    <h3 class="investor-addressTitle">Registrar and Share Transfer Agent </h3>
                    <!-- <div class="investor-small-para">Name : Data Software Research Company Private Limited </div> -->
                    <div class="investorContact-detailContainer wrap-clear">
                        <div class="investorAddress-block">
                            <div class="investorAddress-title">Data Software Research Company Private Limited</div>
                            <address>
                                Unit : Vadinar Oil Terminal Limited<br>
                                Kasturi Towers,<br> #11 Smith Road,<br> Chennai – 600 002
                            </address>
                        </div>
                        <div class="investorMiddle-block">
                            <div class="investorWebsite-block investorIcons-block"> <img src="https://www.nayaraenergy.com/storage/pages/May2019/investor-web.png" alt="web" class="investorIcon">
                                <div  class="investorIcons_content">
                                    <div class="investorIcons-data">
                                        <a href="https://www.dsrc.com/" target="_blank">www.dsrc.com</a>
                                    </div>
                                </div>
                            </div>
                            <div class="investorPhone-block investorIcons-block"> <img src="https://www.nayaraenergy.com/storage/pages/May2019/investor-phone.png" alt="phone" class="investorIcon"> 
                            <div  class="investorIcons_content">
                                <div class="investorIcons-title">Telephone</div> 
                                <div class="investorIcons-data">
                                    <a href="tel:+91 44 4510 5000">+91 44 4510 5000</a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="investorLast-block">
                            <div class="investorFax-block investorIcons-block"><img src="https://www.nayaraenergy.com/storage/pages/May2019/investor-fax.png" alt="fax" class="investorIcon">
                                <div class="investorIcons_content"> 
                                    <div class="investorIcons-title">Fax:</div>
                                    <div class="investorIcons-data"> 
                                        <a href="javascript:;">+91 44 45105001</a>
                                    </div>
                                </div>
                            </div>
                            <div class="investorEmail-block investorIcons-block"> <img src="https://www.nayaraenergy.com/storage/pages/May2019/investor-email.png" alt="email" class="investorIcon">
                                <div class="investorIcons_content">  
                                    <div class="investorIcons-title">Email:</div>
                                    <div class="investorIcons-data">  
                                        <a href="mailto:votl@dsrc-cid.in">votl@dsrc-cid.in</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="investor-contactContent-block">
                    <h3 class="investor-addressTitle">Shareholder’s Grievance Redressal</h3>
                    <div class="investor-small-para">Name : Mr P Radhakrishnan Unnithan</div>
                    <div class="investorContact-detailContainer wrap-clear">
                        <div class="investorAddress-block">
                            <div class="investorAddress-title">Vadinar Oil Terminal Limited</div>
                            <address>
                            5th Floor, Jet Airways Godraj BKC,<br>
                            Bandra Kurla Complex, Bandra East,<br>
                            Mumbai – 400051 <br>
                            Maharashtra, India<br>
                            </address>
                        </div>
                        <div class="investorMiddle-block">
                            
                            <div class="investorPhone-block investorIcons-block"> <img src="https://www.nayaraenergy.com/storage/pages/May2019/investor-phone.png" alt="phone" class="investorIcon"> 
                            <div  class="investorIcons_content">
                                <div class="investorIcons-title">Telephone</div> 
                                <div class="investorIcons-data">
                                    <a href="tel:+91-22-66121800">+91-22-66121800</a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="investorLast-block">
                            
                            <div class="investorEmail-block investorIcons-block"> <img src="http://182.76.150.26/nayara-energy/public//storage/pages/May2019/investor-email.png" alt="email" class="investorIcon">
                                <div class="investorIcons_content">  
                                    <div class="investorIcons-title">Email:</div>
                                    <div class="investorIcons-data">  
                                        <a href="mailto:votlcosec@nayaraenergy.com">votlcosec@nayaraenergy.com</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="notices-wrapper ">
            <h5 class="notices-heading">Investor Education and Protection Fund of Nayara Energy Limited <div class="arrow-title"></div></h5>
           
            <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear">
                <div class="pdfDownload-data">
                    <img src="https://www.nayaraenergy.com/storage/pages/May2019/pdf-img.png" alt="pdf" class="pdfIcon">
                    <div class="pdfdata-block">
                        <div class="pdf-name-title">
                            Investor Education and Protection Fund of Nayara Energy Limited                                    </div>
                        <a href="https://www.nayaraenergy.com/storage/pages/April2019/Investors_PDF.pdf" class="cta gradient-cta theme-gradient form-cta steps-form-cta">
                            <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <div class="notices-wrapper governance-tab-content">
            <h5 class="notices-heading">Major terms and conditions of appointment of Independent Directors of Nayara Energy Limited<div class="arrow-title"></div></h5>
            <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear">
                <p>The Independent Directors will serve for a period of five years from the date of their respective appointments. The board may invite the Independent Directors to continue on as an Independent director for an additional period there after subject to recommendation by the Nomination and Remuneration Committee and approval of shareholders.</p>

                <p>The Board determines the level of remuneration paid to its non-executive members including Independent Directors within any limitations imposed by shareholders. Presently, the Company pays to independent directors sitting fee of Rs. 1,00,000 for attending each meeting of the Board and each meeting of Committees of which they are members and meeting of Independent Directors. In addition the independent directors are entitled to payment of Commission not exceeding 1% of net profits of the Company computed in accordance with the provisions of section 198 of the Act, for the respective financial years. TDS is deducted at applicable rates from the sitting fee / commission. The Company will reimburse the Directors for all direct and indirect expenses such as toll calls, accommodation and travelling expenses, reasonably and properly incurred and documented.</p>
                <p><strong>The directors shall abide by the following duties provided in section 166 of the Companies Act, 2013:</strong></p>
                <ul class="investor-contact-listBlock">
                    <li>
                        <p>Subject to the provisions of the Act, the directors shall act in accordance with the Articles of Association of the company</p>
                    </li>
                    <li>
                        <p>Directors shall act in good faith in order to promote the objects of the Company for the benefit of its members as a whole, and in the best interests of the company, its employees, the shareholders, the community and for the protection of environment.</p>
                    </li>
                    <li>
                        <p>Directors shall exercise duties with due and reasonable care, skill and diligence and shall exercise independent judgment.</p>
                    </li>
                    <li>
                        <p>Directors shall not involve in a situation in which they may have a direct or indirect interest that conflicts, or possibly may conflict, with the interest of the Company.</p>
                    </li>
                    <li>
                        <p>The Directors shall not achieve or attempt to achieve any undue gain or advantage either to themselves or to their relatives, partners or associates and if such director is found guilty of making any undue gain, he / she shall be liable to pay an amount equal of that gain to the Company.</p>
                    </li>
                    <li>
                        <p>The Directors shall not assign their office and any assignment so made shall be void.</p>
                    </li>
                </ul>

                <p>Further, Independent Directors shall have to ensure the following in compliance with Schedule IV read with section 149(8) of the Act.</p>
                <ul class="investor-contact-listBlock">
                    <li>
                        <p>Undertake appropriate induction and regularly update and refresh their skills, knowledge and familiarity with the Company.</p>
                    </li>
                    <li>
                        <p>Seek appropriate clarification or amplification of information and, where necessary, take and follow appropriate professional advice and opinion of outside experts at the expense of the Company.</p>
                    </li>
                    <li>
                        <p>Strive to attend all meetings of the Board of Directors and of the Board committees of which they are a member</p>
                    </li>
                    <li>
                        <p>Participate constructively and actively in the committees of the Board in which they are chairpersons or members</p>
                    </li>
                    <li>
                        <p>Strive to attend the general meetings of the Company</p>
                    </li>
                    <li>
                        <p>Where they have concerns about the running of the Company or a proposed action, ensure that these are addressed by the Board and, to the extent that they are not  resolved, insist that their concerns are recorded in the minutes of the Board meeting.</p>
                    </li>
                    <li>
                        <p>Keep themselves well informed about the Company and the external environment in which it operates.</p>
                    </li>
                    <li>
                        <p>Not to unfairly obstruct the functioning of an otherwise proper Board or Committee of the Board.</p>
                    </li>
                    <li>
                        <p>Pay sufficient attention and ensure that adequate deliberations are held before approving related party transactions and assure themselves that the same are in the interest of the Company.</p>
                    </li>
                    <li>
                        <p>Pay sufficient attention and ensure that adequate deliberations are held before approving related party transactions and assure themselves that the same are in the interest of the Company.</p>
                    </li>
                    <li>
                        <p>Ascertain and ensure that the Company has an adequate and functional vigil mechanism and to ensure that the interests of a person who uses such mechanism are not prejudicially affected on account of such use.</p>
                    </li>
                    <li>
                        <p>Report concerns about unethical behaviour, actual or suspected fraud or violation of the company’s code of conduct.</p>
                    </li>
                    <li>
                        <p>Acting within their authority, assist in protecting the legitimate interests of the Company, shareholders and its employees.</p>
                    </li>
                    <li>
                        <p>Not disclose confidential information, including commercial secrets, technologies, advertising and sales promotion plans, unpublished price sensitive information, unless such disclosure is expressly approved by the Board or required by law.</p>
                    </li>
                    <li>
                        <p>Shall maintain professional conduct and abide by the role, responsibilities and other provisions set out in schedule IV of the Companies Act, 2013 pursuant to section 149(8) of the Act.</p>
                    </li>
                </ul>

            </div>
        </div>

        <div class="notices-wrapper">
            <h5 class="notices-heading">Annual Return FY 2017-18 of Nayara Energy Limited <div class="arrow-title"></div></h5>
            <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear">
                <div class="pdfDownload-data">
                    <img src="https://www.nayaraenergy.com/storage/pages/May2019/pdf-img.png" alt="pdf" class="pdfIcon">
                    <div class="pdfdata-block">
                        <div class="pdf-name-title">
                            Annual Return FY 2017-18 of Nayara Energy Limited                                   </div>
                        <a href="https://www.nayaraenergy.com/storage/pages/July2019/Annual Return FY 2017-18 of Nayara Energy Limited.pdf" class="cta gradient-cta theme-gradient form-cta steps-form-cta" download>
                            <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <div class="notices-wrapper">
            <h5 class="notices-heading">Annual Return FY 2017-18 of Vadinar Oil Terminal Limited <div class="arrow-title"></div></h5>
            <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear">
                <div class="pdfDownload-data">
                    <img src="https://www.nayaraenergy.com/storage/pages/May2019/pdf-img.png" alt="pdf" class="pdfIcon">
                    <div class="pdfdata-block">
                        <div class="pdf-name-title">
                            Annual Return FY 2017-18 of Vadinar Oil Terminal Limited                                   </div>
                        <a href="https://www.nayaraenergy.com/storage/pages/July2019/Annual Return FY 2017-18 of Vadinar Oil Terminal Limited.pdf" class="cta gradient-cta theme-gradient form-cta steps-form-cta" download>
                            <span class="gradient-cta-overlay gradient-text theme-gradient">Download</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <div class="notices-wrapper">
            <h5 class="notices-heading">Policy for appointment and remuneration of directors of Nayara Energy Limited <div class="arrow-title"></div></h5>
            <div class="all-reports-listingBlock notice-lisitingBlock wrap-clear">
                <div class="pdfDownload-data">
                    <img src="https://www.nayaraenergy.com/storage/pages/May2019/pdf-img.png" alt="pdf" class="pdfIcon">
                    <div class="pdfdata-block">
                        <div class="pdf-name-title">
                            Policy for appointment and remuneration of directors of Nayara Energy Limited                                    </div>
                        <a href="https://www.nayaraenergy.com/storage/pages/May2019/Policy for Appointment and Remuneration of Directors.pdf" class="cta gradient-cta theme-gradient form-cta steps-form-cta" target="_blank">
                            <span class="gradient-cta-overlay gradient-text theme-gradient">View</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@stop