<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Point;
use App\User;

class PointsController extends Controller
{
    /**
     * Get total points
     */
    public function getTotalPoints(){
        $userId = Auth::user()->id;
        $redeemedPoints = DB::select("select SUM(PoAmount) as red from points where PoUserId = $userId AND PoFrom = 'redeeming' AND PoConfirm = 1");
        $purchasedPoints = DB::select("select SUM(PoAmount) as pur from points where PoUserId = $userId AND PoFrom = 'purchasing' AND PoConfirm = 1");
        $totalPoints = $purchasedPoints[0]->pur - $redeemedPoints[0]->red;
        return $totalPoints;
    }

    /**
     * Dispaly all points
     */
    public function getAllPoints(){
        $userId = Auth::user()->id;
        $points = Point::where('PoUserId','=',$userId)->where('PoConfirm','=',1)->get();
        return view('points.show', ['points'=>$points, 'total'=>$this->getTotalPoints()]);
    }


    public function upPoints(){
        $gets = Point::all();
        foreach ($gets as $get) {
            $po = Point::find($get->PoId);
            $po->PoConfirm = 1;
            $po->save();
        }
    }

    // Send 5000 Points To Users
    public function sendFHPoints(){
        $users = User::all();
        
        $count = 1;
        
        set_time_limit(200);

        foreach ($users as $user) {
            // Increase The Points
            $newPoint = new Point;
            $newPoint->PoUserId = $user->id;
            $newPoint->PoProductId = 0;
            $newPoint->PoProductName = "initials";
            $newPoint->PoAmount = 5000;
            $newPoint->PoItemNums = 1;
            $newPoint->PoFrom = "purchasing";
            $newPoint->PoStatus = "increased";
            $newPoint->PoConfirm = 1;
            $newPoint->save();

            // Update The User
            $userToUpdate = User::find($user->id);
            $userToUpdate->uPointActive = 0;
            $userToUpdate->save();

            // Send Email
            $tousername     = $user->name;
            $touseremail    = $user->email;

            $subject = 'مبروك تم اضافة 5000 نقطه لحسابك';
            $message = view('emails.points_new', ['username' => $tousername]);

            $headers = "From: Cayshly<". config('maildata.from') ."> \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            mail($touseremail, $subject, $message, $headers);

            $count++;

        }

        echo "Done For $count User";
    }

    // confirmPoints
    public function confirmPoints()
    {
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            $user->uPointActive = 0;
            $user->save();
            return redirect('/');
        }
        else
        {
            return redirect('/');
        }
    }
}
