@extends('partials.general-master')

@section('title') {{ trans('sign.reset-your-password') }} @endsection

@section('content')
	<div class="reset">
		<div class="w-res">
			<div class="box">{!! $msg !!}</div>
		</div>
	</div>
@endsection