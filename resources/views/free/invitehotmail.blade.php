
@extends('partials.general-master')

@section('title') {{ trans('about.about-title') }} @endsection
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css"> -->

@section('content')
<?php
	include(base_path().'/public/config.php');
	
	$url = 'https://login.live.com/oauth20_authorize.srf?client_id='.$client_id.'&scope=wl.signin%20wl.basic%20wl.emails%20wl.contacts_emails&response_type=code&redirect_uri='.$redirect_uri;

?>
	<div class="aboutBanner">
		<h1>{{ trans('about.cayshly-online') }}</h1>
		<p>{{ trans('about.cayshly-trade') }}</p>
        <br>
        <a href="<?php print $url; ?>"  class="btn btn-green2">{{ trans('site.hotmail') }}</a>
	</div>
		<!-- Start Main About -->
		<div class="aboutBody">
			<!-- <div class="whiteDiv">
				<div class="w-res">
					<div class="aboutLeft">
						<h2>{{ trans('about.sell') }}</h2>
						<p>{{ trans('about.sell-any') }}</p>
						<p>{{ trans('about.sell-this') }}</p>
						<p>{{ trans('about.sell-you') }}</p>
					</div>
					<div class="aboutRight">
						<img src="{{ url('assets/images/main/sell.png') }}" />
					</div>
					<div class="clear"></div>
				</div>
			</div> -->

		<!-- 	<div class="grayDiv">
				<div class="w-res">
					<div class="aboutLeft">
						<img src="{{ url('assets/images/main/buy.png') }}">					
					</div>
					<div class="aboutRight">
						<h2>{{ trans('about.buy') }}</h2>
						<p>{{ trans('about.buy-if') }}</p>
						<p>{{ trans('about.buy-steps') }}<br>
						{{ trans('about.buy-steps1') }}<br>
						{{ trans('about.buy-steps2') }}</p>
						<p>{{ trans('about.buy-you') }}</p>
						<p>{{ trans('about.buy-cannot') }} : <b>orders@cayshly.com</b></p>
					</div>
					<div class="clear"></div>
				</div>
			</div> -->

	<!-- 		<div class="whiteDiv">
				<div class="w-res">
					<div class="aboutLeft">
						<h2>{{ trans('about.share-comment-review') }}</h2>
						<p>{{ trans('about.share-as') }}</p>
						<p>{{ trans('about.share-users') }}</p>
					</div>
					<div class="aboutRight">
						<img src="{{ url('assets/images/main/share.jpg') }}">
					</div>
					<div class="clear"></div>
				</div>
			</div> -->
<!-- 
			<div class="grayDiv">
				<div class="w-res">
					<div class="aboutLeft">
						<img src="{{ url('assets/images/main/ask.png') }}">					
					</div>
					<div class="aboutRight">
						<h2>{{ trans('about.ask-before') }}</h2>
						<p>{{ trans('about.as-a-user') }}</p>
					</div>
					<div class="clear"></div>
				</div>
			</div>
 -->
		<!-- 	<div class="centerDiv whiteDiv">
				<div class="w-res">
					<h2>{{ trans('about.gain-points') }}</h2>
					<p>{{ trans('about.the-moment') }}</p>
					<br>
					<a href="how-it-works" class="btn btn-red">{{ trans('sign.how-it-works') }}</a>
				</div>
			</div>
		</div>
		<div class="aboutBody whiteDiv">
			<div class="w-res">
				<p>{{ trans('about.any-reg') }}</p>
				<p>{{ trans('about.any-of') }}</p>
				<p><b>{{ trans('about.example') }}:</b><br>{{ trans('about.account-a-has') }}</p>
				
				<p>{{ trans('about.any-user-can') }}:<br>
				{{ trans('about.online-pur') }}<br>
				{{ trans('about.reimburse-the-points') }}</p>
				<img class="img" src="{{ url('assets/images/main/happy-people.jpg') }}">
			</div>
		</div> -->
@endsection
