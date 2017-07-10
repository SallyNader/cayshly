@extends('emails._mail_body')

@section('title') Cayshly Invitation @endsection

@section('mailTitle') Cayshly Invitation @endsection

@section('mailBodyContent')
  	<!-- Body -->
		<tr>
			<td colspan="2" style="padding: 0px 20px;">
  				<p style="font-size:18px;color:#333;">
          <a style="display:inline-block;color:#e0332a;padding:10px;text-decoration:none;" href=""><span style="font-weight:bold;">{{$person}}</span></a>requested a product </p>
                  <a style="display:inline-block;color:#e0332a;padding:10px;text-decoration:none;" href=""><span style="font-weight:bold;">his / here phone</span></a>{{$phone}}
                  <br/>
                  <a style="display:inline-block;color:#e0332a;padding:10px;text-decoration:none;" href=""><span style="font-weight:bold;">requested product</span></a>{{$product}}
                  <br/>
                  <a style="display:inline-block;color:#e0332a;padding:10px;text-decoration:none;" href=""><span style="font-weight:bold;">email</span></a>{{$email}}





          </p>
  			</td>
		</tr>
@endsection
