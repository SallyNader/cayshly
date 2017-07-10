@extends('partials.main-master')

@section('title') جميع المتاجر @endsection

@section('content')
	<!-- Start Sections Contenets Here +++++++++++ -->
	<div class="all-sections">
		<div class="w-res">
			<div class="banner">
				<a href="{{ url('/') }}">
					<img src="{{ url('assets/images/banners/banner-3.jpg') }}" alt="banner">
				</a>
			</div>

			<h1 class="txt-g-h"><i class="fa fa-fw fa-flag-o"></i> جميع المتاجر الموجودة على كيشلى : ({{ count($stores) }}) متجر</h1>
			<p class="txt-g-p">المتاجر المعتمدة والغير معتمدة</p>
			<br />
			<div class="box">
				@foreach($stores as $store)
					<div class="product">
						<div class="product-in">
							<div class="p-img">
								<a href="{{ url('stores/' . $store->Sid) }}">
									<img src="{{ url('assets/images/stores/' . $store->SImg) }}" title="{{ $store->SName }}" class="tooltip">
								<a>
							</div>
							<div class="p-name">
								@if(preg_match('/ا|ب|ت|ث|ج|ح|خ|د|ذ|ر|س|ش|ص|ض|ط|ظ|ع|غ|ف|ق|ك|ل|م|ن|ه|و|ي/i', $store->SName))
									<p>{{ substr($store->SName , 0, 60) }}</p>
								@else
									<p>{{ substr($store->SName , 0, 15) }}</p>
								@endif
							</div>
						</div>
					</div>
				@endforeach

				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
