@extends('partials.main-master')

@section('title') {{ trans('site.Notifications') }} @endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->
<div class="all-sections">
	<div class="w-res">
		<h1 style="float:left;" class="txt-g-h"><i class="fa fa-fw fa-exchange"></i> {{ trans('site.Notifications') }}</h1>
		<a style="float:right;margin-right:10px;" href="#">{{ trans('site.Clearall') }}</a>
		<div class="clear"></div>
		<div class="noti-p">
			<!-- Notification item -->
			@foreach($user_alerts as $user_alert)
				<div class="noti-p-item">
					<p class="noti-p-item-l">
						<a href="{{ url('profile/' . $user_alert->alert_from) }}">{{ $user_alert->name . ' ' . $user_alert->lastName }}</a>

						@if($user_alert->aler_type == 'new_product_from_store')

							@if(session()->get('lang') == 'en')
								ordered
								<a href="{{ url('product/' . $user_alert->alert_issue_id) }}">{{ trans('site.yourpost') }}</a>
							@else
								<a href="{{ url('product/' . $user_alert->alert_issue_id) }}">طلب المنتج الخاص بك</a>
							@endif

						@elseif($user_alert->aler_type == 'new_registration')

							@if(session()->get('lang') == 'en')
								become a member in your network
							@else
								اصبح عضو فى شبكتك
							@endif

						@endif
					</p>

					<p class="noti-p-item-r">
						<span class="noti-date">On: {{ $user_alert->created_at }}</span>
							{{-- <span class="btn btn-main">Clear</span> --}}
					</p>
				</div>
			@endforeach
			@foreach($user_notifs as $user_interaction)
				<div class="noti-p-item">
					<p class="noti-p-item-l">
						<a href="{{ url('profile/' . $user_interaction->id) }}">{{ $user_interaction->name . ' ' . $user_interaction->lastName }}</a>

						@if($user_interaction->NReactionType == 'like_post')

							@if(session()->get('lang') == 'ar')
								<a href="{{ url('show/post/' . $user_interaction->NotifActionId) }}">{{ trans('site.yourpost') }}</a>
								{{ trans('site.likedyour') }}
							@else
								{{ trans('site.likedyour') }}
								<a href="{{ url('show/post/' . $user_interaction->NotifActionId) }}">{{ trans('site.yourpost') }}</a>
							@endif

						@elseif($user_interaction->NReactionType == 'comment_post')

							@if(session()->get('lang') == 'ar')
								<a href="{{ url('show/post/' . $user_interaction->NotifActionId) }}">{{ trans('site.yourpost') }}</a>
								{{ trans('site.Commentedonyour') }}
							@else
								{{ trans('site.Commentedonyour') }}
								<a href="{{ url('show/post/' . $user_interaction->NotifActionId) }}">{{ trans('site.yourpost') }}</a>
							@endif


						@elseif($user_interaction->NReactionType == 'comment_product')

							@if(session()->get('lang') == 'ar')
								<a href="{{ url('product/' . $user_interaction->NotifActionId) }}">{{ trans('site.yourproduct') }}</a>
								{{ trans('site.Commentedonyour') }}
							@else
								{{ trans('site.Commentedonyour') }}
								<a href="{{ url('product/' . $user_interaction->NotifActionId) }}">{{ trans('site.yourproduct') }}</a>
							@endif

						@endif
					</p>

					<p class="noti-p-item-r">
						<span class="noti-date">{{ date("d",strtotime($user_interaction->NDate)) }} {{ date("M",strtotime($user_interaction->NDate)) }} {{ date("Y",strtotime($user_interaction->NDate)) }} On: {{ date("H:i",strtotime($user_interaction->NDate)) }}</span>
							{{-- <span class="btn btn-main">Clear</span> --}}
 					</p>
				</div>
			@endforeach
		</div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
