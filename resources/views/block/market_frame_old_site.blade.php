<div class="row">
    <div class="col-md-12">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">Market Frame</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                    </a>
                    <a href="javascript:;" class="fullscreen" data-original-title="" title="">
                    </a>
                    <a href="javascript:;" class="reload" data-original-title="" title="">
                    </a>
                    <a href="javascript:;" class="remove" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body portlet-empty">
                <div style="padding-top:15px;" id="infovis"></div>
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

@push('css')
<link href="{{ URL::asset('metronic_custom/market_frame/treemap.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ URL::asset('metronic_custom/market_frame/jit-yc.js') }}"></script>

<script>

var labelType, useGradients, nativeTextSupport, animate;

(function() {
    var ua = navigator.userAgent,
        iStuff = ua.match(/iPhone/i) || ua.match(/iPad/i),
        typeOfCanvas = typeof HTMLCanvasElement,
        nativeCanvasSupport = (typeOfCanvas == 'object' || typeOfCanvas == 'function'),
        textSupport = nativeCanvasSupport
            && (typeof document.createElement('canvas').getContext('2d').fillText == 'function');
    //I'm setting this based on the fact that ExCanvas provides text support for IE
    //and that as of today iPhone/iPad current text support is lame
    labelType = (!nativeCanvasSupport || (textSupport && !iStuff))? 'Native' : 'HTML';
    nativeTextSupport = labelType == 'Native';
    useGradients = nativeCanvasSupport;
    animate = !(iStuff || !nativeCanvasSupport);
})();

var Log = {
    elem: false,
    write: function(text){
        if (!this.elem)
            this.elem = document.getElementById('log');
        this.elem.innerHTML = text;
        this.elem.style.left = (500 - this.elem.offsetWidth / 2) + 'px';
    }
};

function sbTip(tip, node, isLeaf, domElement) {
    var data = node.data;
    var arrowClass = 0 < data.$price_change_per ? 'priceUpHeaderSearch' : (0 == data.$price_change_per) ? 'priceStaticHeaderSearch' : 'priceDownHeaderSearch';
    var html = "<div class=\"tip-wrap\"><span style='font-weight:bold'>" + node.name + "</span>";
    if (data.$price_change_per != undefined) {
        html += "&nbsp;<span class='" + arrowClass + "'>&nbsp;</span>&nbsp; &nbsp;&nbsp;<br>";
    }
    if (data.$sector != undefined) {
        html += "<span class='tip-node-attributes-sector'>" + data.$sector + "</span><br>";
    }
    if (data.$volume) {
        html += "<span class='tip-node-attributes-key'>Volume : <span class='tip-node-attributes-value'>" + data.$volume + "</span></span><br>";
    } else if (data.$turn_over) {
        html += "<span class='tip-node-attributes-key'>Turnover : <span class='tip-node-attributes-value'>" + data.$turn_over + "</span></span><br>";
    } else if (data.$no_of_trade) {
        html += "<span class='tip-node-attributes-key'>Trades : <span class='tip-node-attributes-value'>" + data.$no_of_trade + "</span></span><br>";
    }
    if (data.$price != undefined) {
        html += "<span class='tip-node-attributes-key'>Current Price : <span class='tip-node-attributes-value'>" + data.$price + "</span></span><br>";
    }
    if (data.$price_change_per != undefined) {
        html += "<span class='tip-node-attributes-key'>Change Percent : <span class='tip-node-attributes-value'>" + data.$price_change_per + " % </span></span><br>";
    }
    html += "</div>";
    tip.innerHTML = html;
}

function setFontSize(node) {
    var noOfCharacters = node.name.length;
    var labelElementWidth = parseInt(node.endData.$width);
    var proposingFontSize;
    proposingFontSize = parseInt(labelElementWidth / noOfCharacters);
    proposingFontSize = parseInt(proposingFontSize * (1.12));
    return proposingFontSize;
}

