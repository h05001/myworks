
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

       <div class="content">
           <canvas id="allChart"></canvas>
       </div>

@endsection
