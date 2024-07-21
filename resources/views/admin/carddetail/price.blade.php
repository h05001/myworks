
@extends('layouts.admin')
@section('title', '価格情報')

@section('content')
<div class="container">

        <div class="col-md-12 mx-auto">
            <div class="row">
                <div>{{ $carddetail->card_name }}:価格情報</div>
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
                    @foreach($rarity_list as $key => $rarity_lists)
                        <tr>
                            <th colspan="4">{{ str_limit($rarity_lists, 50) }}</th>
                            <th colspan="4">
                                <a href="{{ action('Admin\CardDetailController@historyAvg', ['id' => $key]) }}">変動歴(平均)</a>
                            </th>
                        </tr>
                        @foreach($lastprice as $lastprices)
                            @if($rarity_lists == $lastprices->rarity_jp)
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
                                    <a href="{{ action('Admin\CardDetailController@history', ['id' => $lastprices->id, 'cardshop_id' => $lastprices->cardshop_id, 'note' => $lastprices->notes]) }}">変動歴</a>
                                </div>

                            </td>
                            @endif
                        @endforeach
                    @endforeach
                        <tbody>

                    </tbody>
                </table>
            </div>


</div>


@endsection
