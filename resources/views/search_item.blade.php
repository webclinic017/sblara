<div class="item asp_result_pagepost opacityOne asp_an_voidanim">
    <div class="asp_content">
        <a class="asp_res_image_url" href="/yourlink">
            <div class="asp_image" style="background-image: url(https://placeholdit.imgix.net/~text?txtsize=28&txt=300%C3%97300&w=300&h=300);">
                <div class="void"></div>
            </div>
        </a>
        <h3><a class="asp_res_url" href="/youlink">
                {{$databank->instrument->instrument_code}} <span class="overlap"></span>
            </a></h3>
        <div class="etc">
        </div>
        <b>{{$databank->instrument->name}} : </b> High Price: (<span class="price">{{$databank->high_price}}</span>)
        Close Price: (<span class="price">{{$databank->close_price}}</span>)
        Day Close Price: (<span class="price">{{$databank->yday_close_price}}</span>)
        Price Change: (<span class="price">{{$databank->price_change}}</span>)
        Price Change Per (<span class="price">{{$databank->price_change_per}}</span>)
        <div class="pull-right">
            <a href="/yourlinkhere">
                <button class="btn btn-small btn-success">Get Price</button>
            </a>
            <a href="/yourlinkhere">
                <button class="btn btn-small btn-warning">Get Next</button>
            </a>
            <a href="/yourlinkhere">
                <button class="btn btn-small btn-success">Detilas</button>
            </a>
        </div>
    </div>
    <div class="clear"></div>
</div>
<!--code, closeprice, y day close price, change, change_per, volume , trade value etc-->