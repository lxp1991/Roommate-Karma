@extends('layouts.message-layout')
@section('content')
<div class="col-sm-12"> 
    <div class="row">
    @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {!! Session::get('error_message') !!}
        </div>
    @endif
    @if($threads->count() > 0)
        @foreach($threads as $thread)
        <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
        <div class="media alert {!!$class!!}">
            <h4 class="media-heading">{!! link_to('messages/' . $thread->id, $thread->subject) !!}</h4>
            <p>{!! $thread->latestMessage->body !!}</p>
            <p><small><strong>Published by:</strong> {!! $thread->creator()->first_name . ' '. $thread->creator()->last_name !!}</small></p>
            <p><small><strong>Updated at:</strong> {!! $thread->getLatestMessageAttribute()->created_at->diffForHumans() !!}</small></p>
        </div>
        @endforeach
    @else
        <p>Sorry, no threads.</p>
    @endif

    @if($threads->count() > 0)
    <ul class="timeline">
        @for ($i = 0; $i < count($threads); $i++)

            @if ($i % 2 == 1)
                <li class="timeline-inverted">
            @else
                <li>
            @endif
                    @if ($random = rand(0, 5)) @endif

                    @if ($random == 1)
                        <div class="timeline-badge">
                    @elseif ($random == 2)
                        <div class="timeline-badge success">
                    @elseif ($random == 3)
                        <div class="timeline-badge danger">
                    @elseif ($random == 4)
                        <div class="timeline-badge warning">
                    @else
                        <div class="timeline-badge info">
                    @endif

                    @if ($random == 1)
                            <i class="fa fa-check"></i>
                    @elseif ($random == 2) 
                            <i class="fa fa-legal"></i>
                    @elseif ($random == 3)
                            <i class="fa fa-play"></i>
                    @else 
                            <i class="fa fa-adjust"></i>
                    @endif 
                </div>

                <?php $class = $threads[$i]->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                <div class="timeline-panel media alert {!!$class!!}">

                    <div class="timeline-heading">
                        <h3 class="timeline-title">{!! link_to('messages/' . $threads[$i]->id, $threads[$i]->subject) !!}</h3>
                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{ $threads[$i]->getLatestMessageAttribute()->created_at->diffForHumans() }}</small>
                        <small class="text-muted"><i class="fa fa-user"></i> {{ $threads[$i]->creator()->first_name . ' '. $threads[$i]->creator()->last_name }}</small>
                        </p>
                    </div>

                    <div class="timeline-body">
                        <p>{!! $threads[$i]->latestMessage->body !!}</p>
                    </div>
                </div>

            </li>

        @endfor
    </ul>
    @else
        <p>Sorry, no threads.</p>
    @endif
    </div>
</div>
@stop