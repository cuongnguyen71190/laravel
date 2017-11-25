@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Create a New Thread</div>
				<div class="panel-body">
					{!! Form::open(['route' => 'threads.store']) !!}
						<div class="form-group">
							{!! Form::label('channel_id', 'Choose a Channel') !!}	
							{!! Form::select('channel_id', $channels, old('channel_id'), ['class' => 'form-control', 'id' => 'channel_id']) !!}
							@if ($errors->has('channel_id'))
							    <div class="error alert alert-danger">{{ $errors->first('channel_id') }}</div>
							@endif
						</div>

						<div class="form-group">
							{!! Form::label('title', 'Title') !!}
							{!! Form::text('title', old('title'), ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'title']) !!}
							@if ($errors->has('title'))
							    <div class="error alert alert-danger">{{ $errors->first('title') }}</div>
							@endif
						</div>

						<div class="form-group">
							{!! Form::label('body', 'Body') !!}
							{!! Form::textarea('body', old('body'), ['class' => 'form-control', 'id' => 'body', 'placeholder' => 'body', 'rows' => 8]) !!}
							@if ($errors->has('body'))
							    <div class="error alert alert-danger">{{ $errors->first('body') }}</div>
							@endif
						</div>

						<div class="form-group">
							{!! Form::submit('Post', ['class' => 'btn btn-primary']) !!}
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection