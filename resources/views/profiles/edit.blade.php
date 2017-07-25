@extends('partials.main-master')

@section('title') {{ trans('site.Update') }} | {{ $name . " " . $lastName}} @endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->
<style type="text/css">
	.user-info p input[type="text"],.user-info p textarea{
		display:none;
	}
	.user-info p label{
		display:inline-block;
		color: #2980b9;
		padding: 4px;
	}
</style>
<div class="all-sections">
	<div class="w-res">
		<div class="profile-p-e">
			<!-- Update User Profile and Cover -->
			<div class="profile-p-l-user append">
					<div class="profile-p-l-user-i">
						@if(Auth::user()->id == $id)
							<div class="opimgs">
								{!! Form::open(['url'=>'profile/'. $id .'/upcvr','files'=>'true','method'=>'put', 'id'=>'ajaxForm']) !!}
									<label class="upfile" for="upcvr"><i class="fa fa-fw fa-camera"></i> {{ trans('site.Update') }} <input type="file" id="upcvr" name="upcvr"/></label>
								{!! Form::close() !!}
							</div>
						@endif
						<!-- User Cover -->
						<img class="theUpImg onModal" src="{{ url('assets/images/prcovers/' . $cover ) }}" />
					</div>

					<!-- User Image -->
					<div class="profile-p-l-user-pic appends">
						@if(Auth::user()->id == $id)
							<div class="opimgs">
								{!! Form::open(['url'=>'profile/'. $id .'/upimg','files'=>'true','method'=>'put', 'id'=>'ajaxForms']) !!}
									<label class="upfile" for="upimg"><i class="fa fa-fw fa-camera"></i> <input type="file" id="upimg" class="" name="upimg"/></label>
								{!! Form::close() !!}
							</div>
						@endif
						<img class="theUpImgs onModal" src="{{ url('assets/images/profiles/' . $img ) }}" />
					</div>

					<div class="profile-p-l-user-d">
						<a class="name">{{ $name . " " . $lastName}}</a>
						<!--<a class="btn btn-main" href="#">Send Message</a>-->
					</div>
				</div>

			<!-- Update User Info -->
			{!! Form::open(['url'=>'profile/' . Auth::user()->id . '/edit', 'method'=>'post']) !!}

			<div class="profile-p-e-user-info">
							
							<div class="progress box" style="border-top:2px solid #4CAF50;">
<div style="color: #333;font-size: 14px;padding:5px 0px;text-align: center;">{{trans('site.progress')}}</div>
                <div style="color: #000;background-color: #f1f1f1;border-radius: 10px;overflow: hidden;">
                                <div style="color: #fff;background-color: #2196F3;padding:2px 5px;text-align: center;width:{{$percent}}%;">{{$percent}}%</div>
