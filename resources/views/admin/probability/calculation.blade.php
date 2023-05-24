@extends('layouts.admin')
@section('title', '確率計算')

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ mix('js/test.js') }}"></script>
<script type="text/javascript">

    window.onload = function(){
      id = 'probabilityChart';
      labels = @json($horizontal);
      probability = @json($vertical);
      make_chart_probability(id,labels,probability);
  };

</script>
@endsection



@section('content')
<div class="container">


    <div class="row">
        <div class="col-md-12">確率計算</div>
            <form action="{{ action('Admin\ProbabilityController@calculation') }}" method="get" enctype="multipart/form-data">
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="deck">デッキ枚数</label>
                    <div>
                        <select class="form-control" name="deck" value="{{ old('deck') }}">

                            <option value="40" selected>40</option>
                            <option value="41">41</option>
                            <option value="42">42</option>
                            <option value="43">43</option>
                            <option value="44">44</option>
                            <option value="45">45</option>
                            <option value="46">46</option>
                            <option value="47">47</option>
                            <option value="48">48</option>
                            <option value="49">49</option>
                            <option value="50">50</option>
                            <option value="51">51</option>
                            <option value="52">52</option>
                            <option value="53">53</option>
                            <option value="54">54</option>
                            <option value="55">55</option>
                            <option value="56">56</option>
                            <option value="57">57</option>
                            <option value="58">58</option>
                            <option value="59">59</option>
                            <option value="60">60</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="card">投入枚数(A)</label>
                    <div>
                        <input type="number" class="form-control text" name="card_A"  min="0" value="0" >
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="card">投入枚数(B)</label>
                    <div>
                        <input type="number" class="form-control text" name="card_B" min="0" value="0">
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="draw">ドロー枚数</label>
                    <div>
                        <input type="number" class="form-control" name="draw" value="5" min="5">

                    </div>
                </div>

            </div>
            <input type="submit" class="btn btn-primary" value="計算">
        </form>
    </div>
    @if(array_key_first($probability_arr) != null && $card_B == 0)

        <div class="col-md-12">デッキ{{ $deck }}枚から{{ $card_A }}枚投入したカードを初手に引く確率は{{ reset($probability_arr) }}％</div>
        <div class="row">
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th width="50%">ドロー枚数</th>
                        <th width="30%">確率</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($probability_arr as $key => $value)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="content">
           <canvas id="probabilityChart" width="500" height="500"></canvas>

        </div>

    @endif

    @if(array_key_first($probability_arr) != null && $card_B != 0)
        <div class="border-end">デッキ{{ $deck }}枚から二種類のカード:{{ $card_A }}枚、{{ $card_B }}枚投入したカードを初手に引く確率は{{ reset($probability_arr) }}％</div>
        <div class="row">
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th width="60%">ドロー枚数</th>
                        <th width="40%">確率</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($probability_arr as $key => $value)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="content">
           <canvas id="probabilityChart" width="500" height="500"></canvas>

        </div>

    @endif

    @if(array_key_first($probability_arr) != null && $card_B == 0)
        @if (session('history'))
            <div>
                @foreach(session('history') as $value)
                    <div>デッキ{{ $value['deck'] }}枚から{{ $value['card_A'] }}枚投入したカードを初手に引く確率は{{ $value['probability'] }}％</div>

                @endforeach
            </div>
        @endif
    @endif

    @if(array_key_first($probability_arr) != null && $card_B != 0)
        @if (session('history'))
            <div>
                @foreach(session('history') as $value)
                    <div>デッキ{{ $value['deck'] }}枚から二種類のカード:{{ $value['card_A'] }}枚、{{ $value['card_B'] }}枚投入したカードを初手に引く確率は{{ $value['probability'] }}％</div>

                @endforeach
            </div>
        @endif
    @endif

</div>


@endsection
