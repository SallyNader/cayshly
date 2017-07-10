@if(Auth::check())
<div class="messg-cont"></div>
<div class="disImg"><img id="disImg" src="" alt=""></div>
<div class="post-create">
  {!! Form::open(['url'=>'post/store', 'method'=>'put', 'files'=>'true', 'class'=>'afx']) !!}
<textarea name="ptxt" class="input-text" placeholder="{{ trans('site.Postproductser') }}"></textarea>
<div class="cpt-price">
    <span>{{ trans('site.Price') }} : </span><input type="text" placeholder="Put the price" name="CPTPrice">
</div>

<div class="post-create-bt">
   <label for="imgFile" class="btn btn-main" >
       <span>{{ trans('site.Choose') }} <i class="fa fa-fw fa-camera"></i></span>
       <input type="file" name="pimg" id="imgFile" />
   </label>
   <input type="submit" name="submitPost" class="btn btn-main" id="submitPost" value="Post" />
</div>
{!! Form::close() !!}
</div>
@endif
