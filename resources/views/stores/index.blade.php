@extends('partials.main-master')

@section('title') {{ trans('site.Allyourstores') }} @endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->
<div class="all-sections">
	<div class="w-res">
		<h1 class="txt-g-h"><i class="fa fa-fw fa-refresh"></i> {{ trans('site.Allyourstores') }}</h1>
		<p class="txt-g-p">{{ trans('site.Selectthestorethat') }}</p>
		<!-- Pages Update -->
		<div class="create-pg">
			<div class="create-pg-in">
				<!-- Pages All -->
				<div class="create-pg-in-l">
					<div class="all-p-update">

						@foreach($userStores as $userStore)
	                     
							<div class="box">						
								<a href="{{ url('stores/'. $userStore->Sid .'/edit') }}">
									<div class="all-p-update-i">
										<div class="all-p-update-i-img">
										<img src="<?= ($userStore->SImg != '') ? url('assets/images/stores/' . $userStore->SImg) : url('assets/images/stores/default.jpg') ; ?>">
										</div>
										<div class="all-p-update-i-txt">
											<p class="page-name">{{ $userStore->SName }}</p>
											<p class="page-by">{{ trans('site.by') }} <span>{{ Auth::user()->name }}</span></p>
										</div>
									</div>
								</a>
							</div>

						@endforeach

					</div>
				</div>
				<!-- Pages All -->
				<div class="create-pg-in-r">
					<h1 class="hint"><i class="fa fa-fw fa-bookmark-o"></i> {{ trans('site.Readthisguid') }}</h1>
					<div class="guid">
						<p>{{ trans('site.storeIndexp1') }}</p>
						<p>{{ trans('site.storeIndexp2') }}</p>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection