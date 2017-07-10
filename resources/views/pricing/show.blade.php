@extends('partials.main-master')

@section('title') {{ trans('site.Pricing') }} @endsection

@section('adsense')
<!--Google Adsense-->

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-6152866399790785",
    enable_page_level_ads: true
  });
</script>
@endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->

<div class="all-sections">
	<div class="w-res">
		<div class="pricing-hero">
			<h1>{{ trans('site.PricingGuide') }}</h1>
			<p>{{ trans('site.Cayshlyisfreetouseforas') }}</p>
		</div>
	</div>
	<?php $arrs = ['#E6190E','#6A4CA6','#3499E0','#F9B644']?>
	<div class="pricing-main">
		<div class="w-res">
			<div class="pricing-cont">
				<!-- Free -->
				<div class="pricing-box-cont">
					<div style="background-color:#E6190E;" class="pricing-box">
						<div class="pricing-pack-name">Free</div>
						<div class="pricing-pack-price">00 <span>LE/Month</span></div>
						<div class="pricing-pack-price">00 <span>LE/Year</span></div>
						<div class="pricing-pack-details">
							Cayshly Free package
						</div>
					</div>

					<div class="pricing-list">
						<h2>Free package details:</h2>
						<ul>
							<li>Online Store	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Shopping Cart	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Delivery	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							<li>Collection 	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							<li>Logo - Profile Picture	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							<li>Cover Photo 	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							<li>Loyalty Program	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							<li>Designs	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							<li>Monthly Email Shot	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							<li>Store Management	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							<li>Corporate Identity	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							<li>FaceBook Page Management <span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							<li>FaceBook Campaign	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							{{-- <li>Google Search Campaign 	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							<li>Google Display Campaign	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li> --}}
						</ul>
					</div>

					<div style="background-color:#E6190E;" class="pricing-dis">
						<div class="pricing-dis-details">Discount: 00</div>
						<div class="pricing-dis-details">Payment: 00</div>
					</div>					

					<a href="{{ url('pricing/go/free') }}" style="background-color:#E6190E;" class="pricing-ref">Go Free</a>
				</div>

				<!-- Silver -->
				<div class="pricing-box-cont">
					<div style="background-color:#9FA8AF;" class="pricing-box">
						<div class="pricing-pack-name">Silver</div>
						<div class="pricing-pack-price">100 <span>LE/Month</span></div>
						<div class="pricing-pack-price">1200 <span>LE/Year</span></div>
						<div class="pricing-pack-details">
							Cayshly Silver package
						</div>
					</div>

					<div class="pricing-list">
						<h2>Silver package details:</h2>
						<ul>
							<li>Online Store	<span class="fl-right gr-txt gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Shopping Cart	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Delivery	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Collection 	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Logo - Profile Picture	<span class="fl-right gr-txt">1</span></li>
							<li>Cover Photo 	<span class="fl-right gr-txt">1</span></li>
							<li>Loyalty Program	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Designs	<span class="fl-right gr-txt">2 / Month</span></li>
							<li>Monthly Email Shot	<span class="fl-right gr-txt">10000</span></li>
							<li>Store Management	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Corporate Identity	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							<li>FaceBook Page Management <span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							<li>FaceBook Campaign	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							{{-- <li>Google Search Campaign 	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							<li>Google Display Campaign	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li> --}}
						</ul>
					</div>

					<div style="background-color:#9FA8AF;" class="pricing-dis">
						<div class="pricing-dis-details">Discount: 20%</div>
						<div class="pricing-dis-details">Payment: * 1000 LE Yearly</div>
					</div>					

					<a href="{{ url('pricing/go/silver') }}" style="background-color:#9FA8AF;" class="pricing-ref">Go Silver</a>
				</div>

				<!-- Golden -->
				<div class="pricing-box-cont">
					<div style="background-color:#FFBF00;" class="pricing-box">
						<div class="pricing-pack-name">Golden</div>
						<div class="pricing-pack-price">250 <span>LE/Month</span></div>
						<div class="pricing-pack-price">3000 <span>LE/Year</span></div>
						<div class="pricing-pack-details">
							Cayshly Golden package
						</div>
					</div>

					<div class="pricing-list">
						<h2>Golden package details:</h2>
						<ul>
							<li>Online Store	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Shopping Cart	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Delivery	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Collection 	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Logo - Profile Picture	<span class="fl-right gr-txt">1</span></li>
							<li>Cover Photo 	<span class="fl-right gr-txt">1</span></li>
							<li>Loyalty Program	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Designs	<span class="fl-right gr-txt">4 / Month</span></li>
							<li>Monthly Email Shot	<span class="fl-right gr-txt">30000</span></li>
							<li>Store Management	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Corporate Identity	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							<li>FaceBook Page Management <span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>FaceBook Campaign	<span class="fl-right gr-txt">10000 Views</span></li>
							{{-- <li>Google Search Campaign 	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li>
							<li>Google Display Campaign	<span class="fl-right"><i class="fa fa-fw fa-close"></i></span></li> --}}
						</ul>
					</div>

					<div style="background-color:#FFBF00;" class="pricing-dis">
						<div class="pricing-dis-details">Discount: 20% for full payment</div>
						<div class="pricing-dis-details">Payment: * 2400 LE Yearly</div>
						<div class="pricing-dis-details">Payment: * 1500 LE Monthly</div>
					</div>

					<a href="{{ url('pricing/go/golden') }}" style="background-color:#FFBF00;" class="pricing-ref">Go Golden</a>
				</div>

				<!-- Platinum -->
				<div class="pricing-box-cont">
					<div style="background-color:#848484;" class="pricing-box">
						<div class="pricing-pack-name">Platinum</div>
						<div class="pricing-pack-price">1000 <span>LE/Month</span></div>
						<div class="pricing-pack-price">12000 <span>LE/Year</span></div>
						<div class="pricing-pack-details">
							Cayshly Platinum package
						</div>
					</div>

					<div class="pricing-list">
						<h2>Platinum package details:</h2>
						<ul>
							<li>Online Store	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Shopping Cart	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Delivery	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Collection 	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Logo - Profile Picture	<span class="fl-right gr-txt">1</span></li>
							<li>Cover Photo 	<span class="fl-right gr-txt">1</span></li>
							<li>Loyalty Program	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Designs	<span class="fl-right gr-txt">8 / Month</span></li>
							<li>Monthly Email Shot	<span class="fl-right gr-txt">100000</span></li>
							<li>Store Management	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>Corporate Identity	<span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>FaceBook Page Management <span class="fl-right gr-txt"><i class="fa fa-fw fa-check"></i></span></li>
							<li>FaceBook Campaign	<span class="fl-right gr-txt">20000 Views</span></li>
							{{-- <li>G Search Campaign 	<span class="fl-right gr-txt">80 Clicks/Month</span></li>
							<li>G Display Campaign	<span class="fl-right gr-txt">1000 Clicks/Month</span></li> --}}
						</ul>
					</div>

					<div style="background-color:#848484;" class="pricing-dis">
						<div class="pricing-dis-details">Discount: 20% for full payment</div>
						<div class="pricing-dis-details">Payment: * 10,000 LE Yearly</div>
						<div class="pricing-dis-details">Payment: * 1200 LE Monthly</div>
					</div>

					<a href="{{ url('pricing/go/platinum') }}" style="background-color:#848484;" class="pricing-ref">Go Platinum</a>
				</div>

				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection