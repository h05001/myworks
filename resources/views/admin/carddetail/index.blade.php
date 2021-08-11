@extends('layouts.admin')
@section('title', '登録済みカードの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>登録カード一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\CardDetailController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\CardDetailController@index') }}" method="get">
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
                                <th width="5%">ID</th>
                                <th width="25%">カード名</th>
                                <th width="25%">読み</th>
                                <th width="10%">カードの種類</th>
                          <!--  <th width="10%">カード画像</th> -->
                                <th width="35%">カードテキスト</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $carddetail)
                                <tr>
                                    <th>{{ $carddetail->id }}</th>
                                    <td>{{ str_limit($carddetail->card_name, 50) }}</td>
                                    <td>{{ str_limit($carddetail->ruby, 50) }}</td>
                                    <td>{{ str_limit($carddetail->card_class, 50) }}</td>
                          <!--      <td>{{ str_limit($carddetail->image_path, 50) }}</td> -->
                                    <td>{{ str_limit($carddetail->card_text, 300) }}</td>


                                    <td>
                                      <div>
                                          <a href="{{ action('Admin\CardDetailController@edit', ['id' => $carddetail->id]) }}">編集</a>
                                      </div>
                                      <div>
                                          <a href="{{ action('Admin\CardDetailController@delete', ['id' => $carddetail->id]) }}">削除</a>
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
