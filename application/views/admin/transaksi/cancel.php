<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete<?php
                                                                                            echo $transaksi->id ?>">
    <i class="fa fa-times"></i> Cancel
</button>

<div class="modal modal-danger fade" id="Delete<?php echo $transaksi->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Batalkan Transaksi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p class="text-wrap"> Apakah Anda Yakin Ingin Membatalkan Kiriman Nomor Resi : <b><?php echo $transaksi->nomor_resi ?></b></p>
            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url('admin/transaksi/cancel/' . $transaksi->id) ?>" class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Ya, Batalkan</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->