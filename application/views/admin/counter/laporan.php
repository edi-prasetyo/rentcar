<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title; ?> - <?php echo $counter->name; ?></h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Transaksi</th>
                            <th>Asuransi</th>
                            <th>Top Up</th>
                            <th>Potongan</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($saldo_counter as $saldo) : ?>
                            <tr>
                                <td> <?php echo date('d/m/Y', strtotime($saldo->date_created)); ?></td>
                                <td> <?php echo $saldo->keterangan; ?></td>
                                <td> Rp. <?php echo number_format($saldo->transaksi, 0, ",", "."); ?></td>
                                <td> Rp. <?php echo number_format($saldo->asuransi, 0, ",", "."); ?></td>
                                <td> <span class="text-success"> Rp. <?php echo number_format($saldo->pemasukan, 0, ",", "."); ?></span></td>
                                <td> <span class="text-danger"> Rp. <?php echo number_format($saldo->pengeluaran, 0, ",", "."); ?> + <?php echo number_format($saldo->asuransi, 0, ",", "."); ?></span></td>
                                <td> Rp. <?php echo number_format($saldo->total_saldo, 0, ",", "."); ?></td>


                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-white border-top">
                <ul class="pagination m-0">
                    <div class="pagination col-md-12 text-center">
                        <?php if (isset($pagination)) {
                            echo $pagination;
                        } ?>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->