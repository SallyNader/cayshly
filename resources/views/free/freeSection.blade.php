@extends('partials.main-master')

@section('title') {{ trans('site.freesction') }} @endsection

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

@section('content')

  @if(Auth::check())
    <div class="all-sections">
    	
    	<div class="w-res" style="">
        <img style="width:100%;" src="{{ url("assets/images/banner_free.jpg") }}" title="اشترى بالمجان" alt="اشترى بالمجان"/>
      </div>
      
	<div class="w-res">
		<div style="text-align:center;font-size: 16px;padding: 10px 0px;color:#FFFFFF;text-align:right;float:right;">
	              <p style="padding:5px 30px;display:inline-block;background-color:#E4493A;border-radius: 20px 0px 0px 20px;">انت تمتلك {{ $total }} نقطة فى حسابك</p>
	        </div>
	        <div style="text-align:center;font-size: 16px;padding: 10px 0px;color:#FFFFFF;text-align:right;float:left;">
	              <a href="#" style="text-decoration:none;color:#FFFFFF;padding:5px 30px;display:inline-block;background-color:#03A55F;border-radius: 0px 20px 20px 0px;">زود نقاطك اكتر واعرف ازاى؟</a>
	        </div>
	</div>
        
        <div class="clear"></div>

      <div class="w-res" style="padding:20px 0px;">
        <h1 class="txt-g-h" style="text-align:center;">{{ trans('site.freeText') }}</h1>
      </div>

      <div class="w-res">

        @if(count($proExact)>0)
          <div style="text-align:center;font-size: 16px;padding: 10px 0px;color:#FFFFFF;text-align:right;">
              <p style="padding:5px 30px;display:inline-block;background-color:#555555;border-radius: 20px 0px 0px 20px;">{{ trans('site.exactFree') }}</p>
          </div>

          <div id="latprod" class="box-w">
            <div class="flexslider carousel">
              <ul class="slides">
                @foreach($proExact as $product )
                  @if($product->ProPrice != 0)
                  <li>
                    <div class="p-slider">
                      <div class="p-slider-img">
                        <a href="{{ url('product/' . $product->ProId) }}">
                          <img src="{!!asset('assets/images/products/'.$product->ProDefaultImg)!!}" title="{{$product->ProName}}" class="tooltip">
                        </a>
                      </div>
                      <div class="p-slider-name">
                        <p>{{$product->ProName}} </p>
                      </div>
                      <div class="p-slider-data">
                        <div class="p-slider-data-price">{{$product->ProPrice}}  {{$product->ProPriceType}}</div>
                        <div class="p-data-points">{{$product->ProPoints}} Points</div>
                      </div>
                    </div>
                  </li>
                  @endif
                @endforeach
              </ul>
            </div>  
          </div>
        @endif

        <!-- ************************************************************* -->

        @if(count($protwinty)>0)
          <div style="text-align:center;font-size: 16px;padding: 10px 0px;color:#FFFFFF;text-align:right;">
              <p style="padding:5px 30px;display:inline-block;background-color:#555555;border-radius: 20px 0px 0px 20px;">{{ trans('site.twintyFree') }}</p>
          </div>
          <div id="latprod" class="box-w">
            <div class="flexslider carousel">
              <ul class="slides">
                @foreach($protwinty as $product )
                <li>
                  <div class="p-slider">
                    <div class="p-slider-img">
                      <a href="">
                        <img src="{!!asset('assets/images/products/'.$product->ProDefaultImg)!!}" title="{{$product->ProName}} " class="tooltip">
                      </a>
                    </div>
                    <div class="p-slider-name">
                      <p>{{$product->ProName}} </p>
                    </div>
                    <div class="p-slider-data">
                      <div class="p-slider-data-price">{{$product->ProPrice}}  {{$product->ProPriceType}}</div>
                      <div class="p-data-points">{{$product->ProPoints}} Points</div>
                    </div>
                  </div>
                </li>
                @endforeach 
              </ul>
            </div>  
          </div>
        @endif
        
        <!-- ************************************************************* -->

        @if(count($proFifty)>0)
          <div style="text-align:center;font-size: 16px;padding: 10px 0px;color:#FFFFFF;text-align:right;">
              <p style="padding:5px 30px;display:inline-block;background-color:#555555;border-radius: 20px 0px 0px 20px;">{{ trans('site.fiftyFree') }}</p>
          </div>
          <div id="latprod" class="box-w">
            <div class="flexslider carousel">
              <ul class="slides">
                @foreach($proFifty as $product )
                <li>
                  <div class="p-slider">
                    <div class="p-slider-img">
                      <a href="{{ url('product/' . $product->ProId) }}">
                        <img src="{!!asset('assets/images/products/'.$product->ProDefaultImg)!!}" title="{{$product->ProName}} " class="tooltip">
                      </a>
                    </div>
                    <div class="p-slider-name">
                      <p>{{$product->ProName}} </p>
                    </div>
                    <div class="p-slider-data">
                      <div class="p-slider-data-price">{{$product->ProPrice}}  {{$product->ProPriceType}}</div>
                      <div class="p-data-points">{{$product->ProPoints}} Points</div>
                    </div>
                  </div>
                </li>
                @endforeach 
              </ul>
            </div>  
          </div>
        @endif

        <!-- ************************************************************* -->

        @if(count($proHundred)>0)
        <div style="text-align:center;font-size: 16px;padding: 10px 0px;color:#FFFFFF;text-align:right;">
              <p style="padding:5px 30px;display:inline-block;background-color:#555555;border-radius: 20px 0px 0px 20px;">{{ trans('site.hundredFree') }}</p>
        </div>
        <div id="latprod" class="box-w">
          <p></p>
          <div class="flexslider carousel">
            <ul class="slides">
              @foreach($proHundred as $product )
              <li>
                <div class="p-slider">
                  <div class="p-slider-img">
                    <a href="">
                      <img src="{!!asset('assets/images/products/'.$product->ProDefaultImg)!!}" title="{{$product->ProName}} " class="tooltip">
                    </a>
                  </div>
                  <div class="p-slider-name">
                    <p>{{$product->ProName}} </p>
                  </div>
                  <div class="p-slider-data">
                    <div class="p-slider-data-price">{{$product->ProPrice}}  {{$product->ProPriceType}}</div>
                    <div class="p-data-points">{{$product->ProPoints}} Points</div>
                  </div>
                </div>
              </li>
              @endforeach 
            </ul>
          </div>  
        </div>
        @endif
    </div>
  @else

  <div class="all-sections">
    <p style="text-align: center;">لابد من التسجيل اولا لكي تتمكن من الاستفادة بهاذا القسم</p>
  </div>

  @endif

@stop