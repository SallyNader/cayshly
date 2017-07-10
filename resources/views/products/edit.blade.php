@extends('partials.main-master')

@section('title') {{ trans('site.Edit') }} | {{ $product->ProName }} @endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->

<div class="all-sections">
	<div class="w-res">
		<div class="page-p">
			<!-- Left -->
			<div class="page-p-l">
				<!-- Page Data -->
				<div class="page-p-l-user-area">
					<!-- Update Product -->
					<div  class="box" style="padding:10px;">
						<a href="{{ url('stores/' . $product->ProStoreId) }}" class="btn btn-main">{{ trans('site.Gobacktoyourstore') }}</a>
						<a href="{{ url('product/' . $product->ProId) }}" class="btn btn-red fl-left">{{ trans('site.Showtheproduct') }}</a>
						<div class="clear"></div>
					</div>
					<div class="box">
						<div class="p-p-manage-c rm-before">
							<br>
							<h1 class="txt-g-h center">{{ trans('site.Updateproduct') }} : "{{ $product->ProName }}"</h1>
							<br>
							{!! Form::open(['url'=>url('product/' . $product->ProId . '/edit'), 'method'=>'post', 'files'=>'true',]) !!}
							<fieldset class="f-s">
								<legend>{{ trans('site.BasicInformations') }}</legend>
								<div class="p-p-manage-c-1-l">
									<div class="user-info-c">
										<p>
											<label>{{ trans('site.Name') }} : </label>
											<input type="text" autofocus name="pro_name" value="{{ $product->ProName }}" />
										</p>
										<p>
											<label>{{ trans('site.Subcategory') }} : </label>
											<select name="pro_subcat">
												@for($i=0; $i < count($storeSubCats); $i++)
													@for($j=0; $j < count($storeSubCats[$i]); $j++)
														@if($storeSubCats[$i][$j]->id == $product->ProSubCatId)
															@if(session()->get('lang') == 'en')
																<option value="{{ $storeSubCats[$i][$j]->id }}">&#10004; {{ $storeSubCats[$i][$j]->sub_cat_name_en }}</option>
															@else
																<option value="{{ $storeSubCats[$i][$j]->id }}">&#10004; {{ $storeSubCats[$i][$j]->sub_cat_name_ar }}</option>
															@endif
														@endif
													@endfor
												@endfor
												
												@for($i=0; $i < count($storeSubCats); $i++)
													@for($j=0; $j < count($storeSubCats[$i]); $j++)
														@if(session()->get('lang') == 'en')
															<option value="{{ $storeSubCats[$i][$j]->id }}">{{ $storeSubCats[$i][$j]->sub_cat_name_en }}</option>
														@else
															<option value="{{ $storeSubCats[$i][$j]->id }}">{{ $storeSubCats[$i][$j]->sub_cat_name_ar }}</option>
														@endif
													@endfor
												@endfor
												{{-- @foreach($storeSubCats as $storeSubCat)
													@if($storeSubCat->id != $product->ProSubCatId)
														<option value="{{ $storeSubCat->id }}">{{ $storeSubCat->sub_cat_name_en }}</option>
													@endif 
												@endforeach --}}
											</select>
										</p>
										<p>
											<label>{{ trans('site.Price') }} : </label>
											<input style="min-width:280px;" type="text" name="pro_price" value="{{ $product->ProPrice }}" />
											<select style="min-width:70px;" name="pro_pricetype">
												@if($product->ProPriceType == 'EGP')
												<option value="EGP">{{ trans('site.EgyptianPound') }}</option>
												<option value="USD">{{ trans('site.USDollar') }}</option>
												@else
												<option value="USD">{{ trans('site.New') }}{{ trans('site.USDollar') }}</option>
												<option value="EGP">{{ trans('site.New') }}{{ trans('site.EgyptianPound') }}</option>
												@endif
											</select>
										</p>
										<p>
											<label>{{ trans('site.Condition') }} : </label>
											<select name="pro_condition">
												@if($product->ProCondition == 'new')
												<option value="new">{{ trans('site.New') }}</option>
												<option value="used">{{ trans('site.Used') }}</option>
												@else
												<option value="used">{{ trans('site.Used') }}</option>
												<option value="new">{{ trans('site.New') }}</option>
												@endif
											</select>
										</p>
										<p>
											<label>{{ trans('site.Warranty') }} : </label>
											<input type="text" name="pro_warranty"  value="{{ $product->ProWarranty }}"/>
										</p>
										<p>
											<label>{{ trans('site.Description') }} : </label>
											<textarea name="pro_description" id="editor1">{{ $product->ProDescription }}</textarea>
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
									<p>{{ trans('site.Choosethedefaultimage') }}</p>
									<br>
									<!-- Uploaded Images Preview -->
									<div class="u-i-p"><img id="u-i-p" src="{{ url('assets/images/products/' . $product->ProDefaultImg) }}"></div>
								</div>

								<div class="clear"></div>
							</fieldset>
							<br>

							@unless(!count($images)>0)
							<fieldset class="f-s">
								<!-- Video -->
								<legend>{{ trans('site.imagesOfproduct') }}</legend>
									<!-- <div class="p-p-manage-c-2-l">

										<div class="pt-vid-url">
											<p>{{ trans('site.Putyoutubevideourl') }}</p>
											<label for="put-video">
												<input type="text" id="put-video" name="pro_vidurl" value="{{ $product->ProVideo }}" />
											</label>
											<div class="clear"></div>
										</div>
									</div> -->
								<!-- <div class="p-p-manage-c-2-r">
									<h1 class="hint"><i class="fa fa-fw fa-bookmark-o"></i> {{ trans('site.Readthisguid') }}</h1>
									<div class="guid">
										<p>{{ trans('site.Youcanputavideo') }} :</p>
										<p>1 - {{ trans('site.1ststep') }}</p>
										<p>2 - {{ trans('site.2ststep') }}</p>
										<p>3 - {{ trans('site.3ststep') }}</p>
										<p>4 - {{ trans('site.4ststep') }}</p>
										<p>5 - {{ trans('site.5ststep') }}</p>
									</div>
								</div> -->


								@foreach($images  as $image)

								<div class="u-i-p" style="width:120px;height:140px" ><img  style="width:130px;height:100px" id="u-i-p" src="{{ url('assets/images/products/' . $image->imagePath) }}">



									<a href="{{ url('delete/image/' . $image->id) }}"  class="btn btn-red fl-left" style="width:110px;background-color: #e74c3c;color: #fff;border-color: #c40000;"  >{{ trans('site.YesDeleteThisProducts') }}</a>

								</div>
								@endforeach

								<div class="clear"></div>
							</fieldset>
							@endunless

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
												<input type="text" id="put-video" name="pro_vidurl" value="{{ $product->ProVideo }}" />
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
							
							<input type="hidden" name="storeStatus" value="{{ $store->SIsPlan }}">
							<input type="submit" class="btn btn-main sub" style="margin-right: 10px;" value="{{ trans('site.Updateproduct') }}">
							<div class="clear"></div>
							{!! Form::close() !!}	
						</div>

						<div class="p-p-manage-c rm-before">
							{!! Form::open(['url'=>url('product/' . $product->ProId . '/delete'), 'method'=>'delete']) !!}
							<fieldset class="f-s">
								<legend>{{ trans('site.Deletethisproduct') }}</legend>
								<p>{{ trans('site.Noteyouwilldeletethis') }}</p>
								<input type="submit" class="btn btn-red" value="{{ trans('site.YesDeleteThisProduct') }}">
							</fieldset>
							<div class="clear"></div>
							{!! Form::close() !!}	
						</div>
					</div>
				</div><!-- End Page Data -->
			</div>

			<!-- Right -->
			<div class="page-p-r">
				<!-- Ads Area -->
				<div class="adMN">
					<div class="ad-s-1">
						<a href="#"><img src="{{ url('assets/images/ads/L.jpg') }}"></a>
					</div>	

					<div class="ad-s-1">
						<a href="#"><img src="{{ url('assets/images/ads/of.png') }}"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection