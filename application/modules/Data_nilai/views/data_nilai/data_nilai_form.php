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
        <h2 style="margin-top:0px">Data_nilai <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Nim <?php echo form_error('nim') ?></label>
            <input type="text" class="form-control" name="nim" id="nim" placeholder="Nim" value="<?php echo $nim; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Mata Kuliah <?php echo form_error('id_mata_kuliah') ?></label>
            <input type="text" class="form-control" name="id_mata_kuliah" id="id_mata_kuliah" placeholder="Id Mata Kuliah" value="<?php echo $id_mata_kuliah; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Dosen <?php echo form_error('id_dosen') ?></label>
            <input type="text" class="form-control" name="id_dosen" id="id_dosen" placeholder="Id Dosen" value="<?php echo $id_dosen; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Nilai <?php echo form_error('nilai') ?></label>
            <input type="text" class="form-control" name="nilai" id="nilai" placeholder="Nilai" value="<?php echo $nilai; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('data_nilai') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>