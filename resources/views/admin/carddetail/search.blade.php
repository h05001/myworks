@extends('layouts.admin')
@section('title', 'カード検索')

@section('content')
    <div class="container">
        <div class="row">
            <h2>検索条件</h2>
        </div>
        <div class="row">

            <div class="col-md-8">
                <form action="{{ action('Admin\CardDetailController@search') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-3">検索：カード分類</label>
                        <div class="col-md-7">
                            <select class="form-control" name="cond_card_class" value="{{ $cond_card_class }}">
                              <option value="">カード種類で検索</option>
                              <option value="select1">モンスターカード</option>
                              <option value="select2">魔法カード</option>
                              <option value="select3">罠カード</option>
                            </select>
                          <!--
                            <input type="text" class="form-control" name="cond_card_class" value="{{ $cond_card_class }}">
                          -->
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
