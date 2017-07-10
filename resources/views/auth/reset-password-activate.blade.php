@extends('partials.general-master')

@section('title') {{ trans('sign.reset-your-password-activate') }} @endsection

@section('content')
	<div class="reset">
		<div class="w-res">
			<div class="box">
                <h2>{{ trans('sign.reset-enter-new-password') }}</h2>
                <p>{{ trans('sign.reset-we-will-activate') }}</p>
                {!! Form::open(['url'=>'reset-password-activate/done','class'=>'form', 'method'=>'post']) !!}
	                <input type="password" name="newPassword" required placeholder='{{ trans('sign.reset-new-password') }}'>                            
	                <input type="password" name="rePassword" required placeholder='{{ trans('sign.reset-new-password-re') }}'>                            
	                <input type="hidden" name="uei57" value="{{ $userEncryptedId }}">                            
	                <input type="hidden" name="uee63" value="{{ $userEncryptedEmail }}">                            
	                <input type="submit" class="btn btn-red" name="login" value='{{ trans('sign.reset-reset') }}'>  
	                <div class="clear"></div>                              
                {!! Form::close() !!}
            </div>
		</div>
	</div>
@endsection