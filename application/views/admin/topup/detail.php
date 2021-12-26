<?php $meta = $this->meta_model->get_meta(); ?>
<!-- Main content -->
<div class="card">
    <div class="card-header">
        <img src="<?php echo base_url('assets/img/logo/' . $meta->logo); ?>"><br>
        Kode Top Up : <strong><?php echo $topup->code_topup; ?></strong>
    </div>
    <div class="card-body">
        <!-- title row -->




        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-6 invoice-col">
                Info Agen <br>
                <b>Nama Counter Agen :</b> <?php echo $topup->name; ?><br>
                <b>ID Counter Agen :</b> <?php echo $topup->user_code; ?><br>
                <b>Telp Counter Agen :</b> <?php echo $topup->user_phone; ?><br>
            </div>
            <!-- /.col -->
            <div class="col-sm-6 invoice-col">
                Info Top Up <br>
                <b>Kode Top Up :</b> <?php echo $topup->code_topup; ?><br>
                <b>Status Pembayaran :</b>
                <?php if ($topup->status_bayar == "Pending") : ?>
                    <span class="badge badge-warning badge-pill">Pending</span>
                <?php elseif ($topup->status_bayar == "Process") : ?>
                    <span class="badge badge-info badge-pill">Proses</span>
                <?php elseif ($topup->status_bayar == "Decline") : ?>
                    <span class="badge badge-danger badge-pill">Batal</span>
                <?php else : ?>
                    <span class="badge badge-success badge-pill">Selesai</span>
                <?php endif; ?>
                <br>
                <b>Tanggal Top Up :</b> <?php echo tanggal_indonesia_lengkap(date('Y-m-d', strtotime($topup->date_created))); ?> <?php echo date('H:i:s', strtotime($topup->date_created)); ?><br>

            </div>
            <!-- /.col -->
        </div>
        <hr>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6">
                <span class="text-muted" style="font-size: 80px;font-weight:bold;"> <?php echo number_format($topup->nominal, 0, ",", "."); ?></span><br>
                <div class="row">
                    <?php if ($topup->status_bayar == 'Success' || $topup->status_bayar == 'Decline') : ?>

                    <?php else : ?>
                        <div class="col-6">
                            <a href="<?php echo base_url('admin/topup/aprove/' . $topup->id); ?>" class="btn btn-lg btn-block btn-success"><i class="fa fa-check"></i> Aprove</a>
                        </div>
                        <div class="col-6">
                            <a href="<?php echo base_url('admin/topup/decline/' . $topup->id); ?>" class="btn btn-lg btn-block btn-danger"><i class="fa fa-times"></i> Decline</a>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <img src="<?php echo base_url('assets/img/struk/' . $topup->foto_struk); ?>" class="img-fluid">
            </div>

        </div>




    </div>
</div>