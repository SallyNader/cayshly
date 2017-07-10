@extends('partials.main-master')

@section('title') {{ trans('site.Pricing') }} @endsection

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
		<div class="g-p">
			<div class="g-p-t">
				<h1 class="g-p-t-txt">نموذج طلب اشتراك فى كيشلى</h1>
				<p>انت تختار باقة : "{{ ucfirst($package) }}"</p>
			</div>
			<div class="g-p-m">
				<!-- The Form here -->
				{!! Form::open(['url'=>'pricing/go/package', 'method'=>'post']) !!}

				<fieldset class="f-s">
					<legend>{{ trans('site.PleaseFillthisout') }}</legend>

					<div class="user-info-c">
						<p>
							<label>{{ trans('site.Name') }} : </label>
							<input type="text" autofocus name="name"/>
						</p>
						<p>
							<label>{{ trans('site.Email') }} : </label>
							<input type="text" name="email"/>
						</p>
						<p>
							<label>{{ trans('site.Phone') }} : </label>
							<input type="text" name="phone"/>
						</p>
						<p>
							<label>نوع الباقة : {{ $package }}</label>
							<input type="hidden" name="package" value="{{ $package }}" />
						</p>
					</div>

					<input type="submit" class="btn btn-main" value="{{ trans('site.Send') }}">
				</fieldset>
      <div class="clear"></div>

			{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

<br>

<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
