@extends('partials.main-master')

@section('title') {{ trans('site.GrowMyNetwork') }} @endsection

@section('content')


<?php
	include(base_path().'/public/config.php');
	
	$url = 'https://login.live.com/oauth20_authorize.srf?client_id='.$client_id.'&scope=wl.signin%20wl.basic%20wl.emails%20wl.contacts_emails&response_type=code&redirect_uri='.$redirect_uri;

?>


	<!-- Start Sections Contenets Here +++++++++++ -->
	<div class="all-sections">
		<div class="w-res">
			<h1 class="txt-g-h"><i class="fa fa-fw fa-bar-chart"></i> {{ trans('site.GrowMyNetwork') }}:</h1>
			<div class="points-p">
				<form class="form" action="{{ url('invite') }}" method="post" accept-charset="utf-8">
					{{ csrf_field() }}
					<input type="email" name="femail" placeholder="Put your friend email .." style="margin-bottom: 10px;">
					<button class="btn-invite" type="submit">{{ trans('site.send-invite') }} <i class="fa fa-fw fa-angle-right"></i></button>
					<div class="clear"></div>
				</form>
			</div>

			<br><br>
			<h1 class="txt-g-h"><i class="fa fa-fw fa-bar-chart"></i> {{ trans('site.send-invite-network') }}:</h1>
			<div class="points-p">
				<div class="the-invite-image">
					<img src="{{ url('assets/images/3party/google.png') }}" alt="google">
					<a  href="{{url('contact/import/google')}}" class="btn-invite">{{ trans('site.send-invite') }} <i class="fa fa-fw fa-angle-right"></i></a>
				</div>

				<div class="the-invite-image">
					<img src="{{ url('assets/images/3party/outlook.png') }}" alt="outlook">
					<a href="<?php print $url; ?>" class="btn-invite">{{ trans('site.send-invite') }} <i class="fa fa-fw fa-angle-right"></i></a>
				</div>

				<div class="the-invite-image">
					<img src="{{ url('assets/images/3party/facebook.png') }}" alt="facebook">
					{{-- <a href="#" class="btn-invite" onclick="event.preventDefault();document.getElementById('#facebook-invite').submit();">{{ trans('site.send-invite') }} <i class="fa fa-fw fa-angle-right"></i></a> --}}
					<div id="fb-root"></div>
						<script>
						(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1863409053915439";
						  fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));</script>
							<div class="fb-send" data-href="http://cayshly.com/?parent={{$parentMail}}" data-layout="button_count">
				  </div>
				</div>

				<div class="the-invite-image">
					<img src="{{ url('assets/images/3party/twitter.png') }}" alt="twitter">
					<a  href="{{url('invite-twitter')}}" class="btn-invite">{{ trans('site.send-invite') }} <i class="fa fa-fw fa-angle-right"></i></a>
				</div>

				<div class="the-invite-image">
					<img src="{{ url('assets/images/3party/linkedin.png') }}" alt="linkedin">
					<a  href="#" class="btn-disabled">{{ trans('site.sooon') }} <i class="fa fa-fw fa-angle-right"></i></a>
				</div>

				<div class="the-invite-image">
					<img src="{{ url('assets/images/3party/yahoo.png') }}" alt="yahoo">
					<a  href="#" class="btn-disabled">{{ trans('site.sooon') }} <i class="fa fa-fw fa-angle-right"></i></a>
				</div>

				<div class="clear"></div>
			</div>

		</div>
	</div>
	<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
