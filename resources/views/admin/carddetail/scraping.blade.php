@extends('layouts.admin')
@section('title', 'スクレイピング')

@section('content')
<div class="container">
    <div>

        <a href="{{ action('Admin\CardDetailController@scrapingConditions') }}">スクレイピングの条件を選択する</a>
    </div>



</div>


@endsection
