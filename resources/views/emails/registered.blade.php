@extends('emails._mail_body')

@section('title') {{ trans('emails.title-reg-congrats') }} @endsection

@section('mailTitle') {{ trans('emails.mailTitle-reg-congrats') }} @endsection

@section('mailBodyContent')
  	<!-- Body -->
		<tr>
			<td colspan="2" style="padding: 0px 20px;">
  				<p style="font-size:20px;color:#333;">{{ trans('emails.congratulations') }} 
  				<span style="font-weight:bold;color:#e0332a;">{{ $name }}</span>,</p>
  				<p style="font-size:14px;color:#333;">
  					{{ trans('emails.registration-accepted') }}<br>
  					{{ trans('emails.see-you') }}.
  				</p>
  		</td>
		</tr>
@endsection