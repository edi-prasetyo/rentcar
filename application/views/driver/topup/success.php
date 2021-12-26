<?php
$meta = $this->meta_model->get_meta();
?>
<div class="col-md-7 mx-auto">
    <div class="card">
        <div class="card-body text-center">
            <span class="display-1 text-success"><i class="fa fa-check-circle"></i></span><br>
            <h3 class="display-3"> Berhasil</h3>
            <p>Terima kasih atas pembayaran anda, kami akan segera memproses top up anda 1x24 Jam, Untuk Informasi dan
                layanan Silahkan Hubungi Kami melalui Chat whatsapp <?php echo $meta->telepon; ?> </p>

            <div class="card shadow-none border">
                <div class="card-header">
                    <h3>Detail Top Up Anda </h3>
                </div>

                <div class="row">

                    <div class="col-sm-6">
                        <address>
                            <strong><?php echo $last_topup->name; ?> </strong> <br>

                            Phone : <?php echo $last_topup->user_phone; ?> <br>
                            Email : <?php echo $last_topup->email; ?>
                        </address>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <b>Kode Topup #<?php echo $last_topup->code_topup; ?></b><br>
                        <br>
                        <b>Status Pembayaran :</b> <span class="badge badge-danger badge-pill"> <?php echo $last_topup->status_bayar; ?></span>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- Table row -->

                <div class="col-xs-12 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode Top Up</th>
                                <th>Nominal</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong><?php echo $last_topup->code_topup; ?></strong></td>
                                <td> <strong> Rp. <?php echo number_format($last_topup->nominal, 0, ",", "."); ?></strong></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- /.col -->

                <div class="col-md-6">
                </div>



            </div>
        </div>
    </div>
</div>