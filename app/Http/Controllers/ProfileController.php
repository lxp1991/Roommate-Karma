<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use DB;
use Flash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    //

    public function showUserById($id) {

        $profile = DB::table('users')
            ->where('id', $id)
            ->first();
        
        $address = DB::table('residences')
            ->where('userid', $id)
            ->where('isActive', true)
            ->first();

        if (count($address) == 0) {
            $location = "Not set up yet";  
        } else {
            $location = $address->address1
                        . " " 
                        . $address->address2 
                        . " "
                        . $address->city
                        . " "
                        . $address->state
                        . " "
                        . $address->zipcode;            
        }

        return view('profile', array('profile' => $profile, 'location' => $location));
    }

    public function showCurrentUser() {
    	$user = Auth::user();
    	$userid = $user->id;

    	$profile = DB::table('users')
    		->where('id', $userid)
    		->first();
    	
    	$address = DB::table('residences')
    		->where('userid', $userid)
    		->where('isActive', true)
    		->first();

    	if (count($address) == 0) {
            $location = "Not set up yet";  
        } else {
            $location = $address->address1
                        . " " 
                        . $address->address2 
                        . " "
                        . $address->city
                        . " "
                        . $address->state
                        . " "
                        . $address->zipcode;            
        }



    	return view('profile', array('profile' => $profile, 'location' => $location));
    }
}
