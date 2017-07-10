<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @yield('socialMeta')

        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/normalize.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/flexslider-sign.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/libs/tipsy/tstyle.css') }}">
        <?php $session = (session()->get('lang'))? session()->get('lang') : Config::get('app.locale'); ?>
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/sign_') }}{{ $session }}.css">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/libs/chosen/chosen.css') }}">

        <!-- Mobile -->
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/mobile.css') }}" media="screen and (min-width:250px) and (max-width:700px)">

        <!--Google Analytics-->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
          ga('create', 'UA-85511466-1', 'auto');
          ga('send', 'pageview');
        </script>

        <!--Google Adsense-->


        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var $_Tawk_API={},$_Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/55b7885ce5c2a74e57a76720/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        <!--End of Tawk.to Script-->

    <body>
      <!-- The Social Media Icons -->
      <div class="social">
        <a href="https://www.facebook.com/Cayshly" class="facebook"><i class="fa fa-fw fa-facebook"></i></a>
        <a href="https://twitter.com/cayshly" class="twitter"><i class="fa fa-fw fa-twitter"></i></a>
        <a href="https://www.linkedin.com/company/cayshly-trading-network" class="linkedIn"><i class="fa fa-fw fa-linkedin"></i></a>
        <a href="https://www.instagram.com/cayshly/" class="facebook"><i class="fa fa-fw fa-instagram"></i></a>
        <a href="https://plus.google.com/115374965157329010450" class="googlePlus"><i class="fa fa-fw fa-google-plus"></i></a>
      </div>

        <!-- Container Class -->
        <div class="container">
            <!-- Start Header -->
            <header id="stickToTop">
                <div class="w-res">
                    <div class="left">
                    @if(session()->get('lang') != 'en')
                        <a href="/"><img src="{{ url('assets/images/main/cayshly-logo-ar.png') }}" alt="كيشلى" title="كيشلى" /></a>
                    @else
                        <a href="/"><img src="{{ url('assets/images/main/cayshly-logo.png') }}" alt="Cayshly" title="Cayshly" /></a>
                    @endif
                        <i class="fa fa-fw fa-bars fa-header-top"></i>
                        <a class="skipThis" href="{{ url('home') }}">{{ trans('sign.skipintro') }}</a>
                    </div>
                    <div class="right">
                        <a href="{{ url('home') }}" class="btn btn-red">{{ trans('sign.find-product') }}</a>
                        <a href="{{ url('how-it-works') }}" class="btn btn-red-o">{{ trans('sign.how-it-works') }}</a>
                        <a href="{{ url('about') }}" class="btn btn-red-o">{{ trans('sign.about') }}</a>
                        <a class="btn btn-call"><i class="fa fa-fw fa-phone"></i> +02 0100 6 1111 57</a>
                        @if(session()->get('lang') != 'en')
                            <a href="{{ url('lang/en') }}">{{ trans('sign.lang-en') }}</a>
                        @else
                            <a href="{{ url('lang/ar') }}">{{ trans('sign.lang-ar') }}</a>
                        @endif
                    </div>
                </div>
            </header>

            <div class="fixHieght"></div>

            @if(Request::is('/'))
            <div class="mainSlider">
                <div class="flexslider">
                  <ul class="slides">
                    <li>
                      <img src="{{ url('assets/images/main/slider/slide1.jpg') }}" />
                    </li>
                    <li>
                      <img src="{{ url('assets/images/main/slider/slide2.jpg') }}" />
                    </li>
                    <li>
                      <img src="{{ url('assets/images/main/slider/slide11.jpg') }}" />
                    </li>
                    <li>
                      <img src="{{ url('assets/images/main/slider/slide3.jpg') }}" />
                    </li>
                    <li>
                      <img src="{{ url('assets/images/main/slider/slide4.jpg') }}" />
                    </li>
                    <li>
                      <img src="{{ url('assets/images/main/slider/slide5.jpg') }}" />
                    </li>
                  </ul>
                </div>
            </div>
            @endif

            @yield('content')

            <div class="footer-behind"></div>
            <!-- Start Footer -->
            <footer>
                <div class="ca-links">
                    <div class="w-res">
                        <a href="{{ url('about') }}">{{ trans('sign.about') }}</a> .
                        <a href="{{ url('how-it-works') }}">{{ trans('sign.how-it-works') }}</a> .
                        <a href="{{ url('terms') }}">{{ trans('sign.terms') }}</a> .
                        <a href="{{ url('privacy') }}">{{ trans('sign.privacy') }}</a> .
                        <a href="{{ url('f-and-q') }}">{{ trans('sign.f-and-q') }}</a> .
                        <a href="{{ url('contact') }}">{{ trans('sign.contact') }}</a>
                    </div>
                </div>
                <div class="payment-icons">
                  <img src="{{ url('assets/images/visa-master-aaib-s.jpg') }}" >
                </div>
                <div class="ca-copy">
                    <div class="w-res">
                        <p>{{ trans('sign.copyright') }} &copy; {{ date('Y') }} {{ trans('sign.cayshly-com') }}</p>
                    </div>
                </div>
            </footer>
        </div>
        <!-- Sign Scripts -->
        <script type="text/javascript" src="{{ url('assets/js/jquery-1.11.3.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('assets/libs/tipsy/tjquery.js') }}"></script>
        <script type="text/javascript" src="{{ url('assets/libs/tipsy/tipsy.js') }}"></script>
        <script type="text/javascript" src="{{ url('assets/libs/chosen/chosen.jquery.js') }}"></script>
        <script type="text/javascript" src="{{ url('assets/js/sign.js') }}"></script>

        <script type="text/javascript" src="{{ url('assets/js/jquery.flexslider-min-sign.js') }}"></script>
        <script type="text/javascript">
        $(window).load(function() {
          $('.flexslider').flexslider({
            animation: "slide"
          });
        });
        </script>
    </body>
</html>
