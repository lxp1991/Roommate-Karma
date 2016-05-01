<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/');
    }

    public function home() {
        $user = Auth::user();
        $userid = $user->id;
        $takenTasks = DB::table('activities')
            ->where('userId', $userid)
            ->where('action', 'taskTake')
            ->get();
        $completedTasks = DB::table('activities')
            ->where('userId', $userid)
            ->where('action', 'taskComplete')
            ->get();
        $undoTasks = count($takenTasks) - count($completedTasks);
        
        $followings = DB::table('followings')
            ->where('userId', $userid)
            ->get();

        $bounty = DB::table('users')
            ->where('id', $userid)
            ->value('karmaScores');

        $activities = DB::table('activities')
            ->where('userId', $userid)
            ->orderBy('dateTime', 'desc')
            ->take(10)
            ->get();

        $currentUserId = Auth::user()->id;
        // All threads, ignore deleted/archived participants
        $threads = Thread::getAllLatest()->get();
         
        return view('home', array('undoTasks' => $undoTasks
            , 'followings' => count($followings)
            , 'bounty' => $bounty
            , 'activities' => $activities
            , 'threads' => $threads
            , 'currentUserId' => $currentUserId));
    }

}
