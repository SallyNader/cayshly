<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml" style="font-family:Verdana, Geneva, sans-serif; margin: 0; padding: 0;">
  <head>
	<!-- If you delete this meta tag, Half Life 3 will never be released. -->
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title')</title>
  </head>
  <body style="font-family:Verdana, Geneva, sans-serif;">
  	<table cellpadding="0" cellspacing="0" style="padding:0px;margin:auto;width:650px;background-color:#f2f2f2;font-family:Verdana, Geneva, sans-serif;">
    <!-- Header -->
      <tr>
        <td colspan="2">
          <div style="background-color:#e0332a;padding: 5px 5px 20px 5px;text-align:center;">
            <h1 style="color:#fff;text-align:center;font-sisze:20px;font-weight:normal;">
              @yield('mailTitle')
            </h1>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="background-color: #f2f2f2;">
          <div style="width: 130px;margin: -20px auto 5px auto;background-color: #f2f2f2;padding: 8px 15px;border-radius: 3px;">
            <img style="width: 100%;" src="{{ url('assets/images/main/cayshly-logo.png') }}">
          </div>
        </td>
      </tr>
    <!-- End Header -->
  	@yield('mailBodyContent')
    <tr><td colspan="2" style="padding:20px;"></td></tr>
    <tr>
      <td style="text-align:left;padding: 5px 5px 5px 20px;">
        <p style="color:#666;margin:0px;padding: 0px 2px;font-size:12px;">{{ trans('emails.contact') }} +02 0100 6 1111 57</p>
        <p style="color:#666;margin:0px;padding: 2px 2px 10px 2px;font-size:12px;">info@cayshly.com</p>
      </td>
      <td style="text-align:right;padding: 5px 20px 5px 5px;">
        <p style="color:#666;margin:0px;padding:0px;font-size:12px;">
          <a style="dispaly:inline-block;" href="https://www.facebook.com/Cayshly/"><img style="width:25px;" title="Cayshly Facebook Account" src="{{ url('assets/images/main/social/Facebook.png') }}"></a>
          <a style="dispaly:inline-block;" href="https://www.instagram.com/Cayshly/"><img style="width:25px;" title="Cayshly Instagram Account" src="{{ url('assets/images/main/social/Instagram.png') }}"></a>
{{--           <a style="dispaly:inline-block;" href="#"><img style="width:25px;" title="Cayshly Twitter Account" src="{{ url('assets/images/main/social/Twitter.png') }}"></a>
          <a style="dispaly:inline-block;" href="#"><img style="width:25px;" title="Cayshly YouTube Channel" src="{{ url('assets/images/main/social/YouTube.png') }}"></a>
          <a style="dispaly:inline-block;" href="#"><img style="width:25px;" title="Cayshly GooglePlus Account" src="{{ url('assets/images/main/social/GooglePlus.png') }}"></a>
          <a style="dispaly:inline-block;" href="#"><img style="width:25px;" title="Cayshly LinkedIn Account" src="{{ url('assets/images/main/social/LinkedIn.png') }}"></a> --}}
        </p>
      </td>
    </tr>
  <!-- End Body -->
    <!-- Footer -->
      <tr>
        <td style="background-color:#e0332a;padding: 10px 10px 20px 10px;text-align:center;border-top:3px solid #333;" colspan="2">
          <p style="color:#fff;text-align:center;margin:0px;padding:0px;">
            <a style="text-decoration:none;color:#ffffff;font-size:12px;" href="{{ url('about') }}">{{ trans('sign.about') }}</a> . 
            <a style="text-decoration:none;color:#ffffff;font-size:12px;" href="{{ url('how-it-works') }}">{{ trans('sign.how-it-works') }}</a> . 
            <a style="text-decoration:none;color:#ffffff;font-size:12px;" href="{{ url('terms') }}">{{ trans('sign.terms') }}</a> . 
            <a style="text-decoration:none;color:#ffffff;font-size:12px;" href="{{ url('privacy') }}">{{ trans('sign.privacy') }}</a> . 
            <a style="text-decoration:none;color:#ffffff;font-size:12px;" href="{{ url('f-and-q') }}">{{ trans('sign.f-and-q') }}</a> . 
            <a style="text-decoration:none;color:#ffffff;font-size:12px;" href="{{ url('contact') }}">{{ trans('sign.contact') }}</a> 
          </p>
          <p style="color:#fff;text-align:center;margin:0px;padding:0px;font-size:12px;">
            {{ trans('emails.copyright') }} &copy; {{ date('Y') }} Cayshly.com
          </p>
        </td>
      </tr>
    <!-- End Footer -->
  	</table>
  </body>
</html>