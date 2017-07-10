@extends('emails._mail_body')

@section('title') Some one commented on your post @endsection

@section('mailTitle') Some one commented on your post @endsection

@section('mailBodyContent')
  	<!-- Body -->
		<tr>
			<td colspan="2" style="padding: 0px 20px;">
  				<p style="font-size:18px;color:#333;">Hi <span style="font-weight:bold;color:#e0332a;">{{ $tousername }}</span> how are you,</p>
  				
	        <p style="font-size:14px;color:#333;border-bottom:1px solid #dddddd;padding-bottom:10px;margin-bottom:10px;">
	            <a href="{{ url('profile/' . $fromuserid) }}" style="font-weight:bold;color:#e0332a;">{{ $fromusername }}</a> commented on your post, 
	  			<a href="{{ url('show/post/' . $postid) }}" style="font-weight:bold;color:#e0332a;">{{ $postTxt }}</a>.
	  		</p>
  		</td>
		</tr>
@endsection