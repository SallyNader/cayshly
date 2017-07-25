@extends('partials.main-master')

@section('title') {{ $name . " " . $lastName}} @endsection

@section('content')
<!-- Start Sections Contenets Here +++++++++++ -->
<div class="all-sections">
	<div class="w-res">
		<div class="profile-p">
			<div class="profile-p-l">
				<div class="profile-p-l-user append">
					<div class="profile-p-l-user-i">
						@if(Auth::check())
							@if(Auth::user()->id == $id)
								<div class="opimgs">
									{!! Form::open(['url'=>'profile/'. $id .'/upcvr','files'=>'true','method'=>'put', 'id'=>'ajaxForm']) !!}
										<label class="upfile" for="upcvr"><i class="fa fa-fw fa-camera"></i> {{ trans('site.Update') }} <input type="file" id="upcvr" name="upcvr"/></label>
									{!! Form::close() !!}
								</div>
							@endif
						@endif
						<!-- User Cover -->
						<img class="theUpImg onModal" src="{{ url('assets/images/prcovers/' . $cover ) }}" />
					</div>

					<!-- User Image -->
					<div class="profile-p-l-user-pic appends">
					@if(Auth::check())
						@if(Auth::user()->id == $id)
							<div class="opimgs">
								{!! Form::open(['url'=>'profile/'. $id .'/upimg','files'=>'true','method'=>'put', 'id'=>'ajaxForms']) !!}
									<label class="upfile" for="upimg"><i class="fa fa-fw fa-camera"></i> <input type="file" id="upimg" class="" name="upimg"/></label>
								{!! Form::close() !!}
							</div>
						@endif
					@endif
						<img class="theUpImgs onModal" src="{{ url('assets/images/profiles/' . $img ) }}" />
					</div>

					<div class="profile-p-l-user-d">
						<a class="name">{{ $name . " " . $lastName}}</a>
						@if(Auth::check())
							@if(Auth::user()->id != $id)
							<a class="btn fl-right btn-main" href="{{ url('messaging/new/' . Auth::user()->id . '/' . $id) }}">{{ trans('site.SendMessage') }}</a>
							@else
							<a class="btn fl-right btn-main" href="{{ url('profile/' . Auth::user()->id . '/edit') }}">{{ trans('site.ProfileSettings') }}</a>
							@endif
						@endif
					</div>
				</div>

				<div class="toggele">
					<div class="popost togActive"><i class="fa fa-fw fa-thumbs-o-up"></i> Posts</div>
					<div class="poproduct"><i class="fa fa-fw fa-cube"></i> Info</div>
				</div>

				<div class="profile-p-l-user-area">
					<div class="profile-p-l-user-info">
						@if($about != '')
						<div class="box">
							<!-- About Me -->
							<div class="profile-p-l-user-info-item">
								<h1><i class="fa fa-fw fa-flag"></i> {{ trans('site.About') }} {{ $name . " " . $lastName}}</h1>
								<div class="user-info">
									<p>{{ trans('site.Bio') }} : </p>
									<?php
										$about = preg_replace('!(http|ftp|scp)(s)?:\/\/[a-zA-Z0-9.?&_/]+!', "<a class='thislink' target='blank' href=\"\\0\">\\0</a>",$about);
									?>
									<p><span><pre <?php if (preg_match('/ا|ب|ت|ث|ج|ح|خ|د|ذ|ر|س|ش|ص|ض|ط|ظ|ع|غ|ف|ق|ك|ل|م|ن|ه|و|ي/i', $about)) { echo "style='text-align:right;'";}else {echo "style='text-align:left;'";} ?> class="pre">{!! $about !!}</pre></span></p>
								</div>
							</div>
						</div>
						@endif

						<div class="box">
							<!-- Basic Informations -->
							<div class="profile-p-l-user-info-item">
								<h1><i class="fa fa-fw fa-bookmark"></i> {{ trans('site.BasicInformations') }}</h1>
								<div class="user-info">
									<p>{{ trans('site.Name') }} : <span>{{ $name . " " . $lastName}}</span></p>
									<p>{{ trans('site.Gender') }} : <span>{{ $gender }}</span> </p>
									<p>{{ trans('site.DateofBirth') }} : <span>{{ $dateOfBirth }}</span> </p>
									@if($nationality != '')<p>{{ trans('site.Nationality') }} : <span>{{ $nationality }}</span> </p>@endif
								</div>
							</div>
						</div>

						@if($school != '' || $university != '' || $jobTitle != '' || $company != '' || $education != '')
						<div class="box">
							<!-- Work and Edu -->
							<div class="profile-p-l-user-info-item">
								<h1><i class="fa fa-fw fa-graduation-cap"></i> {{ trans('site.WorkandEducation') }}</h1>
								<div class="user-info">
									@if($school != '')<p>{{ trans('site.School') }} : <span>{{ $school }}</span></p>@endif
									@if($university != '')<p>{{ trans('site.University') }} : <span>{{ $university }}</span></p>@endif
									@if($jobTitle != '')<p>{{ trans('site.JobTitle') }} : <span>{{ $jobTitle }}</span></p>@endif
									@if($company != '')<p>{{ trans('site.Company') }} : <span>{{ $company }}</span></p>@endif
									@if($education != '')<p>{{ trans('site.Education') }} : <span>{{ $education }}</span></p>@endif
								</div>
							</div>
						</div>
						@endif

						<div class="box">
							<!-- Location -->
							<div class="profile-p-l-user-info-item">
								<h1><i class="fa fa-fw fa-map-marker"></i> {{ trans('site.Location') }}</h1>
								<div class="user-info">
									<p>{{ trans('site.Country') }} : <span>{{ (!empty($country->countryNameEn))? $country->countryNameEn : ' Not Selected ' }}</span></p>
									<p>{{ trans('site.City') }} : <span>{{ (!empty($city->cityNameEn))? $city->cityNameEn : ' Not Selected ' }}</span></p>
									<p>{{ trans('site.Area') }} : <span>{{ (!empty($area->areaNameEn))? $area->areaNameEn : ' Not Selected ' }}</span></p>
								</div>
							</div>
						</div>

						@if(!empty($hobbies))
						<div class="box">
							<!-- Hobbies -->
							<div class="profile-p-l-user-info-item">
								<h1><i class="fa fa-fw fa-motorcycle"></i> {{ trans('site.Hobbies') }}</h1>
								<div class="user-info">
									<p>{{ trans('site.Hobbies') }} : <span>
										<?php
											$allh = '';
											foreach($hobbies as $hobby){
												if(session()->get('lang') == 'ar'){
													$allh .= $hobby->hobNameAr . ' ,';
												}else{
													$allh .= $hobby->hobNameEn . ' ,';
												}
											}
											echo trim($allh , ',');
										?>
									</span></p>
								</div>
							</div>
						</div>
						@endif

						@if(!empty($interests))
						<div class="box">
							<!-- Interests -->
							<div class="profile-p-l-user-info-item">
								<h1><i class="fa fa-fw fa-book"></i> {{ trans('site.Interests') }}</h1>
								<div class="user-info">
									<p>{{ trans('site.Interests') }} : <span>
										<?php
											$alli = '';
											foreach($interests as $interest){
												if(session()->get('lang') == 'ar'){
													$alli .= $interest->intNameAr . ' ,';
												}else{
													$alli .= $interest->intNameEn . ' ,';
												}
											}
											echo trim($alli , ',');
										?>
									</span></p>
								</div>
							</div>
						</div>
						@endif

						@if($phone != '' || $facebook != '' || $linkedIn != '' || $instagram != '')
						<div class="box">
							<!-- Contact Information -->
							<div class="profile-p-l-user-info-item">
								<h1><i class="fa fa-fw fa-envelope"></i> {{ trans('site.ContactInformation') }}</h1>
								<div class="user-info">
									@if($phone != '')<p>{{ trans('site.Phone') }} : <span>{{ $phone }}</span></p>@endif
									@if($facebook != '')<p>{{ trans('site.Facebook') }} : <span><a target="_blank" href="{{ $facebook }}">{{ $facebook }}</a></span></p>@endif
									@if($linkedIn != '')<p>{{ trans('site.LinkedIn') }} : <span><a target="_blank" href="{{ $linkedIn }}">{{ $linkedIn }}</a></span></p>@endif
									@if($instagram != '')<p>{{ trans('site.Instegram') }} : <span><a target="_blank" href="{{ $instagram }}">{{ $instagram }}</a></span></p>@endif
								</div>
							</div>
						</div>
						@endif

					</div>
					<div class="profile-p-l-user-posts">
						@if(Auth::check())
							@if(Auth::user()->id == $id)
							<div class="progress box" style="border-top:2px solid #4CAF50;">
