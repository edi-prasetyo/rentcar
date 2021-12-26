<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <?php echo $title; ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo form_open('admin/transaksi/cari'); ?>
                        <div class="input-group mb-3">
                            <input type="text" name="resi" class="form-control" placeholder="Masukan Nomor Resi">
                            <div class="input-group-append">
                                <button class="btn btn-outline-info" type="button" id="button-addon2">Cari</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo form_open('admin/transaksi/cari'); ?>
                        <div class="input-group mb-3" style="width: 100%;">
                            <select class="form-control select2bs4" name="search">
                                <option>-- Pilih Kota --</option>
                                <?php foreach ($main_agen as $main_agen) : ?>
                                    <option value='<?php echo $main_agen->kota_id; ?>'><?php echo $main_agen->kota_name; ?> - <?php echo $main_agen->name; ?> </option>
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
            <!-- /.card-header -->
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
                            <td><?php echo date('d/m/Y', strtotime($transaksi['date_created'])); ?><br> <?php echo date('H:i:s', strtotime($transaksi['date_created'])); ?></td>
                            <td><?php echo $transaksi['name']; ?> <br>
                                <?php echo $transaksi['kota_from']; ?><br>
                                <b>Code : <?php echo $transaksi['user_code']; ?></b>
                            </td>
                            <td><?php echo $transaksi['mainagen_name']; ?></td>
                            <td><?php echo $transaksi['nomor_resi']; ?></td>
                            <td>
                                <?php if ($transaksi['stage'] == 9) : ?>
                                    <span class="badge badge-success badge-pill">Selesai</span>
                                <?php else : ?>
                                    <span class="badge badge-danger badge-pill">Proses</span>
                                <?php endif; ?>

                            </td>
                            <td><?php echo $transaksi['kota_from']; ?></td>
                            <td><?php echo $transaksi['kota_name']; ?></td>
                            <td>Rp. <?php echo number_format($transaksi['total_harga'], 0, ",", "."); ?></td>
                            <!-- <td><img class="img-fluid" src="<?php echo base_url('assets/img/barcode/' . $transaksi['barcode']); ?>"></td> -->
                            <td>
                                <a href="<?php echo base_url('admin/transaksi/lacak/' . $transaksi['id']); ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-code-branch"></i> Lacak
                                </a>
                                <a href="<?php echo base_url('admin/transaksi/detail/' . $transaksi['id']); ?>" class="btn btn-success btn-sm">
                                    <i class="fa fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php $no++;
                    }; ?>
                </table>

                <?php if (count($transaksi) == 0) : ?>

                    <div class="card my-2">
                        <div class="card-body display-5 text-center">
                            <span class="my-3">Tidak Ada Iklan yang di tampilkan </span><br>
                            di Halaman <b><?php echo $title ?></b> Coba Ganti Pencarian Anda<br>
                            <div class="col-md-6 mx-auto my-3">
                                <!-- Search form (start) -->
                                <?php echo form_open('iklan/search'); ?>
                                <div class="input-group mb-3">
                                    <input type="text" name='search' class="form-control" placeholder="Cari Produk.." value='<?= $search ?>'>
                                    <div class="input-group-append">
                                        <input type='submit' name='submit' value='Cari' class="btn btn-info">
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>

                            <a href="<?php echo base_url(); ?>" class="btn btn-success text-white my-3">Kembali ke Home</a>

                        </div>

                    </div>

                <?php endif; ?>


            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-white border-top">
                <ul class="pagination m-0">
                    <div class="pagination col-md-12 text-center">
                        <?php if (isset($pagination)) {
                            echo $pagination;
                        } ?>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->