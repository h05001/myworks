{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')
@section('title', '登録済みカードの詳細')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>カード詳細情報</h2>
            <form action="{{ action('Admin\CardDetailController@detail') }}" method="post" enctype="multipart/form-data">





        </div>
    </div>
</div>
@endsection
