@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->

@section('content')

<table class="home_grid" border="0" cellspacing="1" cellpadding="0" style="height:auto; width:80.98%;float:left;">            
    <tbody><tr>
        <tr>
            <td class="last">
                <div id="flash-message">
                </div>

                <div align="center" class="course-details" style="border:1px solid #CCCCCC; color:#000000; width:785px; height:auto; margin:0 auto; font-family:Calibri, Verdana, Arial;">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td width="785" valign="top" height="249" background="http://www.stockbangladesh.com/images/course_top.jpg" align="center"><table width="95%" cellspacing="0" cellpadding="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="82%" valign="top" style="height:130px; text-align:left;">
                                                    <a style="position:relative; top:25px; left:260px; font-size:18px; text-decoration:blink;" href="{{ route('registration.create', $batch->id) }}" target="_blank">Register Online</a>
                                                    <p>&nbsp;</p></td>
                                            </tr>
                                            <tr>
                                                <td><table width="100%" style="height:90px; overflow:hidden;">
                                                        <tbody><tr>
                                                                <td align="right" style="padding-top:15px; font-family:'Copperplate Gothic Bold', Calibri, Verdana; color:#000000; color:#e36c0a; font-size:18px;">Exclusive Training Program on {{ $batch->course->course_name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td height="25" align="right" style="font-size:12px;">Venue: {{ $batch->venue->venue_address }}</td>
                                                            </tr>
                                                        </tbody></table></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="padding-left:580px; padding-top:3px; font-size:16px; text-decoration:blink;">
                                                    <a href="{{ route('registration.create', $batch->id) }}" target="_blank">Register Online</a> 
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table></td>
                            </tr>
                            <tr>
                                <td style="background-color:#FFFFFF; text-align:center">
                                    <span class="st_facebook_hcount" displaytext="Facebook" st_processed="yes"><span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton"><span><span class="stMainServices st-facebook-counter" style="background-image: url(&quot;http://w.sharethis.com/images/2017/facebook_counter.png&quot;);">&nbsp;</span><span class="stArrow"><span class="stButton_gradient stHBubble"><span class="stBubble_hcount"></span></span></span></span></span></span>
                                    <span class="st_twitter_hcount" displaytext="Tweet" st_processed="yes"><span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton"><span><span class="stMainServices st-twitter-counter" style="background-image: url(&quot;http://w.sharethis.com/images/2017/twitter_counter.png&quot;);">&nbsp;</span><span class="stArrow"><span class="stButton_gradient stHBubble"><span class="stBubble_hcount"></span></span></span></span></span></span>
                                    <span class="st_linkedin_hcount" displaytext="LinkedIn" st_processed="yes"><span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton"><span><span class="stMainServices st-linkedin-counter" style="background-image: url(&quot;http://w.sharethis.com/images/2017/linkedin_counter.png&quot;);">&nbsp;</span><span class="stArrow"><span class="stButton_gradient stHBubble"><span class="stBubble_hcount"></span></span></span></span></span></span>
                                    <span class="st_googleplus_hcount" displaytext="Google +" st_processed="yes"><span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton"><span><span class="stButton_gradient"><span class="chicklets googleplus">Google +</span></span><span class="stArrow"><span class="stButton_gradient stHBubble"><span class="stBubble_hcount"></span></span></span></span></span></span>
                                    <span class="st_email_hcount" displaytext="Email" st_processed="yes"><span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton"><span><span class="stMainServices st-email-counter" style="background-image: url(&quot;http://w.sharethis.com/images/2017/email_counter.png&quot;);">&nbsp;</span><span class="stArrow"><span class="stButton_gradient stHBubble"><span class="stBubble_hcount"></span></span></span></span></span></span>
                                </td>
                            </tr>
                            <tr>
                                <td><table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" ;="">
                                        <tbody>

                                            <tr>
                                                <td width="65%" valign="top"><div style="border:1px solid #CCCCCC; margin:5px 10px 5px 20px;font-family:Verdana; color:#000000;">
                                                        <table width="96%" cellspacing="0" cellpadding="0" border="0" style="margin-left:10px">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="color:#ff6600">
                                                                        <strong>
                                                                            <u>
                                                                            {{ !empty($batch->course->course_overview_title)?$batch->course->course_overview_title:'Training Overview' }}                                                        </strong>
                                                                            </u>
                                                                        </strong>                                                                 
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p style="text-align: justify;">
                                                                            {!! !empty($batch->course->course_overview)?$batch->course->course_overview:'' !!}</p>
                                                                        <p style="text-align: justify;">{{ !empty($batch->course->objectives_of_course_title)?$batch->course->objectives_of_course_title:'Objectives of Course' }}</p>
                                                                        <ol>
                                                                        </ol>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table width="96%" cellspacing="0" cellpadding="0" border="0" style="margin-left:10px">
                                                            <tbody>
                                                                <tr>
                                                                    <td height="22" bgcolor="#000000" style="color:#ff6600; font-size:14px;padding:3px 10px;"><strong>
                                                                            Topic to be covered:                                                        </strong> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td valign="top"><ol>
                                                                            <li style="text-align: justify;">
                                                                                Basic Operation of Stock Market</li>
                                                                            <li style="text-align: justify;">
                                                                                Types of Analysis</li>
                                                                            <li style="text-align: justify;">
                                                                                Candlestick patterns and impact</li>
                                                                            <li style="text-align: justify;">
                                                                                Introduction on Leading Indicators (RSI, MFI, ROC, Etc.)</li>
                                                                            <li style="text-align: justify;">
                                                                                Introduction on Lagging Indicators (Moving Average, MACD,Bollinger Bands Etc.)</li>
                                                                            <li style="text-align: justify;">
                                                                                Reading Chart Patterns (Reversal Patterns, Continuation Patterns, Head &amp; Shoulder)</li>
                                                                            <li style="text-align: justify;">
                                                                                AmiBroker Overview</li>
                                                                            <li style="text-align: justify;">
                                                                                Trading Rules and strategies</li>
                                                                            <li style="text-align: justify;">
                                                                                How to use StockBangladesh's site to trade effectively</li>
                                                                            <li style="text-align: justify;">
                                                                                StockBangladesh's Courses</li>
                                                                        </ol>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="right" style="background-color:#D3D2D0;"><hr>
                                                                        Above schedule is subject to change without prior intimations<br>
                                                                        <strong>NO SMOKING</strong> is allowed inside the class<br>
                                                                        Please keep your mobile in <strong>SILENT MOOD</strong><br>

                                                                        &nbsp;</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div></td>
                                                <td width="34%" valign="top"><div style="border:0px solid #CCCCCC; margin:5px 20px 5px 0px;">
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ebeaea">
                                                            <tbody>
                                                                <tr>
                                                                    <td><table width="95%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td height="25" bgcolor="#9bbb59" align="center" style="color:#FFFFFF;font-size:12px; font-family:Verdana;"><strong>
                                                                                            Training Details </strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="line-height:20px; font-size:12px; font-family:Verdana;">                                                                        <p><strong>Start Date: </strong> Nov 21, 2017<br>
                                                                                            <strong>Days in  Week:</strong> Tuesday<br>
                                                                                            <strong>Duration: </strong> 4 Hours<br>
                                                                                            <strong>Time:</strong> 04:00PM - 08:00PM <br>
                                                                                            <strong>Last Date of Reg.</strong>: <span style="color:#990000;"> Nov 20, 2017</span> <strong><br>
                                                                                                Training Fees: </strong>
                                                                                            BDT 0/-                                                                             per Participant
                                                                                        </p></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table></td>
                                                                </tr>
                                                                <tr>
                                                                    <td bgcolor="#FFFFFF">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-bottom:20px"><table width="95%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td height="25" bgcolor="#9bbb59" align="center" style="color:#FFFFFF;font-size:14px; font-family:Verdana;"><strong>Facilitator's Profile </strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="line-height:19px;font-size:12px; font-family:Verdana; padding-bottom:10px;"><p><strong>
                                                                                            </strong>
                                                                                        </p>
                                                                                        <p>
                                                                                            Team of Expert Researchers from StockBangladesh Ltd.'s Research and Development Department.</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table></td>
                                                                </tr>
                                                                <tr>
                                                                    <td bgcolor="#FFFFFF">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>                                                        <table width="95%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td height="25" bgcolor="#9bbb59" align="center" style="color:#FFFFFF;font-size:14px; font-family:Verdana;"><strong>
                                                                                            Who Should Attend                                                                        </strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="right_shift"><ul>
                                                                                            <li>
                                                                                                Personnel in Financial Institutions</li>
                                                                                            <li>
                                                                                                General Investors</li>
                                                                                            <li>
                                                                                                Anyone who is interested to learn Technical Analysis</li>
                                                                                        </ul>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td bgcolor="#FFFFFF">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><table width="95%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td height="25" bgcolor="#9bbb59" align="center" style="color:#FFFFFF;font-size:14px; font-family:Verdana;"><strong>Learning Methodologies</strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="line-height:19px;font-size:12px; font-family:Verdana;"></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="right_shift"><ul>
                                                                            <li> Presentation</li>
                                                                            <li> Facilitator Feedback</li>
                                                                            <li> Discussion</li>
                                                                            <li> Q &amp; A</li>
                                                                            <li> Exercises</li>
                                                                        </ul></td>
                                                                </tr>
                                                                <tr>
                                                                    <td bgcolor="#FFFFFF">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>                                                        <table width="95%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td height="25" bgcolor="#9bbb59" align="center" style="color:#FFFFFF;font-size:14px; font-family:Verdana;"><strong>
                                                                                            Special Notes                                                                        </strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="right_shift" style="line-height:19px;font-size:12px; font-family:Verdana;"><ul>
                                                                                            <li>
                                                                                                Refreshments during breaks.</li>
                                                                                        </ul>
                                                                                        <ul>
                                                                                            <li>
                                                                                                <strong>SEATS ARE LIMITED</strong></li>
                                                                                        </ul>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td bgcolor="#FFFFFF" headers="15">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><table width="95%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td height="25" bgcolor="#9bbb59" align="center" style="color:#FFFFFF;font-size:14px; font-family:Verdana;"><strong>Registration Process</strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="line-height:20px;font-size:11px; font-family:Verdana;"><p><strong>Step 01:</strong> For online registration <a href="/courses/register/153" target="_blank">Click</a> here. <br>
                                                                                            <strong>Step 02:</strong> Deposit the training fee to Account No.<strong> 107-110-9792</strong> at <strong>ANY BRANCH Of</strong> of<strong> Dutch-Bangla BANK LTD </strong> favoring <strong>STOCKBANGLADESH LTD.</strong><br>
                                                                                            <strong>Step 03:</strong> email the scanned copy of the Bank deposit slip  at <a href="training@stockbangladesh.com">training@stockbangladesh.com</a> to ensure your  participation.<br>
                                                                                            <strong>Or</strong><br>
                                                                                            <strong>Visit our office for registration.</strong></p>
                                                                                        <p>Seat will be  confirmed after payment. For registration or information please call Hot-Line</p>
                                                                                        <p align="center" style="font-size:20px; color:#990000; padding-bottom:15px;"><strong>  0192 9912 878 </strong></p>
                                                                                        <div style="font-size: 14px;padding-bottom: 10px;text-align: center;text-decoration: blink;"> 
                                                                                            <a href="/courses/register/153" target="_blank"> Register Online </a>
                                                                                        </div></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table></td>
                                                                </tr>
                                                                <tr>
                                                                    <td bgcolor="#FFFFFF" headers="15">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><table width="95%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td height="25" bgcolor="#9bbb59" align="center" style="color:#FFFFFF;font-size:14px; font-family:Verdana;"><strong>Contact Details </strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td valign="top" style="padding:0px;font-size:12px; font-family:Verdana; line-height:19px;"><p><strong>StockBangladesh Limited</strong><br>
                                                                                            Dhaka Trade Center (14th floor), <br>
                                                                                            99 KaziNazrul Islam Avenue, <br>
                                                                                            Kawran Bazar, <br>
                                                                                            Dhaka-1215 </p>
                                                                                        <p>Phone: +88 02 8189295-8<br>
                                                                                            Mobile: 0192 9912 878 <br>
                                                                                            Email: <small>training@stockbangladesh.com</small><br>
                                                                                            Web: www.stockbangladesh.com</p></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table></td>
                                                                </tr>
                                                                <tr>
                                                                    <td bgcolor="#FFFFFF" headers="15">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><table width="95%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td height="25" bgcolor="#9bbb59" align="center" style="color:#FFFFFF;font-size:12px; font-family:Verdana;"><strong>Payment Policies and Procedures:</strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="font-size:10px; line-height:14px;font-family:Verdana;"><p>Payment is to be made by last date of registration. If you cannot attend any program for which you have paid, a notification within no less than 2 business days prior to your session’s start is required for courtesy transfer to use in any future Training program. If you fail to attend without notifying us in writing, in fairness to all attendees, neither a refund nor a courtesy transfer will be issued.</p></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table></td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td valign="top" height="30" align="center" colspan="2" style="background-color:#ebeaea; height:30px; padding:5px;font-size:13px; font-family:Verdana;">
                                                    <a href="/courses/register/153" target="_blank"> Register Online</a> 
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p>&nbsp;</p>
            </td>
        </tr>


    </tbody></table>


@endsection
@push('scripts')
<script type="text/javascript">var switchTo5x = true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "ur-c9efbd4-b6ab-6f34-62df-2507f2ccea75"});</script>
@endpush
@push('css')
<style>
    .course-details .home_grid tr {
        display:none!important;
    }
    .course-details td, ul{


        border-bottom:0px!important;
        font-family:Verdana, Arial, Helvetica, sans-serif;
    }
    .right_shift ul
    {
        padding-left:20px!important;
    }
    .course-details ul li
    {
        list-style:circle!important;
        margin-left:20px!important;
    }
    .course-details ol li
    {
        list-style:decimal-leading-zero!important;
        margin-left:20px!important;
    }
    a{
        color:#990000;
        font-weight:bold;
    }
</style>
@endpush
