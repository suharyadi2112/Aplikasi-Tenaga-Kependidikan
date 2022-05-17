@extends('admin.layout.master')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Jurusan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Tambah</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
  <!-- /.content-header -->
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
          <div class="card-body">
                  <div class="box-body flash-message" data-uk-alert>
                      <a href="" class="uk-alert-close uk-close"></a>
                      <p>{{  isset($successMessage) ? $successMessage : '' }}</p>
                       @if (count($errors) > 0)
                          <div class="alert alert-danger">
                              <strong>Whoops!</strong> There were some problems with your input.<br><br>
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                  </div>
                  <div class="box box-primary">
                    <div class="box-header">
                      <h3 class="box-title">Tambah Jurusan </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <form id="formJurusanTambah" class="form-horizontal" role="form" method="POST" action="{{ url('/jurusan/tambahjurusan') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label">Kode</label>
                            <div class="col-md-6 @if ($errors->has('jurKode')) has-error @endif">
                                <input type="text" class="form-control" name="jurKode" value="{{Request::old('jurKode')}}">
                                <small class="help-block"></small>
                            </div> 
                        </div>
     
                        <div class="form-group">
                            <label class="col-md-4 control-label">Nama </label>
                            <div class="col-md-6  @if ($errors->has('jurNama')) has-error @endif">
                                <input type="text" class="form-control" name="jurNama" value="{{Request::old('jurNama')}}">
                                <small class="help-block"></small>
                                <!-- @if ($errors->has('jurNama')) <small class="help-block">{{ $errors->first('jurNama') }}</small> @endif -->
                            </div>
                        </div>
     
                        
     
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="button-reg">
                                    Simpan
                                </button>

                                
                                <a href="{{{ action('Jurusan\JurusanController@index') }}}" title="Cancel">
                                <button type="button" class="btn btn-default" id="button-reg">
                                    Cancel
                                </button>
                                </a>  
                            </div>
                        </div>
                        </form>   
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->
              </div>
            </div><!-- /.row (main row) -->
          </div>
        </div>
    </div>
            
@endsection

