{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'パック名収録カード情報'を埋め込む --}}
@section('title', '収録カードの登録')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>収録カードの登録</h2>
            <form action="{{ action('Admin\RecordingCardController@create') }}" method="post" enctype="multipart/form-data">

                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group row">
                    <label class="col-md-3" for="cardname">カード名</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="cardname" value="{{ old('cardname') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3" for="card_master_id">カードマスタID</label>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="card_master_id" value="{{ old('card_master_id') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3" for="recordingpackid">収録パックID</label>
                    <div class="col-md-4">
                        {{Form::select('recordingpackid', $packlist, null, ['class' => 'form-control'])}}
                      <!--  {{Form::radio('recordingpackid', '$packlist', true, ['class' => 'form-control'])}}
                        <input type="radio" class="form-control" name="recordingpackid" value="{{ old('recordingpackid') }}">-->
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3" for="title">収録カードID</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="recordingcardid" value="{{ old('recordingcardid') }}">
                    </div>
                </div>
                <div class="form-group row">
                      <label class="col-md-3" for="rarity_id">レアリティID</label>
                      <div class="col-md-9">
                        {{Form::select('rarity_id', $raritylist, null, ['class' => 'form-control'])}}

<!--
                          <select class="form-control" name="rarity" value="{{ old('rarity') }}">

                              <option value="">レアリティの選択</option>
                              <option value="ノーマル">ノーマル</option>
                              <option value="レア">レア</option>
                              <option value="スーパーレア">スーパーレア</option>
                              <option value="ウルトラレア">ウルトラレア</option>
                              <option value="シークレットレア">シークレットレア</option>
                              <option value="アルティメットレア">アルティメットレア</option>
                              <option value="ホログラフィックレア">ホログラフィックレア</option>
                              <option value="ウルトラシークレットレア">ウルトラシークレットレア</option>

                              <option value="ノーマルパラレルレア">ノーマルパラレルレア</option>
                              <option value="ゴールドレア">ゴールドレア</option>
                              <option value="コレクターズレア">コレクターズレア</option>

                          </select>
                          <input type="text" class="form-control" name="rarity" value="{{ old('rarity') }}">
                        -->
                      </div>
                </div>
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="登録">
            </form>
        </div>
    </div>
</div>
@endsection
