@extends ('layouts.dashboard')
@section('page_heading','Message Center')
@section('section')
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="{{URL::to('messages')}}">Messages @include('messenger.unread-count')</a>
        </li>
        
        <li>
            <a href="{{URL::to('messages/create')}}">New Message</a>
        </li>

    </ul>
    <div class="container">
        @yield('content')
    </div>
@stop
