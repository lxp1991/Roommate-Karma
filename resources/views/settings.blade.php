@extends ('layouts.dashboard')
@section('page_heading','Settings')
@section('section')
<div class="col-sm-12">	
	<div class="row">
		<ul class="nav nav-tabs">
			<li class="active">
				<a data-toggle="tab" href="#account">Account</a>
			</li>
			<li>
				<a data-toggle="tab" href="#privacy">Privacy</a>
			</li>
			<li>
				<a data-toggle="tab" href="#notifications">Notifications</a>
			</li>
			<li>
				<a data-toggle="tab" href="#labs">Labs</a>
			</li>

		</ul>
		<div class="tab-content">
			<div id="account" class="tab-pane fade in active">
				<div class="container">
    				<div class="row">
        				<div class="col-md-8">
            				<div class="panel panel-default">
               				<div class="panel-heading">Account</div>
	        					<div class="panel-body">
                            		<label class="col-md-3">Password</label>
			                        <div class="row">
			                        	<a href="{{ url('password/reset') }}">Reset</a>
			                        	
			                        </div>
			                        <label class="col-md-3">Address</label>
			                        <div class="row">
			                        	<a href=" {{ url ('address/update') }}">Update</a>
			                        	
			                        </div>
								</div>
				            </div>
				        </div>
				    </div>
				</div>
			</div>
			
			<div id="privacy" class="tab-pane fade">
				<h3>Privacy</h3>
			</div>
			<div id="notifications" class="tab-pane fade">
				<h3>Notifications</h3>
			</div>
			<div id="labs" class="tab-pane fade">
				<h3>Labs</h3>
			</div>
		</div>

	</div>
</div>
@stop
