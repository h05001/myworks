@extends('layouts.admin')
@section('title', 'モンスターカードの種類登録')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>モンスターカードの種類登録</h2>
                <form action="{{ action('Admin\MonsterClassMasterController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-3" for="monster_card_class">モンスターカード種類</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="monster_class" value="{{ old('monster_class') }}">
                        </div>
                    </div>


                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection
