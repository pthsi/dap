<script type="text/javascript" src="<?php echo base_url('/assets/jshi/highcharts.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/jshi/modules/exporting.js'); ?>"></script>
	
<script type="text/javascript">

$(document).ready(function(){$('.date-picker').datepicker().next().on(ace.click_event, function(){$(this).prev().focus();});
	
});
</script>
<script type="text/javascript">
$(function () {
    $('#container1').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '<?php echo $judul;?>'
        },
        subtitle: {
            text: '<?php echo $data_status;?>'
        },
        xAxis: {
            categories: [
							<?php 
								foreach ($chart_all as $key => $x_axis ) : 
									echo "'".$x_axis->kategori."',";
								endforeach; 
                			?>
			],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total (Pcs)'
            }
        },
        tooltip: {
					formatter: function() {
						var s = '<b>'+ this.x +'</b>',
							sum = 0;
				
						$.each(this.points, function(i, point) {
							s += '<br/>'+ point.series.name +': '+
								point.y +'(pcs)';
							sum += point.y;
						});
				
						s += '<br/>Sub Total: '+sum+' (pcs)'
				
						return s;
					},
					shared: true
				},
		legend: {
					enabled: true,
					layout: 'horizontal',
					align: 'center',
					verticalAlign: 'bottom',
					borderWidth: 0				
				},
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Body Polos',
            data: [
					<?php 
						foreach ($chart_all as $key => $series ) : 
							echo number_format( $series->bodypolos , 3, '.', '') .",";
						endforeach; 
					?>
			],
			color: '#00FF00'

        }, {
            name: 'Colorwave',
            data: [
					<?php 
						foreach ($chart_all as $key => $series ) : 
							echo number_format( $series->colorwave , 3, '.', '') .",";
						endforeach; 
					?>
			],
			color: '#FF9900'

        }, {
            name: 'In Glaze',
            data: [
					<?php 
						foreach ($chart_all as $key => $series ) : 
							echo number_format( $series->inglaze , 3, '.', '') .",";
						endforeach; 
					?>
			],
			color: '#0000FF'

        }, {
            name: 'On Glaze',
            data: [
					<?php 
							foreach ($chart_all as $key => $series ) : 
								echo number_format( $series->onglaze , 3, '.', '') .",";
							endforeach; 
						?>
			],
			color: '#FF00FF'

        }]
    });
});

//=======================

$(function () {
    $('#container2').highcharts({
        chart: {
            type: 'area'
        },
        title: {
            text: 'Grafik Rekap Stok WIP Keramik - Body Polos'
        },
        subtitle: {
            text: '<?php echo $data_status;?>'
        },xAxis: {
            categories: [
							<?php 
								foreach ($chart_all as $key => $x_axis ) : 
									echo "'".$x_axis->kategori."',";
								endforeach; 
                			?>
			],
            crosshair: true
        },
        yAxis: {
            title: {
                text: 'Total (pcs)'
            },
            labels: {
                formatter: function () {
                    return this.value / 1000 + 'k';
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} pcs</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
		legend: {
					enabled: true,
					layout: 'horizontal',
					align: 'center',
					verticalAlign: 'bottom',
					borderWidth: 0				
				},
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Max Stok',
            data: [<?php 
						foreach ($chart_all as $key => $series ) : 
							echo number_format( $series->tbp , 3, '.', '') .",";
						endforeach; 
					?>],
					color: '#FF0000'
        }, {
            name: 'Body Polos',
            data: [<?php 
						foreach ($chart_all as $key => $series ) : 
							echo number_format( $series->bodypolos , 3, '.', '') .",";
						endforeach; 
					?>],
			color: '#00FF00'
        }]
    });
});

//=======================

$(function () {
    $('#container3').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Grafik Rekap Stok WIP Keramik - Colorwave'
        },
        subtitle: {
            text: '<?php echo $data_status;?>'
        },xAxis: {
            categories: [
							<?php 
								foreach ($chart_all as $key => $x_axis ) : 
									echo "'".$x_axis->kategori."',";
								endforeach; 
                			?>
			],
            crosshair: true
        },
        yAxis: {
            title: {
                text: 'Total (pcs)'
            },
            labels: {
                formatter: function () {
                    return this.value / 1000 + 'k';
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} pcs</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
		legend: {
					enabled: true,
					layout: 'horizontal',
					align: 'center',
					verticalAlign: 'bottom',
					borderWidth: 0				
				}
		,
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Batas Atas',
            data: [<?php 
						foreach ($chart_all as $key => $series ) : 
							echo number_format( $series->clv , 3, '.', '') .",";
						endforeach; 
					?>],
					color: '#006600'
        },
		{
            name: 'Batas Bawah',
            data: [<?php 
						foreach ($chart_all as $key => $series ) : 
							echo number_format( $series->clvmin , 3, '.', '') .",";
						endforeach; 
					?>],
					color: '#006600'
        }, {
            name: 'Colorwave',
            data: [<?php 
						foreach ($chart_all as $key => $series ) : 
							echo number_format( $series->colorwave , 3, '.', '') .",";
						endforeach; 
					?>],
			color: '#FF9900'
        }]
    });
});

