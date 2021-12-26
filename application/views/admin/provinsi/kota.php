<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <?php echo form_open(); ?>
                <div class="form-group">
                    <label>Nama Kota / Kabupaten</label>
                    <input type="text" class="form-control" name="kota_name" placeholder="Nama Kota" required="required">
                    <?php echo form_error('kota_name', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">

                <h3 class="card-title">Data Kota / kabupaten di Provinsi <?php echo $provinsi->provinsi_name; ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php
                //Notifikasi
                if ($this->session->flashdata('message')) {
                    echo $this->session->flashdata('message');
                    unset($_SESSION['message']);
                }
                echo validation_errors('<div class="alert alert-warning">', '</div>');

                ?>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama Kota</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($kota as $kota) : ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $kota->kota_name; ?></td>
                            <td>
                                <?php include "update_kota.php"; ?>
                                <a href="<?php echo base_url(); ?>" class="btn btn-danger btn-sm">hapus</a>
                            </td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>

                </tbody>
            </table>




        </div>

    </div>
</div>