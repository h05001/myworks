{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'カード名詳細情報'を埋め込む --}}
@section('title', 'カード名')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>カード名詳細情報</h2>

                <form action="{{ action('Admin\CardInfomationController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="cardname">カード名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="cardname" value="{{ old('cardname') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="cardclass">カード分類</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="cardclass" value="{{ old('cardclass') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="cardtext">カードテキスト</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="cardtext" value="{{ old('cardtext') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                          <label class="col-md-2" for="rarity">レアリティ</label>
                          <div class="col-md-10">
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
