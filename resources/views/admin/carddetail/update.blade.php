{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')




@section('title', 'カード詳細情報の更新')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>カード詳細情報　更新</h2>


                <form action="{{ action('Admin\CardDetailController@update') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if($carddetail->monstercardclasses->contains("id",12))
                        <div id="pendulum_effect">
                            <div class="form-group row">
                                <label class="col-md-3" for="pendulum_effect">旧ペンデュラム効果</label>
                                <div class="col-md-9">
                                  <textarea class="form-control" name="pendulum_effect" rows="5">{{ $carddetail->monstercarddetails -> pendulum_effect }}</textarea>

                                </div>
                            </div>
                        </div>
                        <div id="pendulum_effect">
                            <div class="form-group row">
                                <label class="col-md-3" for="pendulum_effect">新ペンデュラム効果</label>
                                <div class="col-md-9">
                                  <textarea class="form-control" name="pendulum_effect" rows="5">{{ old('pendulum_effect') }}</textarea>

                                </div>
                            </div>
                        </div>
                    @endif


                  <div class="form-group row">
                      <label class="col-md-3" for="card_text">旧カードテキスト</label>
                      <div class="col-md-9">
                        <textarea class="form-control" name="card_text" rows="10">{{ $carddetail->card_text }}</textarea>

                      </div>
                  </div>



                  <div class="form-group row">
                    <label class="col-md-3" for="card_text">新カードテキスト</label>
                    <div class="col-md-9">
                      <textarea class="form-control" name="card_text" rows="10">{{ old('card_text') }}</textarea>

                    </div>
                  </div>


                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">

                </form>
            </div>
        </div>
    </div>
@endsection
