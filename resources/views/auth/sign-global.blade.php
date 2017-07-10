@extends('partials.general-master')

@section('title') {{ trans('sign.sign-title') }} @endsection

@section('content')

<!-- Start Main Section -->
<section>
    <div class="w-res">
        <div style="position: relative;margin: auto;margin-top: 10%;width: 500px;">
            {{-- Sign in from here --}}
            <div class="box sign-in">
                {!! (isset($msg))? $msg : '' !!}
                <h1>{{ trans('sign.login') }}</h1>
                {!! Form::open(['url'=>'auth/login','method'=>'post','class'=>'form']) !!}
                <input type="email" class="" name="email" required placeholder='{{ trans('sign.login-mail') }}'>                            
                <input type="password" class="" name="password" required placeholder='{{ trans('sign.login-pass') }}'>
                <input type="submit" class="btn btn-red" name="login" value='{{ trans('sign.login') }}'>                                
                {!! Form::close() !!}
                <div class="clear"></div>
                {!! link_to('reset-password', $title = trans('sign.login-forget'), $attributes = array("class"=>"forget")) !!}
            </div>
        </div>
    </div>
    <div class="clear"></div>
</section>

@endsection

