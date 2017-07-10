<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Post;
use App\Reply;
use App\User;

use App\Comment;
class PostController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        if ($request->has('ptxt')) {
            $post->PUserId = Auth::user()->id;
            $post->PText = $request->input('ptxt');

            if ($request->has('CPTPrice')) {
                $post->CPT = "product";
                $post->CPTPrice = $request->input('CPTPrice');
            }

            if ($request->hasFile('pimg')) {
                $file = $request->file('pimg');
                $ext = strtolower($file->getClientOriginalExtension());
                $validExt = ['jpg','gif','jpeg','png'];

                if (in_array($ext, $validExt)) {
                    // the file is image
                    $filename = time().rand(1000,9999).'.'.$ext;
                    $upload = $file->move(base_path().'/assets/images/posts', $filename);

                    if ($upload) {
                        $quality = config('vars.imageQuality');
                        $image = base_path().'/assets/images/posts/' . $filename;
                        $info = getimagesize($image);

                        if ($info['mime'] == 'image/jpeg'){
                            $soueceimage = imagecreatefromjpeg($image);
                            header("Content-Type: image/jpeg");
                            imagejpeg($soueceimage, base_path().'/assets/images/posts/' . $filename, $quality);
                        } 
                        elseif ($info['mime'] == 'image/gif') {
                            $soueceimage = imagecreatefromgif($image);
                            header('Content-Type: image/gif');
                            imagegif($soueceimage, base_path().'/assets/images/posts/' . $filename, $quality);
                        }
                        elseif ($info['mime'] == 'image/png') {
                            $soueceimage = imagecreatefrompng($image);
                            header("Content-Type: image/png");
                            imagepng($soueceimage, base_path().'/assets/images/posts/' . $filename);
                        }

                        $post->PImage = $filename;
                    }

                }
            }

            $post->save();

            // Notification track
            $postId = DB::table('posts')->where('PUserId','=',Auth::user()->id)->orderBy('PId', 'desc')->first();
            if ($postId->PUserId == Auth::user()->id) {
                DB::table('notifs')->insert([
                    'NotifUserId'=>$postId->PUserId,
                    'NotifActionId'=>$postId->PId,
                    'NotifActionType'=>'post'
                ]);
            }

            $uid = Auth::user()->id;
            $postId = DB::select("SELECT * FROM posts JOIN users ON PUserId = id WHERE PUserId = $uid ORDER BY PId desc LIMIT 1");

            echo json_encode($postId);
        }else{
            // No text in the post
            session()->flash('msg', '<i class="fa fa-close"></i> Please type a post text');
            session()->flash('dis', 'style="display:block;background-color:#7f0600;"');

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Display the posts
        $post = DB::select("SELECT * FROM posts JOIN users ON PUserId = id WHERE PId = $id");

        // Display the comments
       // $comments = DB::select("SELECT * FROM comments JOIN users ON CoUserId = id WHERE CoPostId = $id");
       //new updates
       $comments =Comment::where('CoPostId',$id)->get();


$replies=Reply::all();

//end of updates
        // posts likes
        $likes = DB::select("SELECT * FROM likes JOIN users ON LUserId = id WHERE LPostId = $id");

        if (!empty($post)) {
            return view('posts.show',[
                    'post'=>$post[0],
                    'comments'=>$comments,
                    'likes'=>$likes,
                     'replies'=>$replies
            ]);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = DB::table('posts')->where('PId','=',$id)->first();
        if (isset($post->PUserId)) {
            if (Auth::user()->id == $post->PUserId) {
                return view('posts.edit', ['post'=>$post]);
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //new updates
     
     public function showSavedPosts(){
      $posts=User::find(Auth::user()->id);
      return view('savedPosts.all',compact('posts'));
      }
            public function removeSavedPost($id){
         $post=DB::table('post_user')->where('user_id',Auth::user()->id)->where('post_id',$id)->delete();
        return redirect()->back();
            }
       public function savePost($id){
         DB::table('post_user')->insert([
           'post_id'=>$id,
           'user_id'=>Auth::user()->id
         ]);
return redirect()->back();
       }
       //end of updates
    public function update(Request $request, $id)
    {
        $post = Post::where('PId' ,'=' , $id);
        if ($request->has('ptxt')) {
            if ($request->hasFile('pimg')) {
                $file = $request->file('pimg');
                $ext = strtolower($file->getClientOriginalExtension());
                $validExt = ['jpg','gif','jpeg','png'];
                if (in_array($ext, $validExt)) {
                    // the file is image
                    $filename = time().rand(1000,9999).'.'.$ext;
                    $upload = $file->move(base_path().'/assets/images/posts', $filename);
                    if ($upload) {
                        $quality = config('vars.imageQuality');
                        $image = base_path().'/assets/images/posts/' . $filename;
                        $info = getimagesize($image);

                        if ($info['mime'] == 'image/jpeg'){
                            $soueceimage = imagecreatefromjpeg($image);
                            header("Content-Type: image/jpeg");
                            imagejpeg($soueceimage, base_path().'/assets/images/posts/' . $filename, $quality);
                        } 
                        elseif ($info['mime'] == 'image/gif') {
                            $soueceimage = imagecreatefromgif($image);
                            header('Content-Type: image/gif');
                            imagegif($soueceimage, base_path().'/assets/images/posts/' . $filename, $quality);
                        }
                        elseif ($info['mime'] == 'image/png') {
                            $soueceimage = imagecreatefrompng($image);
                            header("Content-Type: image/png");
                            imagepng($soueceimage, base_path().'/assets/images/posts/' . $filename);
                        }
                    
                        $post->update(['PText' => $request->input('ptxt'),'PImage' => $filename]);
                        return redirect('/');
                    }
                }else{
                    // No text in the post
                    session()->flash('msg', '<i class="fa fa-close"></i> Please select a valid image');
                    session()->flash('dis', 'style="display:block;background-color:#7f0600;"');
                    return redirect('/');
                }
            }else{
                $post->update(['PText' => $request->input('ptxt')]);
                return redirect('/');
            }
        }else{
            // No text in the post
            session()->flash('msg', '<i class="fa fa-close"></i> Please type a post text');
            session()->flash('dis', 'style="display:block;background-color:#7f0600;"');
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postUserId = DB::table('posts')->where('PId','=', $id)->first()->PUserId;

        if (Auth::user()->id == $postUserId) {
            DB::table('posts')->where('PId','=', $id)->delete();
            DB::table('comments')->where('CoPostId','=', $id)->delete();

            session()->flash('msg', '<i class="fa fa-check"></i> Post deleted Successfully');
            session()->flash('dis', 'style="display:block;background-color:#1D80F0;"');

            echo "1";
        }else{
            return redirect()->back();
        }
    }
}
