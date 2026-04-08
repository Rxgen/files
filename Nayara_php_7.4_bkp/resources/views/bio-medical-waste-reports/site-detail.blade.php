<table class="table-bordered table-striped table-condensed cf">
@foreach($site_details as $site_detail)
                            <thead class="cf">
                                <tr>
                                    <th style="width:50%;">
                                        Locations
                                    </th>
                                    <th>
                                        Biomedical Wastes Categories
                                    </th>
                                    <th class="numeric" id="tdMonth">
                                        {{ $site_detail->month }}<br>(kg)
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr class="yellowbg">
                                    <td class="mobg" data-title="Locations" id="tdSite" rowspan="4">
                                        {{ $site_detail->site_name }}
                                    </td>
                                    <td data-title="Biomedical Wastes Categories">
                                        <span class="yellow"></span>Yellow
                                    </td>
                                    <td class="numeric" data-title="Jan-19" id="tdYellow">{{ $site_detail->biomedical_wastes_categories_yellow }}</td>
                                </tr>
                                <tr>
                                    <td class="redbg" data-title="Biomedical Wastes Categories">
                                        <span class="red"></span>Red</td>
                                    <td class="numeric redbg" data-title="Jan-19" id="tdRed">{{ $site_detail->biomedical_wastes_categories_red }}</td>
                                </tr>
                                <tr class="whitebg">
                                    <td data-title="Biomedical Wastes Categories">
                                        <span class="white"></span>White</td>
                                    <td class="numeric" data-title="Jan-19" id="tdWhite">{{ $site_detail->biomedical_wastes_categories_white }}</td>
                                </tr>
                                <tr class="bluebg1">
                                    <td data-title="Biomedical Wastes Categories">
                                        <span class="blue"></span>Blue</td>
                                    <td class="numeric" data-title="Jan-19" id="tdBlue">{{ $site_detail->biomedical_wastes_categories_blue }}</td>
                                </tr>
                                
                            </tbody>
                            @endforeach
                        </table>