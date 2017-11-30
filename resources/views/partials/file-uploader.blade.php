<div class="form-group">
   <div class="input-group">
     <span class="input-group-btn">
       <a  data-input="{{$name}}" data-id='0'  data-type="{{$type?:'file'}}" class="btn btn-primary file-uploader">
         <i class="fa fa-upload"></i> Choose
       </a>
     </span>
     <input id="{{$name}}_0" class="form-control" type="text" name="{{$name}}[]" readonly >
   </div>
</div>