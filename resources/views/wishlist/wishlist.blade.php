@extends('partials.main-master')

@section('title') {{ trans('site.wishbutton') }} @endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->



<style>
	table {
		border-collapse: collapse;
		width: 100%;
	}

	th, td {
		padding: 8px;
		text-align: left;
		border-bottom: 1px solid #ddd;
	}
</style>





<div class="all-sections">
	<div class="w-res">
		<h1 class="txt-g-h"><i class="fa fa-fw fa-shopping-cart"></i> {{ trans('site.wishbutton') }} </h1>
		<div class="cart-p">
			<div class="">
				<!-- Cart Items -->

				<div style="padding: 20px 10px;" class="box">
					@if(!empty($wishlist))
					<table>
						<tr>
							<th>{{trans('site.wish-product-remove')}}    </th>
							<th>{{trans('site.wish-product-show')}}</th>
							<th>{{trans('site.wish-product-price')}}</th>
							<th>{{trans('site.wish-product-name')}}</th>


						</tr>


						@foreach($wishlist  as $w)
						<tr>

							<td><a href="{{url('delete/wishlist/'.$w->ProId)}}" class="pricing-btn hdthis" >{{trans('site.wish-product-remove-button')}}</a>    </td>

							<td>  <a class="splash-sign" href="{{url('product/'.$w->ProId)}}">{{trans('site.wish-product-show-button')}}</a>  </td>

							<td>{{$w->ProPrice}} {{$w->ProPriceType}}</td>
							<td>{{$w->ProName}}</td>


						</tr>
						@endforeach



					</table>

					@else

					{{trans('site.nowish')}}

					@endif


				</div>

				<div class="clear"></div>
			</div>

			<!-- <div class="cart-p-r">
				<h1 class="hint"><i class="fa fa-fw fa-bookmark-o"></i> {{ trans('site.Readthisguid') }}</h1>
				<div class="guid">
					<p>{{ trans('site.Youcansellanyproduct') }}</p>
					<p>{{ trans('site.Pageandpostyourproduct') }}</p>
				</div>
			</div> -->
			<div class="clear"></div>
		</div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
