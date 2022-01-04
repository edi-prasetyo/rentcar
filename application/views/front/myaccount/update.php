<div class="container my-3">
    <div class="col-md-7 mx-auto">
        <div class="card">
            <div class="card-header">
                Edit Profile
            </div>
            <div class="card-body">
                <?php echo form_open('myaccount/update_profile'); ?>
                <div class="form-group row">
                    <label class="col-md-4 text-md-right">Nama</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="name" value="<?php echo $user->name; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 text-md-right">Email</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="email" value="<?php echo $user->email; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 text-md-right">Phone</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="user_phone" value="<?php echo $user->user_phone; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 text-md-right">Alamat</label>
                    <div class="col-md-8">
                        <textarea class="form-control" name="user_address"><?php echo $user->user_address; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 text-md-right"></label>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>