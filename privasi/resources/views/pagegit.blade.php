@extends('layouts.app')

@section('content')
<div class="content">
@if(Session::has('message'))
	<div class="alert alert-success">Calon pelamar dengan nama <strong>{{Session::get('message')}}</strong> berhasil ditambah!</div>
@endif

  <h2>Data Calon Pelamar</h2>
  <p>Berikut data pelamar pada PT SBG Solution:</p>

  	 <form method="GET" action="{{ action('VueController@cari_pegawai') }}">
                
    <div class="input-group mb-3 col-md-5">
 <input type="text" class="form-control" id="usr" name="cari" placeholder="cari disini">
  <div class="input-group-append">
    <button class="btn btn-primary" type="submit">Cari</button> 
  </div>
   &nbsp;&nbsp;&nbsp;<a class="btn btn-info text-white" href="{{ URL('sqlserver/pegawai/tambah')}}">Tambah</a> 
</div>
  </form> 

  <table class="table table-striped">
    <thead>
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
        <td>{{$rank++}}</td>
        <td>{{$peoples->nama_pegawai}}</td>
        <td>{{$peoples->jabatan_pegawai}}</td>
        <td>{{$peoples->umur_pegawai}}</td>
        <td>{{$peoples->alamat_pegawai}}</td>
        <td>
        	<div class="btn-group">
			  <button type="button" class="btn btn-primary"><i class="fa fa-address-card" aria-hidden="true"></i></button>
			  <a href="{{ URL('sqlserver/pegawai/edit/'.$peoples->id_pegawai)}}" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></a>
			  <button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
			</div>  	
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <span class="btn btn-primary">
  Halaman <span class="badge badge-light">{{ $people->currentPage() }}</span>
</span>
<span class="btn btn-primary">
  Jumlah Data <span class="badge badge-light">{{ $people->total() }}</span>
</span>
<span class="btn btn-primary">
  Data Per Halaman <span class="badge badge-light">{{ $people->perPage() }}</span>
</span><br><br>
 
 
	{{ $people->links() }}
</div>
@endsection