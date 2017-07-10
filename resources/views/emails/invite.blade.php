@extends('emails._mail_body')

@section('title') Cayshly Invitation @endsection

@section('mailTitle') Cayshly Invitation @endsection

@section('mailBodyContent')
  	<!-- Body -->
		<tr>
			<td colspan="2" style="padding: 0px 20px;">
  				<p style="font-size:18px;color:#333;">صديقك 
          <a style="display:inline-block;color:#e0332a;padding:10px;text-decoration:none;" href="{{ url('/profile/' . $uid ) }}"><span style="font-weight:bold;">{{ $fname }} {{ $lname }}</span></a> قام بدعوتك للأنضمام الى كيشلى.</p>
          <p style="font-size:18px;color:#333;">انضم لاقوى واكبر موقع تواصل تجارى الان</p>
  				<p style="font-size:18px;color:#333;">
            <a style="display:inline-block;font-size:18px;background-color:#e0332a;color:#ffffff;padding:10px;border-bottom:3px solid #333;width:200px;text-decoration:none;text-align:center;" href="{{ url('/?parent=' . $parentmail ) }}">سجل الان</a>
          </p>
  			</td>
		</tr>
@endsection