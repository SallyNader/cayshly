@extends('partials.main-master')

@section('title') شكرا لكم @endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->
<div class="all-sections">
	<div class="w-res">
		<div class="g-p">
			<div class="g-p-t">
				<?php if(isset($_GET['vpc_AcqResponseCode']) && $_GET['vpc_AcqResponseCode'] == 00) : ?>
				
					<?php \DB::table('buys')->where('BNumber', $BNumber)->update(['BValidTransaction' => 1]); ?>
				
				<h1 class="g-p-t-txt">تمت العملية بنجاح</h1>
				<p>اكتمال الدفع الالكترونى</p>
				<?php else: ?>
				<h1 class="g-p-t-txt">لم تكتمل عملية الدفع لحدوث خطأ</h1>
				<?php endif; ?>				
			</div>
			<div class="g-p-m">
			<?php if(isset($_GET['vpc_AcqResponseCode']) && $_GET['vpc_AcqResponseCode'] == 00) : ?>
					<h3 style="text-align:center;">شكرا لاستخدامكم موقع كيشلى , سيتم تسليم منتجكم فى اقرب وقت
						<br>
						سيقوم قسم المتابعة بالتواصل معكم لتوصيل المنتج
					</h3>
					<?php else: ?>
				<h3 style="text-align:center;">برجاء التأكد من البطاقة واتمام الدفع بشكل صحيح</h3>
				<?php endif; ?>	
				
					<br>
					<p style="text-align:center;"><a class"filler-items hdthis" href="{{ url('/') }}">الرجوع للصفحة الرئيسية</a></p>
					
					<div style="direction:ltr;">
					<?php
					//echo "<pre>";
					//print_r($_GET);
					//echo "</pre>";					
					?>
					</div>

			</div>
		</div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
