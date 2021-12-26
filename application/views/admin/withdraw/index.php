<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item"><a class="nav-link active" href="<?php echo base_url('admin/withdraw'); ?>">Pending</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/withdraw/sukses'); ?>">Selesai</a></li>
        </ul>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table">
            <thead class="thead-white">
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Kode Top Up</th>
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