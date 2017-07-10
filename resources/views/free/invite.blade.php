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

//include google api library
require_once  base_path().'/public/google-api-php-client/src/Google/autoload.php';// or wherever autoload.php is located


//Create a Google application in Google Developers Console for obtaining your Client id and Client secret.
// https://www.design19.org/blog/import-google-contacts-with-php-or-javascript-using-google-contacts-api-and-oauth-2-0/

// Your redirect uri should be on a online server. Localhost will not work.

//Important : Your redirect uri should be added in Google Developers Console , in your Authorized redirect URIs

//Declare your Google Client ID, Google Client secret and Google redirect uri in  php variables
$google_client_id = '147709673785-v2eft8fuugt6hb7sl66apc00aa4e95fo.apps.googleusercontent.com';
$google_client_secret = 'QsRkZKV7GliuA1UVkf6YQmWS';
$google_redirect_uri = 'http://cayshly.com/contact/import/google';




//setup new google client
$client = new Google_Client();
$client -> setApplicationName('My application name');
$client -> setClientid($google_client_id);
$client -> setClientSecret($google_client_secret);
$client -> setRedirectUri($google_redirect_uri);
$client -> setAccessType('online');
$client -> setScopes('https://www.google.com/m8/feeds');
$googleImportUrl = $client -> createAuthUrl();


//curl function
function curl($url, $post = "") {
	$curl = curl_init();
	$userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
	curl_setopt($curl, CURLOPT_URL, $url);
	//The URL to fetch. This can also be set when initializing a session with curl_init().
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	//TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
	//The number of seconds to wait while trying to connect.
	if ($post != "") {
		curl_setopt($curl, CURLOPT_POST, 5);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
	}
	curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
	//The contents of the "User-Agent: " header to be used in a HTTP request.
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
	//To follow any "Location: " header that the server sends as part of the HTTP header.
	curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);
	//To automatically set the Referer: field in requests where it follows a Location: redirect.
	curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	//The maximum number of seconds to allow cURL functions to execute.
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	//To stop cURL from verifying the peer's certificate.
	$contents = curl_exec($curl);
	curl_close($curl);
	return $contents;
}


//google response with contact. We set a session and redirect back
if (isset($_GET['code'])) {
	$auth_code = $_GET["code"];
	$_SESSION['google_code'] = $auth_code;
}


/*
    Check if we have session with our token code and retrieve all contacts, by sending an authorized GET request to the following URL : https://www.google.com/m8/feeds/contacts/default/full
    Upon success, the server responds with a HTTP 200 OK status code and the requested contacts feed. For more informations about parameters check Google API contacts documentation
*/
if(isset($_SESSION['google_code'])) {
	$auth_code = $_SESSION['google_code'];
	$max_results = 200;
    $fields=array(
        'code'=>  urlencode($auth_code),
        'client_id'=>  urlencode($google_client_id),
        'client_secret'=>  urlencode($google_client_secret),
        'redirect_uri'=>  urlencode($google_redirect_uri),
        'grant_type'=>  urlencode('authorization_code')
    );
    $post = '';
    foreach($fields as $key=>$value)
    {
        $post .= $key.'='.$value.'&';
    }	
    $post = rtrim($post,'&');
	
	
    $result = curl('https://accounts.google.com/o/oauth2/token',$post);
    $response =  json_decode($result);
    $accesstoken = @$response->access_token;
    $url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&alt=json&v=3.0&oauth_token='.$accesstoken;
    $xmlresponse =  curl($url);
    $contacts = json_decode($xmlresponse,true);
	
	//deg ($contacts['feed']['entry']);
	
	$return = array();
	if (!empty($contacts['feed']['entry'])) {
		foreach($contacts['feed']['entry'] as $contact) {
			
			//$contactidlink = explode('/',$contact['id']['$t']);
			//$contactId = end($contactidlink);
			
			//retrieve user photo
			if (isset($contact['link'][0]['href'])) {
				
				$url =   $contact['link'][0]['href'];
				
				$url = $url . '&access_token=' . urlencode($accesstoken);
				
				$curl = curl_init($url);

		        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		        curl_setopt($curl, CURLOPT_TIMEOUT, 15);
				curl_setopt($curl, CURLOPT_VERBOSE, true);
		
		        $image = curl_exec($curl);
		        curl_close($curl);
				
				
				//echo '<img src="data:image/jpeg;base64,'.base64_encode( $image ).'" />';
				
				    
			}
			
			//retrieve Name + email and store into array
			$return[] = array (
				'name'=> $contact['title']['$t'],
				'email' => @$contact['gd$email'][0]['address'],
				'image' => $image
			);
		}				
	}
	
	$google_contacts = $return;
						
	unset($_SESSION['google_code']);
	



	//Now that we have the google contacts stored in an array, display all in a table
	if(!empty($google_contacts)) {
		
			?>


								<!-- Silver -->
<center>
<div class="box" style="width: 700px;text-align:center; vertical-align:middle;">
							<!-- Location -->
							<div class="profile-p-l-user-info-item">
								<h1>{{trans('site.inviteGmail')}}</h1>
								<form action="{{url('inviteSelected')}}" >
								{!! method_field('POST') !!} 

                                                  {{ csrf_field() }}
									<button style="margin-right:50px;margin-bottom:22px;margin-top:10px"  type="submit"  class="btn btn-main">invite selected</button>
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
		foreach ($google_contacts as $contact) {
			if(!empty($contact['email'])){
			// echo '<tr>';
			// echo '<td>'.$contact['name'].'</td>';
		
			// echo '<td>'.$contact['email'].'</td>';
			
			
			
			?>
				<tr>
<td><input type="checkbox" name="emails[]"  value="<?= $contact['email'] ?>"></td>
  <?php echo '<td>'.$contact['email'].'</td>'; ?>



<td style="width: 100px"><a class="btn btn-green2" href="{{url('invite/gmail/'.$contact['email'])}}" >invite</a></td>

        
				</tr>
						
						

			<?php
			
		
			// echo '<td>';
			// echo "";
			// echo '</td>';
		    // echo '</tr>';
		}
		}
		?>
		
		</form>

		 </tbody>
  </table>

 </div>
							</div>
						</div>
						</center>
		<?php

		
	}
						
}
					