//=======================

$(function () {
    $('#container4').highcharts({
        chart: {
            type: 'area'
        },
        title: {
            text: 'Grafik Rekap Stok WIP Keramik - In Glaze'
        },
        subtitle: {
            text: '<?php echo $data_status;?>'
        },xAxis: {
            categories: [
							<?php 
								foreach ($chart_all as $key => $x_axis ) : 
									echo "'".$x_axis->kategori."',";
								endforeach; 
                			?>
			],
            crosshair: true
        },
        yAxis: {
            title: {
                text: 'Total (pcs)'
            },
            labels: {
                formatter: function () {
                    return this.value / 1000 + 'k';
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} pcs</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
		legend: {
					enabled: true,
					layout: 'horizontal',
					align: 'center',
					verticalAlign: 'bottom',
					borderWidth: 0				
				}
		,
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Max Stok',
            data: [<?php 
						foreach ($chart_all as $key => $series ) : 
							echo number_format( $series->tgi , 3, '.', '') .",";
						endforeach; 
					?>],
					color: '#FF0000'
        }, {
            name: 'In Glaze',
            data: [<?php 
						foreach ($chart_all as $key => $series ) : 
							echo number_format( $series->inglaze , 3, '.', '') .",";
						endforeach; 
					?>],
			color: '#0000FF'
        }]
    });
});

//=======================

$(function () {
    $('#container5').highcharts({
        chart: {
            type: 'area'
        },
        title: {
            text: 'Grafik Rekap Stok WIP Keramik - On Glaze'
        },
        subtitle: {
            text: '<?php echo $data_status;?>'
        },xAxis: {
            categories: [
							<?php 
								foreach ($chart_all as $key => $x_axis ) : 
									echo "'".$x_axis->kategori."',";
								endforeach; 
                			?>
			],
            crosshair: true
        },
        yAxis: {
            title: {
                text: 'Total (pcs)'
            },
            labels: {
                formatter: function () {
                    return this.value / 1000 + 'k';
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} pcs</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
		legend: {
					enabled: true,
					layout: 'horizontal',
					align: 'center',
					verticalAlign: 'bottom',
					borderWidth: 0				
				}
		,
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Max Stok',
            data: [<?php 
						foreach ($chart_all as $key => $series ) : 
							echo number_format( $series->tgo , 3, '.', '') .",";
						endforeach; 
					?>],
					color: '#FF0000'
        }, {
            name: 'On Glaze',
            data: [<?php 
						foreach ($chart_all as $key => $series ) : 
							echo number_format( $series->onglaze , 3, '.', '') .",";
						endforeach; 
					?>],
			color: '#000000'
        }]
    });
});
</script>


<div class="widget-box ">
    <div class="widget-header">
        <h4 class="lighter smaller">
            <i class="icon-book blue"></i>
            <?php echo $judul;?>
        </h4>
    </div>

    
  <div class="widget-body">
    	 
 <div class="row-fluid">
<form name="my-form" id="my-form" class="form-horizontal" method="post" action="<?php echo base_url();?>index.php/c_grafik_wip/cari_data">		    <div class="control-group">    
    <label class="control-label">Periode</label>
    <div class="controls">
    <input type="text" name="periode1" id="periode1" class="span2 date-picker"  data-date-format="dd-mm-yyyy"/>
     <span class="add-on">-s/d-</span>
    <input type="text" name="periode2" id="periode2" class="span2 date-picker"  data-date-format="dd-mm-yyyy"/>
    <button type="submit" name="cari" id="cari" class="btn btn-small btn-info"><i class="icon-double-angle-right">Filter Data</i></button>
    </div>
    </div>
</form>   
</div>
</div>

<div id="container1" style="float:left; width: 100%; height: 430px; margin: 0 auto"></div>
<div id="container2" style="float:left; width: 100%; height: 330px; margin: 0 auto"></div>
<div id="container3" style="float:left; width: 100%; height: 330px; margin: 0 auto"></div>
<div id="container4" style="float:left; width: 100%; height: 330px; margin: 0 auto"></div>
<div id="container5" style="float:left; width: 100%; height: 330px; margin: 0 auto"></div>