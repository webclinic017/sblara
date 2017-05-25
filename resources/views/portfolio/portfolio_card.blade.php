            <div class="portlet light bordered" id="portlet_{{$portfolio->id}}">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-th-large font-green-jungle"></i>
								<span class="caption-subject bold font-green-jungle uppercase">
								{{$portfolio->portfolio_name}} </span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse">
                        </a>

                        </a>
                    </div>

                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th><i class="fa icon-equalizer"></i> Head</th>
                            <th class="hidden-xs"><i class="fa fa-bar-chart-o"></i> Stats</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="highlight">
                                <div class="success"></div>
                                <a href="#"> Cash </a></td>
                            <td class="hidden-xs"> {{$portfolio->cash_amount}}</td>
                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="info"></div>
                                <a href="#"> Today gain/loss </a></td>
                            <td class="hidden-xs"> {{$gainLossToday}}</td>
                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="success"></div>
                                <a href="#">Since purchased gain/loss</a></td>
                            <td class="hidden-xs">{{$totalProfitSincePurchase}} ({{$totalChangeSincePurchase}}%)</td>
                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="warning"></div>
                                <a href="#"> Sell value</a></td>
                            <td class="hidden-xs">{{$totalSellDeductingCommission}}</td>
                        </tr>
                        </tbody>
                    </table>

                <a href="{{url('/portfolio')}}/{{$portfolio->id}}" class="btn btn-block btn-outline green-sharp  uppercase"  data-original-title="" title="" aria-describedby="confirmation165603">Access</a>
                <button itemId='{{$portfolio->id}}' id="bs_confirm_{{$portfolio->id}}" class="btn btn-outline red-mint  uppercase deleteTransaction" data-toggle="confirmation" data-placement="top"data-singleton="true"  data-original-title="" title="" aria-describedby="confirmation165603">Delete</button>
                </div>
            </div>