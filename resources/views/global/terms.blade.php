@extends('partials.general-master')

@section('title') Terms @endsection

@section('content')
	@if(auth()->check())
		<h1>Authenticated</h1>
	@else
		<h1>Not Authenticated</h1>
	@endif	
@endsection