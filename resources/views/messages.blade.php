@extends ('layouts.dashboard')
@section('page_heading','Messages')
@section('section')
<div class="col-sm-12">	
	<div class="row">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="{{URL::to('messages')}}">Messages @include('messenger.unread-count')</a>
			</li>
            <li>
            	<a href="{{URL::to('messages/create')}}">New Message</a>
            </li>

		</ul>

	</div>
</div>
@stop
