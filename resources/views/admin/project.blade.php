@extends('layouts.admin')

@section('breadcrumb')
<li class="breadcrumb-item active">Project</li>
@endsection

@section('content')
<div class="card mb3">

  <div class="card-header">
    <i class="fa fa-area-chart"></i> Project Management
    <button class="btn btn-success btn-sm" id="addProject" data-toggle="modal" data-target="#addModal" style="float: right;"><i class="fa fa-plus"></i> Add Project</button>
  </div>

  <div class="card-body">


    <div class="table-responsive">
      <div class="col-12">
        <table class="table display" id="projectTable">
          <thead>
            <tr>
              <th>Category</th>
              <th>Project</th>
              <th>Team</th>
              <th>Lokasi</th>
              <th>Keterangan</th>
              <th>Mulai</th>
              <th>Selesai</th>
              <th>Fee (Rp)</th>
              <th>Pengeluaran (Rp)</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>


  </div>

</div>

<!-- Add Modal-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Add new Project</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="post" id="addForm">

          <div class="form-group">
            <label>Kategori Project</label>
            <select name="category" class="form-control" id="addProjectCat">
              <option value="" selected="">-</option>
              <option value="studi_kelayakan">Studi Kelayakan</option>
              <option value="riset_pasar">Riset Pasar</option>
              <option value="pelatihan">Pelatihan</option>
              <option value="pengawasan">Pengawasan</option>
            </select>
            <p class="invalid-feedback add-category"></p>
          </div>

          <div class="form-group">
            <label>Nama Project</label>
            <input type="text" name="project" class="form-control" id="addProjectName">
            <p class="invalid-feedback add-project"></p>
          </div>

          <div class="form-group">
            <label>Team</label>
            <input type="text" class="form-control" id="addTeam">
            <input type="hidden" name="team_array" id="addTeamArray" value="">
            <button class="btn btn-info btn-sm" id="addTeamBtn"><i class="fa fa-plus"></i> Add</button>
            <ul id="addTeamList">
            </ul>
          </div>

          <div class="form-group">
            <label>Lokasi Project</label>
            <input type="text" class="form-control" id="addLokasi">
            <input type="hidden" name="team_array" id="addLokasiArray" value="">
            <button class="btn btn-info btn-sm" id="addLokasiBtn"><i class="fa fa-plus"></i> Add</button>
            <ul id="addLokasiList">
            </ul>
          </div>

          <!-- <div class="form-group">
            <label>Lokasi Project</label>
            <input type="text" name="lokasi" class="form-control" id="addProjectLokasi">
            <p class="invalid-feedback add-lokasi"></p>
          </div> -->

          <div class="form-group">
            <label>Keterangan Project</label>
            <textarea name="keterangan" class="form-control" id="addProjectKeterangan"></textarea>
            <p class="invalid-feedback add-keterangan"></p>
          </div>

          <div class="form-group">
            <label>Mulai Project</label>
            <input type="date" name="mulai" class="form-control" id="addProjectMulai">
            <p class="invalid-feedback add-mulai"></p>
          </div>

          <div class="form-group">
            <label>Selesai Project</label>
            <input type="date" name="selesai" class="form-control" id="addProjectSelesai">
            <p class="invalid-feedback add-selesai"></p>
          </div>

          <label>Fee Project</label>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Rp</span>
            <input type="number" name="fee" class="form-control" id="addProjectFee">
            <br/>
            <p class="invalid-feedback add-fee"></p>
          </div>

          <label>Pengeluaran Project</label>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Rp</span>
            <input type="number" name="pengeluaran" class="form-control" id="addProjectPengeluaran">
            <br/>
            <p class="invalid-feedback add-pengeluaran"></p>
          </div>

          <br/>
          <input type="submit" class="btn btn-primary" value="Add new Project">

        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
      </div>

    </div>

  </div>

</div>

