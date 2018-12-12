@extends('layouts.app')

@section('content')
<div id="app"></div>

<script>
    // Global app data
const $Refdata = @json($refdata);
const $Clientdata = @json($clientdata);
const $Barcodes = @json($barcodes);

</script>
 
  
<script src="{{ asset('js/app.js') }}"></script>
@endsection
