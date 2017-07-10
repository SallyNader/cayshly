@extends('partials.main-master')

@section('title') {!! $store->SName !!} @endsection

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
<!-- Start Sections Contenets Here +++++++++++ -->

<div class="all-sections">
	<div class="w-res">
		<div class="page-p">
			<!-- Left -->
			<div class="page-p-l">
				<!-- Store Images -->
				<div class="page-p-l-user append">
					<!-- Store Cover -->
					<div class="page-p-l-user-i">
						@if(Auth::check())
						@if($store->SUserId == Auth::user()->id)
						<div class="opimgs">
							{!! Form::open(['url'=>'store/'. $store->Sid .'/upcvr','files'=>'true','method'=>'put', 'id'=>'ajaxForm']) !!}
							<label class="upfile" for="upcvr"><i class="fa fa-fw fa-camera"></i> {{ trans('site.Update') }} <input type="file" id="upcvr" name="upcvr"/></label>
							{!! Form::close() !!}
						</div>
						@endif
						@endif
						<img class="theUpImg onModal" src="<?= ($store->SCover != '') ? url('assets/images/storecovers/' . $store->SCover) : url('assets/images/storecovers/default.jpg') ; ?>">
					</div>

					<!-- Store Image -->
					<div class="page-p-l-user-pic appends">
						@if(Auth::check())
						@if($store->SUserId == Auth::user()->id)
						<div class="opimgs">
							{!! Form::open(['url'=>'store/'. $store->Sid .'/upimg','files'=>'true','method'=>'put', 'id'=>'ajaxForms']) !!}
							<label class="upfile" for="upimg"><i class="fa fa-fw fa-camera"></i> <input type="file" id="upimg" class="" name="upimg"/></label>
							{!! Form::close() !!}
						</div>
						@endif
						@endif
						<img class="theUpImgs onModal"  src="<?= ($store->SImg != '') ? url('assets/images/stores/' . $store->SImg) : url('assets/images/stores/default.jpg') ; ?>">
					</div>

					<div class="page-p-l-user-name">
						<p>{!! $store->SName !!}</p>
						<div style="font-size:12px;">
							{{ trans('site.numofviews') }} : <span>{{ $store->SViews }}</span>
						</div>
					</div>
				</div>

				<!-- Page Data -->
				<div class="page-p-l-user-area">
					<div class="page-p-l-user-area-heads">
						<div class="fl-left">
							<span id="p-p-about"><i class="fa fa-fw fa-flag"></i> {{ trans('site.About') }} {{ $store->SName }}</span>

							<span id="p-p-products"><i class="fa fa-fw fa-cubes"></i> {{ trans('site.Products') }}</span>

							@if(Auth::check())
							@if($store->SUserId == Auth::user()->id)<span id="p-p-manage"><i class="fa fa-fw fa-cogs"></i> {{ trans('site.ManageProducts') }}</span>@endif
							@endif

							<span id="p-p-follow">{{ $storeFollowers[0]->flwrs }} {{ trans('site.Follower') }}</span>

							@if($store->SIsPlan == 1)
							<span style="background-color:#FF9B1E;" class="planed-store"><i class="fa fa-check"></i> {{ trans('site.Premium') }}</span>
							@else
							<span style="background-color:#057db5;" class="planed-store"><i class="fa fa-check"></i> {{ trans('site.FreeStore') }}</span>
							@endif

							<span><i class="fa fa-fw fa-phone"></i> {{ $store->SPhone }}</span>
							


							@if(!empty($max)>0)

							@if($max=="star1")
							<img style="margin-bottom:-9px;" src="{!!asset('stars/1.PNG')!!}"  />

							@elseif($max=="star2")
							<img style="margin-bottom:-9px;" src="{!!asset('stars/2.PNG')!!}"  />

							@elseif($max=="star3")
							<img style="margin-bottom:-9px;" src="{!!asset('stars/3.PNG')!!}"  />

							@elseif($max=="star4")
							<img style="margin-bottom:-9px;" src="{!!asset('stars/4.PNG')!!}"  />

							@elseif($max=="star5" )
							<img style="margin-bottom:-9px;" src="{!!asset('stars/5.PNG')!!}"  />
							@else
							<img style="margin-bottom:-9px;" src="{!!asset('stars/0.PNG')!!}"  />
							@endif


							@endif
						</div>

						@if(Auth::check())
						@if($store->SUserId != Auth::user()->id)
						<div class="follow">
							@if($IsUserFollowChk == 0)
							{!! Form::open(['url'=>'store/follow', 'method'=>'put', 'class'=>'fas']) !!}
							<input type="hidden" name="store" value="{{ $store->Sid }}">
							<input type="submit" name="follow" id="follow" value="{{ trans('site.Follow') }}" />
							{!! Form::close() !!}
							@else
							{!! Form::open(['url'=>'store/unfollow', 'method'=>'put', 'class'=>'fas']) !!}
							<input type="hidden" name="store" value="{{ $store->Sid }}">
							<input type="submit" name="unfollow" id="unfollow" value="{{ trans('site.Followed') }}" />
							{!! Form::close() !!}
							@endif
						</div>
						@else
						<div class="follow">
							<a href="{{ url('stores/'. $store->Sid . '/edit') }}">{{ trans('site.UpdateStore') }}</a>
						</div>
						@endif
						@endif
						<div class="clear"></div>
					</div>
					<div class="page-p-l-user-area-info">
						<!-- About Page -->
						<div class="p-p-about">
							<div class="user-info">
								<p class="mcolor">{{ trans('site.StoreName') }} : <span>{{ $store->SName }}</span></p>
								<p class="mcolor">{{ trans('site.PhoneNumber') }} : <span>{{ $store->SPhone }}</span></p>
								<p class="mcolor">{{ trans('site.Email') }} : <span>{{ $store->SEmail }}</span> </p>
								<p class="mcolor">{{ trans('site.Website') }} : <span><a target="blank" style="color:#0A7278;" class="link" href="{{ $store->SWebsite }}" title="{{ $store->SWebsite }}">{{ $store->SWebsite }}</a></span> </p>
								<p class="mcolor">{{ trans('site.Concernedwith') }} : <span>
									@foreach($storeCats as $storeCat)
									{{ $storeCat->cat_name_en . ',' }}
									@endforeach
								</span> </p>
								<p class="mcolor">{{ trans('site.Description') }} : </p>
								<?php
								$newStr = preg_replace('!(http|ftp|scp)(s)?:\/\/[a-zA-Z0-9.?&_/]+!', "<a class='thislink' target='blank' href=\"\\0\">\\0</a>",$store->PDescription);
								?>
								<p class="mcolor"><span><pre class="pre">{!! $newStr !!}</pre></span></p>
							</div>
						</div><!-- End About Page -->

						<!-- Products Page -->

						<div class="p-p-products" id="Container">
							@if(count($products))
							<div class="subCatMenuR">
								
								<form id="ratingsForm"  action="{{url('rate-store')}}" method="post" >
									{{ csrf_field() }}

									<div class="api-fb-l" style="margin-right:12px;margin-left:12px" >{{trans('site.rateStore')}}</div>

									<br/>

									<div class="stars">
										<input type="hidden" name="store_id" value="{{$store->Sid}}" />
										<input type="radio" name="star" value="1" class="star-1" id="star-1" />
										<label class="star-1" for="star-1">1</label>
										<input type="radio" name="star" value="2" class="star-2" id="star-2" />
										<label class="star-2" for="star-2">2</label>
										<input type="radio" name="star" value="3" class="star-3" id="star-3" />
										<label class="star-3" for="star-3">3</label>
										<input type="radio" name="star" value="4" class="star-4" id="star-4" />
										<label class="star-4" for="star-4">4</label>
										<input type="radio" name="star"value="5"  class="star-5" id="star-5" />
										<label class="star-5" for="star-5">5</label>
										<span  style=""  ></span>

										<center style="background-color:white" >
											<button type="submit"  id="pComment" class="btn btn-red">تقييم</button>
											<!-- <input type="submit"  id="pComment" class="btn btn-red"  value="send rate"> -->
										</center>

									</div>

								</form>

								<br>

								@if(count($products))
								<div class="filter" data-filter="all">{{ trans('site.all') }}</div>
								@foreach($productSuCats as $productSuCat)
								<div class="filter" data-filter=".category-{{ $productSuCat->ProSubCatId }}">
									@if(session()->get('lang') == 'en')
									{{ $productSuCat->sub_cat_name_en }}
									@else
									{{ $productSuCat->sub_cat_name_ar }}
									@endif
								</div>
								@endforeach
								@endif

							</div>

							<div class="subCatMenuL">
								<!-- Product -->
								@foreach($products as $product)
								<div class="product mix category-{{ $product->ProSubCatId }}">
									<div class="product-in">
										@if(Auth::check())
										@if($store->SUserId == Auth::user()->id)
										<a href="{{ url('product/'. $product->ProId .'/edit') }}" class="editProduct"><i class="fa fa-fw fa-cogs"></i> {{ trans('site.Edit') }}</a>
										
										
														<form action="{{url('testDelete/'.$product->ProId)}}" id="formDeleteProduct"  method="post" style="padding-right:123px;padding-top:45px;" >

															{{ csrf_field() }}


<input type="hidden" name="_method" value="DELETE">

<button  data-id="{{$product->ProId}}" id="btnDeleteProduct"  class="deleteProduct" style="background-color:#E6190E;border:none;color:white">{{trans('site.deleteJ')}}
														</button>
													</form>

										@endif
										@endif
										<div class="p-img"><a href="{{ url('product/' . $product->ProId) }}"><img src="{{ url('assets/images/products/' . $product->ProDefaultImg) }}" title="{{ $product->ProName }}" class="tooltip"><a></div>
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
								@endforeach
								<div class="clear"></div>
							</div>
							@else
							<div class="nothing">{{ trans('site.ThisStorehasntupload') }}</div>
							@endif
							<div class="clear"></div>
						</div><!-- Products Page -->


						<!----------------------------------------------------->
						<!-- follow Page -->
						<div class="p-p-follow" id="Container">
							@if(count($theStoreFollowers))
							@foreach($theStoreFollowers as $allMember)
							<div class="n-m-c-i">
								<a href="{{ url('profile/' . $allMember->id) }}">
									<div class="n-m-c-i-img">
										<img src="{{ url('assets/images/profiles/' . $allMember->uImg) }}">
									</div>
									<p class="n-m-c-i-txt">{{ $allMember->name }} {{ $allMember->lastName }}</p>
								</a>
							</div>
							@endforeach
							<div class="clear"></div>
							@else
							<p style="text-align:center;">لا يوجد متابعين حتى الان</p>
							@endif
						</div><!-- Products Page -->
						<!----------------------------------------------------->

						<!-- Manage Products Page -->
						@if(Auth::check())
						@if($store->SUserId == Auth::user()->id)
						<div class="p-p-manage">
							<div class="p-p-manage-mnu">
								<span data-target="p-p-manage-c"><i class="fa fa-fw fa-plus"></i> {{ trans('site.AddNewProduct') }}</span>
								<span data-target="p-p-manage-c2"><i class="fa fa-fw fa-refresh"></i> {{ trans('site.UpdateProducts') }}</span>
							</div>
							<!-- Create New Product -->
							<div class="p-p-manage-c">
								{!! Form::open(['url'=>url('product/store'), 'method'=>'post', 'files'=>'true',]) !!}
								<fieldset class="f-s">
									<legend>{{ trans('site.BasicInformations') }}</legend>
									<div class="p-p-manage-c-1-l">
										<div class="user-info-c">
											<p>
												<label>{{ trans('site.Name') }} : </label>
												<input type="text" autofocus name="pro_name"/>
											</p>
											<p>
												<label>{{ trans('site.Subcategory') }} : </label>
												<select name="pro_subcat">
													@foreach($storeSubCats as $storeSubCat)
													@if(session()->get('lang') == 'en')
													<option value="{{ $storeSubCat->id }}">{{ $storeSubCat->sub_cat_name_en }}</option>
													@else
													<option value="{{ $storeSubCat->id }}">{{ $storeSubCat->sub_cat_name_ar }}</option>
													@endif
													@endforeach
												</select>
											</p>
											<p>
												<label>{{ trans('site.Price') }} : </label>
												<input style="min-width:280px;" type="text" name="pro_price"/>
												<select style="min-width:70px;" name="pro_pricetype">
													<option value="EGP" SELECTED>{{ trans('site.EgyptianPound') }}</option>
													<option value="USD">{{ trans('site.USDollar') }}</option>
												</select>
											</p>
											<p>
												<label>{{ trans('site.Condition') }} : </label>
												<select name="pro_condition">
													<option value="new">{{ trans('site.New') }}</option>
													<option value="used">{{ trans('site.Used') }}</option>
												</select>
											</p>
											<p>
												<label>{{ trans('site.Warranty') }} : </label>
												<input type="text" name="pro_warranty"/>
											</p>
											<p>
												<label>{{ trans('site.Description') }} : </label>
												<textarea name="pro_description" id="editor1"></textarea>
												<script>CKEDITOR.replace( 'editor1' );</script>
											</p>
										</div>
									</div>
									<div class="p-p-manage-c-1-r">
										<p>{{ trans('site.UploadImage') }} :</p>
										<label class="upload-p-image">
											<i class="fa fa-fw fa-plus"></i>
											<input type="file" id="productImage" name="pro_image"/>
										</label>
										<p>{{ trans('site.Choosethedefault') }}</p>
										<br>
										<!-- Uploaded Images Preview -->
										<div class="u-i-p"><img id="u-i-p" src=""></div>
									</div>

									<div class="clear"></div>
								</fieldset>

								<br>
								<fieldset class="f-s">
									<!-- Video -->
									<legend>{{ trans('site.ProductVideo') }}</legend>
									<div class="p-p-manage-c-2-l">
										{{-- <div class="up-vid">
										<p>Choose Video to upload " Max Video Size = 50 MB "</p>

										<label for="upload-video" class="upload-video">Choose Video
											<i class="fa fa-fw fa-camera"></i> <input type="file" id="upload-video" name="pro_video" />
										</label>
									</div> --}}
									<div class="pt-vid-url">
										<p>{{ trans('site.Putyoutubevideourl') }}</p>
										<label for="put-video">
											<input type="text" id="put-video" name="pro_vidurl" placeholder="https://www.youtube.com/embed/s6OxquPP6LM" />
										</label>
										<div class="clear"></div>
									</div>
								</div>
								<div class="p-p-manage-c-2-r">
									<h1 class="hint"><i class="fa fa-fw fa-bookmark-o"></i> {{ trans('site.Readthisguid') }}</h1>
									<div class="guid">
										<p>{{ trans('site.Youcanputavideo') }} :</p>
										<p>1 - {{ trans('site.1ststep') }}</p>
										<p>2 - {{ trans('site.2ststep') }}</p>
										<p>3 - {{ trans('site.3ststep') }}</p>
										<p>4 - {{ trans('site.4ststep') }}</p>
										<p>5 - {{ trans('site.5ststep') }}</p>
									</div>
								</div>

								<div class="clear"></div>
							</fieldset>


							<input type="hidden" name="store" value="{{ $store->Sid }}">
							<input type="hidden" name="storeStatus" value="{{ $store->SIsPlan }}">

							<input type="submit" class="btn btn-main sub" style="margin-right: 10px;" value="{{ trans('site.InsertProduct') }}">
							<div class="clear"></div>
							{!! Form::close() !!}
						</div>

						<!-- Create New Product -->
						<div class="p-p-manage-c2">
							<div class="table-container">
								<table class="table">
									<thead>
										<tr>
											<td>{{ trans('site.Name') }}</td>
											<td>{{ trans('site.Price') }}</td>
											<td>{{ trans('site.Points') }}</td>
											<td>{{ trans('site.Currency') }}</td>
											<td>{{ trans('site.Condition') }}</td>
											<td>{{ trans('site.Description') }}</td>
											<td class="center">{{ trans('site.Action') }}</td>
										</tr>
									</thead>

									<tbody>
										@if(count($products) != 0)
										@foreach($products as $product)
										<tr>
											<td>{{ $product->ProName }}</td>
											<td>{{ $product->ProPrice }}</td>
											<td>{{ $product->ProPoints }}</td>
											<td>{{ $product->ProPriceType }}</td>
											<td>{{ $product->ProCondition }}</td>
											<td>{{ $product->ProDescription }}</td>
											<td class="center">
												<a class="update" href="{{ url('product/' . $product->ProId . '/edit') }}"><i class="fa fa-fw fa-refresh"></i></a>
												

												<form action="{{url('testDelete/'.$product->ProId)}}" id="formDeleteProduct"  method="post" style="padding-right:123px;padding-top:45px;" >

															{{ csrf_field() }}


