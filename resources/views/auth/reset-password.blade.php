@extends('partials.general-master')

@section('title') {{ trans('sign.reset-your-password') }} @endsection

@section('content')
	<div class="reset">
		<div class="w-res">
			<div class="box">
                <h2>{{ trans('sign.reset-enter') }}</h2>
                <p>{{ trans('sign.reset-we-will') }}</p>
                {!! Form::open(['url'=>'#','class'=>'form']) !!}
	                <input type="email" name="email" required placeholder='{{ trans('sign.reset-email') }}'>                            
	                <input type="submit" class="btn btn-red" name="login" value='{{ trans('sign.reset-send-link') }}'>
	                <div class="clear"></div>                              
                {!! Form::close() !!}
            </div>
		</div>
	</div>
@endsection