{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'カード詳細情報')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>カード詳細情報　新規作成</h2>
                <form action="{{ action('Admin\CardDetailController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-3" for="title">カード名</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="card_name" value="{{ old('card_name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="title">読み方</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="ruby" value="{{ old('ruby') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="title">カード分類</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="card_class" value="{{ old('card_class') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3" for="title">カードテキスト</label>
                        <div class="col-md-9">
                          <textarea class="form-control" name="card_text" rows="15">{{ old('card_text') }}</textarea>

                        </div>
                    </div>

                    <div class="form-group row">
                         <label class="col-md-2" for="image">カード画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">

                </form>
            </div>
        </div>
    </div>
@endsection
