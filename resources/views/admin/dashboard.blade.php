@extends('admin.nav')

@section('link_rel')
    <link rel="stylesheet" href="css/homeHtyle.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('LTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('LTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('LTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('LTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('LTE/plugins/toastr/toastr.min.css') }}">
@endsection

@section('title')

@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
          <div class="info-box bg-gradient-olive">
            @foreach ($data as $item)
            <div class="info-box-content">
                <img src="image/guru.jpg" class="brand-image" style="opacity: .8" height="200" width="200">
            </div>
                <div class="col-lg-4 info-box-content">
                    <span class="info-box-text"><h3>SELAMAT DATANG</h3></span>
                    <div class="row">
                        <div class="col-sm-1"><p>NAMA</p></div>
                        <div class="col-sm-1"><p> : </p></div>
                        <div class="col"><p>{{ $item->NAMA }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"><p>ALAMAT</p></div>
                        <div class="col-sm-1"><p> : </p></div>
                        <div class="col"><p>{{ $item->ALAMAT }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"><p>TTL</p></div>
                        <div class="col-sm-1"><p> : </p></div>
                        <div class="col"><p>{{ $item->TTL }}</p></div>
                    </div>
                </div>
            @endforeach
            <div class="info-box-content">
                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <h3><i class="fas fa-graduation-cap"></i> {{ \App\Models\Daftar_Siswa::count()  }}<sup style="font-size: 20px"></sup></h3>

                                <p>Total Murid</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <!-- small box -->
                        <div class="small-box ">
                            <div class="inner">
                                <h3><i class="fas fa-school"></i> {{ \App\Models\Daftar_Guru::count()  }}<sup style="font-size: 20px"></sup></h3>

                                <p>Total Guru</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <!-- small box -->
                        <div class="small-box ">
                            <div class="inner">
                                <h3><i class="fas fa-landmark"></i> {{ \App\Models\Daftar_Kelas::count()  }}<sup style="font-size: 20px"></sup></h3>
                                <p>Total Kelas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          </div> <!-- /.info-box-content -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-gray">
                <div class="inner">
                    <h3><i class="fas fa-settings"></i> Setting Guru<sup style="font-size: 20px"></sup></h3>

                    <p>Total Guru {{ \App\Models\Daftar_Guru::count()  }}</p>
                </div>
                <a href="{{ route('/kbm_guru')}}" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-gray">
                <div class="inner">
                    <h3><i class="fas fa-landmark"></i> Tambah Kelas<sup style="font-size: 20px"></sup></h3>

                    <p>Total Kelas {{ \App\Models\Daftar_Kelas::count()  }}</p>
                </div>
                <a href="{{ route('/data_kelas')}}" class="small-box-footer" >Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-gray">
                <div class="inner">
                    <h3><i class="fas fa-landmark"></i> {{ \App\Models\Daftar_Kelas::count()  }}<sup style="font-size: 20px"></sup></h3>

                    <p>Total Kelas</p>
                </div>
                <a class="small-box-footer">Info Lebih Lanjut </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Deskripsi -->
<div class="modal fade" id="infoDetail">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h6 class="modal-title">Informasi Detail</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="callout callout-info">
          <dl class="row">
            <dt class="col-sm-4">ID</dt><dd class="col-sx-1">:</dd>
            <dd class="col-sm-7" id="aCPL"></dd>
            <dt class="col-sm-4">Uraian</dt><dd class="col-sx-1">:</dd>
            <dd class="col-sm-7" id="aKet"></dd>
          </dl>
        </div>
      </div>

      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-reply-all"></i> Close</button>
      </div>

    </div>
  </div>
</div>
    <!-- Modal Update -->
  <div class="modal fade" id="EditModal" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h6 class="modal-title" id="tJudul">Data</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form class="form-horizontal" id="EditForm">
          @csrf
          @method('PUT')

          <div class="modal-body">
            <div class="form-group row">
              <label for="inputText" class="col-sm-2 col-form-label">NAMA KELAS</label>
              <div class="col-sm-10">
                <div class="input-group input-group-sm">
                  <input type="text" name="NAMA" id="eNAMA"  class="form-control" placeholder="NAMA" required>
                </div>
              </div>
              <label for="inputText" class="col-sm-2 col-form-label">GURU</label>
                <div class="col-sm-10">
                  <select name="GURU" class="form-control select2" id="eGURU" style="width: 100%;" >
                      @foreach ($daftar_guru as $d)
                      <option value="{{ $d->ID }}" >{{ $d->NAMA }} </option>
                      @endforeach
                  </select>

                </div>
              <label for="inputText" class="col-sm-2 col-form-label">TINGKAT</label>
              <div class="col-sm-10">
                <div class="input-group input-group-sm">
                  <input type="text" name="TINGKAT" id="eTINGKAT"  class="form-control" placeholder="TINGKAT" required>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-reply"></i> Cancel</button>
            <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Save</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <!-- Modal Delete -->
  <div class="modal fade" id="DelRecModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h6 class="modal-title"><i class="fa fa-question-circle"></i>  Hapus Detail Data</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form id="DelRecForm">
          @csrf
          @method('PUT')

          <div class="modal-body">
            <div class="row">
                <dd class="col-sm-8" id="dID" hidden=""></dd>
              <dt class="col-sm-4">Category Name </dt><dd class="col-sx-1">:</dd>
              <dd class="col-sm-6" id="dname_categories"></dd>
            </div>
          </div>

          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-reply-all"></i> Cancel</button>
            <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Delete</button>
          </div>
        </form>

      </div>
    </div>
  </div>
@endsection

@section('script_src')
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('LTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('LTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('LTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('LTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('LTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('LTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('LTE/plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('LTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('LTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('LTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('LTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('LTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <!-- SweetAlert2 -->
  <script src="{{ asset('LTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('LTE/plugins/toastr/toastr.min.js') }}"></script>
@endsection

@section('script_e')
  <script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      // Modal Add & Edit
    $('.EditBtn').on('click',function() {
      $cID = $(this).attr("value");
      if ($cID == "new") {
        $("#tJudul").text("Add Data KELAS");
        $("#eNAMA").val("");
        $("#eGURU").val("");
        $("#eTINGKAT").val("");
        }
      else {
        $("#tJudul").text("Edit Data Categories");
        $.get("Det_Cat/"+$(this).attr("value"))
          .done(function(data){
            $("#ename_categories").val(data[0].name_categories);
            $cID = data[0].ID;
          });
        }

      $i = 0;
      $('#EditForm').on('submit',function(e){
        e.preventDefault();
        if ( $i == 0 ) {
          $i = 1;
          var id = $cID;

          $.ajax({
            type : "PUT",
            url : "Upd_Cat/"+id,
            data : $('#EditForm').serialize(),
            success : function (response) {
              console.log(response);
              $('#EditModal').modal('hide');

              toastr.success('SUCCESS.., Input data berhasil, Silahkan klik reload/refresh.');
              location.reload();
            },
            error: function(error) {
              console.log(error);
              toastr.error('ERROR.., silahkan dicek kembali.');
              $i = 0;
            }
          });
        }
      });
    })

    // Modal Delete Record
    $('.DelBtn').on('click',function() {
      $.get("Det_Cat/"+$(this).attr("value"))
        .done(function(data){
        $('#dID').text(data[0].ID);
        $('#dname_categories').text(data[0].name_categories);
      });

      $('#DelRecForm').on('submit',function(e){
        e.preventDefault();
        var id = $('#dID').text();
        $.ajax({
          type : "PUT",
          url : "Del_Cat/"+id,
          data : $('#DelRecForm').serialize(),
          success : function (response) {
            console.log(response);
            $('#DelRecModal').modal('hide');
            toastr.success('SUCCESS..., Data CPL sudah terhapus, Silahkan klik refresh/reload');
            // location.reload();
          },
          error: function(error) {
            console.log(error);
            toastr.error('ERROR.., Hapus data terjadi kesalahan.');
          }
        });
      });

    });
  </script>
@endsection
