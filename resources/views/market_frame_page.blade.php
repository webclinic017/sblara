@extends('layouts.metronic.default')

@section('content')

    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Market frame </span>
                        <span class="caption-helper">Eagle view of the market</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
                    @include('block.market_frame_old_site',['base'=>'total_value'])
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>

<div class="row">
<div class="col-md-8">
    <div class="note note-info note-bordered">

        <p>
            <!--Use <code>&lt;a href="#" data-load="true" data-url="portlet_ajax_content_1.html" class="reload"&gt;&lt;/a&gt;</code> markup to enable the ajax portlet.-->
            মার্কেট ফ্রেইমে ডি.এস.ই'র প্রত্যেকটি সেক্টরের প্রতিটি শেয়ারের মূল্য কত শতাংশ বৃদ্ধি বা হ্রাস পেয়েছে সেটি একবারে দেখা যায়। যে কোন একটি সেক্টরের নামের ওপর (হলুদ রং) ক্লিক করলে শুধু মাত্র ঐ সেক্টরের বিস্তারিত তথ্য দেখা যাবে। আবার যদি কোন কোম্পানিতে ক্লিক করা হয় তবে ঐ কোম্পানির তথ্য দেখা যায়। পুনরায় ফিরে যেতে অর্থাৎ আগের অবস্থানে যেতে শুধু রাইট ক্লিক করতে হবে।
        </p>
        <p>
            মার্কেট ম্যাপে ৪টি রং ব্যবহার করা হয়েছে। যেসব কোম্পানির মূল্য> ২% থেকে  বেশি বৃদ্ধি পেয়েছে সেটির রং গাঢ় সবুজ এবং যেসব কোম্পানির মূল্য> ০ থেকে ২% এর মধ্যে বৃদ্ধি পেয়েছে সেটির রং হালকা সবুজ হয়েছে। বিপরীতভাবে যেসব কোম্পানির মূল্য< ২% থেকে  বেশি হ্রাস পেয়েছে সেটির রং গাঢ় লাল এবং যেসব কোম্পানির মূল্য< ০ থেকে ২% এর মধ্যে হ্রাস পেয়েছে সেটির রং হাল্কা লাল হয়েছে।
        </p>
    </div>

</div>
<div class="col-md-4">
    <div style="text-align: center;padding-top:50px;"><img src='{{ url('/metronic_custom/market_frame/market_cap_ratio.png') }}' broder=0></div>
</div>
</div>


@endsection