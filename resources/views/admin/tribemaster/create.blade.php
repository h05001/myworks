@extends('layouts.admin')
@section('title', 'モンスターカードの種族登録')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>モンスターカードの種族登録</h2>
                <form action="{{ action('Admin\TribeMasterController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-3" for="tribe">モンスターカード種族</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="tribe" value="{{ old('tribe') }}">
                        </div>
                    </div>


                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection
