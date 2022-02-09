@extends('layouts.admin')
@section('title', '価格情報')

@section('content')

        <div class="row">
            <div class="col-md-6">{{ $posts->card_name }}価格情報</div>
        </div>
        
        <!-- レアリティ毎に表とグラフ -->
        <div class="row">
            <div class="col-md-2">{{ $posts->rarity }}</div><!-- レアリティ -->
        </div>
        <div class="row">
                <div class="col-md-2">{{ $posts->recordingcardid }}</div><!-- 収録カードID -->
                <div class="col-md-2">{{ $posts->cardshop }}</div><!-- カードショップ名 -->
                <div class="col-md-2">{{ $posts->price }}</div><!-- 最新の価格 -->
                <div class="col-md-2">{{ $posts->created_at }}</div><!-- 情報取得日 -->


        </div>

@endsection
