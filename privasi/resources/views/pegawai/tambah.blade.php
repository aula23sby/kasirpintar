@extends('layouts.app')

@section('content')

  <div class="row justify-content-center content">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">  
          <h2>{{ isset($people) ? 'Edit' : 'Tambah' }} Data Calon Pelamar</h2>
          <p>{{ isset($people) ? 'Edit' : 'Tambah' }} data pelamar pada PT SBG Solution:</p>
          <form method="POST" action="{{ isset($people) ? action('VueController@update_pegawai', ['id_pegawai'=>$people->id_pegawai]) : action('VueController@simpan_pegawai') }}">       
            @csrf
            @if(isset($people))
            @method('PUT')
            @endif
            <div class="form-group">
              <label>Nama:</label>
              <input type="text" class="form-control @if ($errors->has('nama_pegawai')) is-invalid @endif" name="nama_pegawai" value="{{ old('nama_pegawai',isset($people) ? $people->nama_pegawai : '') }}">
              <div class="invalid-feedback">{{$errors->first('nama_pegawai')}}</div>
            </div>
            <div class="form-group">
              <label>Jabatan:</label>
              <input type="text" class="form-control @if ($errors->has('jabatan_pegawai')) is-invalid @endif" name="jabatan_pegawai" value="{{ old('jabatan_pegawai', isset($people) ? $people->jabatan_pegawai : '') }}">
              <div class="invalid-feedback">{{$errors->first('jabatan_pegawai')}}</div>
            </div>
            <div class="form-group">
              <label>Umur:</label>
              <input type="text" class="form-control @if ($errors->has('umur_pegawai')) is-invalid @endif" name="umur_pegawai" value="{{ old('umur_pegawai', isset($people) ? $people->umur_pegawai : '') }}">
               <div class="invalid-feedback">{{$errors->first('umur_pegawai')}}</div>
            </div>
            <div class="form-group">
              <label>Alamat:</label>
              <input type="text" class="form-control @if ($errors->has('alamat_pegawai')) is-invalid @endif" name="alamat_pegawai" value="{{ old('alamat_pegawai', isset($people) ? $people->alamat_pegawai : '') }}">
              <div class="invalid-feedback">{{$errors->first('alamat_pegawai')}}</div>
            </div>
            <a href="{{ URL('sqlserver/pegawai')}}" class="btn btn-danger text-white">Kembali</a>
            <button type="submit" class="btn btn-primary float-right">{{isset($people) ? 'Edit' : 'Tambah'}}</button>
          </form> 
        </div>
      </div> <!-- end card -->
    </div>  <!-- end col-sm -->
  </div> <!-- end row -->

@endsection