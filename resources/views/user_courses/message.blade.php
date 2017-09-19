<div class="message">
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul id='errors'>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif
  @if(isset($message_success))
    <div class="alert alert-success">
      {{ $message_success }}
    </div>
  @endif
  @if (Session::has('message_success'))
   <div class="alert alert-success">{{ Session::get('message_success') }}</div>
  @endif
</div>
