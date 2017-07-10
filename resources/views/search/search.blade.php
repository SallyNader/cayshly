@extends('partials.main-master')

@section('title') {{ trans('site.Search') }} @endsection

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
		<div class="search-p">
			<div class="ad"><img src="{{ url('assets/images/ads/odder.jpg') }}"></div>
			<div class="search-p-results">
				<div class="chos">
					<h2 id="search-res-prod">{{ trans('site.Products') }}</h2>
					<h2 id="search-res-prof">{{ trans('site.Profiles') }}</h2>
					<h2 id="search-res-pag">{{ trans('site.Stores') }}</h2>
				</div>

				<div class="search-p-results-all">
					<!-- Search Results of Profiles -->
					<div class="search-res-prof">
						<h1 class="txt-g-h">{{ trans('site.Profilesrelatedtoyoursearch') }} :</h1>
						<div class="n-m-c">
							@if(count($profiles) > 0)
								@foreach($profiles as $profile)
									<div class="n-m-c-i">
										<a href="{{ url('profile/' . $profile->id) }}">
											<div class="n-m-c-i-img">
												@if($profile->uImg != "")
													<img src="{{ url('assets/images/profiles/' . $profile->uImg) }}">
												@else
													@if($profile->gender == 'female')
														<img src="{{ url('assets/images/profiles/default-girl.jpg') }}"/>
													@else
														<img src="{{ url('assets/images/profiles/default-boy.jpg') }}"/>
													@endif
												@endif
											</div>
											<p class="n-m-c-i-txt">{{ $profile->name }} {{ $profile->lastName }}</p>
										</a>
									</div>
								@endforeach
							@else
								<p class="nothing">{{ trans('site.NoResults') }}</p>
							@endif

							<div class="clear"></div>
						</div>
					</div>

					<!-- Search Results of Pages -->
					<div class="search-res-pag">
						<h1 class="txt-g-h">{{ trans('site.Storesrelatedtoyoursearch') }} :</h1>
						<div class="n-m-c">
							@if(count($stores) > 0)
								@foreach($stores as $store)
									<div class="n-m-c-i">
										<a href="{{ url('stores/' . $store->Sid) }}">
											<div class="n-m-c-i-img">
												<img src="<?= ($store->SImg != '') ? url('assets/images/stores/' . $store->SImg) : url('assets/images/stores/default.jpg') ; ?>">
											</div>
											<p class="n-m-c-i-txt">{{ $store->SName }}</p>
										</a>
									</div>
								@endforeach
							@else
								<p class="nothing">{{ trans('site.NoResults') }}</p>
							@endif
							<div class="clear"></div>
						</div>
					</div>

					<!-- Search Results of Products -->
					<div class="search-res-prod">
						<h1 class="txt-g-h">{{ trans('site.Productsrelatedtoyoursearch') }} :</h1>
						@if(count($products) > 0)
							@foreach($products as $product)
								<div class="product">
									<div class="product-in">
										<div class="p-img"><a href="{{ url('product/' . $product->ProId) }}"><img src="{{ url('assets/images/products/' . $product->ProDefaultImg) }}" title="HTC Desire 50" class="tooltip"><a></div>
										<div class="p-name"><p>{{ substr($product->ProName, 0, 25) }}</p></div>
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
						@else
							<p class="nothing">{{ trans('site.NoResults') }}</p>
						@endif
						<div class="clear"></div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
