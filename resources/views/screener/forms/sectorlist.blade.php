<div id="SECTORLIST">
    <div class="alert alert-warningdf alert-dismissable" >
        <div class="row">
        <div class="col-md-12">

         <label class="col-md-4 control-label" for="form_control_1"></label>
         <form action="" class="form-inline">
                    <div class="form-group form-md-line-input">
                       <select class="form-control value"  id="form_control_1">
                          @foreach(\App\SectorList::all() as $sector)
                            <option value="{{$sector->name}}">{{$sector->name}}</option>
                          @endforeach
                       </select>

                    </div>         	
         </form>
        </div>

    </div>
    </div>	
</div>