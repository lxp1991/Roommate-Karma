@extends ('layouts.dashboard')
@section('page_heading','Task History')
@section('section')
<div class="row">
    @if(Session::has('flash_notification.message'))
        <div class="alert alert-{{ Session::get('flash_notification.level') }}" id="addr-success-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Success!</strong> {{ Session::get('flash_notification.message') }}
        </div>
    @endif  
    <div class="col-lg-7 col-lg-offset-1">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Deadline</th>
                        <th>Complete Date</th>
                        <th>Bounty</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($tasks); $i++)
                        <tr>
                            <td>{{ $tasks[$i]->title }}</td>
                            <td>{{ $tasks[$i]->deadline }}</td>
                            <td>{{ $tasks[$i]->completeDate }}</td>
                            <td>{{ $tasks[$i]->bounty }}</td>
                            <td>
                            @if ($tasks[$i]->isCompleted)
                                <button type="button" class="btn btn-success btn-sm btn-block" disabled>Completed</button>          
                            @else
                                {{ Form::open(array('action' => array('TaskController@done', $tasks[$i]->taskId))) }}
                                {{ Form::submit('I have done!', array('class' => 'btn btn-info btn-sm btn-block')) }}
                                {{ Form::close() }} 
                            @endif
                            </td>
                            
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
