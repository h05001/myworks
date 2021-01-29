@extends('layouts.admin')
@section('title', 'ショップ情報の編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>ショップ情報の編集</h2>
                <form action="{{ action('Admin\CardShopController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-3" for="title">カードショップ名</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="cardshop" value="{{ $cardshop_form->cardshop }}">>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="title">URL</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="URL" value="{{ $ardshop_form->URL }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $cardshop_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
