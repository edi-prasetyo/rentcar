<?php echo form_open('admin/meta/update/' . $meta->id); ?>
<div class="row">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <?php echo $title; ?>
            </div>
            <div class="card-body">


                <div class="text-center">
                    <?php echo $this->session->flashdata('message'); ?>
                </div>


                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Judul Web <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="title" value="<?php echo $meta->title; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Tagline Web <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="tagline" value="<?php echo $meta->tagline; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Deskripsi Web <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="description" value="<?php echo $meta->description; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Link <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="link" value="<?php echo $meta->link; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Facebook <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="facebook" value="<?php echo $meta->facebook; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Instagram <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="instagram" value="<?php echo $meta->instagram; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Youtube <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="youtube" value="<?php echo $meta->youtube; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Twitter <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="twitter" value="<?php echo $meta->twitter; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Email <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="email" value="<?php echo $meta->email; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Telepon <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="telepon" value="<?php echo $meta->telepon; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Whatsapp <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="whatsapp" value="<?php echo $meta->whatsapp; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Alamat <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <textarea class="form-control" name="alamat"><?php echo $meta->alamat; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Keywords Web <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <textarea class="form-control" name="keywords"><?php echo $meta->keywords; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Google Meta <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <textarea class="form-control" name="google_meta"><?php echo $meta->google_meta; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Google Analytics <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <textarea class="form-control" name="google_analytics"><?php echo $meta->google_analytics; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Google Tag <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <textarea class="form-control" name="google_tag"><?php echo $meta->google_tag; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Bing Meta <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <textarea class="form-control" name="bing_meta"><?php echo $meta->bing_meta; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Google Maps <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-9">
                        <textarea class="form-control" name="map"><?php echo $meta->map; ?></textarea>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-9">
                        <button type="submit" class="btn btn-info btn-lg btn-block">
                            Update Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Api Key Whatsapp Gateway</h3>
            </div>


            <form class="form-horizontal">
                <div class="card-body">

                    <div class="form-group">
                        <label class="col-form-label">Api Whatsapp</label>
                        <input type="text" name="whatsapp_api" class="form-control" value="<?php echo $meta->whatsapp_api; ?>">
                    </div>
                    <button type="submit" class="btn btn-info">Simpan</button>

                </div>
            </form>
        </div>
    </div>
</div>
<?php echo form_close(); ?>