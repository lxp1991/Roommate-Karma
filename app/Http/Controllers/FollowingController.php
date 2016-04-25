<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Auth;
use Flash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class FollowingController extends Controller
{
    //
    public function follow($followingId) {
    	$currentUser = Auth::user();
        $currentUserId = $currentUser->id;

    	$record = DB::table('followings')
    		->where('userId', $currentUserId)
    		->where('followingId', $followingId)
    		->first();
    	
    	if (count($record) == 1) {
    		return "You have already followed the user";
    	} else {
    		DB::table('followings')->insert([
	    		'userId' => $currentUserId,
	    		'followingId' => $followingId,
    		]);

            DB::table('activities')->insert([
                'action' => 'userFollow',
                'userId' => $currentUserId,
                'dateTime' => Carbon::now(),
                'followingId' => $followingId,
            ]);
    	}
    	
        Flash::success('You have followed this user');

    	return Redirect::to('/user/list');

    }

    public function unfollow($followingId) {
    	$currentUser = Auth::user();
        $currentUserId = $currentUser->id;

    	$record = DB::table('followings')
    		->where('userId', $currentUserId)
    		->where('followingId', $followingId)
    		->first();

    	if (count($record) == 0) {
    		return "Error, you have not followed the user";
    	} else {
    		DB::table('followings')
    		    ->where('userId', $currentUserId)
    			->where('followingId', $followingId)
    			->delete();
            DB::table('activities')->insert([
                'action' => 'userUnfollow',
                'userId' => $currentUserId,
                'dateTime' => Carbon::now(),
                'followingId' => $followingId,
                ]);
    	}

    	Flash::success('You have unfollowed this user');

    	return Redirect::to('/user/list');
    }
}
