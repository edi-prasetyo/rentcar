<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> <?php echo $email_register->name; ?></h4>

                <div class="card-tools">
                    <a href="<?php echo base_url('admin/pengaturan/update/' . $email_register->id); ?>" class="btn btn-info btn-sm">Update Email Register</a>
                </div>
            </div>
           




                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Name
                                </td>
                                <td> : <?php echo $email_register->name; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Email Ke Admin
                                </td>
                                <td> : <?php echo $email_register->cc_email; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Protocol
                                </td>
                                <td> : <?php echo $email_register->protocol; ?></td>

                            </tr>
                            <tr>
                                <td>
                                    SMTP Host
                                </td>
                                <td> : <?php echo $email_register->smtp_host; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    SMTP Port
                                </td>
                                <td>: <?php echo $email_register->smtp_port; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    SMTP User
                                </td>
                                <td>: <?php echo $email_register->smtp_user; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    SMTP Password
                                </td>
                                <td>: <?php echo $email_register->smtp_pass; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>






        </div>
    </div>
    <div class="col-md-6">
        <div class="card">

            <div class="card-header">
                <h4 class="card-title"> <?php echo $email_order->name; ?></h4>
                <div class="card-tools">
                    <a href="<?php echo base_url('admin/pengaturan/update/' . $email_order->id); ?>" class="btn btn-info btn-sm">Update Email Order</a>
                </div>
            </div>
           



                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Name
                                </td>
                                <td> : <?php echo $email_order->name; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Email Ke Admin
                                </td>
                                <td> : <?php echo $email_order->cc_email; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Protocol
                                </td>
                                <td> : <?php echo $email_order->protocol; ?></td>

                            </tr>
                            <tr>
                                <td>
                                    SMTP Host
                                </td>
                                <td> : <?php echo $email_order->smtp_host; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    SMTP Port
                                </td>
                                <td>: <?php echo $email_order->smtp_port; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    SMTP User
                                </td>
                                <td>: <?php echo $email_order->smtp_user; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    SMTP Password
                                </td>
                                <td>: <?php echo $email_order->smtp_pass; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>




          

        </div>
    </div>
</div>