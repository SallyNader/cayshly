<!DOCTYPE html>
<html>
<head>
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header("Content-Type: application/xml; charset=utf-8");
  ?>

  @yield('socialMeta')

  <link rel="icon" type="image/ico" href="{{ url('favicon.ico') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/libs/tipsy/tstyle.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/css/flexslider.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/css/modal.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/css/jquery.bxslider.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/css/sweetalert.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/css/main.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/libs/chosen/chosen.css') }}">
 
 <link rel="stylesheet" href="{!!asset('stars/style2.css')!!}" />
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


  <script type="text/javascript" src="{{ url('assets/ckeditor/ckeditor.js') }}"></script>
  @if(session()->get('lang') != "en")
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/override.css') }}">
  @endif

  <!-- Mobile -->
  <link rel="stylesheet" type="text/css" href="{{ url('assets/css/main-mobile.css') }}" media="screen and (min-width:250px) and (max-width:700px)">

  <!--Google Analytics-->
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-85511466-1', 'auto');
  ga('send', 'pageview');
  </script>

   @yield('adsense')

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

  <div id="fb-root"></div>
  <script>
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  </script>

  <div class="msg" {!! session()->get('dis') !!} >{!! session()->get('msg') !!}</div>

  @if(Auth::check() && Auth::user()->uPointActive == 1)
    <div class="splash">
      <div class="splash-in">
        <div class="w-res">
          <p class="splash-txt">مبروك تم اضافة 5000 نقطة لحسابك على كيشلى تقدر تشتري بيهم منتجات من الموقع</p>
          <div class="clear"></div>
          <a class="splash-sign" href="{{ url('/points/confirm') }}">تأكيد عملية الأضافة</a>
        </div>
      </div>
    </div>
    <p class="splash-close">لا ليس الان</p>
  @endif

  {{-- Modal - Pics --}}
  <div class="modalBack"></div>
  <div class="modal">
    <span class="closed"><i class="fa  fa-fw fa-close"></i></span>
    <img src=""/>
  </div>

  <!-- Start Header -->
  <header>
    @if(Auth::check())
      @if(Auth::user()->uActive == 0)
        <div class="not-active-user"><div class="w-res"> {{trans('site.active')}}<a class="splash-sign" href="{{ url('resendcode') }}">{{trans('site.resendCode')}}</a>     </div></div>
                    <style type="text/css" media="screen">.all-sections{margin-top: 112px;}</style>
      @endif
    @else
      <div class="not-active-user">
        <div class="w-res">قم بالاشتراك الان, يمكنك تسجيل حسابك المجانى وتمتع بتجربة التصفح والشراء الكاملة
          <a style="float: none;" class="btn btn-main" href="{{ url('/') }}">تسجيل حساب جديد</a>
          <div class="clear"></div>
        </div>
      </div>
    @endif

    <input type="hidden" name="url" id="url" value="{{ url() }}" />

    <div class="h-top">
      <div class="w-res">
        @if(session()->get('lang') == 'en')
          <a href="/"><img class="logoTop" src="{{ url('assets/images/main/cayshly-logo.png') }}" alt="Cayshly" title="Cayshly" /></a>
        @else
          <a href="/"><img class="logoTop" src="{{ url('assets/images/main/cayshly-logo-ar.png') }}" alt="كيشلى" title="كيشلى" /></a>
        @endif

        @if(session()->get('lang') != 'en')
          <a class="langs" href="{{ url('lang/en') }}">En</a>
        @else
          <a class="langs" href="{{ url('lang/ar') }}">Ar</a>
        @endif

        {!! Form::open(['url'=>'/search/results/', 'method'=>'get', 'class'=>'fx searching', 'id'=>'searchInsta']) !!}
        <input type="text" autocomplete="off" name="searchWhat" id="searchWhat" placeholder="{{ trans('site.Searchfor') }}" />
        <button type="submit" name="submit" id="submit" class="btn btn-main"><i class="fa fa-fw fa-search"></i> {{ trans('site.Search') }}</button>
        <div class="searchRes w-res scrolled">
          {{-- <a href="#"><span class="searchResImg"><img src="{{ url('assets/images/profiles/' . Auth::user()->uImg) }}" alt=""></span><span class="searchResTxt">Eldahan</span></a> --}}
        </div>
        {!! Form::close() !!}
      </div>
    </div>

    <div class="h-btm">
      <div class="w-res">

        <div class="h-right">
          {{-- <a href="{{ url('/filter') }}" class="filler-items hdthis"><i class="fa fa-filter"></i> {{ trans('site.Filter') }}</a> --}}
          <a href="{{ url('/pricing') }}" class="link hdthis"> {{ trans('site.Pricing') }}</a>
             
          <div class="cat-menu">تصنيفات المنتجات <i class="fa fa-fw fa-bars"></i></div>
        
        </div>

        <div class="h-mid">
          <nav>
            <ul>
              @if(!Auth::check())
                @if(Request::is('home') || Request::is('/'))
                  <li><a class="catshow shthis"><i class="fa fa-fw fa-bars"></i></a></li>
                @endif
              @endif
 	       
              <li><a {!!(Request::is('home')) ? 'id="active"' : '' !!} href="{{ url('/home') }}"><div class="shthis"><i class="fa fa-fw fa-home"></i></div> <div class="hdtxt" >{{ trans('site.Home') }}</div></a></li>

              <!-- The User Profile, Pages, Network, Messages, Notifications -->
              @if(Auth::check())
                <li><a {!! (Request::is('profile/' . Auth::user()->id)) ? 'id="active"' : '' !!} href="{{ url('profile') }}/{{ Auth::user()->id }}"><div class="shthis"><i class="fa fa-fw fa-user"></i></div> <div class="hdtxt"> {{ trans('site.Profile') }} </div></a></li>

                <!-- My Stores -->
                <li class="drop">
                  <a {!!(Request::is('stores/create')) ? 'id="active"' : '' !!}>
                    @if(count($userStores) > 0)
                      ({{ count($userStores) }})
                    @else
                      <i class="fa fa-fw fa-map-marker" aria-hidden="true"></i>
                    @endif
                    <div class="hdtxt" >{{ trans('site.Stores') }} <i class="fa fa-fw fa-angle-down"></i></div>
                  </a>
                  <ul id="droped1" class="droped">
                    <!-- Get All User Stores -->
                    @foreach($userStores as $userStore)
                      <li><a href='{{ url("/stores/" . $userStore->Sid . "/" . $userStore->SName) }}'>{{ $userStore->SName }}</a></li>
                    @endforeach
                    
                    
                    
                    <li><a class="create-page" href="{{ url('/stores/create') }}"><i class="fa fa-fw fa-plus"></i> {{ trans('site.CreateNewStore') }}</a></li>
                 
                  </ul>
                </li>
                   

                <!-- Network -->
                <li class="drop">
                  <a {!! (Request::is('network')) ? 'id="active"' : '' !!} {!! (Request::is('grow-network')) ? 'id="active"' : '' !!}><div class="shthis"><i class="fa fa-fw fa-sitemap"></i></div> <div class="hdtxt" >{{ trans('site.Network') }} <i class="fa fa-fw fa-angle-down"></i></div></a>
                  <ul class="droped">
                    <li><a href="{{ url('/network') }}">{{ trans('site.MyNetwork') }}</a></li>
                    <li><a href="{{ url('/grow-network') }}">{{ trans('site.GrowMyNetwork') }}</a></li>
                  </ul>
                </li>

                <!-- Free Section -->
                <!--<li><a href="{{ url('free') }}"><i class="fa fa-fw fa-gift"></i> <div class="hdtxt" >{{ trans('site.free') }}</div></a></li> -->

                <!-- Create Store -->
                <li><a href="{{ url('/stores/create') }}"><i class="fa fa-fw fa-plus"></i> <div class="hdtxt" >{{ trans('site.CreateNewStore') }}</div></a></li>

                <!-- Notification -->
                <li class="drop-box unon">
                  <a>
                    @if ( (count($user_notifs) + count($user_alerts)) > Auth::user()->showed_notifications)
                      <span class="notif" data-unon="{{ (count($user_notifs) + count($user_alerts)) }}">
                        {{ (count($user_notifs) + count($user_alerts)) - Auth::user()->showed_notifications }}
                      </span>
                    @endif
                    <i class="fa fa-fw fa-bell-o"></i>
                  </a>

                  @if(!empty($user_notifs) || !!empty($user_alerts))
                    <div class="droped-box">
                      <ul>
                        <!-- user_alerts -->
                        @foreach($user_alerts as $user_alert)

                          @if($user_alert->aler_type == 'new_product_from_store')

                            <li class="not_hover">
                              <a href="{{ url('profile/' . $user_alert->alert_from) }}" style="float:left;">
                                <div class="droped-box-img">
                                  <img src="{{ url('assets/images/profiles/' . $user_alert->uImg) }}" title="{{ $user_alert->name . ' ' . $user_alert->lastName }}" />
                                </div>
                              </a>

                              <div class="droped-box-txt">
                                <a href="{{ url('product/' . $user_alert->alert_issue_id) }}">
                                  <span>{{ $user_alert->name }} طلب المنتج الخاص بك </span>
                                </a>
                                <span>{{ $user_alert->created_at }}</span>
                              </div>
                            </li>

                          @elseif($user_alert->aler_type == 'new_registration')

                            <li class="not_hover">
                              <a href="{{ url('profile/' . $user_alert->alert_from) }}">
                                <div class="droped-box-img">
                                  <img src="{{ url('assets/images/profiles/' . $user_alert->uImg) }}" title="{{ $user_alert->name . ' ' . $user_alert->lastName }}" />
                                </div>

                                <div class="droped-box-txt">
                                  <span>{{ $user_alert->name }}	اصبح عضو فى شبكتك</span>
                                  <span>{{ $user_alert->created_at }}</span>
                                </div>
                              </a>
                            </li>

                          @endif
                        @endforeach

                        <!-- user_notifs -->
                        @foreach($user_notifs as $user_interaction)

                          @if($user_interaction->NReactionType == 'like_post')

                            <li class="not_hover">
                              <a href="{{ url('show/post/' . $user_interaction->NotifActionId) }}">
                                <div class="droped-box-img">
                                  <img src="{{ url('assets/images/profiles/' . $user_interaction->uImg) }}" title="{{ $user_interaction->name . ' ' . $user_interaction->lastName }}" />
                                </div>

                                <div class="droped-box-txt">
                                  <span>{{ $user_interaction->name }} {{ trans('site.likedyour') }} {{ trans('site.yourpost') }}</span>
                                  <span>{{ $user_interaction->NDate }}</span>
                                </div>
                              </a>
                            </li>

                          @elseif($user_interaction->NReactionType == 'comment_post')

                            <li class="not_hover">
                              <a href="{{ url('show/post/' . $user_interaction->NotifActionId) }}">
                                <div class="droped-box-img">
                                  <img src="{{ url('assets/images/profiles/' . $user_interaction->uImg) }}" title="{{ $user_interaction->name . ' ' . $user_interaction->lastName }}" />
                                </div>

                                <div class="droped-box-txt">
                                  <span>{{ $user_interaction->name }} {{ trans('site.Commentedonyour') }} {{ trans('site.yourpost') }}</span>
                                  <span>{{ $user_interaction->NDate }}</span>
                                </div>
                              </a>
                            </li>

                          @elseif($user_interaction->NReactionType == 'comment_product')

                            <li class="not_hover">
                              <a href="{{ url('product/' . $user_interaction->NotifActionId) }}">
                                <div class="droped-box-img">
                                  <img src="{{ url('assets/images/profiles/' . $user_interaction->uImg) }}" title="{{ $user_interaction->name . ' ' . $user_interaction->lastName }}" />
                                </div>

                                <div class="droped-box-txt">
                                  <span>{{ $user_interaction->name }} {{ trans('site.Commentedonyour') }} {{ trans('site.yourproduct') }}</span>
                                  <span>{{ $user_interaction->NDate }}</span>
                                </div>
                              </a>
                            </li>

                          @endif
                        @endforeach

                        <li><a style="color: #fff;" class="create-page" href="{{ url('notification') }}">{{ trans('site.SeeAll') }}</a></li>
                      </ul>
                    </div>
                  @endif
                </li>

                <!-- Messages -->
                <li class="drop-box">
                  <a href="{{ url('/messaging') }}">{{-- <span class="notif">55</span> --}}<i class="fa fa-fw fa-envelope-o"></i></a>
                  {{-- <div class="droped-box">
                  <ul>
                  <li>
                  <a href="#">
                  <div class="droped-box-img"><img src="{{ url('assets/images/profiles/ahmed.jpg') }}" title="" /></div>
                  <div class="droped-box-txt"><span>Ahmed sent you a message</span></div>
                </a>
              </li>
              <li><a class="create-page" href="#">New Message</a></li>
            </ul>
          </div> --}}
        </li>

      @endif

      <!-- Shopping Cart -->
      <li>
        <a {!!(Request::is('cart')) ? 'id="active"' : '' !!} href="{{ url('cart') }}">
          @if(!empty(session()->get('carts'))) <span class="notif"> {{ (empty(session()->get('carts')))? '0' : count(session()->get('carts')) }} </span> @endif
            <i class="fa fa-fw fa-shopping-cart"></i>
            @if(!Auth::check()) <div class="hdtxt" >{{ trans('site.Shoppingcart') }}</div> @endif
            </a>
          </li>
        </ul>
      </nav>
      <div class="clear"></div>
    </div>

    <div class="h-left">
      @if(Auth::check())
        <div class="g-user">
          <div class="g-user-links">
            <a href="#" class="catshow fli shthis"><i class="fa fa-fw fa-bars"></i></a>
            {{-- <a href="{{ url('/filter') }}" class="fli shthis"><i class="fa fa-filter"></i> {{ trans('site.Filter') }}</a>
            <a href="{{ url('/pricing') }}" class="fli shthis">{{ trans('site.Pricing') }}</a> --}}
            <div class="g-user-links-name">
              <div class="g-user-img">
                @if (Auth::user()->uImg != "")
                  <img src="{{ url('assets/images/profiles/' . Auth::user()->uImg) }}" alt="{{ Auth::user()->name }}">
                @else
                  <span class="g-user-img-default">{{ substr( Auth::user()->name , 0, 1) }}</span>
                @endif
              </div>
              <span class="hdthis">{{ Auth::user()->name }}</span> <i class="fa fa-fw fa-angle-down"></i></a>
            </div>
            <div class="g-user-links-plinks">
              <div class="g-user-links-plinks-in">
                <a class="plink" href="{{ url('/profile') }}/{{ Auth::user()->id }}/edit"><i class="fa fa-fw fa-cog"></i> {{ trans('site.ProfileSettings') }}</a>
                <a class="plink" href="{{ url('/change-password') }}"><i class="fa fa-fw fa-cog"></i> تغير كلمة المرور</a>
                <a class="plink" href="{{ url('reporting/form') }}"><i class="fa fa-fw fa-check"></i> {{ trans('site.reporting') }}</a>
                 <a class="plink" href="{{ url('show-save-post') }}"><i class="fa fa-fw fa-cog"></i> {{ trans('site.savedPost') }}</a>
                    <a class="plink" href="{{ url('wishlist') }}"><i class="fa fa-fw fa-cog"></i> {{ trans('site.wishbutton') }}</a>
                <a class="plink" href="{{ url('/stores/all') }}"><i class="fa fa-fw fa-cog"></i> {{ trans('site.StoresSettings') }}</a>
                <a class="plink"href="{{ url('/points') }}"><i class="fa fa-fw fa-bar-chart"></i> {{ trans('site.MyPoints') }}</a>
                <a class="plink"href="{{ url('/request-new-product') }}"><i class="fa fa-fw fa-tag"></i> {{ trans('site.RequestProduct') }}</a>
                <a href="{{ url('/auth/logout') }}" class="logout"><i class="fa fa-fw fa-sign-out"></i> {{ trans('site.Logout') }}</a>
              </div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
      @else
        <div class="g-user">
          <div class="g-user-links">
            <a href="{{ url('/filter') }}" class="fli shthis"><i class="fa fa-filter"></i> {{ trans('site.Filter') }}</a>
            <a href="{{ url('/pricing') }}" class="fli shthis">{{ trans('site.Pricing') }}</a>
          </div>
        </div>
      @endif
    </div>

    <div class="clear"></div>
  </div>
