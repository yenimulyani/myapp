@extends('layout.template')
@section('judul')
Menampilkan Data uses
@endsection
@section('content')
<div class="card">
<div class="row">
<div class="col-md-8">
<a href="{{route('karyawan.create')}}" class="btn btn-success" style="float: right;" >Tambah</a>
</div>

<!-- SEARCH FORM -->
<div class="col-md-4">
  <form>
      <div class="input-group input-group-sm">
        <input class="form-control" name="table_search" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-default" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
</div>
</div>
    <div class="card-body register-card-body">
    <h2>Data Karyawan</h2>
    </div>
    <!-- /.form-box -->

    <button></button>
    <table class="table table-bordered" id="tblKaryawan">
    <thead>
    <tr>
    <th>No</th>
    <th>Aksi</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Gender</th>
    <th>Status</th>
    <th>Foto</th>
    </tr>
    </thead>
    <tbody>
    @php
    $no=1;
    @endphp
    @foreach($karyawan as $row)
    <tr>
    <td>{{$no}}</td>
    <td>

         <form action="{{route('karyawan.destroy', $row->karyawan_id )}}" method="POST">
            {{csrf_field()}}
            {{method_field('DELETE')}}
         <a href="{{ route('karyawan.edit', $row->karyawan_id)}}" class="btn btn-warning">Edit</a> |
            <button class="btn btn-danger" type="submit" onclick="return confirm('Data Akan dihapus')">Hapus</button>
         </form>
    </td>

    <td contenteditable="true" class="nama" karyawan_id="{{$row->karyawan_id}}">{{$row->karyawan_nama}}</td>
    <td contenteditable="true" class="alamat" karyawan_id="{{$row->karyawan_id}}">{{$row->karyawan_alamat}}</td>
    <td>{{$row->karyawan_gender}}</td>


    <td>
    @if($row->status==1)
        <div class="bg-success">Aktif
        </div>
    @else
    <div class="card bg-danger">Tidak Aktif
        </div>
    @endif
    </td>
    <td><img src="{{$row->karyawan_image}}" width="100px" alt=""></td>
    </tr>
    @php 
    $no++ 
    @endphp
    @endforeach
    </tbody>
    </table>

    {{$karyawan->links()}}

  <div>
  
  {!! QrCode::color(255, 0, 0, 25)->size(100)->generate('Halo Aku Qrqoder') !!}
  </div>
    
  </div>
@endsection

@section('script')
<script>
 $('input[name=table_search]').keyup(function(ex) {
   var Myinput = $(this);
   var _token = "{{csrf_token()}}";
    $.ajax({
      url:"{{route('karyawan.cari')}}",
      method:'POST',
      data:{cari:Myinput.val(),"_token":_token},
      type:"JSON",
      success:function(response){
        if(response.status){
            $('#tblKaryawan tbody').html(response.data);
            _token = response.token;
        }else{
            $('#tblKaryawan tbody').html(`
            <tr><td colspan=7>Data Tidak ditemukan</td></tr>
            `);
        }
    }
   });
 });



 $('.nama').blur(function(){
    var _token = "{{csrf_token()}}";
    var ini = $(this);
    $.ajax({
      url:"{{route('karyawan.updatenama')}}",
      method:'POST',
      data:{karyawan_id:ini.attr('karyawan_id'), nama:ini.text(),"_token":_token},
      type:"JSON",
      success:function(response){
          alert(response.pesan);
    }
   });
 });
//  alamat
 $('.alamat').blur(function(){
    var _token = "{{csrf_token()}}";
    var ini = $(this);
    $.ajax({
      url:"{{route('karyawan.updatealamat')}}",
      method:'POST',
      data:{karyawan_id:ini.attr('karyawan_id'), alamat:ini.text(),"_token":_token},
      type:"JSON",
      success:function(response){
          alert(response.pesan);
    }
   });
 });
 
</script>
@endsection