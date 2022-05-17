@extends('admin.layout.master')
@section('content')

<?php if(cek_akses('75') == 'yes'){
}else{ ?>
  <script type="text/javascript">history.back(alert("Anda Tidak Memiliki Akses"))</script>
<?php } ?> 
@php

function cek_akses($aModul) {

    $level = Auth::user()->level;
    $username = Auth::user()->username;
    //query untuk mendapatkan iduser dari user           

    $quser = DB::table('users')->select('level')->where('username','=',$username)->first();
    $qry = DB::table('hak_akses')->select('id')->where([['usergroup','=',$quser->level],['modul','=',$aModul]])->count();

    if (1 > $qry) {
        return "no";
    } else {
        return "yes";
    }

}
@endphp

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">User</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
  <!-- /.content-header --> 
<div class="container-fluid">
  <div class="row">
      <!-- left column -->
      <div class="col-md-5">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit User</h3>
              </div>
         <div class="uk-alert uk-alert-success" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
              @if ($message = Session::get('successMessage'))

              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                <strong>{{ $message }}</strong>
              </div>
              @endif
        </div>
            <form method="POST" action="{{ url('/user/'.$data->id.'/simpanedit') }}">
              <div class="card-body">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="{{$data->id}}" >

                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$data->name}}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="username">{{ __('Username') }}</label>

                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{$data->username}}" required autocomplete="username" autofocus>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="level">{{ __('Level') }}</label>

                        <div class="has-error">
                                <select class="form-control" name="level"> 
                        
                                  @foreach ($levelgrup as $leveling)
                                  <option @if ($leveling->id == $data->level) selected @endif" value="{{$leveling->id}}">{{$leveling->nama}}</option>
                                  @endforeach
                                </select>
                        <small class="help-block"></small>
                        </div>
                        @error('level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ __('Update') }}
                </button>
              </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

@endsection
@section('script')

@endsection