</div>

</header>

<div class="clear"></div>

<!-- Categoryies and sub-categories -->
<div class="side-menu-over"></div>
<div class="side-menu">
  <div class="l-menu">
    <a href="?All=All" style="color: #2980b9;" class="l-menu-hed">{{ trans('site.AllCategories') }}</a>
    @foreach(DB::table('categories')->get() as $category)
      <?php
      if(session()->get('lang') != 'en'){
        if(strlen($category->cat_name_ar) < 50){
          $theCat = $category->cat_name_ar;
          $theCatT = $category->cat_name_ar;
        }
        else{
          $theCat = substr($category->cat_name_ar, 0, 50) . '..';
          $theCatT = $category->cat_name_ar;
        }
      }else {
        if(strlen($category->cat_name_en) < 18){
          $theCat = $category->cat_name_en;
          $theCatT = $category->cat_name_en;
        }
        else{
          $theCat = substr($category->cat_name_en, 0, 18) . '..';
          $theCatT = $category->cat_name_en;
        }
      }
      ?>
      <a class="l-menu-hed" title="{{ $theCatT }}">{{ $theCat }} <i class="fa fa-fw fa-angle-down"></i></a>

      <div class="l-menu-cont">
        @foreach(DB::table('subcategories')->get() as $subcategory)
          @if ($subcategory->cat_id === $category->id)
            @if(session()->get('lang') != 'en')
              @if(strlen($subcategory->sub_cat_name_ar) < 50)
                <a href='{{ url('home/?sub=' . $subcategory->id) }}' title="{{ $subcategory->sub_cat_name_ar }}"> {{ $subcategory->sub_cat_name_ar }} </a>
              @else
                <a href='{{ url('home/?sub=' . $subcategory->id) }}' title="{{ $subcategory->sub_cat_name_ar }}"> {{ substr($subcategory->sub_cat_name_ar, 0, 50) . ' ..' }} </a>
              @endif
            @else
              @if(strlen($subcategory->sub_cat_name_en) < 20)
                <a href='{{ url('home/?sub=' . $subcategory->id) }}' title="{{ $subcategory->sub_cat_name_en }}"> {{ $subcategory->sub_cat_name_en }} </a>
              @else
                <a href='{{ url('home/?sub=' . $subcategory->id) }}' title="{{ $subcategory->sub_cat_name_en }}"> {{ substr($subcategory->sub_cat_name_en, 0, 20) . ' ..' }} </a>
              @endif
            @endif
          @endif
        @endforeach
      </div>

    @endforeach
  </div>
  <div class="close-menu"><i class="fa fa-fw fa-close"></i></div>
