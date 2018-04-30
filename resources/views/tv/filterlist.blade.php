<div class="panel-group accordion " id="filter">

    <div class="panel panel-default hasfilter" id="allshares">
        <div class="panel-heading">
            <h4 class="panel-title">
                 <a class="accordion-toggle accordion-toggle-styled " data-toggle="collapse" data-parent="#filter" href="#allshares_1"> All Shares </a>
            </h4>
        </div>
        <div id="allshares_1"  class="panel-collapse in">
<table class="table table-striped table-hover filter-table">
    <thead>
        
    <tr style="background: #f5f5f5">
        <td>Category</td>
        <td>
            <select style="width: 98%" data-name="category" class="filter-param">
                <option value="All">All</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="N">N</option>
                <option value="Z">Z</option>
            </select>
        </td>
    </tr>
    <tr style="background: #f5f5f5">
        <td>Sector</td>
        <td>
            <select style="width: 98%"   data-name="sector" class="filter-param">
                <option value="All">All</option>
                @foreach(\App\SectorList::all() as $sector)
                <option value="{{$sector->id}}">{!!shorten($sector->name, 15)!!}</option>
                @endforeach
            </select>
        </td>
    </tr>
    </thead>
</table>            
            <div class="panel-body" >

            </div>
        </div>
    </div>

</div>