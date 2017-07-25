@extends('partials.general-master')

@section('title') {{ trans('sign.Cayshly') }} @endsection

@section('content')

            <!-- Start Main Section -->
            <section>
                <div class="w-res">
                    <div class="left">
                        <div class="box ca-about-hints">
                            <h1>{{ trans('sign.welcome') }}</h1>
                            <ul>
                                <li><i class="fa fa-fw fa-check-square"></i> {{ trans('sign.hits-1') }}</li> 
                                <li><i class="fa fa-fw fa-check-square"></i> {{ trans('sign.hits-2') }}</li>
                                <li><i class="fa fa-fw fa-check-square"></i> {{ trans('sign.hits-3') }}</li>
                                <li><i class="fa fa-fw fa-check-square"></i> {{ trans('sign.hits-4') }}</li>
                            </ul>
                        </div>
                        <div class="ca-about-video">
                            <iframe width="100%" height="315" src="https://www.youtube.com/embed/s6OxquPP6LM" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="right">
                        {{-- Sign in from here --}}
                        <div class="box sign-in">
                            <h1>{{ trans('sign.login') }}</h1>
                          <!--   @if($errors->has('email'))
                                <p class="theError"><i class="fa fa-warning"></i> {{ $errors->first('email') }}</p>
                            @endif -->


                            @if($errors->any())
                                <p class="theError"><i class="fa fa-warning"></i> {{$errors->first()}}</p>
                            @endif   

                            {!! Form::open(['url'=>'auth/login/custom','method'=>'post','class'=>'form']) !!}
                            <input type="email" class="" name="email" required placeholder='{{ trans('sign.login-mail') }}'>                            
                            <input type="password" class="" name="password" required placeholder='{{ trans('sign.login-pass') }}'>
                            <input type="submit" class="btn btn-red" name="login" value='{{ trans('sign.login') }}'>
                            {!! Form::close() !!}

                            <div class="clear"></div>
                            {!! link_to('reset-password', $title = trans('sign.login-forget'), $attributes = array("class"=>"forget")) !!}
                        </div>

                        {{-- Sign up new account from here --}}
                        <div class="box sign-up">
                            <h1>{{ trans('sign.register-new') }}</h1>
                            {!! Form::open(['url'=>'auth/register/options','class'=>'form', 'method'=>'post']) !!}
                                <input type="text" name="fname" required <?= (old('fname')) ? 'value="' . old('fname') . '"': "" ;  ?> placeholder='{{ trans('sign.register-fname') }}'>
                                @if($errors->has('fname'))
                                    <p class="theError"><i class="fa fa-warning"></i> {{ $errors->first('fname') }}</p>
                                @endif

                                <input type="text" name="lname" required <?= (old('lname')) ? 'value="' . old('lname') . '"': "" ;  ?> placeholder='{{ trans('sign.register-lname') }}'>
                                @if($errors->has('lname'))
                                    <p class="theError"><i class="fa fa-warning"></i> {{ $errors->first('lname') }}</p>
                                @endif

                                <input type="email" class="" name="email" required <?= (old('email')) ? 'value="' . old('email') . '"': "" ;  ?> placeholder='{{ trans('sign.register-email') }}'>
                                @if($errors->has('email'))
                                    <p class="theError"><i class="fa fa-warning"></i> {{ $errors->first('email') }}</p>
                                @endif
                                
                                <input type="tel" class="" name="phone" required <?= (old('phone')) ? 'value="' . old('phone') . '"': "" ;  ?> placeholder='{{ trans('sign.register-phone') }}'>
                                @if($errors->has('phone'))
                                    <p class="theError"><i class="fa fa-warning"></i> {{ $errors->first('phone') }}</p>
                                @endif

                                <input type="password" class="" name="password" required placeholder='{{ trans('sign.register-pass') }}'>
                                @if($errors->has('password'))
                                    <p class="theError"><i class="fa fa-warning"></i> {{ $errors->first('password') }}</p>
                                @endif

                                <div style="position: relative;">
                                    <input type="email" style="width:92%;float:left;" name="parentEmail" placeholder='{{ trans('sign.register-parent-email') }}' @if(isset($_GET['parent'])) value="{{ $_GET['parent'] }}" @endif>
                                    <span class="tooltip" title="{{ trans('sign.register-parent-what') }}"><i class="help-ico fa fa-fw fa-question-circle"></i></span>
                                    {{-- <p style="width:45%;float:right;" class="btn btn-green">{{ trans('sign.register-generate') }}</p> --}}
                                    <div class="clear"></div>
                                </div> 
                                
                                <div style="margin: 0px 0px 10px 0px;overflow:hidden;">                                
                                    <div class="fl-left">
                                        <label>{{ trans('sign.register-gender') }} : </label>
                                    </div>
                                    <div class="fl-right">
                                        {{ trans('sign.register-gender-male') }} <input type="radio" name="gender" value="male">
                                        {{ trans('sign.register-gender-female') }} <input type="radio" name="gender" value="female">
                                    </div>
                                </div>
                                @if($errors->has('gender'))
                                    <p class="theError"><i class="fa fa-warning"></i> {{ $errors->first('gender') }}</p>
                                @endif

                                <div style="overflow:hidden;">
                                    <div class="fl-left">
                                        <label>{{ trans('sign.DOB') }} :</label>
                                    </div>
                                    <div class="fl-right">
                                        <select name="day">
                                            <option disabled selected>{{ trans('sign.register-day') }}</option>
                                            @for($i=0; $i<=31; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>

                                        <select name="month">
                                            <option disabled selected>{{ trans('sign.register-month') }}</option>
                                            @for($i=0; $i<=12; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>

                                        <select name="year">
                                            <option disabled selected>{{ trans('sign.register-year') }}</option>
                                            @for($i=1920; $i<=date('Y'); $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>                                    
                                </div> 
                                @if($errors->has('day') or $errors->has('month') or $errors->has('year'))
                                    <p class="theError"><i class="fa fa-warning"></i> {{ $errors->first('day') }}</p>
                                @endif

                                <input type="submit" class="btn btn-red" value="{{ trans('sign.register') }}"> 
                                <div class="clear"></div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </section>

@endsection

