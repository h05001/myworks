@extends('layouts.admin')
@section('title', '価格データの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>価格データ一覧</h2>
        </div>
        <div class="row">
            <form action="{{ action('Admin\CardDetailController@import') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8">

                    <div class="grid grid-cols-1">
                        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">CSVファイルを選択（必須）</label>
                        <input type='file' name='import' />

                    </div>
                </div>
                <button type="submit" class='bg-gray-500 hover:bg-gray-700 text-black font-bold py-1 px-3 mt-1 rounded'>登録</button>
            </form>

            <div class="col-md-12">
                <form action="{{ action('Admin\CardPriceController@index') }}" method="get">
                   <div class="form-group row">

                  </div>
                </form>
            </div>
        <div class="col-md-4">
            <a href="{{ action('Admin\CardPriceController@add') }}" role="button" class="btn btn-primary">新規作成</a>
        </div>

        <div class="row">
              <div class="list-news col-md-12 mx-auto">
                  <div class="row">

                   <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="45%">カード名</th>
                                <th width="25%">収録カードID</th>
                                <th width="25%">レアリティ</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $cardprice)
                                <tr>
                                    <th>{{ $cardprice->id }}</th>
                                    <td>{{ str_limit($cardprice->card_name, 50) }}</td>
                                    <td>{{ str_limit($cardprice->recordingcardid, 50) }}</td>
                                    <td>{{ str_limit($cardprice->rarity, 50) }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