<!-- Edit Modal-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Edit Project</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="post" id="editForm">

          <input type="hidden" id="editID">

          <div class="form-group">
            <label>Kategori Project</label>
            <select name="category" class="form-control" id="editProjectCat">
              <option value="studi_kelayakan">Studi Kelayakan</option>
              <option value="riset_pasar">Riset Pasar</option>
              <option value="pelatihan">Pelatihan</option>
              <option value="pengawasan">Pengawasan</option>
            </select>
            <p class="invalid-feedback edit-category"></p>
          </div>

          <div class="form-group">
            <label>Nama Project</label>
            <input type="text" name="project" class="form-control" id="editProjectName">
            <p class="invalid-feedback edit-project"></p>
          </div>

          <div class="form-group">
            <label>Team</label>
            <input type="text" class="form-control" id="editTeam">
            <input type="hidden" name="team_array" id="editTeamArray" value="">
            <button class="btn btn-info btn-sm" id="editTeamBtn"><i class="fa fa-plus"></i> Add</button>
            <ul id="editTeamList">
            </ul>
          </div>

          <div class="form-group">
            <label>Lokasi Project</label>
            <input type="text" class="form-control" id="editLokasi">
            <input type="hidden" name="lokasi_array" id="editLokasiArray" value="">
            <button class="btn btn-info btn-sm" id="editLokasiBtn"><i class="fa fa-plus"></i> Add</button>
            <ul id="editLokasiList">
            </ul>
          </div>

          <!-- <div class="form-group">
            <label>Lokasi Project</label>
            <input type="text" name="lokasi" class="form-control" id="editProjectLokasi">
            <p class="invalid-feedback edit-lokasi"></p>
          </div> -->

          <div class="form-group">
            <label>Keterangan Project</label>
            <textarea name="keterangan" class="form-control" id="editProjectKeterangan"></textarea>
            <p class="invalid-feedback edit-keterangan"></p>
          </div>

          <div class="form-group">
            <label>Mulai Project</label>
            <input type="date" name="mulai" class="form-control" id="editProjectMulai">
            <p class="invalid-feedback edit-mulai"></p>
          </div>

          <div class="form-group">
            <label>Selesai Project</label>
            <input type="date" name="selesai" class="form-control" id="editProjectSelesai">
            <p class="invalid-feedback edit-selesai"></p>
          </div>

          <label>Fee Project</label>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Rp</span>
            <input type="number" name="fee" class="form-control" id="editProjectFee">
            <br/>
            <p class="invalid-feedback edit-fee"></p>
          </div>

          <label>Pengeluaran Project</label>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Rp</span>
            <input type="number" name="pengeluaran" class="form-control" id="editProjectPengeluaran">
            <br/>
            <p class="invalid-feedback edit-pengeluaran"></p>
          </div>

          <br/>
          <input type="submit" class="btn btn-primary" value="Edit Project">

        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
      </div>

    </div>

  </div>

</div>

@endsection

@section('script')

<?php
  $url = request()->fullUrl();
  if (strpos($url, 'deadline')) {
    $projectUrl = url('admin/project-json') . '?status=deadline';
  } else if (strpos($url, 'running')) {
    $projectUrl = url('admin/project-json') . '?status=running';
  } else if (strpos($url, 'finish')) {
    $projectUrl = url('admin/project-json') . '?status=finish';
  } else {
    $projectUrl = url('admin/project-json');
  }
?>

