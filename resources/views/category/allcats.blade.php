@extends('partials.main-master')

@section('title') {{ trans('site.Category') }} @endsection

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
			<div class="banner">
				<a href="{{ url('pricing') }}">
					<img src="{{ url('assets/images/banners/banner-3.jpg') }}" alt="banner">
				</a>
			</div>

			<div style="color:#FFB400;padding:20px 0px;text-align:center;">
				<h1>{{ DB::table('categories')->where('id','=',$id)->first()->cat_name_ar }}</h1>
			</div>

			<h1 class="txt-g-h"><i class="fa fa-fw fa-flag-o"></i> {{ trans('site.Productsrelated') }} :</h1>
			<p class="txt-g-p">{{ trans('site.Hereyoufindallproductsreleted') }}</p>
			<br />
			<div class="box">
				@foreach($products as $product)
					<div class="product">
						<div class="product-in">
							<div class="p-img">
								<a href="{{ url('product/' . $product->ProId) }}">
									<img src="{{ url('assets/images/products/' . $product->ProDefaultImg) }}" title="{{ $product->ProName }}" class="tooltip">
								<a>
							</div>
							<div class="p-name">
								@if(preg_match('/ا|ب|ت|ث|ج|ح|خ|د|ذ|ر|س|ش|ص|ض|ط|ظ|ع|غ|ف|ق|ك|ل|م|ن|ه|و|ي/i', $product->ProName))
									<p>{{ substr($product->ProName , 0, 60) }}</p>
								@else
									<p>{{ substr($product->ProName , 0, 15) }}</p>
								@endif
							</div>
							<div class="p-data">
								<div class="p-data-price">{{ $product->ProPrice }} {{ $product->ProPriceType }}</div>
								<div class="p-data-points"> {{ $product->ProPoints }} {{ trans('site.Points') }}</div>
							</div>
							<div class="p-process">
								<div class="p-process-details"><a href="{{ url('product/' . $product->ProId) }}">{{ trans('site.Details') }}</a></div>
								<div class="p-process-addCurt">
									{!! Form::open(['url'=>'cart/add/' .  $product->ProId, 'method'=>'post']) !!}
										<button type="submit" id="p-id"><i class="fa fa-fw fa-cart-plus"></i></button>
									{!! Form::close() !!}
								</div>
							</div>
						</div>
					</div>
				@endforeach

				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
