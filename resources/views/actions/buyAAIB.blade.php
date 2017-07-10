<!DOCTYPE html>
<html>
<head>
  <title>Payment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header("Content-Type: application/xml; charset=utf-8");
  ?>

  <link rel="icon" type="image/ico" href="{{ url('favicon.ico') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/libs/tipsy/tstyle.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/css/flexslider.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/css/modal.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/css/jquery.bxslider.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/css/sweetalert.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/css/main.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/libs/chosen/chosen.css') }}">
  @if(session()->get('lang') != "en")
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/override.css') }}">
  @endif

  <!-- Mobile -->
  <link rel="stylesheet" type="text/css" href="{{ url('assets/css/main-mobile.css') }}" media="screen and (min-width:250px) and (max-width:700px)">

<body>


  <!-- Start Header -->
  <header>
    <div class="h-top">
      <div class="w-res">
        @if(session()->get('lang') == 'en')
          <a href="/"><img class="logoTop" src="{{ url('assets/images/main/cayshly-logo.png') }}" alt="Cayshly" title="Cayshly" /></a>
        @else
          <a href="/"><img class="logoTop" src="{{ url('assets/images/main/cayshly-logo-ar.png') }}" alt="كيشلى" title="كيشلى" /></a>
        @endif

        @if(session()->get('lang') != 'en')
          <a class="langs" href="{{ url('lang/en') }}">En</a>
        @else
          <a class="langs" href="{{ url('lang/ar') }}">Ar</a>
        @endif
				<div class="clear"></div>
      </div>
    </div>
</div>

</header>

