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
        <h2 style="margin-top:0px">Data_mata_kuliah <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Mata Kuliah <?php echo form_error('nama_mata_kuliah') ?></label>
            <input type="text" class="form-control" name="nama_mata_kuliah" id="nama_mata_kuliah" placeholder="Nama Mata Kuliah" value="<?php echo $nama_mata_kuliah; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Sks <?php echo form_error('sks') ?></label>
            <input type="text" class="form-control" name="sks" id="sks" placeholder="Sks" value="<?php echo $sks; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Semester <?php echo form_error('semester') ?></label>
            <input type="text" class="form-control" name="semester" id="semester" placeholder="Semester" value="<?php echo $semester; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('data_mata_kuliah') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>