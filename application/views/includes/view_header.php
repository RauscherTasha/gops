<!--/**
 * Created by PhpStorm.
 * User: Natascha
 * Date: 10/12/2016
 * Time: 14:40
 */
-->
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>
        <?php if (isset($title)) {
            echo $title;
        } else {
            echo 'GOPS.net';
        } ?>
    </title>
    <link rel="stylesheet" href="<?php echo base_url("css/bootstrap.css"); ?>"/>
    <script src="<?php echo base_url("js/jquery-3.1.1.js"); ?>"></script>
    <script src="<?php echo base_url("js/bootstrap.js"); ?>"></script>
</head>
<body>
