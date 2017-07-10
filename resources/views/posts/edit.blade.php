@extends('partials.main-master')

@section('title') {{ trans('site.EditPost') }} @endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->
<div class="all-sections">
	<div class="w-res">
		<h1 class="txt-g-h"><i class="fa fa-fw fa-flag-o"></i> {{ trans('site.Updateyourpost') }}</h1>
		<p class="txt-g-p">{{ trans('site.Makeyourpostmoretargeted') }}</p>
		<div class="create-pg">
			<div class="create-pg-in">
				<!-- Update Post -->
				<div class="create-pg-in-l">
					<div class="post">
						<div class="post-in">
							<div class="post-in-top">
							<div class="post-in-mid">
								@if(!empty($post->PImage))
									<div style="border:0px;position: relative;height: 300px;text-align: center;" class="post-in-mid-pimg">
										<img style="max-width: 100%;max-height: 100%;float:none;width:auto;" class="onModal" src="{{ url('assets/images/posts/' . $post->PImage) }}"/>
									</div>
								@endif
									<div style="border-width:0px;" class="post-create">
										{!! Form::open(['url'=>'edit/post/' . $post->PId, 'method'=>'post', 'files'=>'true']) !!}
											<textarea name="ptxt" class="input-text" required>{{ $post->PText }}</textarea>
								            <div class="post-create-bt">
								            	<label for="file">
								                	<span><i class="fa fa-fw fa-camera"></i></span>
								                	<input type="file" name="pimg" id="file" />
								                </label>
								                <input type="submit" name="submitPost" id="submitPost" value="{{ trans('site.UpdatePost') }}" /> 
								            </div>                      
								        {!! Form::close() !!}
									</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				</div>
				<!-- Creation Guid -->
				<div class="create-pg-in-r">
					<h1 class="hint"><i class="fa fa-fw fa-bookmark-o"></i> {{ trans('site.Guidtoupdateyourposts') }}</h1>
					<div class="guid">
						<p>{{ trans('site.Makeyourpostmoretargeted') }}</p>
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