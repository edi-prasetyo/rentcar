<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
?>
<div class="container my-3">
    <div class="container my-5">
        <?php if ($this->session->userdata('id')) : ?>
            <div class="col-md-9 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-left">
                                    ORDER BERHASIL
                                </div>
                                <div class="display-3 text-left">
                                    <i class="far fa-check-circle text-success"></i><br>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="text-right">ID ORDER</div>
                                <div class="display-4 text-right">
                                    <?php echo $transaksi->order_id; ?>
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Mobil</th>
                                        <th>Qty</th>
                                        <th>Durasi</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td><?php echo $transaksi->mobil_name; ?> <?php echo $transaksi->paket_name; ?></td>
                                    <td><?php echo $transaksi->jumlah_mobil; ?> Unit</td>
                                    <td><?php echo $transaksi->lama_sewa; ?> Hari</td>
                                    <td>Rp. <?php echo number_format($transaksi->start_price, 0, ",", "."); ?></td>
                                    <td>Rp. <?php echo number_format($transaksi->total_price, 0, ",", "."); ?></td>
                                </tr>
                            </table>
                        </div>

                        <?php echo $transaksi->passenger_name; ?><br>
                        <?php echo $transaksi->passenger_email; ?><br>
                        <?php echo $transaksi->passenger_phone; ?><br>
                    </div>
                </div>
            </div>
        <?php else : ?>
        <?php endif; ?>
    </div>
</div>