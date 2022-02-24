{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'レアリティの変換'を埋め込む --}}
@section('title', 'レアリティの変換情報の登録')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>レアリティ変換の登録</h2>
                <form action="{{ action('Admin\RarityConvertController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-3" for="rarity_id">レアリティID</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="rarity_id" value="{{ old('rarity_id') }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-3" for="shop_id">ショップID</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="shop_id" value="{{ old('shop_id') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3" for="rarity_convert">レアリティの変換</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="rarity_convert" value="{{ old('rarity_convert') }}">
                        </div>
                    </div>


                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection
