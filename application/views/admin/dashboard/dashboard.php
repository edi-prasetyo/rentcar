<div class="row">


  <div class="col-lg-6">
    <div class="small-box bg-purple">
      <div class="inner">
        <h3>Rp. <?php echo number_format($total_topup, "0", ",", "."); ?></h3>

        <p>Pendapatan Top Up</p>
      </div>
      <div class="icon">
        <i class="fa fa-wallet"></i>
      </div>
    </div>
  </div>


  <div class="col-lg-6">
    <div class="small-box bg-olive">
      <div class="inner">
        <h3>Rp. <?php echo number_format($total_omset_transaksi, "0", ",", "."); ?></h3>

        <p>Omset Transaksi</p>
      </div>
      <div class="icon">
        <i class="fa fa-credit-card"></i>
      </div>
    </div>
  </div>



  <!-- <div class="small-box bg-info">
      <div class="inner">
        <h3><?php echo count($count_transaksi); ?></h3>

        <p>Transaksi</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="<?php echo base_url('admin/transaksi'); ?>" class="small-box-footer">Lihat Semua <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div> -->


  <!-- ./col -->
</div>


<div class="card">
  <div class="card-header border-0">
    <div class="d-flex justify-content-between">
      <h3 class="card-title">Jumlah Order 7 Hari Terakhir</h3>
      <a href="<?php echo base_url('admin/transaksi'); ?>">Lihat Transaksi</a>
    </div>
  </div>
  <div class="card-body">
    <div class="d-flex">
      <p class="d-flex flex-column">
        <span class="text-bold text-lg"><?php echo count($count_alltransaksi); ?></span>
        <span>Order</span>
      </p>

    </div>


    <div class="position-relative mb-4">
      <canvas id="sales-chart" height="200"></canvas>
    </div>

    <div class="d-flex flex-row justify-content-end">
      <span class="mr-2">
        <i class="fas fa-square text-primary"></i> Data Per Hari
      </span>

    </div>
  </div>
</div>