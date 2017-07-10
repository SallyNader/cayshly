@extends('emails._mail_body')

@section('title') {{ trans('emails.title-netP-network') }} @endsection

@section('mailTitle') {{ trans('emails.mailTitle-netP-network') }} @endsection

@section('mailBodyContent')
  	<!-- Body -->
		<tr>
			<td colspan="2" style="padding: 0px 20px;">
  				<p style="font-size:20px;color:#333;">{{ trans('emails.congratulations') }} 
  				<span style="font-weight:bold;color:#e0332a;">Ahmed</span>, 
          {{ trans('emails.your-points-increased') }}.</p>
  				
          <p style="font-size:14px;color:#333;padding-bottom:10px;margin-bottom:10px;">
  					{{ trans('emails.one-points-increased') }}  
            <span style="font-weight:bold;">452</span> {{ trans('emails.points') }},<br>
  					{{ trans('emails.your-total-number') }} 
            <span style="font-weight:bold;">16820</span>.
  				</p>

  		</td>
		</tr>
@endsection