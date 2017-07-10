@extends('partials.main-master')

@section('title') {{ trans('site.reportingForm') }} @endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->
<div class="all-sections">
	<div class="w-res">
		<div class="g-p">
			<div class="g-p-t">
				<h1 class="g-p-t-txt">{{ trans('site.reportingForm') }}</h1>
				<p>{{ trans('site.reportingDesc') }}</p>
			</div>
			<div class="g-p-m">
				<!-- The Form here -->
				{!! Form::open(['url'=>'reporting/send']) !!}
        {{ csrf_field() }}
				<fieldset class="f-s">
					<legend>{{ trans('site.PleaseFillthisout') }}</legend>
					<div class="user-info-c">
						<p>
							<label>{{ trans('site.Name') }} : </label>
							<input type="text" autofocus name="name"/>
						</p>
						<p>
							<label>{{ trans('site.Email') }} : </label>
							<input type="text" name="email"/>
						</p>

<p>


  <label>{{ trans('site.phoneNo') }} : </label>
  <input type="text" name="phone"/>
</p>

            <p>

              <lebel>{{trans('site.typeOfProblem')}}</lebel>

              <select name="problem">

                <option value="Error">{{trans('site.errorProblem')}}</option>
                <option value="Slow">{{trans('site.slowProblem')}}</option>


              </select>

            </p>
						<!-- <p>

							<label>{{ trans('site.Subjectabout') }} : </label>
							<input type="text" name="subject"/>
						</p> -->
						<p>
							<label>{{ trans('site.DescripeWhatyouneed') }} : </label>
							<textarea name="desc"></textarea>
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
