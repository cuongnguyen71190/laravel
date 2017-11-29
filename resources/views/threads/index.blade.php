@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			@forelse ($threads as $thread)
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="level">
							<h4 class="flex">
								<a href="{{$thread->path()}}">{{$thread->title}}</a>
							</h4>
							<a href="{{ $thread->path() }}">
								{{ $thread->replies_count }}  {{ str_plural('reply', $thread->replies_count) }}
							</a>
							@can('update', $thread)
							{!! Form::open(['method' => 'POST', 'url' => $thread->path()]) !!}
								{!! method_field('DELETE') !!}
								{!! Form::button('Delete thread', ['class' => 'btn btn-link', 'type' => 'submit']) !!}
							{!! Form::close() !!}
							@endcan
						</div>
					</div>

					<div class="panel-body">
						<article>
							<div class="body">{{$thread->body}}</div>
						</article>
					</div>
				</div>
			@empty
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="flex">
							Nothing Found!
						</h4>
					</div>
				</div>
			@endforelse
		</div>
	</div>
</div>
@endsection