
@extends('layouts.admin')
@section('title', '価格変動歴(平均)')
@section('script')
<script src="{{ mix('js/test.js') }}"></script>
<script>
    window.onload = function(){
      id = 'allChart';
      labels = @json($keys);
      
      data = @json($maxPrices,$avgPrices,$minPrices);
      make_chart(id,labels,data);
  };

</script>
@endsection

@section('content')
    <form action="{{ action('Admin\CardDetailController@historyAvg') }}" method="get">
        <div class="form-group row">
            <div class="col-md-3" class="form-control">
                <select name="term" value="term">
                  <option value="">期間の選択</option>
                  <option value="1">1が月</option>
                  <option value="3">3か月</option>
                  <option value="6">6か月</option>
                </select>
            </div>
            <input type="hidden" name="id" value="{{ $id }}">

        </div>
        <input type="submit" class="btn btn-primary" value="グラフの生成">
    </form>

    <div class="content">
       <canvas id="allChart" width="1500" height="500"></canvas>

    </div>

@endsection
