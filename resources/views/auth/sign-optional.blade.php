@extends('partials.general-master')

@section('title') {{ trans('sign.sign-title') }} @endsection

@section('content')

            <!-- Start Main Section -->
            <section>
                <div class="w-res">
                    <div class="center">
                        <div class="box sign-up">
                            <h1>{{ trans('sign.MoreInformation') }}</h1>
                            {!! Form::open(['url'=>'auth/register/options/complete','class'=>'form', 'method'=>'post']) !!}
                                <select class="w100" name="country">
                                    <option disabled selected>{{ trans('sign.register-country') }}</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->countryId }}">{{ $country->countryNameEn }}</option>
                                    @endforeach
                                </select>
								<select class="w100" name="city">
                                    <option disabled selected>{{ trans('sign.register-city') }}</option>
                                    @foreach($cities as $city)
                                        <option data-country="{{ $city->cityCountryId }}" value="{{ $city->cityId }}">{{ $city->cityNameEn }}</option>
                                    @endforeach
                                </select> 
								<select class="w100" name="area">
                                    <option disabled selected>{{ trans('sign.register-area') }}</option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->areaId }}">{{ $area->areaNameEn }}</option>
                                    @endforeach
                                </select>

                                <select multiple="multiple" class="w100 chzns-i" name="interestes[]">
                                    <option disabled>{{ trans('sign.register-interestes') }}</option>
                                    @foreach($interestes as $interest)
                                        <option value="{{ $interest->intId }}">{{ $interest->intNameEn }}</option>
                                    @endforeach
                                </select>

								<select multiple="multiple" class="w100 chzns-h" name="hobbies[]">
                                    <option disabled>{{ trans('sign.register-hobbies') }}</option>
                                    @foreach($hobbies as $hobby)
                                        <option value="{{ $hobby->hobId }}">{{ $hobby->hobNameEn }}</option>
                                    @endforeach
                                </select>

								<div class="skipPOP">
									<div class="back">
										<div class="bon">
											<h1><i class="fa fa-fw fa-warning"></i> {{ trans('sign.Important') }}</h1>
											<p>{{ trans('sign.Providingmoreinformation') }}</p>
                                            <input type="hidden" name="em" value='{{ $email }}'>
											<input type="submit" class="btn btn-green" value='{{ trans('sign.register') }}'>
											<a id="skip-close" class="btn btn-red-o fl-right" name="skip">{{ trans('sign.register-skip-com') }}</a>
											<div class="clear"></div>
										</div>
									</div>									
								</div>

                                <input type="submit" class="btn btn-red" value='{{ trans('sign.register') }}'>
                                <a id="skip" class="btn btn-red-o fl-right" name="skip">{{ trans('sign.register-skip') }}</a>
                                <div class="clear"></div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </section>

@endsection

