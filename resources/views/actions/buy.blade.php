@extends('partials.main-master')

@section('title') {{ trans('site.Buy') }} @endsection

	@section('content')
		<!-- Start Sections Contenets Here +++++++++++ -->
		<div class="all-sections">
			<div class="w-res">
				<h1 class="txt-g-h"><i class="fa fa-fw fa-check"></i> {{ trans('site.Thisfinalaction') }} :</h1>
				<div class="buy-p">
					<div class="buy-p-in">
						{!! Form::open(['url'=>'/buy/done', 'method'=>'post']) !!}
						<h1>{{ trans('site.ProductInvoice') }} :</h1>

						@for($index = 0; $index < count($products); $index++)
							<div class="productsBuy">
								<div class="left">
									<h2 class="txt-g-h">{{ $products[$index]['product']->ProName }}</h2>
									<p><label>{{ trans('site.Price') }} : </label><span>{{ $products[$index]['product']->ProPrice }} {{ $products[$index]['product']->ProPriceType }} / {{ trans('site.Item') }}</span></p>
									<p><label>{{ trans('site.Points') }} : </label><span>{{ $products[$index]['product']->ProPoints }} {{ trans('site.Point') }}</span></p>
									<p><label>{{ trans('site.Condition') }} : </label>
										<span>
											@if (App::getLocale() == "ar")
												@if ($products[$index]['product']->ProCondition == "new")
													جديد
												@else
													مستعمل
												@endif
											@else
												{{ ucfirst($products[$index]['product']->ProCondition) }}
											@endif
										</span>
									</p>
									<p><label>{{ trans('site.Warranty') }} : </label><span>{{ $products[$index]['product']->ProWarranty }}</span></p>
									<p><label>{{ trans('site.Soldby') }} : </label><span>{{ $products[$index]['product']->SName }} {{ trans('site.Store') }}</span></p>
									<p><label>{{ trans('site.Quantity') }} : </label><span>{{ $products[$index]['quant'] }} {{ trans('site.Item') }}<?= ($products[$index]['quant'] > 1)? 's' : '' ; ?></span></p>
								</div>
								<div class="right">
									<img src="{{ url('assets/images/products/' . $products[$index]['product']->ProDefaultImg) }}" alt="{{ $products[$index]['product']->ProName }}">
								</div>
								<div class="clear"></div>
							</div>
							<input type="hidden" name="product[]" value="{{ $products[$index]['product']->ProId }}" />
							<input type="hidden" name="quant[]" value="{{ $products[$index]['quant'] }}" />
						@endfor
						<div class="productsBuy">
							<div class="left">
								<h2 class="txt-g-h">{{ trans('site.TotalPrice') }} : {{ $totalAmount }} EGP</h2>
							</div>
							<div class="clear"></div>
						</div>

						@if(Auth::check())
							<!-- Your Data -->
							<h1>{{ trans('site.DeliveryData') }} :</h1>
							<p><label>{{ trans('site.Name') }} : </label><input type="text" required name="name" value="{{ Auth::user()->name . ' ' . Auth::user()->lastName }}"/></p>
							<p><label>{{ trans('site.PhoneNumber') }} : </label><input type="text" required name="phone" value="{{ Auth::user()->phone }}"/></p>
							<p><label>{{ trans('site.Email') }} : </label><input type="text" required name="email" value="{{ Auth::user()->email }}"/></p>
							<p><label>{{ trans('site.Address') }} : </label><input type="text" required name="address" value="{{ Auth::user()->address }}" placeholder="{{ trans('site.typeyourrealaddress') }}" /></p>
							<p>
								<label>{{ trans('site.Payment') }}</label>
								<input class="rcpr" type="radio" checked required name="payment" value="cash" /> {{ trans('site.Cashondelivery') }}
							</p>
							@if($totalpointsnotconfirmed >= ($totalAmount*100))
								<p>
									<label></label>
									<input class="rcpr" type="radio" required name="payment" value="all" /> {{ trans('site.RedeemWithPoints') }} ({{ trans('site.YouHave') }} {{ $totalpoints }} {{ trans('site.Points') }})
								</p>
							@endif
							{{-- <p>
							<label></label>
							<input id="rcp" type="radio" required name="payment" value="custom" /> Redeem With Custom Points
							<input id="rc" type="number" class="range" name="redeem_amount" min="1" max="{{ $totalpoints }}" placeholder="00"/>
						</p> --}}

						<p>
							<label></label>
							{{-- <a href="{{ url('buy/aaib') }}" class="btn-pay">اضغط هنا لاتمام الدفع بواسطة بنك AAIB </a> --}}
							<input type="submit" class="btn btn-main" value="{{ trans('site.ConfirmOrder') }}">
						</p>

						<br>

						{{-- <a href="javascript:window.print()" type="button" class="btn">PRINT</a> --}}
						<div class="clearfix"></div>
						{!! Form::close() !!}
						<div class="clearfix"></div>


					@endif


				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
