<!-- Modal -->
<div id="createWatchlist" class="modal fade" role="dialog">
  <div class="modal-dialog">

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