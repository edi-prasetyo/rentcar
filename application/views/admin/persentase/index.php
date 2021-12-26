<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <?php echo $title; ?>

            </div>

            <div class="card-body">

                <a href="<?php echo base_url('admin/persentase/update/' . $persentase->id); ?>" class="btn btn-rounded btn-info btn-sm"><i class="fa fa-edit"></i> Ubah Data</a>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Driver</h3>
                    </div>
                    <div class="col-md-3">Pemotongan Saldo Driver</div>
                    <div class="col-md-9">: <?php echo $persentase->potong_saldo; ?> %</div>
                    <hr>


                </div>
            </div>
        </div>
    </div>


</div>