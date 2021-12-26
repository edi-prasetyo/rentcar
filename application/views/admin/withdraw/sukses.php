<div class="card">
    <div class="card-header">

        <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/withdraw'); ?>">Pending</a></li>
            <li class="nav-item"><a class="nav-link active" href="<?php echo base_url('admin/withdraw/sukses'); ?>">Selesai</a></li>
        </ul>

    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <?php echo form_open('admin/withdraw/sukses'); ?>
                <div class="input-group mb-3">
                    <input type="text" name="code_withdraw" class="form-control" placeholder="Masukan Kode Kode Withdraw" value="<?php echo set_value('code_withdraw'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit" id="button-addon2">Cari</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="col-md-4">
                <?php echo form_open('admin/withdraw/sukses'); ?>
                <div class="form-group">
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <div class=" input-group-append">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        <input type="date" name="date_created" class="form-control" />
                        <div class="input-group-append">
                            <button class="btn btn-info" type="submit" id="button-addon2">Cari</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="col-md-4">
                <?php echo form_open('admin/withdraw/sukses'); ?>
                <div class="input-group mb-3">
                    <select class="form-control select2bs4" name="nama_mainagen">
                        <option>Cari Mainagen</option>
                        <?php foreach ($list_mainagen as $list_mainagen) : ?>
                            <option value='<?php echo $list_mainagen->name; ?>'><?php echo $list_mainagen->name; ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit" id="button-addon2">Cari</button>
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
                    <th>Kode Withdraw</th>
                    <th>Nama</th>
                    <th>Region</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($withdraw as $withdraw) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($withdraw->date_created)); ?><br> <?php echo date('H:i:s', strtotime($withdraw->date_created)); ?></td>
                    <td><b><?php echo $withdraw->code_withdraw; ?></b></td>
                    <td><?php echo $withdraw->name; ?></td>
                    <td><?php echo $withdraw->kota_name; ?></td>
                    <td>Rp. <?php echo number_format($withdraw->nominal_withdraw, 0, ",", "."); ?></td>
                    <td>
                        <?php if ($withdraw->status_withdraw == "Pending") : ?>
                            <span class="badge badge-warning badge-pill">Pending</span>
                        <?php elseif ($withdraw->status_withdraw == "Process") : ?>
                            <span class="badge badge-info badge-pill">Proses</span>
                        <?php elseif ($withdraw->status_withdraw == "Cancel") : ?>
                            <span class="badge badge-danger badge-pill">Batal</span>
                        <?php else : ?>
                            <span class="badge badge-success badge-pill">Selesai</span>
                        <?php endif; ?>

                    </td>
                    <td>

                        <a href="<?php echo base_url('admin/withdraw/detail/' . $withdraw->id); ?>" class="btn btn-info btn-sm">
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