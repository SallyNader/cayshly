@extends('partials.main-master')

@section('title') {{ trans('site.Edit') }} | {!! $store->SName !!} @endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->
<div class="all-sections">
	<div class="w-res">
		<h1 class="txt-g-h"><i class="fa fa-fw fa-flag-o"></i> {{ trans('site.UpdateBusinessStore') }} "{!! $store->SName !!}"</h1>
		<p class="txt-g-p">{{ trans('site.Keepyourstoreuptodate') }}</p>
		<!-- Create Page Section -->
		<div class="create-pg">
			<div class="create-pg-in">
				<!-- Update Page -->
				<div class="create-pg-in-l">
					<div class="box">
						<!-- Basic Informations -->
						{!! Form::open(['url'=>'stores/'. $store->Sid .'/edit','method'=>'post','class'=>'formEdit']) !!}
						<div class="profile-p-l-user-info-item">
							<h1><i class="fa fa-fw fa-bookmark"></i> {{ trans('site.Store Informations') }}</h1>
							<div class="user-info">
								<p>
									<b>{{ trans('site.StoreName') }} : </b>
								    <input type="text" name="store_name" autofocus id="store-name" value="{!! $store->SName !!}" />
								</p>
								
								<p>
									<b>{{ trans('site.PhoneNumber') }} : </b>
									<input type="text" name="store_phone" id="store-phone" value="{{ $store->SPhone }}"/>
								</p>						
								<p>
									<b>{{ trans('site.Email') }} : </b>
									<input type="email" name="store_email" id="store-email" value="{{ $store->SEmail }}" />
								</p>
								<p>
									<b>{{ trans('site.Website') }} : </b>
									<input type="url" name="store_website" id="store-website" value="{{ $store->SWebsite }}" />
								</p>
								<p>
									<b>{{ trans('site.StoreDescription') }} : </b>
									<textarea name="store_desc" id="store-desc" class="scrolled">{{ $store->PDescription }}</textarea>
								</p>
							</div>

							<!-- Update Page Category -->
							<label>{{ trans('site.Categories') }} :</label>
		                    <div class="form" style="padding:0;border:none;">
			                    <div class="allCat">
			                    	@foreach($categories as $category)
			                    		@foreach($storeCategories as $storeCategory)
				                    		<?php if ($category->id == $storeCategory->SCCId) {$found = 1; break; }else{ $found = 0; } ?>
			                    		@endforeach

		                    			@if($found === 1)
					                    	<label class="checkbox-g checkedit" for="page-cat">
						                    	<span><i class="fa fa-check" style="display: inline;"></i> <?= (session()->get('lang') == 'ar') ? $category->cat_name_ar : $category->cat_name_en ;?></span>
						                    	<input type="checkbox" name="store_cat[]" checked value="{{ $category->id }}" />
						                    </label>
						                @elseif($found === 0)
							            	<label class="checkbox-g notcheckedit" for="page-cat">
							                	<span><i class="fa fa-check"></i> <?= (session()->get('lang') == 'ar') ? $category->cat_name_ar : $category->cat_name_en ;?></span>
							                	<input type="checkbox" name="store_cat[]" value="{{ $category->id }}" />
							                </label>
							            @endif
				                    @endforeach
			                    </div>
							</div>

		                    <input type="hidden" name="rr" value="{{ Auth::user()->id * 50 }}"/>

							<div class="clear"></div>
		                    <input type="submit" name="page_create" id="page-create" class="btn btn-main" value="{{ trans('site.UpdateStore') }}" />
		                    <div class="clear"></div>
						</div>

						{!! Form::close() !!}
					</div>


					<!-- Delete Page -->
					<div class="box">
						<div class="profile-p-l-user-info-item">
						<h1><i class="fa fa-fw fa-bookmark"></i> {{ trans('site.DeleteStore') }}</h1>
							{!! Form::open(['url'=>'stores/' . $store->Sid . '/delete', 'method'=>'delete']) !!}
								<div style="padding:10px;">
									{{-- <p class="txt-g-p"><span class="note">NOTE : </span> Your page will be deleted in 3 days "You can undo deletion"</p> --}}
									<p class="txt-g-p"><span class="note">{{ trans('site.NOTE') }} : </span> {{ trans('site.Therelatedproducts') }}</p>
								</div>
								<input type="submit" name="_create" id="page-create" class="btn btn-red" value="{{ trans('site.DeleteStore') }}" />
								<div class="clear"></div>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
				<!-- Creation Guid -->
				<div class="create-pg-in-r">
					<h1 class="hint"><i class="fa fa-fw fa-bookmark-o"></i> {{ trans('site.Readthisguid') }}</h1>
					<div class="guid">
						<p>{{ trans('site.editstorep') }}</p>
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