</div>

<!-- Start All Contenets Here *********** -->
@yield('content')
<!-- Ended All Contenets Here *********** -->

<!-- Start Footer -->
<div class="clear"></div>
<footer>
  <!-- The Social Media Icons -->
  <div class="social">
    <a href="https://www.facebook.com/Cayshly" class="facebook"><i class="fa fa-fw fa-facebook"></i></a>
    <a href="https://twitter.com/cayshly" class="twitter"><i class="fa fa-fw fa-twitter"></i></a>
    <a href="https://www.linkedin.com/company/cayshly-trading-network" class="linkedIn"><i class="fa fa-fw fa-linkedin"></i></a>
    <a href="https://www.instagram.com/cayshly/" class="facebook"><i class="fa fa-fw fa-instagram"></i></a>
    <a href="https://plus.google.com/115374965157329010450" class="googlePlus"><i class="fa fa-fw fa-google-plus"></i></a>
  </div>
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
<script type="text/javascript" src="{{ url('assets/js/modal.js') }}"></script>
{{-- <script type="text/javascript" src="{{ url('assets/libs/tipsy/tjquery.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/libs/tipsy/tipsy.js') }}"></script>  --}}
<script type="text/javascript" src="{{ url('assets/libs/chosen/chosen.jquery.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/jquery.nicescroll.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/jquery.flexslider.js') }}"></script>
<script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>
<script type="text/javascript" src="{{ url('assets/js/sweetalert.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/jquery.bxslider.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/requests.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/main.js') }}"></script>
</body>
</html>
