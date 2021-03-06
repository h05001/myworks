@extends('layouts.admin')
@section('title', '収録パック情報の編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>収録パック情報の編集</h2>
                <form action="{{ action('Admin\RecordingPackController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-3" for="title">収録パック名</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="recordingpack" value="{{ $recordingpack_form->recordingpack }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="title">収録パックID</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="recordingpackid" value="{{ $recordingpack_form->recordingpackid }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $news_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
