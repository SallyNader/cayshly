@extends('emails._mail_body')

@section('title') {{ trans('emails.title-new-one') }} @endsection

@section('mailTitle') {{ trans('emails.mailTitle-new-one') }} @endsection

@section('mailBodyContent')
  	<!-- Body -->
		<tr>
			<td colspan="2" style="padding: 0px 20px;">
  				<p style="font-size:20px;color:#333;">{{ trans('emails.congratulations-new-one') }} 
  				<span style="font-weight:bold;color:#e0332a;">{{ $parent }}</span>,</p>
  				
          <p style="font-size:14px;color:#333;border-bottom:1px solid #dddddd;padding-bottom:10px;margin-bottom:10px;">
          <span style="font-weight:bold;color:#e0332a;">{{ $member }}</span>
  					{{ trans('emails.joined') }},<br>
  					{{ trans('emails.his-purchases') }}.
  				</p>

          <p style="font-size:14px;color:#333;font-weight:bold;">
            {{ trans('emails.build-your-network') }}.
          </p>
  		</td>
		</tr>
@endsection