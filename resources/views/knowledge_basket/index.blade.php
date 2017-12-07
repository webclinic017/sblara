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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection