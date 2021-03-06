@extends('layout.template')
@section('judul')
Ubah user
@endsection
@section('content')
<div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>
      @if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
      <form action="{{route('karyawan.update', $data_user->karyawan_id)}}" method="POST">


      {{csrf_field()}}
      @method('PATCH')
        <div class="input-group mb-3">
          <input type="text" class="form-control" value="{{$data_user->karyawan_nama}}" name="nama" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" value="{{$data_user->username}}" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" value="{{$data_user->karyawan_alamat}}" name="alamat" placeholder="Alamat">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa-address-book"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="radio" {{($data_user->karyawan_gender=='L')?'checked':''}} name="gender" placeholder="L" value="L">Laki-laki
          <input type="radio" {{($data_user->karyawan_gender=='P')?'checked':''}} name="gender" placeholder="P" value="P">Perempuan

          <div class="input-group-append">

          </div>
        </div>
        <div class="input-group mb-3">
            <select name="status" id="" class="form-control" require>
                <option value="">Status User</option>
                <option value="1" {{($data_user->status==1) ? 'selected':'' }}>Aktif</option>
                <option value="0" {{($data_user->status==0) ? 'selected':'' }}>Tidak Aktif</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <select name="jabatan" id="" class="form-control" require>
                <option value="" disabled selected>Pilih Jabatan</option>
                @foreach($jabatan as $row)
                @if($data_user->karyawan_jab_id==$row->jabatan_id)
                <option value="{{$row->jabatan_id}}" selected>{{$row->jabatan_nama}}</option>
                @else
                <option value="{{$row->jabatan_id}}">{{$row->jabatan_nama}}</option>

                @endif
                @endforeach
            </select>
        </div>
        <div class="row">
          <div class="col-8">

          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


    </div>
    <!-- /.form-box -->
  </div>
@endsection
