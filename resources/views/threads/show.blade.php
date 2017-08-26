@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#">{{ $thread->creator->name }}</a> posted:
                        {{ $thread->title }}
                    </div>

                    <div class="panel-body">
                        {{ $thread->body }}
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        This thread was published {{ $thread->created_at->diffForHumans() }} by John Doe, and
                        currently has {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}.
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                @foreach($replies as $reply)
                    @include ('threads.reply')
                @endforeach

                {{ $replies->links() }}
            </div>
        </div>

        @if (auth()->check())
            <div class="row">
                <div class="col-md-8">
                    <form method="POST" action="{{ '/threads/' . $thread->id . '/replies' }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Post</button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-center">Please <a href="{{ route('login') }}">sing in</a> to participate to this discussion.</p>
        @endif

    </div>
@endsection