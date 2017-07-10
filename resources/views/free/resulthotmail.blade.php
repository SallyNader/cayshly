@extends('partials.general-master')

@section('title') {{ trans('about.about-title') }} @endsection
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css"> -->

@section('content')


<style>
table, td, th {    
    border: 1px solid #ddd;
    text-align: left;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 15px;
    text-align:center;
}
</style>

<?php 

session_start(); 

function curl_file_get_contents($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

?>

<?php
//setting parameters

include(base_path().'/public/config.php');

$auth_code = $_GET["code"];
$fields=array(
	'code'=>  urlencode($auth_code),
	'client_id'=>  urlencode($client_id),
	'client_secret'=>  urlencode($client_secret),
	'redirect_uri'=>  urlencode($redirect_uri),
	'grant_type'=>  urlencode('authorization_code')
);

$post = '';
foreach($fields as $key=>$value) { $post .= $key.'='.$value.'&'; }

$post = rtrim($post,'&');
$curl = curl_init();
curl_setopt($curl,CURLOPT_URL,'https://login.live.com/oauth20_token.srf');
curl_setopt($curl,CURLOPT_POST,5);
curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
$result = curl_exec($curl);
curl_close($curl);
$response =  json_decode($result);
$accesstoken = @$response->access_token;

$url = 'https://apis.live.net/v5.0/me/contacts?access_token='.$accesstoken;
$xmlresponse =  curl_file_get_contents($url);
$xml = json_decode($xmlresponse, true);
$contacts_email = "";

$count = 0;

$data=$xml['data'];
?>

<center>
<div class="box" style="margin-top:50px;width: 700px;text-align:center; vertical-align:middle;">
							<!-- Location -->
							<div class="profile-p-l-user-info-item">
								<h1>{{trans('site.inviteGmail')}}</h1>
								<form action="{{url('inviteSelected')}}" >
								{!! method_field('POST') !!} 

                                                  {{ csrf_field() }}
									<button type="submit" style="margin-right:50px;margin-bottom:22px;margin-top:10px"  class="btn btn-main">invite selected</button>
								<div class="user-info">
									
								

				<table style="text-align:center; vertical-align:middle;" >
    <thead>
     <!--  <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Invite</th>
      </tr> -->
    </thead>
    <tbody>
<?php

foreach ($xml['data'] as $title) {
	if(!empty($title['emails']['personal'])){
	$count++;?>




<tr>
<td><input type="checkbox" name="emails[]"  value="<?= $title['emails']['personal'] ?>"></td>
  <?php echo '<td>'.$title['emails']['personal'].'</td>'; ?>



<td style="width: 100px"><a class="btn btn-green2" href="{{url('invite/gmail/'.$title['emails']['personal'])}}" >invite</a></td>

        
				</tr>
						
	<?php
	
	

}
}
?>
</form>
&nbsp;</td>
		</tr>
	</table>
</div>
</body>