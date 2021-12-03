<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>awdwd</title>
</head>
<body>

	<h1>Halo, aku {{$name}}</h1>

	@if($name == "") tidak perlu kurawal walaupun banyak
		<h1>Halo, kamu siapa?</h1>
	@elseif($name != "")
		<h1>Halo, aku {{$name}}</h1>
	@else
	@endif

	@switch($name)
		@case("Jong Koding")
			<h1>Halo, aku {{$name}}</h1>
			@break
		@case("")
			<h1>Halo, aku gda namah</h1>
			@break
		@default
			<h1>Halo, aku bukan siapa2</h1>
			@continue
	@endswitch

<!-- for, foreach, forelse, while -->
<!-- loop->first dkk, ini kyknya var global(?) -->

	
	@php
	$isActive = false;
	$hasError = true;
	@endphp
	

	<!-- idk if its work -->
	<span @class([
		'p-4', 'font-bold' => $isActive,
		'text-gray-500' => ! $isActive,
		'bg-red' => $hasError,
	])>ssss</span>
	<span class="p-4 text-gray-500 bg-red">awwwww</span>


	<!-- include view dan mengirimkan tambahan var lain ke view yg di-include -->
	{{-- @include('directives.loop') --}}
	{{-- @include('directives.conditional', ['name' => 'JongKreatif']) --}}

	<!-- kalo ada ya ditampilkan, gda ya skip -->
	{{-- @infludeIf('directives.conditional') --}}

	{{-- include dengan ekspresi boolean --}}
	{{-- @includeWhen($boolean, 'directives.conditional') --}}
	{{-- @includeWhen($boolean, 'directives.conditional') --}}

	<!-- masih kurang paham,  -->
	{{-- @includeFirst(['namaview', 'variable'], ['data' => 'additional']) 	--}}<!-- kayaknya data additional parameter deh -->

	<!-- untuk menjalankan php biasa make ini -->
	@php
	$count = 1;
	@endphp

	<!-- @csrf harus dimasukkan ketika membuat form cari docs / sumber lain -->
	<!-- beda, sekalian cari @method('PUT') -->

	<label for="name">Name</label>
	<input type="text" name="name" id="name" class="@error('name') is-invalid @enderror">

	{{-- @error
	<div class="alert alert-danger">{{ $message }}</div> <!-- ntah kenapa error -->
	@enderror --}}

</body>
</html>