<script>
$(document).ready(function () {

  $('#projectTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ $projectUrl }}",
    columns: [
      {data: 'category', name: 'category'},
      {data: 'project', name: 'project'},
      {data: 'team', name: 'team'},
      {data: 'lokasi', name: 'lokasi'},
      {data: 'keterangan', name: 'keterangan'},
      {data: 'mulai', name: 'mulai'},
      {data: 'selesai', name: 'selesai'},
      {data: 'fee', name: 'fee'},
      {data: 'pengeluaran', name: 'pengeluaran'},
      {data: 'action', name: 'action'},
    ]
  });

  $('#addProject').click(function () {
    $('#addForm').trigger('reset');

    $('#addProjectCat').removeClass('is-invalid');
    $('#addProjectName').removeClass('is-invalid');
    $('#addProjectLokasi').removeClass('is-invalid');
    $('#addProjectMulai').removeClass('is-invalid');
    $('#addProjectSelesai').removeClass('is-invalid');
    $('#addProjectFee').removeClass('is-invalid');
    $('#addProjectPengeluaran').removeClass('is-invalid');

    $('.invalid-feedback.add-category').empty();
    $('.invalid-feedback.add-project').empty();
    $('.invalid-feedback.add-lokasi').empty();
    $('.invalid-feedback.add-mulai').empty();
    $('.invalid-feedback.add-selesai').empty();
    $('.invalid-feedback.add-fee').empty();
    $('.invalid-feedback.add-pengeluaran').empty();
  });

  // dynamic team
  $('#addTeamBtn').on('click', function (event) {
    event.preventDefault();
    if ($('#addTeam').val() !== '') {
      $('#addTeamList').append('<li>'+$('#addTeam').val()+' <button class="btn btn-danger delete-item"><i class="fa fa-trash"></i></button></li>');
    }
  });

  $('#editTeamBtn').on('click', function (event) {
    event.preventDefault();
    if ($('#editTeam').val() !== '') {
      $('#editTeamList').append('<li>'+$('#editTeam').val()+' <button class="btn btn-danger delete-item"><i class="fa fa-trash"></i></button></li>');
    }
  });

  $('#addTeamList').on('click', '.delete-item', function (e) {
    var item = this;
    deleteItem(e, item);

  });

  $('#editTeamList').on('click', '.delete-item', function (e) {
    var item = this;
    deleteItem(e, item);

  });

  // dynamic location
  $('#addLokasiBtn').on('click', function (event) {
    event.preventDefault();
    if ($('#addLokasi').val() !== '') {
      $('#addLokasiList').append('<li>'+$('#addLokasi').val()+' <button class="btn btn-danger delete-item"><i class="fa fa-trash"></i></button></li>');
    }
  });

  $('#editLokasiBtn').on('click', function (event) {
    event.preventDefault();
    if ($('#editLokasi').val() !== '') {
      $('#editLokasiList').append('<li>'+$('#editLokasi').val()+' <button class="btn btn-danger delete-item"><i class="fa fa-trash"></i></button></li>');
    }
  });

  $('#addLokasiList').on('click', '.delete-item', function (e) {
    var item = this;
    deleteItem(e, item);

  });

  $('#editLokasiList').on('click', '.delete-item', function (e) {
    var item = this;
    deleteItem(e, item);

  });

  $('#addForm').on('submit', function () {
    event.preventDefault();

    var team = [];
    $('#addTeamList > li').each(function () {
      var list = $(this);
      team.push($(this).text());
    });
    $('#addTeamArray').val(team);

    var lokasi = [];
    $('#addLokasiList > li').each(function () {
      var list = $(this);
      lokasi.push($(this).text());
    });
    $('#addLokasiArray').val(lokasi);

    $.ajax({
      url: "{{ url('admin/project-rest') }}",
      type: 'POST',
      dataType: 'JSON',
      data: {
        method: '_STORE',
        category: $('#addProjectCat').val(),
        project: $('#addProjectName').val(),
        team_array: $('#addTeamArray').val(),
        lokasi: $('#addLokasiArray').val(),
        keterangan: $('#addProjectKeterangan').val(),
        mulai: $('#addProjectMulai').val(),
        selesai: $('#addProjectSelesai').val(),
        fee: $('#addProjectFee').val(),
        pengeluaran: $('#addProjectPengeluaran').val(),
      },
      success: function (data) {
        if (data.errors) {
          console.log(data.errors);

          if (data.errors.category) {
            $('#addProjectCat').addClass('is-invalid');
            $('.invalid-feedback.add-category').text(data.errors.category);
          } else {
            $('#addProjectCat').removeClass('is-invalid');
            $('.invalid-feedback.add-category').empty();
          }

          if (data.errors.team_array) {
            $('#addTeam').addClass('is-invalid');
          } else {
            $('#addTeam').removeClass('is-invalid');
          }

          if (data.errors.lokasi) {
            $('#addLokasi').addClass('is-invalid');
          } else {
            $('#addLokasi').removeClass('is-invalid');
          }

          if (data.errors.project) {
            $('#addProjectName').addClass('is-invalid');
            $('.invalid-feedback.add-project').text(data.errors.project);
          } else {
            $('#addProjectName').removeClass('is-invalid');
            $('.invalid-feedback.add-project').empty();
          }

          // if (data.errors.lokasi) {
          //   $('#addProjectLokasi').addClass('is-invalid');
          //   $('.invalid-feedback.add-lokasi').text(data.errors.lokasi);
          // } else {
          //   $('#addProjectLokasi').removeClass('is-invalid');
          //   $('.invalid-feedback.add-lokasi').empty();
          // }

          if (data.errors.mulai) {
            $('#addProjectMulai').addClass('is-invalid');
            $('.invalid-feedback.add-mulai').text(data.errors.mulai);
          } else {
            $('#addProjectMulai').removeClass('is-invalid');
            $('.invalid-feedback.add-mulai').empty();
          }

          if (data.errors.selesai) {
            $('#addProjectSelesai').addClass('is-invalid');
            $('.invalid-feedback.add-selesai').text(data.errors.selesai);
          } else {
            $('#addProjectSelesai').removeClass('is-invalid');
            $('.invalid-feedback.add-selesai').empty();
          }

          if (data.errors.fee) {
            $('#addProjectFee').addClass('is-invalid');
            $('.invalid-feedback.add-fee').text(data.errors.fee);
          } else {
            $('#addProjectFee').removeClass('is-invalid');
            $('.invalid-feedback.add-fee').empty();
          }

          if (data.errors.pengeluaran) {
            $('#addProjectPengeluaran').addClass('is-invalid');
            $('.invalid-feedback.add-pengeluaran').text(data.errors.pengeluaran);
          } else {
            $('#addProjectPengeluaran').removeClass('is-invalid');
            $('.invalid-feedback.add-pengeluaran').empty();
          }

        } else {
          toastr.success('Project berhasil ditambahkan');
          $('#addModal').modal('hide');
          $('#projectTable').DataTable().draw(false);
        }
      }
    })
  });

  $('#projectTable').on('click', '.edit[data-id]', function () {
    console.log('edit project ' + $(this).data('id'));
    $('#editModal').modal('show');

    $.ajax({
      url: "{{ url('admin/project-rest') }}/" + $(this).data('id') + "/edit",
      type: 'GET',
      dataType: 'JSON',
      data: {
        method: '_EDIT',
      },
      success: function (data) {
        $('#editID').val(data.project.id);
        $('#editProjectCat').val(data.project.category);
        $('#editProjectName').val(data.project.project);
        // $('#editProjectLokasi').val(data.project.lokasi);
        $('#editProjectKeterangan').val(data.project.keterangan);
        $('#editProjectMulai').val(data.project.mulai);
        $('#editProjectSelesai').val(data.project.selesai);
        $('#editProjectFee').val(data.project.fee);
        $('#editProjectPengeluaran').val(data.project.pengeluaran);

        $('#editTeamList').html(data.team);
        $('#editLokasiList').html(data.lokasi);
      }
    })
  })

  $('#editForm').on('submit', function () {
    event.preventDefault();

    var team = [];
    $('#editTeamList > li').each(function () {
      var list = $(this);
      team.push($(this).text());
    });
    $('#editTeamArray').val(team);

    var lokasi = [];
    $('#editLokasiList > li').each(function () {
      var list = $(this);
      lokasi.push($(this).text());
    });
    $('#editLokasiArray').val(lokasi);

    $.ajax({
      url: "{{ url('admin/project-rest') }}/" + $('#editID').val(),
      type: 'PUT',
      dataType: 'JSON',
      data: {
        method: '_UPDATE',
        id: $('#editID').val(),
        category: $('#editProjectCat').val(),
        team_array: $('#editTeamArray').val(),
        project: $('#editProjectName').val(),
        lokasi: $('#editLokasiArray').val(),
        keterangan: $('#editProjectKeterangan').val(),
        mulai: $('#editProjectMulai').val(),
        selesai: $('#editProjectSelesai').val(),
        fee: $('#editProjectFee').val(),
        pengeluaran: $('#editProjectPengeluaran').val(),
      },
      success: function (data) {
        if (data.errors) {
          console.log(data.errors);

          if (data.errors.category) {
            $('#editProjectCat').addClass('is-invalid');
            $('.invalid-feedback.edit-category').text(data.errors.category);
          } else {
            $('#editProjectCat').removeClass('is-invalid');
            $('.invalid-feedback.edit-category').empty();
          }

          if (data.errors.team_array) {
            $('#editTeam').addClass('is-invalid');
          } else {
            $('#editTeam').removeClass('is-invalid');
          }

          if (data.errors.lokasi) {
            $('#editLokasi').addClass('is-invalid');
          } else {
            $('#editLokasi').removeClass('is-invalid');
          }

          if (data.errors.project) {
            $('#editProjectName').addClass('is-invalid');
            $('.invalid-feedback.edit-project').text(data.errors.project);
          } else {
            $('#editProjectName').removeClass('is-invalid');
            $('.invalid-feedback.edit-project').empty();
          }

          // if (data.errors.lokasi) {
          //   $('#editProjectLokasi').addClass('is-invalid');
          //   $('.invalid-feedback.edit-lokasi').text(data.errors.lokasi);
          // } else {
          //   $('#editProjectLokasi').removeClass('is-invalid');
          //   $('.invalid-feedback.edit-lokasi').empty();
          // }

          if (data.errors.mulai) {
            $('#editProjectMulai').addClass('is-invalid');
            $('.invalid-feedback.edit-mulai').text(data.errors.mulai);
          } else {
            $('#editProjectMulai').removeClass('is-invalid');
            $('.invalid-feedback.edit-mulai').empty();
          }

          if (data.errors.selesai) {
            $('#editProjectSelesai').addClass('is-invalid');
            $('.invalid-feedback.edit-selesai').text(data.errors.selesai);
          } else {
            $('#editProjectSelesai').removeClass('is-invalid');
            $('.invalid-feedback.edit-selesai').empty();
          }

          if (data.errors.fee) {
            $('#editProjectFee').addClass('is-invalid');
            $('.invalid-feedback.edit-fee').text(data.errors.fee);
          } else {
            $('#editProjectFee').removeClass('is-invalid');
            $('.invalid-feedback.edit-fee').empty();
          }

          if (data.errors.pengeluaran) {
            $('#editProjectPengeluaran').addClass('is-invalid');
            $('.invalid-feedback.edit-pengeluaran').text(data.errors.pengeluaran);
          } else {
            $('#editProjectPengeluaran').removeClass('is-invalid');
            $('.invalid-feedback.edit-pengeluaran').empty();
          }

        } else {
          toastr.success('Data berhasil diperbarui');
          $('#editModal').modal('hide');
          $('#projectTable').DataTable().draw(false);
        }
      }
    })
  })

  $('#projectTable').on('click', '.delete[data-id]', function () {
    console.log('delete project ' + $(this).data('id'));

    if (confirm('Apakah anda yakin?')) {
      $.ajax({
        url: "{{ url('admin/project-rest') }}/" + $(this).data('id'),
        type: 'DELETE',
        dataType: 'JSON',
        data: {
          method: '_DESTROY',
        },
        success: function (data) {
          toastr.success('Data berhasil terhapus');
          $('#projectTable').DataTable().draw(false);
        }
      })
    }
  })

});

function deleteItem(e, item) {
  e.preventDefault();
    $(item).parent().fadeOut('slow', function() {
      $(item).parent().remove();
  });
}
</script>
@endsection
