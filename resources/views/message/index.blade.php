@extends('partials.main-master')

@section('title') {{ trans('site.Messaging') }} @endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->
<div class="all-sections">
	<div class="w-res">
		<div class="messaging-container">
			<div class="messaging-1">
				<h1 class="box" style="padding:10px;"><i class="fa fa-fw fa-globe"></i> {{ trans('site.Yourconversations') }}</h1>
				<div class="box">
				@if(!empty($Msgs[0]) || !empty($Msgs[1]))
					@foreach($Msgs[0] as $Msg)
						<a @if($Msg->MsgId == $MsgID && $MsgID != 'NO') style="background-color: #eee;" @endif href="{{ url('messaging/thread/' . $Msg->MsgId) }}" class="msg-div">
							<div class="msg-pic"><img src="{{ url('assets/images/profiles/' . $Msg->uImg) }}" alt=""></div>
							<div class="msg-txt">
								<div class="msg-name">{{ $Msg->name . ' ' . $Msg->lastName }}</div>
								<div class="msg-hint">{{ trans('site.On') }} {{ $Msg->MsgDate }}</div>
							</div>
						</a>
					@endforeach
					@foreach($Msgs[1] as $Msg)
						<a @if($Msg->MsgId == $MsgID && $MsgID != 'NO') style="background-color: #eee;" @endif href="{{ url('messaging/thread/' . $Msg->MsgId) }}" class="msg-div">
							<div class="msg-pic"><img src="{{ url('assets/images/profiles/' . $Msg->uImg) }}" alt=""></div>
							<div class="msg-txt">
								<div class="msg-name">{{ $Msg->name . ' ' . $Msg->lastName }}</div>
								<div class="msg-hint">{{ trans('site.On') }} {{ $Msg->MsgDate }}</div>
							</div>
						</a>
					@endforeach
				@else
					<div class="nothing">{{ trans('site.Nothingtodisplay') }}</div>
				@endif
				</div>
			</div>
			<div class="messaging-2">
				<div class="box msg-with" style="padding:10px;"><i class="fa fa-comments-o" ></i> {{ trans('site.Conversationhistory') }}</a></div>
				<div class="box">
					@if(!empty($MsgsConvs) && $MsgsConvs != 'NO')
					<div class="msg-conver">
						@foreach($MsgsConvs as $MsgsConv)
						<div class="msg-ball @if($MsgsConv->id == Auth::user()->id) msg-ball-user @else msg-ball-client @endif clear">
							<div class="msg-ball-name">{{ $MsgsConv->name . ' ' . $MsgsConv->lastName }}</div>
							<div class="msg-ball-msg">{{ $MsgsConv->MsgConvTxt }}</div>
						</div>
						@endforeach
					</div>
					<div class="msg-actions">
						{!! Form::open(['url'=>'messaging/add', 'method'=>'post', 'class'=>'form']) !!}
							<textarea name="convText" placeholder="type your message .."></textarea>
							<input type="hidden" name="ms" value="{{ $MsgID }}">
							<input type="submit" class="btn btn-main" name="submit" value="Send">
							<div class="clear"></div>
						{!! Form::close() !!}
					</div>
					@elseif($MsgsConvs == 'NO')
						<div class="nothing">{{ trans('site.Nothingtodisplay') }}</div>
					@else
						<div class="msg-conver">
						</div>
						<div class="msg-actions">
							{!! Form::open(['url'=>'messaging/add', 'method'=>'post', 'class'=>'form']) !!}
								<textarea name="convText" placeholder="type your message .."></textarea>
								<input type="hidden" name="ms" value="{{ $MsgID }}">
								<input type="submit" class="btn btn-main" name="submit" value="{{ trans('site.Send') }}">
								<div class="clear"></div>
							{!! Form::close() !!}
						</div>
					@endif
				</div>
			</div>

			<div class="messaging-3">
				<!-- Ads Area -->
				<div class="adMN">
					@include('_parts.ads_1')
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection	