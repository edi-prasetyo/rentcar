<?php
//Notifikasi
if ($this->session->flashdata('message')) {
  echo $this->session->flashdata('message');
  unset($_SESSION['message']);
}

?>

<div class="card">
  <div class="card-header bg-white">
    <h5 class="card-title"><?php echo $title; ?></h5>
    <div class="card-tools">
      <a href="<?php echo base_url('admin/mobil/create') ?>" title="Tambah Mobil baru" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Baru</a>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-flush">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th width="5%">img</th>
          <th>Type</th>
          <th>Status</th>
          <th width="45%">Paket</th>
          <th width="15%">Action</th>
        </tr>
      </thead>
      <tbody>

        <?php $i = 1;
        foreach ($mobil as $mobil) { ?>

          <tr>
            <td><?php echo $i ?></td>
            <td><img src="<?php echo base_url('assets/img/mobil/' . $mobil->mobil_gambar) ?>" width="60" class="img img-thumbnail"></td>
            <td><?php echo $mobil->mobil_name; ?></td>
            <td><?php echo $mobil->mobil_status ?></td>
            <td> <a href="<?php echo base_url('admin/mobil/airport/' . $mobil->id) ?>" title="Edit Mobil" class="btn btn-primary btn-sm"><i class="fa-solid fa-plane-arrival"></i> Paket Bandara</a>
              <a href="<?php echo base_url('admin/mobil/dropoff/' . $mobil->id) ?>" title="Edit Mobil" class="btn btn-info btn-sm"><i class="fa fa-car"></i> Paket Drop Off</a>
              <a href="<?php echo base_url('admin/mobil/daily/' . $mobil->id) ?>" title="Edit Mobil" class="btn btn-success btn-sm"><i class="far fa-calendar-alt"></i> Paket Harian</a>
              <!-- <a href="<?php echo base_url('admin/mobil/hourly/' . $mobil->id) ?>" title="Edit Mobil" class="btn btn-success btn-sm"><i class="far fa-clock"></i> Paket per Jam</a> -->
            </td>
            <td>

              <a href="<?php echo base_url('admin/mobil/update/' . $mobil->id) ?>" title="Edit Mobil" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
              <?php
              //link Delete
              include('delete_mobil.php');
              ?>


            </td>
          </tr>

        <?php $i++;
        } ?>

      </tbody>
    </table>
  </div>
</div>