<input type="hidden" name="_method" value="DELETE">

<button  data-id="{{$product->ProId}}" id="btnDeleteProduct"  class="deleteProduct" style="background-color:#E6190E;border:none;color:white">{{trans('site.deleteJ')}}
														</button>
													</form>
											</td>
										</tr>
											<script>

										$('.deleteProduct').on('click', function(e) {
										    var inputData = $('#formDeleteProduct').serialize();

										    var dataId = $('#btnDeleteProduct').attr('data-id');
										    var parent = $(this).parent();

										    $.ajax({
										        url: '{{ url('testDelete/') }}' + '/' + dataId,
										        type: 'POST',
										        data: inputData,
										        success: function( msg ) {
										            if ( msg.status === 'success' ) {
										              console.log( msg.msg );
										                // you don't need to reload your page, just remove the row from DOM
										                parent.slideUp(300, function () {
										                    parent.closest("div").remove();
										                });
										                // setInterval(function() {
										                //     window.location.reload();
										                // }, 5900);
										            }
										        },
										        error: function( data ) {
										            if ( data.status === 422 ) {
										                console.log('Cannot delete the category');
										            }
										        }
										    });

										    return false;
										});

										</script>

										@endforeach
										@else
										<tr>
											<td colspan="7" class="nothing" style="padding:50px 0px;">
												{{ trans('site.NoProductsToDispaly') }}
											</td>
										</tr>
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div><!-- Manage Products Page -->
					@endif
					@endif
				</div>
			</div><!-- End Page Data -->
		</div>

		<!-- Right -->
		<div class="page-p-r">
			<!-- Ads Area -->
			<div class="adMN">
				@include('_parts/ads_3_side')
			</div>
		</div>
	</div>
</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
