<script type="text/javascript">

document.addEventListener('DOMContentLoaded', function(){
  tabs = document.querySelectorAll('#js-tab li');
  for(i = 0; i < tabs.length; i++) {
    tabs[i].addEventListener('click', tabSwitch, false);
  }

  function tabSwitch(){
    tabs = document.querySelectorAll('#js-tab li');
    var node = Array.prototype.slice.call(tabs, 0);
    node.forEach(function (element) {
      element.classList.remove('active');
    });
    this.classList.add('active');

    content = document.querySelectorAll('.tab-content');
    var node = Array.prototype.slice.call(content, 0);
    node.forEach(function (element) {
      element.classList.remove('active');
    });

    const arrayTabs = Array.prototype.slice.call(tabs);
    const index = arrayTabs.indexOf(this);

    document.querySelectorAll('.tab-content')[index].classList.add('active');
  };
});

const labels = [
  'January',
  'February',
  'March',
  'April',
  'May',
  'June',
];

const data = {
  labels: labels,
  datasets: [{
    label: 'My First dataset',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: [0, 10, 5, 2, 20, 30, 45],
  }]
};

const config = {
  type: 'line',
  data: data,
  options: {}
};

  const myChart = new Chart(
  document.getElementById('myChart'),
  config
);

</script>


@extends('layouts.admin')
@section('title', '価格情報')

@section('content')
<div class="container">

        <div class="list-news col-md-12 mx-auto">
            <div class="row">

                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="25%">カードショップ</th>
                            <th width="10%">収録パック</th>
                            <th width="10%">収録カードID</th>
                            <th width="20%">レアリティ</th>
                            <th width="10%">価格</th>
                            <th width="10%">備考</th>
                            <th width="15%">情報取得日</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($lastprice as $lastprices)
                          <tr>
                              <th>{{ $lastprices->id }}</th>
                              <td>{{ str_limit($lastprices->cardshop, 50) }}</td>
                              <td>{{ str_limit($lastprices->recordingpackid, 50) }}</td>
                              <td>{{ str_limit($lastprices->recordingcardid, 50) }}</td>
                              <td>{{ str_limit($lastprices->rarity_jp, 50) }}</td>
                              <td>{{ str_limit($lastprices->cardprice, 50) }}</td>
                              <td>{{ str_limit($lastprices->notes, 50) }}</td>
                              <td>{{ str_limit($lastprices->created_at, 50) }}</td>


                          </tr>
                      @endforeach
                    </tbody>
                </table>

<!-- レアリティ毎にグラフ -->
                <div class="wrap-tab">
                    @foreach($rarity_tab as $rarity_t)
                        <ul id="js-tab" class="list-tab">

                            <li>{{$rarity_t}}</li>

                        </ul>
                        <div class="wrap-tab-content">
                            <li>{{$rarity_t}}</li>
                            <div class="tab-content">
                                <p>{{$rarity_t}}価格変動歴</p>
                            </div>
                        </div>
                    @endforeach





                </div>
            </div>
        </div>
<div>
  <canvas id="myChart"></canvas>
</div>




</div>


@endsection
<!--<li class="active">タブ1</li>
<div class="tab-content active">
<p>タブ1タブ1タブ1</p>
</div>-->
