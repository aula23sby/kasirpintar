@extends('layouts.app')

@section('content')
@if(Session::has('message'))
	<div class="alert alert-success">Calon pelamar dengan nama <strong>{{Session::get('message')}}</strong> berhasil ditambah!</div>
@endif
@if(Session::has('update'))
	<div class="alert alert-success">Calon pelamar dengan nama <strong>{{Session::get('update')}}</strong> berhasil diupdate!</div>
@endif
@if(Session::has('hapus'))
	<div class="alert alert-success">Calon pelamar dengan nama <strong>{{Session::get('hapus')}}</strong> berhasil dihapus!</div>
@endif
@if(Session::has('restore'))
	<div class="alert alert-success">Calon pelamar dengan nama <strong>{{Session::get('restore')}}</strong> berhasil direstore!</div>
@endif
@if(Session::has('restores'))
	<div class="alert alert-success">Semua calon pelamar di trash telah direstore</div>
@endif
  <h2>Data Calon Pelamar</h2>
  <p>Berikut data pelamar pada PT SBG Solution:</p>

<div class="row">
<div class="col-sm-6">  	
  	<form method="GET" action="{{ action('VueController@cari_pegawai') }}">           
   	<div class="input-group">
	 <input type="text" class="form-control" id="usr" name="cari" placeholder="cari disini">
	  <div class="input-group-append">
	    <button class="btn btn-primary" type="submit">Cari</button> 
	  </div>
	   &nbsp;&nbsp;&nbsp;<a class="btn btn-info text-white" href="{{ URL('sqlserver/pegawai/tambah')}}">Tambah</a> 
	</div>
  	</form> 
</div>
<div class="col-sm-6">
	<span class="float-right"><a href="{{URL('sqlserver/pegawai/trash')}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Trash</a></span>
</div>
</div>
<br><br>
  <table class="table table-striped table-hover table-responsive-xl">
    <thead class="thead-light">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jabatan</th>
        <th>Umur</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    	@foreach($people as $peoples)
      <tr>
        <td>1</td>
        <td>{{$peoples->nama_pegawai}}</td>
        <td>{{$peoples->jabatan_pegawai}}</td>
        <td>{{$peoples->umur_pegawai}}</td>
        <td>{{$peoples->alamat_pegawai}}</td>
        <td>
        	<div class="btn-group">
			  <a href="{{ URL('Image/'.$peoples->post->image)}}" class="btn btn-primary"><i class="fa fa-address-card" aria-hidden="true"></i></a>
			  <a href="{{ URL('sqlserver/pegawai/edit/'.$peoples->id_pegawai)}}" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></a>
			  <a href="{{ URL('sqlserver/pegawai/hapus/'.$peoples->id_pegawai)}}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
			</div>  	
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection