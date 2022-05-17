@extends('admin.layout.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard v2</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v2</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- /.content-header -->

<div class="container-fluid">
  <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="formProdiEdit" class="form-horizontal" role="form" method="POST" action="{{ url('/prodi/'.$prodiKode.'/simpanedit') }}">
                <div class="card-body">

                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="_method" value="PUT">
                  <input type="hidden" name="prodiKode" value="{{$prodiKode}}" >

                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="text" class="form-control" name="prodiKodeShow" value="{{$prodiKode}}" disabled="true">
                      <small class="help-block"></small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Prodi</label>
                    <input type="text" class="form-control @error('prodiNama') is-invalid @enderror"" id="inputError" name="prodiNama" value="{{$prodiNama}}">

                    @error('prodiNama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror

                  </div>
                    

                  <div class="form-group">
                    <label for="exampleInputPassword1">Jurusan</label>
                    <select class="form-control" name="prodiJurKode">
                        
                          @foreach ($listjurusan as $itemjurusan)
                          <option @if ($itemjurusan->jurKode == $prodiKodeJurusan) selected @endif" value="{{$itemjurusan->jurKode}}">{{$itemjurusan->jurNama}}</option>
                          @endforeach
                      </select>
                      
                      <small class="help-block"></small>

                  </div>

                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="{{{ action('prodi\ProdiController@index') }}}" title="Cancel">
                    <span class="btn btn-danger"><i class="fa fa-back"> Cancel </i></span>
                </a>  
                </div>
                
              </form>

            </div><!-- /.row (main row) -->
        </div>
    </div>
</div>

@endsection
@section('script')

@include('sweet::alert')
@endsection
