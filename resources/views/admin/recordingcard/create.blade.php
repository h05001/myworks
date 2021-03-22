{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'パック名収録カード情報'を埋め込む --}}
@section('title', 'パック名収録カード一覧')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>パック名収録カード一覧</h2>
            <form action="{{ action('Admin\RecordingCardController@create') }}" method="post" enctype="multipart/form-data">

                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group row">
                    <label class="col-md-3" for="cardname">カード名</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="cardname" value="{{ old('cardname') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3" for="recordingpackid">収録パックID</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="recordingpackid" value="{{ old('recordingpackid') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3" for="title">収録カードID</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="recordingcardid" value="{{ old('recordingcardid') }}">
                    </div>
                </div>
                <div class="form-group row">
                      <label class="col-md-3" for="rarity">レアリティ</label>
                      <div class="col-md-9">
                          <input type="text" class="form-control" name="rarity" value="{{ old('rarity') }}">
                      </div>
                </div>
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="更新">
            </form>
        </div>
    </div>
</div>
@endsection
