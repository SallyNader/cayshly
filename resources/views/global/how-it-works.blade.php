@extends('partials.general-master')

@section('title') How it works @endsection

@section('content')
	<div class="w-res">
		<?php $session = (session()->get('lang'))? session()->get('lang') : 'en'; ?>
		<img width="100%" src="{{ url('assets/images/main/how-it-works-') }}{{ $session }}.jpg" alt="How it works" />	
	</div>	
@endsection