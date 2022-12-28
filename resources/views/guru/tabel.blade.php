@extends('guru.nav')

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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">DAFTAR PENILAIAN </h5>
              </div>
        </div>
    </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>TUGAS<sup style="font-size: 20px"></sup></h3>

                    <p>Tugas Harian</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="/data_tugas/1" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>UH<sup style="font-size: 20px"></sup></h3>

                    <p>Ulangan Harian</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="/data_uh/1" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>UTS<sup style="font-size: 20px"></sup></h3>

                    <p>Ujian Tengah Semester</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="/data_uts" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>UAS<sup style="font-size: 20px"></sup></h3>

                    <p>Ujian Akhir Semester</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="/data_uas" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
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
              <label for="inputText" class="col-sm-2 col-form-label">Nilai Baru</label>
              <div class="col-sm-10">
                <div class="input-group input-group-sm">
                  <input type="text" name="nilai" id="eNilai"  class="form-control" placeholder="Nilai" required>
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
        $("#tJudul").text("Add Data Categories");
        $("#ename_categories").val("");
        }
      else {
        $("#tJudul").text("Edit Data Nilai");
        $.get("Det_Uas/"+$(this).attr("value"))
          .done(function(data){
            $("#eNilai").val(data[0].NILAI);
            $cID = data[0].ID_UAS;
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
            url : "Upd_Uas/"+id,
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
