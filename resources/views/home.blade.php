@extends('layouts.app')

@section('content')
<div id="app"></div>

<script>
    // Global app data
const $Refdata = @json($refdata);
const $Clientdata = @json($clientdata);

</script>
 
  
<script src="{{ asset('js/app.js') }}"></script>
@endsection
