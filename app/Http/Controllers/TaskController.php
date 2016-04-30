<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Http\Requests;
use Flash;

class TaskController extends Controller
{
    //

    public function listAll() {
        $user = Auth::user();
        $userid = $user->id;
        $takenTasks = DB::table('activities')
            ->where('userId', $userid)
            ->where('action', 'taskTake')
            ->get();
        $tasks = [];
        foreach ($takenTasks as $task) {
            $t = DB::table('tasks')
                ->where('taskId', $task->taskId)
                ->first();
            if ($t != null) {
                array_push($tasks, $t);
            }
        }

        return view('tasklist', array('tasks' => $tasks));
    }

    public function done($taskId) {
        $user = Auth::user();
        $userid = $user->id;
        
        $bountyGet = DB::table('tasks')
            ->where('taskId', $taskId)
            ->value('bounty');
        
        DB::table('tasks')
            ->where('taskId', $taskId)
            ->update(['isCompleted' => true]);

        DB::table('tasks')
            ->where('taskId', $taskId)
            ->update(['completeDate' => Carbon::now()]);
        
        $bountyOrigin = DB::table('users')
            ->where('id', $userid)
            ->value('karmaScores');

        $bountyTotal = $bountyOrigin + $bountyGet;
        DB::table('users')
            ->where('id', $userid)
            ->update(['karmaScores' => $bountyTotal]);


        DB::table('activities')->insert([
            'action' => 'taskComplete',
            'userId' => $userid,
            'dateTime' => Carbon::now(),
            'taskId' => $taskId,
        ]);

        Flash::success('Congratulation. You have earned ' 
            . $bountyGet 
            . " this time! Total bounty: " 
            . $bountyTotal);
        return Redirect::to('task/list');
    }

    public function take($taskId) {
        $user = Auth::user();
        $userid = $user->id;
        $preEntry = DB::table('activities')
            ->where('userId', $userid)
            ->where('taskId', $taskId)
            ->get();
        if (count($preEntry) == 0) {
            DB::table('tasks')
                ->where('taskId', $taskId)
                ->update(['isTaken' => true]);
            DB::table('activities')->insert([
                'action' => 'taskTake',
                'userId' => $userid,
                'dateTime' => Carbon::now(),
                'taskId' => $taskId,
            ]);
            Flash::success('Remember to complete before deadline.');
            return Redirect::to('task/view');
        } else {
            Flash::error('You have already taken that task.');
            return "You have already taken that task.";
        }

    }


    public function view() {
        $tasks = DB::table('tasks')->get();
        return view('viewtask')->with('tasks', array_reverse($tasks));
    }

    public function store(Request $request) {
    	$user = Auth::user();
    	$userid = $user->id;

        $bountyOrigin = DB::table('users')
            ->where('id', $userid)
            ->value('karmaScores');

        if ($request->input('bounty') > $bountyOrigin) {
            Flash::error('Sorry, you do not have enough bounty');
            
            return Redirect::to('task/create')
                ->with('bountyOrigin', $bountyOrigin);
        }

        //validate the submitted form
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'max:65535',
            'deadline' => 'max:255|date',
            'bounty' => 'required|max:255',
        ]);
    	
        $residence = DB::table('residences')
            ->where('userid', $userid)
            ->where('isActive', true)
            ->first();

    	if (count($residence) == 0) {
            Flash::error('You have not registered with an address, please add an address first');
            return Redirect::to('/address/update');
        }

    	$residenceid = $residence->residenceId;
        DB::table('tasks')->insert([
            'residenceId' => $residenceid,
            'userId' => $userid,
            'isTakenById' => 0,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'releaseDate' => Carbon::now(),
            'deadline' => $request->input('deadline'),
            'bounty' => $request->input('bounty'),
            'isActive' => true,
            'isTaken' => false,
            'isCompleted' => false,
        ]);

        $newBounty = $bountyOrigin - $request->input('bounty');

        DB::table('users')
            ->where('id', $userid)
            ->update(['karmaScores' => $newBounty]);

        $taskId = DB::table('tasks')
            ->where('residenceId', $residenceid)
            ->where('userId', $userid)
            ->where('title', $request->input('title'))
            ->where('description', $request->input('description'))
            ->where('deadline', $request->input('deadline'))
            ->where('bounty', $request->input('bounty'))
            ->first()->taskId;
        

        DB::table('activities')->insert([
            'action' => 'taskCreate',
            'userId' => $userid,
            'dateTime' => Carbon::now(),
            'taskId' => $taskId,
        ]);
        
        Flash::success('A new task has been posted!');
    	return Redirect::to('/');

    }
}
