<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;
use Mail;
use App\Point;

class UserProfileController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $percent =0;
        $user = User::findOrFail($id);

        // Country, City, Area
        $country   = DB::table('countries')->where('countryId','=', $user->country)->first();
        $city      = DB::table('cities')->where('cityId','=', $user->city)->first();
        $area      = DB::table('areas')->where('areaId','=', $user->area)->first();

        // Hobbies, Interests
        $hobbies   = DB::table('userhobbies')->where('uHobUserId','=', $id)->get();
        $AllHobbies = [];
        foreach ($hobbies as $hobby) {
            $AllHobbies[] = DB::table('hobbies')->where('hobId','=', $hobby->uHobHobId)->first();
        }

        $interests = DB::table('userinterestes')->where('uIntUserId','=', $id)->get();
        $AllInterests = [];
        foreach ($interests as $interest) {
            $AllInterests[] = DB::table('interestes')->where('intId','=', $interest->uIntIntId)->first();
        }

        // Display the posts
        $posts = DB::select("SELECT * FROM posts JOIN users ON PUserId = id WHERE PUserId = $id ORDER BY PId DESC");

        // Display the comments
        $comments = DB::select("SELECT * FROM comments JOIN users ON CoUserId = id");

        // posts likes
        $likes = DB::select("SELECT * FROM likes JOIN users ON LUserId = id");

$array=[
$user->country,
$user->city,
$user->area,
$user->name,
$user->lastName,
$user->email,
$user->phone,
 $user->about,
 $user->gender,
 $user->dateOfBirth,
 $user->nationality,
 $user->school,
 $user->university,
 $user->jobTitle,
 $user->company,
 $user->education,
 $user->facebook,
$user->linkedIn,
$user->instagram,
$user->address,
];

foreach($array as $value){


if($value != null)

    {$percent+=4.5;
    }

}

if($AllHobbies != null){
$percent+=4.5;

}
if($AllInterests != null){
$percent+=4.5;
    
}

// return $percent;

if($percent == 99){

    $percent=100;
}

        return view('profiles.show',[
                    'id'=> $user->id,
                    'name'=> $user->name,
                    'lastName'=> $user->lastName,
                    'email'=> $user->email,
                    'phone'=> $user->phone,
                    'parentEmail'=> $user->parentEmail,
                    'about'=> $user->about,
                    'gender'=> $user->gender,
                    'dateOfBirth'=> $user->dateOfBirth,
                    'nationality'=> $user->nationality,
                    'school'=> $user->school,
                    'university'=> $user->university,
                    'jobTitle'=> $user->jobTitle,
                    'company'=> $user->company,
                    'education'=> $user->education,

                    'country'=> $country,
                    'city'=> $city,
                    'area'=> $area,
                    'hobbies'=> $AllHobbies,
                    'interests'=> $AllInterests,
                    
                    'facebook'=> $user->facebook,
                    'linkedIn'=> $user->linkedIn,
                    'instagram'=> $user->instagram,
                    'cover'=> $user->uCover,
                    'img'=> $user->uImg,

                    'posts'=>$posts,
                    'comments'=>$comments,
                    'likes'=>$likes,
                    "percent"=>floor($percent)
        ]); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
$percent =0;
        $userAuth = Auth::user()->id;
        $user = User::findOrFail($id);

        // Country, City, Area
        $countries   = DB::table('countries')->get();
        $cities      = DB::table('cities')->get();
        $areas      = DB::table('areas')->get();

        $interestes      = DB::table('interestes')->get();
        $hobbies      = DB::table('hobbies')->get();

        $uinterestes      = DB::table('userinterestes')->where('uIntUserId','=',$userAuth)->get();
        $uhobbies      = DB::table('userhobbies')->where('uHobUserId','=',$userAuth)->get();


        if($user->name != null and $user->lastName !=null and $user->gender != null and $user->address != null and $user->dateOfBirth != null and $user->nationality != null ){


    Point::firstOrCreate([

"PoUserId"=>Auth::user()->id,
"PoProductId"=>0,
"PoProductName"=>"complete profile",
"PoAmount"=>150,
"PoItemNums"=>0,
"PoFrom"=>"purchasing",
"PoStatus"=>"increased",
"PoConfirm"=>1



    ]);


        }

        if($user->about != null){

            Point::firstOrCreate([

"PoUserId"=>Auth::user()->id,
"PoProductId"=>0,
"PoProductName"=>"complete profile",
"PoAmount"=>150,
"PoItemNums"=>0,
"PoFrom"=>"purchasing",
"PoStatus"=>"increased",
"PoConfirm"=>1



    ]);

        }




        if( $user->school  !=null  and $user->university  !=null and $user->jobTitle !=null and $user->company !=null and  $user->education !=null ){

Point::firstOrCreate([

"PoUserId"=>Auth::user()->id,
"PoProductId"=>0,
"PoProductName"=>"complete profile",
"PoAmount"=>150,
"PoItemNums"=>0,
"PoFrom"=>"purchasing",
"PoStatus"=>"increased",
"PoConfirm"=>1



    ]);

        }

        if($user->facebook !=null  and $user->instagram !=null and  $user->linkedIn  !=null and  $user->phone  !=null){


            Point::firstOrCreate([

"PoUserId"=>Auth::user()->id,
"PoProductId"=>0,
"PoProductName"=>"complete profile",
"PoAmount"=>150,
"PoItemNums"=>0,
"PoFrom"=>"purchasing",
"PoStatus"=>"increased",
"PoConfirm"=>1



    ]);
        }

        if($uhobbies != null){

             Point::firstOrCreate([

"PoUserId"=>Auth::user()->id,
"PoProductId"=>0,
"PoProductName"=>"complete profile",
"PoAmount"=>125,
"PoItemNums"=>0,
"PoFrom"=>"purchasing",
"PoStatus"=>"increased",
"PoConfirm"=>1



    ]);
        }




           if($uinterestes != null){

             Point::firstOrCreate([

"PoUserId"=>Auth::user()->id,
"PoProductId"=>0,
"PoProductName"=>"complete profile",
"PoAmount"=>125,
"PoItemNums"=>0,
"PoFrom"=>"purchasing",
"PoStatus"=>"increased",
"PoConfirm"=>1



    ]);
        }

        $array=[
$user->country,
$user->city,
$user->area,
$user->name,
$user->lastName,
$user->email,
$user->phone,
 $user->about,
 $user->gender,
 $user->dateOfBirth,
 $user->nationality,
 $user->school,
 $user->university,
 $user->jobTitle,
 $user->company,
 $user->education,
 $user->facebook,
$user->linkedIn,
$user->instagram,
$user->address,
];

foreach($array as $value){


if($value != null)

    {$percent+=4.5;
    }

}

if($uhobbies != null){
$percent+=4.5;

}
if($uinterestes != null){
$percent+=4.5;
    
}

// return $percent;

if($percent == 99){

    $percent=100;
}


           if($user->country != null  and    $user->city != null  and  $user->area!= null){

             Point::firstOrCreate([

"PoUserId"=>Auth::user()->id,
"PoProductId"=>0,
"PoProductName"=>"complete profile",
"PoAmount"=>150,
"PoItemNums"=>0,
"PoFrom"=>"purchasing",
"PoStatus"=>"increased",
"PoConfirm"=>1



    ]);
        }

        if ($userAuth == $user->id) {
            return view('profiles.edit',[

                    'id'=> $user->id,
                    'name'=> $user->name,
                    'lastName'=> $user->lastName,
                    'email'=> $user->email,
                    'phone'=> $user->phone,
                    'parentEmail'=> $user->parentEmail,
                    'about'=> $user->about,
                    'gender'=> $user->gender,
                    'dateOfBirth'=> $user->dateOfBirth,
                    'nationality'=> $user->nationality,
                    'school'=> $user->school,
                    'university'=> $user->university,
                    'jobTitle'=> $user->jobTitle,
                    'company'=> $user->company,
                    'education'=> $user->education,
                    'countries'=>$countries,
                    'ucountry'=> $user->country,
                    'cities'=>$cities,
                    'ucity'=> $user->city,
                    'uarea'=> $user->area,
                    'areas'=>$areas,
                    'interestes'=>$interestes,
                    'hobbies'=>$hobbies,
                    'uinterestes'=>$uinterestes,
                    'uhobbies'=>$uhobbies,
                    'facebook'=> $user->facebook,
                    'linkedIn'=> $user->linkedIn,
                    'instagram'=> $user->instagram,
                    'cover'=> $user->uCover,
                    'img'=> $user->uImg,
                    "percent"=>floor($percent)
            ]); 
        }else{
            return view('errors.404');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userAuth = Auth::user()->id;
        $user = User::findOrFail($id);

        if ($request->has('name')) {$user->name = $request->input('name');}
        if ($request->has('lastName')) {$user->lastName = $request->input('lastName');}
        if ($request->has('email')) {$user->email = $request->input('email');}
        if ($request->has('phone')) {$user->phone = $request->input('phone');}
        if ($request->has('about')) {$user->about = $request->input('about');}
        if ($request->has('gender')) {$user->gender = $request->input('gender');}
        if ($request->has('address')) {$user->address = $request->input('address');}
        if ($request->has('dateOfBirth')) {$user->dateOfBirth = $request->input('dateOfBirth');}
        if ($request->has('nationality')) {$user->nationality = $request->input('nationality');}
        if ($request->has('school')) {$user->school = $request->input('school');}
        if ($request->has('university')) {$user->university = $request->input('university');}
        if ($request->has('jobTitle')) {$user->jobTitle = $request->input('jobTitle');}
        if ($request->has('company')) {$user->company = $request->input('company');}
        if ($request->has('education')) {$user->education = $request->input('education');}
        if ($request->has('country')) {$user->country = $request->input('country');}
        if ($request->has('city')) {$user->city = $request->input('city');}
        if ($request->has('area')) {$user->area = $request->input('area');}
        if ($request->has('facebook')) {$user->facebook = $request->input('facebook');}
        if ($request->has('linkedIn')) {$user->linkedIn = $request->input('linkedIn');}
        if ($request->has('instagram')) {$user->instagram = $request->input('instagram');}

        if ($request->has('interestes')) {
            DB::table('userinterestes')->where('uIntUserId','=',$userAuth)->delete();
            foreach ($request->input('interestes') as $interest) {
                DB::table('userinterestes')->insert([
                    'uIntIntId'=>$interest,
                    'uIntUserId'=>$userAuth
                ]);
            }
        }

        if ($request->has('hobbies')) {
            DB::table('userhobbies')->where('uHobUserId','=',$userAuth)->delete();
            foreach ($request->input('hobbies') as $hobby) {
                DB::table('userhobbies')->insert([
                    'uHobHobId'=>$hobby,
                    'uHobUserId'=>$userAuth
                ]);
            }
        } 

        $user->save();

        return redirect('profile/'. $id .'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // Images
    public function uploadCover(Request $r, $id){

        $file = $r->file('upcvr');

        if ($r->hasFile('upcvr')) {
            $ext = strtolower($file->getClientOriginalExtension());
            $validExt = ['jpg','gif','jpeg','png'];

            if (in_array($ext, $validExt)) {
                // the file is image
                $filename = time().rand(1000,9999).'.'.$ext;
                $upload = $file->move(base_path().'/assets/images/prcovers', $filename);

                if ($upload) {
                    $quality = 50;
                    $image = base_path().'/assets/images/prcovers/' . $filename;
                    $info = getimagesize($image);

                    if ($info['mime'] == 'image/jpeg'){
                        $soueceimage = imagecreatefromjpeg($image);
                        header("Content-Type: image/jpeg");
                        imagejpeg($soueceimage, base_path().'/assets/images/prcovers/' . $filename, $quality);
                    } 
                    elseif ($info['mime'] == 'image/gif') {
                        $soueceimage = imagecreatefromgif($image);
                        header('Content-Type: image/gif');
                        imagegif($soueceimage, base_path().'/assets/images/prcovers/' . $filename, $quality);
                    }
                    elseif ($info['mime'] == 'image/png') {
                        $soueceimage = imagecreatefrompng($image);
                        header("Content-Type: image/png");
                        imagepng($soueceimage, base_path().'/assets/images/prcovers/' . $filename);
                    }

                    DB::table('users')->where('id', '=', $id)->update(['uCover'=> $filename]);
                }

                $url = url('/assets/images/prcovers/' . $filename);
                echo json_encode($url);

            }else{
                echo json_encode("Error");
            }

        }else{
            echo json_encode("Error");
        }
    }

    public function uploadImg(Request $r, $id){

        $file = $r->file('upimg');

        if ($r->hasFile('upimg')) {
            $ext = strtolower($file->getClientOriginalExtension());
            $validExt = ['jpg','gif','jpeg','png'];

            if (in_array($ext, $validExt)) {
                // the file is image
                $filename = time().rand(1000,9999).'.'.$ext;
                $upload = $file->move(base_path().'/assets/images/profiles', $filename);

                if ($upload) {
                    $quality = 50;
                    $image = base_path().'/assets/images/profiles/' . $filename;
                    $info = getimagesize($image);

                    if ($info['mime'] == 'image/jpeg'){
                        $soueceimage = imagecreatefromjpeg($image);
                        header("Content-Type: image/jpeg");
                        imagejpeg($soueceimage, base_path().'/assets/images/profiles/' . $filename, $quality);
                    } 
                    elseif ($info['mime'] == 'image/gif') {
                        $soueceimage = imagecreatefromgif($image);
                        header('Content-Type: image/gif');
                        imagegif($soueceimage, base_path().'/assets/images/profiles/' . $filename, $quality);
                    }
                    elseif ($info['mime'] == 'image/png') {
                        $soueceimage = imagecreatefrompng($image);
                        header("Content-Type: image/png");
                        imagepng($soueceimage, base_path().'/assets/images/profiles/' . $filename);
                    }
                    
                    DB::table('users')->where('id', '=', $id)->update(['uImg'=> $filename]);
                }
            
                $url = url('/assets/images/profiles/' . $filename);
                echo json_encode($url);

            }else{
                echo json_encode("Error");
            }

        }else{
            echo json_encode("Error");
        }
    }

// Change password
    public function getChPsPage()
    {
      return view('profiles.getChPsPage');
    }
    public function postChPsPage(Request $request)
    {
      $userId = Auth::user()->id;
      $userPassword = Auth::user()->password;

      $inputOldPassword = $request->get('oldPass');
      $inputOldPasswordEnc = bcrypt($inputOldPassword);
      $inputNewPassword = $request->get('newPass');
      $inputNewPasswordEnc = bcrypt($inputNewPassword);

      $user = User::find($userId);
      $user->password = $inputNewPasswordEnc;
      $user->save();

      // Old password matched
      session()->flash('msg', '<i class="fa fa-close"></i> Your password updated Successfully');
      session()->flash('dis', 'style="display:block;background-color:#3498DB;"');
      return redirect('profile/' . $userId);

      // if ($inputOldPassword == $userPassword) {
      //   $user = User::find($userId);
      //   $user->password = $inputNewPassword;
      //   $user->save();
      //
      //   // Old password matched
      //   session()->flash('msg', '<i class="fa fa-close"></i> Your password updated Successfully');
      //   session()->flash('dis', 'style="display:block;background-color:#3498DB;"');
      //   return redirect('profile/' . $userId);
      // }else {
      //   // Old password not matched
      //   session()->flash('msg', '<i class="fa fa-close"></i> Old password not not matched');
      //   session()->flash('dis', 'style="display:block;background-color:#7f0600;"');
      //   return redirect()->back();
      // }

    }

}
