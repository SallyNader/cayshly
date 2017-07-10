@extends('emails._mail_body')

@section('title') {{ trans('sign.reset-your-password') }} @endsection

@section('mailTitle') {{ trans('sign.reset-your-password') }} @endsection

@section('mailBodyContent')
  	<!-- Body -->
		<tr>
			<td colspan="2" style="padding: 0px 20px;">
  				<p style="font-size:20px;color:#333;">{{ trans('emails.thank') }} 
  				<span style="font-weight:bold;color:#e0332a;">{{ $name }}</span> {{ trans('emails.rest-thank') }},</p>
  				<p style="font-size:14px;color:#333;">
  					{{ trans('emails.use-link') }}<br>
  				</p>

  				<p style="text-align:center;padding: 10px;">
  					<a style="display:inline-block;font-size:14px;background-color:#e0332a;color:#ffffff;padding:10px;border-bottom:3px solid #333;width:200px;text-decoration:none;text-align:center;" href="{{ url('reset-password-activate/' . $code) }}">
  						{{ trans('emails.rest-my-password') }}
  					</a>
  				</p>
  			</td>
		</tr>
@endsection