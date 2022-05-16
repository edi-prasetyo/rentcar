<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
$meta           = $this->meta_model->get_meta();
?>

<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>

<?php if ($this->session->userdata('id')) : ?>
    <section class="invoice bg-primary pb-5 pt-2">
        <div class="container">
            <div class="col-md-8 mx-auto">
                <div class="row">
                    <div class="col-6">
                        <h6 class="text-white"> ID Order </h6>
                        <h1 class="text-white"><b><?php echo $detail_transaksi->order_id; ?></b></h1>
                    </div>
                    <div class="col-6 text-right text-white">
                        <h6><b><?php echo $detail_transaksi->passenger_name; ?></b></h6>
                        <h6><b><?php echo $detail_transaksi->passenger_phone; ?></b></h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container my-5">
        <div class="col-md-9 mx-auto">
            <div class="card mb-3 shadow border-0" style="margin-top:-90px;">
                <div class="card-header bg-white">
                    Review Pesanan
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">

                            Mobil : <?php echo $detail_transaksi->mobil_name; ?><br>
                            Paket : <?php echo $detail_transaksi->paket_name; ?><br>
                            Status Penggunaan :
                            <?php if ($detail_transaksi->status == "Pending") : ?>
                                <span class="badge badge-warning"><?php echo $detail_transaksi->status; ?></span>
                            <?php elseif ($detail_transaksi->status == "Dikonfirmasi") : ?>
                                <span class="badge badge-primary"><?php echo $detail_transaksi->status; ?></span>
                            <?php elseif ($detail_transaksi->status == "Dalam Pengantaran") : ?>
                                <span class="badge badge-info"><?php echo $detail_transaksi->status; ?></span>
                            <?php elseif ($detail_transaksi->status == "Selesai") : ?>
                                <span class="badge badge-success"><?php echo $detail_transaksi->status; ?></span>
                            <?php endif; ?>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <div class="text-left"> Total Pembayaran</div>
                            <h1>
                                Rp. <b><?php echo number_format($detail_transaksi->grand_total, 0, ",", "."); ?></b>
                            </h1>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card shadow border-0 mb-3">
                <div class="card-header bg-white">
                    Detail penjemputan
                </div>
                <div class="card-body">
                    <div class="col-md-6">
                        <h6><b><?php echo $detail_transaksi->alamat_jemput; ?></b></h6>
                        Tanggal : <?php echo $detail_transaksi->tanggal_jemput; ?> - Jam <?php echo $detail_transaksi->jam_jemput; ?>

                    </div>
                </div>
            </div>
            <div class="card shadow border-0">
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-white">
                        Rincian Pesanan

                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total Harga
                        <span class="font-weight-bold">Rp. <?php echo number_format($detail_transaksi->total_price, 0, ",", "."); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Diskon Point
                        <span class="font-weight-bold"><?php echo number_format($detail_transaksi->diskon_point, 0, ",", "."); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Grand Total
                        <span class="font-weight-bold">Rp. <?php echo number_format($detail_transaksi->grand_total, 0, ",", "."); ?></span>
                    </li>
                </ul>
            </div>
            <?php if ($detail_transaksi->pembayaran == "Cash") : ?>
                <div class="my-3 pb-3">

                    <button type="button" class="btn btn-danger btn-block btn-lg" data-toggle="modal" data-target="#Cancel">
                        Batalkan Pesanan
                    </button>

                </div>
            <?php else : ?>
                <div style="z-index: 9999;" class="carbook-menu-fotter fixed-bottom bg-white px-3 py-2 text-center shadow">
                    <a href="<?php echo base_url('daily/payment/' . $detail_transaksi->id); ?>" class="btn-order-block"> <i class="fa-solid fa-arrow-right"></i> Bayar Sekarang</a>
                </div> <?php endif; ?>

        </div>


    </div>


<?php else : ?>
    <div class="d-flex justify-content-center align-items-center my-5">
        <h1 class="mr-3 pr-3 align-top border-right inline-block align-content-center">401</h1>
        <div class="inline-block align-middle">
            <h2 class="font-weight-normal lead" id="desc">Unauthorized.</h2>
        </div>
    </div>
<?php endif; ?>





<div class="modal modal-danger fade" id="Cancel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Pembatalan Order</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Silahkan Hubungi Customer Service untuk pengajuan pembatalan Order</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->