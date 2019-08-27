@extends('layouts.app')

@section('content')
@if(Session::has('delete'))
  <div class="alert alert-success">Calon pelamar dengan nama <strong>{{Session::get('delete')}}</strong> berhasil dihapus permanent!</div>
@endif
@if(Session::has('deletes'))
  <div class="alert alert-success">Semua calon pelamar di trash telah dihapus permanent</div>
@endif
<div class="row justify-content-center content">
<div class="col-sm-6">
 <div class="card">
  <div class="card-header">
    <a href="{{URL('sqlserver/pegawai')}}" class="btn btn-danger float-left"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
    <h3 class="text-center">Trash Pelamar</h3>
  </div>
  <div class="card-body">
    @if(count($people)==0)
      <h5 class="text-center">Tidak ada data</h5>
    @endif
   
      @foreach($people as $peoples)
     <div class="shadow p-3 mb-3 bg-white">
          <strong>{{$peoples->nama_pegawai}}</strong>
          <span class="badge badge-secondary float-right">{{$peoples->jabatan_pegawai}}</span>
          <br>
          Dari: {{$peoples->alamat_pegawai}}
          <div class="btn-group float-right">
        <a href="{{ URL('sqlserver/pegawai/restore/'.$peoples->id_pegawai)}}" class="btn btn-success btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        <a href="{{ URL('sqlserver/pegawai/delete/'.$peoples->id_pegawai)}}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus permanent?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
      </div>    
        </div>
      @endforeach

  </div> <!-- end body-card-->
  <div class="card-footer">
    {{ $people->links() }}
    Total: {{count($people)}} 
    <span class="float-right">
      @if(count($people)==0)
      <a href="{{ URL('sqlserver/pegawai/restoreall')}}" class="btn btn-success btn-sm disabled">Restore Semua</a>
      <a href="{{ URL('sqlserver/pegawai/deleteall')}}" class="btn btn-danger btn-sm disabled">Hapus Semua</a>
      @else
      <a href="{{ URL('sqlserver/pegawai/restoreall')}}" class="btn btn-success btn-sm">Restore Semua</a>
      <a href="{{ URL('sqlserver/pegawai/deleteall')}}" class="btn btn-danger btn-sm">Hapus Semua</a>
      @endif
    </span>
  </div>
</div> 	
</div> 
</div>
@endsection