@extends('layouts.admin')
@section('title', '収録カードの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>収録カード一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\RecordingCardController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\RecordingCardController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">収録カードID検索</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_recordingcardid" value="{{ $cond_recordingcardid }}">
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
                                <th width="35%">カード名</th>
                                <th width="15%">収録パックID</th>
                                <th width="15%">収録カードID</th>
                                <th width="20%">レアリティ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $recordingcard)
                                <tr>
                                    <th>{{ $recordingcard->id }}</th>
                                    <td>{{ str_limit($recordingcard->cardname, 100) }}</td>
                                    <td>{{ str_limit($recordingcard->recordingpackid, 100) }}</td>
                                    <td>{{ str_limit($recordingcard->recordingcardid, 100) }}</td>
                                    <td>{{ str_limit($recordingcard->rarity, 100) }}</td>
                                    <td>
                                      <div>
                                          <a href="{{ action('Admin\RecordingCardController@edit', ['id' => $recordingcard->id]) }}">編集</a>
                                      </div>
                                      <div>
                                          <a href="{{ action('Admin\RecordingCardController@delete', ['id' => $recordingcard->id]) }}">削除</a>
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
