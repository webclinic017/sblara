@extends('layouts.metronic.default')
@section('content')

<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>KNOWLEDGE BASKET </div>
    </div>
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2n knowledge_basket_sidebar">
                <ul class="nav nav-tabs tabs-left">
                    <li class="active">
                        <a href="#tab_6_1" data-toggle="tab">
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image100.jpeg')}}"/>
                            <br>Technical
                        </a>
                    </li>
                    <li>
                        <a href="#tab_6_2" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image010.png')}}"/>
                            <br>Bullish 
                        </a>
                    </li>
                    <li>
                        <a href="#tab_6_3" data-toggle="tab">
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image007.png')}}"/>
                            <br>Bearish 
                        </a>
                    </li>
                    <li>
                        <a href="#tab_6_4" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image009.gif')}}"/>
                            <br>Squeeze 
                        </a>
                    </li>
                    <li>
                        <a href="#tab_6_5" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image008.gif')}}"/>
                            <br>Bands </a>
                    </li>
                    <li>
                        <a href="#tab_6_6" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image032.gif')}}"/>
                            <br>Crossover </a>
                    </li>
                    <li>
                        <a href="#tab_6_7" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image034.png')}}"/>
                            <br>Average </a>
                    </li>
                    <li>
                        <a href="#tab_6_8" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image031.png')}}"/>
                            <br>MACD </a>
                    </li>
                    <li>
                        <a href="#tab_6_9" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image043.gif')}}"/>
                            <br>RSI </a>
                    </li>
                    <li>
                        <a href="#tab_6_10" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image044.gif')}}"/>
                            <br>Stochastics </a>
                    </li>
                    <li>
                        <a href="#tab_6_11" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image050.gif')}}"/>
                            <br>Ultimate </a>
                    </li>
                    <li>
                        <a href="#tab_6_12" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image051.png')}}"/>
                            <br>Williams </a>
                    </li>
                    <li>
                        <a href="#tab_6_13" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image033.gif')}}"/>
                            <br>MoneyFlow </a>
                    </li>
                    <li>
                        <a href="#tab_6_14" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image011.png')}}"/>
                            <br>Chaikin </a>
                    </li>
                    <li>
                        <a href="#tab_6_15" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image017.png')}}"/>
                            <br>Demand </a>
                    </li>
                    <li>
                        <a href="#tab_6_16" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image030.png')}}"/>
                            <br>Importance </a>
                    </li>
                    <li>
                        <a href="#tab_6_17" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image039.png')}}"/>
                            <br>Price </a>
                    </li>
                    <li>
                        <a href="#tab_6_18" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image029.png')}}"/>
                            <br>Bullish&Bearish </a>
                    </li>
                    <li>
                        <a href="#tab_6_19" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image036.png')}}"/>
                            <br>OBV </a>
                    </li>
                    <li>
                        <a href="#tab_6_20" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image045.png')}}"/>
                            <br>SAR </a>
                    </li>
                    <li>
                        <a href="#tab_6_21" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image012.png')}}"/>
                            <br>Channel </a>
                    </li>
                    <li>
                        <a href="#tab_6_22" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image013.jpg')}}"/>
                            <br>A&D </a>
                    </li>
                    <li>
                        <a href="#tab_6_23" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image035.png')}}"/>
                            <br>Neutral </a>
                    </li>
                    <li>
                        <a href="#tab_6_24" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image042.png')}}"/>
                            <br>Reversal </a>
                    </li>
                    <li>
                        <a href="#tab_6_25" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image018.png')}}"/>
                            <br>Divergence </a>
                    </li>
                    <li>
                        <a href="#tab_6_26" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image003.png')}}"/>
                            <br>Andrew's </a>
                    </li>
                    <li>
                        <a href="#tab_6_27" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image004.gif')}}"/>
                            <br>Aroon </a>
                    </li>
                    <li>
                        <a href="#tab_6_28" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image019.png')}}"/>
                            <br>Fan </a>
                    </li>
                    <li>
                        <a href="#tab_6_29" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image020.png')}}"/>
                            <br>Retracement </a>
                    </li>
                    <li>
                        <a href="#tab_6_30" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image045.png')}}"/>
                            <br>Arc </a>
                    </li>
                    <li>
                        <a href="#tab_6_31" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image048.png')}}"/>
                            <br>TLV </a>
                    </li>
                    <li>
                        <a href="#tab_6_32" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image049.png')}}"/>
                            <br>TS-1 </a>
                    </li>
                    <li>
                        <a href="#tab_6_33" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image047.png')}}"/>
                            <br>TS-2 </a>
                    </li>
                    <li>
                        <a href="#tab_6_34" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image046.png')}}"/>
                            <br>Swing </a>
                    </li>
                    <li>
                        <a href="#tab_6_35" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image040.png')}}"/>
                            <br>PushingUp </a>
                    </li>
                    <li>
                        <a href="#tab_6_36" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image038.png')}}"/>
                            <br>Pivot </a>
                    </li>
                    <li>
                        <a href="#tab_6_37" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image002.png')}}"/>
                            <br>A/D </a>
                    </li>
                    <li>
                        <a href="#tab_6_38" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image024.gif')}}"/>
                            <br>HPP-1 </a>
                    </li>
                    <li>
                        <a href="#tab_6_39" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image025.gif')}}"/>
                            <br>HPP-2 </a>
                    </li>
                    <li>
                        <a href="#tab_6_40" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image026.gif')}}"/>
                            <br>HPP-3 </a>
                    </li>
                    <li>
                        <a href="#tab_6_41" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image027.gif')}}"/>
                            <br>HPP-4 </a>
                    </li>
                    <li>
                        <a href="#tab_6_42" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image006.jpg')}}"/>
                            <br>ATR-1 </a>
                    </li>
                    <li>
                        <a href="#tab_6_43" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image005.gif')}}"/>
                            <br>ATR-2 </a>
                    </li>
                    <li>
                        <a href="#tab_6_44" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image015.png')}}"/>
                            <br>Cup </a>
                    </li>
                    <li>
                        <a href="#tab_6_45" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image016.png')}}"/>
                            <br>DeadCat </a>
                    </li>
                    <li>
                        <a href="#tab_6_46" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image028.png')}}"/>
                            <br>H&S </a>
                    </li>
                    <li>
                        <a href="#tab_6_47" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image022.png')}}"/>
                            <br>Gaps </a>
                    </li>
                    <li>
                        <a href="#tab_6_48" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image023.png')}}"/>
                            <br>GoodTrade </a>
                    </li>
                    <li>
                        <a href="#tab_6_49" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image041.png')}}"/>
                            <br>ROC </a>
                    </li>
                    <li>
                        <a href="#tab_6_50" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image037.jpg')}}"/>
                            <br>ParabolicSAR </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 col-sm-10 col-xs-10">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_6_1">
                        <strong><u>Technical Analysis :</u></strong><br><br>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="knowledge_basket_tab">
                                    <div class="portlet-body">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab"> English </a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab"> Bangla </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content knowledge_basket">
                                            <div class="tab-pane fade active in" id="tab_1_1 ">
                                                <img src="{{ URL::asset('/knowledge_basket/images/clip_image100.jpeg') }}"/>
                                                <p> 
                                                    Technical Analysis is the study of price movement. The analyst usually studies the price action on the stock market by the use of quantitative techniques and charts. By looking at charts, you can identify trends and patterns which can help you find good trading opportunities. Simply put, technical analysis is the study of prices, with charts being the primary tool. The purpose of this type of analysis is to forecast overall price trends. A company's financial statements are less important in this type of analysis. Investors using technical analysis often use the advance-decline line, a tool that determines the difference between the number of stocks dropping in price and the number of stocks rising in price. Investors can create a net advance by subtracting total number of dropping prices from total number of advancing prices.
                                                </p>
                                                <p>
                                                    The roots of modern-day technical analysis stem from the Dow Theory developed around 1900 by Charles Dow. And of course, the widely followed Dow Jones Industrial Average is a direct offspring of the Dow Theory.
                                                </p>
                                                <p>
                                                    Technical analysis is based on three major conclusions about the market:
                                                </p>
                                                <ol>
                                                    <li>Price Discounts Everything:</li>
                                                    <li>Price Moves In Trends</li>
                                                    <li>Price Movements Are Historically Repetitive</li>
                                                </ol>
                                            </div>
                                            <div class="tab-pane fade" id="tab_1_2">
                                                <img src="{{ URL::asset('/knowledge_basket/images/clip_image100.jpeg') }}"/>
                                                <ol>
                                                    <li>Long black (filled-in)line: এটি একটি বিয়ারিশ রেখা।একটি নির্দিষ্ট সময়ে প্রারম্ভিক মূল্য সর্বোচ্চের কাছাকাছি থেকে শুরু হয়ে সর্বনিন্ম মূল্যের কাছে গিয়েই শেষ হয়।</li>
                                                    <li>Hanging man: এই রেখাগুলি বিয়ারিশ যা uptrend এর পর সৃস্টি হয়।যদি এই রেখাগুলি downtrend এর পর তৈরি হয় তবে আমরা একে hammer বলবো।এদের ছোট শরীর (প্রারম্ভিক মূল্য ও সমাপ্তি মূল্যের অল্প পার্থক্য) ও নিচের দিকে লম্বা ছায়া (সর্বোনিন্ম মূল্য প্রারম্ভিক, সর্বোচ্চ, সমাপ্তি মূল্যের চেয়েও নিচে অবস্থান করে) দেখে এদের চিহ্নিত করা যায়।এটি পূর্ণ কিম্বা খালি থাকে। </li>
                                                    <li>Dark cloud cover. এই কেন্ডেলটি একই বিয়ারিশ কেন্ডেল যা আগের দিনের কেন্ডেলের শমাপ্তি মূল্যর ওপরে থেকে শুরু হয় এবং আগের দিনের কেন্ডেলকে ঢেকে ফেলে।</li>
                                                    <li>Bearish engulfing lines: এটি একটি বিয়ারিশ প্যাটার্ণ। সাধারণতঃ এটি uptrend এর পর সৃস্টি হয়(এটি রিভেরসেল হিসেবে কাজ করে)।যখন ছোট বুলিশ(খলি) রেখাটি একটা বড় বিয়ারিশ রেখা(পূর্ণ) দ্বারা আবৃত থাকে।</li>
                                                    <li>Evening star: এটি একটি বিয়ারিশ প্যাটার্ণ যা সম্ভাব্য শীর্ষবিন্দু নির্দেশ করে।এখানে সটারটি রিভারসেলের সম্ভাবনা নির্দেশ করে এবং বিয়ারিশ রেখাটি এই নির্দেশনাকে সমর্থন করে।স্টারটি পূর্ণ বা খালি থাকতে পারে।</li>
                                                    <li>Doji star: স্টারটি রিভেরসেলের এবং ডজিটি সিদ্ধান্তহীনতা নির্দেশ করে।যদিও এটি অনিশ্চিত সময়ে রিভারসেলের ইঙ্গিত দেয়।নিশ্চিত না হওয়া পর্যন্ত এই ডজি দেখার পর আপনাকে অপেক্ষা করতে হবে। </li>
                                                    <li>Shooting star: এই প্যাটার্ণটি অল্পস্বল্প রিভারসেলের ইঙ্গিত দেয় যা সাধারণতঃ রেখার মিছিলের পর প্রতিভাত হয়। সর্বনিন্ম মূল্যের কাছাকাছি স্টারটি পরিলক্ষিত হয় এবং এর উপরের দিকে একটি দীর্ঘ লম্বা ছায়া থাকে।</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_2">
                        <strong><u>Bullish Candlestick Pattern :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_3" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_4" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_3">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image010.png') }}"/>
                                            <ol>
                                                <li>Long white (empty) line. This is a bullish line. It occurs when prices open near the low and close significantly higher near the period's high. The long white is a sign that buyers are firmly in control so its a bulish symbol. </li><br>
                                                <li>Hammer: The hammer signals a reversal after a downtrend when control has already been shifted from sellers to buyers. This is ofcourse bullish line if it occurs after a significant downtrend. If the line occurs after a significant up-trend, it is called a Hanging Man. A Hammer is identified by a small real body (i.e., a small range between the open and closing prices) and a long lower shadow (i.e., the low is significantly lower than the open, high, and close). The body can be empty or filled-in.</li><br>
                                                <li>Piercing line. This is a bullish pattern and the opposite of a dark cloud cover. The first line is a long black line and the second line is a long white line. The second line opens lower than the first line's low, but it closes more than halfway above the first line's real body.</li><br>
                                                <li>Bullish engulfing lines. Engulfing patterns consist of two bodies and where the second body “engulfs” the first. This pattern is strongly bullish if it occurs after a significant downtrend (i.e., it acts as a reversal pattern). It occurs when a small bearish (filled-in) line is engulfed by a large bullish (empty) line. </li><br>
                                                <li>Morning star: The morning Star pattern is a bullish reversal signal after a dwontrend. the first bar has a long black body, the second body gaps down from the first (the shadows may still overlap) and may be filled or hollow. This is a bullish pattern signifying a potential bottom. The "star" indicates a possible reversal and the bullish (empty) line confirms this.</li><br>
                                                <li>Bullish doji star. A "star" indicates a reversal and a doji indicates indecision. Thus, this pattern usually indicates a reversal following an indecisive period. You should wait for a confirmation (e.g., as in the morning star, above) before trading a doji star. The first line can be empty or filled in.</li><br>
                                            </ol>                                            
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_4">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image010.png') }}"/>
                                            <ol>
                                                <li>Long white (empty)line: এটি হচ্ছে একটি বুলিশ রেখা ।এটি সৃষ্টি হয় যখন প্রারম্ভিক মূল্য সর্বনিন্ম থেকে শুরু হয়ে একেবারে দিনের সর্বোচ্চ প্রান্তে কাছাকাছি গিয়ে শেষ হয় ।</li>
                                                <li>Hammer: এটি একটি বুলিশ রেখা । সাধারণতঃ এটি একটি downtrend এর পর সৃষ্টি হয় । যদি এটি একটি গুরুত্বপূর্ণ uptrend এর পর সৃষ্টি হয় তবে এটকে Hanging man বলা হয় । হ্যামার সাধরণত একটি ছোট শরীর (প্রারম্ভিক মূল্য ও সমাপ্তি মূল্যের অল্প পার্থক্য) ও নিচের দিকে লম্বা ছায়া থাকে (সর্বোনিন্ম মূল্য প্রারম্ভিক, সর্বোচ্চ, সমাপ্তি মূল্যের চেয়েও নিচে অবস্থান করে).</li>
                                                <li>Piercing Line: এটি বুলিশ রেখা এবং ডার্ক ক্লাউড কাভারের বিপরীত । প্রথম লম্বা রেখাটি সম্পূর্ণ কালো এবং দ্বিত্বীয় লম্বা রেখাটি সাদা হয়ে থাকে। প্রথম রেখাটির নিন্মস্তরের চেয়েও নিচে হতে দ্বিত্বীয় রেখাটি শুরু হয়। কিন্তু এটি প্রথম রেখাটির মধ্যবর্তী অংশের কিছু উপরে গিয়ে শেষ হয় । </li>
                                                <li>Bullish engulfing lines: এটি একটি জোরালো বুলিশ প্যাটার্ণ যা একটি গুরুত্বপূর্ণ downtrend পর দেখা যায় (এটি রিভারসেল হিসেবে কাজ করে)। যখন একটি ছোট বিয়ারিশ(bearish)রেখা বড় বুলিশ(bullish)রেখা দ্বারা আবৃত থাকে তখন এটি সৃষ্টি হয়।</li>
                                                <li>Morning star: এটি ও একটি বুলিশ প্যাটার্ণ যা নিন্মের গতি নির্দেশ করে ।এখানে সটারটি রিভারসেলের সম্ভাবনা এবং বুলিশ (খালি) রেখাটি সে সম্ভাবনাকে নিশ্চিত করে ।এ স্টারটি পূর্ণ বা খালি থাকতে পারে। </li>
                                                <li>Bullish doji star: সটার রিভারসেল নির্দেশ করে ও ডজি সিদ্ধান্তহীনতা প্রকাশ করে ।যদিও এটি অনিশ্চিত সময়ে রিভারসেল প্রদর্শণ করে।ট্রেড এর নিশ্চয়তার জন্য ডজি দেখলেই অপেক্ষা করতে হবে।প্রথম রেখাটি পূর্ণ বা খালি থাকতে পারে।</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_3">
                        <strong><u>Bearish Candlestick Pattern :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_5" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_6" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_5">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image007.png') }}"/>
                                            <ol>
                                                <li>Long black (filled-in) line. This is a bearish line. It occurs when prices open near the high and close significantly lower near the period's low. The long black is a sign that Sellers are firmly in control so its a bearish symbol. </li>
                                                <li>Hanging Man. These lines are bearish if they occur after a significant uptrend. If this pattern occurs after a significant downtrend, it is called a Hammer. They are identified by small real bodies (i.e., a small range between the open and closing prices) and a long lower shadow (i.e., the low was significantly lower than the open, high, and close). The bodies can be empty or filled-in.</li>
                                                <li>Dark cloud cover. This is a bearish pattern. The pattern is more significant if the second line's body is below the center of the previous line's body (as illustrated). </li>
                                                <li>Bearish engulfing lines. This pattern is strongly bearish if it occurs after a significant up-trend (i.e., it acts as a reversal pattern). It occurs when a small bullish (empty) line is engulfed by a large bearish (filled-in) line. its a oposit of Bullish engulfing lines.</li>
                                                <li>Evening star: The Evening Star Pattern is the opposite to Morning Star and is a reversal signal at the end of an up trend. Evening starts is three-candle pattern that comes after a rally. the first candle has a tall white real body, the sec ond has a small real body that gaps higher to form a star, and the third is a black candle that closes well into the first sessions white real body.</li>
                                                <li>Doji star: A Doji Star formation is weaker that the Morning or Evening Star - the doji represents indecision. With a shooting star the body on the second bar must be near the low - at the bottom end of the trading range. the upper shadow must be longer. This is also a weaker reversal signal after a trend. </li>
                                                <li>Shooting star. This pattern suggests a minor reversal when it appears after a rally. The star's body must appear near the low price and the line should have a long upper shadow.</li>
                                            </ol>                                            
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_6">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image007.png') }}"/>
                                            <ol>
                                                <li>Long black (filled-in)line: এটি একটি বিয়ারিশ রেখা।একটি নির্দিষ্ট সময়ে প্রারম্ভিক মূল্য সর্বোচ্চের কাছাকাছি থেকে শুরু হয়ে সর্বনিন্ম মূল্যের কাছে গিয়েই শেষ হয়।</li>
                                                <li>Hanging man: এই রেখাগুলি বিয়ারিশ যা uptrend এর পর সৃস্টি হয়।যদি এই রেখাগুলি downtrend এর পর তৈরি হয় তবে আমরা একে hammer বলবো।এদের ছোট শরীর (প্রারম্ভিক মূল্য ও সমাপ্তি মূল্যের অল্প পার্থক্য) ও নিচের দিকে লম্বা ছায়া (সর্বোনিন্ম মূল্য প্রারম্ভিক, সর্বোচ্চ, সমাপ্তি মূল্যের চেয়েও নিচে অবস্থান করে) দেখে এদের চিহ্নিত করা যায়।এটি পূর্ণ কিম্বা খালি থাকে। </li>
                                                <li>Dark cloud cover. এই কেন্ডেলটি একই বিয়ারিশ কেন্ডেল যা আগের দিনের কেন্ডেলের শমাপ্তি মূল্যর ওপরে থেকে শুরু হয় এবং আগের দিনের কেন্ডেলকে ঢেকে ফেলে।</li>
                                                <li>Bearish engulfing lines: এটি একটি বিয়ারিশ প্যাটার্ণ। সাধারণতঃ এটি uptrend এর পর সৃস্টি হয়(এটি রিভেরসেল হিসেবে কাজ করে)।যখন ছোট বুলিশ(খলি) রেখাটি একটা বড় বিয়ারিশ রেখা(পূর্ণ) দ্বারা আবৃত থাকে।</li>
                                                <li>Evening star: এটি একটি বিয়ারিশ প্যাটার্ণ যা সম্ভাব্য শীর্ষবিন্দু নির্দেশ করে।এখানে সটারটি রিভারসেলের সম্ভাবনা নির্দেশ করে এবং বিয়ারিশ রেখাটি এই নির্দেশনাকে সমর্থন করে।স্টারটি পূর্ণ বা খালি থাকতে পারে।</li>
                                                <li>Doji star: স্টারটি রিভেরসেলের এবং ডজিটি সিদ্ধান্তহীনতা নির্দেশ করে।যদিও এটি অনিশ্চিত সময়ে রিভারসেলের ইঙ্গিত দেয়।নিশ্চিত না হওয়া পর্যন্ত এই ডজি দেখার পর আপনাকে অপেক্ষা করতে হবে। </li>
                                                <li>Shooting star: এই প্যাটার্ণটি অল্পস্বল্প রিভারসেলের ইঙ্গিত দেয় যা সাধারণতঃ রেখার মিছিলের পর প্রতিভাত হয়। সর্বনিন্ম মূল্যের কাছাকাছি স্টারটি পরিলক্ষিত হয় এবং এর উপরের দিকে একটি দীর্ঘ লম্বা ছায়া থাকে।</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_4">
                        <strong><u>Bollinger Squeeze :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_7" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_8" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_7">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image009.gif') }}"/>
                                            <p> 
                                                The Bollinger squeeze is pretty self explanatory. When the bands “squeeze” together, it usually means that a breakout is going to occur. If the candles start to break out above the top band, then the move will usually continue to go up. If the candles start to break out below the lower band, then the move will usually continue to go down. Looking at the chart you can see the bands squeezing together. The price has just started to break out of the top band. Based on this information, where do you think the price will go? If you said up, you are correct! This is how a typical Bollinger Squeeze works. This strategy is designed for you to catch a move as early as possible. Setups like these don’t occur every day, but you can probably spot them a few times a week if you are looking at chart.                                           
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_8">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image009.gif') }}"/>
                                            <p> 
                                                বলিংঙ্গার স্কুইজ দেখেই আমরা এর বৈশিষ্ট্য বুঝতে পারি। যখন ব্যান্ডগুলো পরস্পর সংকুচিত হয় তার অর্থ হলো ব্রেকাউটের সমূহ সম্ভাবনা আছে ।যদি ক্যান্ডেলস্টিকগুলো উপরের ব্যান্ডকে অতিক্রম করে যায় এবং স্থায়ী হয় তবে তা uptrend নির্দেশ করে।আর যদি ক্যান্ডেলস্টিকগুলো নিচের ব্যান্ডকে অতিক্রম করে তবে তা ট্রেন্ডে downtrend নির্দেশ করে।চার্ট –এ আপনি দেখতে পাচ্ছেন ব্যান্ডগুলো পরস্পরের দিকে সংকুচিত। পরের দিন একটি bullish Candlestick তৈরি করেছে। পরের দিন দাম Bollinger এর উপরের ব্যান্ডকে অতিক্রম করছে। এই তথ্যের উপর ভিত্তি করে আপনি কি সিদ্ধান্ত নিবেন? যদি আপনি ভাবেন uptrend তবে আপনার ধারনা সঠিক। চিত্র টি লক্ষ্য করুন। সাধারণতঃ এইভাবে বলিংঙ্গার স্কুইজ কাজ করে। এই স্ট্র্যাটিজি এভাবে তৈরিকরা হয়েছে যাতে আপনি তড়িৎ একটি ট্রেন্ড বুঝতে পারেন। তবে আপনাকে অবশ্যই কিছুটা সাবধানতা অবলম্বন করতে হবে কারন পরের দিন ব্যান্ডটি স্কুইজ না ও করতে পারে। কিন্তু যদি স্কুইজ করে তবে ধরে নিতে হবে স্কুইজটি বেশ কয়েকদিন স্থায়ী হবে এবং খুব বর একটি দামের পরিবরতিন ঘটবে। এ ধরনের বৈশিষ্ট্য প্রতিদিন খুঁজে পাওয়া যায় না কিন্তু আপনি সপ্তাহের কোন কোন সময় এই বৈশিষ্ট্য খুঁজে পাবেন যদি আপনি ৫/৭ দিনের চার্ট পর্যবেক্ষন করেন।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_5">
                        <strong><u>Bollinger Bands :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_9" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_10" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_9">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image008.gif') }}"/>
                                            <p> 
                                                Bollinger bands are used to measure a market’s volatility. Basically, this little tool tells us whether the market is quiet or whether the market is LOUD! When the market is quiet, the bands contract; and when the market is LOUD, the bands expand. Notice on the chart below that when the price was quiet, the bands were close together, but when the price moved up, the bands spread apart. The Bollinger Bounce One thing you should know about Bollinger Bands is that price tends to return to the middle of the bands. That is the whole idea behind the Bollinger bounce. If this is the case, then by looking at the chart below, can you tell us where the price might go next? If you said down, then you are correct! As you can see, the price settled back down towards the middle area of the bands. That’s all there is to it. What you just saw was a classic Bollinger bounce. The reason these bounces occur is because Bollinger Bands act like mini support and resistance levels. The longer the time frame you are in, the stronger these bands are. Many traders have developed systems that thrive on these bounces, and this strategy is best used when the market is ranging and there is no clear trend.                                        
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_10">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image008.gif') }}"/>
                                            <p> 
                                                বলিংঙ্গার ব্যান্ডের মাধ্যমে বাজারের পরিবর্তন(ওঠানামা) পরিমাপ করা হয়। মুলতঃ এই অনুসংঘটি আমাদের বাজার কখন স্থির কিম্বা প্রসারিত এই সম্পর্কে ধারণা দেয়।যখন বাজার স্থির থাকে তখন ব্যান্ডগুলো সংকুচিত হয় এবং যখন বাজার বিস্তৃতি লাভ করে তখন ব্যান্ডগুলো প্রসারিত হয়।লক্ষ্য করুন,নিন্ম চিত্রে যখন দামের তেমন কোন পরিবর্তন ঘটে না তখন ব্যান্ডগুলো পরস্পরের কাছাকাছি অবস্থান করে আর যখন দাম বাড়তে শুরু করেছে তখন ব্যান্ডগুলো ছড়িয়ে গেছে। বলিংঙ্গার ব্যান্ডের একটি দিক সম্পর্কে আপনার ধারণা থাকা প্রয়োজন তা হচ্ছে মূল্যের প্রবণতাই থাকে ব্যান্ডের মাঝামাঝিতে ফিরে আসা।এটি হচ্ছে বলিংঙ্গার বাউন্সের মূল ধারনা। যদি তাই হয় তবে নিন্মোক্ত চিত্র পর্যবেক্ষন করে বলুন দাম পরবর্তীতে কোনদিকে যাবে? যদি আপনি বলেন দাম নিচে নেমে আসবে তবে তা সঠিক। আপনি দেখতে পাচ্ছেন দাম আবার ব্যান্ডের মাঝামাঝি স্থানে ফিরে এসেছে। আপনি এইমাত্র যা পর্যবেক্ষন করলেন তা একটি ক্লাসিক বলিংঙ্গার বাউন্স। এই বাউন্সটি সংঘটিত হয়েছে কারন বলিংঙ্গার ব্যান্ডটি একটি ছোটখাটো সাপোর্ট ও রেজিস্টেন্স হিসেবে কাজ করেছে।যত বেশি সময় আপনি বলিংঙ্গার ব্যান্ডে যুক্ত করবেন তত ব্যান্ডগুলি শক্তিশালী হবে।অনেক ট্রেডাররা বলিংঙ্গার বাউন্সেকে কাজে লাগিয়ে সফল হয়েছেন এবং এই স্ট্র্যাটিজি সবচেয়ে সফল যখন বাজার বিস্তৃতি লাভ করে এবং যখন অনান্য ট্রেন্ডগুলি হতে আমরা সুস্পষ্ট ইংগিত পাই না। একটি ট্রেন্ড বুঝার জন্য।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_6">
                        <strong><u>MACD Crossover :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_11" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_12" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_11">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image032.gif') }}"/><br><br>
                                            <p> 
                                                Because there are two moving averages with different “speeds”, the faster one will obviously be quicker to react to price movement than the slower one. When a new trend occurs, the fast line will react first and eventually cross the slower line. When this “crossover” occurs, and the fast line starts to “diverge” or move away from the slower line, it often indicates that a new trend has formed. From the chart above, you can see that the fast line crossed under the slow line and correctly identified a new downtrend. Notice that when the lines crossed, the histogram temporarily disappears. This is because the difference between the lines at the time of the cross is 0. As the downtrend begins and the fast line diverges away from the slow line, the histogram gets bigger, which is good indication of a strong trend. There is one drawback to MACD. Naturally, moving averages tend to lag behind price. After all, it's just an average of historical prices. Since the MACD represents moving averages of other moving averages and is smoothed out by another moving average, you can imagine that there is quite a bit of lag. However, it is still one of the most favored tools by many traders.                                         
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_12">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image032.gif') }}"/><br><br>
                                            <p> 
                                                গতির পরিপ্রেক্ষিতে দুটি moving average –ই ভিন্নতর। স্বভাবতই দ্রুতগতিসম্পন্ন moving average ধীরগতিসম্পন্ন moving average অপেক্ষা দামের পরিবর্তনের সাথে দ্রুত পরিবর্তিত হবে। যখনই একটি নতুন ট্রেন্ডের সৃষ্টি হয় তখন দ্রুতগতিসম্পন্ন moving average টি দ্রুত সাড়া দেয় এবং ধীরগতি রেখাটিকে অতিক্রম করে। Crossover-এর ক্ষেত্রে দ্রুতগতি রেখাটি ধীরগতি রেখা হতে দূরে সরে যায় (diverge) যা সাধারণতঃ নতুন ট্রেন্ড সৃষ্টির ইংঙ্গিত দেয়। এখন আমরা একটি উদাহরনের মাধ্যমে জিনিস গুলি বুঝার চেষ্টা করব। উপোরোক্ত চার্টে আমরা দেখতে পাই দ্রুতগতি রেখাটি ধীরগতি রেখাটিকে নিচের দিক হতে অতিক্রম করছে যা downtrend নির্দেশ করছে। লক্ষ্য করূন, যে পয়েন্টে রেখাগুলি পরস্পরকে অতিক্রম করছে (Crossover) সে পয়েন্টেই histogram সাময়িকভাবে মিলিয়ে যায়। খুব ভাল ভাবে লক্ষ্য করুন দিকে একটি সময়ে histogram দেখা যাচ্ছে না। এর কারন হলো অতিক্রান্ত সময়ে রেখাগুলির পার্থক্যমান শূন্য হয়ে যায় ফলে কোন histogram দেখা যায় না । যেইমাত্র downtrend শুরু হয় তখন দ্রুতগতি রেখাটি ধীরগতি রেখা হতে দূরে সরে যায়, ফলে histogram বর্ধিত হয় যা একটি শক্তিশালী ট্রেন্ডের ইংঙ্গিত বহন করে। ঠিক uptrend এর সময়ে ও একই ঘটনা ঘটে থাকে। MACD-র একটি বড় অসুবিধা হচ্ছে মন্থরতা যা একইসময়ে দামের সাথে পরিবর্তিত না হয়ে বরং ধীর গতিতে দামকে অনুসরন করে। তাই এই ইন্ডিকেটি Lagging ইন্ডিকেট বলে পরিচিত, তবে এই ইন্ডিকেটরটি কোন trend সংগঠিত হবার পর সিগন্যাল দিয়ে থাকে ফলে ভুল হবার সম্ভাবনা কম। এবং এটি হছে অতীত মূল্যের গড় । যদিও MACD-র গতি মন্থর কিন্তু এটি ট্রেডারদের কাছে সবচেয়ে জনপ্রিয় ইন্ডিকেটর।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_7">
                        <strong><u>Moving Average :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_13" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_14" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_13">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image034.png') }}"/><br><br>
                                            <p> 
                                                Moving averages are used to identify current trends and trend reversals as well as to set up support and resistance levels. Moving averages can be used to quickly identify whether a security is moving in an uptrend or a downtrend depending on the direction of the moving average. When a moving average is heading upward and the price is above it, the security is in an uptrend. Conversely, a downward sloping moving average with the price below can be used to signal a downtrend Another method of determining momentum is to look at the order of a pair of moving averages. When a short-term average is above a longer-term average, the trend is up. On the other hand, a long-term average above a shorter-term average signals a downward movement in the trend. Moving average trend reversals are formed in two main ways: when the price moves through a moving average and when it moves through moving average crossovers. The signal of a trend reversal is when one moving average crosses through another. For example, as you can see in following figure, if the 10 day moving average crosses bellow the 25-day moving average, it is a negative sign that the price will start to decrease. If the periods used in the calculation are relatively short, for example 10 and 25, this could signal                                           
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_14">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image034.png') }}"/><br><br>
                                            <p> 
                                                Moving average সাম্প্রতিক ট্রেন্ড ও ট্রেন্ড রিভার্সেল পাশাপাশি সাপোর্ট এবং রেজিস্টেন্স লেভেলকে চিহ্নিত করতে ব্যবহৃত হয়। Moving average –এর গতিবিধির মাধ্যমে খুব দ্রুত একটি শেয়ারের up trend ও down trend চিহ্নিত করা যায়।যখন moving average উর্ধ্বগতি নির্দেশ করে এবং দামও এর সাথে চলে যা একটি শেয়ারের uptrend নির্দেশ করে ।একইভাবে moving average –এর সাথে দামের নিচে নেমে আসা একটি শেয়ারের downtrend নির্দেশ করে। আপনি অন্যভাবেও moving average –এর গতি পরিমাপ করতে পারেন।যখন স্বল্পমেয়াদী moving average দীর্ঘমেয়াদী moving averageকে অতিক্রম করে দীর্ঘমেয়াদী moving average এর উপরে অবস্থান নেয় তখন তা uptrend নির্দেশ করে। আবার,দীর্ঘমেয়াদী moving average যখন স্বল্পমেয়াদী moving averageকে অতিক্রম করে তার উপরে অবস্থান নেয় তখন তা ট্রেন্ডটির downtrend নির্দেশ করে। Moving average ট্রেন্ড রিভার্সেলের ধারা দু’টি পন্থার উপর নির্ভরশীলঃ যখন দাম moving average –এর মধ্য দিয়ে অতিক্রম করে। যখন দাম moving average crossover এর মধ্য দিয়ে অতিক্রম করে।রিভের্সেলের আরেকটি বৈশিষ্ট্য হচ্ছে যখন moving average-গুলো পরস্পরকে অতিক্রম করে।উদাহরণস্বরুপ,নিমোক্ত চিত্রে আপনি দেখতে পাচ্ছে্ন যে ১০ দিনের moving average ২৫ দিনের moving average –কে অতিক্রম করেছে যা নেগেটিভ এবং মূল্যহ্রাশ সংকেত প্রদান করছে। যদিও এখানে স্বল্প সময়ের পরিধি নিয়ে হিসেব করা হয়েছে।উদাহরণস্বরুপ, ১০ ও ১৫ দিনের moving average গুলো স্বল্পমেয়াদী ট্রেন্ড রিভার্সেলের সিগনাল দেখাচ্ছে ।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_8">
                        <strong><u>Moving Average Convergence Divergence (MACD) :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_15" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_16" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_15">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image031.png') }}"/><br><br>
                                            <p> 
                                                The moving average convergence divergence (MACD) is one of the most well known and used indicators in technical analysis. This indicator is comprised of two exponential moving averages. The MACD is simply the difference between these two moving averages plotted against a centerline. The centerline is the point at which the two moving averages are equal. Along with the MACD and the centerline, an exponential moving average of the MACD itself is plotted on the chart. The idea behind this momentum indicator is to measure short-term momentum compared to longer term momentum to help signal the current direction of momentum. With an MACD chart, you will usually see three numbers that are used for its settings. • The first is the number of periods that is used to calculate the faster moving average. • The second is the number of periods that are used in the slower moving average. • And the third is the number of bars that is used to calculate the moving average of the difference between the faster and slower moving averages There is a common misconception when it comes to the lines of the MACD. The two lines that are drawn are NOT moving averages of the price. Instead, they are the moving averages of the DIFFERENCE between two moving averages. In our example above, the faster moving average is the moving average of the difference between the 12 and 26 period moving averages. The slower moving average plots the average of the previous MACD line. Once again, from our example above, this would be a 9 period moving average. The histogram simply plots the difference between the fast and slow moving average. If you look at our original chart, you can see that as the two moving averages separate, the histogram gets bigger. This is called divergence, because the faster moving average is “diverging” or moving away from the slower moving average. As the moving averages get closer to each other, the histogram gets smaller. This is called convergence because the faster moving average is “converging” or getting closer to the slower moving average. And that, my friend, is how you get the name                                           
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_16">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image031.png') }}"/><br><br>
                                            <p> 
                                                টেকনিক্যাল এনালাইসিসে MACD বহুল ব্যবহৃত এবং অন্যতম ইন্ডিকেটর হিসেবে পরিচিত। এই ইন্ডিকেটরটি দু’টি exponential moving average-এর সম্বন্নয়ে গঠিত। সাধারণতঃ একটি মধ্যবর্তী রেখার বিপরীতে দুটি exponential moving average-এর পার্থ্যকের উপর ভিত্তি করে MACD নির্ণিত হয়। এই মধ্যবর্তী রেখাটি(center line) সে স্থল যেখানে moving average দুটিই সমান।একটি চার্টে MACD-র সাথে মধ্যবর্তী রেখা(Center line) এবং exponential moving average থাকে। এই indicator –এর মাধ্যমে স্বল্পমেয়াদী MACD –র সাথে দীর্ঘমেয়াদী MACD –র তুলনা করে সাম্প্রতিক ট্রেন্ড কি হবে বা কোনদিকে যাবে তা নির্ণয় করা যায়। MACD চার্টে সাধারণতঃ ৩ সংখ্যা ব্যবহৃত হয় যা তার সেটিংসে প্রয়োজন। • ১ম সংখ্যা হচ্ছে সময়ের ১ম সংখ্যা যার মাধ্যমে দ্রুতগতিসম্পন্ন moving average পরিমাপ করা হয়। • ২য় সংখ্যা হচ্ছে সময়ের ২য় সংখ্যা যার মাধ্যমে ধীরগতিসম্পন্ন moving average পরিমাপ করা হয়। • ৩য় সংখ্যা হচ্ছে বারের(bar)সংখ্যা যার মাধ্যমে দ্রুতগতিসম্পন্ন ও ধীরগতিসম্পন্ন moving average তুলনা করে moving average-এর পার্থক্য পাওয়া যায়। এখানে MACD –র এ দুটি রেখা নিয়ে একটি ভ্রান্ত ধারনা প্রচলিত আছে।যে দুটি রেখা অংকিত আছে তারা দামের উপর ভিত্তি করে নির্ণিত moving average নয়। বরঞ্চ, এরা দুটি moving average – এর পার্থক্য যা দুটি moving average –কে তুলনা করে পাওয়া যায়। Histogram –এর মাধ্যমে আমরা দ্রুতগতি ও ধীরগতি moving average এর পার্থ্যক্য খুঁজে পাই। আপনি যদি আমাদের অরিজিনাল চার্ট দেখেন তবে দেখতে পাবেন, যে স্থলে moving average গুলোর দূরত্ব সৃষ্টি হয়েছে সেখানেই histogram বেড়েছে। একে divergence বলা হয়। কারন, এসময় দ্রুতগতিসম্পন্ন moving average ধীরগতিসম্পন্ন moving average এর থেকে দূরে সরে যায়। যখন moving average গুলো পরস্পরের কাছাকাছি অবস্থান করে তখন Histogram ছোট আকার ধারণ করে। একে convergence বলা হয়। কারন, এসময় দ্রুতগতিসম্পন্ন moving average ধীরগতিসম্পন্ন moving average এর কাছাকাছি অবস্থান করে। এভাবে Moving Average Convergence Divergence নামের সৃষ্টি হয়েছে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_9">
                        <strong><u>Relative Strength Index :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_17" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_18" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_17">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image043.gif') }}"/><br><br>
                                            <p> 
                                                Relative Strength Index, or RSI, is similar to stochastics in that it identifies overbought and oversold conditions in the market. It is also scaled from 0 to 100. Typically, readings below 20 indicate oversold, while readings over 80 indicate overbought. RSI can be used just like stochastics. From the chart above you can see that when RSI dropped below 20, it correctly identified an oversold market. After the drop, the price quickly shot back up. RSI is a very popular tool because it can also be used to confirm trend formations. If you think a trend is forming, take a quick look at the RSI and look at whether it is above or below 50. If you are looking at a possible uptrend, then make sure the RSI is above 50. If you are looking at a possible downtrend, then make sure the RSI is below 50.In the beginning of the chart above, we can see that a possible uptrend was forming. To avoid fakeouts, we can wait for RSI to cross above 50 to confirm our trend. Sure enough, as RSI passes above 50, it is a good confirmation that an uptrend has actually formed.                                            
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_18">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image043.gif') }}"/><br><br>
                                            <p> 
                                                Relative Strength index অথবা RSI অনেকটাই Stochastics এর মত যা বাজারের overbought ও oversold নির্দেশ করে। এর স্কেলমান ০ হতে ১০০। সাধারণতঃ ২০ এর নিচে oversold এবং ৮0 এর উপরে overbought বোঝায়। RSI এর ব্যবহার অনেকটাই Stochastics এর মত। চার্টে আমরা দেখতে পাচ্ছি যে যখন RSI নিচের দিকে নেমে এসেছে তখন তা সঠিকভাবে বাজারের oversold নির্ণয় করেছে। এই নেমে আসার পর দাম আবার দ্রুত উপরের দিকে উঠে এসেছে। RSI খুবই জনপ্রিয় ইন্ডিকেটর কারন এটি নতুন একটি ট্রেন্ড যে সৃষ্টি হবে তা নিশ্চিত করে। যদি আপনি মনে করেন একটি নতুন ট্রেন্ড সৃষ্টি হবে তবে আপনি RSI কে পর্যবেক্ষন করুণ এটি কি ৫০ এর উপরে অথবা নিচে অবস্থান করছে। যদি RSI ৫০ এর উপরে অবস্থান করে তবে আপনি সম্ভাব্য uptrend দেখতে পাবেন। আর আপনি যদি সম্ভাব্য downtrend পরিলক্ষিত করেন তবে RSI এর ৫০ এর নিচে অবস্থান করবে। আমরা দেখতে পাচ্ছি চার্টের শুরুতে একটি সম্ভাব্য uptrend শুরু হয়েছে। যদি আপনি সঠিক ধারনা পেতে চান এবং ট্রেন্ডের নিশ্চয়তা পেতে চান তবে আপনাকে RSI ৫০ কে অতিক্রম করেছে কিনা সেজন্যে অপেক্ষা করতে হবে। যদি RSI ৫০ অতিক্রম করে তবে তা সুনিশ্চিত uptrend নির্দেশ করে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_10">
                        <strong><u>Stochastics :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_19" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_20" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_19">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image044.gif') }}"/><br><br>
                                            <p> 
                                                Stochastics are another indicator that helps us determine where a trend might be ending. By definition, a stochastic is an oscillator that measures overbought and oversold conditions in the market. The 2 lines are similar to the MACD lines in the sense that one line is faster than the other. stochastics tells us when the market is overbought or oversold. Stochastics are scaled from 0 to 100. When the stochastic lines are above 70, then it means the market is overbought. When the stochastic lines are below 30 , then it means that the market is oversold. As a rule of thumb, we buy when the market is oversold, and we sell when the market is overbought. Looking at the chart above, you can see that the stochastics has been showing overbought conditions for quite some time. Based upon this information, can you guess where the price might go? If you said the price would drop, then you are absolutely correct! Because the market was overbought for such a long period of time, a reversal was bound to happen.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_20">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image044.gif') }}"/><br><br>
                                            <p> 
                                                Stochastics এ্কটি সূচক যা একটি ট্রেন্ড কোথায় গিয়ে শেষ হবে তা নির্দেশ করে থাকে । এই Stochastics একটি oscillator যা বাজারের overbought এবং oversold স্থল নির্দেশ করে। Stochastics-র দুটি রেখাই MACD-র রেখাগুলোর মত, এই অর্থে যে Stochastics একটি রেখা অপর রেখাটির চেয়ে দ্রুত। Stochastics এর ব্যবহারঃ পূর্বেই বলেছি Stochastics আমাদের বাজারের অবস্থা যা overbought বা oversold কিনা সে সম্পর্কে জানায়। Stochastics এর স্কেলমান ০ হতে ১০০।যখন Stochastics এর রেখাগুলো ৭০-র উপরে অবস্থান করে তখন তা বাজারের overbought নির্দেশ করে আর যখন ৩০-র নিচে অবস্থান করে তখন তা বাজারের oversold নি্দেশ করে। সাধারন নিয়মানুসারে বাজার oversold হলে আমরা ক্রয় করি এবং overbought হলে বিক্রয় করি।চার্ট হতে আমরা দেখতে পাই, Stochastics অনেকটা সময় ধরে overbought এর অবস্থান নির্দেশ করছে।এই তথ্যের উপর ভিত্তি করে দাম কোনদিকে যাবে তা কি আপনি অনুমান করতে পারেন?যদি আপনি বলেন দাম নিচের দিকে নামবে তাহলে আপনি সম্পূর্ণভাবে সঠিক। কারণ, বাজার অনেকটা সময় ধরে overbought –এ অবস্থান করছে যেখানে রিভার্সেল ঘটতে বাধ্য। এটাই হচ্ছে Stochastics এর মূল বিষয়। অনেক ট্রেডাররা Stochastics ভিন্নভাবে ব্যবহার করে থাকেন। কিন্তু Stochastics এর প্রধান কাজ হচ্ছে বাজার কখন overbought এবং oversold হয় তা নির্দেশ করা। Stochastics এর ব্যবহার আপনার ট্রেডের জন্য কতোটা উপোযোগী তা আপনি সময়ের পরিপ্রেক্ষিতে বুঝতে পারবেন।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_11">
                        <strong><u>Ultimate Oscillator :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_21" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_22" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_21">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image050.gif') }}"/><br><br>
                                            <p> 
                                                Ultimate Oscillator Developed by Larry Williams and first described in a 1985 article for Technical Analysis of Stocks and Commodities magazine, the "Ultimate" Oscillator combines a stock's price action during three different time frames into one bounded oscillator. Values range from 0 to 100 with 50 as the center line. Oversold territory exists below 30 and overbought territory extends from 70 to 100. Three time frames are used by the Ultimate Oscillator and can be specified by the user. Typically values of 7-periods, 14-periods and 28-periods are used. Note that these time periods all overlap, i.e. the 28-period time frame includes both the 14-period time frame and the 7-period time frame. This means that the action of the shortest time frame is included in the calculation three times and has a magnified impact on the results. By using Ultimate oscillator we can get buy signal. We can get buy signal at three steps.
                                            </p>
                                            <ol>
                                                <li>A Bullish Divergence will occur between prices indicator. </li>
                                                <li>Bullish Divergence will remain below 30 lines and higher low will consist.</li>
                                                <li>Oscillator must cross above Bullish Divergence. Look at the graph. There is a bullish divergence and lower low happened. When a ultimate oscillator cross 50 line then price went up and followed a long rally. So buy this way we can use ultimate oscillator.</li>
                                            </ol>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_22">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image050.gif') }}"/><br><br>
                                            <p> 
                                                Larry Williams ১৯৮৫ সালে প্রথমবার “Technical Analysis of Stocks and Commodities” ম্যাগাজিনে প্রকাশিত আর্টিকেলে ultimate oscillator সম্পর্কে বর্ণনা দিয়েছেন। Ultimate Oscillator হচ্ছে একটি সূচকের মধ্যে একটি শেয়ারের তিনটি ভিন্ন সময়ের মূল্য পরিবর্তনের (price action) বর্তমান। এর মান ০ হতে ১০০ পর্যন্ত এবং এর মধ্যবর্তী হচ্ছে ৫০। oversold এর স্থল ৩০ এর নিচে এবং overbought এর স্থল ৭০ হতে ১০০ পর্যন্ত বিস্তৃত। Ultimate Oscillator তিনটি time frame ব্যবহার করে এবং ব্যবহারকারীরা এটিকে সুনির্দিষ্টভাবে সাজিয়ে ব্যবহার করতে পারেন। সাধারণত ৭ দিনের, ১৪ দিনের এবং ২৮ দিনের মান ব্যবহৃত হয়। লক্ষ্য করুন, এই সময়গুলো একইসূত্রে গাথা এর মানে হলো ২৮ দিনের time frame এ ১৪ দিন ও ৭ দিন time frame উভয়ই অন্তর্ভূক্ত। স্বল্প সময়ের পরিবর্তন (action) তিনটি পিরিয়ওডের ক্যালকুলেশনের অন্তর্ভূক্ত এবং এটি ফলাফলের উপর সুন্দর প্রভাব ফেলে। সাধারণত আমরা তিনটি ধাপ অনুসরণ করে ক্রয় সিগন্যাল পেতে পারি।
                                            </p>
                                            <ol>
                                                <li>bullish divergence সংগঠিত হবে ইনডিকেটরটি এবং শেয়ারটির দামের মাঝে। তার অর্থ হচ্ছে Lower Low সংগঠিত হয়।</li>
                                                <li>bullish divergence টি ৩০ লাইনের এর নিচে থাকবে এবং একটি Higher Low সংগঠিত হবে।</li>
                                                <li>oscillator টি bullish divergence এর ওপরে উঠে যাবে। চিত্রে দেখুন একটি Bullish Divergence দেখা যাচ্ছে এবং Lower Low সংগঠিত হয়েছে। অন্য দিকে Ultimate Oscillator ও Higher Low সংগঠিত হয়েছে। যখনই ultimate Oschillator ইনডিকেটরটি ৫০ লাইন অতিক্রম করেছে তখন থেকেই শেয়ারটির দাম আবার বাড়তে শুরু করেছিল। ফলে দেখা যাচ্ছে আমাদের পূর্বের বর্ণিত তিনটি ধাপ খুবই গুরুত্বপূরণ এবং এই ধাপ গুলো ভাল ভাবে বুঝতে হবে এবং এর ব্যাবহারিক প্রয়োগ করতে হবে। এইভাবে আমরা Ultimate Oscillator টি ব্যাবহার করে Buy সিগন্যাল পেতে পারি। আগামীকালের সংখ্যায় আমরা বিক্রয় সিগন্যাল নিয়ে আলোচনা করবো।</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_12">
                        <strong><u>Williams % R Percent Range :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_23" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_24" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_23">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image051.png') }}"/><br><br>
                                            <p>
                                                Williams’ Percent Range Technical Indicator (%R) is a dynamic technical indicator, which determines whether the market is overbought/oversold. Williams’ %R is very similar to the Stochastic Oscillator. The only difference is that %R has an upside down scale and the Stochastic Oscillator has internal smoothing. To show the indicator in this upside down fashion, one places a minus symbol before the Williams Percent Range values (for example -30%). One should ignore the minus symbol when conducting the analysis.Indicator values ranging between 80 and 100% indicate that the market is oversold. Indicator values ranging between 0 and 20% indicate that the market is overbought. As with all overbought/oversold indicators, it is best to wait for the security’s price to change direction before placing your trades. For example, if an overbought/oversold indicator is showing an overbought condition, it is wise to wait for the security’s price to turn down before selling the security. An interesting phenomenon of the Williams Percent Range indicator is its uncanny ability to anticipate a reversal in the underlying security’s price. The indicator almost always forms a peak and turns down a few days before the security’s price peaks and turns down. Likewise, Williams Percent Range usually creates a trough and turns up a few days before the security’s price turns up.                                                
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_24">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image051.png') }}"/><br><br>
                                            <p>
                                                Willims’ Percent Range একটি সক্রিয় টেকনিক্যাল ইন্ডিকেটর (%R) যা বাজারের overbought/oversold স্থল নির্ণয় করে। Willims’ %R অনেকটাই Stochastics oscillator এর মত। পার্থক্য শুধুমাত্র %R এর স্কেল রয়েছে যা ওঠানামা পরিমাপ করে এবং Stochastics ছে আভন্তরীন স্বাচ্ছন্দ। যদি এই ইন্ডিকেটরটিকে ওঠানামা দেখতে হয় তবে Willims’ Percent Range এর মানের পূর্বে একটি (-) চিহ্ন বসাতে হবে যেমন(-)৩০%। এই মাইনাস চিহ্নটি বাদ দিতে হবে যখন কেউ এই ইন্ডিকেটরটির মান ৮০ হতে ১০০% ধরে নেয় যা বাজারের oversold অবস্থা নির্দেশ করে। ইন্ডিকেটরটির মান ০ হতে ২০% পর্যন্ত বাজারের overbought অবস্থা নির্দেশ করে। এটাই ভাল যে ট্রেড করার পূর্বে দামের পরিবর্তনের জন্য অপেক্ষা করা। এইক্ষত্রে অনান্য overbought/oversold ইন্ডিকেটরের মত Willims’ Percent Range-কে ব্যবহার করা উচিত। যেমনঃ যদি একটি overbought/oversold ইন্ডিকেটর overbought স্থল নির্দেশ করে তবে বিক্রি করার পূর্বে শেয়ারের মূল্য নিন্মগতি প্রাপ্ত হওয়া পর্যন্ত অপেক্ষা করাই উত্তম। তবে Willims’ Percent Range সম্পর্কে একটি অদ্ভূত ধারনা প্রচলিত আছে যে এটি শেয়ারমূল্যের রিভার্সেল বিচক্ষনতার সথে চিহ্নিত করতে ব্যর্থ। মুল্যের শীর্ষে ওঠা এবং নেমে আসার পূর্বে এই ইন্ডিকেটরটি সবসময় শীর্ষে পৌঁছায় এবং আবার নিচে নেমে আসে। একইভাবে, দাম বাড়ার কিছুসময় পূর্বে Willims’Percent Range স্বাভাবিকভাবে উপরে উঠে আসে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_13">
                        <strong><u>Money Flow Analysis :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_25" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_26" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_25">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image033.gif') }}"/><br><br>
                                            <p>
                                            Money Flow Index (MFI) is the technical indicator, which indicates the rate at which money is invested into a security and then withdrawn from it. With the only difference that volume is important to MFI. A positive money flow is a sum of positive money flows for a selected period of time. A negative money flow is the sum of negative money flows for a selected period of time. When money flow increase, the price of a share also increase and its true about 80% cases. Look at the graph, when money flow was increasing that time the price of the share also increasing and when money flow was decreasing that time price also decreasing. But one point must kept in mind if you find any MFI in oversold situation that is very good situation to entry. If you find any stocks MFI is in Overbought then it will be riskier to entry.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_26">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image033.gif') }}"/><br><br>
                                            <p>
                                                money flow এর মাধ্যমে লেনদেনের মান এবং কি পরিমান অর্থ আসছে এবং বেরিয়ে যাচ্ছে তা পরিমাপ করা যায়। মানি ফ্লো কিভাবে কাজ করে।? Money flow এর মাধ্যমে ডাইভারজেন্স যা দাম এবং অর্থের প্রবাহ পরিবর্তন চিহ্নিত করে। তাত্ত্বিকভাবে, একটি শেয়ারের দাম বাড়া মানে সেখানে অর্থ প্রবেশ করেছে। একইভাবে যখন একটি শেয়ারের দাম পড়ে আসে তার মানে সেখান হতে অর্থ বেরিয়ে যাচ্ছে। প্রত্যেকটি শেয়ারের ক্ষেত্রে money flow পরিবর্তিত হয় তার অতীত এবং বর্তমান লেভেলের উপর ভিত্তি করে যা একটি গুরুত্বপূর্ণ তথ্য। যখন একটি শেয়ারের ট্রেন্ড উপরের দিকে উঠতে থাকে তখন money flow একইসাথে উপরের দিকে উঠতে থাকে। এটি ৮০% সত্য যাতে কোন নুতন তথ্য যুক্ত করা হয়নি। money flow সেভাবেই কাজ করে যা তার কাছ থেকে আশা করা হয়। উপরের চিত্রে দেখতে পাচ্ছি দামের সাথে money flow ও বেড়ে চলেছে। যাহোক, যখন একটি শেয়ারের দাম বাড়তে থাকে এবং Money flow নিচের দিকে নেমে আসে যা বিয়ারিশ ডাইভারজেন্স ইংগিত করে। পরবর্তিতে দাম money flow-কে অনুসরন করে অর্থাৎ দাম ও নিচের দিকে নেমে আসে। এই মানি ফ্লোএর মাধমে আমরা বুঝতে পারি সত্যই কি ওই শেয়ারের প্রতি মানুষের চাহিদা আছে কিনা। আবার মানি ফ্লো যদি অনেক দিন over bought অবস্থতায় থাকে তবে বুঝতে হবে খুব তাড়াতাড়ি শেয়ারটির দাম পড়ে যেতে পারে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_14">
                        <strong><u>Chaikin Oscillator :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_27" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_28" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_27">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image011.png') }}"/><br><br>
                                            <p>
                                                the Chaikin Oscillator measures the momentum of the Accumulation Distribution Line using the MACD formula. This makes it an indicator of an indicator. The Chaikin Oscillator is the difference between the 3-day EMA of the Accumulation Distribution Line and the 10-day EMA of the Accumulation Distribution Line. Like other momentum indicators, this indicator is designed to anticipate directional changes in the Accumulation Distribution Line by measuring the momentum behind the movements. A momentum change is the first step to a trend change. Anticipating trend changes in the Accumulation Distribution Line can help chartists anticipate trend changes in the underlying security. The Chaikin Oscillator generates signals with crosses above/below the zero line or with bullish/bearish divergences. Look at the chart. When the indicator was in negative that time selling pressure was so high. Relatively when the indicator was in positive situation that time there was huge buying pressure.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_28">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image011.png') }}"/><br><br>
                                            <p>
                                                Chaikin Oscillator টি Accumulation Distribution Line এর momentum পরিমাপ করে। এবং এই পরিমাপের জন্য Chaikin Oscillator টি MACD formula ব্যাবহার করে থাকে। এটি একটি ইনডিকেটরেরে ইনডিকেটর হিসেবে কাজ করে থাকে। মুলত Chaikin Oscillator টি হচ্ছে Accumulation Distribution Line - এর ৩ দিন এবং ১০ দিনের Exponential Moving Average এর পার্থক্য। অন্যান্য indicator এর মত এই Indcator টি ও trend chaning নির্দেশনা দিয়ে থাকে। Chaikin Oscillator টি দিক নির্দেশনা দেয় যখন zero line এর ওপরে অথবা নিচে crossover হয়।এই ব্যাবহার করে খুব সাধারন ভাবে ক্রয় এবং বিক্রয় করা যায়। ক্রয় এবং বিক্রয়ের সিধান্তটি positive অথবা negative মানের ওপর নিরভর করে থাকে। ক্রয়ের চাপ বেশি লক্ষ করা যায় যখন indicator টি positive থাকে ঠিক একই ভাবে বিক্রয়ের চাপ বেশি থাকে যখন indicator টি negative থাকে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_15">
                        <strong><u>Demand Factor :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_29" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_30" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_29">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image017.png') }}"/><br><br>
                                            <p>
                                                In any market demand and supply is very important factor. In technical analysis trader can measures the demand and supply factor by watching trading volume and price action. It will be very easy to understand to find out demand situation and supply situation. So at first you need to identify Lack of Demand and Supply. Lack of demand means there is no demand for a particular stock in market. if you see price of a particular share is increasing but volume is not increasing that much and difference between opening price and closing price is very low then you can assume there is a lack of demand. And after few days the price will go down because smart money is not interested to that share. look at the graph. Before October month the spread of price was low but the volume was not increase that much so here is a lack of demand. After few days the price went down.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_30">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image017.png') }}"/><br><br>
                                            <p>
                                                শেয়ার বাজারে চাহিদা এবং যোগান (ডিমান্ড অ্যান্ড সাপ্লাই) বিষয়টি খুবই গুরুত্বপূর্ণ একটি বিষয়। টেকনিক্যাল আনাল্যসিসে আপনি ভলিউম এবং দামের গতি দেখে সহজেই বিষয়টি ধরতে পারবেন। একজন বিনিয়োগকারী অথবা আনালিস্ট ডিমান্ড এবং সাপ্লাই বিবেচনা করে মার্কেটে ঢুকবেন কি ঢুকবেন না নিরধারন করে থাকেন। সেই সাথে আর ও কিছু বিবেচনার বিষয় রয়েছে যেমন - analysis of trading volume, price action and price spreads. শেয়ার বাজার আপনার কাছে আরও সহজ এবং বোধগম্য হয়ে উঠবে যখন আপনি নিজে নিজেই বুঝতে পারবেন বাজার কি ঊর্ধ্বমুখী হবে অথবা নিন্মমুখি থাকবে। এর জন্য আপনাকে দুইটি বিষয় সম্পর্কে খুব ভাল ধারনা রাখতে হবে। একটি হচ্ছে Lack of demand এবং Supply । এই Lack of demand হচ্ছে বাজারে একটি শেয়ারের প্রতি বিনিয়োগকারীদের চাহিদা তুলনা মুলক ভাবে কম থাকে। আপনাকে বুঝতে হবে বাজারে demand কতটুকু আছে। যদি আপনি দেখেন একটি শেয়ারের দাম বেড়েছে কিন্তু ভলিউম সেই সাথে বাড়েনি এবং দামের সর্বউচ্চ এবং সর্বণিন্ম সীমার মধ্য পার্থক্য খুবই কম তবে ধরে নিতে হবে বাজারে এই শেয়ারটির demand কম রয়েছে। এবং কয়েক দিন পর দেখতে পাবেন দাম কমে যাচ্ছে। এর কারন হচ্ছে স্মার্টমানি ঐ শেয়ারটি কিনতে আগ্রহী নয়। ফলে দাম ধিরে ধিরে কমতে থাকে। চিত্রে লক্ষ্য করলে দেখতে পাবেন অক্টোবর মাসের কয়েকদিন আগে শেয়ারটির দাম কিছুটা spreads করেছিল কিন্তু সেই সাথে ভলিউম কিন্তু Average ভাবে বৃদ্ধি পায়নি। ফলে Lack of Demand বুঝা যাচ্ছিল এবং দেখুন ঠিক কিছু দিন পরই আবার দাম কমতে শুরু করে। এই ধরনের এনাল্যসিসের মাধ্যমে আপনি একটি শেয়ারের গতিবিধি সম্পর্কে ধারনা রাখতে পারবেন এবং আপনি কখন শেয়ারটি ক্রয় করবেন এবং কখন বিক্রয় করবেন সেই সম্পর্কে ও পরিষ্কার ধারনা রাখতে পারবেন। সুতরাং এই ডিমান্ড ফ্যাক্টরটি খুবই গুরুত্বপূর্ণ।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_16">
                        <strong><u>Importance of Volume :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_31" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_32" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_31">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image030.png') }}"/><br><br>
                                            <p>
                                            Technical analyst always focuses on volume. Actually what does it mean by volume? Normally volume is the number of share treaded in a particular day. High volume expresses the activeness of the share. For tracing the movement of volume an analyst normally use Volume bar. Now question why volume is so important? Yes volume is important because volume confirm the various chart patterns and trends. If you see price of a share is increasing without volume support then you can take it as a fake breakout and it will not sustain for long period. Assume after a downtrend price changes dramatically (5%) and volume does not increase. Will you consider it as a upward trend? No we cannot because it is a spike and we have to avoid this fake spike. we can say the trend is changing when volume will gradually increase. So volume confirms the trend and patterns.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_32">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image030.png') }}"/><br><br>
                                            <p>
                                                অনেক টেকনিক্যাল এনালিস্টকে আমরা ভলিউম নিয়ে কথা বলতে শুনি। আসলে ভলিউম বলতে আমরা কি বুঝি? সাধারণত ভলিউম হচ্ছে একটি দিনের লেনদেনকৃত শেয়ারের সংখ্যা। বেশি পরিমানের ভলিউম একটি শেয়ারের সক্রিয়তা প্রকাশ করে থাকে। ভলিউম এর মুভেমেন্ট বোঝার জন্য (আপ অথবা ডাউন), এনালিস্টরা সাধারণত ভলিউম বার দেখে থাকেন। এখন প্রশ্ন হচ্ছে এই ভলিউম বিষয়টি এত গুরুত্বপূর্ণ কেন এবং এই ভলিউম আনাল্যসিস করে আপনার কি লাভ হবে। হ্যাঁ ভলিউম টেকনিক্যাল আনাল্যসিস এর একটি গুরুত্বপূর্ণ বিষয় কারন এই ভলিউমই একটি ত্রেন্ড এবং চার্ট প্যাটার্ন গুলোকে নিশ্চিত করে থাকে। দাম যদি ঊর্ধ্বমুখী অথবা নিন্মমুখি হয় তবে সাথে সাথে বেশি পরিমান ভলিউমও দেখতে পাওয়া যায়। আপনি যদি দেখেন একটি শেয়ারের দাম হু হু করে বাড়ছে কিন্তু সেই সাথে ভলিউম সেই পরিমানে বৃদ্ধি পাচ্ছে না তখন আপনি ধরে নিতে পারেন এই দাম বৃদ্ধিটি একটি অস্বাভাবিক বৃদ্ধি এবং দামের ঊর্ধ্বমুখী প্রবণতা বেশি দিন টিকবে না। ধরুন আপনি দেখলেন একটি শেয়ার অনেক দিন ডাউন ট্রেেন্ড থাকার পর হুটকরে একদিন ৫% দাম বৃদ্ধি পেলো।আপনি কি এই বৃদ্ধিকে একটি রেভারসাল ট্রেন্ড ধরবেন? এই ক্ষেত্রে ভলিউম আনাল্যসিস আপনাকে সাহায্য করবে। যদি ভলিউম আগের দিন গুলোর থেকে বেশি হয় তবে আপনি এটিকে রেভারসাল ট্রেন্ড হিসেবে ধরতে পারেন। কিন্তু যদি ভলিউম আগের দিন গুলোর থেকে বেশি না হয় তবে আপনার বুঝতে হবে এটি কোন রেভারসাল ট্রেন্ড নয়। সুতরাং ভলিউমের সম্পর্ক সব সময় ট্রেন্ডের সাথে
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_17">
                        <strong><u>Price Volume Trend :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_33" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_34" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_33">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image039.png') }}"/><br><br>
                                            <p>
                                            Price Volume Trend combines percentage price change and volume to confirm the strength of price trends or through divergences, warn of weak price moves. Unlike other price-volume indicators, the Price Volume Trend takes into consideration the percentage increase or decrease in price, rather than just simply adding or subtracting volume based on whether the current price is higher than the previous day's price. How the formula is calculated is presented below: 1. On an up day, the volume is multiplied by the percentage price increase between the current close and the previous time-period's close. This value is then added to the previous day's Price Volume Trend value. 2. On a down day, the volume is multiplied by the percentage price decrease between the current close and the previous time-period's close. This value is then added to the previous day's Price Volume Trend value. When the price increases that time if price volume trend also increase then it will be a upward trend. Similarly when price goes down and same time price volume trend also goes down it will be a downward trend. Now notice very carefully when the price of this share was increasing but Price volume trend was not increasing. So we can assume that this upward trend is not strong enough. Similarly when price decrease but price volume trend is not increase then the downtrend will not be strong enough.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_34">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image039.png') }}"/><br><br>
                                            <p>
                                            Price Volume Trend ইনডিকেটরটি হচ্ছে একটি শেয়ারের মূল্য এবং ভলিউমের শতকরা পরিবর্তনের হার যা মূল্যর পরিবর্তনের গতি কতটা মজবুত সেইটি প্রকাশ করে থাকে। Price Volume Trend ইনডিকেটরটি সাধারণত অনন্যা Price Volume ইনডিকেটরের মত শুধু আগের দিনের সর্বউচ্চ এবং সর্বনিন্ম মূল্য যোগ অথবা বিয়োগ করে না বরং মূল্যর পরিবর্তনের শতকরা হার নিয়ে কাজ করে থাকে। একটি upward দিনের ভলিউম কে গুন করা হয় সেই দিনের মূল্যর শতকরা বৃদ্ধির হার এবং সেই দিনের ক্লোজিং এবং আগের দিনের ক্লোজিং মূল্যর সাথে। তারপর প্রাপ্ত মানটির সাথে আগের দিনের Price Volume Trend -এর সাথে যোগ করা হয়। আবার একটি Downward দিনের ভলিউম কে গুন করা হয় সেই দিনের মূল্যর শতকরা হ্রাসের হার এবং সেই দিনের ক্লোজিং এবং আগের দিনের ক্লোজিং মূল্যর সাথে। তারপর প্রাপ্ত মানটির সাথে আগের দিনের Price Volume Trend -এর সাথে যোগ করা হয়। এখন প্রশ্ন হচ্ছে এই ইনডিকেটরটি আপনাকে কি ভাবে সাহায্য করবে? এই ইনডিকেটরটি আপনাকে divergences বুঝতে সাহায্য করে থাকে। চিত্রতে লক্ষ্য করুন। যখন শেয়ারটির মূল্য বৃদ্ধি পাচ্ছে তখন সেই সাথে যদি Price Volume Trend ও বৃদ্ধি পায় তবে সেটি Upward Trend বুঝিয়ে থাকে। আবার যখন শেয়ারটির মূল্য কমতে থেকে তখন সেই সাথে যদি Price Volume Trend ও কমতে থেকে তবে সেটি হবে Downward Trend। এবার লক্ষ্য করুন যখন শেয়ারটির মূল্য বৃদ্ধি পাচ্ছে তখন সেই সাথে যদি Price Volume Trend কমতে থাকে তবে বুঝতে হবে upward Trend টি খুব একটা Strong না। একই ভাবে দেখা যায় আবার যখন শেয়ারটির মূল্য কমতে থাকে তখন সেই সাথে যদি Price Volume Trend বৃদ্ধি পেতে থাকে তবে বুঝতে হবে Downward Trend টি খুব একটা Strong না।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_18">
                        <strong><u>Identify Bullish & Bearish Volume :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_35" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_36" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_35">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image029.png') }}"/><br><br>
                                            <p>
                                                As we know Volume is very important in Technical Analysis we also need to know about bullish and bearish volume. You can easily identify bullish and bearish volume if you know the Volume analysis. Suppose when you see price of a particular share is increasing and volume also increasing then you can take it as a bullish volume. look at the graph. When price was increasing the volume was increasing and spread between opening and closing price was high. So we can say this is a bullish volume. Similarly in figure - 2 when the price was decreasing the volume were decreasing and spread between opening and closing price was high. So we can say this is a bearish volume.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_36">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image029.png') }}"/><br><br>
                                            <p>
                                                কিভাবে আমরা বুলিশ এবং বিয়ারিশ ভলিউম চিহ্নিত করতে পারি। আমরা এই বুলিশ এবং বিয়ারিশ ভলিউম দেখে বাজারের চাহিদা এবং যোগান সম্পর্কে ও ধারনা পেতে পারি। যখন আপনি দেখেন বাজারে একটি শেয়ারের দাম বাড়ছে এবং সেই সাথে ভলিউম ও বৃদ্ধি পাচ্ছে তার মানে কি হচ্ছে? বাজারে কি চাহিদা বৃদ্ধি পাচ্ছে? হ্যাঁ আপনি এই প্রশ্ন গুলোর উত্তর সহজেই দিতে পারবেন যদি আপনি ভলিউম এনালাইসিস জানেন। এখন আসুন দেখি কি ভাবে এই বুলিশ এবং বিয়ারিশ ভলিউম চিহ্নিত করা যায়। চিত্র - ১ এ লক্ষ্য করুন। দেখা যাচ্ছে শেয়ারটির দাম বাড়ছে এবং প্রারম্ভিক এবং সমাপনী মূল্যর মধ্যে পার্থক্যের পরিমান বেশি এবং সেই সাথে ভলিউম ও বৃদ্ধি পাচ্ছে। আমরা এই ভলিউমটিকে বুলিশ ভলিউম বলতে পারি। কারন সেই সময় বাজারে চাহিদা বেশি ছিল এবং সাথে সাথে দাম ও বাড়ছিল। আবার ঠিক একই ভাবে চিত্র - ২ এ লক্ষ্য করুন, দেখবেন শেয়ারটির দাম কমছিল এবং পারম্ভিক এবং শমাপনী মূল্যর মাঝে ও পার্থক্য বেশি ছিল। এবার ভলিউম দেখুন। ভলিউম কিন্তু আগের দিনের থেকেও বেশি ছিল।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_19">
                        <strong><u>On Balance Volume (OBV) :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_37" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_38" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_37">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image036.png') }}"/><br><br>
                                            <p>
                                                Joe Granville introduced the On Balance Volume (OBV) indicator in his 1963 book, Granville's New Key to Stock Market Profits. This was one of the first and most popular indicators to measure positive and negative volume flow. The concept behind the indicator: volume precedes price. OBV is a simple indicator that adds a period's volume when the close is up and subtracts the period's volume when the close is down. A cumulative total of the volume additions and subtractions forms the OBV line. This line can then be compared with the price chart of the underlying security to look for divergences or confirmation. The idea behind the OBV indicator is that changes in the OBV will precede price changes. A rising volume can indicate the presence of smart money flowing into a security. Then once the public follows suit, the security's price will likewise rise. Like other indicators, the OBV indicator will take a direction. A rising (bullish) OBV line indicates that the volume is heavier on up days. If the price is likewise rising, then the OBV can serve as a confirmation of the price uptrend. In such a case, the rising price is the result of an increased demand for the security, which is a requirement of a healthy uptrend. However, if prices are moving higher while the volume line is dropping, a negative divergence is present. This divergence suggests that the uptrend is not healthy and should be taken as a warning signal that the trend will not persist. The numerical value of OBV is not important, but rather the direction of the line. A user should concentrate on the OBV trend and its relationship with the security's price.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_38">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image036.png') }}"/><br><br>
                                            <p>
                                                ১৯৬৩ সালে Joe Granville রচিত “Granville’s New Key to Stock Market Profits” বইতে তিনি On Balance Volume ইন্ডিকেটরটিকে পরিচিত করেন। এটি প্রথম এবং সবচেয়ে জনপ্রিয় indicator যা পজিটিভ ও নেগেটিভ volume এর মাত্রা পরিমাপ করে।এর পেছনে যে ধারণা কাজ করে তা হচ্ছে দামে পরিবর্তন ঘটলে Volume তার প্রভাব পড়ে। OBV একটি সাধারণ ইন্ডিকেটর যখন সমাপ্তি মূল্য শীর্ষে থাকে তখন একটি নির্দিষ্ট সময়ের volume যুক্ত করা হয় এবং যখন সমাপ্তি মূল্য নিন্মে থাকে তখন একটি নির্দিষ্ট সময়ের volume বাদ দেয়া হয়।একটি ক্রমবর্ধমান volume –এর সমষ্টি যা যোজন ও বিয়োজনের মাধ্যমে OBV Line সৃস্টি করে। পরবর্তীতে divergence অথবা একটি শেয়ার সম্পর্কে সঠিক তথ্য পেতে এই রেখটিকে(OBV) price chart এর সঙ্গে তুলনা করা হয়। এই indicator –এর পেছনে যে ধারণা কাজ করে তা হচ্ছে দামের পরিবর্তনে OBV-র পরিবর্তন সংঘটিত হয়। একটি বর্ধিত volume দ্বারা আমরা বুঝতে পারি একটি শেয়ারে কি পরিমান অর্থের যোগান রয়েছে। যখনই লোকজন direction অনুসরন করবে তখনই একটি শেয়ারের দাম বাড়তে থাকবে। অনান্য ইন্ডিকেটর এর মত OBV ইন্ডিকেটররে নির্দিষ্ট দিক আছে। একটি উঠতি (bullish)OBV রেখা উর্ধ্বমূখী বাজারে volume –এর আধিক্য নির্দেশ করে।যদি এর সাথে দামও বাড়তে থাকে তবে OBV নিশ্চিত uptrend –র সংকেত দেয়। এইক্ষেত্রে, দাম বেড়ে যাওয়া মানে একটি শেয়ারের চাহিদা বেড়েছে যা একটি সুনির্দিষ্ট uptrend-র জন্য প্রয়োজন। যাহোক,যদি দাম বাড়তে থাকে এবং volume নিচের দিকে নেমে আসে সেক্ষেত্রে নেগেটিভ divergence সৃস্টি হয়। এই divergence আমাদের অনির্দিষ্ট uptrend এবং এই ট্রেন্ড যে ক্ষণস্থায়ী সে সম্পর্কে সর্তক করে। OBV –র নিউমারিক্যাল ভ্যালু ততটা গুরুত্বপূর্ণ নয় যতটা এর গতি কি হবে তা বিবেচ্য।ব্যবহারকারী শুধুমাত্র OBV –র ট্রেন্ড লক্ষ্য করবে এবং শেয়ারের দামকে পর্যবেক্ষন করবে যা এর সাথে সম্পর্কযুক্ত।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_20">
                        <strong><u>Support and Resistance :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_39" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_40" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_39">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image045.png') }}"/><br><br>
                                            <p>
                                                Support defines that level where buyers are strong enough to keep price from falling further. Resistance defines that level where sellers are too strong to allow price to rise further. Support and resistance are created because price has memory. Those prices where significant buyers or sellers entered the market in the past will tend to generate a similar mix of participants when price again returns to that level. When price pushes above resistance, it becomes a new support level. When price falls below support, that level becomes resistance. When a level of support or resistance is penetrated, price tends to thrust forward sharply as the crowd notices the BREAKOUT and jumps in to buy or sell. When a level is penetrated but does not attract a crowd of buyers or sellers, it often falls back below the old support or resistance. This failure is known as a FALSE BREAKOUT. Support and resistance come in all varieties and strengths. They most often manifest as horizontal price levels. But trend lines at various angles represent support and resistance as well. The length of time that a support or resistance level exists determines the strength or weakness of that level. The strength or weakness determines how much buying or selling interest will be required to break the level. Also, the greater volume traded at any level, the stronger that level will be. Support and resistance exist in all time frames and all markets. Levels in longer time frames are stronger than those in shorter time frames.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_40">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image045.png') }}"/><br><br>
                                            <p>
                                            সাপোর্ট বলতে সেই মূল্যস্তরকে নির্দেশ করে যেখানে ক্রেতা একটি সুদৃঢ় অবস্থানে থেকে মূল্যের পতন রোধ করে। রেজিস্টেন্স হচ্ছে সেই মূল্যস্তর যেখানে বিক্রেতা সুদৃঢ় অবস্থানে থেকে মূল্যের উর্ধ্বগতিকে ধরে রাখে। আতীত মূল্যের উপর ভিত্তি করে সাপোর্ট ও রেজিস্টেন্স লেভেল তৈরিহয়।সাপোর্ট ও রেজিস্টেন্স লেভেল হচ্ছে সেই মুল্যস্তর যেখানে নির্দিষ্ট সময়ে বিশেষ কিছু ক্রেতা/বিক্রেতা বাজারে প্রবেশ করে এবং পরবর্তীতে আরোকিছু ক্রেতা/বিক্রেতা প্রবেশ করে মূল্যকে তার আগের অবস্থানে ফিরিয়ে আনে। যখন মূল্য রেজিস্টেন্স লেভেলকে অতিক্রম করে তখন তা সাপোর্ট হিসেবে পরিগনিত হয়।আবার যখন মূল্য পতিত হয়ে নিচে একটি নুতন অবস্থান নেয় তখন তা সাপোর্ট হিসেবে কাজ করে।যখন সাপোর্ট বা রেজিস্টেন্স পরিবর্তীত হয়ে একটি নুতন রেজিস্টেন্স লেভেল তৈরি করে তখন দাম দ্রুতগতিতে উপরের দিকে ঊঠে আসে যা ব্রেকাউট বা মূল্যবৃদ্ধি নির্দেশ করে।যখন একটি লেভেল পরিবর্তিত হয় কিন্তু যা পর্যাপ্ত পরিমাণ ক্রেতা বা বিক্রেতা আকৃষ্ট করতে পারেনা তখন তা অতীতের সাপোর্ট বা রেজিস্টেন্সে লেভেল অতিক্রম করে আরো নিচে নেমে আসে। এই পতনকে কৃত্রিম ব্রেকাঊট বলা হয়। সাপোর্ট ও রেজিস্টেন্স লেভেল তার বিভিন্নতা এবং সহনীয়তা নিয়ে অবস্থান করে।এরা অনূভূমিকভাবে মূল্যের মাত্রা/স্থল নির্দেশ করে। বিভিন্ন আঙ্গিকের ট্রেন্ডলাইনগুলি সাপোর্ট ও রেজিস্টেন্স হিসেবে কাজ করে।যে সময় নিয়ে সাপোর্ট/রেজিস্টেন্স একটি লেভেলে অবস্থান করে তা সেই স্থলের সহনীয়তা বা দূর্বলতা। এই অবস্থানগুলি সে স্থল থেকে বেরিয়ে আসতে কি পরিমান ক্রয় বা বিক্রয়ের প্রয়োজন তা নির্দেশ করে।যতই একটি অবস্থানে ভলিউম বাড়তে থাকবে ততই সে অবস্থানটি সুদৃঢ় হবে। সাপোর্ট ও রেজিস্টেন্স সকল সময়ে এবং সব বাজারেই অবস্থিত। একটি স্তরে দীর্ঘ সময়ে অবস্থান সে স্তরের সুদৃঢ় এং স্বল্প সময়ের অবস্থান সে স্থলের দূর্বলতাকে নির্দেশ করে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_21">
                        <strong><u>Channel :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_41" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_42" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_41">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image012.png') }}"/><br><br>
                                            <p>
                                                If we take this trend line theory one step further and draw a parallel line at the same angle of the uptrend or downtrend, we will have created a channel. To create an up (ascending) channel, simply draw a parallel line at the same angle as an uptrend line and then move that line to position where it touches the most recent peak. This should be done at the same time you create the trend line. To create a down (descending) channel, simple draw a parallel line at the same angle as the downtrend line and then move that line to a position where it touches the most recent valley. This should be done at the same time you created the trend line. When prices hit the bottom trend line this may be used as a buying area. When prices hit the upper trend line this may be used as a selling area.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_42">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image012.png') }}"/><br><br>
                                            <p>
                                                যদি আমরা Uptrend ও downtrend এই দুই ধারাকে কেন্দ্র করে যদি সমভাবে দু’টি রেখা অঙ্কন করি তবে আমরা একটি channel পেয়ে যাই। ঊর্ধ্বগতির (ascending) চ্যানেল পেতে হলে up trend বরাবর সমভাবে দু’টি রেখা টেনে যেতে হবে যা সম্প্রতি তার শীর্ষ অবস্থানকে স্পর্শ করেছে। এটি তৈরীর সময় আপনি trend line ও পেয়ে যাবেন। নিন্মগতির (descending) চ্যানেল পেতে হলে down trend বরাবর সমভাবে দু’টি রেখা টেনে যেতে হবে যা সম্প্রতি তার তলদেশকে স্পর্শ করেছে।আপনি চ্যানেল ও ট্রেন্ড লাইন একইসাথে পেয়ে যাবেন। যখন দাম নিচের ট্রেন্ডলাইনটিকে স্পর্শ করে তখন তা ক্রয়ের স্থান (buying area) হিসেবে বিবেচিত হয়। যখন দাম উপরের ট্রেন্ডলাইনটিকে স্পর্শ করে তখন তা বিক্রয়স্থান (selling area) হিসেবে বিবেচিত হয়। চিত্রটিতে দেখুন Trend গুলোকে Uptrend and Downtrend অনুযায়ী ভাগ করা হয়েছে। এর জন্য একটি নিচে এবং ওপরে দুইটি দাগ দিয়ে Channel তৈরি করা হয়েছে। এই Channel এর উপকারিতা হলো আপনি অনেক সহজে Trend line পেয়ে যাবেন এবং বুঝতে পারবেন বাজার কোনদিকে যাচ্ছে ফলে আপনার সিদ্ধান্ত নিতে কোনোরকম বিলম্ব হবে না। সেই সাথে পরবর্তী কোন হতে পারে সেই সম্পর্কে ও আপনি কিছু আগাম ধারনা পেতে পারেন। channel এর উপরকিতা হচ্ছে আপনি একটি শেয়ার ক্রয় করার সময় তার support level থেকেই ক্রয় করতে পারবেন এবং একটি লম্বা পর্যন্ত অবস্থান নিতে
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_22">
                        <strong><u>Ascending & Descending Triangles Chart Pattern :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_43" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_44" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_43">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image013.jpg') }}"/><br><br>
                                            <p>
                                                Ascending and descending triangles are short-term investor favorites, because the trends allow short-term traders to earn from the same sharp price increase that long-term investors have been waiting for. Rather than holding on to a stock for months or years before you finally see a big payday, you can buy and hold for only a period of days and reap in the same monster returns as the long-time stock owners. As with many of our favorite patterns, when you learn to identify ascending and descending triangles, you can profit from upwards or downwards breakouts. That way, you’ll earn a healthy profit regardless of where the market is going. Set Your Target Price: For ascending and descending triangles, sell your stock at a target price of:  Entry price plus the pattern’s height for an upward breakout.  Entry price minus the pattern’s height for a downward breakout. To Profit from Symmetrical Triangles: Symmetrical triangles are very reliable. You can profit from upwards or downwards breakouts. You’ll learn more about how to earn from downtrends when we talk about maximizing profits. If you see a symmetrical triangle forming, watch it closely. The sooner you catch the breakout, the more money you stand to make. Watch For:  Sideways movement, a period of rest, before the breakout.  Price of the asset traveling between two converging trendlines.  Breakout ¾ of the way to the apex. Set Your Target Price: As with all patterns, knowing when to get out is as important as knowing when to get in. Your target price is the safest time to sell, even if it looks like the trend may be continuing. For symmetrical triangles, sell your stock at a target price of:  Entry price plus the pattern’s height for an upward breakout.  Entry price minus the pattern’s height for a downward breakout.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_44">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image013.jpg') }}"/><br><br>
                                            <p>
                                                স্বল্প মেয়াদী বিনিয়োগকারীদের কাছে Ascending এবং Descending Triangles জনপ্রিয় কারন স্বল্পমেয়াদী ট্রেডাররা এই ট্রেন্ডটি ব্যবহারের মাধ্যমে সেই পরিমান মুনাফা অর্জন করতে পারেন যার জন্যে দীর্ঘমেয়াদী বিনিয়োগকারী দীর্ঘ সময় ধরে অপেক্ষা করে থাকেন। বরং একটি শেয়ারকে দীর্ঘদিন ধরে না রেখে এই triangles ব্যবহার করে আপনি শেয়ার কিনে তা অল্প কিছুদিন ধরে রেখে দীর্ঘমেয়াদী বিনিয়োগকারীদের সমান মুনাফা লাভ করতে পারেন। অনান্য জনপ্রিয় প্যাটার্ণগুলোর মত আপনি যখন চার্টে ascending এবং descending triangles শনাক্ত করতে পারবেন তখন আপনি উর্ধ্বমূখী বা নিন্মগামী ব্রেকাউট চিহ্নিত করে তা হতে মুনাফা অর্জন করতে পারবেন।এভাবে বাজার যেদিকেই অবস্থান নিক না কেন আপনি ভালরকম মুনাফা অর্জন করতে পারেন। তিন এবং চার সপ্তাহের মধ্যে একটি ascending এবং descending প্যাটার্ণ সৃষ্টি হয়।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_23">
                        <strong><u>Neutral Candlestick Pattern :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_45" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_46" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_45">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image035.png') }}"/><br><br>
                                            <ol>
                                                <li>Marubozu: Marubozu indicates that there are no shadows from the bodies. A white Marubozu is a long white body without anyshadows and indicates a bullish trend. It generally becomes the first part of a bullish continuance or a bullish reverssal pattern. Black Marubozu is a long black body without any shadows. It generally implies bearish continuation or bearish reversal. Spinning tops. These are neutral lines. They occur when the distance between the high and low, and the distance between the open and close, are relatively small.</li>
                                                <li>Doji. This line implies indecision. The security opened and closed at the same price. These lines can appear in several different patterns. Double doji lines (two adjacent doji lines) imply that a forceful move will follow a breakout from the current indecision.</li>
                                                <li>Harami ("pregnant" in English). This pattern indicates a decrease in momentum. It occurs when a line with a small body falls within the area of a larger body. In this example, a bullish (empty) line with a long body is followed by a weak bearish (filled-in) line. This implies a decrease in the bullish momentum.</li>
                                                <li>Harami cross. This pattern also indicates a decrease in momentum. The pattern is similar to a harami, except the second line is a doji (signifying indecision).</li>
                                            </ol>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_46">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image035.png') }}"/><br><br>
                                            <ol>
                                                <li>Marubozu: এই কেন্ডেলস্টিকটির সাধারণত কোন ওপরের দিকে কোন ছায়া থাকে না অর্থাৎ কোন শরবচ্ছো বা সর্বনিম্ন মূল্য থাকে না। যদি এই কেন্ডেল টি সবুজ হয় তবে সেটি বুলিশ এবং লাল হলে বিয়ারিশ ধারা বুঝিয়ে থাকে।</li>
                                                <li>Doji: এটি অনিশ্চয়তার ইঙ্গিত বহন করে। যদি শেয়ারের প্রারম্ভিক ও সমাপ্তি মূল্য একই হয় তবে এটি সংঘটিত হয়।এই রেখাগুলি বিভিন্ন প্যাটার্ণে আবির্ভূত হতে পারে।যুগল ডজি রেখাদ্দ্বয় বর্তমান অনিশ্চয়তা থেকে বেরিয়ে একটি শক্তিশালী ব্রেকাউটের ইঙ্গিত দেয়।</li>
                                                <li>Harami: এই প্যাটার্ণটি নিন্মগামী গতি ইঙ্গিত করে।ছোট শরীরবিশিষ্ট রেখা যখন বড় একটি রেখার মধ্যবর্তী হয় তখন এটি সৃষ্টি হয়।উদাহরণস্বরুপ,আমরা দেখতে পাচ্ছি বিয়ারিশ রেখাটি বুলিশ রেখাটিকে অনুসরন করছে যা বুলিশের নিন্মগতি ইঙ্গিত করছে।</li>
                                                <li>Harami cross: এটি গতিহ্রাস্ব প্রকাশ করে।এটি harami –র মতো কিন্তু পরবর্তী রেখাটি ডজি যা অনিশ্চয়তার ইঙ্গিত দেয়।</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_24">
                        <strong><u>Reversal Candlestick Pattern :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_47" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_48" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_47">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image042.png') }}"/><br><br>
                                            <ol>
                                                <li>Long-legged doji. This line often signifies a turning point. It occurs when the open and close are the same, and the range between the high and low is relatively large. it expresses the indecision of buyers and also for sellers.</li>
                                                <li>Dragon-fly doji. This line also signifies a turning point. It occurs when the open and close are the same, and the low is significantly lower than the open, high, and closing prices. This signal is a reversal after a downtrend and expresses that control has shifted sellers to buyers.</li>
                                                <li>Gravestone doji. This line also signifies a turning point. It occurs when the open, close, and low are the same, and the high is significantly higher than the open, low, and closing prices.</li>
                                                <li>Four Price Doji: Open, High, Low and close are all the same for a trading day. Its a very distinctive line that indicates the indecision of the traders, or a very quite market.</li>
                                                <li>Star. Stars indicate reversals. A star is a line with a small real body that occurs after a line with a much larger real body, where the real bodies do not overlap. The shadows may overlap.</li>
                                                <li>Doji star. A star indicates a reversal and a doji indicates indecision. Thus, this pattern usually indicates a reversal following an indecisive period. You should wait for a confirmation (e.g., as in the evening star illustration) before trading a doji star.</li>
                                            </ol>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_48">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image042.png') }}"/><br><br>
                                            <ol>
                                                <li>Long-legged doji: এই রেখাটি সবসময় একটি পরিবর্তনের ইঙ্গিত বহন করে।এটি তখনই সংঘটিত হয় যখন প্রারম্ভিক ও সমাপ্তি মূল্য একই থাকে এবং সর্বোচ্চ ও সর্বনিন্ম মূল্যের দূরত্ব পারস্পারিকভাবে অধিক হয়।</li>
                                                <li>Dragon-fly doji: এই রেখাটি ও পরিবর্তনের আভাস দেয়।করে।এটি তখনই সংঘটিত হয় যখন প্রারম্ভিক ও সমাপ্তি মূল্য একই থাকে এবং সর্বনিন্ম মূল্য প্রারম্ভিক, সর্বোচ্চ ও সমাপ্তি মূল্যের চেয়ে কম থাকে।</li>
                                                <li>Gravestone Doji: এই রেখার মাধ্যমেও আমরা পরিবর্তনের আভাস পাই।এটি আমরা দেখতে পাই যখন প্রারম্ভিক,সমাপ্তি ও সর্বোনিন্ম মুল্য একই অবস্থানে থাকে এবং সর্বোচ্চ মূল্য প্রারম্ভিক,সমাপ্তি ও সর্বনিন্ম মূল্যের চেয়ে বেশি থাকে।</li>
                                                <li>Four Price Doji: এই কেন্ডেলস্টিকটির কোন শরবচ্ছ বা শরবনিন্ম কোন মূল্য থাকে না শুধু পারম্ভিক এবং শমাপনি মূল্য থাকে। এই পারম্ভিক এবং শমাপনি মূল্যর মাঝে ও কোন বেবধান থাকে না।</li>
                                                <li>Star: স্টারগুলি রিভারসেলের ইঙ্গিত দেয়।একটি বড় রেখার(রিয়েল বডি)পর এই রেখাটি ছোট দেহ নিয়ে আবির্ভুত হয়।যখন এটি বিয়ারিশ প্যাটার্ণের পর আবির্ভূত হয় তখন তা downtrend নির্দেশ করে এবং বুলিশ প্যাটার্ণের পর আবির্ভূত হয় তখন তা uptrend নির্দেশ করে।তবে স্টারটির অবশ্যই ছায়া থাকতে হবে অন্যথায় এটি স্টার হিসেবে গণ্য হবে না।</li>
                                                <li>Doji star: স্টারটি রিভেরসেলের এবং ডজিটি সিদ্ধান্তহীনতা নির্দেশ করে।যদিও এটি অনিশ্চিত সময়ে রিভারসেলের ইঙ্গিত দেয়।ট্রেড করার পূর্বে এই ডজি দেখার পর আপনাকে অপেক্ষা করতে হবে।</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_25">
                        <strong><u>Divergence Trading :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_49" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_50" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_49">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image018.png') }}"/><br><br>
                                            <p>
                                                divergence can be seen by comparing price action and the movement of an indicator. It doesn't really matter what indicator you use. You can use RSI, MACD, the stochastic, CCI, etc. The great thing about divergences is that you can use them as a leading indicator, and after some practice it's not too difficult to spot. When traded properly, you can be consistently profitable with divergences. The best thing about divergences is that you're usually buying near the bottom or selling near the top. This makes the risk on your trades are very small relative to your potential reward. Just think "higher highs" and "lower lows". Price and momentum normally move hand in hand. If price is making higher highs, the oscillator should also be making higher highs. If price is making lower lows, the oscillator should also be making lower lows. If they are NOT, that means price and the oscillator are diverging from each other. And that's why it's called "divergence." A regular divergence is used as a possible sign for a trend reversal. If price is making lower lows (LL), but the oscillator is making higher lows (HL), this is considered to be regular bullish divergence. This normally occurs at the end of a down trend. After establishing a second bottom, if the oscillator fails to make a new low, it is likely that the price will rise, as price and momentum are normally expected to move in line with each other.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_50">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image018.png') }}"/><br><br>
                                            <p>
                                                Divergence Trading টি হলো একটি শেয়ার যখন বোটম লেভেলে থাকে তখন ক্রয় করা এবং যখন টপ লেভেলে থাকে ঠিক তখন বিক্রয় করা। আপনি এই Divergence Trading করার জন্য MACD, stochastic ইনডিকেটরগুলো ব্যাবহার করতে পারেন। এই ট্রেডিং পদ্ধতিটি ব্যাবহার করতে আপনাকে আরও কিছু বিষয় সম্পর্কে জানতে হবে। বিষয়গুলো হচ্ছে Higher Highs and Lower Lows। সাধারণত Higher Highs হচ্ছে উচ্চ পয়েন্ট এর উচ্চ সীমা এবং Lower Lows হচ্ছে নিন্ম পয়েন্ট এর নিন্ম সীমা। চিত্রে ভালভবে লক্ষ্য করলে আপনি ও বিষয়টা বুঝতে পারবেন। আপনি এখন জেনে গেছেন Divergence Trading সম্পর্কে। এখন আপনি পুরপরি প্রস্তুত Divergence Trading করার জন্য। দুই ধরনের Divergence রয়েছে। একটি হচ্ছে regular এবং আরেকটি হচ্ছে Hidden। regular bullish divergence ব্যাবহার করা হয় সম্ভাব্য ট্রেন্ড রিভারসাল বুঝার জন্য। যদি কোন শেয়ারের দাম lower lows অবস্থানে থাকে কিন্তু oscillator টি higher lows অবস্থানে থাকে তবে সেটি হবে regular divergence। এই regular divergence শাধারনত সংগঠিত হয় একটি ডাওন ট্রেন্ডের পর। একটি Hidden bullish divergence সংগঠিত হয় যখন একটি শেয়ার এর দাম higher low অবস্থানে থেকে এবং oscillator টি lower low অবস্থনে থাকে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_26">
                        <strong><u>Andrew's Pitchfork :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_51" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_52" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_51">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image003.png') }}"/><br><br>
                                            <p>
                                                Andrew's Pitchfork, otherwise known as median line studies utilizes the concepts of support, resistance, and retracements. As is visually depicted below, Andrew's Pitchfork consists of: • Handle • Resistance Trendline "tine" • Median Line • Support Trendline "tine" now lets see with an example how andrew’s pitchfork works. At very beginning we need to find a significant pivot or retracement (in the chart above, the lower left corner). Then find the next significant pivot or retracement. Thirdly find the next retracement. Now look at the graph. Red box areas showing the Low point, High point and low point. We also can see the support and resistance line and median line. The price of that share did not cross its resistance level and always got support at the support level. in the last are the price broke the support line and continued to fall.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_52">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image003.png') }}"/><br><br>
                                            <p>
                                                Ami Broker এর একটি খুবই জনপ্রিয় টুলস হচ্ছে Andrew's Pitchfork অনেকটা কাটা চামচের মত দেখতে। এই Andrew's Pitchfork Tool -টিকে অনেকে আবার median line studies ও বলে থাকেন। এই median line লাইন দিয়ে সাধারণত support, resistance এবং retracements নির্ণয় করা হয়ে থাকে। এই Andrew's Pitchfork টুলসটিতে একটি Handle, একটি Resistance লাইন, একটি Median লাইন এবং একটি Support লাইন রয়েছে। চলুন এবার একটি উদাহরনের মাধ্যমে দেখে কি ভাবে আমরা এই Andrew's Pitchfork টুলসটি ব্যাবহার করবো। এই Andrew's Pitchfork আঁকার জন্য প্রথমে একটি Low point খুজে বের করতে হবে তারপর সেই low point কে ভিত্তি ধরে আর একটি high point নিতে হবে। এবং শেষ ধাপে সেই high point থেকে আবার নিচের দিকে একটি low point নিতে হবে। চিত্রে লক্ষ্য করুন লাল বক্স করে পয়েন্ট গুলো দেখানো হয়েছে। ১ নাম্বার বক্সটি ছিল low point এবং ২ নাম্বার বক্সটি ছিল high point এবং ৩ নাম্বার বক্সটি ছিল low point। এভাবে আঁকার পর দেখা যায় তিনটি লাইন তৈরি হয়েছে। সব থেকে ওপরের লাইনটি Resistance লেভেল হিশেবে কাজ করে থাকে। মাঝখানের লাইনটি median এবং শেষের লাইনটি একটি শেয়ারের support লেভেল হিসেবে কাজ করে থাকে। চিত্রে support এবং Resistance দেখুন। শেয়ারটির দাম ওপরের লাইনে Resistance যেয়ে ব্রেক করতে না পেরে নিচের দিকে নেমে আসে এবং নিচের লাইনে সে support তৈরি করবে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_27">
                        <strong><u>Aroon :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_53" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_54" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_53">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image004.gif') }}"/><br><br>
                                            <p>
                                            Aroon is an indicator system that determines whether a stock is trending or not and how strong the trend is. The Aroon indicators measure the number of periods since price recorded an x-day high or low. There are two separate indicators: Aroon-Up and Aroon-Down. A 25-day Aroon-Up measures the number of days since a 25-day high.A 25-day Aroon-Down measures the number of days since a 25-day low. In this sense, the Aroon indicators are quite different from typical momentum oscillators, which focus on price relative to time. Aroon is unique because it focuses on time relative to price. Chartists can use the Aroon indicators to spot emerging trends, identify consolidations, define correction periods and anticipate reversals. In graph we can see that Aroon indicator gave signal when Aroon-Up crossed the Aroon-down. this uptrend was sustain and went 50 points to 100 points. That time Aroon down also in downtrend.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_54">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image004.gif') }}"/><br><br>
                                            <p>
                                                Aroon ইনডিকেটরটি হচ্ছে কোন শেয়ারের ট্রেন্ড নির্ণয় করার একটি পদ্ধতি। এই ইনডিকেটরটি বুঝায় একটি শেয়ার কি ট্রেেন্ড রয়েছে অথবা নতুন করে ট্রেন্ড তৈরি হতে যাচ্ছে কিনা এবং ট্রেন্ডটি কতটা মজবুত হতে পারে। এই ইনডিকেটরটি এক সাথে দুইটি সংকেত দিয়ে থাকে। একটি হচ্ছে Aroon-Up এবং Aroon-Down। একটি ২৫ দিনের Aroon-Up শেষ ২৫ দিনের শর্বচ্চ দাম পরিমাপ করে থাকে এবং Aroon-Down এর ক্ষেত্রে শেষ ২৫ দিনের সর্বনিন্ম দাম পরিমাপ করা হয়। এই ইনডিকেটরটি গতানুগতিক momentum oscillators ইনডিকেটরেরে থেকে কিছুটা আলাদা। আলাদা হবার প্রধান কারনটি হচ্ছে এই ইনডিকেটরটি দামের থেকে সময়ের ওপর বেশি জোর দিয়ে থাকে। সাধারণত এই ইনডিকেটরটি সেন্ট্রাল লাইনের (৫০) ওপরে এবং নিচে ওঠানামা করে থাকে। এর সর্বউচ্চ সীমা হচ্ছে ১০০ এবং শরবনিন্ম সীমা হচ্ছে ০। চিত্রে দেখা যাচ্ছে Aroon প্রথম ঊর্ধ্বমুখী প্রবণতার সংকেত দিয়েছিল যখন Aroon-Up ইনডিকেটরটি Aroon-Down কে ক্রস করে। এই ঊর্ধ্বমুখী প্রবণতা শেষ পর্যন্ত অব্যাহত ছিল এবং ৫০ পয়েন্ট লাইন ক্রস করে ১০০ পয়েন্ট পর্যন্ত পৌঁছে ছিল। ঠিক তখন ও Aroon-Down নিন্মমুখি প্রবণতায় ছিল। আপনি খেয়াল করলে দেখবেন তখন শেয়ারটির দাম বেরেছিল এবং যখন Aroon-Down ইনডিকেটরটি Aroon-Up কে ক্রস করে এবং ঊর্ধ্বমুখী প্রবণতায় ছিল তখন শেয়ারটির দাম কমে ছিল। অর্থাৎ আপনাকে দুইটি ইনডিকেটরই ব্যাবহার করতে হবে একটি ট্রেন্ড বুঝার জন্য।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_28">
                        <strong><u>Fibonacci Fan :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_55" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_56" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_55">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image019.png') }}"/><br><br>
                                            <p>
                                                Fibonacci Fan consists of three Diagonal lines and these lines use Fibonacci Ratio to measure support & resistance level. Like Fibonacci Fan the way of drawing Fibonacci Fan is also same. In this case a Swing High and Swing Low will be needed to draw the Fibonacci Fan. After finding swing low and swing high point a line need to draw from low point to high point. Then three lines will be available with the Fibonacci Ratio like 38.2%, 50.0% and 61.8%. Look at the graph. The three lines worked as a support and resistance level. when price fallen at the first day it bounced back from its second support line. Then again went up and it didn’t break the last support. At last the price went up from the last support line. So the last support line was very strong.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_56">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image019.png') }}"/><br><br>
                                            <p>
                                                Fibonacci Fan তিনটি Diagonal লাইন দ্বারা গঠিত এবং এই লাইন গুলো Fibonacci Ratio ব্যাবহার করে support এবং resistance লেভেল নির্ণয় করতে সাহায্য করে থাকে। অন্য সব Fibonacci এর মত Fibonacci Fan আঁকার ও কৌশল রয়েছে। এই Fibonacci Fan আঁকতে আপনাকে নিকটবর্তী Swing High এবং Swing Low খুঁজে বের করতে হবে। তারপর Swing Low থেকে Swing High পর্যন্ত একটি Fibonacci Fan আঁকতে হবে। এই Fibonacci Fanএর প্রতিটি লাইন Fibonacci Ratio দ্বারা ভাগ করা থাকে। রেশিও গুলো হচ্ছে 38.2%, 50% এবং 61.8%। লক্ষ্য করুন যখন শেয়ারটির দাম কমে যাচ্ছিল ঠিক তখন সে তার প্রথম support লেভেল ব্রেক করে এবং কিছু দিন side walk করে। তারও কিছু দিন পর তৃতীয় support লেভেল ব্রেক করতে যেয়েও ব্রেক করতে পারিনি এবং আস্তে আস্তে সে আবার উপরের দিকে ওঠা শুরু করে। অর্থাৎ বলা যায় ৫০.০০% লেভেলের support লেভেলটা খুব মজবুত ছিল।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_29">
                        <strong><u>Fibonacci Retracement :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_57" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_58" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_57">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image020.png') }}"/><br><br>
                                            <p>
                                                In technical analysis Fibonacci Tools is very popular tools for measuring Support and Resistance level of a given stock. When market is in trend Fibonacci retracement can give better result for measuring possible support & resistance level. When market goes up an investor can stay up to his Fibonacci Resistance level and when market goes down an investor can stay up to his Fibonacci Support level. For calculation Fibonacci Retracement at first need to find out the Swing High and Swing Low point. Look at the chart there are two points are available. One is swing high and another is swing low. Now a Fibonacci retracement can be drawn from swing low to swing high. See there are some possible level of support and resistance like 38.2%, 50.0%, 61.8% and 100%. So if the stock price goes down then these level will work as a possible support and if the price goes up then these level will work as a possible resistance.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_58">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image020.png') }}"/><br><br>
                                            <p>
                                                টেকনিক্যাল আনালাইসিসে Fibonacci খুবই একটি জনপ্রিয় টুলস যেটি সম্ভাব্য support & resistance level নির্ণয় করতে সাহায্য করে। সর্ব প্রথম যেটা মাথায় রাখতে হবে সেটা হল Fibonacci খুব ভাল কাজ করে যখন মার্কেট একটি Trend এর দিকে যেটে থাকে। মার্কেট যখন Uptrend এ যেতে থাকে তখন একজন Trader Long Position এ থাকতে পারে যতক্ষণ Fibonacci Support Level এ থাকে। আবার মার্কেট যখন Downtrend এ যেতে থাকে তখন একজন Trader Short Position এ থাকতে পারে যতক্ষণ Fibonacci Resistance Level এ থাকে। আর এই Retracement Level খুজে পবার জন্য আপনাকে নিকটবর্তী Swing Highs and Swings Lows বের করতে হবে। তারপর Swing High থেকে Swing Low পর্যন্ত একটি Fibonacci Draw করতে হবে। চিত্রে Swing Low থেকে একটি Fibonacci Retracement অপরের swing High পর্যন্ত আঁকা হয়েছে। চার্ট থেকে আমরা দেখতে পাই retracement levels ছিল ৩৮.২%, ৫০.০%, ৬১.৮% এবং ১০০.০% পয়েন্ট। এই লেভেল গুলো আমাদের Support এবং Resistance এর জায়গা পরিমাপ করে দিচ্ছে। অর্থাৎ যদি শেয়ারটি Downtrend এ চলে আসে তবে ওপরের ঐ লেভেল গুলতে Strong Bounce করার শম্ভাবনা থাকে। ঠিক একই ভাবে যদি Uptrend যায় তবে ওপরের ঐ লেভেল গুলোতে ও Bounce করে নিচের দিকে নেমে যেতে পারে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_30">
                        <strong><u>Fibonacci Arc :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_59" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_60" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_59">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image021.png') }}"/><br><br>
                                            <p>
                                            Like Fibonacci Retracement Fibonacci arc does same work. Fibonacci Arc also uses to determine the possible support & resistance level. When market is in trend Fibonacci Arc can give better result for measuring possible support & resistance level. When market goes up an investor can stay up to his Fibonacci Arc level and when market goes down an investor can stay up to his Fibonacci Arc level. Like Fibonacci Retracement, at first need to find out the Swing High and Swing Low point for calculating Fibonacci Arc. Look at the chart there are two points are available. One is swing high and another is swing low. Now a Fibonacci Arc can be drawn from swing low to swing high. See there are some possible level of support and resistance like 38.2%, 50.0%, 61.8% . So if the stock price goes down then these levels will work as a possible support and if the price goes up then these level will work as a possible resistance level.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_60">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image021.png') }}"/><br><br>
                                            <p>
                                                টেকনিক্যাল আনালাইসিসে Fibonacci Retracement এর মত Fibonacci Arc ও একটি শেয়ারের সম্ভাব্য support & resistance level নির্ণয় করতে সাহায্য করে। Fibonacci Arc এর খেত্তেও সর্ব প্রথম যেটা মাথায় রাখতে হবে সেটা হল Fibonacci Arc খুব ভাল কাজ করে যখন মার্কেট একটি Trend এর দিকে যেতে থাকে। মার্কেট যখন Uptrend এ যেতে থাকে তখন একজন Trader Long Position এ থাকতে পারে যতক্ষণ Fibonacci Arc Support Level এ থাকে। আবার মার্কেট যখন Downtrend এ যেতে থাকে তখন একজন Trader Short Position এ থাকতে পারে যতক্ষণ Fibonacci Arc Resistance Level এ থাকে। আর এই Retracement Level খুজে পবার জন্য আপনাকে নিকটবর্তী Swing Highs and Swings Lows বের করতে হবে। তারপর Swing High থেকে Swing Low পর্যন্ত একটি Fibonacci arc Draw করতে হবে। চিত্রে Swing Low থেকে একটি Fibonacci Arc swing High পর্যন্ত আঁকা হয়েছে। চার্ট থেকে আমরা দেখতে পাই retracement levels ছিল ৩৮.২%, ৫০.০%, ৬১.৮% পয়েন্ট। এই লেভেল গুলো আমাদের Support এবং Resistance এর জায়গা পরিমাপ করে দিচ্ছে। অর্থাৎ যদি শেয়ারটি Downtrend এ চলে আসে তবে ওপরের ঐ লেভেল গুলতে Strong Bounce করার শম্ভাবনা থাকে। ঠিক একই ভাবে যদি Uptrend যায় তবে ওপরের ঐ লেভেল গুলোতে ও Bounce করে নিচের দিকে নেমে যেতে পারে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_31">
                        <strong><u>Relationship between Trend Line and Volume :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_61" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_62" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_61">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image048.png') }}"/><br><br>
                                            <p>
                                                Today we will discuss about relationship between Trend Line and Volume. We know trend line works as a support and resistance of a share. And if the price breaks the trend line it must be confirmed by the volume. Without large volume price cannot breaks the trend line. Look at the image. We have seen a downtrend rally was continuing. When price breaks the trend line for the first time it confirmed by the volume and it continued to increase. So here volume is very important incase of break out a trend line. sometime a trend line can show you wrong signals but you need to observe it very carefully.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_62">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image048.png') }}"/><br><br>
                                            <p>
                                                আজকে আমরা Trend Line বা রেখের পরিবর্তনের সাথে Volume এর সম্পর্ক নিয়ে আলোচনা করব। উপোরোক্ত চিত্রে আমরা দেখতে পাচ্ছি চারবার দাম মিডিয়াম ট্রেন্ডকে অনুসরন করেছে কিন্তু ট্রেন্ডলাইনটিকে অতিক্রম করে যায়নি। অবশেষে এক সময় মূল্য একটি উঠতি স্বল্পমেয়াদী ট্রেন্ডলাইনের সাহায্যে মিডিয়াম ট্রেন্ডলাইনকে অতিক্রম করে গেছে। পরবর্তী দিনে বাজার সঠিক তথ্য দিয়েছে যে এটি ট্রেন্ডলাইন হতে ওপরে উঠে অর্থাৎ দাম বেড়ে গিয়ে একটি নুতন ঊর্ধ্বমুখী প্রবণতা সৃষ্টি করেছে। এখনে volume এর ব্যাপারটি খুবই গুরুত্বপূর্ণ। volume ছাড়া কোন Trend Line মজবুত হয় না। এই লাইনের ক্ষেত্রেও ঠিক তাই হয়েছে। যখনই দাম বৃদ্ধি পেতে শুরু করে তখনই ভলিউম বৃদ্ধি পেতে থাকে। অনেক সময় এই Trend Line ভুল সিগন্যাল ও দিতে পারে। যদি ভুল সিগন্যাল দেয় তবে Trend Line টি পূর্ণ না হয়ে বিপরীত মুখি ধারার চলে যাবে অর্থাৎ line change হয়ে যাবে। টেকনিকাল এনালিসিস এ সফল হবার মূলে হচ্ছে অনুশীলন। এই অনুশীলনের মাধ্যমেই সম্ভব পুরো বিষয়টাকে আয়ত্ত করা।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_32">
                        <strong><u>Trend Spotting 1 :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_63" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_64" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_63">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image049.png') }}"/><br><br>
                                            <p>
                                                When two people go to war, the foolish man always rushes blindly into battle without a plan, much like a starving man at his favorite buffet spot. The wise man, on the other hand, will always get a situation report first to know the surrounding conditions that could affect how the battle plays out. Like in warfare, we must also get a situation report on the market we are trading. This means we need to know what kind of market environment we are actually in. Sometimes the system does in fact, suck. Other times, the system is potentially profitable, but it is being utilized in the wrong environment. Before spotting those opportunities, you have to be able to determine the market environment. The state of the market can be classified into three scenarios: 1.Trending up, 2. Trending down, 3. Ranging. A trending market is one in which price is generally moving in one direction. Sure, price may go against the trend every now and then, but looking at the longer time frames would show that those were just retracements. Trends are usually noted by "higher highs" and "higher lows" in an uptrend and "lower highs" and "lower lows" in a downtrend. Place a 7 period, a 20 period, and a 65 period Simple Moving Average on your chart. Then, wait until the three SMA's compress together and begin to fan out. If the 7 period SMA fans out on top of the 20 period SMA, and the 20 SMA on top of the 65 SMA, then price is trending up. On the other hand, if the 7 period SMA fans out below the 20 period SMA, and the 20 SMA is below the 65 SMA, then price is trending down.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_64">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image049.png') }}"/><br><br>
                                            <p>
                                                যখন দুই জন যোদ্ধা যুদ্ধক্ষেত্রে মিলিত হয় তখন শুধু বোকা যোদ্ধাই কেবল মাত্র কোন পরিকল্পনা ছাড়াই লড়াইয়ে অংশ গ্রহন করেন। কিন্তু বুদ্দিমান যোদ্ধা একটি পরিকল্পনা নিয়েই যুদ্ধে অংশগ্রহন করে থাকে। ঠিক তেমনি আপনারও উচিৎ একটি নির্দিষ্ট পরিকল্পনা নিয়ে শেয়ার বাজারে বিনিয়োগ করা। আর সেই জন্য আপনাকে বাজারের গতিবিধি বা ট্রেন্ড বুঝতে হবে। বাজারে সাধারণত তিন ধরনের ট্রেন্ড পরিলক্ষিত হয়। এই গুলো হচ্ছে ১. আপ ট্রেন্ড, ২. ডাওন ট্রেন্ড, ৩. রেঞ্জিং। আজ আমরা দেখব Trending Market কি এবং এই বিষয়টি কিভাবে আপনার কাজে আসবে। Trending Market হচ্ছে একটি মার্কেট যখন নির্দিষ্ট ট্রেন্ডে অনেক দিন যাবত চলতে থাকে। চিত্র লক্ষ্য করুন এবং দেখুন একটি পরিষ্কার ডাওন ট্রেন্ড দেখা যাচ্ছে। তারমানে আমরা এই ট্রেন্ডটিকে Trending বলতে পারি কারন অনেক দিন যাবত এই ট্রেন্ডটি অব্যাহত ছিল। আপনি আপ ট্রেন্ড বুঝতে পারবেন যখন "higher highs" এবং "higher lows" দেখতে পাবেন এবং ডাওন ট্রেন্ড বুঝবেন "lower highs" এবং "lower lows" দেখে। আপনি এই Trending মার্কেটেও Moving Average টুলস টি বেবহার করতে পারেন। আপনি ৭ দিন, ২০ দিন এবং ৬৫ দিনের Simple Moving Average নিতে পারেন। একটু ভালভাবে লক্ষ্য করুন যখন ওপর দিক থেকে ৭ দিনের SMA ২০ দিনের SMA কে অতিক্রম করে এবং ২০ দিনের SMA ৬৫ দিনের কে অতিক্রম করে তখন মূল্যর trending up সংগঠিত হয়। আবার ঠিক উল্টো ভাবে যখন নিচের দিক থেকে ৭ দিনের SMA ২০ দিনের SMA কে অতিক্রম করে এবং ২০ দিনের SMA ৬৫ দিনের কে অতিক্রম করে তখন মূল্যর trending down সংগঠিত হয়। চিত্রে ঠিক এই বিষয়টিই দেখানো হয়েছে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_33">
                        <strong><u>Trend Spotting - 2 :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_65" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_66" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_65">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image047.png') }}"/><br><br>
                                            <p>
                                                A ranging market is one in which price bounces in between a specific high price and low price. The high price acts as a major resistance level in which price can't seem to break through. Likewise, the low price acts as major support level in which price can't seem to break as well. Market movement could be classified as horizontal or sideways. The basic idea of a range-bound strategy is that a stock has a high and low price that it normally trades between. By buying near the low price, the trader is hoping to take profit around the high price. By selling near the high price, the trader is hoping to take profit around the low price. Popular tools to use are channels such as the one shown above and Bollinger bands. Using oscillators, like Stochastic or RSI, will help increase the odds of you finding a turning point in a range as they can identify potentially oversold and overbought conditions.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_66">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image047.png') }}"/><br><br>
                                            <p>
                                                Ranging হচ্ছে একটি মার্কেট যখন নির্দিষ্ট রেঞ্জের মধ্যে বার বার ওঠা নামা করে এবং রেঞ্জেটির আওতা হচ্ছে মূল্যর উচ্চসীমা এবং মূল্যর ণিন্মসীমা। বার বার মার্কেট এই রেঞ্জের মধ্য ওঠানামা করে বিধায় এটিকে ranging বলা হয়। চিত্রে একটু লক্ষ্য করলে দেখতে পাবেন শেয়ারটির দাম একটি নির্দিষ্ট সীমার মধ্যে ওঠা নামা করে। কিন্তু সেই রেঞ্জটি ব্রেক করতে পারেনি। এই ধরনের বাজারে বুদ্ধিমান বিনিয়োগকারীরা low price লেভেলে শেয়ার ক্রয় করে থাকেন এবং high price লেভেলে বিক্রয় করে থাকেন। এই Ranging মার্কেটে ও আপনি Stochastic এবং RSI Indicator ব্যাবহার করতে পারেন। আবার ও চিত্রে লক্ষ্য করে দেখুন আমরা Stochastic ব্যাবহার করেছি। এই টুলটি ব্যাবহার করা হয়েছে বাজারে overbought এবং oversold চিহ্নিত করার জন্য। খেয়াল করুন যখন শেয়ারটির দাম ওপরের লেভেলটি ব্রেক করতে পারেনি তখন দেখুন Stochastic টি ও overbought অবস্থায় ছিল। ফলে শেয়ারটির দাম কমে যায়। ঠিক একই ভাবে নিচের দিকের লেভেলও ব্রেক করতে পারেনি এবং সেই সময় Stochastic টি ও oversold অবস্থায় ছিল। সুতরাং আপনি কিন্তু এই পদ্ধতিতে আপনার Entry এবং Exit এর সময় নির্ধারণ করতে পারবেন।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_34">
                        <strong><u>Swing Trade Strategy :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_67" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_68" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_67">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image046.png') }}"/><br><br>
                                            <p>
                                                Among traders Swing trade strategy is very popular. By using this strategy you can earn profit within very short period. Basically Swing Trading is to take position in a trade by based on Candlestick and support resistance line. Look at the graph. At first you have seen a reversal candlestick in support line so you can understand tomorrow it can pull back. Then next day you have seen a bullish candlestick so it pulled back. You can buy this share in that day and wait until the price goes at resistance line. When price went in resistance line then you can sell out and wait for next round. Few days later you have got the same pattern and you can also buy the share and sell at its resistance level. This is way you can get 3 times buy signals and 3 times sell signals from a particular stock. So it’s your responsibility to find out this pattern.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_68">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image046.png') }}"/><br><br>
                                            <p>
                                                প্রথমবার আপনি দেখতে পেলেন candlestick টি একটি রিভারসাল প্যাটার্ন তৈরি করেছে এবং support line এ স্পর্শ করেছে ফলে আপনি বুঝতে পারছেন শেয়ারটি আগামিকাল pull back করার যথেষ্ট শম্ভাবনা রয়েছে। পরের দিন আপনি লক্ষ্য করলেন একটি bulish candlestick তৈরি হয়েছে তার মানে শেয়ারটি সত্যি pull back করেছে। আপনি যদি সেই দিন শেয়ারটি ক্রয় করেন তবে চার দিনের মাথায় মুনাফা নিয়ে বের হতে পারবেন। ধরুন আপনি চার দিনের মাথায় শেয়ারটি বিক্রয় করলেন। এইবার আবার কিছু দিন অপেক্ষা করুন এবং শেয়ারটির মুভমেন্ট খেয়াল করুন। ঠিক আবার চার দিন পর দেখলেন candlestick টি আবার একটি রিভারসাল প্যাটার্ন তৈরি করেছে। আপনি অপেক্ষা করছেন পরের দিনের জন্য।পরের দিন ও ঠিক একই ভাবে আপনি লক্ষ্য করলেন একটি bulish candlestick তৈরি হয়েছে তার মানে শেয়ারটি আবার pull back করেছে। আপনি যদি সেই দিন ও শেয়ারটি ক্রয় করেন তবে আবার পাঁচ দিনের মাথায় বিক্রয় করতে পারেন এবং স্বল্প সময়ের মধ্যে মুনাফা অর্জন করতে পারেন। চিত্রটি ভাল ভাবে খেয়াল করে দেখুন একটি শেয়ার আপনাকে বার বার মুনাফা করার সুযোগ করে দিচ্ছে। আপনি এই Swing Trade ব্যাবহার করে তিন বার ক্রয় এবং তিন বার বিক্রয়ের সুযোগ পাচ্ছেন। শুধু প্রয়োজন আপনার সতর্ক দৃষ্টি এবং বুদ্ধি। আপনাকে খুজে বের করতে হবে এই রকম প্যাটার্ন যা ব্যাবহার করে আপনি স্বল্প সময় মুনাফা করতে পারবেন.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_35">
                        <strong><u>Pushing Up through Supply :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_69" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_70" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_69">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image040.png') }}"/><br><br>
                                            <p>
                                                Sometime many investors stuck in upper price level that means they purchase at resistance level. General people start panic selling when they stack a resistance level and ultimately price goes down. After few days number of sellers also decreases and market makers take this opportunity to make money. That time they purchase share in very low price and supply decrease gradually. When supply decreases the demand increase and ultimately it push price to increase. This price push breaks the resistance level and price goes up. Again Market makers takes this opportunity and sells their total holding to general investor and remain inactive for sometimes. This is like a cycle and continues forever.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_70">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image040.png') }}"/><br><br>
                                            <p>
                                                সাধারণত Crowed Behavior এর জন্য আমাদের মত সাধারণ বিনিয়োগকারীরা অনেক সময় উপরের লেভেলে আটকা পরে যাই। তার অর্থ হচ্ছে Resistance লেভেল ব্রেক করতে পারে না। যখন Resistance লেভেলে বিনিয়োগকারীরা আটকে যায় তখন কিছু বিনিয়োগকারী পেনিক সেল করেন এবং শেয়ারটির দাম আস্তে আস্তে কমে যায়। একটি নির্দিষ্ট সময় পর বিক্রয়কারীর সংখ্যা কমে যায় এবং যারা সেল না করে আটকে ছিল তারা পারথনা করতে থাকে দাম বাড়ার জন্য। এই সুযোগটির জন্যই প্রোফেসনাল মানি অথবা মার্কেট মেকাররা অপেক্ষা করতে থাকেন। তারা সেই সময় খুবই কম দামে শেয়ার গুলো কিনে নেন এবং কিছুদিন অপেক্ষা করেন। তারপর আস্তে আস্তে শেয়ারটির বিক্রেতা কমে যায় এবং যোগান (Supply) ও কমে যায়। ফলে চাহিদা বৃদ্ধি পায় এবং দাম আবার বারতে শুরু করে। আবার সেই Resistance লেভেলে চলে গেলে মার্কেট মেকেররা বাজারে যোগান বাড়িয়ে দেয় এবং Resistance লেভেল ব্রেক করে। যখন এই অবস্থা হয় তখন যেইসব বিনিয়োগকারী Resistance ভেলেভে আটকে ছিল তারা কিছুটা শস্তি পায় এবং শেয়ার গুলো বিক্রয় না করে অপেক্ষা করতে থাকে বেশি দামের আশায়। আবার ও সেই Crowed Behivior জন্য নতুন বিনিয়োগকারীরা ঐ লেভেলে শেয়ার কিনতে থাকেন। এই সময় মার্কেট মেকেররা আবার তাদের সব শেয়ার বিক্রয় করে কিছুদিন নিষ্ক্রয় ভূমিকা পালন করেন। এই ভাবেই এই ধারাটি চলতে থাকে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_36">
                        <strong><u>Pivot :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_71" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_72" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_71">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image038.png') }}"/><br><br>
                                            <p>
                                                For any market, there is an equilibrium point around which trading activity occurs. in the absence of large number of new buyers or sellers, this point serves as the pivot or focal point for floor trader and market makers as they adjust their bids and offers. When prices move away from the pivot, there are zone of support and resistance that can be derived from the established value area in the market. Penetration of these zone leads to perceived changes in valuation and they entry of new players into the market. calculation of Pivot Point: Pivot point(P)=(H+L+C)/3 First resistence level(R1)= (2*P)- L First support level(S1) = (2*P) – H Second resistence level (R2)= P+(R1-S1) Second support level(S2)= P – (R1-S1) where H, L, C are the previous day’s high, low and close, respectively.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_72">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image038.png') }}"/><br><br>
                                            <p>
                                                একটি নির্দিষ্ট মূল্যকে বেইজ করেই ট্রেড সংঘটিত হয় যা যেকোন বাজারের ক্ষেত্রেই প্রযোজ্য। একটি বিশাল সংখ্যক নুতন ক্রেতা এবং বিক্রেতার অনুপস্থিতিতে এই পয়েন্টটি প্রধান এবং উল্লেখযোগ্য মূল্যস্থল হিসেবে স্থানীয় ট্রেডার এবং বাজার নিয়ন্ত্রণকারীদের বিড এবং অফার সম্বন্বয়ে সাহায্য করে। এই মূল্যস্থলটিকেই Pivot পয়েন্ট বলে। যখন মূল্য এই pivot পয়েন্ট হতে সরে যায় তখন নুতন সাপোর্ট এবং রেজিস্টেন্স লেভেল তৈরি হয়। যখন এই জ়োনগুলি ভেঙ্গে যায় তখন দামে পরিবর্তন পরিলক্ষিত হয় এবং নুতন ট্রেডাররা বাজারে প্রবেশ করে। ক্যালকুলেশনঃ নিন্মে Pivot পয়েন্ট এবং এর সাপোর্ট ও রেজিস্টেন্স লেভেল এর ক্যালকুলেশন তুলে ধরা হলোঃ Pivot point(P)=(H+L+C)/3 First resistence level(R1)= (2*P)- L First support level(S1) = (2*P) – H Second resistence level (R2)= P+(R1-S1) Second support level(S2)= P – (R1-S1) যেখানে H, L, C হচ্ছে পূরবর্তী দিনের সর্বোচ্চ, সর্বনিন্ম এবং সমাপ্তিমূল্য নির্দেশ করছে। যায়।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_37">
                        <strong><u>Accumulation/Distribution :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_73" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_74" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_73">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image002.png') }}"/><br><br>
                                            <p>
                                                There are many indicators available to measure volume and the flow of money for a particular stock, index or security. One of the most popular volume indicators over the years has been the Accumulation/Distribution Line. The basic premise behind volume indicators, including the Accumulation/Distribution Line, is that volume precedes price. Volume reflects the amount of shares traded in a particular stock, and is a direct reflection of the money flowing into and out of a stock. Many times before a stock advances, there will be period of increased volume just prior to the move. Most volume or money flow indicators are designed to identify early increases in positive or negative volume flow to gain an edge before the price moves. Take a example. look at very carefully. After June month Accumulation / Distribution line was decreasing and that time volume was increasing. so it was a clear indication of distribution. Again look at the July month. Accumulation and Distribution line was moving steadily and after few days later the price increased.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_74">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image002.png') }}"/><br><br>
                                            <p>
                                                বিভিন্ন indicator দ্বারা একটি নির্দিষ্ট শেয়ারের volume ও money flow পরিমাপ করা যায়। Accumulation/Distribution Line হচ্ছে সবচেয়ে জনপ্রিয় volume ইন্ডিকেটর। Volume indicator গুলোর পেছনে যে মূলধারণা কাজ করে তা হচ্ছে volume-এ পরিবর্তন মূল্যে পরিবর্তন ঘটায়। কি পরিমান শেয়ার কেনা-বেচা হয়েছে এবং কি পরিমান অর্থ প্রবাহ(money flow) একটি শেয়ারে প্রবেশ করছে এবং বেরিয়ে যাচ্ছে তা Volume নির্দেশ করে। অনেক সময় একটি শেয়ারের লেনদেনের প্রায় শুরুর দিকে বর্ধিত volume পরিলক্ষিত হয়। সাধারণত অধিকাংশ volume বা money flow indicator গুলো এভাবে তৈরিকরা হয়েছে যাতে মূল্যে পরিবর্তনের পূর্বে এটি পজিটিভ এবং নেগেটিভ volume flow-র প্রাথমিক বৃদ্ধি চিহ্নিত করতে পারে যা কিছুটা মুনাফা লাভে সহায়ক। আমরা এখন একটি শেয়ার নিয়ে দেখব কিভাবে কাজ করে। চিত্রটি খেয়াল করুন। ভাল ভাবে লক্ষ্য করলে দেখবেন জুন মাসের শেষ ভাগে Accumulation/Distribution Line টি নিচের দিকে নেমে যাচ্ছে এবং সেই সাথে ও volume বৃদ্ধি পেয়েছে। এর মাধ্যমে আমরা বুঝতে পারি শেয়ারটি এখন Distribution পর্যায় রয়েছে। আবার দেখুন ঠিক জুলাই মাসের একটু আগে Accumulation/Distribution Line টি সমান্তরাল ভাবে চলছিলো এবং কিছুটা volume ও বৃদ্ধি পেয়েছিল, আসলে তখন Accumulation period চলছিলো।ঠিক তার কিছুদিন পরই শেয়ারটির দাম বৃদ্ধি পেয়েছিল। জুলাই মাসের মাঝামাঝি সময় শেয়ারটি আবার Distribution আরাম্ভ করে ছিল এবং সাথে সাথে volume ও বৃদ্ধি পেয়েছিল।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_38">
                        <strong><u>Harmonic price patterns (পর্ব - ১) :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_75" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_76" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_75">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image024.gif') }}"/><br><br>
                                            <p>
                                                The whole idea of these patterns is that they help people spot possible retracements of recent trends. In fact, we'll make use of other tools we've already covered - the Fibonacci retracement and extensions. Combining these wonderful tools to spot these harmonic patterns, we'll be able to distinguish possible areas for a continuation of the overall trend. There are 6 types of Harmonic Patterns. • ABCD Pattern • Three-Drive Pattern • Gartley Pattern • Crab Pattern • Bat Pattern • Butterfly Pattern For both the bullish and bearish versions of the ABCD chart pattern, the lines AB and CD are known as the legs while BC is called the correction or retracement. If you use the Fibonacci retracement tool on leg AB, the retracement BC should reach until the 0.618 level. Then, the line CD should be the 1.272 Fibonacci extension of BC. All you have to do is wait for the entire pattern to complete (reach point D) before taking any short or long positions. Oh, but if you want to be extra strict about it, here are a couple more rules for a valid ABCD pattern: The length of line AB should be equal to the length of line CD.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_76">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image024.gif') }}"/><br><br>
                                            <p>
                                                harmonic price patterns সম্পর্কে সম্পূর্ণ ধারনা একজন বিনিয়োগকারীকে একটি ট্রেন্ডের সম্ভাব্য retracements বুঝতে সাহায্য করে থাকে। আপনাদের নিশ্চয়ই Fibonacci retracement এবং extensions সম্পর্কে মনে আছে কারন আমরা আমাদের টিউটোরিয়াল কর্নারে এই সম্পর্কেও বিস্তারিত আলোচনা করেছি। আমাদের এই retracement এবং extensions টুলস দুইটি দরকার হবে harmonic patterns নির্ণয় করার জন্য। ছয় ধরনের harmonic patterns সাধারণত দেখা যায়। সেই গুলো হচ্ছে ১.ABCD pattern ২.Three-Driven Pattern ৩.Gtartley Pattern ৪.Crab Pattern ৫. Bat Pattern ৬. Butterfly Pattern। এখন আমরা ABCD pattern নিয়ে আলোচনা করব এবং বুঝতে চেষ্টা করব এই pattern- টি কিভাবে কাজ করে থাকে। ABCD pattern টি বুঝতে এবং খুজে বের করতে আপনাকে Fibonacci টুলস ব্যাবহার করতে হবে এবং সেই সাথে তীক্ষ্ণ দৃষ্টি দরকার হবে। ABCD pattern এ AB এবং CD কে legs এবং BC কে correction বলা হয়ে থাকে যা একটি বুলিশ এবং বিয়ারিশ উভয় ট্রেন্ডের জন্য প্রযোজ্য। আপনি যদি leg AB থেকে retracement আঁকেন তবে BC -র retracement 0.618 লেভেল হওয়া উচিৎ। এবং BC লাইনের extension CD লাইনের পরিমাপ 1.272 লেভেল হবে। আপনি retracement এর সাহায্যে সম্ভাব্য লেভেল গুলো জেনে গিয়েছেন এবং সম্পূর্ণ pattern টি সংগঠিত না হওয়া পর্যন্ত আপনাকে অপেক্ষা করতে হবে (point D সংগঠিত না হওয়া পর্যন্ত)। এই ABCD pattern এর কিছু Rules রয়েছে এবং Rules গুলো হচ্ছে। ১. AB লাইনের দৈর্ঘ্য ঠিক CD লাইনের দৈর্ঘ্যর সমান হবে। ২. Point A থেকে Point B তে যেতে যে সময় লাগে ঠিক একই সময় লাগবে Point C থেকে Point D তে পৌঁছুতে। অনেক সময় এই Rules গুলোর কিছুটা তারতম্য হয়ে থাকে যখন শেয়ার মার্কেট দুর্বল এবং খুব Volatile হয়ে থাকে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_39">
                        <strong><u>Harmonic price patterns (পর্ব - 2) :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_77" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_78" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_77">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image025.gif') }}"/><br><br>
                                            <p>
                                                The three-drive pattern is a lot like the ABCD pattern except that it has three legs (now known as drives) and two corrections or retracements. Easy as pie! In fact, this three-drive pattern is the ancestor of the Elliott Wave pattern. As usual, you'll need your hawk eyes, the Fibonacci tool, and a smidge of patience on this one. As you can see from the charts above, point A should be the 61.8% retracement of drive 1. Similarly, point B should be the 0.618 retracement of drive 2. Then, drive 2 should be the 1.272 extension of correction A and drive 3 should be the 1.272 extension of correction B. By the time the whole three-drive pattern is complete, that's when you can pull the trigger on your long or short trade. Typically, when the price reaches point B, you can already set your short or long orders at the 1.272 extension so that you won't miss out.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_78">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image025.gif') }}"/><br><br>
                                            <p>
                                                three-drive pattern টিও অনেকটা ABCD Pattern এর মত কিন্তু এই Pattern টির তিনটি legs রয়েছে যা সাধারণত drives নামে পরিচিত এবং দুইটি corrections বা retracements রয়েছে। প্রকৃতপক্ষে এই three-drive pattern টি Elliott Wave pattern এর অগ্রদূত বলে বিবেচিত হয়। এই pattern টির খেত্রেও আপনাকে তীক্ষ্ণ দৃষ্টি শম্পন্ন হতে হবে এবং অবশ্যই Fibonacci টুলস ব্যাবহার করতে হবে। আপনি চার্টে লক্ষ্য করলে দখতে পাবেন পয়েন্ট A এর পরিমাপ drive 1 এর 61.8% retracement লেভেল হওয়া উচিৎ। ঠিক একই ভাবে পয়েন্ট B এর পরিমাপ drive 2 এর 0.618 retracement লেভেলে হবে। তারপর drive 2 অবশ্যই 1.272 extension of correction A এবং drive 3 অবশ্যই 1.272 extension of correction B হতে হবে। এই correction গুলোর extension সম্পূর্ণ হলে পুরো pattern টি সংগঠিত হবে। এই pattern টি একটি বুলিশ এবং বিয়ারিশ উভয় ট্রেন্ডের জন্য প্রযোজ্য। সাধারণত যখন দাম পয়েন্ট B তে পৌছায় তখন আপনি 1.272 extension লেভেলে দীর্ঘ অথবা স্বল্প সময়ের জন্য ট্রেডে অংশ নিতে পারেন। এই pattern টির ও কিছু rules রয়েছে। rules গুলো হচ্ছে ১. drive 2 সম্পূর্ণ হতে যে সময় লাগে ঠিক একই সময় লাগবে drive 3 সম্পূর্ণ হতে। ২. retracements A এবং B সম্পূর্ণ হতেও ঠিক একই সময় লাগবে। চিত্রে লক্ষ্য করুন বুলিশ ট্রেন্ডের সময় পয়েন্ট A এবং B এর অবস্থান ছিল ওপরে তারমানে ঐ গুলো ছিল Corrective wave. মার্কেট যখন আপ ট্রেন্ডে থাকবে তখন Corrective wave হয় নিচের দিকে এবং মার্কেট যখন ডাউন ট্রেন্ডে থাকবে তখন Corrective wave হয় ওপরের দিকে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_40">
                        <strong><u>Harmonic price patterns (পর্ব - ৩) :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_79" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_80" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_79">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image026.gif') }}"/><br><br>
                                            <p>
                                                The Gartley "222" pattern is named for the page number it is found on in H.M. Gartleys book, Profits in the Stock Market. Gartleys are patterns that include the basic ABCD pattern we've already talked about, but are preceded by a significant high or low. Now, these patterns normally form when a correction of the overall trend is taking place and look like 'M' (or 'W' for bearish patterns). These patterns are used to help traders find good entry points to jump in on the overall trend. A Gartley forms when the price action has been going on a recent uptrend (or downtrend) but has started to show signs of a correction. What makes the Gartley such a nice setup when it forms is the reversal points are a Fibonacci retracement and Fibonacci extension level. This gives a stronger indication that the pair may actually reverse. This pattern can be hard to spot and once you do, it can get confusing when you pop up all those Fibonacci tools. The key to avoiding all the confusion is to take things one step at a time. In any case, the pattern contains a bullish or bearish ABCD pattern, but is preceded by a point (X) that is beyond point D. The "perfect" Gartley pattern has the following characteristics: 1. Move AB should be the .618 retracement of move XA. 2. Move BC should be either .382 or .886 retracement of move AB. 3. If the retracement of move BC is .382 of move AB, then CD should be 1.272 of move BC. Consquently, if move BC is .886 of move AB, then CD should extend 1.618 of move BC.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_80">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image026.gif') }}"/><br><br>
                                            <p>
                                                Harmonic price patterns এর মধ্যে আরেকটি প্যাটার্ন হচ্ছে Gartley "222" pattern। এই প্যাটার্নটির নামকরন করা হয়েছে H.M. Gartleys এর নামানুসারে কারন তিনিই এই pattern টি সর্ব প্রথম আবিষ্কার করেন। এই pattern টি মধ্যেও basic ABCD pattern রয়েছে যা আমরা গত কয়েকদিন আগের টিউটোরিয়াল কর্নারে আলোচনা করেছিলাম। এই Gartley "222" pattern টি সাধারণত সংগঠিত হয় যখন একটি ট্রেন্ডের correction হয় এবং এটি দেখতে অনেকটা ইংরেজি শব্দ 'M' এর মত (যখন বুলিশ প্যাটার্ন)এবং আরেকটি অনেকটা ইংরেজি শব্দ 'W' এর মত (যখন বিয়ারিশ প্যাটার্ন)। এই প্যাটার্ন গুলো বিনিয়োগকারীদের কখন শেয়ার কিনতে হবে অথবা এন্ট্রি দিতে হবে এই বেপারে অনেক সাহায্য করে থাকে। একটি Gartley প্যাটার্ন সংগঠিত হয় যখন price action একটি correction এর সংকেত দিয়ে সম্প্রতি উপট্রেন্ড অথবা ডাওনট্রেন্ডে যেতে থাকে। এবং এই বিষয়টি Fibonacci retracement এবং Fibonacci extension ব্যাবহারের মাধ্যমে আর পরিষ্কার হওয়া যায়। এটি খুব strong নির্দেশনা দেয় যখন রেভারসাল হয়। এই Gartley pattern টি খুজে বের করা কিছুটা কঠিন এবং কিছুটা বিবভ্রান্তিকর হলেও যদি আপনি একবার বের করতে পারেন তবে আস্তে আস্তে বিভ্রান্তি কেটে যাবে। একটি আদর্শ Gartley pattern এর কিছু বৈশিষ্ট্য রয়েছে। সেই বৈশিষ্ট্য গুলো হচ্ছে - ১. AB point এর মুভমেন্ট সাধারণত XA point এর মুভেমেন্টের .618 retracement লেভেলে হবে। ২. BC point এর মুভমেন্ট সাধারণত AB এর মুভেমেন্টের .382 অথবা .886 retracement লেভেলে হবে। ৩. যদি AB এর মুভ BC এর retracement লেভেল .382 হয় তবে CD এর মুভ retracement লেভেলের 1.272 হওয়া উচিৎ। ৩. CD এর মুভ XA এর .786 retracement হওয়া উচিৎ। দিকে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_41">
                        <strong><u>Harmonic price patterns (শেষ পর্ব) :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_81" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_82" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_81">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image027.gif') }}"/><br><br>
                                            <p>
                                                As you may have guessed, profiting off Harmonic Price Patterns is all about being able to spot those "perfect" patterns and buying or selling on their completion. There are three basic steps in spotting Harmonic Price Patterns: • Step 1: Locate a potential Harmonic Price Pattern • Step 2: Measure the potential Harmonic Price Pattern • Step 3: Buy or sell on the completion of the Harmonic Price Pattern Step 1: Locate a potential Harmonic Price Pattern: look at the chart. At this point in time, we're not exactly sure what kind of pattern that is. It LOOKS like a three-drive, but it could be a Bat or a Crab. Heck, it could even be a Moose! In any case, let's label those reversal points. Step 2: Measure the potential Harmonic Price Pattern: Using the Fibonacci tool, a pen, and a piece of paper, let us list down our observations. 1. Move BC is .618 retracement of move AB. 2. Move CD is 1.272 extension of move BC. 3. The length of AB is roughly equal to the length of CD. This pattern qualifies for a bullish ABCD pattern, which is a strong buy signal Step 3: Buy or sell on the completion of the Harmonic Price Pattern: Once the pattern is complete, all you have to do is respond appropriately with a buy or sell order. In this case, you should buy at point D, which is the 1.272 Fibonacci extension of move CB, and put your stop loss a couple of pips below your entry price.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_82">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image027.gif') }}"/><br><br>
                                            <p>
                                                Harmonic Price Patterns ব্যাবহারের মাধ্যমে মুনাফা করার জন্য যে বিষয়টি সব থেকে গুরুত্বপূর্ণ সেইটি হচ্ছে আপনি কতটা দক্ষ ভাবে Pattern গুলো খুঁজে বের করতে পারেন। তিনটি বেসিক ধাপ রয়েছে এই Harmonic Price Patterns ঠিক মত চিহ্নিত করার জন্য। ১. আপনাকে একটি সম্ভাব্য Harmonic Price Pattern সেট করতে হবে। ২. তারপর আপানাকে সেই সম্ভাব্য Harmonic Price Pattern টি পরিমাপ করতে হবে। ৩. আপনি ক্রয় এবং বিক্রয় সম্পন্ন করবেন যখন Harmonic Price Pattern টি সম্পূর্ণ হবে। প্রথম ধাপে লক্ষ্য করুন চার্টটি একটি সম্ভাব্য Harmonic Price Pattern এর মত দেখা যাচ্ছে। কিন্তু সেই সময় নিশ্চিত হওয়া যাচ্ছিলোনা যে এই pattern টি কি three-drive হবে অথবা Bat pattern হবে। এই বিষয়টি নিশ্চিত হবার জন্য এর রেভারসাল পয়েন্টটি ছিনহিত করতে হবে। দ্বিতীয় ধাপে আপনি Fibonacci tool ব্যাবহার করে কিছুটা মাপঝোঁক করে নিতে পারেন। লক্ষ্য করুন মুভ BC হচ্ছে মুভ AB এর .৬১৮ retracement লেভেল। মুভ CD হচ্ছে মুভ BC এর ১.২৭২ extension এবং সব শেষে মুভ AB এর দৈর্ঘ্য মুভ CD এর প্রায় সমান। ফলে এই Pattern টি একটি বুলিশ ABCD pattern হয়েছে যা একটি ক্রয় সিগন্যাল। একবার যখন pattern টি সম্পূর্ণ হবে তখন আপানাকে ক্রয় অথবা বিক্রয় কোনটি করবেন সেই বেপারে সিদ্ধান্ত নিতে হবে। এর জন্য আপনার পয়েন্ট D থেকে ক্রয় করা উচিত। এবং আপনি বিক্রয় আদেশ দিতে পারেন যখন দাম আপনার ক্রয় মূল্য থেকে নিচে নেমে যাবে। harmonic price patterns এর একটি সমস্যা হচ্ছে অনুশীলন না থাকেল এই pattern গুলো খুঁজে বের করা একটু কঠিন। তবে আপনি যদি নিয়মিত অনুশীলন করেন তবে আপনি কিন্তু অনেক তারাতারি এই pattern গুলো খুঁজে বের করতে পারবেন।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_42">
                        <strong><u>Average True Range - 1 :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_83" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_84" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_83">
                                            <img src="{{ URL::asset('/knowledge_basket/clip_image006.jpg') }}"/><br><br>
                                            <p>
                                                ATR indicator does not provide an indication of price direction or duration, simply the degree of price movement or volatility. As with most of his indicators, Wilder designed ATR with commodities and daily prices in mind. In 1978, commodities were frequently more volatile than stocks. They were (and still are) often subject to gaps and limit moves. In order to accurately reflect the volatility associated with commodities, Wilder sought to account for gaps, limit moves, and small high-low ranges in his calculations. A volatility formula based on only the high-low range would fail to capture the actual volatility created by the gap or limit move. True Range is the greatest of the following three values:  difference between the current maximum and minimum (high and low).  difference between the previous closing price and the current maximum.  difference between the previous closing price and the current minimum. If the current high-low range is large, chances are it will be used as the True Range. If the current high-low range is small, it is likely that one of the other two methods would be used to calculate the True Range. The last two possibilities usually arise when the previous close is greater than the current high (signaling a potential gap down or limit move) or the previous close is lower than the current low (signaling a potential gap up or limit move). To ensure positive numbers, absolute values were applied to differences. The example shows three potential situations when the TR would not be based on the current high/low range. Notice that all three examples have small high/low ranges and two examples show a significant gap. 1. A small high/low range formed after a gap up. The TR was found by calculating the absolute value of the difference between the current high and the previous close. 2. A small high/low range formed after a gap down. The TR was found by calculating the absolute value of the difference between the current low and the previous close. 3. Even though the current close is within the previous high/low range, the current high/low range is quite small. In fact, it is smaller than the absolute value of the difference between the current high and the previous close, which is used to value the TR
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_84">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image006.jpg') }}"/><br><br>
                                            <p>
                                                Average True Range indicator টি দামের গতি ও সময় কোনটাই নির্দেশ করেনা শুধুমাত্র দাম পরিবর্তনশীলতার (volatility) ডিগ্রী নির্দেশ করে। এই indicator গুলো সব সময় বিষয় অনুযায়ী ব্যবধান (gap) এবং limit move দেখায়। Limit move তখনই সংঘটিত হয় যখন একটি কমোডিটি তার অনুমোদিত সর্বোচ্চ সীমা পর্যন্ত ওঠানামা করে এবং পরবর্তী সেশান না আসা পর্যন্ত আবার ট্রেডে অংশগ্রহন করেনা।এর ফলে সৃষ্ট বার কিম্বা ক্যান্ডেলস্টিক ছোট ড্যাশে পরিণত হয়। নিন্মলিখিত তিনটি value এর উপর ভিত্তি করে True range নির্ধারিত হয়। • চলতি সর্বোচ্চ ও সর্বনিন্ম মূল্যের পার্থক্য(high & low) • পূর্ব্বর্তী সমাপ্তি মূল্য এবং চলতি (current) সর্বোচ্চ মূল্যের পার্থক্য • পূর্ব্বর্তী সমাপ্তি মূল্য এবং চলতি সর্বনিন্ম মূল্যের পার্থক্য যদি চলতি (current) সর্বোচ্চ ও সর্বনিন্মের পরিধি বৃদ্ধি পায় তবে এটি True range হিসেবে বাবহৃত হওয়ার সুযোগ থাকে। আর যদি চলতি(current) সর্বোচ্চ ও সর্বনিন্মের পরিধি ছোট হয় তবে এটি অন্য দুটি পদ্ধতির মত True range ক্যালকুলেশনে ব্যবহৃত হয়। শেষের দিক-কার দুটি সম্ভাবনা তৈরি হয় যখন পূর্ব্বর্তী সমাপ্তি মূল্য চলতি (current) সর্বোচ্চ মূল্যের চেয়ে বেশী থাকে। (যা limit move অথবা gap এর নেমে আসাকে ইংঙ্গিত করে) উপোরোক্ত চিত্রে দেখতে পাই তিনটি অবস্থাতেই TR চলতি সর্বোচ্চ/সর্বনিন্ম এর উপর নির্ভর করছে না। লক্ষ্য করুন, তিনটি দৃষ্টান্তেই সীমার স্বল্পতা রয়েছে এবং দুটি দৃষ্টান্তে একটি গুরুত্বপূর্ন gap পরিলক্ষিত হচ্ছে। ১. ব্যবধান (gap) বৃদ্ধি যা একটি স্বল্প সীমা(high/low) সৃষ্টি করে। পুর্ব্বর্তী সমাপ্তি মূল্য এবং চলতি সর্বোচ্চ মূল্যের পার্থক্যের উপর ভিত্তি করে TR মান নির্ণয় করা হয়। ২. ব্যবধানের(gap) হ্রস্বতা যা একটি স্বল্প সীমা(high/low) সৃষ্টি করে। পূর্ব্বর্তী সমাপ্তি মূল্য এবং চলতি সর্বনিন্ম মূল্যের পার্থক্যের উপর ভিত্তি করে TR মান নির্ণয় করা হয়। ৩. তাসত্ত্বেও পূর্ব্বর্তী সর্বোচ/সর্বনিন্ম পরিধির মধ্যে চলতি সমাপ্তি মুল্য অন্তর্ভূক্ত থাকে। একটি ট্রেন্ড বুঝার জন্য।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_43">
                        <strong><u>Average True Range - 2 :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_85" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_86" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_85">
                                            <img src="{{ URL::asset('/knowledge_basket/clip_image005.gif') }}"/><br><br>
                                            <p>
                                                Typically, the Average True Range (ATR) is based on 14 periods and can be calculated on an intraday, daily, weekly or monthly basis. For this example, the ATR will be based on daily data. Because there must be a beginning, the first TR value in a series is simply the High minus the Low, and the first 14-day ATR is the average of the daily ATR values for the last 14 days. After that, Wilder sought to smooth the data set, by incorporating the previous period's ATR value. The second and subsequent 14-day ATR value would be calculated with the following steps: 1. Multiply the previous 14-day ATR by 13. 2. Add the most recent day's TR value. 3. Divide by 14.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_86">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image005.gif') }}"/><br><br>
                                            <p>
                                                মূলত তিনটি বিষয়ের ওপর ভিত্তি করে ATR calculation করা হয়। বিষয় গুলো হচ্ছেঃ ১. চলতি সর্বোচ্চ ও সর্বনিন্ম মূল্যের পার্থক্য(high & low). ২. পূর্ব্বর্তী সমাপ্তি মূল্য এবং চলতি (current) সর্বোচ্চ মূল্যের পার্থক্য. ৩. পূর্ব্বর্তী সমাপ্তি মূল্য এবং চলতি সর্বনিন্ম মূল্যের পার্থক্য। সাধারণতঃ ATR ১৪ দিনের ডাটার উপর ভিত্তি করে সৃষ্টি হয় এবং দিনের মধ্যবর্তী সময়, দৈনিক, সাপ্তাহিক ও মাসিক ভিত্তিতে এটি নির্ণিত হতে পারে। উদাহরণস্বরুপ, ATR দৈনিক ডাটার উপর নির্ভরশীল।কারন সবকিছুর শুরু রয়েছে, প্রথম TR value পেতে হলে সর্বোচ্চ হতে সর্বনিন্ম মূল্যকে বাদ দিতে হবে। আর প্রথম ১৪ দিনের ATR হচ্ছে দৈনিক ATR value-র গড় যা পূর্বের ১৪ দিনে সংঘটিত হয়েছিল। এর পরে Wilder (ইন্ডিকেটরটির জনক) ডাটাকে আরো সঠিকভাবে পেতে পূর্ব্বর্তী ATR value যুক্ত করেছেন। ২য় ও পরবর্তী ১৪ দিনের ATR value-র ক্যালকুলেশন নিন্মে বর্ণিত হলোঃ ১. পূর্ব্বর্তী ১৪ দিনের ATR কে ১৩ দিয়ে গুণ , ২. একেবারে চলতি TR value যুক্ত করতে হবে, ৩. ১৪ দ্বারা বিভাজন করতে হবে. চিত্রে আমরা ATR বিষয়টি দেখতে পাচ্ছি। ভাল ভাবে লক্ষ্য করলে দেখবেন যখন ATR ঊর্ধ্বমুখী হয়ে ওঠে ছিল Average True Range এর তুলনায় এবং শেয়ারের দামও বৃদ্ধি পেয়েছিল। আবার যখন ATR নিন্মমুখি হয়ে ওঠে ছিল Average True Range এর তুলনায় এবং শেয়ারটির দামও কমে যাচ্ছিলো। এই ভাবে একটি শেয়ারের ATR খুব সহজেই নির্ণয় করা যায়। একটি ট্রেন্ড বুঝার জন্য।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_44">
                        <strong><u>Cup & handle :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_87" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_88" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_87">
                                            <img src="{{ URL::asset('/knowledge_basket/clip_image015.png') }}"/><br><br>
                                            <p>
                                                The Cup with Handle is a bullish continuation pattern that marks a consolidation period followed by a breakout. As its name implies, there are two parts to the pattern: the cup and the handle. The cup forms after an advance and looks like a bowl or rounding bottom. As the cup is completed, a trading range develops on the right hand side and the handle is formed. A subsequent breakout from the handle's trading range signals a continuation of the prior advance. 1. Trend: To qualify as a continuation pattern, a prior trend should exist. Ideally, the trend should be a few months old and not too mature. 2. Cup: The cup should be "U" shaped and resemble a bowl or rounding bottom. The perfect pattern would have equal highs on both sides of the cup, but this is not always the case. 3. Cup Depth: Ideally, the depth of the cup should retrace 1/3 or less of the previous advance. 4. Handle: After the high forms on the right side of the cup, there is a pullback that forms the handle. 5. Duration: The cup can extend from 1 to 6 months 6. Volume: There should be a substantial increase in volume on the breakout above the handle's resistance.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_88">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image015.png') }}"/><br><br>
                                            <p>
                                                Cup and Handle চার্টটি একটি bullish Continuation প্যাটার্ণ যা uptrend থেমে যাওয়ার পরেও যখন প্যাটার্ণটি সৃষ্টি হয় তখন তা উর্ধ্বমূখী দিক নির্দেশ করে। আমরা যদি চার্টে লক্ষ্য করি করি তবে সেটা স্পষ্ট ভাবে বুঝতে পারব। চার্টটিতে March মাস থেকে downward trend শুরু হয়েছিল এবং একটা নির্দিষ্ট সময়ের পর একটি কাপ প্যাটার্ণ তৈরি করেছে যেটা দেখতে অনেকটা চায়ের কাপের মত বলে এই প্যাটার্ণটির নাম দেয়া হয়েছে Cup and Handle । এই প্যাটার্ণটি একটি মজবুত Upward Trend নির্দেশ করে । চার্ট এ আমরা ঠিক তাই দেখতে পাচ্ছি। এই প্যাটার্ণটি আমাদের দেশের বাজারে খুব সহসা দেখা যায় না। মাঝে মাঝে এই ধরনের চার্ট সংগঠিত হয় এবং যদি সংগঠিত হয় তবে সেই খুব দীর্ঘ দিনের জন্য ঊর্ধ্বমুখী অবস্থায় থাকে। ১. ট্রেন্ডঃ একটি continuation pattern এর জন্য অবশ্যই শেয়ারটিকে একটি ট্রেন্ডে থাকতে হবে। ২. কাপঃ কাপটি দেখতে অনেকটা “ইউ” এর মত হবে। কিন্তু হুবুহু যে “ইউ” শেপই হতে হবে সেই রকম কোন বাধ্যবাধকতা নেই। ৩. কাপের গভিরতাঃ কাপের গভীরতা সাধারণত ১/৩ অংশ হবে আগের থেকে। ৪. হান্ডেলঃ হান্ডেল থেকে সাধারণত শেয়ারটি শক্ত ভাবে পুল ব্যাক করে। ৫. সময় কালঃ একটি কাপ এবং হান্ডেল সংগঠিত হতে ১ থেকে ৬ মাস সময় লাগতে পারে আবার এর আগে ও সংগঠিত হয়তে পারে। ৬. ভলিউমঃ যখন দেখা যায় হ্যান্ডল থেকে ব্রেকআউট হবে তখন ভলিউমও বেশি হবে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_45">
                        <strong><u>Dead Cat Bounce :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_89" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_90" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_89">
                                            <img src="{{ URL::asset('/knowledge_basket/clip_image016.png') }}"/><br><br>
                                            <p>
                                                Dead Cat bounce is a financial Buzz word. In technical analysis we use this term to explain A temporary recovery from a prolonged decline or bear market, after which the market continues to fall. it happens because of short interest of investors. In a bearish market when demand and supply is not adjustable then for some specific period demand creates among the investors. it increases price of share for one or two days. Basically it is a Dead Cat Bounce. Recently, in our DSE chart we have seen this Dead Cat Bounce. Just look at the graph. After September month DSE index increased and volume also increased but did not sustain that level. It again happened in October and also in November month but did not sustain. This situation is called dead cat bounce.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_90">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image016.png') }}"/><br><br>
                                            <p>
                                                আমরা অনেক সময় অনেক ধরনের টেকনিক্যাল টার্ম ব্যাবহার করে থাকি এবং তাদের মধ্যে একটি টার্ম হচ্ছে Dead Cat Bounce। এই Dead Cat Bounce হচ্ছে যখন একটি শেয়ার অনেক দিন নিন্মমুখি থাকার পর কিছু দিনের জন্য ঊর্ধ্বমুখী হয়ে থাকে। এই বিষয়টি ঘটে থাকে কারন অনেক বিনিয়োগকারীর মার্কেটের প্রতি স্বল্প সময়ের জন্য আগ্রহ থাকে যাকে আমরা Short Interest ও বলতে পারি। যদি একটি বেয়ারিশ মার্কেটে চাহিদা এবং যোগানের পরিমান সমান না হয় তবে একটি স্বল্প সময়ের জন্য বিপুল চাহিদার সৃষ্টি হয় এবং স্বল্প সময়ের জন্য দাম বৃদ্ধি পায়। এই বৃদ্ধিকে টেকনিক্যাল আনাল্যসিসের ভাষায় Dead Cat Bounce বলা হয়ে থাকে। এই বৃদ্ধিটি খুব স্বল্প সময়ের জন্য হয় এবং একটি শক্ত বিক্রয় চাপ থাকে ফলে আগের মূল্যসীমা অতিক্রম করে যায়। আমরা আমাদের ডিএসই চার্ট পর্যবেক্ষণ করলে এই বিষয়ে অনেক পরিষ্কার ধারনা পাব। চার্টে লক্ষ্য করে দেখুন প্রায়ই ডিএসই ইনডেক্স কিছুটা বৃদ্ধি পায় এবং সাথে ভলিউমও বেড়ে ছিল। কিন্তু বেশিদিন সেই ঊর্ধ্বমুখী প্রবণতা অব্যাহত ছিল না। আবার ঠিক সেপ্টেম্বর মাসের শেষ দিকেও ইনডেক্স ছিল ঊর্ধ্বমুখী এবং কয়েক দিন ঊর্ধ্বমুখী ছিল। বিয়ারিশ মার্কেতে এই মাঝে মাঝে যে দামের এবং শেয়ারের ঊর্ধ্বমুখী প্রবণতা একেই Dead Cat Bounce বলা হয়ে থাকে। পরিমানে কমে গেছে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_46">
                        <strong><u>Head and shoulders :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_91" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_92" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_91">
                                            <img src="{{ URL::asset('/knowledge_basket/clip_image028.png') }}"/><br><br>
                                            <p>
                                                This is one of the most popular and reliable chart patterns in technical analysis. head and shoulders is a reversal chart pattern than when formed, signals that the security is likely to move against the previous trend. The head and shoulders chart pattern illustrates a weakening in a trend by showing the deterioration in the successive movements of the highs and lows. The chart exactly showing what happened in our DSE. The chart formed two shoulders and one head and it has nick line. When it crossed its nick line then it went more down also price has decreased.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_92">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image028.png') }}"/><br><br>
                                            <p>
                                                Head and Shoulders মূলত একটি Reversal Chart Pattern । টেকনিক্যাল এনালাইসিসে এই চার্টটি সবচেয়ে জনপ্রিয় এবং নির্ভরযোগ্য। Head and Shoulders যখন সৃষ্টি হয় তখন এটি রিভার্সেল চার্ট প্যাটার্ণ হিসেবে কাজ করে এবং একটি শেয়ারের পূর্ব্বর্তী ট্রেন্ডের বিপরীত গতি নির্দেশ করে। Head and Shoulders চার্ট প্যাটার্ণটি সর্বোচ্চ ও সর্বনিন্ম পরিধির দূর্বলতা তুলে ধরার মাধ্যমে ট্রেন্ডের দূর্বলতা চিহ্নিত করে। Head and Shoulders চার্ট প্যাটার্ণটি খুব মনোযোগ দিয়ে লক্ষ্য করতে হবে কারন মনযোগী না হলে অনেক সময় আপনি চার্ট প্যাটার্ণটি ধরতে পারবেন না। চিত্রে Head and Shoulders দেখাচ্ছে যেটি আমাদের দেশের বাজারে সংগঠিত হয়েছে। চিত্রে ওপর দিকে Head and Shoulders সংগঠিত হয়েছে এবং যখন Nick line cross করেছে তখন দাম ও অনেক পরিমানে কমে গেছে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_47">
                        <strong><u>Gaps :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_93" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_94" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_93">
                                            <img src="{{ URL::asset('/knowledge_basket/clip_image022.png') }}"/><br><br>
                                            <p>
                                                A gap in a chart is an empty space between a trading period and he following trading period. This occurs when there is a large difference in price between two sequential trading periods. If the trading range in one period is between 50 taka and 65 taka and the next trading period opens at 70 Taka there will be a large gap on the chart between these two periods. look at the chart first one downward gap. when the price of a particular share starts below than yesterdays price then there is a downward gap. in this situation 80% share’s price increase. Upward Gap is just reverse of Downward Trend and in case of Upward Tren 80% share’s price falls.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_94">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image022.png') }}"/><br><br>
                                            <p>
                                                একটি চার্টের Gap হচ্ছে ট্রেডিং এর সময় সৃষ্ট কিম্বা পরবর্তী ট্রেডিং পিরিওডের সৃষ্ট খালি জায়গা। দুটি ট্রেডিং পিরিওডে মূল্যের অস্বাভাবিক পার্থক্যের কারনে এটি তৈরিহয়। মূলতঃ Gap একটি শেয়ারের গুরুত্বপূর্ণ পরিবর্তনকে ইংগিত করে যদি প্রাপ্তির চেয়ে বেশি অর্জনের ঘোষনা থাকে। এবার চিত্রটি লক্ষ্য করা যাক। চিত্রে আমরা দেখতে পাচ্ছি দুইটি Gap । প্রথমটি Downward Gap. যখন কোন শেয়ােরর দাম আগের দিনের দামের তুলনায় কম দিয়ে শুরু হয় এবং আগের দিনের দামকে ক্রস করতে পারে না তখন একটি Downward Gap সৃষ্টি হয়। এই ক্ষেত্রে প্রায় ৮০ ভাগ শেয়ােরর দাম বৃদ্ধি পায়। নিচের চিত্রে ও আমরা সেই বিষয়ই দেখতে পাচ্ছি। Upward Gap হল ঠিক Downward Gap এর উল্টো। এই ক্ষেত্রে শেয়ােরর দাম আগের দিনের দামের তুলনায় বেশী দিয়ে শুরু হয় ফলে উপরের দিকে একটি Upward Gap সৃষ্টি হয়। এই Upward Gap সৃষ্টি হলে দেখা যায় অধিকাংশ শেয়ােরর দাম কমে যায়। নিচের চিত্রে ও আমরা তাই লক্ষ্য করছি। যেদিন ক্যানডেল স্টিকটি একটি Upward Gap সৃষ্টি করেছে ঠিক তার পরদিন থেকে দাম কমতে শুরু করেছে। সুতরাং Gap Trading এর ক্ষেত্রে আমাদের কিছুটা লক্ষ্য রাখতে হবে যে কোন ধরনের Gap সৃষ্টি হচ্ছে।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_48">
                        <strong><u>Good Trade :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_95" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_96" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_95">
                                            <img src="{{ URL::asset('/knowledge_basket/clip_image023.png') }}"/><br><br>
                                            <p>
                                            What is a good Tread? or how we can select a good trade? Many investor ask this types of question. we know some of the indicators we have that show the when market is risky and when the market is totally safe for investment. the picture shows the weekly chart and the trading range is 6758 to 5170. so there is 1580 point gaps are available so we can take it as our trading range. we can sell when it goes to its resistance and we can buy when the price goes to its support line. For this reason you have to take three decisions. 1. what will be the target price and stop price. 2. For next trade will you follow the trend or not. 3. Will you trade at a current market price or will wait for your desire market price.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_96">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image023.png') }}"/><br><br>
                                            <p>
                                                সাধারণত আমরা একটি ভাল ট্রেড বলতে কি বুঝি অথবা ভাল ট্রেড আমরা কিভাবে চিনহিত করতে পারি? অনেক বিনিয়োগকারীর এমন প্রশ্ন রয়েছে। আমরা জানি অল্প কিছু সংখ্যক ট্রেন্ডলাইন বাজারে বিনিয়োগ কখন ঝুকিপূর্ণ তা নির্দেশ করে। আমরা একটি সাপ্তাহিক চার্টে দেখতে পাচ্ছি এর ট্রেডিং রেঞ্জ 6758 হতে 5170 পর্যন্ত যা 1580 পয়েন্ট। সুতরাং, রেজিস্টেন্স লেভেলের একেবারে সর্বোচ্চ পর্যায়ে sell করা ততোটা বিপদজনক নয়। যদি রেজিস্টেন্স লেভেল ভেঙ্গে যায় তবে সে স্থানটি buy এর স্থান হিসেবে বিবেচিত হয়। এই ক্ষেতের আপনাকে তিনটি বিষয়ে সিদ্ধান্ত নিতে হবে- ১. Target price বা stop price এর ক্ষেত্রে লাভ-লোকসানের অনুপাত কি হওয়া উচিত? ২. পরবর্তী দীর্ঘমেয়াদী ট্রেডের ক্ষেত্রে আমি কি ট্রেন্ড অনূসরণ করবো অথবা করবোনা? ৩. আপনি কি মার্কেট প্রাইসে ট্রেড করবেন বা একটি উপযুক্ত প্রাইস লেভেলের জন্য অপেক্ষা করবেন ?
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_49">
                        <strong><u>The Rate-of-Change (ROC) :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_97" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_98" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_97">
                                            <img src="{{ URL::asset('/knowledge_basket/clip_image041.png') }}"/><br><br>
                                            <p>
                                                The Rate-of-Change (ROC) indicator, which is also referred to as simply Momentum, is a pure momentum oscillator that measures the percent change in price from one period to the next. The ROC calculation compares the current price with the price "n" periods ago. The plot forms an oscillator that fluctuates above and below the zero line as the Rate-of-Change moves from positive to negative. As a momentum oscillator, ROC signals include centerline crossovers, divergences and overbought-oversold readings. Divergences fail to foreshadow reversals more often than not so this article will forgo a discussion on divergences. Even though centerline crossovers are prone to whipsaw, especially short-term, these crossovers can be used to identify the overall trend. Identifying overbought or oversold extremes comes natural to the Rate-of-Change oscillator.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_98">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image041.png') }}"/><br><br>
                                            <p>
                                                The Rate-of-Change (ROC) ইনডিকেটরটি সাধারণত একটি মোমেনটার্ম এবং অনেক সময় এই ইনডিকেটরকে একটি বিশুদ্ধ momentum oscillator ও বলা হয়। সাধারণত এই ইনডিকেটরটি একটি নির্দিষ্ট সময় থেকে আরেকটি সময় পর্যন্ত দামের পরিবর্তনের হার নির্ণয় করে থাকে। যখন দামের পরিবর্তন হয় তখন Rate-of-Change ইনডিকেটরটি জিরো লাইনের এর ওপরে এবং নিচে ওঠানামা করে। যেহেতু Rate-of-Change একটি মোমেনটার্ম তাই এর সিগনাল গুলো অন্যান্য মোমেনটার্মের মতই হয়ে থাকে যেমন center line crossovers, divergences and overbought-oversold। এই পরিবর্তনের হার সাধারণত তিন ধরনের হয়ে থাকে সেইগুলো হচ্ছে আপ ট্রেন্ড, ডাউন ট্রেন্ড এবং সাইডওয়ে। সাধারণত একটি আপট্রেন্ড গঠিত হয় যখন কতগুলো higher highs এবং higher lows থাকে এবং দাম ও জিকজ্যাক করে আপট্রেন্ড অনুসরণ করে । এবং Pullback হয় যখন একটি নির্দিষ্ট সময় পর পর percentage move করে এবং ডাউন ট্রেন্ড গঠিত হয় যখন lows and lower highs এবং দাম ও জিকজ্যাক করে ডাউন ট্রেন্ড অনুসরণ করে.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_50">
                        <strong><u>Parabolic SAR with RSI and Stochastic :</u></strong><br><br>
                        <div class="row">                           
                            <div class="knowledge_basket_tab">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_99" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_100" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content knowledge_basket">
                                        <div class="tab-pane fade active in" id="tab_1_99">
                                            <img src="{{ URL::asset('/knowledge_basket/clip_image037.jpg') }}"/><br><br>
                                            <p>
                                                Parabolic SAR is an indicator and basically it indicates the momentum of an assets when the possibility of change the momentum. That is upward or downward change. In a chart Parabolic SAR, RSI and Stochastics oscillator were added to see the buy and sell signals. We know when RSI and Stochastics leave their Oversold area then they generate buy signals. Take a example of HR textile. In 3rd March 2011 we have seen a buy signals. If we look previous data then we find RSI and Stochastics Oscillator were in oversold situation and giving buy signals. These three Indicators buy signals were formed one after another and we can take it a good trade. Similarly look at the 3rd April 2011. That time RSI and Stochastics Oscillator were overbought situation and Parabolic SAR was in Downtrend. If anyone can use these three indicators then he or she can get easily buy signal.
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_100">
                                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image037.jpg') }}"/><br><br>
                                            <p>
                                                প্রথমে জানা যাক Parabolic SAR ইন্ডিকেটরটি কি । Parabolic SAR ইন্ডিকেটর হচ্ছে এমন একটি Indicator যেটা assets এর Momenterm নির্দেশ করে এবং যখন Momenterm এর দিক পরিবর্তনের সম্ভাবনা অনেক বেশি থাকে । অর্থাৎ upward অথবা dwonword এ যাবার সম্ভাবনা। নিন্মের একটি চার্টে Parabolic SAR ইন্ডিকেটর , RSI এবং Stochastics oscillator যুক্ত করা হয়েছে। ইতিমধ্যে আমরা জানি যখন RSI এবং Stochastics তাদের oversold স্থল ত্যাগ করা শুরু করে তখন তা buy সিগন্যাল হিসেবে কাজ করে এবং যখন RSI এবং Stochastics তাদের overbought স্থল ত্যাগ করা শুরু করে তখন তা buy সিগন্যাল হিসেবে কাজ করে।এখানে আমরা HR Textile এর একটি উদাহরন দিচ্ছি । ০৩-০৩-২০১১ তারিখে একটি buy সিগন্যাল দেখা গেছে। তারও আগে যদি আমরা ভাল মত লক্ষ করা হয় তবে দেখা যাবে RSI এবং Stochastics oscillator OverSold অবস্থায় ছিল এবং buy সিগন্যাল দিচ্ছিল । এই তিনটি ইন্ডিকেটরে buy সিগন্যাল পরপর সংঘটিত হয়েছে এবং এটি একটি ভাল ট্রেড হিসেবে বিবেচিত হয়েছে। আবার ০৩.০৪.২০১১ তারিখে আবার দেখা যায় RSI এবং Stochastics oscillator Overbought অবস্থায় ছিল এবং Parabolic SAR ও Downtrend এ ছিল। যদি এই তিনটি Indicators এক সাথে ব্যাবহার করা হয় তবে পরিষ্কার sell Signal পাওয়া যায়। আবার যদি May মাসের দিকে লক্ষ করা হয় তবে আবার ও RSI এবং Stochastics oscillator Oversold অবস্থায় দেখতে পাওয়া এবং আবার Buy সিগন্যাল পাওয়া যায়।
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection