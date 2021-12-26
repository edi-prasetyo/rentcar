<div class="row">
    <div class="col-md-6 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-shopping-bag"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Transaksi</span>
                <span class="info-box-number"><?php echo $total_rows; ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-md-6 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fa fa-credit-card"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Omset</span>
                <span class="info-box-number">Rp. <?php echo number_format($total_omset, 0, ",", ".") ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

</div>
<div class="card">
    <div class="card-header">
        <?php echo $title; ?> - <?php echo $counter->name; ?>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <?php echo form_open('admin/counter/transaksi/' . $counter->id); ?>
                <div class="input-group mb-3">
                    <input type="text" name="resi" class="form-control" placeholder="Masukan Nomor Resi" value="<?php echo set_value('resi'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-info" type="submit" id="button-addon2">Cari</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <div class="col-md-4">
                <?php echo form_open('admin/counter/transaksi/' . $counter->id); ?>
                <div class="input-group mb-3" style="width: 100%;">
                    <select class="form-control select2bs4" name="kota_tujuan">
                        <option>Pilih Kota Tujuan</option>
                        <?php foreach ($list_kota as $kota_tujuan) : ?>
                            <option value='<?php echo $kota_tujuan->kota_name; ?>'><?php echo $kota_tujuan->kota_name; ?> </option>
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

                    <th>Resi</th>
                    <th>Status</th>
                    <th>Kota Asal</th>
                    <th>Kota Tujuan</th>
                    <th>Harga</th>
                    <!-- <th width="15%">Action</th> -->
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($transaksi_counter as $data) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($data->date_created)); ?><br> <?php echo date('H:i:s', strtotime($data->date_created)); ?></td>
                    <td><?php echo $data->nomor_resi; ?></td>
                    <td>
                        <?php if ($data->stage == 9) : ?>
                            <span class="badge badge-success badge-pill">Selesai</span>
                        <?php elseif ($data->stage == 10) : ?>
                            <span class="badge badge-danger badge-pill">Dibatalkan Counter</span>
                        <?php else : ?>
                            <span class="badge badge-warning badge-pill">Belum di Ambil</span>
                        <?php endif; ?>

                    </td>
                    <td><?php echo $data->kota_from; ?></td>
                    <td><?php echo $data->kota_to; ?></td>
                    <td>Rp. <?php echo number_format($data->total_harga, 0, ",", "."); ?></td>
                    <!-- <td><img class="img-fluid" src="<?php echo base_url('assets/img/barcode/' . $data->barcode); ?>"></td> -->
                    <!-- <td>
                        <a href="<?php echo base_url('admin/transaksi/lacak/' . $data->id); ?>" class="btn btn-info btn-sm">
                            <i class="fas fa-code-branch"></i> Lacak
                        </a>
                        <a href="<?php echo base_url('admin/transaksi/detail/' . $data->id); ?>" class="btn btn-success btn-sm">
                            <i class="fa fa-eye"></i> Detail
                        </a>
                    </td> -->
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