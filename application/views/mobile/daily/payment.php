<nav class="site-header bg-primary sticky-top py-1 shadow-sm ">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-white text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-center font-weight-bold text-white">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>

<!-- <embed type="text/html" src="https://checkout-staging.xendit.co/web/6270dc5fd4846eff064dc53f" width="100%" height="1080px" min-height="100%"> -->
<embed type="text/html" src="<?php echo $transaksi->payment_url; ?>" width="100%" min-height="1000px" height="1000px">