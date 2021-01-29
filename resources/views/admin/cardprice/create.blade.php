{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'カード価格情報'を埋め込む --}}
@section('title', 'カード名価格')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>カード名価格</h2>
                <form action="{{ action('Admin\CardPriceController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="form-group row">
                        <label class="col-md-2" for="title">ショップID</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="shopid" value="{{ old('shopid') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">収録カードID</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="recordingcardid" value="{{ old('recordingcardid') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                          <label class="col-md-2" for="title">価格</label>
                          <div class="col-md-10">
                              <input type="text" class="form-control" name="price" value="{{ old('prise') }}">
                          </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection
