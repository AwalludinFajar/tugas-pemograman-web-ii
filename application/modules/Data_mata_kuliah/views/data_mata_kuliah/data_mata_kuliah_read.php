<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Data_mata_kuliah Read</h2>
        <table class="table">
	    <tr><td>Nama Mata Kuliah</td><td><?php echo $nama_mata_kuliah; ?></td></tr>
	    <tr><td>Sks</td><td><?php echo $sks; ?></td></tr>
	    <tr><td>Semester</td><td><?php echo $semester; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('data_mata_kuliah') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>