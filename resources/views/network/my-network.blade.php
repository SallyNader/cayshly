@extends('partials.main-master')

@section('title') {{ trans('site.MyNetwork') }} @endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->
<div class="all-sections">
	<div class="w-res">
		<h1 class="txt-g-h"><i class="fa fa-fw fa-sitemap"></i> {{ Auth::user()->name }}{{ trans('site.snetwork') }}</h1>
		<p class="txt-g-p">{{ trans('site.Hereyoucanfind') }}</p>
		<!-- Network Page -->
		<div class="network-p">
			<!-- Network Page Top -->
			<div class="network-p-t">
				<div class="network-p-l">
					<div class="network-p-l-total">{{ trans('site.Yourtotalnetworkmembers') }} : <span style="color: #ffffff;background-color: #e6190e;display: inline-block;padding: 0px 8px;border-radius: 10px;">{{ count($allMembers) }} </span> {{ trans('site.members') }}</div>
					<div class="network-p-l-parent">
						<div>{{ trans('site.YourParent') }}</div>
						@if($uParent != '0')
							<a href="{{ url('profile/' . $uParent->id) }}">
								<div class="ni"><img src="{{ url('assets/images/profiles/' . $uParent->uImg) }}"></div>
								<div class="ni-n">
									<p>{{ $uParent->name }} {{ $uParent->lastName }}</p>
									<p style="color:#777;font-size:12px;">Since {{ $uNetwork->created_at }}</p>
								</div>
								<div class="clear"></div>
							</a>
						@else
							<p>{{ trans('site.Youaretheposs') }}</p>
						@endif
					</div>
				</div>

				<div class="network-p-r">
					<h1 class="hint"><i class="fa fa-fw fa-bookmark-o"></i> {{ trans('site.Readthisguid') }}</h1>
					<div class="guid">
						<p>{{ trans('site.networkGuid') }}</p>					
					</div>
				</div>
				<div class="clear"></div>
			</div>
			
			<!-- Network Page Bottom -->
			<div class="network-p-b">
				<h1 class="txt-g-h">{{ trans('site.YourNetworkMembers') }} :</h1>
				<div class="n-m-c">
					@if(count($allMembers))
						@foreach($allMembers as $allMember)
							<div class="n-m-c-i">
								<a href="{{ url('profile/' . $allMember->id) }}">
									<div class="n-m-c-i-img">
										<img src="{{ url('assets/images/profiles/' . $allMember->uImg) }}">
									</div>
									<p class="n-m-c-i-txt">{{ $allMember->name }} {{ $allMember->lastName }}</p>
								</a>
							</div>
						@endforeach
						<div class="clear"></div>	
					@else
						<p>{{ trans('site.Youdonthaveanymember') }}</p>
					@endif			
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection	