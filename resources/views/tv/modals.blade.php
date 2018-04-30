<!-- Modal -->
<div id="createWatchlist" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create Watchlist</h4>
      </div>
      <div class="modal-body">
          <form action="">

            <div class="form-group form-md-line-input">
                <label for="" class="label-control">Watchlist Name</label>
                <input class="form-control"  type="text"  placeholder="Enter watchlist name here" id="watchlistname" required="">
                <div class="form-control-focus"> </div> 
            </div>

          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="watchlistsubmit" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>
@push('scripts')
<script>
  $(document).ready(function () {
    
  $('#watchlistsubmit').click(function (e) {
    var name = $('#watchlistname').val();
     $('#watchlistname').val("");
     $.post('/watchlist/create', {name: name, _token: token}, function (data) {
        location.reload();
     })
  })
  })
</script>
@endpush


<!-- Modal -->
<div id="shareModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="modal-title">Download/Share Chart image</h4> <hr style="margin: 2px; margin-bottom: -10px">
            <div class="form-group form-md-line-input" style="margin-bottom: 0px">
                <label for="" class="label-control">Image url</label>
                <input class="form-control"  type="text" id="imageurl" required="">
                <div class="form-control-focus"> </div>
            </div>
                <div class="row">
                  
                <div class="col-md-12 margin-top-10 text-center">
                  
                <a href="#" target="_blank" id="imageshare" class="btn blue btn-sm"><i class="fa fa-facebook"></i> Share</a>
                <a href="#" target="_blank" id="imagedownload" class="btn green btn-sm"><i class="fa fa-download"></i>Download</a>
                <button class="btn green-jungle btn-sm btn-copy" data-clipboard-target="#imageurl"><i class="fa fa-copy"></i>Copy Link Url</button>
                <button class="btn red btn-sm" data-dismiss="modal">Cancel</button>
                </div> 
                </div>      

      </div>

    </div>

  </div>
</div>


<!-- Modal -->
<div id="renameModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="modal-title">Rename Watchlist</h4> <hr style="margin: 2px; margin-bottom: -10px">
            <div class="form-group form-md-line-input" style="margin-bottom: 0px">
                <label for="" class="label-control">Name</label>
                <input class="form-control"  type="text" id="watchlistName" required="">
                <input type="hidden" id="watchlistid" >
                <div class="form-control-focus"> </div>
            </div>
                <div class="row">
                  
                <div class="col-md-12 margin-top-10 text-center">
                  
                <button class="btn green-jungle btn-sm save-watchlist" data-dismiss="modal" ><i class="fa fa-save"></i>Save</button>
                <button class="btn red btn-sm" data-dismiss="modal">Cancel</button>
                </div> 
                </div>      

      </div>

    </div>

  </div>
</div>


<!-- Modal -->
<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="modal-title">Are you sure?</h4> <hr style="margin: 2px; margin-bottom: -10px">
            <div class="form-group form-md-line-input" style="margin-bottom: 0px">
                <input type="hidden" id="watchlistid" >
                <div class="form-control-focus"> </div>
            </div>
                <div class="row">
                  
                <div class="col-md-12 margin-top-10 text-center">
                  
                <button class="btn green-jungle btn-sm deletewatchlist" data-dismiss="modal" >Yes</button>
                <button class="btn red btn-sm" data-dismiss="modal">Cancel</button>
                </div> 
                </div>      

      </div>

    </div>

  </div>
</div>



<!-- Modal -->
<div id="watchlistsModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="modal-title">Select list to add</h4> <hr style="margin: 2px; margin-bottom: -10px">
            <div class="form-group form-md-line-input" style="margin-bottom: 0px">
                <input type="hidden" id="watchlistid" >
                <div class="form-control-focus"> </div>
            </div>
                <div class="row">
                  
                <div class="col-md-12 margin-top-10 text-center">
                  @if(\Auth::guest())
                  Please <a href="/login">login</a>
                  @else
                  <div class="col-md-12">
                    <form id="addToWatchlistForm">
                      
                        <div class="form-group col-md-12">
                            <div class="input-group" style="text-align: left;">
                                <div class="icheck-list">
                                  <input type="hidden" name="instrument_id", class="instrument">
                                  @foreach(request()->user()->watchlists as $watchlist)
                                    <label>
                                        <input name="watchlist[]" value="{{$watchlist->id}}" type="checkbox" class="icheck"> {{$watchlist->name}} </label>
                                  @endforeach
                                </div>
                            </div>
                        </div>
                    </form>
                  </div>
                  @endif
                  <br>
                <button class="btn green-jungle btn-sm addToWatchlistSubmit" data-dismiss="modal" >Add</button>
                <button class="btn red btn-sm" data-dismiss="modal">Cancel</button>
                </div> 
                </div>      

      </div>

    </div>

  </div>
</div>

