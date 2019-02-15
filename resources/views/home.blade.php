@extends('layouts.app')

@section('content')
<div id="app"></div>

<script>
    // Global app data
const $Refdata = @json($refdata);
const $Clientdata = @json($clientdata);
const $Barcodes = @json($barcodes);

</script>
 
@if(!empty($role)) 
    <script src="{{ asset('js/'. $role . '_app.js') }}"></script>
@endif


@endsection
