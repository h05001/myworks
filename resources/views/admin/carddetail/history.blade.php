
@extends('layouts.admin')
@section('title', '価格変動歴')
@section('script')
<script src="{{ mix('js/test.js') }}"></script>
<script>
    window.onload = function(){
      id = 'allChart';
      labels = @json($keys);
      data = @json($counts);
      make_chart(id,labels,data);
  };

</script>
@endsection

@section('content')
    <form action="{{ action('Admin\CardDetailController@history') }}" method="get">
        <div class="form-group row">
            <div class="col-md-3" class="form-control">
              <input type = "month" name="term" value="{{ $term }}">
                <!-- <select name="term" value="term">
                  <option value="">期間の選択</option>
                  <option value="1">1が月</option>
                  <option value="3">3か月</option>
                  <option value="6">6か月</option>
                </select> -->
            </div>
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="cardshop_id" value="{{ $cardshop_id }}">
            <input type="hidden" name="note" value="{{ $note }}">
        </div>
        <input type="submit" class="btn btn-primary" value="グラフの生成">
    </form>

    <div class="content">
       <canvas id="allChart" width="1500" height="500"></canvas>

    </div>

@endsection
