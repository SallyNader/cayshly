@extends('partials.main-master')

@section('title') {{ trans('site.GrowMyNetwork') }} @endsection

@section('content')
	<!-- Start Sections Contenets Here +++++++++++ -->
	<div class="all-sections">
		<div class="w-res">
			<h1 class="txt-g-h"><i class="fa fa-fw fa-bar-chart"></i> {{ trans('site.askproduct') }}:</h1>
			<div class="points-p">
  <center> {{ trans('site.askdesc') }}</center>
				<form class="form" action="{{ url('invite') }}" method="post" accept-charset="utf-8">
					{{ csrf_field() }}
					<input type="email" name="email" placeholder="Put your email .." style="margin-bottom: 10px;">
          	<input type="text" name="product" placeholder="Put your product .." style="margin-bottom: 10px;">
              	<input type="text" name="person" placeholder="Put your name .." style="margin-bottom: 10px;">
                  	<input type="text" name="phone" placeholder="Put your phone .." style="margin-bottom: 10px;">
					<button class="btn-invite" type="submit">{{ trans('site.send-wish') }} <i class="fa fa-fw fa-angle-right"></i></button>
					<div class="clear"></div>
				</form>
			</div>

			<br><br>


		</div>
	</div>
	<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
