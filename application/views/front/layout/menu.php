<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
$meta           = $this->meta_model->get_meta();

?>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url() ?>"><img class="img-fluid" src="<?php echo base_url('assets/img/logo/' . $meta->logo) ?>"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active"><a class="nav-link" href="<?php echo base_url() ?>"> Home <span class="sr-only">(current)</span></a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('daily'); ?>"> Sewa Mobil Harian </a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('hourly'); ?>"> Sewa Per Jam </a></li>

            </ul>
            <ul class="navbar-nav">
                <?php if ($this->session->userdata('email')) { ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-user"></i> <?php echo $user->name; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">


                            <?php if ($user->role_id == 1) : ?>
                                <a class="dropdown-item" href="<?php echo base_url('admin/dashboard'); ?>">Panel Admin</a>
                            <?php elseif ($user->role_id == 4) : ?>
                                <a class="dropdown-item" href="<?php echo base_url('mainagen/dashboard'); ?>">Dashboard</a>
                            <?php elseif ($user->role_id == 5) : ?>
                                <a class="dropdown-item" href="<?php echo base_url('counter/dashboard'); ?>">Dashboard</a>
                            <?php elseif ($user->role_id == 6) : ?>
                                <a class="dropdown-item" href="<?php echo base_url('myaccount'); ?>">My Account</a>
                            <?php endif; ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
                        </div>
                    </li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#registerModal"><i class="ti ti-user"></i> Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal"><i class="ti ti-lock"></i> Login</a></li>
                <?php } ?>


            </ul>
        </div>
    </div>
</nav>



<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="text-center">
                <?php echo $this->session->flashdata('message');
                unset($_SESSION['message']);
                ?>
            </div>
            <?php
            echo form_open('auth')
            ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-md-3 text-right">Email</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control form-control-user" name="email" id="email" placeholder="Enter Email Address..." value="<?php echo set_value('email'); ?>" style="text-transform: lowercase">
                        <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 text-right">Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                        <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 text-right"></label>
                    <div class="col-md-9">
                        <div class="d-flex w-100 justify-content-between">
                            <button type="submit" class="btn btn-primary pl-5 pr-5">Login</button>
                            <a href="#" data-toggle="modal" data-target="#forgotModal">Lupa Password</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                Belum Punya Akun? <a href="#" data-toggle="modal" data-target="#registerModal"> Daftar Sekarang </a>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<!-- Modal Forgot -->
<div class="modal fade" id="forgotModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Forgot Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="text-center">
                <?php echo $this->session->flashdata('message');
                unset($_SESSION['message']);
                ?>
            </div>
            <?php
            echo form_open('auth/forgotpassword')
            ?>
            <div class="modal-body my-5 py-2">
                <div class="form-group row">
                    <label class="col-md-3 text-right">Email</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control form-control-user" name="email" id="email" placeholder="Enter Email Address..." value="<?php echo set_value('email'); ?>" style="text-transform: lowercase">
                        <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 text-right"></label>
                    <div class="col-md-9">
                        <div class="d-flex w-100 justify-content-between">
                            <button type="submit" class="btn btn-primary pl-5 pr-5">Kirim</button>

                        </div>
                    </div>
                </div>
            </div>

            <?php echo form_close() ?>
        </div>
    </div>
</div>

<!-- Modal Register -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Daftar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="text-center">
                <?php echo $this->session->flashdata('message');
                unset($_SESSION['message']);
                ?>
            </div>
            <?php
            echo form_open('auth/register')
            ?>
            <div class="modal-body">

                <div class="form-group row">
                    <label class="col-md-4 text-md-right">Title</label>
                    <div class="col-md-8">
                        <select class="form-control form-control-chosen" name="user_title" value="">
                            <option value='Bapak'>Bapak</option>
                            <option value='Ibu'>Ibu</option>
                            <option value='Saudara'>Saudara</option>
                            <option value='Saudari'>Saudari</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 text-md-right">Nama Lengkap</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="<?php echo set_value('name'); ?>">
                        <?php echo form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 text-md-right">No. Handphone</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="user_phone" placeholder="Nomor Handphone" value="<?php echo set_value('user_phone'); ?>">
                        <?php echo form_error('user_phone', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="email">

                <div class="form-group row">
                    <label class="col-md-4 text-md-right">Email</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="real_email" placeholder="Email Address" value="<?php echo set_value('real_email'); ?>" style="text-transform: lowercase">
                        <?php echo form_error('real_email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-md-right">Password</label>
                    <div class="col-md-8">
                        <input type="password" class="form-control" name="password1" placeholder="Password">
                        <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-md-right">Ulangi Password</label>
                    <div class="col-md-8">
                        <input type="password" class="form-control" name="password2" placeholder="Repeat Password">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-block">Daftar Sekarang</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>