?>



	<div class="aboutBanner">
		<h1>{{ trans('about.cayshly-online') }}</h1>
		<p>{{ trans('about.cayshly-trade') }}</p>
        <br>
        <a href="<?php echo $googleImportUrl; ?>"  class="btn btn-green2">{{ trans('site.gmail') }}</a>
	</div>
		<!-- Start Main About -->
		<div class="aboutBody">
			<!-- <div class="whiteDiv">
				<div class="w-res">
					<div class="aboutLeft">
						<h2>{{ trans('about.sell') }}</h2>
						<p>{{ trans('about.sell-any') }}</p>
						<p>{{ trans('about.sell-this') }}</p>
						<p>{{ trans('about.sell-you') }}</p>
					</div>
					<div class="aboutRight">
						<img src="{{ url('assets/images/main/sell.png') }}" />
					</div>
					<div class="clear"></div>
				</div>
			</div> -->

		<!-- 	<div class="grayDiv">
				<div class="w-res">
					<div class="aboutLeft">
						<img src="{{ url('assets/images/main/buy.png') }}">					
					</div>
					<div class="aboutRight">
						<h2>{{ trans('about.buy') }}</h2>
						<p>{{ trans('about.buy-if') }}</p>
						<p>{{ trans('about.buy-steps') }}<br>
						{{ trans('about.buy-steps1') }}<br>
						{{ trans('about.buy-steps2') }}</p>
						<p>{{ trans('about.buy-you') }}</p>
						<p>{{ trans('about.buy-cannot') }} : <b>orders@cayshly.com</b></p>
					</div>
					<div class="clear"></div>
				</div>
			</div> -->

	<!-- 		<div class="whiteDiv">
				<div class="w-res">
					<div class="aboutLeft">
						<h2>{{ trans('about.share-comment-review') }}</h2>
						<p>{{ trans('about.share-as') }}</p>
						<p>{{ trans('about.share-users') }}</p>
					</div>
					<div class="aboutRight">
						<img src="{{ url('assets/images/main/share.jpg') }}">
					</div>
					<div class="clear"></div>
				</div>
			</div> -->
<!-- 
			<div class="grayDiv">
				<div class="w-res">
					<div class="aboutLeft">
						<img src="{{ url('assets/images/main/ask.png') }}">					
					</div>
					<div class="aboutRight">
						<h2>{{ trans('about.ask-before') }}</h2>
						<p>{{ trans('about.as-a-user') }}</p>
					</div>
					<div class="clear"></div>
				</div>
			</div>
 -->
		<!-- 	<div class="centerDiv whiteDiv">
				<div class="w-res">
					<h2>{{ trans('about.gain-points') }}</h2>
					<p>{{ trans('about.the-moment') }}</p>
					<br>
					<a href="how-it-works" class="btn btn-red">{{ trans('sign.how-it-works') }}</a>
				</div>
			</div>
		</div>
		<div class="aboutBody whiteDiv">
			<div class="w-res">
				<p>{{ trans('about.any-reg') }}</p>
				<p>{{ trans('about.any-of') }}</p>
				<p><b>{{ trans('about.example') }}:</b><br>{{ trans('about.account-a-has') }}</p>
				
				<p>{{ trans('about.any-user-can') }}:<br>
				{{ trans('about.online-pur') }}<br>
				{{ trans('about.reimburse-the-points') }}</p>
				<img class="img" src="{{ url('assets/images/main/happy-people.jpg') }}">
			</div>
		</div> -->
@endsection