function init(){
    //init data
    var LIGHT_RED = "light-red";
    var DARK_RED = "deep-red";
    var DARK = "dark";
    var DARK_GREEN = "deep-green";
    var LIGHT_GREEN = "light-green";
    var EXCHANGE_AREA = {{$market_turnover}};

    var FONT_THRESHOLD_MIN_SIZE = 7;
    var REDUCE = 3;
    var PUSH_VAL = 4;
    var containerHeight = $jit.id('infovis').offsetHeight;
    var containerWidth = $jit.id('infovis').offsetWidth;
    var containerArea = containerHeight * containerWidth;

    var json = {!! $frameData !!};
    //end
    //init TreeMap
    var tm = new $jit.TM.Squarified({
        //where to inject the visualization
        injectInto: 'infovis',
        //parent box title heights
        titleHeight: 15,
        //enable animations
        animate: animate,
        //box offsets
        offset: 1,
        //Attach left and right click events
        Events: {
            enable: true,
            onClick: function(node) {
                if(node) tm.enter(node);
            },
            onRightClick: function() {
                tm.out();
            }
        },
        duration: 1000,
        //Enable tips
        Tips: {
            enable: true,
            //add positioning offsets
            offsetX: 20,
            offsetY: 20,
            //implement the onShow method to
            //add content to the tooltip when a node
            //is hovered
            onShow:sbTip
        },
        //Add the name of the node in the correponding label
        //This method is called once, on label creation.
        /*
         onCreateLabel: function(domElement, node){
         domElement.innerHTML = node.name;
         var style = domElement.style;
         style.display = '';
         style.border = '1px solid transparent';
         domElement.onmouseover = function() {
         style.border = '1px solid #9FD4FF';
         };
         domElement.onmouseout = function() {
         style.border = '1px solid transparent';
         };
         }
         });*/

        onCreateLabel: function(domElement, node) {
            if (node.data.$class == 'exchange') {
                domElement.innerHTML = node.name;
                domElement.className = "node exchange";
            } else if (node.data.$class == 'sector') {
                domElement.innerHTML = node.name;
                domElement.className = "node sector";
            } else if (node.data.$class == 'stock') {
                var colorClass = LIGHT_GREEN;
                if (node.data.$price_change_per < -2.0) {
                    colorClass = DARK_RED;
                } else if (node.data.$price_change_per < -0) {
                    colorClass = LIGHT_RED;
                } else if (node.data.$price_change_per < 0) {
                    colorClass = LIGHT_GREEN;
                } else if (node.data.$price_change_per < 2.0) {
                    colorClass = DARK_GREEN;
                } else {
                    colorClass = LIGHT_GREEN;
                }
                var fontSizeBySector = parseInt((node.data.$area / node.data.$sectorArea) * 80) + PUSH_VAL;
                var percent = node.data.$price_change_per;
                var fontSize;
                var fontSizeAccordingToSectorArea = parseInt(((node.data.$area / node.data.$sectorArea) * (node.data.$sectorArea / EXCHANGE_AREA)) * 750) + 4;

                var fontSizeAccordingToElementWidth = setFontSize(node);
                fontSize = fontSizeAccordingToElementWidth;

                var Browser = {
                    Version: function() {
                        var version = 999; // we assume a sane browser
                        if (navigator.appVersion.indexOf("MSIE") != -1)
                        // bah, IE again, lets downgrade version number
                            version = parseFloat(navigator.appVersion.split("MSIE")[1]);
                        return version;
                    }
                }

                if (Browser.Version() <= 8) {

                    fontSize =parseInt(fontSizeAccordingToSectorArea * 40 / 100);
                    var dataw = node.data;
                    if (dataw.$noOfTrades) {
                        fontSize =parseInt(fontSizeAccordingToSectorArea * 100 / 100);
                    }
                    else if(dataw.$volume){

                        fontSize =parseInt(fontSizeAccordingToSectorArea * 90 / 100);

                    }
                }
                fontSize = Math.max(fontSize, FONT_THRESHOLD_MIN_SIZE);
                var labelHight = fontSize * 2.2;
                var name = node.name;
                var percentMark = "%";
                if (node.endData.$height < labelHight) {
                    name = "";
                    percent = "";
                    percentMark = "";
                }
                var distance = parseInt((node.endData.$height / 2) - (labelHight / 2));
                var top = (0 < distance) ? distance : 5;
                var fontSizePercentageLabel = ( FONT_THRESHOLD_MIN_SIZE < parseInt(fontSize * 0.75)) ? parseInt(fontSize * 0.75) : FONT_THRESHOLD_MIN_SIZE;
                domElement.innerHTML = "<div style='line-height:" + fontSize + "px;font-size:" + fontSize + "px; position: relative; top:" + top + "px;color: #ffffff'>" + name + " <br><span class='percent-class' style='font-size:" + fontSizePercentageLabel + "px;'>" + percent + percentMark + "</span></div>";
                domElement.className = colorClass + " node stock";
            }
        }
    });
    tm.loadJSON(json);
    tm.refresh();
    //end

}

init();

</script>



@endpush

