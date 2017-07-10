@extends('emails._mail_body')

@section('title') مبروك @endsection

@section('mailTitle') مبروك نقاطك زادت @endsection

@section('mailBodyContent')
  	<!-- Body -->
		<tr>
			<td colspan="2" style="padding: 0px 20px;">
  				<p style="font-size:20px;color:#333;">مبروك يا <span style="font-weight:bold;color:#e0332a;">{{ $username }}</span>, نقاطك زادت 5000 نقطة.</p>
          <p style="font-size:14px;color:#333;font-weight:bold;">دلوقتى تقدر تشترى بنقاطك اى من منتجات الموقع بما يوازى 5000 نقطة.</p>
  		</td>
		</tr>
@endsection