<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 se-search">
    
<form class="search" action="extra_search.html" method="GET">
    {{csrf_field()}}
    <div class="search-input">
        <input type="name" class="form-control" name="query" placeholder="Search..." id="top-search" autocomplete="off" style="background-color: #fff; width: 300px;">
    <a href="javascript:;" class="btn submit md-skip">
        <i class="fa fa-search"></i>
    </a>


    </div>
</form>
<style>
.company-search p {
    margin-top: 0;
}


.company-search> .portlet {
    margin-top: 0;
    margin-bottom: 0px;
    padding: 0;
    border-radius: 2px;
}

/*
.list-group-item.up, .list-group-item.active:focus, .list-group-item.active:hover {
    z-index: 2;
    color: #fff;
    background-color: #26C281;
    border-color: #26C281;
}
.list-group-item.down, .list-group-item.active:focus, .list-group-item.active:hover {
    z-index: 2;
    color: #fff;
    background-color: #EF4836;
    border-color: #EF4836;
}
*/

</style>
<div class="search-result company-search">

{{--
<div class="list-group company-search">

</div>
--}}
</div>


</div>