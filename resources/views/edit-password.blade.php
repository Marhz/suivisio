@extends('layouts.app')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Reset Password</div>
		<div class="panel-body">
			@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
			@endif
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/changerMdp') }}">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="PUT"/>
				{{--<div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
					<label for="old_password" class="col-md-4 control-label">Ancien mot de passe</label>
					<div class="col-md-6">
						<input id="old_password" type="password" class="form-control" name="old_password" required autofocus>
						@if ($errors->has('old_password'))
							<span class="help-block">
								<strong>{{ $errors->first('old_password') }}</strong>
							</span>
						@endif
					</div>
				</div>--}}
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="password" class="col-md-4 control-label">Nouveau mot de passe</label>
					<div class="col-md-6">
						<input id="password" type="password" class="form-control" name="password" required>
						@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
					<label for="password-confirm" class="col-md-4 control-label">Confirmation</label>
					<div class="col-md-6">
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
						@if ($errors->has('password_confirmation'))
							<span class="help-block">
								<strong>{{ $errors->first('password_confirmation') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn btn-primary">
							Changer de mot de passe
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
