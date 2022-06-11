<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
$meta           = $this->meta_model->get_meta();
?>

<nav class="site-header bg-primary sticky-top py-1 shadow-sm ">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-white text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-center font-weight-bold text-white">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>

<section class="invoice bg-primary pb-5 pt-2">
    <div class="container">
        <div class="col-md-8 mx-auto">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-white"> ID Order </h6>
                    <h1 class="text-white"><b><?php echo $transaksi->order_id; ?></b></h1>
                </div>
                <div class="col-6 text-right text-white">
                    <h6><b><?php echo $transaksi->passenger_name; ?></b></h6>
                    <h6><b><?php echo $transaksi->passenger_phone; ?></b></h6>
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

                        Mobil : <?php echo $transaksi->mobil_name; ?><br>
                        Paket : <?php echo $transaksi->origin; ?> <i class="fa fa-arrow-right"></i> <?php echo $transaksi->destination; ?><br>
                        Pembayaran : <?php echo $transaksi->pembayaran; ?> - <?php echo $transaksi->status_pembayaran; ?><br>
                        Status :
                        <?php if ($transaksi->status == "Pending") : ?>
                            <span class="badge badge-warning"><?php echo $transaksi->status; ?></span>
                        <?php elseif ($transaksi->status == "Dikonfirmasi") : ?>
                            <span class="badge badge-primary"><?php echo $transaksi->status; ?></span>
                        <?php elseif ($transaksi->status == "Dalam Pengantaran") : ?>
                            <span class="badge badge-info"><?php echo $transaksi->status; ?></span>
                        <?php elseif ($transaksi->status == "Selesai") : ?>
                            <span class="badge badge-success"><?php echo $transaksi->status; ?></span>
                        <?php endif; ?>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <div class="text-left"> Total Pembayaran</div>
                        <h1>
                            Rp. <b><?php echo number_format($transaksi->grand_total, 0, ",", "."); ?></b>
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
                    <h6><b><?php echo $transaksi->alamat_jemput; ?></b></h6>
                    Tanggal : <?php echo $transaksi->tanggal_jemput; ?> - Jam <?php echo $transaksi->jam_jemput; ?>

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
                    <span class="font-weight-bold">Rp. <?php echo number_format($transaksi->total_price, 0, ",", "."); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Diskon Point
                    <span class="font-weight-bold"><?php echo number_format($transaksi->diskon_point, 0, ",", "."); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Diskon Promo
                    <span class="font-weight-bold">- <?php echo number_format($transaksi->promo_amount, 0, ",", "."); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Grand Total
                    <span class="font-weight-bold">Rp. <?php echo number_format($transaksi->grand_total, 0, ",", "."); ?></span>
                </li>
            </ul>
        </div>

        <?php $date = date('Y-m-d H:i');
        if ($transaksi->expired_payment_date <= $date) : ?>
            <div class="alert alert-danger">Pembayaran Telah Expired</div>
        <?php else : ?>
            <div class="alert alert-danger">Bayar Sebelum <?php echo date("j F Y", strtotime($transaksi->expired_payment_date)); ?> Jam <?php echo date("H:i", strtotime($transaksi->expired_payment_date)); ?></div>
            <div style="z-index: 9999;" class="carbook-menu-fotter fixed-bottom bg-white px-3 py-2 text-center shadow">
                <a href="<?php echo base_url('airport/payment/' . $transaksi->id); ?>" class="btn-order-block"> <i class="fa-solid fa-arrow-right"></i> Bayar Sekarang</a>
            </div>
        <?php endif; ?>

    </div>


</div>