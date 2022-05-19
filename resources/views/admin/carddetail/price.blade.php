
@extends('layouts.admin')
@section('title', '価格情報')

@section('content')
<div class="container">

        <div class="col-md-12 mx-auto">
            <div class="row">

                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="25%">カードショップ</th>
                            <th width="10%">収録パック</th>
                            <th width="10%">収録カードID</th>
                            <th width="20%">レアリティ</th>
                            <th width="5%">価格</th>
                            <th width="10%">備考</th>
                            <th width="15%">情報取得日</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($lastprice as $lastprices)
                          <tr>
                              <th>{{ $lastprices->id }}</th>
                              <td>{{ str_limit($lastprices->cardshop, 50) }}</td>
                              <td>{{ str_limit($lastprices->recordingpackid, 50) }}</td>
                              <td>{{ str_limit($lastprices->recordingcardid, 50) }}</td>
                              <td>{{ str_limit($lastprices->rarity_jp, 50) }}</td>
                              <td>{{ str_limit($lastprices->cardprice, 50) }}</td>
                              <td>{{ str_limit($lastprices->notes, 50) }}</td>
                              <td>{{ str_limit($lastprices->created_at, 50) }}</td>


                          </tr>
                          <td>
                              <div>
                                  <a href="{{ action('Admin\CardDetailController@history', ['id' => $lastprices->id]) }}">変動歴</a>
                              </div>
                          </td>
                      @endforeach
                    </tbody>
                </table>
            </div>


</div>


@endsection
