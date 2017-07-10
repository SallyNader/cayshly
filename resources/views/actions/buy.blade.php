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
							<input class="rcpr" type="radio" required name="payment" value="cash" /> {{ trans('site.Cashondelivery') }}
						</p>
						@if($totalpointsnotconfirmed >= ($totalAmount*100))
						<p>
							<label></label>
							<input class="rcpr" type="radio" required name="payment" value="all" /> {{ trans('site.RedeemWithPoints') }} ({{ trans('site.YouHave') }} {{ $totalpoints }} {{ trans('site.Points') }})
						</p>
						@endif
						<p>
							<label></label>
							<input class="rcpr" type="radio" name="payment" value="vam" id="chvam" /> الدفع بواسطة بطاقة الائتمان
						</p>
						{{-- <p>
							<label></label>
							<input id="rcp" type="radio" required name="payment" value="custom" /> Redeem With Custom Points
							<input id="rc" type="number" class="range" name="redeem_amount" min="1" max="{{ $totalpoints }}" placeholder="00"/>
						</p> --}}

						<p>
							<label></label>
							{{-- <a href="{{ url('buy/aaib') }}" class="btn-pay">اضغط هنا لاتمام الدفع بواسطة بنك AAIB </a> --}}
							<input type="submit" class="btn btn-main bvam" value="{{ trans('site.ConfirmOrder') }}">
						</p>

						<br>

						{{-- <a href="javascript:window.print()" type="button" class="btn">PRINT</a> --}}
						<div class="clearfix"></div>
	          {!! Form::close() !!}
						<div class="clearfix"></div>
					<div style="background-color:#eee;padding:10px;text-align:center;display: none;" class="hvam">
						<form action="{{ url('buy/aaib') }}" method="get">
							{{ csrf_field() }}
							<p>الدفع بواسطة بطاقة الائتمان</p>
							<img style="width: 265px;" src="{{ url('assets/images/AAIB.jpg') }}" >

							<h1>{{ trans('site.DeliveryData') }} :</h1>

							<p><label>{{ trans('site.Name') }} : </label><input type="text" required name="name" value="{{ Auth::user()->name . ' ' . Auth::user()->lastName }}"/></p>
							<p><label>{{ trans('site.PhoneNumber') }} : </label><input type="text" required name="phone" value="{{ Auth::user()->phone }}"/></p>
							<p><label>{{ trans('site.Email') }} : </label><input type="text" required name="email" value="{{ Auth::user()->email }}"/></p>
							<p><label>{{ trans('site.Address') }} : </label><input type="text" required name="address" value="{{ Auth::user()->address }}" placeholder="{{ trans('site.typeyourrealaddress') }}" /></p>

							@for($index = 0; $index < count($products); $index++)
								<input type="hidden" name="product[]" value="{{ $products[$index]['product']->ProId }}" />
								<input type="hidden" name="quant[]" value="{{ $products[$index]['quant'] }}" />
							@endfor

							<input type="hidden" name="total" value="{{ $totalAmount }}">

							<div class="clearfix"></div>
							<button type="submit" class="btn-pay">اضغط هنا لاتمام الدفع بواسطة بطاقة الائتمان</button>
						</form>
					</div>

					@else
                {!! Form::close() !!}
                	<div class="plsign">
                		<div class="plsignl">
	                		<div class="box">
	                			<h2>{{ trans('site.loginifnot') }}</h2>

	                			{!! Form::open(['url'=>'auth/login','method'=>'post','class'=>'form']) !!}
	                			<label for="email"><b>{{ trans('site.CurrentEmail') }} : </b></label>
	                            <input type="email" class="" name="email" required placeholder='{{ trans('sign.login-mail') }}'>

	                            <label for="password"><b>{{ trans('site.CurrentPass') }} : </b></label>
	                            <input type="password" class="" name="password" required placeholder='{{ trans('sign.login-pass') }}'>

	                            <input type="submit" class="btn btn-red" name="login" value='{{ trans('sign.login') }}'>
	                            <div class="clear"></div>
	                            {!! Form::close() !!}

	                		</div>
                		</div>
                		<div class="plsignr">
                		{{-- Sign up new account from here --}}
                        <div class="box sign-up">
                			<h2>{{ trans('site.registerifnot') }}</h2>

                            {!! Form::open(['url'=>'auth/ref/new','class'=>'form', 'method'=>'post']) !!}

                                <input style="width:100%;border: 1px solid #0D848B;" type="text" name="fname" required <?= (old('fname')) ? 'value="' . old('fname') . '"': "" ;  ?> placeholder='{{ trans('sign.register-fname') }}'>
                                @if($errors->has('fname'))
                                    <p class="theError"><i class="fa fa-warning"></i> {{ $errors->first('fname') }}</p>
                                @endif

                                <input style="width:100%;border: 1px solid #0D848B;" type="text" name="lname" required <?= (old('lname')) ? 'value="' . old('lname') . '"': "" ;  ?> placeholder='{{ trans('sign.register-lname') }}'>
                                @if($errors->has('lname'))
                                    <p class="theError"><i class="fa fa-warning"></i> {{ $errors->first('lname') }}</p>
                                @endif

                                <input type="email" class="" name="email" required <?= (old('email')) ? 'value="' . old('email') . '"': "" ;  ?> placeholder='{{ trans('sign.register-email') }}'>
                                @if($errors->has('email'))
                                    <p class="theError"><i class="fa fa-warning"></i> {{ $errors->first('email') }}</p>
                                @endif

                                <input style="width:100%;border: 1px solid #0D848B;" type="phone" class="" name="phone" required <?= (old('phone')) ? 'value="' . old('phone') . '"': "" ;  ?> placeholder='{{ trans('sign.register-phone') }}'>
                                @if($errors->has('phone'))
                                    <p class="theError"><i class="fa fa-warning"></i> {{ $errors->first('phone') }}</p>
                                @endif

                                <input type="password" class="" name="password" required placeholder='{{ trans('sign.register-pass') }}'>
                                @if($errors->has('password'))
                                    <p class="theError"><i class="fa fa-warning"></i> {{ $errors->first('password') }}</p>
                                @endif

                                <input type="submit" class="btn btn-red" value="{{ trans('sign.register') }}">
                                <div class="clear"></div>
                            {!! Form::close() !!}
                        </div>

                		</div>
						<div class="clear"></div>
                	</div>
					@endif


			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
