<div class="panel panel-default">
	<div class="panel-heading">
		<div class="level">
			<h5 class="flex">
				<a href="{{ route('profile', $reply->owner) }}">
					{{$reply->owner->name}}
				</a> <i>said </i> {{$reply->created_at->diffForHumans()}}
			</h5>
			<div>
				{!! Form::open(['route' => ['favorites', $reply->id]]) !!}
				{!! Form::button($reply->favorites_count . ' ' . str_plural('Favorite', $reply->favorites_count), ['type' => 'submit', 'class' => 'btn btn-default', $reply->isFavorited() ? 'disabled' : '']) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="panel-body">
		{{$reply->body}}
	</div>
</div>