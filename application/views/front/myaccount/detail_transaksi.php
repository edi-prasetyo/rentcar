<div class="container my-5">
    <div class="col-md-7 mx-auto">
        <div class="card mb-3">
            <div class="card-header">Detail Order</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        Order ID<br>
                        <b><?php echo $detail_transaksi->order_id; ?></b><br>
                        Customer<br>
                        <b><?php echo $detail_transaksi->passenger_name; ?></b>
                    </div>
                    <div class="col-md-6 text-right">

                        <i class="fa fa-calendar"></i> Tanggal Jemput<br>
                        <b><?php echo $detail_transaksi->tanggal_jemput; ?></b>

                        <div class="text-end">
                            Pembayaran<br>
                            <b><?php echo $detail_transaksi->pembayaran; ?></b>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Total Pembayaran</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        Harga<br>
                    </div>
                    <div class="col-md-6 text-right">
                        <b><?php echo number_format($detail_transaksi->total_price, 0, ",", "."); ?></b>
                    </div>
                    <div class="col-md-6">
                        Discount<br>
                    </div>
                    <div class="col-md-6 text-right">
                        <b>- <?php echo $detail_transaksi->diskon_point; ?></b>
                    </div>
                    <div class="col-md-6">
                        Grand Total<br>
                    </div>
                    <div class="col-md-6 text-right">
                        <b>Rp. <?php echo number_format($detail_transaksi->grand_total, 0, ",", "."); ?></b>
                    </div>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-header">Info Pengemudi</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        Nama<br>
                    </div>
                    <div class="col-md-6 text-right">
                        <b><?php echo $detail_transaksi->driver_name; ?></b>
                    </div>
                    <div class="col-md-6">
                        No. Handphone<br>
                    </div>
                    <div class="col-md-6 text-right">
                        <b>081233134</b>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
</div>