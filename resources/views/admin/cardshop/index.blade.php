@extends('layouts.admin')
@section('title', '登録済みカードショップの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>カードショップ一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\CardShopController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\CardShopController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="30%">カードショップ名</th>
                                <th width="50%">URL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $cardshop)
                                <tr>
                                    <th>{{ $cardshop->id }}</th>
                                    <td>{{ str_limit($cardshop->cardshop, 100) }}</td>
                                    <td>{{ str_limit($cardshop->URL, 250) }}</td>
                                    <td>
                                      <div>
                                          <a href="{{ action('Admin\CardShopController@edit', ['id' => $cardshop->id]) }}">編集</a>
                                      </div>
                                      <div>
                                          <a href="{{ action('Admin\CardShopController@delete', ['id' => $cardshop->id]) }}">削除</a>
                                      </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
