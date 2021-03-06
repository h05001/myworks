{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'モンスターカード詳細情報')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>モンスターカード詳細情報　新規作成</h2>
                <form action="{{ action('Admin\MonsterCardDetailController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-3" for="card_master_id">カードマスタID</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="card_master_id" value="{{ old('card_master_id') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="property">属性</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="property" value="{{ old('property') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="tribe">種族</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="tribe" value="{{ old('tribe') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="level">レベル</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="level" value="{{ old('level') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="rank">ランク</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="rank" value="{{ old('rank') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3" for="scale">スケール</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="scale" value="{{ old('scale') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="pendulum_effect">ペンデュラム効果</label>
                        <div class="col-md-9">
                          <textarea class="form-control" name="pendulum_effect" rows="15">{{ old('pendulum_effect') }}</textarea>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3" for="link">Link</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="link" value="{{ old('link') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="link_marker">マーカーの向き</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="link_marker" value="{{ old('link_marker') }}">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-md-3" for="attack">攻撃力</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="attack" value="{{ old('attack') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="defense">守備力</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="defense" value="{{ old('defense') }}">
                        </div>
                    </div>

                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">

                </form>
            </div>
        </div>
    </div>
@endsection
