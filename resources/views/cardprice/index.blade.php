@extends('layouts.front')

@section('content')
echo 'test';
  <table>
    <tr>
      <th>店名</th>
    </tr>
    @foreach ($shopnames as $shopname)
    <tr>
      <td>$shopname->cardshop</td>
    </tr>
    @endforeach
  </table>

@endsection
