<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <div class="alert alert-block alert-success">
            
            <i class="icon-ok green"></i>

            Selamat datang di 
            <strong class="green">
                Aplikasi <?php echo $this->config->item('nama_aplikasi');?>
                <small>(v1.0.0)</small>
            </strong>
            ,
            <?php echo $this->config->item('nama_pendek');?> - <?php echo $this->config->item('nama_instansi');?>
        </div>
</div>                            
</div>
<div class="row-fluid">
	<div class="span12">
    
    </div>
    <div class="span12 infobox-container">
        <div class="infobox infobox-green  ">
            <div class="infobox-icon">
                <i class="icon-group"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php echo $this->model_data->jml_data('admins');?> Data</span>
                <div class="infobox-content">Pengguna</div>
            </div>
        </div>

        <div class="infobox infobox-blue  ">
            <div class="infobox-icon">
                <i class="icon-book"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php echo $this->model_data->jml_data('mata_kuliah');?> Data</span>
                <div class="infobox-content">Mata Kuliah</div>
            </div>

        </div>

        <div class="infobox infobox-pink  ">
            <div class="infobox-icon">
                <i class="icon-briefcase"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php echo $this->model_data->jml_data('dosen');?> Data</span>
                <div class="infobox-content">Dosen</div>
            </div>
        </div>

        <div class="infobox infobox-red  ">
            <div class="infobox-icon">
                <i class="icon-eye-open"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php echo $this->model_data->jml_data('mahasiswa');?> Data</span>
                <div class="infobox-content">Mahasiswa</div>
            </div>
        </div>

        <div class="infobox infobox-orange2  ">
            <div class="infobox-icon">
                <i class="icon-calendar"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php echo $this->model_data->jml_data('jadwal');?> Data</span>
                <div class="infobox-content">Jadwal</div>
            </div>
        </div>

        <div class="infobox infobox-blue2  ">
            <div class="infobox-icon">
                <i class="icon-envelope-alt "></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php echo $this->model_data->jml_data('krs');?> Data</span>
                <div class="infobox-content">Kartu Rencana Studi</div>
            </div>
        </div>
		
        <div class="infobox infobox-red  ">
            <div class="infobox-icon">
                <i class="icon-beaker"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php echo $this->model_data->jml_data('mutasi_mhs');?> Data</span>
                <div class="infobox-content">Mutasi Mahasiswa</div>
            </div>
        </div>

		<div class="infobox infobox-orange  ">
            <div class="infobox-icon">
                <i class="icon-coffee"></i> 
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php echo $this->model_data->jml_data('prodi');?> Data</span>
                <div class="infobox-content">Program Studi</div>
            </div>
        </div>
        
    </div>
</div>    
<br />
<?php echo $this->load->view('setting');?>