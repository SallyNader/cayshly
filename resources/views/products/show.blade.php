@extends('partials.main-master')

@section('title') {{ $product->ProName }} @endsection

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

@section('socialMeta')

<meta property="og:image" content="{{ url('assets/images/products/' . $product->ProDefaultImg) }}" />

@endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->
<div class="all-sections">
	<div class="w-res">
		<!-- Banner Ad -->
		{{--<div class="box">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- Cayshly_18-12-2016_1st ad -->
		<ins class="adsbygoogle"
		style="display:block"
		data-ad-client="ca-pub-8428370033035064"
		data-ad-slot="1029867037"
		data-ad-format="auto"></ins>
		<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>--}}

	<div class="product-page">
		<div class="product-page-banner">
			<div class="product-page-banner-page">
				<span class="pp-link">{{ trans('site.Seemoreon') }} <a href="{{ url('stores/' . $product->ProStoreId . "/" . $product->SName) }}">{{ $product->SName }}</a> </span>
			</div>
			<div class="product-page-banner-cat">
				<span class="pp-link">{{ trans('site.Allfrom') }} <a href="{{ url('category/' . $product->id) }}" class="link">
					{{ (session()->get('lang') == 'ar') ? $product->cat_name_ar : $product->cat_name_en }}
				</a> </span>
			</div>
		</div>
		<!-- Start Section 1 -->
		<div class="product-page-details">
			<div class="product-page-details-pro">
				<div class="product-images">
					<div class="product-images-selected">
						<img class="ceter-ig onModal" src="{{ url('assets/images/products/' . $product->ProDefaultImg) }}">
					</div>
					@unless(!count($images)>0)
					<div class="product-images-all">

						<?php $counter=0; ?>
						@foreach($images as $image)

						@if($counter<6)
						<div class="imgs"><img src="{{ url('assets/images/products/'.$image->imagePath) }}"></div>
						<?php  $counter++;  ?>
						@endif

						@endforeach

					</div>
					@endunless
				</div>

				<!-- Product Reviews -->
				<div class="product-reviews">
					<div class="product-reviews-spes">
						<div class="product-reviews-spes-1" <?php if (preg_match('/ا|ب|ت|ث|ج|ح|خ|د|ذ|ر|س|ش|ص|ض|ط|ظ|ع|غ|ف|ق|ك|ل|م|ن|ه|و|ي/i', $product->ProName)) { echo "style='direction:rtl;'";}else {echo "style='direction:ltr;'";}?> >
							{{ $product->ProName }}
						</div>
						<div class="product-reviews-spes-2">
							<div class="product-reviews-spes-2-txt">{{ trans('site.Price') }} : <span>{{ $product->ProPrice }}</span> {{ $product->ProPriceType }}</div>
							<div class="product-reviews-spes-2-txt">{{ trans('site.Points') }} : <span>{{ $product->ProPoints * .75 }}</span> {{ trans('site.Points') }}</div>
							<div class="product-reviews-spes-2-txt">{{ trans('site.RedeemWith') }} : <span>{{ $product->ProPrice*100 }}</span> {{ trans('site.Point') }}</div>
						</div>
						<div class="product-reviews-spes-2">
							<center>
								@if(!empty($max)>0)
								@if($max=="star1")
								<img  src="{!!asset('stars/1.PNG')!!}"  />

								@elseif($max=="star2")
								<img  src="{!!asset('stars/2.PNG')!!}"  />

								@elseif($max=="star3")
								<img  src="{!!asset('stars/3.PNG')!!}"  />

								@elseif($max=="star4")
								<img  src="{!!asset('stars/4.PNG')!!}"  />

								@elseif($max=="star5" )
								<img  src="{!!asset('stars/5.PNG')!!}"  />
								@else
								<img  src="{!!asset('stars/0.PNG')!!}"  />
								@endif
								@endif
							</center>
							
							<div class="api-fb-l">{{trans('site.rateit')}}</div>
								<form id="ratingsForm" action="{{url('rate')}}" method="post" >
									{{ csrf_field() }}

									<div class="stars">
										<input type="hidden" name="product_id" value="{{ $product->ProId }}" />
										<input type="radio" name="star" value="1" class="star-1" id="star-1" />
										<label class="star-1" for="star-1">1</label>
										<input type="radio" name="star" value="2" class="star-2" id="star-2" />
										<label class="star-2" for="star-2">2</label>
										<input type="radio" name="star" value="3" class="star-3" id="star-3" />
										<label class="star-3" for="star-3">3</label>
										<input type="radio" name="star" value="4" class="star-4" id="star-4" />
										<label class="star-4" for="star-4">4</label>
										<input type="radio" name="star"value="5"  class="star-5" id="star-5" />
										<label class="star-5" for="star-5">5</label>
										<span  style=""  ></span>

										<center  style="background-color:white">
											<input type="submit"   class="btn btn-red" value="{{trans('site.sendrate')}}">
										</center>
									</div>
								</form>
						</div>
						<div class="product-reviews-spes-2">
							<center>
								@if(Auth::check())
									@if(!count($wishlist)>0)
										<form action="{{url('wishlist')}}"  method="post">

											{{ csrf_field() }}
											<input type="hidden"  name="product_id" value="{{$product->ProId}}" />
											<input type="submit" name="pcomment" id="pComment" class="btn btn-red" value="{{trans('site.addToWishlist')}}">
										</form>
									@endif
								@endif
							</center>
						</div>						
						<div class="product-reviews-spes-2">
							<div class="product-reviews-spes-2-txt">{{ trans('site.numofviews') }} : <span>{{ $product->ProViews }}</span></div>
						</div>
						<div class="product-reviews-spes-3">
							<div><span>{{ trans('site.Condition') }} : </span>
								@if (App::getLocale() == "ar")
								@if ($product->ProCondition == "new")
								جديد
								@else
								مستعمل
								@endif
								@else
								{{ ucfirst($product->ProCondition) }}
								@endif
							</div>
							<div><span>{{ trans('site.Warranty') }} : </span>{{ $product->ProWarranty }}</div>
						</div>
						<div class="product-reviews-spes-3">
							<span>{{ trans('site.Phone') }} : </span>{{ $product->SPhone }}
						</div>
							<div class="product-reviews-spes-4">
								{!! Form::open(['url'=>'cart/add/' .  $product->ProId, 'method'=>'post']) !!}
								<button type="submit" class="addCart"><i class="fa fa-fw fa-cart-plus"></i> {{ trans('site.AddtoCart') }}</button>
								{!! Form::close() !!}
							</div>

							<div class="product-reviews-spes-5">
								<div class="api-fb-l">{{ trans('site.Sharethisonfacebook') }}</div>
								<div class="api-fb-r">
									<div class="fb-share-button" data-href="{{ url('product/' . $product->ProId) }}" data-layout="button" data-size="large" data-mobile-iframe="false">
										<a style="background-color:#365899;color:#fff" class="btn fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url('product/' . $product->ProId) }}&amp;src=sdkpreparse">{{ trans('site.Shareon') }} <i class="fa fa-facebook"></i></a>
									</div>
								</div>
							</div>
							<div class="product-reviews-spes-5">
								<div class="api-fb-l">{{ trans('site.ShareThisongoogle') }}</div>
								<div class="api-fb-r">
									<!-- Place this tag in your head or just before your close body tag. -->
									<script src="https://apis.google.com/js/platform.js" async defer>
										{lang: 'en-GB'}
									</script>

									<!-- Place this tag where you want the share button to render. -->
									<div class="g-plus" data-action="share" data-annotation="none" data-height="24"></div>
								</div>
							</div>
							<div class="product-reviews-spes-6">
								<div class="product-reviews-spes-6-in">{{ trans('site.Orderthisproduct') }}
									{!! Form::open(['url'=>'cart/add/' .  $product->ProId, 'method'=>'post', 'style'=>'display: initial;']) !!}
									<button class="btn btn-red" type="submit">{{ trans('site.Buy') }}</button>
									{!! Form::close() !!}
								</div>
								{{-- <div class="product-reviews-spes-6-in">Loved this product <span class="btn btn-main">Share</span></div> --}}
							</div>
						</div>
						<div class="product-reviews-comments scrolled">
							<!-- Add New Product Comment -->
							@if(Auth::check())
							{!! Form::open(['url'=>'product/comment/add','method'=>'post', 'class'=>'commentProduct']) !!}
							<div class="user-comment-area">
								<textarea name="txtComment" class="txtComment" placeholder="{{ trans('site.Writeacomment') }}"></textarea>
								<input type="hidden" name="proid" value="{{ $product->ProId }}">
								<input type="hidden" id="userId" value="{{ Auth::user()->id }}">
								<input type="hidden" id="userImg" value="{{ Auth::user()->uImg }}">
								<input type="submit" name="pcomment" id="pComment" class="btn fl-right btn-red" value="{{ trans('site.Comment') }}">
							</div>
							{!! Form::close() !!}
							<span>
							<!-- {{ trans('site.Writeyourreviewaboutthisproduct') }} -->
							<div style="display: inline-block;">{{$numberOfLikes}} {{trans("site.Likes")}}</div>
							@if(Auth::check())
								@if(count($ifLike)==0)
									<form style="display: inline-block;" action="{{url('like_product')}}"  method="post" >
										{{ csrf_field()}}
										<input type="hidden" name="id" value="{{$product->ProId}}" />
										<button style="border: 0px;background-color: transparent;padding: 3px;font-size: 12px;color: #0C9E81;" type="submit"  ><i class="fa fa-thumbs-o-up"></i> {{ trans('site.Like') }}</button>
									</form>
								@else
									<form style="display: inline-block;" action="{{url('unlike_product')}}"  method="post">
										{{ csrf_field()}}
										<input type="hidden" name="id" value="{{$product->ProId}}" />
										<button style="border: 0px;background-color: transparent;padding: 3px;font-size: 12px;color: #0C9E81;" type="submit"><i class="fa fa-thumbs-up"></i>{{ trans('site.Unlike') }}</button>
									</form>
								@endif
							@endif
							</span>
							@endif


							<div class="user-comment-area-all">
								@if(count($productComments) == 0) <p class="nothing">{{ trans('site.BethefirsttoComment') }}</p> @endif
								@foreach($productComments as $productComment)
								<div class="user-comment-area-all-user">
									<div class="user-comment-area-all-uimg">
										@if($product->SUserId == $productComment->id)
										<img src="{{ url('assets/images/stores/') }}<?= ($product->SImg == '')? '/default.jpg' : '/'. $product->SImg ; ?>">
										@else
										<img src="{{ url('assets/images/profiles/' . $productComment->uImg) }}">
										@endif
									</div>
									<div class="user-comment-area-all-txt">
										@if($product->SUserId == $productComment->id)
										<a href="{{ url('stores/' . $product->ProStoreId) }}" class="linkGl">{{ $product->SName }}</a>
										@else
										<a href="{{ url('profile/' . $productComment->id) }}" class="linkGl">{{ $productComment->name }}</a>
										@endif
										<p><pre <?php if (preg_match('/ا|ب|ت|ث|ج|ح|خ|د|ذ|ر|س|ش|ص|ض|ط|ظ|ع|غ|ف|ق|ك|ل|م|ن|ه|و|ي/i', $productComment->ProComText)) { echo "style='direction:rtl;'";}else {echo "style='direction:ltr;'";}?> class="pre">{{ $productComment->ProComText }}</pre></p>
									</div>
								</div>
								@endforeach
							</div>

						</div>
						<div class="clear"></div>
					</div>
				</div><!-- End Section 1 -->
				<div class="clear"></div>

				<!-- Start Section 2 -->
				<div class="product-page-info">
					{{-- <h1>PRODUCT INFORMATION</h1>
					<div class="product-page-info-specifications">
						<h2>Specifications</h2>
						<p><span>Brand : </span>Acer</p>
						<p><span>Operating System : </span>Android</p>
						<p><span>Audio Formats : </span>MP3, WAV, eAAC+, FLAC player</p>
						<p><span>Storage Capacity : </span>16 GB</p>
						<p><span>Depth : </span>9.9 mm</p>
						<p><span>Width : </span>73 mm</p>
						<p><span>Operating System Version : </span>Android 4.4.2 (KitKat)</p>
					</div> --}}

					<div class="product-page-info-description">
						<h2>{{ trans('site.Description') }}</h2>
						<?php
						$newStr = preg_replace('!(http|ftp|scp)(s)?:\/\/[a-zA-Z0-9.?&_/]+!', "<a class='thislink' target='blank' href=\"\\0\">\\0</a>",$product->ProDescription);
						?>
						<p <?php if (preg_match('/ا|ب|ت|ث|ج|ح|خ|د|ذ|ر|س|ش|ص|ض|ط|ظ|ع|غ|ف|ق|ك|ل|م|ن|ه|و|ي/i', $newStr)) { echo "style='direction:rtl;'";}else {echo "style='direction:ltr;'";}?>>
							{!! $newStr !!}
						</p>
					</div>

					@if($product->ProVideo != '')
					<div class="product-page-info-video">
						<h2>{{ trans('site.Video') }}</h2>
						<iframe width="100%" height="400" src="{{ $product->ProVideo }}" frameborder="0" allowfullscreen></iframe>
					</div>
					@endif

				</div><!-- End Section 2 -->

				@if(count($relatedProducts))
				<!-- Start Section 3 -->
				<div class="product-page-related">
					<h1>{{ trans('site.Chekthisalsoyoumayfound') }}</h1>
					<!-- Place somewhere in the <body> of your page -->
					<div class="flexslider carousel">
						<ul class="slides">
							@foreach($relatedProducts as $relatedProduct)
							<li>
								<div class="p-slider">
									<div class="p-slider-img">
										<a href="{{ url('product/' . $relatedProduct->ProId) }}">
											<img src="{{ url('assets/images/products/' . $relatedProduct->ProDefaultImg) }}" title="{{ $relatedProduct->ProName }}" class="tooltip">
										</a>
									</div>
									<div class="p-slider-name">
										@if(preg_match('/ا|ب|ت|ث|ج|ح|خ|د|ذ|ر|س|ش|ص|ض|ط|ظ|ع|غ|ف|ق|ك|ل|م|ن|ه|و|ي/i', $relatedProduct->ProName))
										<p>{{ substr($relatedProduct->ProName , 0, 60) }}</p>
										@else
										<p>{{ substr($relatedProduct->ProName , 0, 15) }}</p>
										@endif
									</div>
									<div class="p-slider-data">
										<div class="p-slider-data-price">{{ $relatedProduct->ProPrice }} {{ $relatedProduct->ProPriceType }}</div>
										<div class="p-data-points">{{ $relatedProduct->ProPoints }} {{ trans('site.Points') }}</div>
									</div>
								</div>
							</li>
							@endforeach
						</ul>
					</div>
				</div><!-- End Section 3 -->
				@endif


			</div>
		</div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
