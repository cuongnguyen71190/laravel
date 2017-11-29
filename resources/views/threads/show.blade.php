@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="level">
						<span class="flex">
							<a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> <i>posted: </i>
							{{$thread->title}}
						</span>
						
						@can('update', $thread)
						{!! Form::open(['method' => 'POST', 'url' => $thread->path()]) !!}
							{!! method_field('DELETE') !!}
							{!! Form::button('Delete thread', ['class' => 'btn btn-link', 'type' => 'submit']) !!}
						{!! Form::close() !!}
						@endcan
					</div>
				</div>

				<div class="panel-body">
					{{$thread->body}}
				</div>
			</div>

			@foreach ($thread->replies as $reply)
				@include('threads.reply')
			@endforeach

			{{ $replies->links() }}

			@if(auth()->check())
				<form method="POST" action="{{$thread->path() . '/replies'}}">
					{{csrf_field()}}
					<div class="form-group">
						<textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
					@if ($errors->has('body'))
					    <div class="error">{{ $errors->first('body') }}</div>
					@endif
					</div>

					<button type="submit" class="btn btn-default">Post</button>
				</form>
			@else
			<p style="text-align: center;">Please <a href="{{ route('login') }}">sign in</a> to participate this discussion.</p>
			@endif
		</div>

		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-body">
					This thread was published {{ $thread->created_at->diffForHumans() }} by 
					<a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>, and currently has {{ $thread->replies_count }} {{ str_plural('commnet', $thread->replies_count) }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection