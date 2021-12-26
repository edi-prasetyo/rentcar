<?php
$meta = $this->meta_model->get_meta();

// error_reporting(0);
// ini_set('display_errors', 0);
// var_dump($meta);
// die;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $meta->title ?> | <?php echo $meta->tagline ?></title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo/' . $meta->favicon) ?>">
    <meta name="description" content="<?php echo $meta->description ?>">
    <meta name="keywords" content="<?php echo $meta->title . ',' . $meta->keywords ?>">
    <meta name="author" content="<?php echo $meta->title ?>">
    <meta name="google-site-verification" content="<?php echo $meta->google_meta ?>" />
    <meta name="msvalidate.01" content="<?php echo $meta->bing_meta ?>" />

    <meta property="og:title" content="<?php echo $meta->title ?>">
    <meta property="og:description" content="<?php echo $meta->description ?>">
    <meta property="og:image" content="<?php echo base_url('assets/img/logo/' . $meta->favicon) ?>">
    <meta property="og:url" content="<?php echo base_url(); ?>">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/template/front/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/template/front/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/front/icon/fontawesome5/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/front/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/template/front/css/component-chosen.css">
    <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/template/front/css/bootstrap-datetimepicker.css" />
    <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/template/front/css/timepicker.css" />
    <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/template/front/css/dataTables.bootstrap4.min.css" />

</head>

<body class="d-flex flex-column min-vh-100">