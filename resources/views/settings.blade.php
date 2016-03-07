@extends ('layouts.dashboard')
@section('page_heading','Settings')
@section('section')
<div class="col-sm-12">	
	<div class="row">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="{{ url ('settings') }}">Account</a>
			</li>
			<li>
				<a href="#">Privacy</a>
			</li>
		</ul>

	</div>
</div>
@stop