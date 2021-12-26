<div class="card">
    <div class="card-header">

        <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/transaksi'); ?>">Belum di Ambil</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/transaksi/proses'); ?>">Proses Kirim</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/transaksi/selesai'); ?>">Selesai</a></li>
            <li class="nav-item"><a class="nav-link active" href="<?php echo base_url('admin/transaksi/batal'); ?>">Batal</a></li>
        </ul>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <?php echo form_open('admin/transaksi/batal'); ?>
                <div class="input-group mb-3">
                    <input type="text" name="resi" class="form-control" placeholder="Masukan Nomor Resi" value="<?php echo set_value('resi'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-info" type="submit" id="button-addon2">Cari</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="col-md-4">
                <?php echo form_open('admin/transaksi/batal'); ?>
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
            </div>
            <div class="col-md-4">
                <?php echo form_open('admin/transaksi/batal'); ?>
                <div class="input-group mb-3" style="width: 100%;">
                    <select class="form-control select2bs4" name="kota_tujuan">
                        <option>Pilih Kota Tujuan</option>
                        <?php foreach ($list_kota_tujuan as $kota) : ?>
                            <option value='<?php echo $kota->kota_name; ?>'><?php echo $kota->kota_name; ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-group-append">
                        <input type='submit' name='submit' value='Cari' class="btn btn-info">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table">
            <thead class="thead-white">
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Counter</th>
                    <th>Main Agen</th>
                    <th>Resi</th>
                    <th>Status</th>
                    <th>Kota Asal</th>
                    <th>Kota Tujuan</th>
                    <th>Harga</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($transaksi as $transaksi) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($transaksi->date_created)); ?><br> <?php echo date('H:i:s', strtotime($transaksi->date_created)); ?></td>
                    <td><?php echo $transaksi->name; ?> <br>
                        <?php echo $transaksi->kota_from; ?><br>
                        <b>Code : <?php echo $transaksi->user_code; ?></b>
                    </td>
                    <td><?php echo $transaksi->mainagen_name; ?></td>
                    <td><?php echo $transaksi->nomor_resi; ?></td>
                    <td>
                        <?php if ($transaksi->stage == 9) : ?>
                            <span class="badge badge-success badge-pill">Selesai</span>
                        <?php elseif ($transaksi->stage == 10) : ?>
                            <span class="badge badge-danger badge-pill">Dibatalkan</span>
                        <?php else : ?>
                            <span class="badge badge-warning badge-pill">Proses</span>
                        <?php endif; ?>

                    </td>
                    <td><?php echo $transaksi->kota_from; ?></td>
                    <td><?php echo $transaksi->kota_name; ?></td>
                    <td>Rp. <?php echo number_format($transaksi->total_harga, 0, ",", "."); ?></td>
                    <!-- <td><img class="img-fluid" src="<?php echo base_url('assets/img/barcode/' . $transaksi->barcode); ?>"></td> -->
                    <td>
                        <a href="<?php echo base_url('admin/transaksi/lacak/' . $transaksi->id); ?>" class="btn btn-info btn-sm">
                            <i class="fas fa-code-branch"></i> Lacak
                        </a>
                        <a href="<?php echo base_url('admin/transaksi/detail/' . $transaksi->id); ?>" class="btn btn-success btn-sm">
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