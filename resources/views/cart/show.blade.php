@extends('partials.main-master')

@section('title') {{ trans('site.Shoppingcart') }} @endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->
<div class="all-sections">
	<div class="w-res">
		<h1 class="txt-g-h"><i class="fa fa-fw fa-shopping-cart"></i> {{ trans('site.Shoppingcart') }} (<?= (empty(session()->get('carts')))? '0' : count(session()->get('carts')) ; ?> {{ trans('site.items') }})</h1>
		<div class="cart-p">					
			<div class="cart-p-l">
				<!-- Cart Items -->
				@if(!empty(session()->get('carts')))
				{!! Form::open(['url'=>'buy', 'method'=>'put' ]) !!}
					@foreach($products as $product)
						<div class="box">
							<div class="cart-item">
								<div class="cart-item-t">
									<div class="cart-item-t-l">
										<img src="{{ url('assets/images/products/' . $product->ProDefaultImg) }}">
									</div>
									<div class="cart-item-t-r">
										<h1>{{ $product->ProName }}</h1>
										<p>{{ trans('site.Price') }} : 
											<span class="proPriceOriginal" >{{ $product->ProPrice }}</span>
											<span class="proPrice" >{{ $product->ProPrice }}</span>
											 {{ $product->ProPriceType }}</p>								
										<p>{{ trans('site.Quantity') }} : <input type="number" class="quant" name="quant[]" value="1"></p>								
									</div>
									<a href="{{ url('cart/delete/' . $product->ProId) }}" class="btn btn-red">{{ trans('site.Delete') }}</a>
									<div class="clear"></div>
								</div>
							</div>
						</div>
					@endforeach
					<div class="box totalPriceAll">
						<div class="totalPriceCont">{{ trans('site.TotalPrice') }} : <span class="totalPrice"></span></div> 
						<div class="fl-right">
								<button class="btn btn-main" type="submit">{{ trans('site.ProceedToBuy') }} </button>
						</div>
						<div class="clear"></div>
					</div>
				{!! Form::close() !!}
				@else
					<div style="padding: 20px 10px;" class="box">{{ trans('site.AddProducts') }}</div>
				@endif
				<div class="clear"></div>
			</div>

			<div class="cart-p-r">
				<h1 class="hint"><i class="fa fa-fw fa-bookmark-o"></i> {{ trans('site.Readthisguid') }}</h1>
				<div class="guid">
					<p>{{ trans('site.Youcansellanyproduct') }}</p>
					<p>{{ trans('site.Pageandpostyourproduct') }}</p>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection	