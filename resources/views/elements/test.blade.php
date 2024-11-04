@extends('layouts.app')
@section('title', 'Piloto Cargues - Cargues')

@section('content')
<button id="start_reader">Start QR Code scanner</button>

<form id="update_form">
  <div id="reader"></div>
  <input id="barcode_search" />
  <button id="barcode_submit">Submit</button>
  <div id="product_info">Some product info</div>
</form>

@endsection
