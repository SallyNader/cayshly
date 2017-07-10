@extends('emails._mail_body')

@section('title') {{ trans('emails.title-order-confirm') }} @endsection

@section('mailTitle') {{ trans('emails.mailTitle-order-confirm') }} @endsection

@section('mailBodyContent')
  	<!-- Body -->
		<tr>
			<td colspan="2" style="padding: 0px 20px;">
  				<p style="font-size:20px;color:#333;">{{ trans('emails.hi') }} 
  				<span style="font-weight:bold;color:#e0332a;">{{ $name }}</span>,</p>
  				
          <p style="font-size:14px;color:#333;padding-bottom:10px;margin-bottom:10px;">
  					{{ trans('emails.you-received-order') }} 
            "<span style="font-weight:bold;">{{ $store }}</span>", <br>
  					{{ trans('emails.kindly-act') }}.
  				</p>

  		</td>
		</tr>
@endsection