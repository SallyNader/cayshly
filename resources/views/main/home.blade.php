@extends('partials.main-master')

@section('title') {{ trans('site.CayshlyHome') }} @endsection


@section('adsense')
<!--Google Adsense-->

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-6152866399790785",
    enable_page_level_ads: true
  });
</script>
@endsection

  @section('socialMeta')

    <meta name="description" content="Welcome To Cayshly.. Sign Up For Free. Build Your Network. Gain Points From Your Purchases As Well As Your Network Purhases. Redeem Your Points By Ordering Any Product/Service/Offer OR Take It Cash." />
    <!-- Twitter Card data -->
    <meta name="twitter:card" value="Welcome To Cayshly.. Sign Up For Free. Build Your Network. Gain Points From Your Purchases As Well As Your Network Purhases. Redeem Your Points By Ordering Any Product/Service/Offer OR Take It Cash.">
    <!-- Open Graph data -->
    <meta property="og:title" content="Welcome To Cayshly" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:image" content="{{ url('assets/images/main/cayshly-logo.png') }}" />
    <meta property="og:description" content="Welcome To Cayshly.. Sign Up For Free. Build Your Network. Gain Points From Your Purchases As Well As Your Network Purhases. Redeem Your Points By Ordering Any Product/Service/Offer OR Take It Cash." />

  @endsection

  @section('content')


    <!-- Start Sections Contenets Here +++++++++++ -->
    <div class="all-sections">
      <div class="toggele">
        <div class="topost"><i class="fa fa-fw fa-thumbs-o-up" aria-hidden="true"></i> Posts</div>
        <div class="toproduct togActive"><i class="fa fa-fw fa-cube" aria-hidden="true"></i> Products</div>
      </div>
      <div class="w-res">

        <!-- Section Middle -->
        <div class="sec-m">

          <!-- Create new post -->
          @include('_parts.create_post')

          @if(Auth::check())
          <!-- The Flash For Person -->
          <div class="flash-person">
            <div class="flash-person-img">
              <img src="{{ url('assets/images/flash/increase_points.jpg') }}" alt="banner">
            </div>
            <div class="flash-person-text">
              <h3>مرحبا بك يا {{ Auth::user()->name . " " . Auth::user()->lastName}}</h3>
              <p>معاك {{ $total }} نقطة تقدر تشترى بيهم من منتجات الموقع</p>

              <a href="{{ url('points') }}" class="btn btn-red">المزيد <i class="fa fa-fw fa-angle-right"></i></a>
            </div>
          </div>
          @endif

          <!-- Global posts and shares -->
          <h1 class="global-txt box" style="padding:10px;<?= (Auth::check())? '' : 'margin-top:0px;' ; ?>"><i class="fa fa-fw fa-globe"></i> {{ trans('site.Publicandglobalposts') }}</h1>

          <div id="loadPostsHere"></div>

          <!-- Load More -->
          <!-- <span class="load-more"><i class="fa fa-fw fa-refresh"></i> Load More</span> -->
        </div>
        <!-- Section Right -->
        <div class="sec-r">

          <!-- Banner Ad -->
          {{-- <div class="box">
          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <!-- Cayshly_18-12-2016_1st ad -->
          <ins class="adsbygoogle"
          style="display:block"
          data-ad-client="ca-pub-8428370033035064"
          data-ad-slot="1029867037"
          data-ad-format="auto"></ins>
          <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
      </div> --}}

      {{-- <div class="banner">
      <a href="{{ url('pricing') }}">
      <img src="{{ url('assets/images/banners/banner-1.jpg') }}" alt="banner">
    </a>
  </div> --}}

  <div class="basic-slider">
    <ul class="bxslider">
      <li><a href="#"><img src="{{ url('assets/images/banners/banner-5.jpg') }}" alt="banner"></a></li>
      <li><a href="#"><img src="{{ url('assets/images/banners/banner-3.jpg') }}" alt="banner"></a></li>
      <li><a href="#"><img src="{{ url('assets/images/banners/banner-6.jpg') }}" alt="banner"></a></li>
      <li><a href="#"><img src="{{ url('assets/images/banners/banner-4.jpg') }}" alt="banner"></a></li>
      <li><a href="#"><img src="{{ url('assets/images/banners/banner-1.jpg') }}" alt="banner"></a></li>
      <li><a href="#"><img src="{{ url('assets/images/banners/banner-2.jpg') }}" alt="banner"></a></li>
    </ul>
  </div>

  {{-- <p class="latest"><span class="new">{{ trans('site.Check') }}</span></p>
  <!-- The user's points -->
  @if(Auth::check())
  <p class="gpoints">
  <a href="#" class="pointhints-co" title="">
  <span class="pointhints">تقدر تزود نقاطك بالشراء من المنتجات المعروضه على الموقع, او ادع اصدقائك للأنضمام لكيشلى واى من مشترياتهم هيعود عليك بالنقاط</span>

  <i class="fa fa-fw fa-question-circle"></i>
</a> {{ trans('site.MyPoints') }}<span class="span">{{ $total }}</span>
</p>
@endif --}}