<div class="clear"></div>





	<!-- Start Sections Contenets Here +++++++++++ -->
	<div class="all-sections">
		<div class="w-res">
			<h1 class="txt-g-h"><i class="fa fa-fw fa-refresh"></i>الدفع بواسطة بطاقة الائتمان</h1>
			<p class="txt-g-p">نظام الدفع الالكترونى</p>
			<!-- Pages Update -->
			<div class="create-pg">
				<div class="create-pg-in">
					<!-- Pages All -->
					<div class="create-pg-in-l">
						<div class="box">
							<img style="width: 100%;" src="{{ url('assets/images/aaib2.jpg') }}" >

							<!-- The "Pay Now!" button submits the form and gives control to the form 'action' parameter -->
							<form action="{{ url('aaib/PHP_VPC_3Party_Order_DO.php') }}" method="post" accept-charset="UTF-8">

								<br>
								<h1 class="txt-g-h"><i class="fa fa-fw fa-bars"></i> بيانات الفاتورة</h1>
								<br>

								@for($index = 0; $index < count($products); $index++)
									<div class="productsBuy">
										<div class="left">
											<h2 class="txt-g-h">{{ $products[$index]['product']->ProName }}</h2>
			 								<p><label>{{ trans('site.Price') }} : </label><span>{{ $products[$index]['product']->ProPrice }} {{ $products[$index]['product']->ProPriceType }} / {{ trans('site.Item') }}</span></p>
			 								<p><label>{{ trans('site.Points') }} : </label><span>{{ $products[$index]['product']->ProPoints }} {{ trans('site.Point') }}</span></p>
											<p><label>{{ trans('site.Condition') }} : </label>
												<span>
												@if (App::getLocale() == "ar")
													@if ($products[$index]['product']->ProCondition == "new")	جديد @else مستعمل @endif
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
											<img style="max-width: 100%;max-height: 100%;margin-top: 35%;" src="{{ url('assets/images/products/' . $products[$index]['product']->ProDefaultImg) }}" alt="{{ $products[$index]['product']->ProName }}">
										</div>
										<div class="clear"></div>
									</div>
								@endfor

								<p class="txt-g-h"> المبلغ الاجمالى :  {{ sprintf("%.2f", $vpc_Amount) }} EGP</p>
								<br>

									<div style="display:none;">
										<input type="hidden" name="Title" value = "PHP VPC 3 Party Transacion">
										<input name="virtualPaymentClientURL" size="65" value="https://migs.mastercard.com.au/vpcpay" maxlength="250"/>
										<input name="vpc_Version" value="1" size="20" maxlength="8"/>
										<input name="vpc_Command" value="pay" size="20" maxlength="16"/>
										<input name="vpc_AccessCode" value="7CF0E289" size="20" maxlength="8"/>
										<input name="vpc_MerchTxnRef" value="{{ $vpc_MerchTxnRef }}" size="20" maxlength="40"/>
										<input name="vpc_Merchant" value="534863" size="20" maxlength="16"/>
										<input name="vpc_OrderInfo" value="{{ $vpc_OrderInfo }}" size="20" maxlength="34"/>
										<input name="vpc_Amount" value="{{ $vpc_Amount * 100 }}" maxlength="10"/>
										<input name="vpc_ReturnURL" size="65" value="{{ url('buy/aaib/confirmation') }}" maxlength="250"/>
										<select name="vpc_Locale"><option SELECTED value="en_US">en_US</option><option>en_AU</option></select>
										<select name="vpc_Currency"><option SELECTED value="EGP">EGP</option></select>
									</div>

                  <h2 dir="rtl"><span>الشروط والاحكام</span></h2>
                  <div style="background-color:#eee;padding:15px;">
                    <h2 dir="rtl"><span style="color:#e74c3c">القسم 1 - شروط متجر أونلين</span></h2>
                    <p dir="rtl"><br />
                    بالموافقة على شروط الخدمة هذه، فإنك تقر بأنك فى سن الرشد في ولايتك أو إقليم إقامتك.</p>
                    <p dir="rtl">لا يجوز لك استخدام منتجاتنا لأي غرض غير قانوني أو غير مصرح به، ولا يجوز لك، في استخدام الخدمة، انتهاك أي قوانين في ولايتك القضائية.</p>
                    <p dir="rtl">يجب عليك عدم نقل أي فيروسات أو أي رمز ذات طبيعة مدمرة.</p>
                    <p dir="rtl">يؤدي أي انتهاك أو انتهاك لأي من البنود إلى الإنهاء الفوري لخدماتك.</p>
                    <br />

                    <h2 dir="rtl"><span style="color:#e74c3c">القسم 2 - الشروط العامة</span></h2>
                    <br />
                    <p dir="rtl">نحن نحتفظ بالحق في رفض الخدمة لأي شخص لأي سبب في أي وقت.</p>
                    <p dir="rtl"> أنت تدرك أن المحتوى الخاص بك (وليس بما في ذلك معلومات بطاقة الائتمان)، قد يتم نقله غير مشفر ويشمل (أ) الإرسال عبر الشبكات المختلفة. و (ب) التغييرات في المطابقة مع المتطلبات التقنية للشبكات أو الأجهزة المتصلة. يتم دائما تشفير معلومات بطاقة الائتمان أثناء النقل عبر الشبكات.</p>
                    <p dir="rtl">أنت توافق على عدم إعادة إنتاج أو تكرار أو نسخ أو بيع أو بيع أو استغلال أي جزء من الخدمة أو استخدام الخدمة أو الوصول إلى الخدمة أو أي جهة اتصال على الموقع الإلكتروني يتم من خلالها تقديم الخدمة دون الحصول على إذن خطي صريح من قبلنا .</p>
                    <p dir="rtl">يتم تضمين العناوين المستخدمة في هذه الاتفاقية للامان فقط ولن تحد أو تؤثر على هذه الشروط.<br />
                    &nbsp;</p>

                    <h2 dir="rtl"><span style="color:#e74c3c">القسم 3 - سياسة الاسترجاع</span></h2>
                    <br />
                    <p dir="rtl">يحق للمستخدم استرجاع نقوده بعد عملية الشراء اذا لم يكن المنتج المطلوب او به عيوب صناعة</p>

                  </div>

                  <br>
									<input type="submit" class="btn btn-red" NAME="SubButL" value="موافق">
									<a href="{{ url('/') }}" style="padding:7px;" class="btn btn-main">غير موافق</a>
                  <br><br>

									<div class="clear"></div>
							</form>

						</div>
					</div>
					<!-- Pages All -->
					<div class="create-pg-in-r">
						<h1 class="hint"><i class="fa fa-fw fa-bookmark-o"></i> {{ trans('site.Readthisguid') }}</h1>
						<div class="guid">
							<p><i class="fa fa-fw fa-check"></i> جميع بيانات العميل تكون امنه</p>
							<p><i class="fa fa-fw fa-check"></i> يتم اتمام العملية فى جهة البنك</p>
							<p><i class="fa fa-fw fa-check"></i> جميع البيانات تكون سرية</p>
							<p><i class="fa fa-fw fa-check"></i> يتم خصم المبلغ الاجمالى لفاتورة الشراء</p>
							<p><i class="fa fa-fw fa-check"></i> يتم الافراج عن المنتجات بعد اتمام العمليه بنجاح</p>
							<p><i class="fa fa-fw fa-check"></i> يتم احتساب النقاط الخاصه بالعميل فور استلام المنتج</p>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<!-- Ended Sections Contenets Here +++++++++++ -->





	<!-- Start Footer -->
	<div class="clear"></div>
	<footer>
	  <!-- The Social Media Icons -->
	  <div class="social">
	    <a href="https://www.facebook.com/Cayshly" class="facebook"><i class="fa fa-fw fa-facebook"></i></a>
	    <a href="https://twitter.com/cayshly" class="twitter"><i class="fa fa-fw fa-twitter"></i></a>
	    <a href="https://www.linkedin.com/company/cayshly-trading-network" class="linkedIn"><i class="fa fa-fw fa-linkedin"></i></a>
	    <a href="https://www.instagram.com/cayshly/" class="facebook"><i class="fa fa-fw fa-instagram"></i></a>
	    <a href="https://plus.google.com/115374965157329010450" class="googlePlus"><i class="fa fa-fw fa-google-plus"></i></a>
	  </div>
	  <div class="ca-links">
	    <div class="w-res">
	      <a href="{{ url('about') }}">{{ trans('sign.about') }}</a> .
	      <a href="{{ url('how-it-works') }}">{{ trans('sign.how-it-works') }}</a> .
	      <a href="{{ url('terms') }}">{{ trans('sign.terms') }}</a> .
	      <a href="{{ url('privacy') }}">{{ trans('sign.privacy') }}</a> .
	      <a href="{{ url('f-and-q') }}">{{ trans('sign.f-and-q') }}</a> .
	      <a href="{{ url('contact') }}">{{ trans('sign.contact') }}</a>
	    </div>
	  </div>
	  <div class="payment-icons">
	    <img src="{{ url('assets/images/visa-master-aaib-s.jpg') }}" >
	  </div>
	  <div class="ca-copy">
	    <div class="w-res">
	      <p>{{ trans('sign.copyright') }} &copy; {{ date('Y') }} {{ trans('sign.cayshly-com') }}</p>
	    </div>
	  </div>
	</footer>
	</div>
	<!-- Sign Scripts -->
	<script type="text/javascript" src="{{ url('assets/js/jquery-1.11.3.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/js/modal.js') }}"></script>
	{{-- <script type="text/javascript" src="{{ url('assets/libs/tipsy/tjquery.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/libs/tipsy/tipsy.js') }}"></script>  --}}
	<script type="text/javascript" src="{{ url('assets/libs/chosen/chosen.jquery.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/js/jquery.nicescroll.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/js/jquery.flexslider.js') }}"></script>
	<script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>
	<script type="text/javascript" src="{{ url('assets/js/sweetalert.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/js/jquery.bxslider.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/js/requests.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/js/main.js') }}"></script>
	</body>
	</html>
