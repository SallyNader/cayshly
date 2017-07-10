@extends('partials.main-master')

@section('title') تغير كلمة المرور @endsection

  @section('content')
    <!-- Start Sections Contenets Here +++++++++++ -->
    <div class="all-sections">
      <div class="w-res">
        <div class="g-p">
          <div class="g-p-t">
            <h1 class="g-p-t-txt">تغير كلمة المرور</h1>
          </div>
          <div class="g-p-m">
            <!-- The Form here -->
            {!! Form::open(['url'=>'change-password', 'method'=>'post', 'class'=>'form']) !!}
            <fieldset class="f-s">
              <legend>{{ trans('site.PleaseFillthisout') }}</legend>
              <div class="user-info-c">
                <p>
                  <label for="oldPass">كلمة المرور الحالية : </label>
                  <input id="oldPass" type="password" name="oldPass"/>
                </p>
                <p>
                  <label for="newPass">كلمة المرور الجديدة : </label>
                  <input id="newPass" type="password" name="newPass"/>
                </p>
              </div>
              <input type="submit" class="btn btn-main" value="حفظ">
            </fieldset>
            <div class="clear"></div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
    <!-- Ended Sections Contenets Here +++++++++++ -->
  @endsection
