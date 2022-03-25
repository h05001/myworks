@extends('layouts.admin')
@section('title', '価格情報')

@section('content')
<div class="container">

    <form action="{{ action('Admin\CardDetailController@price') }}" method="get" enctype="multipart/form-data">

        <div class="list-news col-md-12 mx-auto">
            <div class="row">

                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="25%">カードショップ</th>
                            <th width="10%">収録パック</th>
                            <th width="10%">収録カードID</th>
                            <th width="20%">レアリティ</th>
                            <th width="10%">価格</th>
                            <th width="10%">備考</th>
                            <th width="15%">情報取得日</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <th>{{ $post->id }}</th>
                                <td>{{ str_limit($post->cardshop, 50) }}</td>
                                <td>{{ str_limit($post->recordingpackid, 50) }}</td>
                                <td>{{ str_limit($post->recordingcardid, 50) }}</td>
                                <td>{{ str_limit($post->rarity_jp, 50) }}</td>
                                <td>{{ str_limit($post->cardprice, 50) }}</td>
                                <td>{{ str_limit($post->notes, 50) }}</td>
                                <td>{{ str_limit($post->created_at, 50) }}</td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </form>

</div>


@endsection
