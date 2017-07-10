@extends('partials.main-master')

@section('title') {{ trans('site.Filter') }} @endsection

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
		<!-- Banner Ad -->
		@include('_parts.ads_2_banner')
		
		<div class="filter-p">
			<!-- Filter Page Left -->
			{!! Form::open(['url'=>'filter/data','method'=>'get']) !!}
			<div class="filter-p-l">
				{{-- <div class="filter-p-l-c">
					<h2>Search</h2>
					<div class="s-c-t">
						<p><input type="text" name="" placeholder="Enter Search Item"></p>
					</div>
				</div> --}}
				
				<h2>{{ trans('site.Category') }}</h2>
				<div class="s-c-t">
					@foreach($cats as $cat)
						<p><input type="radio" name="cat" id="cat{{ $cat->id }}" value="{{ $cat->id }}"><label for="cat{{ $cat->id }}"> {{ $cat->cat_name_en }}</label></p>
					@endforeach
				</div>

				<h2>{{ trans('site.Subcategory') }}</h2>
				<div class="s-c-t">
					@foreach($subcats as $subcat)
						<p><input type="radio" name="subcat" id="subcat{{ $subcat->id }}" value="{{ $subcat->id }}"><label for="subcat{{ $subcat->id }}"> {{ $subcat->sub_cat_name_en }}</label></p>
					@endforeach
				</div>

				<h2>{{ trans('site.Condition') }}</h2>
				<div class="s-c-t">
					<p><input type="radio" name="cond" value="new" id="radioN"><label for="radioN"> {{ trans('site.New') }}</label></p>
					<p><input type="radio" name="cond" value="used" id="radioU"><label for="radioU"> {{ trans('site.Used') }}</label></p>
				</div>

				<h2>{{ trans('site.Price') }}</h2>
				<div class="s-c-t">
					<p><input type="radio" name="price" id="less0" value="100"><label for="less0"> {{ trans('site.Lessthan100EGP') }}</label></p>
					<p><input type="radio" name="price" id="less1" value="1000"><label for="less1"> {{ trans('site.Lessthan1000EGP') }}</label></p>
					<p><input type="radio" name="price" id="less2" value="2000"><label for="less2"> {{ trans('site.Lessthan2000EGP') }}</label></p>
					<p><input type="radio" name="price" id="less3" value="3000"><label for="less3"> {{ trans('site.Lessthan3000EGP') }}</label></p>
					<p><input type="radio" name="price" id="less4" value="4000"><label for="less4"> {{ trans('site.Lessthan5000EGP') }}</label></p>
					<p><input type="radio" name="price" id="less5" value="5000"><label for="less5"> {{ trans('site.Morethan5000EGP') }}</label></p>	
				</div>

				<button type="submit" style="width:100%;margin:10px 0px;padding:7px 0px;" class="btn btn-main"><i class="fa fa-fw fa-filter"></i> {{ trans('site.Filter') }}</button>
				
				<!-- Ads Area -->
				<div class="ad-s-1">
					<a href="#"><img src="{{ url('assets/images/ads/L.jpg') }}"></a>
				</div>

			</div>

			{!! Form::close() !!}

			<!-- Filter Page Right -->
			<div class="filter-p-r">
				@if(count($products) != 0)
					@foreach($products as $product)
						<div class="product">
							<div class="product-in">
								<div class="p-img"><a href="{{ url('product/' . $product->ProId) }}"><img src="{{ url('assets/images/products/' . $product->ProDefaultImg) }}" title="{{ $product->ProName }}" class="tooltip"><a></div>
								<div class="p-name"><p>{{ $product->ProName }}</p></div>
								<div class="p-data">
									<div class="p-data-price">{{ $product->ProPrice }} {{ $product->ProPriceType }}</div>
									<div class="p-data-points"> {{ $product->ProPoints }} {{ trans('site.Points') }}</div>
								</div>
								<div class="p-process">
									<div class="p-process-details"><a href="{{ url('product/' . $product->ProId) }}">{{ trans('site.Details') }}</a></div>
									<div class="p-process-addCurt">
										{!! Form::open(['url'=>'cart/add/' .  $product->ProId, 'method'=>'post']) !!}
											<button type="submit" id="p-id"><i class="fa fa-fw fa-cart-plus"></i> {{ trans('site.Add') }}</button>
										{!! Form::close() !!}
									</div>
								</div>
							</div>
						</div>
					@endforeach
				@else
					<p class="nothing">{{ trans('site.noproductsforyoursearch') }}</p>
				@endif
				<div class="clear"></div>
			</div>

			<div class="clear"></div>
		</div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection	