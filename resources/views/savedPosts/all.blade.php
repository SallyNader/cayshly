@extends('partials.main-master')

@section('title') {{ trans('site.savedPost') }} @endsection

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
		<h1 class="txt-g-h"><i class="fa fa-fw fa-shopping-cart"></i> {{ trans('site.savedPost') }} </h1>
		<div class="cart-p">
			<div class="">
				<!-- Cart Items -->

				<div style="padding: 20px 10px;" class="box">
					@if(count($posts)>0)
					<table>
						<tr>
							<th>{{trans('site.wish-product-remove')}}    </th>
							<th>{{trans('site.showPost')}}</th>
							<th>{{trans('site.Posts')}}</th>
						</tr>
						@foreach($posts->posts  as $w)
						<tr>
							<td><a href="{{url('remove-saved-post/' . $w->PId)}}" class="pricing-btn hdthis" >{{trans('site.wish-product-remove-button')}}</a>    </td>
							<td>  <a class="splash-sign" href="{{url('show/post/'.$w->PId)}}">{{trans('site.wish-product-show-button')}}</a>  </td>
							<td>{{$w->PText}}</td>
						</tr>
						@endforeach
					</table>
					@else
					{{trans('site.noSavedPosts')}}
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
