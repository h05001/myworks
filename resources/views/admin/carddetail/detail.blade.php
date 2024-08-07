{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')
@section('title', 'カード詳細')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
          <!-- フラッシュメッセージ -->
          @if (session('flash_message'))
              <div class="flash_message">
                  {{ session('flash_message') }}
              </div>
          @endif
          @if($posts != null)


            <h2>{{ $posts->card_name }}:詳細情報</h2>
            <form action="{{ action('Admin\CardDetailController@detail') }}" method="post" enctype="multipart/form-data">

                <div class="form-group row">

                    <div class="col-md-3">カード名</div>
                    <div class="col-md-6">{{ $posts->card_name }}

                        @if($posts->latestRegulation() != null)
                            @if($posts->latestRegulation()->able =='0')
                                <div class="col-md-3">禁止</div>
                            @elseif($posts->latestRegulation()->able =='1')
                                <div class="col-md-3">制限</div>
                            @elseif($posts->latestRegulation()->able =='2')
                                <div class="col-md-3">準制限</div>
                            @endif
                        @endif</div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">読み方</div>
                    <div class="col-md-6">{{ $posts->ruby }}</div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">カードの種類</div>
                    @if($posts->card_class =='select1')
                        <div class="col-md-3">モンスター</div>
                    @elseif($posts->card_class =='select2')
                        <div class="col-md-3">魔法</div>
                    @elseif($posts->card_class =='select3')
                        <div class="col-md-3">罠</div>
                    @endif


                </div>
                <div class="form-group row">
                    <div class="col-md-3">テキスト</div>
                    <div>{{ $posts->card_text }}</div>
                </div>

                @if($posts->card_class =='select1')


                    @if($posts->monstercardclasses->contains("id",12))
                        <div class="col-md-3">ペンデュラムスケール</div>
                        <div class="col-md-3">{{ $posts->monstercarddetails->scale }}</div>
                        <div class="col-md-3">ペンデュラム効果</div>
                        <div class="col-md-9">{{ $posts->monstercarddetails->pendulum_effect }}</div>
                    @endif
                    <div class="form-group row">
                        <div class="col-md-3">属性</div>
                        @if($posts->monstercarddetails->property =="dark")
                            <div class="col-md-3">闇属性</div>
                        @elseif($posts->monstercarddetails->property =="light")
                            <div class="col-md-3">光属性</div>
                        @elseif($posts->monstercarddetails->property =="earth")
                            <div class="col-md-3">地属性</div>
                        @elseif($posts->monstercarddetails->property =="water")
                            <div class="col-md-3">水属性</div>
                        @elseif($posts->monstercarddetails->property =="fire")
                            <div class="col-md-3">炎属性</div>
                        @elseif($posts->monstercarddetails->property =="wind")
                            <div class="col-md-3">風属性</div>
                        @else
                            <div class="col-md-3">神属性</div>
                        @endif


                        <div class="col-md-3">種族</div>
                        <div class="col-md-3">{{ $posts->tribemasters[0]->tribe }}</div>


                        <div class="col-md-3">モンスターカード種類</div>
                        <div class="col-md-3"> @foreach ($posts->monstercardclasses as $class )
                                                    <div>{{ $class->monster_class }}</div>

                                               @endforeach</div>
                       <div class="col-md-3">攻撃力</div>
                       <div class="col-md-3">{{ $posts->monstercarddetails->attack }}</div>

                       <div class="col-md-3">守備力</div>

                       @if(is_null( $posts->monstercarddetails->defense ))
                          <div class="col-md-3"> --- </div>
                       @else
                          <div class="col-md-3">{{ $posts->monstercarddetails->defense }}</div>
                       @endif

                    @if($posts->monstercardclasses->contains("id",5))
                        <div class="col-md-3">ランク</div>
                        <div class="col-md-3">{{ $posts->monstercarddetails->level_rank_link }}</div>


                    @elseif($posts->monstercardclasses->contains("id",14))
                        <div class="col-md-3">リンク</div>
                        <div class="col-md-3">{{ $posts->monstercarddetails->level_rank_link }}</div>
                        <div class="col-md-3">リンクマーカー</div>
                        <div class="col-md-3">{{ $posts->monstercarddetails->link_marker }}</div>

                    @else
                        <div class="col-md-3">レベル</div>
                        <div class="col-md-3">{{ $posts->monstercarddetails->level_rank_link }}</div>
                    @endif

                    </div>

                @elseif($posts->card_class =='select2')

                    <div class="form-group row">
                        <div class="col-md-3">魔法カードの種類</div>
                        <div class="col-md-3">{{ $posts->magiccarddetails->magic_card_class }}</div>
                    </div>

                @else
                    <div class="form-group row">
                        <div class="col-md-3">罠カードの種類</div>
                        <div class="col-md-3">{{ $posts->trapcarddetails->trap_card_class }}</div>
                    </div>
                @endif
            </form>
            <div>
                <a href="{{ action('Admin\CardDetailController@price', ['id' => $posts->card_master_id]) }}">価格</a>
            </div>
            <div>
                <a href="{{ action('Admin\CardDetailController@update', ['id' => $posts->card_master_id]) }}">編集</a>
            </div>
            <div class="row">リミットレギュレーションの変遷歴</div>
                <div class="row">
                  <table class="table table-dark">
                       <thead>
                           <tr>
                               <th width="25%">レギュレーション</th>
                               <th width="25%">投入可能枚数</th>

                           </tr>
                       </thead>
                       <tbody>
                           @foreach($transitions as $value)
                               <tr>
                                   <th>{{ $value->regulation_id }}</th>
                                   <td>{{ $value->able }}</td>

                               </tr>
                           @endforeach
                       </tbody>
                   </table>
                </div>
                @else
                    <div class="col-md-3">詳細情報未登録です</div>
                @endif
        </div>
    </div>
</div>
@endsection
