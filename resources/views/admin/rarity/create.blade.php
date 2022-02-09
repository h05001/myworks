@extends('layouts.admin')
@section('title', 'レアリティ登録')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>レアリティの登録</h2>
                <form action="{{ action('Admin\RarityController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-3" for="rarity_jp">レアリティ(JP)</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="rarity_jp" value="{{ old('rarity_jp') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="rarity_en">レアリティ(EN)</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="rarity_en" value="{{ old('rarity_EN') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="rarity_sign">レアリティ記号</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="rarity_sign" value="{{ old('rarity_sign') }}">
                        </div>
                    </div>


                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection
