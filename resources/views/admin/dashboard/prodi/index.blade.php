
@extends('admin.layout.master')


@section('content')
<div id="progress" class="waiting">
    <dt></dt>
    <dd></dd>
</div>

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
<div class="container-fluid">
<div class="row">
  <div class="col-12">
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
                <div class="card">
                  <div class="card-header">
                    <a href="#myModal2" data-toggle='modal' class="btn bg-navy btn-flat margin" data-id=""><i class="fa fa-fw fa-plus"></i>Tambah Paket</a>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="datatables" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Prodi Kode</th>
                        <th>Prodi Nama</th>
                        <th>Prodi Kode Jurusan</th>
                        <th>Aksi</th>
                      </tr>
                      </thead>
                     
                      <tfoot>
                      <tr>
                        <th>Prodi Kode</th>
                        <th>Prodi Nama</th>
                        <th>Prodi Kode Jurusan</th>
                        <th>Aksi</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        <!-- /.col -->
      </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Program Studi - Tambah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                
            </div>
            <div class="modal-body">
 
                <form id="formProdi" class="form-horizontal" role="form" method="POST" action="{{ url('/prodi/tambah') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   
  
                    <div class="form-group">
                        <label class="col-md-4 control-label">Kode</label>
                            <input type="text" class="form-control" name="prodiKode">
                            <small class="help-block"></small>
                    </div>
 
                    <div class="form-group">
                        <label class="col-md-4 control-label">Nama </label>
                          <input type="text" class="form-control" name="prodiNama">
                          <small class="help-block"></small>
                    </div>
 
                    <div class="form-group">
                        <label class="col-md-4 control-label">Jurusan</label>
                        <div class="has-error">
                            <select class="form-control" name="prodiJurKode">
                                @foreach ($listjurusan as $itemjurusan)
                                <option value="{{$itemjurusan->jurKode}}">{{$itemjurusan->jurNama}}</option>
                                @endforeach
                            </select>
                            
                            <small class="help-block"></small>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" id="button-reg">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>                       
 
            </div>
        </div>
    </div>
</div>

<!--ajax form-->
<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Record</h4>
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label class="control-label col-md-4" >Kode : </label>
            <div class="col-md-8">
             <input type="text" name="first_name" id="first_name" class="form-control" />
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">Nama Prodi : </label>
            <div class="col-md-8">
             <input type="text" name="last_name" id="last_name" class="form-control" />
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">Jurusan : </label>
            <div class="col-md-8">
             <input type="text" name="jurusan" id="jurusan" class="form-control" />
            </div>
           </div>

           <br />
           <div class="form-group" align="center">
            <input type="hidden" name="action" id="action" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
           </div>
         </form>
        </div>
     </div>
    </div>
</div>


<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Confirmation</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--end of Modal -->     



@endsection
@section('script')

<script>
$.noConflict();
jQuery( document ).ready(function( $ ) {
    $('#datatables').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('prodi.data') !!}',
        columns: [
            { data: 'prodiKode', name: 'prodiKode' },
            { data: 'prodiNama', name: 'prodiNama' },
            { data: 'jurNama', name: 'jurNama' },
            { data: 'action', name: 'action' },
        ]
    });

    //Hapus 
    var prodiKode;

     $(document).on('click', '.delete', function(){
      prodiKode = $(this).attr('id');
      $('#confirmModal').modal('show');
     });

     $('#ok_button').click(function(){
      $.ajax({
       url:"prodi/destroy/"+prodiKode,

       beforeSend:function(){
        $('#ok_button').text('Deleting...');

          jQuery( document ).ready(function( $ ) {
          $({property: 0}).animate({property: 105}, {
              duration: 3000,
              step: function() {
                  var _percent = Math.round(this.property);
                  $('#progress').css('width',  _percent+"%");
                  if(_percent == 105) {
                      $("#progress").addClass("done");
                  }
              },
          });
        });
       },

       success:function(data)
       {
        setTimeout(function(){
         $('#confirmModal').modal('hide');
         swal({
              title: "Deleted!",
              text: "Your post has been deleted.",
              type: "success"
          }),
         $('#datatables').DataTable().ajax.reload();
        }, 1000);
       }
      })
     });


});


</script>
<style type="text/css">
    #progress {
        position: fixed;
        z-index: 2147483647;
        top: 0;
        left: -6px;
        width: 0%;
        height: 2px;
        background: #ff3300;
        -moz-border-radius: 1px;
        -webkit-border-radius: 1px;
        border-radius: 1px;
        -moz-transition: width 500ms ease-out,opacity 400ms linear;
        -ms-transition: width 500ms ease-out,opacity 400ms linear;
        -o-transition: width 500ms ease-out,opacity 400ms linear;
        -webkit-transition: width 500ms ease-out,opacity 400ms linear;
        transition: width 500ms ease-out,opacity 400ms linear
    }
    #progress.done {
        opacity: 0
    }
    #progress dd,#progress dt {
        position: absolute;
        top: 0;
        height: 2px;
        -moz-box-shadow: #ff3300 1px 0 6px 1px;
        -ms-box-shadow: #ff3300 1px 0 6px 1px;
        -webkit-box-shadow: #ff3300 1px 0 6px 1px;
        box-shadow: #ff3300 1px 0 6px 1px;
        -moz-border-radius: 100%;
        -webkit-border-radius: 100%;
        border-radius: 100%
    }
    #progress dd {
        opacity: 1;
        width: 20px;
        right: 0;
        clip: rect(-6px,22px,14px,10px)
    }
    #progress dt {
        opacity: 1;
        width: 180px;
        right: -80px;
        clip: rect(-6px,90px,14px,-6px)
    }
    @-moz-keyframes pulse {
        30% {
            opacity: 1
        }
        60% {
            opacity: 0
        }
        100% {
            opacity: 1
        }
    }
    @-ms-keyframes pulse {
        30% {
            opacity: .6
        }
        60% {
            opacity: 0
        }
        100% {
            opacity: .6
        }
    }
    @-o-keyframes pulse {
        30% {
            opacity: 1
        }
        60% {
            opacity: 0
        }
        100% {
            opacity: 1
        }
    }
    @-webkit-keyframes pulse {
        30% {
            opacity: .6
        }
        60% {
            opacity: 0
        }
        100% {
            opacity: .6
        }
    }
    @keyframes pulse {
        30% {
            opacity: 1
        }
        60% {
            opacity: 0
        }
        100% {
            opacity: 1
        }
    }
    #progress.waiting dd,#progress.waiting dt {
        -moz-animation: pulse 2s ease-out 0s infinite;
        -ms-animation: pulse 2s ease-out 0s infinite;
        -o-animation: pulse 2s ease-out 0s infinite;
        -webkit-animation: pulse 2s ease-out 0s infinite;
        animation: pulse 2s ease-out 0s infinite
    }
  
</style>

@endsection
