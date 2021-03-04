@extends('layouts.front')

@section('content')
echo 'test';
  <table>
    <tr>
      <th>店名</th>
    </tr>
    @foreach ($cardprice_form as $shopname)
    <tr>
      <td>{{$shopname->cardshop}}</td>
    </tr>
    @endforeach
  </table>

@endsection
