@extends('layouts.app')

@section('content')
<script>
  $(document).ready(function() {
  $('#barang').DataTable();
});
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
             <p>Selamat Datang, {{$guestt}} {{Auth::user()->name}}!</p>
            <div class="card">
                <div class="card-header">Dashboard Barang <span class="pull-right clickable panel-toggle"><a href="#add" data-toggle="collapse" class="btn btn-light btn-sm"><em class="fa fa-plus fa-lg" style="color:blue"></em> 
                @if($guestt == "staff" || $guestt == "admin")
                  Edit
                @else
                  Tambah
                @endif

              </a></span></div>
                <div class="card-body">
                  <div id="add" class="collapse">
                   <form action="{{ route($guestt.'.add') }}" method="POST" id="formId">
                        @csrf
                        <input type="hidden" id="saveid" value="{{$kdBrg}}">
                        <input type="hidden" id="kodeid" name="kode" value="{{$kdBrg}}">
                        <div class="row">
                          <div class="col-sm-4 top-row">
                            <label for="kode">Kode Barang:</label>
                            <input type="text" class="form-control" id="kode" value="{{$kdBrg}}" disabled="true">
                          </div>
                          <div class="col-sm-8 top-row">
                            <label for="nama">Nama Barang:</label>
                            <input type="text" class="form-control" placeholder="Nama Barang" id="nama" name="nama">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4 top-row">
                            <label for="stock">Stock Barang:</label>
                            <input type="number" min="1" class="form-control" placeholder="Stock Barang" id="stock" name="stock">
                          </div>
                          @if($guestt == "owner")
                          <div class="col-sm-4 top-row">
                            <label for="Harga Beli">Harga Beli:</label>
                            <input type="number" step="1000" min="0" class="form-control" placeholder="Harga Beli" id="harga_beli" name="harga_beli">
                          </div>
                           @endif
                          @if($guestt == "owner" || $guestt == "admin")
                            <div class="col-sm-4 top-row"> 
                               <label for="Harga Jual">Harga Jual:</label>
                            <input type="number" step="1000" min="0" class="form-control" placeholder="Harga Jual" id="harga_jual" name="harga_jual" data-type="currency">
                            </div>
                          @endif
                        </div>
        
                      <br>

                      <button type="submit" class="btn btn-primary" id="btn_save">Tambah</button>
                      <button type="button" class="btn btn-danger" id="btn_clear">Clear</button>
                    </form>
                    <br><br>
                  </div>
                    
                    @if(Session::has('success'))
                        <p class="text-success">{{ Session::get('success') }}</p>
                    @elseif(Session::has('failed'))    
                        <p class="text-danger">{{ Session::get('failed') }}</p>
                    @endif
                    
                <div class="table-responsive">
                    <table class="table table-hover" id="barang">
                    <thead>
                      <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Stock</th>
                        @if($guestt == "owner")
                         <th>Harga Beli</th>
                        @endif 
                        @if($guestt == "owner" || $guestt == "admin")
                          <th>Harga Jual</th>
                        @endif
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>

                        @foreach($barangs as $barang)
                          <tr>
                            <td>{{$barang->kode}}</td>
                            <td>{{$barang->nama}}</td>
                            <td>{{$barang->stock}}</td>
                            @if($guestt == "owner")
                              <td>{{$barang->harga_beli}}</td>
                            @endif
                            @if($guestt == "owner" || $guestt == "admin")
                              <td>{{$barang->harga_jual}}</td>
                            @endif
                            <td>
                                <div class="row">
                                  <div class="col-sm-3"><a href="#" class="edit-value" data-id="{{$barang->kode}}" data-nama="{{$barang->nama}}" data-stock="{{$barang->stock}}" data-hargajual="{{$barang->harga_jual}}" data-hargabeli="{{$barang->harga_beli}}"><i class="fa fa-pencil fa-lg" style="color:blue"></i></a></div>
                                  <div class="col-sm-3"><a href="{{URL($guestt.'/delete/'.$barang->kode)}}" onclick="return confirm('Apakah anda yakin menghapus barang?');"><i class="fa fa-trash fa-lg" style="color:red"></i></a></div>
                                </div>
                                
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                  @if(count($barangs)>0)
                  Halaman : {{ $barangs->currentPage() }} <br/>
                  Jumlah Data : {{ $barangs->total() }} <br/>
                  Data Per Halaman : {{ $barangs->perPage() }} <br/>
                  @endif
                 
                  {{ $barangs->links() }}
              </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 $(document).ready(function() {
   var guest = "{{$guestt}}";
   if(guest == "admin" || guest == "staff"){
    $('#btn_clear').hide();
    $('#formId').attr('action', '{!!route($guestt.'.update')!!}');
    $("#btn_save").html('Edit');
    $(':input[type="submit"]').prop('disabled', true);
   }
     
 });
$(document).on("click", ".edit-value", function () {
  $("#btn_save").html('Edit');
  $('#formId').attr('action', '{!!route($guestt.'.update')!!}');
  $('.collapse').collapse();
  var kode =  $(this).data('id');
  var nama =  $(this).data('nama');
  var stock =  $(this).data('stock');
  var harga_jual =  $(this).data('hargajual');
  var harga_beli =  $(this).data('hargabeli');
  $('#kode').val(kode);
  $('#kodeid').val(kode);
  $('#nama').val(nama);
  $('#stock').val(stock);
  $('#harga_jual').val(harga_jual);
  $('#harga_beli').val(harga_beli);
  $(':input[type="submit"]').prop('disabled', false);
});
$(document).on("click", "#btn_clear", function () {
  $('#formId').attr('action', '{!!route($guestt.'.add')!!}');
  $("#btn_save").html('Tambah');
  $id = $('#saveid').val();
  $('#kodeid').val($id);
  $('#kode').val($id);
  $('#nama').val('');
  $('#stock').val('');
  $('#harga_jual').val('');
  $('#harga_beli').val('');
});


</script>
@endsection
