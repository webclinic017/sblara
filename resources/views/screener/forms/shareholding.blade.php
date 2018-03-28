<div id="SHAREHOLDING">
    <div class="alert alert-warningdf alert-dismissable" data-func="SHAREHOLDING" >
        <div class="row">
        <div class="col-md-12">

         <label class="col-md-4 control-label" for="form_control_1">SHAREHOLDING </label>
                <form class="form-inline" role="form">

                    <div class="form-group form-md-line-input">
                       <select class="form-control " data-param="1" id="form_control_1">
                           <option value="DIRECTOR">Director</option>
                           <option value="GOVT">Govt</option>
                           <option value="INSTITUTE">Institute</option>
                           <option value="FOREIGN">Foreign</option>
                           <option value="PUBLIC">Public</option>
                       </select>
                    </div>

                    <div class="form-group form-md-line-input">
                       <select class="form-control " data-param="2" id="form_control_1">
                         {!! yearsAsOption(2016) !!}
                       </select>
                    </div>

                    <div class="form-group form-md-line-input">
                       <select class="form-control " data-param="3" id="form_control_1">
							<option value="JAN">Januaray</option>
							<option value="FEB">February</option>
							<option value="MAR">March</option>
							<option value="APR">April</option>
							<option value="MAY">May</option>
							<option value="JUN">June</option>
							<option value="JUL">July</option>
							<option value="AUG">August</option>
							<option value="SEP">September</option>
							<option value="OCT">October</option>
							<option value="NOV">November</option>
							<option value="DEC">December</option>
                       </select>
                    </div>

                </form>
        </div>
    </div>
    </div>	
</div>