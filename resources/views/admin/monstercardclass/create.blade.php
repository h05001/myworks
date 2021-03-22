{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'リンクモンスターカード詳細情報')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>モンスターカードクラス情報　新規作成</h2>
                <form action="{{ action('Admin\MonsterCardClassController@create') }}" method="post" enctype="multipart/form-data">

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
                        <label class="col-md-3" for="class_id">種類ID</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="class_id" value="{{ old('class_id') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="monster_card_class">モンスターカード種類</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="monster_card_class" value="{{ old('monster_card_class') }}">
                        </div>
                    </div>
                    

                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">

                </form>
            </div>
        </div>
    </div>
@endsection
