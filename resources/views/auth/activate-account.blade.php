@extends('partials.general-master')

@section('title') {{ trans('sign.sign-title') }} @endsection

@section('content')

            <!-- Start Main Section -->
            <section>
                <div class="w-res">
                    <div class="center">
                        <div class="box sign-up">
                            <h1>{{ trans('sign.Congratulations') }} {{ $user->name }}</h1>
                            <p><i class="fa fa-fw fa-check"></i> {{ trans('sign.youraccountactivated') }}</p>

                            <a href="{{ url('auth/signin') }}" class="btn btn-red-o fl-right">{{ trans('sign.Login') }}</a>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </section>

@endsection

