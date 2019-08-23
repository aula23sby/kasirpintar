@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Striped Rows</h2>
  <p>The .table-striped class adds zebra-stripes to a table:</p>            
  <table class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jabatan</th>
        <th>Umur</th>
        <th>Alamat</th>
      </tr>
    </thead>
    <tbody>
    	@php $i=1; @endphp
    	@foreach($people as $peoples)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$peoples->nama_pegawai}}</td>
        <td>{{$peoples->jabatan_pegawai}}</td>
        <td>{{$peoples->umur_pegawai}}</td>
        <td>{{$peoples->alamat_pegawai}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection