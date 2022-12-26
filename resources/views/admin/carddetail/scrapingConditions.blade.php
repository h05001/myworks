@extends('layouts.admin')
<script type="text/javascript">

function entryChange(){

    if(document.getElementById('checkbox_pack').checked){
        document.getElementById('select_pack').style.display = "block";
    }else{
        document.getElementById('select_pack').style.display = "none";
    }
    if(document.getElementById('checkbox_shop').checked){
        document.getElementById('select_shop').style.display = "block";
    }else{
        document.getElementById('select_shop').style.display = "none";
    }
}

</script>
@section('title', 'スクレイピング条件')

@section('content')
    <div class="container">
        <div class="row">
            <h2>スクレイピングの条件</h2>
        </div>
        <div class="row">
            <form action="{{ action('Admin\CardDetailController@scraping') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="custom-control custom-checkbox">

                        <input type="checkbox" class="form-control-input"  onchange="entryChange();" value = "select_pack" checked id="checkbox_pack">
                            <label class="form-control-label" for="CheckBox2">収録パックから選択</label>
                        <input type="checkbox" class="form-control-input"  onchange="entryChange();" value = "select_shop" checked id="checkbox_shop">
                            <label class="form-control-label" for="CheckBox2">カードショップから選択</label>
                    </div>

                <div id="select_pack">
                    <div class="form-group row">

                        @foreach($recordingpack_list as $key => $val)
                            <div class="col-md-6">
                            <input type="checkbox" class="form-control-input"  name= "recordingpack[]" value="{{ $key }}">
                            <label class="form-control-label"  for="{{ $key }}">{{ $val }}</label>
                            </div>
                            <!--
                            {{ Form::checkbox('recordingpack[]', $key, false, ['id' => 'tag'.$key, 'class' => 'form-control-input']) }}
                            {{ Form::label('tag'.$key, $val, []) }} style="transform:scale(2.0);"
                            -->
                        @endforeach
                    </div>
                </div>
                    <div id="select_shop">
                        <div class="form-group row">

                            @foreach($shop_list as $key => $val)
                                <div class="col-md-6">
                                <input type="checkbox" class="form-control-input"  name= "shop[]" value="{{ $key }}">
                                <label class="form-control-label"  for="{{ $key }}">{{ $val }}</label>
                                </div>

                            @endforeach
                        </div>
                    </div>

                <div class="col-md-12">
                    <input type="submit" class="btn btn-primary" value="実行">
                </div>
            </form>
            <!--
            <div>

                <a href="{{ action('Admin\CardDetailController@scraping') }}">実行</a>
            </div>
-->



        </div>
    </div>
@endsection
