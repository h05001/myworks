{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'カード価格情報'を埋め込む --}}
@section('title', '入賞デッキ情報の登録')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>入賞デッキ情報の登録</h2>
                <form action="{{ action('Admin\TournamentDeckController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="form-group row">
                        <label class="col-md-2">大会ID</label>
                        <div class="col-md-10">

                            {{Form::select('tournament_id', $tournament_list, $cnt, ['class' => 'form-control'])}}
                            {{--<select name="tournament_id" class="form-control"  value="{{ old('tournament_id') }}">

                                @foreach ($tournament_list as $lists) {
                                    @if ( {{ $lists->id == $cnt }})
                                        echo '<option value="{{ $lists->id }}">{{ $lists->tournament_name }}</option>';
                                    @endif
                                }
                                @endforeach --}}

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">デッキ名</label>
                        <div class="col-md-10">
                            <input type="テキスト" class="form-control" name="deck_name" value="{{ old('deck_name') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2">順位</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control" name="rank" value="{{ old('rank') }}">
                        </div>
                    </div>

                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection
