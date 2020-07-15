<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <link rel="icon" href="<?php echo SITE_URL; ?>/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo SITE_URL; ?>/favicon.png" type="image/x-icon">

    <link href="css/styles.css" rel="stylesheet" />
    <link href="<?php echo SITE_ADMIN_URL; ?>/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="<?php echo SITE_ADMIN_URL; ?>/css/dropzone.min.css" rel="stylesheet"/>
    <script src="<?php echo SITE_ADMIN_URL; ?>/js/font-awesome.js" crossorigin="anonymous"></script>

</head>

<body class="sb-nav-fixed">

<?php include "top-nav.php"; ?>

    <div id="layoutSidenav">

        <?php include "side-nav.php"; ?>

        <div id="layoutSidenav_content">