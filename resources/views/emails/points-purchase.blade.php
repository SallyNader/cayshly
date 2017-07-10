@extends('emails._mail_body')

@section('title') {{ trans('emails.title-netP') }} @endsection

@section('mailTitle') {{ trans('emails.mailTitle-netP') }} @endsection

@section('mailBodyContent')
  	<!-- Body -->
		<tr>
			<td colspan="2" style="padding: 0px 20px;">
  				<p style="font-size:20px;color:#333;">{{ trans('emails.thank') }} 
  				<span style="font-weight:bold;color:#e0332a;">{{ $name }}</span>,</p>
  				
          <p style="font-size:14px;color:#333;padding-bottom:10px;margin-bottom:10px;">
  					{{ trans('emails.your-purchase-confirmed') }} 
            <span style="font-weight:bold;">{{ $points }}</span> {{ trans('emails.points') }},<br>
{{--   					{{ trans('emails.your-total-number') }} 
            <span style="font-weight:bold;">{{ $totalPoints }}</span>.
 --}}  				</p>

  		</td>
		</tr>
@endsection