<!-- ************************************************************* -->
<!-- Product -->
@if(isset($_GET['sub']))
  <div class="filter">
    <p>{{ trans('site.Moreproductsandservices') }}</p>
  </div>
  <div class="box-w">
    <?php $productSum = 0; ?>
    @foreach($products as $product)
      @if($product->ProSubCatId == $_GET['sub'])
        <?php $productSum++; ?>
      @endif
    @endforeach
    @if($productSum >= 1)
      @foreach($products as $product)
        @if($product->ProSubCatId == $_GET['sub'])
          <div class="product">
            <div class="product-in">
              <div class="p-img">
                <a href="{{ url('product/' . $product->ProId) }}">
                  <img src="{{ url('assets/images/products/' . $product->ProDefaultImg) }}" title="{{ $product->ProName }}" class="tooltip">
                  <a>
                  </div>
                  <div class="p-name">
                    @if(preg_match('/ا|ب|ت|ث|ج|ح|خ|د|ذ|ر|س|ش|ص|ض|ط|ظ|ع|غ|ف|ق|ك|ل|م|ن|ه|و|ي/i', $product->ProName))
                      <p>{{ substr($product->ProName , 0, 80) }}</p>
                    @else
                      <p>{{ substr($product->ProName , 0, 15) }}</p>
                    @endif
                  </div>
                  <div class="p-data">
                    <div class="p-data-price">{{ $product->ProPrice }} {{ $product->ProPriceType }}</div>
                    <div class="p-data-points"> {{ $product->ProPoints }} {{ trans('site.Points') }}</div>
                  </div>
                  <div class="p-process">
                    <div class="p-process-details"><a href="{{ url('product/' . $product->ProId) }}">{{ trans('site.Details') }}</a></div>
                    <div class="p-process-addCurt">
                      {!! Form::open(['url'=>'cart/add/' .  $product->ProId, 'method'=>'post']) !!}
                      <button type="submit" id="p-id"><i class="fa fa-fw fa-cart-plus"></i></button>
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        @else
          <p class="nothing">{{ trans('site.!Sorry,Noproducts') }}</p>
        @endif
      </div>
    @endif

    <div class="side-note">
      <h2>احدث المتاجر المعتمدة التم تم افتتاحها</h2>
      <div class="side-note-img">
        <img src="{{ url('assets/images/icons/stores.png') }}" alt="Stores">
      </div>
    </div>

    <div class="clear"></div>

    <div id="latprod" class="box-w">
      <!-- Product -->
      <div class="flexslider carousel">
        <ul class="slides">
          <!-- Hot Product -->
          @foreach($premStores as $premStore)
            @if ($premStore->SImg != "default.jpg")
              <li>
                <div class="p-slider">
                  <div class="p-slider-img">
                    <a href="{{ url('stores/' . $premStore->Sid . "/" . $premStore->SName) }}">
                      <img src="{{ url('assets/images/stores/' . $premStore->SImg) }}" title="{{ $premStore->SName }}" class="tooltip">
                    </a>
                  </div>
                  <div class="p-slider-name">
                    @if(preg_match('/ا|ب|ت|ث|ج|ح|خ|د|ذ|ر|س|ش|ص|ض|ط|ظ|ع|غ|ف|ق|ك|ل|م|ن|ه|و|ي/i', $premStore->SName))
                      <p>{{ substr($premStore->SName , 0, 80) }}</p>
                    @else
                      <p>{{ substr($premStore->SName , 0, 15) }}</p>
                    @endif
                  </div>
                </div>
              </li>
            @endif
          @endforeach
          <!-- items mirrored twice, total of 12 -->
        </ul>
      </div>

    </div>
    <div class="clear"></div>

    <div class="show-more">
      <a class="btn btn-main-o" href="{{ url('all-stores') }}">المزيد من المتاجر</a>
    </div>
    
    
      <div class="side-note">
    <h2>المنتجات الاكثر مبيعا</h2>
    <div class="side-note-img">
      <img src="{{ url('assets/images/icons/products.png') }}" alt="Stores">
    </div>
  </div>

  <div id="latprod" class="box-w">
    <!-- Product -->
    <div class="flexslider carousel">
      <ul class="slides">
        <!-- Hot Product -->
        @for($i = 0; $i < count($hotProducts); $i++)
          <?php $rand = rand(0, count($hotProducts[$i]) - 1); ?>
          <li>
            <div class="p-slider">
              <div class="p-slider-img">
                <a href="{{ url('product/' . $hotProducts[$i][$rand]->ProId) }}">
                  <img src="{{ url('assets/images/products/' . $hotProducts[$i][$rand]->ProDefaultImg) }}" title="{{ $hotProducts[$i][$rand]->ProName }}" class="tooltip">
                </a>
              </div>
              <div class="p-slider-name">
                @if(preg_match('/ا|ب|ت|ث|ج|ح|خ|د|ذ|ر|س|ش|ص|ض|ط|ظ|ع|غ|ف|ق|ك|ل|م|ن|ه|و|ي/i', $hotProducts[$i][$rand]->ProName))
                  <p>{{ substr($hotProducts[$i][$rand]->ProName , 0, 80) }}</p>
                @else
                  <p>{{ substr($hotProducts[$i][$rand]->ProName , 0, 15) }}</p>
                @endif
              </div>
              <div class="p-slider-data">
                <div class="p-slider-data-price">{{ $hotProducts[$i][$rand]->ProPrice }} {{ $hotProducts[$i][$rand]->ProPriceType }}</div>
                <div class="p-data-points">{{ $hotProducts[$i][$rand]->ProPoints }} Points</div>
              </div>
            </div>
          </li>
        @endfor
        <!-- items mirrored twice, total of 12 -->
      </ul>
    </div>
  </div>


  <!-- Start The Categories -->
  <div class="side-note">
    <h2>الكترونيات</h2>
    <div class="side-note-img">
      <img src="{{ url('assets/images/icons/cats.png') }}" alt="Stores">
    </div>
  </div>

  <div class="super-cats">
    <div class="super-cats-l">
      <div class="super-cats-4">
        <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',11)->first()->id }}">
          <img src="{{ url('assets/images/cats/mobiles.jpg') }}">
        </a>
      </div>
      <div class="super-cats-4">
        <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',14)->first()->id }}">
          <img src="{{ url('assets/images/cats/tvs.jpg') }}">
        </a>
      </div>
      <div class="super-cats-4">
        <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',7)->first()->id }}">
          <img src="{{ url('assets/images/cats/cook.jpg') }}">
        </a>
      </div>
      <div class="super-cats-4">
        <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',7)->first()->id }}">
          <img src="{{ url('assets/images/cats/waterheater.jpg') }}">
        </a>
      </div>
    </div>
    <div class="super-cats-r">
      <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',8)->first()->id }}">
        <img src="{{ url('assets/images/cats/aircond.jpg') }}">
      </a>
    </div>

    <div class="clear"></div>
  </div>
  <!-- End The Categories -->


  <!-- Start The Categories -->
  <div class="side-note">
    <h2>منزل واثاث</h2>
    <div class="side-note-img">
      <img src="{{ url('assets/images/icons/cats.png') }}" alt="Stores">
    </div>
  </div>

  <div class="super-cats">
    <div class="super-cats-r">
      <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',16)->first()->id }}">
        <img src="{{ url('assets/images/cats/furn.jpg') }}">
      </a>
    </div>

    <div class="super-cats-l">
      <div class="super-cats-4">
        <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',3)->first()->id }}">
          <img src="{{ url('assets/images/cats/handmade.jpg') }}">
        </a>
      </div>
      <div class="super-cats-4">
        <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',2)->first()->id }}">
          <img src="{{ url('assets/images/cats/cooking.jpg') }}">
        </a>
      </div>
      <div class="super-cats-4">
        <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',17)->first()->id }}">
          <img src="{{ url('assets/images/cats/pits.jpg') }}">
        </a>
      </div>
      <div class="super-cats-4">
        <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',16)->first()->id }}">
          <img src="{{ url('assets/images/cats/painting.jpg') }}">
        </a>
      </div>
    </div>

    <div class="clear"></div>
  </div>
  <!-- End The Categories -->

  <!-- Start The Categories -->
  <div class="side-note">
    <h2>ازياء وملابس</h2>
    <div class="side-note-img">
      <img src="{{ url('assets/images/icons/cats.png') }}" alt="Stores">
    </div>
  </div>

  <div class="super-cats">
    <div class="super-cats-l">
      <div class="super-cats-4">
        <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',1)->first()->id }}">
          <img src="{{ url('assets/images/cats/women.jpg') }}">
        </a>
      </div>
      <div class="super-cats-4">
        <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',1)->first()->id }}">
          <img src="{{ url('assets/images/cats/kids.jpg') }}">
        </a>
      </div>
      <div class="super-cats-4">
        <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',1)->first()->id }}">
          <img src="{{ url('assets/images/cats/men.jpg') }}">
        </a>
      </div>
      <div class="super-cats-4">
        <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',1)->first()->id }}">
          <img src="{{ url('assets/images/cats/acc.jpg') }}">
        </a>
      </div>
    </div>
    <div class="super-cats-r">
      <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',1)->first()->id }}">
        <img src="{{ url('assets/images/cats/cat.jpg') }}">
      </a>
    </div>

    <div class="clear"></div>
  </div>
  <!-- End The Categories -->

  <!-- Start The Categories -->
  <div class="side-note">
    <h2>تصنيفات و مستلزمات اخرى</h2>
    <div class="side-note-img">
      <img src="{{ url('assets/images/icons/cats.png') }}" alt="Stores">
    </div>
  </div>

  <div class="super-cats">
    <div class="super-cats-l">
      <div class="super-cats-4">
        <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',4)->first()->id }}">
          <img src="{{ url('assets/images/cats/books.jpg') }}">
        </a>
      </div>
      <div class="super-cats-4">
        <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',6)->first()->id }}">
          <img src="{{ url('assets/images/cats/mobacc.jpg') }}">
        </a>
      </div>
      <div class="super-cats-4">
        <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',18)->first()->id }}">
          <img src="{{ url('assets/images/cats/tour.jpg') }}">
        </a>
      </div>
      <div class="super-cats-4">
        <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',40)->first()->id }}">
          <img src="{{ url('assets/images/cats/monzef.jpg') }}">
        </a>
      </div>
    </div>
    <div class="super-cats-r">
      <a href="{{ url('category') . "/" . DB::table('categories')->where('id','=',15)->first()->id }}">
        <img src="{{ url('assets/images/cats/cars.jpg') }}">
      </a>
    </div>

    <div class="clear"></div>
  </div>
  <!-- End The Categories -->


  <div class="show-more">
    <a class="btn btn-main-o cat-menu" href="#">المزيد من التصنيفات</a>
  </div>

</div>

<div class="clear"></div>
</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