</div>
</div>

				<div class="box">
					<!-- Location -->
					<div class="profile-p-l-user-info-item">
						<h1><i class="fa fa-fw fa-map-marker"></i> {{ trans('site.UpdateYourEmail') }}</h1>
						<div class="user-info">
							<p><b>{{ trans('site.CurrentEmail') }} : </b>
								<label>{{ $email }}</label>
							</p>
							<p><b>{{ trans('site.NewEmail') }} : </b>
								<input type="text" name="email" />
								<span class="edit-ico">{{ trans('site.Edit') }}</span>

							</p>
						</div>
					</div>
				</div>











				<div class="box">
					<!-- About Me -->
					<div class="profile-p-l-user-info-item">
						<h1><i class="fa fa-fw fa-flag"></i> {{ trans('site.AboutMe') }}</h1>
						<div class="user-info">
							<p><b>{{ trans('site.Bio') }} : </b>
								<label>{{ $about }}</label>
								<textarea name="about" class="scrolled">{{ $about }}</textarea>
								<span class="edit-ico">{{ trans('site.Edit') }}</span>
							</p>
						</div>
					</div>
				</div>

				<div class="box">
					<!-- Basic Informations -->
					<div class="profile-p-l-user-info-item">
						<h1><i class="fa fa-fw fa-bookmark"></i> {{ trans('site.BasicInformations') }}</h1>
						<div class="user-info">
							<p><b>{{ trans('site.FirstName') }} : </b>
								<label>{{ $name }}</label>
								<input type="text" name="name" value="{{ $name }}"/>
								<span class="edit-ico">{{ trans('site.Edit') }}</span>
								<input type="submit" class="done-ico" value="{{ trans('site.Done') }}" />
							</p>
							<p><b> {{ trans('site.LastName') }} : </b>
								<label>{{ $lastName }}</label>
								<input type="text" name="lastName" value="{{ $lastName }}"/>
								<span class="edit-ico">{{ trans('site.Edit') }}</span>

							</p>
							<p><b>{{ trans('site.Gender') }} : </b>
								<label>{{ $gender }}</label>
								<input type="text" name="gender" value="{{ $gender }}"/>
								<span class="edit-ico">{{ trans('site.Edit') }}</span>

							</p>
							<p><b>{{ trans('site.Address') }} : </b>
								<label>{{ Auth::user()->address }}</label>
								<input type="text" name="address" value="{{ Auth::user()->address }}"/>
								<span class="edit-ico">{{ trans('site.Edit') }}</span>
							</p>
							<p><b>{{ trans('site.DateofBirth') }} : </b>
								<label>{{ $dateOfBirth }}</label>
								<input type="text" name="dateOfBirth" value="{{ $dateOfBirth }}"/>
								<span class="edit-ico">{{ trans('site.Edit') }}</span>

							</p>
							<p><b>{{ trans('site.Nationality') }} : </b>
								<label>{{ $nationality }}</label>
								<input type="text" name="nationality" value="{{ $nationality }}"/>
								<span class="edit-ico">{{ trans('site.Edit') }}</span>

							</p>
						</div>
					</div>
				</div>

				<div class="box">
					<!-- Work and Edu -->
					<div class="profile-p-l-user-info-item">
						<h1><i class="fa fa-fw fa-graduation-cap"></i> {{ trans('site.WorkandEducation') }}</h1>
						<div class="user-info">
							<p><b>{{ trans('site.School') }} : </b>
								<label>{{ $school }}</label>
								<input type="text" name="school" value="{{ $school }}"/>
								<span class="edit-ico">{{ trans('site.Edit') }}</span>

							</p>
							<p><b>{{ trans('site.University') }} : </b>
								<label>{{ $university }}</label>
								<input type="text" name="university" value="{{ $university }}"/>
								<span class="edit-ico">{{ trans('site.Edit') }}</span>

							</p>
							<p><b>{{ trans('site.JobTitle') }} : </b>
								<label>{{ $jobTitle }}</label>
								<input type="text" name="jobTitle" value="{{ $jobTitle }}"/>
								<span class="edit-ico">{{ trans('site.Edit') }}</span>

							</p>
							<p><b>{{ trans('site.Company') }} : </b>
								<label>{{ $company }}</label>
								<input type="text" name="company" value="{{ $company }}"/>
								<span class="edit-ico">{{ trans('site.Edit') }}</span>

							</p>
							<p><b>{{ trans('site.Education') }} : </b>
								<label>{{ $education }}</label>
								<input type="text" name="education" value="{{ $education }}"/>
								<span class="edit-ico">{{ trans('site.Edit') }}</span>

							</p>
						</div>
					</div>
				</div>

				<div class="box">
					<!-- Location -->
					<div class="profile-p-l-user-info-item">
						<h1><i class="fa fa-fw fa-map-marker"></i> {{ trans('site.Location') }}</h1>
						<div class="user-info">
							<p><b>{{ trans('site.Country') }} : </b>
								<select class="sh" name="country">
                                    @foreach($countries as $country)
                                    	@if($country->countryId == $ucountry)
                                        	<option selected value="{{ $country->countryId }}">{{ $country->countryNameEn }}</option>
                                        @else
                                        	<option value="{{ $country->countryId }}">{{ $country->countryNameEn }}</option>
                                        @endif
                                    @endforeach
                                </select>
							</p>
							<p><b>{{ trans('site.City') }} : </b>
								<select class="sh" name="city">
                                    @foreach($cities as $city)
                                    	@if($city->cityId == $ucity)
                                        	<option selected data-country="{{ $city->cityCountryId }}" value="{{ $city->cityId }}">{{ $city->cityNameEn }}</option>
                                        @else
                                        	<option data-country="{{ $city->cityCountryId }}" value="{{ $city->cityId }}">{{ $city->cityNameEn }}</option>
                                        @endif
                                    @endforeach
                                </select>
							</p>
							<p><b>{{ trans('site.Area') }} : </b>
								<select class="sh" name="area">
                                    @foreach($areas as $area)
                                    	@if($area->areaId == $uarea)
                                        	<option selected value="{{ $area->areaId }}">{{ $area->areaNameEn }}</option>
                                        @else
                                        	<option value="{{ $area->areaId }}">{{ $area->areaNameEn }}</option>
                                        @endif
                                    @endforeach
                                </select>
							</p>
						</div>
					</div>
				</div>

				<div class="box">
					<!-- Contact Information -->
					<div class="profile-p-l-user-info-item">
						<h1><i class="fa fa-fw fa-envelope"></i> {{ trans('site.ContactInformation') }}</h1>
						<div class="user-info">
							<p><b>{{ trans('site.Phone') }} : </b>
								<label>{{ $phone }}</label>
								<input type="text" name="phone" value="{{ $phone }}"/>
								<span class="edit-ico">{{ trans('site.Edit') }}</span>
							</p>
							<p><b>{{ trans('site.Facebook') }} : </b>
								<label>{{ $facebook }}</label>
								<input type="text" name="facebook" value="{{ $facebook }}"/>
								<span class="edit-ico">{{ trans('site.Edit') }}</span>
							</p>
							<p><b>{{ trans('site.LinkedIn') }} : </b>
								<label>{{ $linkedIn }}</label>
								<input type="text" name="linkedIn" value="{{ $linkedIn }}"/>
								<span class="edit-ico">{{ trans('site.Edit') }}</span>
							</p>
							<p><b>{{ trans('site.Instegram') }} : </b>
								<label>{{ $instagram }}</label>
								<input type="text" name="instagram" value="{{ $instagram }}"/>
								<span class="edit-ico">{{ trans('site.Edit') }}</span>
							</p>
						</div>
					</div>
				</div>

				<div class="box">
					<!-- Hobbies -->
					<div class="profile-p-l-user-info-item">
						<h1><i class="fa fa-fw fa-motorcycle"></i> {{ trans('site.Hobbies') }}</h1>
						<div class="user-info">
							<p><b>{{ trans('site.Hobbies') }} : </b>
							<label>
								<?php $saryh = array();$sari = array(); ?>
								@foreach($hobbies as $hobby)
	                            	@foreach($uhobbies as $uhobby)
										@if($hobby->hobId == $uhobby->uHobHobId)
										{{ $hobby->hobNameEn }},
										<?php $saryh[] = $hobby->hobNameEn; ?>
		                                @endif
	                            	@endforeach
	                            @endforeach
	                         </label>
							</p>
						</div>
						<select multiple="multiple" style="width:100% !important;" class="sh chzns-h" name="hobbies[]">
                            @foreach($hobbies as $hobby)
                            	<option value="{{ $hobby->hobId }}"><?php if(in_array($hobby->hobNameEn, $saryh)){ echo "&#10004;" ;} ?> {{ $hobby->hobNameEn }}</option>
                            @endforeach
                        </select>
					</div>
				</div>

				<div class="box">
					<!-- Interests -->
					<div class="profile-p-l-user-info-item">
						<h1><i class="fa fa-fw fa-book"></i> {{ trans('site.Interests') }}</h1>
						<div class="user-info">
							<p><b>{{ trans('site.Interests') }} : </b>
							<label>
								@foreach($interestes as $interest)
	                            	@foreach($uinterestes as $uinterest)
										@if($interest->intId === $uinterest->uIntIntId)
											{{ $interest->intNameEn }},
											<?php $sari[] = $interest->intNameEn; ?>
										@endif
	                            	@endforeach
	                            @endforeach
	                        </label>
							</p>
						</div>
						<select multiple="multiple" style="width:100% !important;" class="sh chzns-i" name="interestes[]">
	                        @foreach($interestes as $interest)
                            	<option value="{{ $interest->intId }}"><?php if(in_array($interest->intNameEn, $sari)){ echo "&#10004;" ;} ?> {{ $interest->intNameEn }}</option>
                            @endforeach
	                    </select>
					</div>
				</div>
			</div>

			<input type="submit" class="btn btn-main" value="Done" />
			<div class="clear"></div>
			{!! Form::close() !!}
		</div>
		<div class="profile-p-e-ads">
			<!-- Ads Area -->
			<div class="ad-s-1 adMN">
				<a href="#"><img class="w100" src="{{ url('assets/images/ads/Ls.jpg') }}"></a>
			</div>
			<div class="ad-s-1 adMN">
				<a href="#"><img class="w100" src="{{ url('assets/images/ads/swb.gif') }}"></a>
			</div>
		</div>

		<div class="clear"></div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
