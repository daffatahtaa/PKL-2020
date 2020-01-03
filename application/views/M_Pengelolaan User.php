<!-- Page Content -->
<div class="page-wrapper">
    <div class="container-fluid">
      <div class="row page-titles">
          <div class="col-md-5 col-8 align-self-center">
              <h3 class="text-themecolor m-b-0 m-t-0">Manage User</h3>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="javascript:void(0)">Manage User</a></li>
              </ol>
          </div>
      </div>
      <div class="card">
        <div style="padding: 20px;">
        <div>
          <a class="btn btn-primary" href="<?php echo base_url(); ?>user_authentication/user_registration_show">
            <i class="fas fa-plus">
            </i> Tambahkan User</a>


          <table id="tabel1" class="table" style="width:100%">
            <thead>
              <tr>
                <th>No.</th>
                <th>User ID</th>
                <th>Kode Uker</th>
                <th>Nama Uker</th>
                <th>Role</th>
                <th>Tanggal Input</th>
                <th>Tanggal Perubahan</th>
                <th>User Yang Merubah</th>
                <th style="width:80px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $counter=1 ?>
              <?php foreach ($data as $item) { ?>
              <tr>
                <td><?php echo $counter;?></td>
                <td><?php echo $item->Id;?></td>
                <td><?php echo $item->uker;?></td>
                <td><?php echo $item->ket_uker;?></td>
                <td><?php echo $item->role;?></td>
                <td><?php echo $item->CREATE_DATE;?></td>
                <td><?php echo $item->UPDATE_DATE;?></td>
                <td><?php echo $item->UPDATE_BY;?></td>

                <td>
                  <div class="btn-group " role="group" aria-label="Basic example">
                    <a title="Edit" class="btn btn-primary btn-sm" href="<?php echo base_url('user_authentication/edit/'.$item->Id); ?>">
                      <i class="fas fa-edit"></i></a>
                    <a title="Reset Password" class="btn btn-warning btn-sm" href="<?php echo base_url('user_authentication/reset/'.$item->Id); ?>">
                      <i class="fas fa-redo"></i></a>
                    <button title="Hapus" type="button" class="btn btn btn-danger btn-sm"
                      data-toggle="modal" data-target="#modal-delete"
                      data-item-name="Id" data-item-id="<?php echo $item->Id;?>">
                      <i class="fas fa-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
                <?php $counter++ ?>
              <?php }?>

            </tbody>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>User ID</th>
                <th>Kode Uker</th>
                <th>Nama Uker</th>
                <th>Role</th>
                <th>Tanggal Input</th>
                <th>Tanggal Perubahan</th>
                <th>User Yang Merubah</th>
                <th>Action</th>
              </tr>
            </tfoot>
          </table>
        </div>

      </div>

        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-delete">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Hapus User</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p id="modal-text">Apakah Anda yakin akan menghapus "<span id="item-nama"></span>" ?</p>
        </div>
        <div class="modal-footer">
            <form id="form-delete" method="DELETE">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger" style="width:57px;"> Iya </button>
            </form>
        </div>
    </div>
</div>
</div>

<script>
$(document).ready(function() {
$('#tabel1').DataTable({
  scrollCollapse: true,
  paging: true,
  columnDefs:[
    {width:'20%', targets:0}
  ],
  fixedColumns: true
});
} );
</script>
<script>
$('#modal-delete').on('show.bs.modal', function(e) {

    //get attribute of the clicked element
    var itemId = $(e.relatedTarget).attr('data-item-nama');
    var itemName = $(e.relatedTarget).attr('data-item-id');
    var url = "<?php echo base_url('user_authentication/delete/:id'); ?>";
    url = url.replace(':id', itemName);

    var modal = $(this);
    modal.find('#form-delete').attr('action', url);
    modal.find('#item-nama').html(itemName);
    modal.find('#item-id').html(itemId);
});
</script>
