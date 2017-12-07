@extends('layouts.metronic.default')
@section('content')

<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>KNOWLEDGE BASKET </div>
    </div>
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2">
                <ul class="nav nav-tabs tabs-left">
                    <li class="active">
                        <a href="#tab_6_1" data-toggle="tab">
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image100.jpeg')}}" width="100px" height="50px"/>
                            <br>Technical
                        </a>
                    </li>
                    <li>
                        <a href="#tab_6_2" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image010.png')}}" width="100px" height="50px"/>
                            <br>Bullish 
                        </a>
                    </li>
                    <li>
                        <a href="#tab_6_3" data-toggle="tab">
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image007.png')}}" width="100px" height="50px"/>
                            <br>Bearish 
                        </a>
                    </li>
                    <li>
                        <a href="#tab_6_4" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image009.gif')}}" width="100px" height="50px"/>
                            <br>Squeeze 
                        </a>
                    </li>
                    <li>
                        <a href="#tab_6_5" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image008.gif')}}" width="100px" height="50px"/>
                            <br>Bands </a>
                    </li>
                    <li>
                        <a href="#tab_6_6" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image032.gif')}}" width="100px" height="50px"/>
                            <br>Crossover </a>
                    </li>
                    <li>
                        <a href="#tab_6_7" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image034.png')}}" width="100px" height="50px"/>
                            <br>Average </a>
                    </li>
                    <li>
                        <a href="#tab_6_8" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image031.png')}}" width="100px" height="50px"/>
                            <br>MACD </a>
                    </li>
                    <li>
                        <a href="#tab_6_9" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image043.gif')}}" width="100px" height="50px"/>
                            <br>RSI </a>
                    </li>
                    <li>
                        <a href="#tab_6_10" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image044.gif')}}" width="100px" height="50px"/>
                            <br>Stochastics </a>
                    </li>
                    <li>
                        <a href="#tab_6_11" data-toggle="tab"> 
                            <img src="{{ URL::asset('/knowledge_basket/images/clip_image050.gif')}}" width="100px" height="50px"/>
                            <br>Ultimate </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 col-sm-10 col-xs-10">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_6_1">
                        <strong><u>Technical Analysis :</u></strong><br><br>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <img src="{{ URL::asset('/knowledge_basket/images/clip_image100.jpeg') }}"/>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-body">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab"> English </a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab"> Bangla </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade active in" id="tab_1_1">
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
                                                <p> 
                                                <ol>
                                                    <li>Long black (filled-in)line: এটি একটি বিয়ারিশ রেখা।একটি নির্দিষ্ট সময়ে প্রারম্ভিক মূল্য সর্বোচ্চের কাছাকাছি থেকে শুরু হয়ে সর্বনিন্ম মূল্যের কাছে গিয়েই শেষ হয়।</li>
                                                    <li>Hanging man: এই রেখাগুলি বিয়ারিশ যা uptrend এর পর সৃস্টি হয়।যদি এই রেখাগুলি downtrend এর পর তৈরি হয় তবে আমরা একে hammer বলবো।এদের ছোট শরীর (প্রারম্ভিক মূল্য ও সমাপ্তি মূল্যের অল্প পার্থক্য) ও নিচের দিকে লম্বা ছায়া (সর্বোনিন্ম মূল্য প্রারম্ভিক, সর্বোচ্চ, সমাপ্তি মূল্যের চেয়েও নিচে অবস্থান করে) দেখে এদের চিহ্নিত করা যায়।এটি পূর্ণ কিম্বা খালি থাকে। </li>
                                                    <li>Dark cloud cover. এই কেন্ডেলটি একই বিয়ারিশ কেন্ডেল যা আগের দিনের কেন্ডেলের শমাপ্তি মূল্যর ওপরে থেকে শুরু হয় এবং আগের দিনের কেন্ডেলকে ঢেকে ফেলে।</li>
                                                    <li>Bearish engulfing lines: এটি একটি বিয়ারিশ প্যাটার্ণ। সাধারণতঃ এটি uptrend এর পর সৃস্টি হয়(এটি রিভেরসেল হিসেবে কাজ করে)।যখন ছোট বুলিশ(খলি) রেখাটি একটা বড় বিয়ারিশ রেখা(পূর্ণ) দ্বারা আবৃত থাকে।</li>
                                                    <li>Evening star: এটি একটি বিয়ারিশ প্যাটার্ণ যা সম্ভাব্য শীর্ষবিন্দু নির্দেশ করে।এখানে সটারটি রিভারসেলের সম্ভাবনা নির্দেশ করে এবং বিয়ারিশ রেখাটি এই নির্দেশনাকে সমর্থন করে।স্টারটি পূর্ণ বা খালি থাকতে পারে।</li>
                                                    <li>Doji star: স্টারটি রিভেরসেলের এবং ডজিটি সিদ্ধান্তহীনতা নির্দেশ করে।যদিও এটি অনিশ্চিত সময়ে রিভারসেলের ইঙ্গিত দেয়।নিশ্চিত না হওয়া পর্যন্ত এই ডজি দেখার পর আপনাকে অপেক্ষা করতে হবে। </li>
                                                    <li>Shooting star: এই প্যাটার্ণটি অল্পস্বল্প রিভারসেলের ইঙ্গিত দেয় যা সাধারণতঃ রেখার মিছিলের পর প্রতিভাত হয়। সর্বনিন্ম মূল্যের কাছাকাছি স্টারটি পরিলক্ষিত হয় এবং এর উপরের দিকে একটি দীর্ঘ লম্বা ছায়া থাকে।</li>
                                                </ol>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="clearfix margin-bottom-20"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_2">
                        <strong><u>Bullish Candlestick Pattern :</u></strong><br><br>
                        <img src="{{ URL::asset('/knowledge_basket/images/clip_image010.png') }}"/><br><br>
                        <div class="row">                           
                            <div class="portlet light bordered">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_3" data-toggle="tab"> English </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_4" data-toggle="tab"> Bangla </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="tab_1_3">
                                            <p> 
                                            <ol>
                                                <li>Long white (empty) line. This is a bullish line. It occurs when prices open near the low and close significantly higher near the period's high. The long white is a sign that buyers are firmly in control so its a bulish symbol. </li><br>
                                                <li>Hammer: The hammer signals a reversal after a downtrend when control has already been shifted from sellers to buyers. This is ofcourse bullish line if it occurs after a significant downtrend. If the line occurs after a significant up-trend, it is called a Hanging Man. A Hammer is identified by a small real body (i.e., a small range between the open and closing prices) and a long lower shadow (i.e., the low is significantly lower than the open, high, and close). The body can be empty or filled-in.</li><br>
                                                <li>Piercing line. This is a bullish pattern and the opposite of a dark cloud cover. The first line is a long black line and the second line is a long white line. The second line opens lower than the first line's low, but it closes more than halfway above the first line's real body.</li><br>
                                                <li>Bullish engulfing lines. Engulfing patterns consist of two bodies and where the second body “engulfs” the first. This pattern is strongly bullish if it occurs after a significant downtrend (i.e., it acts as a reversal pattern). It occurs when a small bearish (filled-in) line is engulfed by a large bullish (empty) line. </li><br>
                                                <li>Morning star: The morning Star pattern is a bullish reversal signal after a dwontrend. the first bar has a long black body, the second body gaps down from the first (the shadows may still overlap) and may be filled or hollow. This is a bullish pattern signifying a potential bottom. The "star" indicates a possible reversal and the bullish (empty) line confirms this.</li><br>
                                                <li>Bullish doji star. A "star" indicates a reversal and a doji indicates indecision. Thus, this pattern usually indicates a reversal following an indecisive period. You should wait for a confirmation (e.g., as in the morning star, above) before trading a doji star. The first line can be empty or filled in.</li><br>
                                            </ol>                                            
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_4">
                                            <p> 
                                            <ol>
                                                <li>Long white (empty)line: এটি হচ্ছে একটি বুলিশ রেখা ।এটি সৃষ্টি হয় যখন প্রারম্ভিক মূল্য সর্বনিন্ম থেকে শুরু হয়ে একেবারে দিনের সর্বোচ্চ প্রান্তে কাছাকাছি গিয়ে শেষ হয় ।</li>
                                                <li>Hammer: এটি একটি বুলিশ রেখা । সাধারণতঃ এটি একটি downtrend এর পর সৃষ্টি হয় । যদি এটি একটি গুরুত্বপূর্ণ uptrend এর পর সৃষ্টি হয় তবে এটকে Hanging man বলা হয় । হ্যামার সাধরণত একটি ছোট শরীর (প্রারম্ভিক মূল্য ও সমাপ্তি মূল্যের অল্প পার্থক্য) ও নিচের দিকে লম্বা ছায়া থাকে (সর্বোনিন্ম মূল্য প্রারম্ভিক, সর্বোচ্চ, সমাপ্তি মূল্যের চেয়েও নিচে অবস্থান করে).</li>
                                                <li>Piercing Line: এটি বুলিশ রেখা এবং ডার্ক ক্লাউড কাভারের বিপরীত । প্রথম লম্বা রেখাটি সম্পূর্ণ কালো এবং দ্বিত্বীয় লম্বা রেখাটি সাদা হয়ে থাকে। প্রথম রেখাটির নিন্মস্তরের চেয়েও নিচে হতে দ্বিত্বীয় রেখাটি শুরু হয়। কিন্তু এটি প্রথম রেখাটির মধ্যবর্তী অংশের কিছু উপরে গিয়ে শেষ হয় । </li>
                                                <li>Bullish engulfing lines: এটি একটি জোরালো বুলিশ প্যাটার্ণ যা একটি গুরুত্বপূর্ণ downtrend পর দেখা যায় (এটি রিভারসেল হিসেবে কাজ করে)। যখন একটি ছোট বিয়ারিশ(bearish)রেখা বড় বুলিশ(bullish)রেখা দ্বারা আবৃত থাকে তখন এটি সৃষ্টি হয়।</li>
                                                <li>Morning star: এটি ও একটি বুলিশ প্যাটার্ণ যা নিন্মের গতি নির্দেশ করে ।এখানে সটারটি রিভারসেলের সম্ভাবনা এবং বুলিশ (খালি) রেখাটি সে সম্ভাবনাকে নিশ্চিত করে ।এ স্টারটি পূর্ণ বা খালি থাকতে পারে। </li>
                                                <li>Bullish doji star: সটার রিভারসেল নির্দেশ করে ও ডজি সিদ্ধান্তহীনতা প্রকাশ করে ।যদিও এটি অনিশ্চিত সময়ে রিভারসেল প্রদর্শণ করে।ট্রেড এর নিশ্চয়তার জন্য ডজি দেখলেই অপেক্ষা করতে হবে।প্রথম রেখাটি পূর্ণ বা খালি থাকতে পারে।</li>
                                            </ol>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="clearfix margin-bottom-20"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_6_3">
                        <p> 
                            3
                        </p>
                    </div>
                    <div class="tab-pane fade" id="tab_6_4">
                        <p> 
                            4
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection