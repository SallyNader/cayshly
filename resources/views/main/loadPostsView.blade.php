        @foreach($posts as $post)
        <div class="post" id="{{ 'post'.$post->PId }}">
          <div class="post-in" >
            @if(Auth::check())
            <div class="post-drop">
              <i class="crt fa fa-fw fa-angle-down"></i>
              <div class="post-drop-menu">
                <a href="{{ url('show/post/' . $post->PId) }}"><i class="fa fa-fw fa-globe"></i> {{ trans('site.GetpostURL') }}</a>
                @if(Auth::check())

                <a href="{{ url('save-post/' .$post->PId) }}"><i class="fa fa-fw fa-globe"></i> {{ trans('site.saveThisPost') }}</a>

                @endif
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
                      //  echo ($days_until_appt > 0)? "منذ " . $days_until_appt . " يوم" : "اليوم";
                      // }
                      // else{
                      //  if($days_until_appt > 0){if ($days_until_appt == 1) {echo $days_until_appt . " day ago";}else {echo $days_until_appt . " days ago";}}else {echo "Today";}
                      // }
                  ?>
                </div>
              </div>
            </div>

            @if($post->CPT == "product")
            <div class="cpt-p">
              {{ trans('site.Price') }} : {{ $post->CPTPrice }}
            </div>
            @endif

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
                    <textarea class="input-text" name="comment" required placeholder="{{ trans('site.writeacomment') }}" ></textarea>
                  </div>
                  <input type="hidden" name="cpi" value="{{ $post->PId }}" />
                  <button type="submit" class="btn btn-main fl-left">{{ trans('site.Comment') }}</button>
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

                <br/><br/>

                <div class="comment-area-all">
                  @foreach($comments as $comment)
                  @if($comment->CoPostId == $post->PId)
                  <div class="comment-area-all-user">
                    <div class="comment-area-all-uimg">
                      <!-- User Image -->
                      <img src="{{ url('assets/images/profiles/' . $comment->user->uImg ) }}" title="{{ $comment->name }}" />
                    </div>

                    <div style="width:90%;" class="comment-area-all-txt">
                      <a href="{{ url('profile/'. $comment->id) }}" class="linkGl">{{ $comment->name }}  {{ $comment->lastName }}</a>
                      <p><pre <?php if (preg_match('/ا|ب|ت|ث|ج|ح|خ|د|ذ|ر|س|ش|ص|ض|ط|ظ|ع|غ|ف|ق|ك|ل|م|ن|ه|و|ي/i', $comment->CoText)) { echo "style='direction:rtl;'";}else {echo "style='direction:ltr;'";} ?>  class="pre">{{ $comment->CoText }}</pre></p>
                      
                      @if(Auth::check())
                        <div class="" style="margin-top:12px">
                          <div class="clear"></div>
                          {!! Form::open(['url'=>'reply', 'method'=>'post']) !!}
                          <div class="comment-area-user-txt" style="float: left;width: 90%;">
                            <textarea class="input-text" name="reply" style="width:100%;height:30px;outline: none;border: 1px solid #ccc;"  placeholder="{{ trans('site.reply_to_this_comment') }}" ></textarea>
                          </div>
                          <input type="hidden" name="comment_id" value="{{  $comment->CoId }}" />
                          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                          <button style="float: right;min-width: 9% !important;background-color: #E34839;color: #fff;" type="submit" class="btn" >{{ trans('site.reply-button') }}</button>
                          {!! Form::close() !!}
                        </div>
                      @endif
                      
                      @foreach($replies as $r)
                        @if($r->comment_id == $comment->CoId)

                        <div class="comment-area-all-txt" style="margin-top:12px">
                           <img style="width:20px;height:20px" src="{{ url('assets/images/profiles/' . $r->user->uImg ) }}" title="{{ $comment->name }}" />
                           <a  href="{{ url('profile/' . $comment->id) }}" class="linkGl">{{$r->user->name}}  {{$r->user->lastName}}</a>
                           <p><pre <?php if (preg_match('/ا|ب|ت|ث|ج|ح|خ|د|ذ|ر|س|ش|ص|ض|ط|ظ|ع|غ|ف|ق|ك|ل|م|ن|ه|و|ي/i',$r->reply)) { echo "style='direction:rtl;'";}else {echo "style='direction:ltr;'";} ?>  class="pre">{{ $r->reply }}</pre></p>
                        </div>

                        <!-- <div  >  <a href="{{ url('profile/' . $comment->id) }}" class="linkGl">{{$r->user->name}} {{$r->user->lastName}}</a>{{$r->reply}}</div> -->
                        @endif
                      @endforeach

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
