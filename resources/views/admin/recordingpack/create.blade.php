{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'収録パックの情報'を埋め込む --}}
@section('title', '収録パック名一覧')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>収録パック一覧</h2>
            <form action="{{ action('Admin\RecordingPackController@create') }}" method="post" enctype="multipart/form-data">

                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group row">
                    <label class="col-md-3" for="recordingpack">収録パック名</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="recordingpack" value="{{ old('recordingpack') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3" for="recordingpackid">収録パックID</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="recordingpackid" value="{{ old('recordingpackid') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3" for="category">カテゴリ</label>
                    <div class="col-md-9">
                        <select  name="category" class="form-control"  value="{{ old('category') }}">
                            <option value="">収録パックのカテゴリを選択</option>
                            <option value="0">基本ブースターパック</option>
                            <option value="1">構築済みデッキ</option>
                            <option value="2">その他ブースターパック</option>

                        </select>
                    </div>
                </div>
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="登録">

            </form>
        </div>
    </div>
</div>
@endsection
