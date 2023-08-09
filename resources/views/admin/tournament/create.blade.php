{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'カード価格情報'を埋め込む --}}
@section('title', '大会情報の登録')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>大会情報の登録</h2>
                <form action="{{ action('Admin\TournamentController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">大会名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="tournament_name" value="{{ old('tournament_name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">開催日</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="date" value="{{ old('date') }}">
                        </div>
                    </div>


                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection
