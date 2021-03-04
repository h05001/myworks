{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'ペンデュラムモンスターカード詳細情報')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>ペンデュラムモンスターカード詳細情報　新規作成</h2>
                <form action="{{ action('Admin\PendulumMonsterCardDetailController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-3" for="title">カードマスタID</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="cardmasterid" value="{{ old('cardmasterid') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="title">属性</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="attribute" value="{{ old('attribute') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="title">種族/分類</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="tribe/class" value="{{ old('tribe/class') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="title">レベル/ランク</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="level/rank" value="{{ old('level/rank') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="title">スケール</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="scale" value="{{ old('scale') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="title">ペンデュラム効果</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name=pendulumeffect value="{{ old('pendulumeffect') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3" for="title">攻撃力</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="attack" value="{{ old('attack') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="title">守備力</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name=defense value="{{ old('defense') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="title">カードテキスト</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="cardtext" value="{{ old('cardtext') }}">
                        </div>
                    </div>


                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">

                </form>
            </div>
        </div>
    </div>
@endsection
