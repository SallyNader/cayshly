@extends('partials.main-master')

@section('title') {{ trans('site.CreateNewStore') }} @endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->
<div class="all-sections">
	<div class="w-res">
		<h1 class="txt-g-h"><i class="fa fa-fw fa-flag-o"></i> {{ trans('site.CreateNewStore') }}</h1>
		<p class="txt-g-p">{{ trans('site.Tostartaddyourproducts') }}</p>
		<!-- Create Page Section -->
		<div class="create-pg">
			<div class="create-pg-in">
				<!-- Creation Process -->
				<div class="create-pg-in-l">
					<div style="background-color:#f1c40f;color:#444" class="box">
						يتم انشاء المتجر مجانا لفترة 14 يوم يمكنك من خلاله تجربة الخدمة او قم بزيارة <a style="font-weight:bold;" href="{{ url('pricing') }}">خطط الاشتراك</a> لتفعيل المتجر <br>
						لمزيد من المعلومات تواصل معنا على : 01006111157
					</div>
					
					<div class="box">
						{!! Form::open(['url'=>'stores/store', 'method' => 'post','class'=>'form cstore']) !!}
		                    <label for="store-name">
		                    	<span class="span">{{ trans('site.StoreName') }} <span class="required-g">({{ trans('site.Required') }})</span> : </span>
		                    	<input type="text" required name="store_name" id="store-name" />
		                    </label>

		                    <label for="store-phone">
		                    	<span class="span">{{ trans('site.PhoneNumber') }} <span class="required-g">({{ trans('site.Required') }})</span> :</span>
		                    	<input type="text" required name="store_phone" id="store-phone" />
		                    </label>

		                    <label for="store-email">
		                    	<span class="span">{{ trans('site.Email') }} <span class="required-g">({{ trans('site.Required') }})</span> :</span>
		                    	<input type="email" required name="store_email" id="store-email" />
		                    </label>

				    <label>{{ trans('site.CategoriesChooseRelatedCategory') }} <span class="required-g">({{ trans('site.Required') }})</span></label>
		                    <p class="showval" style="color: red;display: none;">** يجب اختيار تصنيف واحد على الاقل</p>
		                    <div class="allCat">
			                    @foreach($categories as $category)
			                    	<label class="checkbox-g notcheckedit" for="store-cat">
				                    	<span><i class="fa fa-check"></i> <?= (session()->get('lang') != 'en') ? $category->cat_name_ar : $category->cat_name_en ;?>  </span>
				                    	<input class="store_cats" type="checkbox" name="store_cat[]" value="{{ $category->id }}" />
				                    </label>
				                @endforeach
		                    </div>

							<label for="store-website">
		                    	<span class="span">{{ trans('site.Website') }} :</span>
		                    	<input type="text" name="store_website" id="store-website" />
		                    </label>

		                    <label for="store-desc">
		                    	<span class="span">{{ trans('site.StoreDescription') }} :</span>
		                    	<textarea name="store_desc" id="store-desc" class="textarea"></textarea>
		                    </label>

		                    <input type="hidden" name="rr" value="{{ Auth::user()->id * 50 }}" />

							<div class="clear"></div>
		                    <input type="submit" name="store_create" id="store-create" class="btn btn-main" value="{{ trans('site.CreateStore') }}" />
		                    <div class="clear"></div>
	                    {!! Form::close() !!}
					</div>
				</div>
				<!-- Creation Guid -->
				<div class="create-pg-in-r">
					<h1 class="hint"><i class="fa fa-fw fa-bookmark-o"></i> {{ trans('site.Readthisguid') }}</h1>
					<div class="guid">
						<p>{{ trans('site.storecreatep') }}</p>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
