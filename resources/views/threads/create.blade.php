@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a New Thread</div>
                    <div class="panel-body">
                        <form action="/threads" method="post" role="form">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="channel" class="control-label">Channel</label>
                                <select class="form-control" id="channel" name="channel_id">
                                    <option value="">Choose One...</option>
                                    @foreach($channels as $channel)
                                    <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : ''  }} >{{ $channel->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                            </div>

                            <div class="form-group">
                                <label for="body" class="control-label">Body:</label>
                                <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{ old('body') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Publish</button>

                            <div class="form-group">
                                @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection