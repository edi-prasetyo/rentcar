<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item"><a class="nav-link active" href="<?php echo base_url('admin/topup'); ?>">Pending</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/topup/sukses'); ?>">Selesai</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/topup/batal'); ?>">Batal</a></li>
        </ul>
    </div>

    <div class="card-body">
        <div class="row">
            <!-- <div class="col-md-4">
                <?php echo form_open('admin/topup'); ?>
                <div class="input-group mb-3">
                    <input type="text" name="code_topup" class="form-control" placeholder="Masukan Kode Topup" value="<?php echo set_value('code_topup'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit" id="button-addon2">Cari</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div> -->
            <!-- <div class="col-md-4">
                <?php echo form_open('admin/transaksi'); ?>
                <div class="input-group mb-3" style="width: 100%;">
                    <select class="form-control select2bs4" name="kota_asal">
                        <option>Pilih Kota Asal</option>
                        <?php foreach ($list_kota_asal as $kota) : ?>
                            <option value='<?php echo $kota->kota_name; ?>'><?php echo $kota->kota_name; ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-group-append">
                        <input type='submit' name='submit' value='Cari' class="btn btn-info">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div> -->
            <!-- <div class="col-md-4">
                <?php echo form_open('admin/transaksi'); ?>
                <div class="input-group mb-3" style="width: 100%;">
                    <select class="form-control select2bs4" name="kota_tujuan">
                        <option>Pilih Kota Tujuan</option>
                        <?php foreach ($list_kota_tujuan as $kota_tujuan) : ?>
                            <option value='<?php echo $kota_tujuan->kota_name; ?>'><?php echo $kota_tujuan->kota_name; ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-group-append">
                        <input type='submit' name='submit' value='Cari' class="btn btn-info">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div> -->
        </div>
    </div>

    <?php
    //Notifikasi
    if ($this->session->flashdata('message')) {
        echo '<div class="alert alert-success">';
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
        echo '</div>';
    }
    echo validation_errors('<div class="alert alert-warning">', '</div>');

    ?>

    <div class="card-body table-responsive p-0">

        <table class="table">
            <thead class="thead-white">
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Kode Top Up</th>
                    <th>Driver</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($topup as $topup) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($topup->date_created)); ?><br> <?php echo date('H:i:s', strtotime($topup->date_created)); ?></td>
                    <td><b><?php echo $topup->code_topup; ?></b></td>
                    <td><?php echo $topup->name; ?></td>
                    <td>Rp. <?php echo number_format($topup->nominal, 0, ",", "."); ?></td>
                    <td>
                        <?php if ($topup->status_bayar == "Pending") : ?>
                            <span class="badge badge-warning badge-pill">Pending</span>
                        <?php elseif ($topup->status_bayar == "Process") : ?>
                            <span class="badge badge-info badge-pill">Proses</span>
                        <?php elseif ($topup->status_bayar == "Decline") : ?>
                            <span class="badge badge-danger badge-pill">Batal</span>
                        <?php else : ?>
                            <span class="badge badge-success badge-pill">Selesai</span>
                        <?php endif; ?>

                    </td>
                    <td>

                        <a href="<?php echo base_url('admin/topup/detail/' . $topup->id); ?>" class="btn btn-info btn-sm">
                            <i class="fa fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
            <?php $no++;
            }; ?>
        </table>
    </div>
    <div class="card-footer bg-white border-top">
        <div class="pagination col-md-12 text-center">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>
    </div>
</div>