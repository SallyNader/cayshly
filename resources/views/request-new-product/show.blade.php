@extends('partials.main-master')

@section('title') {{ trans('site.RequestNewProduct') }} @endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->
<div class="all-sections">
	<div class="w-res">
		<div class="g-p">
			<div class="g-p-t">
				<h1 class="g-p-t-txt">{{ trans('site.RequestNewProduct') }}</h1>
				<p>{{ trans('site.Tellusaboutwhatyouwish') }}</p>
			</div>
			<div class="g-p-m">
				<!-- The Form here -->				
				{!! Form::open(['url'=>'#']) !!}
				<fieldset class="f-s">
					<legend>{{ trans('site.PleaseFillthisout') }}</legend>
					<div class="user-info-c">
						<p>
							<label>{{ trans('site.Name') }} : </label>
							<input type="text" autofocus name="ahmed"/>
						</p>
						<p>
							<label>{{ trans('site.Email') }} : </label>
							<input type="text" name="ahmed"/>
						</p>
						<p>
							<label>{{ trans('site.Subjectabout') }} : </label>
							<input type="text" name="ahmed"/>
						</p>
						<p>
							<label>{{ trans('site.DescripeWhatyouneed') }} : </label>
							<textarea name="ahmed"></textarea>
						</p>
					</div>
					<input type="submit" class="btn btn-main" value="{{ trans('site.Send') }}">
				</fieldset>					
                <div class="clear"></div>
                {!! Form::close() !!}					
			</div>
		</div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection	