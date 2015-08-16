<?php
if($class=='home'){
	$home = 'class="active"';
	$master ='';
	$transaksi = '';
	$laporan = '';
	$grafik = '';
}elseif($class=='master'){
	$home = '';
	$master ='class="active"';
	$transaksi = '';
	$laporan = '';
	$grafik = '';
}elseif($class=='transaksi'){
	$home = '';
	$master ='';
	$transaksi = 'class="active"';
	$laporan = '';
	$grafik = '';
}elseif($class=='laporan'){
	$home = '';
	$master ='';
	$transaksi = '';
	$laporan = 'class="active"';
	$grafik = '';					
}else{
	$home = '';
	$master ='';
	$transaksi = '';
	$laporan = '';
	$grafik = 'class="active"';
}
?>
<div class="main-container container-fluid">
<a class="menu-toggler" id="menu-toggler" href="#">
    <span class="menu-text"></span>
</a>
<div class="sidebar" id="sidebar">
    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <i class="icon-calendar"></i> 
			<?php 
			date_default_timezone_set('Asia/Jakarta');
			echo $this->model_global->hari_ini(date('w')).", ".$this->model_global->tgl_indo(date('Y-m-d'));
			?>
        </div>
        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>
            <span class="btn btn-info"></span>
            <span class="btn btn-warning"></span>
            <span class="btn btn-danger"></span>
        </div>
    </div><!--#sidebar-shortcuts-->
	
    <div align="center">
    <img src="<?php echo base_url();?>assets/img/logo-black.png" width="80">
    <h6><?php echo $this->config->item('nama_pendek');?></h6>
    </div>
    
    <ul class="nav nav-list">
        <li <?php echo $home;?> >
            <a href="<?php echo base_url();?>index.php/home">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>

        <li <?php echo $master;?> >
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Master </span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo base_url();?>index.php/home">
                        <i class="icon-double-angle-right"></i>
                        Pengguna &amp; Hak Akses
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/c_master_target">
                        <i class="icon-double-angle-right"></i>
                        Target (AR) / Budget (OT)
                    </a>
                </li>
				<li>
                    <a href="<?php echo base_url();?>index.php/c_master_emp">
                        <i class="icon-double-angle-right"></i>
                        Karyawan
                    </a>
                </li>
				<li>
                    <a href="<?php echo base_url();?>index.php/home">
                        <i class="icon-double-angle-right"></i>
                        Pengiriman
                    </a>
                </li>
                
            </ul>
        </li>


        <li <?php echo $transaksi;?>>
			<a href="#" class="dropdown-toggle">
                <i class="icon-edit"></i>
                <span class="menu-text"> Transaksi </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">
            	<li>
                    <a href="<?php echo base_url();?>index.php/c_dko">
                        <i class="icon-double-angle-right"></i>
                        Dekorasi
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/c_fgar">
                        <i class="icon-double-angle-right"></i>
                        FG Pengiriman
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/c_glz">
                        <i class="icon-double-angle-right"></i>
                        Glasir
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/c_jigcas">
                        <i class="icon-double-angle-right"></i>
                        Jiggering & Casting
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/c_pck">
                        <i class="icon-double-angle-right"></i>
                        Packing
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/c_ovt">
                        <i class="icon-double-angle-right"></i>
                        Over Time
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/c_wip">
                        <i class="icon-double-angle-right"></i>
                        WIP Keramik
                    </a>
                </li>
            </ul>
        </li>

        <li <?php echo $laporan;?>>
            <a href="#" class="dropdown-toggle">
                <i class="icon-print"></i>
                <span class="menu-text">Laporan</span>
                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">
            	 <li>
                    <a href="<?php echo base_url();?>index.php/c_lap_dko">
                        <i class="icon-double-angle-right"></i>
                        Dekorasi
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/c_lap_fgar">
                        <i class="icon-double-angle-right"></i>
                        FG Pengiriman
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/c_lap_glz">
                        <i class="icon-double-angle-right"></i>
                        Glasir
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/c_lap_jc">
                        <i class="icon-double-angle-right"></i>
                        Jiggering & Casting
                    </a>
                </li>
                 <li>
                    <a href="<?php echo base_url();?>index.php/c_lap_pck">
                        <i class="icon-double-angle-right"></i>
                        Packing
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/c_lap_ovt">
                        <i class="icon-double-angle-right"></i>
                        Over Time
                    </a>
                </li>
                 <li>
                    <a href="<?php echo base_url();?>index.php/c_lap_wip">
                        <i class="icon-double-angle-right"></i>
                        WIP Keramik
                    </a>
                </li>
            </ul>
        </li>

        <li <?php echo $grafik;?>>
            <a href="#" class="dropdown-toggle">
                <i class="icon-bar-chart"></i>
                <span class="menu-text">
                    Grafik
                </span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
               	 <li>
                    <a href="<?php echo base_url();?>index.php/c_grafik_dko/chart_all">
                        <i class="icon-double-angle-right"></i>
                        Dekorasi
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/c_grafik_ar/fg_chart_all">
                        <i class="icon-double-angle-right"></i>
                        FG Pengiriman
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/c_grafik_glz/fg_chart_all">
                        <i class="icon-double-angle-right"></i>
                        Glasir
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/c_grafik_jc/fg_chart_all">
                        <i class="icon-double-angle-right"></i>
                        Jiggering & Casting
                    </a>
                </li>
                 <li>
                    <a href="<?php echo base_url();?>index.php/c_grafik_pck/chart_all">
                        <i class="icon-double-angle-right"></i>
                        Packing
                    </a>
                </li> 
                <li>
                    <a href="<?php echo base_url();?>index.php/c_grafik_ovt/chart_all">
                        <i class="icon-double-angle-right"></i>
                        Over Time
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/c_grafik_wip/fg_chart_all">
                        <i class="icon-double-angle-right"></i>
                        WIP Keramik
                    </a>
                </li>
            </ul>
        </li>
         <li>
            <a href="<?php echo base_url();?>index.php/login/logout">
                <i class="icon-off"></i>
                <span class="menu-text"> Keluar </span>
            </a>
        </li>
    </ul><!--/.nav-list-->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left"></i>
    </div>
</div>