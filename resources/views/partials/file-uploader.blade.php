  <div class="form-group">
       <div class="input-group">
         <span class="input-group-btn">
           <a  data-input="{{$name}}" data-preview="{{$name}}_holder" data-type="{{$type?:'file'}}" class="btn btn-primary file-uploader">
             <i class="fa fa-upload"></i> Choose
           </a>
         </span>
         <input id="{{$name}}" class="form-control" type="hidden" name="{{$name}}">
       </div>
       <img id="{{$name}}_holder" style="margin-top:15px;max-height:100px;">
  </div>