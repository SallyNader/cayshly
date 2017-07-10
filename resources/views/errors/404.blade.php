@extends('partials.general-master')

@section('title') {{ trans('site.Error') }} @endsection

@section('content')
	<div class="w-res">
		<div style="text-align: center;padding:10% 0px;">
			<img style="width: 150px;" src="{{ url('assets/images/main/404.png') }}" alt="Error ..!">
			<h1>{{ trans('site.Sorry,thispage') }}</h1>
			<p>{{ trans('site.Thislinkmaybe') }}</p>
		</div>
	</div>	
@endsection