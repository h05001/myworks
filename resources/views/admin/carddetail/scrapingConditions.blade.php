@extends('layouts.admin')

@section('script')
<link href="{{ asset('css/sumoselect.css') }}" rel="stylesheet" defer>
<script defer src="{{ asset('js/jquery.sumoselect.min.js') }}" ></script>

<script defer>
    $(document).ready(function () {
        $('#select_pack').SumoSelect({
          csvDispCount: 6,
          selectAll: true,
          search:true,
          selectAllPartialCheck: true
        });
    });

    $(document).ready(function () {
        $('#select_shop').SumoSelect({
          csvDispCount: 6,
          selectAll: true,
          search:true,
          selectAllPartialCheck: true
        });
    });
</script>

<!--<link href="{{ asset('css/multiPick.css') }}" rel="stylesheet">
<script src="{{ asset('js/multiPick.min.js') }}" ></script>

<link href="{{ asset('css/easySelectStyle.css') }}" rel="stylesheet">
<script src="{{ asset('js/jquery.bs-select.min.js') }}" ></script>
 <link href="{{ asset('css/easySelectStyle.css') }}" rel="stylesheet">
<script src="{{ asset('js/easySelect.js') }}" ></script> -->
@endsection

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

                    <div class="form-group row">
                        <div class="col-md-12">収録パックから選択</div>

                        <div>
                            <select name="recordingpack[]" class="form-control" multiple="multiple"  id="select_pack" >
                              @foreach($recordingpack_list as $key => $val)

                                      <option value="{{ $val->id }}" >{{ $val->recordingpack ." [".$val->recordingpackid."]" }}</option>
                              @endforeach

                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="form-group row">
                            <div class="col-md-12">カードショップから選択</div>
                            <select name="shop[]" class="form-control" multiple="multiple"  id="select_shop" >
                                @foreach($shop_list as $key => $val)
                                    <option value="{{ $key }}" >{{ $val }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>

                <div class="col-md-12">
                    <input type="submit" class="btn btn-primary" value="実行">
                </div>
            </form>


        </div>
    </div>


@endsection
