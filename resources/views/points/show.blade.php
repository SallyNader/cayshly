@extends('partials.main-master')

@section('title') {{ trans('site.MyPoints') }} @endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->
<div class="all-sections">
	<div class="w-res">
		<h1 class="txt-g-h"><i class="fa fa-fw fa-bar-chart"></i> {{ trans('site.MyPoints') }}</h1>
		<div class="points-p">
				<!-- Show Points -->
				<div class="points-my">
					<h1>{{ trans('site.AllYourPointsHistory.') }} <span>{{ trans('site.Yourtotalpoints') }} : {{ $total }}</span></h1>
					<!-- Points item -->
					@if(count($points) > 0)
					@foreach($points as $point)
						
						<div class="points-my-item">
							
							<p class="points-my-item-l">
								{{ trans('site.Yourpoints') }} <span>{{ $point->PoStatus }}</span> {{ trans('site.with') }} <span style="font-weight:bold;">{{ $point->PoAmount }}</span> @if($point->PoFrom != null)

								from <span>{{$point->PoFrom}}</span>
								@endif


								
								@if($point->PoItemNums > 0)
									
									@if($point->PoProductName == "initials")
										 From cayshly.
									@else
										 {{ trans('site.pointsfrom') }} <span>{{ $point->PoFrom }}</span> <span>{{ $point->PoItemNums }}</span> {{ trans('site.itemsof') }} 
										<a href="{{ url('product/' . $point->PoProductId) }}" class="link"><span style="font-weight:bold;">{{ $point->PoProductName }}</span></a>.
									@endif
                                
								@elseif($point->PoProductName !="invite"  and $point->PoProductName !="login" and $point->PoProductName !="complete profile") 
								
								{{ trans('site.yournetwork') }}
								
								@endif
							</p>

							<p class="points-my-item-r">
								<span class="points-my-date">{{ $point->PoDate }}</span>
							</p>
							<div class="clear"></div>
						</div>

					@endforeach

					@else
					<p class="nothing">{{ trans('site.Nothingtodisplaystart') }}</p>
					@endif
				</div>
		</div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection	