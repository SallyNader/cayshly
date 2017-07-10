<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Point;

class AuthCayshly extends Controller
{
    /**
     * Display Sign Page.
     */
    public function signBasic()
    {
        if(auth()->check())
            return redirect('/home');
        else            
            return view('auth.sign-basic'); 
    }

    /**
     * Sign in global
     */
    public function signGlobal(){
        if(auth()->check())
            return redirect('/home');
        else            
            return view('auth.sign-global'); 
    }

    /**
     * 1 - Get user basic informations (FName,LName,Phone,Email,ParentEmail)
     */
    // Parent equation
    public function parentEquation($parent = null)
    {
        if ($parent === null) {
            $countUsers = DB::table('users')->count();
            $randUser = rand(1,$countUsers);
            return $randUser;
        }else{
            $requestedParent = DB::table('users')->where('email', '=', $parent)->first();
            if (!empty($requestedParent)) {
                return $requestedParent->id;
            }else{
                $countUsers = DB::table('users')->count();
                $randUser = rand(1,$countUsers);
                return $randUser;
            }
        }
    }




//start of new updates




public function resendCode(){

$user=User::find(Auth::user()->id);



  $activationCode = sha1($user->email);
  // $user->uActive = '0';
  $user->uActiveCode = $activationCode;

  // Save new user
  $user->save();

              // Send user activation code
              $data = ['name' => Auth::user()->name, 'activationCode' => $activationCode ];
              $username = $user->name;
              $toUser = $user->email;
              $subjectUser = 'Activate Cayshly Account';
              $messageUser = view('emails.activation', $data);

              $headersUser = "From: Cayshly<". config('maildata.from') ."> \r\n";
              // $headersUser .= "BCC: ". config('maildata.bcc') ."\r\n";
              $headersUser .= "MIME-Version: 1.0\r\n";
              $headersUser .= "Content-Type: text/html; charset=UTF-8\r\n";

              //mail($toUser, $subjectUser, $messageUser, $headersUser);
              
              
              
              Mail::send('emails.activation', ['name' => Auth::user()->name,'activationCode'=>$activationCode], function($message) use($toUser,$username)
{
    $message->from('info@Cayshly.com','Cayshly');
    $message->to($toUser,$username)->subject('Activate Cayshly Account');
});

  session()->flash('msg', '<i class="fa fa-check"></i> check your email');
            session()->flash('dis', 'style="display:block;background-color:#1D80F0;"');

              return redirect()->back();


}
//end of new updates
    public function signOptional(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'fname'=>'required|max:255',
                'lname'=>'required|max:255',
                'email'=>'required|email|unique:users',
                'phone'=>'required',
                'password'=>'required',
                'gender'=>'required',
                'day'=>'required',
                'month'=>'required',
                'year'=>' required'
        ]);

        $nicenames = [
            'fname'=>'first name',
            'lname'=>'last name',
            'day'=>'date',
            'month'=>'date',
            'year'=>'date'
        ];

        $validator->setAttributeNames($nicenames);

        if ($validator->fails()) {
            // The valedation process fails
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
                
        }else{
            // Insert new user
            $user = new User();

            $user->name = $request->input('fname');
            $user->lastName = $request->input('lname');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->password = bcrypt($request->input('password'));
            $user->gender = $request->input('gender');
            $user->uImg = ($request->input('gender') == 'male') ? 'default-boy.jpg' :  'default-girl.jpg' ;
            $user->uCover = 'default.jpg';
            
            $user->dateOfBirth = $request->input('day') . "/" . $request->input('month') . "/" . $request->input('year');
            $user->parentEmail = $this->parentEquation($request->input('parentEmail'));

            // Generate activation code
            $activationCode = sha1($request->input('email'));
            $user->uActive = '0';
            $user->uActiveCode = $activationCode;
            
            // Save new user
            $user->save();

	    // Notification
            $reUserId = DB::table('users')->where('email','=',$request->input('email'))->orderBy('id', 'desc')->first();

            DB::table('alerts')->insert([
                'alert_from'     => $reUserId->id,
                'alert_to'       => $reUserId->parentEmail,
                'aler_type'      => 'new_registration',
                'alert_issue_id' => 0,
            ]);

            // Send user activation code
            $data = ['name' => $request->input('fname'), 'activationCode' => $activationCode ];
            $username = $request->input('fname');
            $toUser = $request->input('email');
            $subjectUser = 'Activate Cayshly Account';
            $messageUser = view('emails.activation', $data);

            $headersUser = "From: Cayshly<". config('maildata.from') ."> \r\n";
            // $headersUser .= "BCC: ". config('maildata.bcc') ."\r\n";
            $headersUser .= "MIME-Version: 1.0\r\n";
            $headersUser .= "Content-Type: text/html; charset=UTF-8\r\n";

            mail($toUser, $subjectUser, $messageUser, $headersUser);

            // Mail::send('emails.activation', $data, function ($message) use ($usermail, $username){  
            //     $message->from('no-replay@cayshly.com', 'Cayshly');      
            //     $message->to($usermail, $username);
            //     $message->cc('ahmsam39@gmail.com', 'Cayshly');
            //     $message->subject('Activate Cayshly Account');
            // });

            // Send email to the parent
            $getUser = DB::table('users')->where('email', '=', $request->input('email'))->first();
            $parentname = DB::table('users')->where('id', '=', $getUser->parentEmail)->first()->name;

            $noewone = ['parent'=>$parentname,'member'=>$username];
            
            $toParent = DB::table('users')->where('id', '=', $getUser->parentEmail)->first()->email;
            $subjectParent = 'Congratulations '. $parentname .' new member in your network';
            $messageParent = view('emails.new-one-network', $noewone);

            $headersParent = "From: Cayshly<". config('maildata.from') ."> \r\n";
            // $headersParent .= "BCC: ". config('maildata.bcc') ."\r\n";
            $headersParent .= "MIME-Version: 1.0\r\n";
            $headersParent .= "Content-Type: text/html; charset=UTF-8\r\n";

            mail($toParent, $subjectParent, $messageParent, $headersParent);

            // Mail::send('emails.new-one-network', $noewone, function ($message) use ($parentmail, $parentname){  
            //     $message->from('no-replay@cayshly.com', 'Cayshly');
            //     $message->to($parentmail, $parentname);
            //     $message->cc('ahmsam39@gmail.com', 'Cayshly');
            //     $message->subject('New member to your network');
            // });

            // Get Countries, Cities, Areas, Hoppies, Interests
            $countries = DB::table('countries')->get();
            $cities = DB::table('cities')->get();
            $areas = DB::table('areas')->get();
            $hobbies = DB::table('hobbies')->get();
            $interestes = DB::table('interestes')->get();

            // Add New 5000 points
            $newPoint = new Point;
            $newPoint->PoUserId = $getUser->id;
            $newPoint->PoProductId = 0;
            $newPoint->PoProductName = "initials";
            $newPoint->PoAmount = 5000;
            $newPoint->PoItemNums = 0;
            $newPoint->PoFrom = "purchasing";
            $newPoint->PoStatus = "increased";
            $newPoint->PoConfirm = 1;
            $newPoint->save();

            // Send Email
            $tousername     = $getUser->name;
            $touseremail    = $getUser->email;

            $subject = 'مبروك تم اضافة 5000 نقطه لحسابك';
            $message = view('emails.points_new', ['username' => $tousername]);

            $headers = "From: Cayshly<". config('maildata.from') ."> \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            mail($touseremail, $subject, $message, $headers);

            // Rerurn the optional 
            return view('auth.sign-optional',[
                'countries'=>$countries,
                'cities'=>$cities,
                'areas'=>$areas,
                'hobbies'=>$hobbies,
                'interestes'=>$interestes,
                'email'=>$request->input('email')
            ]);

        }
    }

    /**
     * 2 - User optional informations
     */
    public function signComplete(Request $request){
        // Find user
        $user = DB::table('users')->where('email', '=', $request->input('em'))->first();

        if ($request->has('country')) {
            DB::table('users')->where('id', '=', $user->id)->update([
                'country' => $request->input('country'),
                'city' => $request->input('city'),
                'area' => $request->input('area')
            ]);
        }
        
        if ($request->has('interestes')) {
            foreach ($request->input('interestes') as $interest) {
                DB::table('userinterestes')->insert([
                    'uIntIntId'=>$interest,
                    'uIntUserId'=>$user->id
                ]);
            }
        }

        if ($request->has('hobbies')) {
            foreach ($request->input('hobbies') as $hobby) {
                DB::table('userhobbies')->insert([
                    'uHobHobId'=>$hobby,
                    'uHobUserId'=>$user->id
                ]);
            }
        }

        return view('auth.sign-complete')->with('user',$user);
    }


    /**
     * Activate the account
     */
    public function activateAccount($activationcode){
        // Compare the activation code with the database
        $theUser = DB::table('users')->where('uActiveCode', '=', $activationcode)->first();

        if (!empty($theUser)) {
            $user = User::find($theUser->id);
                // Update the database
                $user->uActive = '1';
                $user->uActiveCode = "";
                $user->save();

                // Congratulations
                $data = array('name'=>$theUser->name);
                $username = $theUser->name;
                $usermail = $theUser->email;

                $subjectUser = 'Congratulations ' . $username;
                $messageUser = view('emails.registered', $data);

                $headersUser = "From: Cayshly<". config('maildata.from') ."> \r\n";
                // $headersUser .= "BCC: ". config('maildata.bcc') ."\r\n";
                $headersUser .= "MIME-Version: 1.0\r\n";
                $headersUser .= "Content-Type: text/html; charset=UTF-8\r\n";

                mail($usermail, $subjectUser, $messageUser, $headersUser);


                // Mail::send('emails.registered', $data, function ($message) use ($usermail, $username){  
                //     $message->from('no-replay@cayshly.com', 'Cayshly');
                //     $message->to($usermail, $username);
                //     $message->cc('ahmsam39@gmail.com', 'Cayshly');
                //     $message->subject('Congratulations ' . $username);
                // });

                // Return to view
                return view('auth.activate-account')->with('user',$theUser);
        }
        return redirect('/');

    }

    /**
     * 
     */
    public function signRefNew(Request $request)
    {
         // Insert new user
        $user = new User();

        $user->name = $request->input('fname');
        $user->lastName = $request->input('lname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = bcrypt($request->input('password'));
        $user->gender = 'male';
        $user->uImg = 'default-boy.jpg';
        $user->uCover = 'default.jpg';
        
        $user->dateOfBirth = '00/00/0000';
        $user->parentEmail = $this->parentEquation($request->input('parentEmail'));

        // Generate activation code
        $activationCode = sha1($request->input('email'));
        $user->uActive = '0';
        $user->uActiveCode = $activationCode;
        
        // Save new user
        $user->save();
        
        /*// Send user activation code
        $data = ['name' => $request->input('fname'), 'activationCode' => $activationCode ];
        $username = $request->input('fname');
        $toUser = $request->input('email');
        $subjectUser = 'Activate Cayshly Account';
        $messageUser = view('emails.activation', $data);

        $headersUser = "From: Cayshly<". config('maildata.from') ."> \r\n";
        // $headersUser .= "BCC: ". config('maildata.bcc') ."\r\n";
        $headersUser .= "MIME-Version: 1.0\r\n";
        $headersUser .= "Content-Type: text/html; charset=UTF-8\r\n";

        mail($toUser, $subjectUser, $messageUser, $headersUser);*/

        return redirect('/');
    }


    /**
     * Get Reset password
     */
    public function getResetPassword(){
        return view('auth.reset-password');
    }

    /**
     * Post Reset password
     */
    public function postResetPassword(Request $r){
        $email = $r->input('email');
        $user = DB::table('users')->where('email','=',$email)->first();

        if (!empty($user)) {
            // Generate token
            $token = md5(md5(rand(10, 458763)) . md5($email)) . md5(md5(rand(10, 458763)));

            // Update user remember token field
            DB::table('users')->where('email','=',$email)->update(['remember_token'=>$token]);

            // Send message
            $data = array('name'=>$user->name, 'code'=>$token);

            $subject = 'Reset your password';
            $message = view('emails.resetpassword', $data);

            $headers = "From: Cayshly<". config('maildata.from') ."> \r\n";
            // $headers .= "BCC: ". config('maildata.bcc') ."\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            mail($user->email, $subject, $message, $headers);

            // Redirect user
            return view('auth.reset-password-message')->with('msg', "<div style='text-align:center;color:#3c763d;background-color: #dff0d8;border-color: #d6e9c6;padding: 40px;font-size: 20px;font-family: arial;margin: 5%;border-radius: 10px;'>We Sent you email to reset your password .. please check your email</div>");
        }else{

            // User not exist
            return redirect('/');
        }

    }


    /**
     * Post Reset password Activate
     */
    public function getResetPasswordActivate($code){
        // Check the code
        $user = DB::table('users')->where('remember_token','=',$code)->first();

        if (!empty($user)) {
            // Encrypt user
            $userEncryptedId = (int) $user->id * 85422315; 
            $userEncryptedEmail = $user->email;

            // Return view if success
            return view('auth.reset-password-activate')->with('userEncryptedId', $userEncryptedId)->with('userEncryptedEmail', $userEncryptedEmail);
        }else{
            // User not exist
            return redirect('/');
        }

    }

    /**
    * Post Reset password Activate
    */
    public function postResetPasswordActivateDone(Request $r){
        $newPassword = $r->input('newPassword');
        $rePassword = $r->input('rePassword');
        $uei57 = $r->input('uei57');
        $userDecryptedId = $uei57 / 85422315;
        $userDecryptedEmail = $r->input('uee63');

        $userToUpdate = DB::table('users')->where('id','=',$userDecryptedId)->where('email','=',$userDecryptedEmail)->first();

        if (!empty($userToUpdate)) {
            if ($newPassword != '' && $rePassword != '') {
                if ($newPassword == $rePassword) {
                    // Update user remember token field
                    DB::table('users')->where('email','=',$userToUpdate->email)->update([
                        'password'=>bcrypt($newPassword),
                        'remember_token'=>'',
                        ]);
                    // Redirect user
                    return view('auth.sign-global')->with('msg', "<div style='text-align:center;color:#3c763d;background-color: #dff0d8;border-color: #d6e9c6;padding: 40px;font-family: arial;margin: 5% auto;border-radius: 10px;'>You have successfully reset your password .. please login with new password:</div>");

                }else{
                    // Passwords not matched
                    return redirect('/');
                }         
            }else{
                // Passwords empty
                return redirect('/');
            }
        }else{
            // User not exist
            return redirect('/');
        }

    }


}
