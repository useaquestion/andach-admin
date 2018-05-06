@extends('template')

@section('content')
<h1>Products</h1>
<div class="alert alert-info">?</div>

<div class="row">
	<div class="col-3">Name</div>
	<div class="col-9">Company</div>
</div>

@foreach ($products as $product)
	<div class="row">
		<div class="col-3">{{ $product->name }}</div>
		<div class="col-9"></div>
	</div>
@endforeach

@endsection