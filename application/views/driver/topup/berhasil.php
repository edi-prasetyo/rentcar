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
        </div>
    </div>
</div>