<div style="color: #333;font-size: 14px;padding:5px 0px;text-align: center;">{{trans('site.progress')}}</div>
                <div style="color: #000;background-color: #f1f1f1;border-radius: 10px;overflow: hidden;">
                                <div style="color: #fff;background-color: #2196F3;padding:2px 5px;text-align: center;width:{{$percent}}%;">{{$percent}}%</div>
</div>
</div>
							<!-- Create new post -->

							@include('_parts.create_post')
							@endif
						@endif

						<!-- Global posts and shares -->
						<h1 class="global-txt">{{ $name . " " . $lastName}} - {{ trans('site.Posts') }} </h1>

						<!-- User Posts -->
						@if(count($posts))
							@foreach($posts as $post)
								<div class="post" id="{{ 'post'.$post->PId }}">
									<div class="post-in">
											@if(Auth::check())
											<div class="post-drop">
												<i class="crt fa fa-fw fa-angle-down"></i>
												<div class="post-drop-menu">
													<a href="{{ url('show/post/' . $post->PId) }}"><i class="fa fa-fw fa-globe"></i> {{ trans('site.GetpostURL') }}</a>
													@if($post->id == Auth::user()->id)
														<a href="{{ url('edit/post/' . $post->PId) }}"><i class="fa fa-fw fa-pencil"></i> {{ trans('site.Editthispost') }}</a>
														<a post="{{ 'post'.$post->PId }}" class="deletePost" href="{{ url('delete/post/' . $post->PId) }}"><i class="fa fa-fw fa-close"></i> {{ trans('site.Deletethispost') }}</a>
													@endif
												</div>
											</div>
											@endif
										<div class="post-in-top">
											<div class="post-in-top-uimg">
											<!-- User Image -->
											<img src="{{ url('assets/images/profiles/' . $post->uImg ) }}" title="{{ $post->name }}" />
											</div>
											<div class="post-in-top-txt">
												<div class="post-status">
													<a href="{{ url('profile/' . $post->id) }}" class="linkGl">
														{{ $post->name }} {{ $post->lastName }}
													</a>
													 {{ trans('site.postedthis') }}
												</div>
												<div class="post-in-top-time">{{ $post->PDate }}
													<?php
														// $today = new DateTime($post->PDate); $appt  = new DateTime(date("Y-m-d H:i:s")); $days_until_appt = $appt->diff($today)->days;
														// if(session()->get('lang') != 'en'){
														// 	echo ($days_until_appt > 0)? "منذ " . $days_until_appt . " يوم" : "اليوم";
														// }
														// else{
														// 	if($days_until_appt > 0){if ($days_until_appt == 1) {echo $days_until_appt . " day ago";}else {echo $days_until_appt . " days ago";}}else {echo "Today";}
														// }
													?>
												</div>
											</div>
										</div>

										<div class="post-in-mid">
											@if(!empty($post->PImage))
												<div class="post-in-mid-pimg">
													<img class="onModal" src="{{ url('assets/images/posts/' . $post->PImage) }}"/>
												</div>
											@endif
											<div class="post-in-mid-txt">
												<?php
													$newStr = preg_replace('!(http|ftp|scp)(s)?:\/\/[a-zA-Z0-9.?&_/]+!', "<a class='thislink' target='blank' href=\"\\0\">\\0</a>",$post->PText);
												?>
												<pre <?php if (preg_match('/ا|ب|ت|ث|ج|ح|خ|د|ذ|ر|س|ش|ص|ض|ط|ظ|ع|غ|ف|ق|ك|ل|م|ن|ه|و|ي/i', $newStr)) { echo "style='text-align:right;'";}else {echo "style='text-align:left;'";} ?> class="pre">{!! $newStr !!}</pre>
											</div>
										</div>

							<div class="post-in-bot">
								<!-- Like and Share -->
								<div class="like-and-share">
								<?php
									// Like and share mechanism
									$lCount = 0; $found = 0;
									foreach($likes as $like){
										if($like->LPostId == $post->PId){$lCount++;}
										if (isset(Auth::user()->id)) {
											if($like->LPostId == $post->PId && $like->LUserId == Auth::user()->id){$found++;}
										}
									}
								?>
								@if(Auth::check())
	            					<div class="like-and-share-b">
										@if($found == 1)
											{!! Form::open(['url'=>'post/'. $post->PId .'/unlike','method'=>'get', 'class'=>'likePostForm']) !!}
												<button type="submit" id="{{ 'like'.$post->PId }}" name="like" data-like-action="ulkp" data-txt="{{ trans('site.Unlike') }}" class="likePost unlike"><i class="fa fa-thumbs-up"></i> {{ trans('site.Unlike') }}</button>
											{!! Form::close() !!}
										@else
											{!! Form::open(['url'=>'post/'. $post->PId .'/like','method'=>'get', 'class'=>'likePostForm']) !!}
												<button type="submit" id="{{ 'like'.$post->PId }}" name="like" data-like-action="lkp" data-txt="{{ trans('site.Like') }}" class="likePost like"><i class="fa fa-thumbs-o-up"></i> {{ trans('site.Like') }}</button>
											{!! Form::close() !!}
										@endif
										{{-- .
										<a class="share"><i class="fa fa-share-alt"></i> Share</a> --}}
									</div>
								@endif
									<div class="like-and-share-num">
										<span class="counter"><b>{{ $lCount }}</b> {{ trans('site.Likes') }}</span>
										<!-- <span>20 Shares</span> -->
									</div>
								</div>
								<!-- Commnets -->
								<div class="comment-area">

								<!-- Add user commnet -->
	            				@if(Auth::check())
									<!-- Add user commnet -->
									<div class="comment-area-user">
										<div class="comment-area-user-img">
											<!-- User Image -->
											<img src="{{ url('assets/images/profiles/' . Auth::user()->uImg ) }}" />
										</div>
										{!! Form::open(['url'=>'comment/store', 'method'=>'post', 'class'=>'commentPost']) !!}
											<div class="comment-area-user-txt">
												<textarea class="input-text" name="comment" required placeholder="write a comment .." ></textarea>
											</div>
											<input type="hidden" name="cpi" value="{{ $post->PId }}" />
											<button type="submit" class="btn fl-right btn-main">{{ trans('site.Comment') }}</button>
						                {!! Form::close() !!}
									</div>
								@endif
									<!-- Numbur of commnets -->
									<div class="comment-area-num">
										<span class="show-comments"></span>

										<?php $coCount = 0; foreach($comments as $comment){ if($comment->CoPostId == $post->PId){ $coCount++; } } ?>

										<span class="comments-num">{{ $coCount }} {{ trans('site.Comment') }}</span>
									</div>
									<!-- All users commnets -->
									<div class="comment-area-all">
										@foreach($comments as $comment)
											@if($comment->CoPostId == $post->PId)
												<div class="comment-area-all-user">
													<div class="comment-area-all-uimg">
														<!-- User Image -->
														<img src="{{ url('assets/images/profiles/' . $comment->uImg ) }}" title="{{ $comment->name }}" />
													</div>

													<div class="comment-area-all-txt">
														<a href="{{ url('profile/' . $comment->id) }}" class="linkGl">{{ $comment->name }}  {{ $comment->lastName }}</a>
														<p><pre class="pre">{{ $comment->CoText }}</pre></p>
													</div>
												</div>
											@endif
										@endforeach
									</div>
								</div>
							</div>
									</div>
								</div>
							@endforeach
						@else
							<div class="box" style="padding: 10px;"> {{ trans('site.Nopoststodisplay') }} </div>
						@endif

					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="profile-p-r">
				<!-- Ads Area -->
				<div class="adMN">
					@include('_parts.ads_1')
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<!-- Ended Sections Contenets Here +++++++++++ -->
@endsection
