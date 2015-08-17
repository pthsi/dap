<script type="text/javascript" src="<?php echo base_url('/assets/highcharts/highcharts.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/highcharts/modules/exporting.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/highcharts/themes/skies.js'); ?>"></script>	
<script type="text/javascript">

$(document).ready(function()
{$('.date-picker').datepicker().next().on(ace.click_event, function(){$(this).prev().focus();});
	
});
</script>

<script type="text/javascript">

$(function () {
    var chart;
    $(document).ready(function() {
//==========================================================
	chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containera',
                type: 'line',
				spacingTop: 0,				
				spacingBottom: 0
            },
            title: {
                text: 'Grafik AR Glasir',
				style: {
                        color: '#154C67',
                        fontSize: '14px',
                        fontFamily: 'Verdana, sans-serif'							
                    }
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
				labels: {
                    align: 'center',
                    style: {
                        fontSize: '8px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Persen',
                    style: {
                        color: '#154C67',
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'						
                    }
                },
				lineColor:'#999',
				lineWidth:1,
				tickColor:'#666',
				tickWidth:1,
				tickLength:3,
				gridLineColor:'#ddd',				
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
            formatter: function () {
                var s = '<b>' + this.x + '</b>';

                $.each(this.points, function () {
                    s += '<br/>' + '<span style="color:' + this.series.color + '"> ●♦▲▼■ </span>' + ' ' + this.series.name + ': ' + this.y + ' %';
                });

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
                        line: {
                            dataLabels: {
                                enabled: true,
                                color: 'black',
                                style: { fontFamily: '\'Lato\', sans-serif', lineHeight: '18px', fontSize: '9px' },
                                formatter: function () {
                                    return Highcharts.numberFormat(this.y,0) + ' %';
                                     
                                },
                                y : -10
                            },
                            enableMouseTracking: true
                        }
                    },
            series: [{
                name: 'Dipping',
                data: [
					<?php 
					foreach ($chart_all as $key => $series ) : 
						echo number_format( $series->ar_dip , 3, '.', '') .",";
					endforeach; 
					?>
				],
				color: '#AA4643'
            },
			{
                name: 'Konveyer',
                data: [
					<?php 
					foreach ($chart_all as $key => $series ) : 
						echo number_format( $series->ar_kon , 3, '.', '') .",";
					endforeach; 
					?>
				],
				color: '#0000FF'
            }
            ,
            {
                name: 'Mesin',
                data: [
					<?php 
					foreach ($chart_all as $key => $series ) : 
						echo number_format( $series->ar_mes , 3, '.', '') .",";
					endforeach; 
					?>
				],
				color: '#FF00FF'
            },
            {
                name: 'Spray',
                data: [
					<?php 
					foreach ($chart_all as $key => $series ) : 
						echo number_format( $series->ar_spr , 3, '.', '') .",";
					endforeach; 
					?>
				],
				color: '#FF6600'
            },
            {
                name: 'Waterfall',
                data: [
					<?php 
					foreach ($chart_all as $key => $series ) : 
						echo number_format( $series->ar_wat , 3, '.', '') .",";
					endforeach; 
					?>
				],
				color: '#669900'
            }
            ]
        });
//======================================================================================
chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerb',
                type: 'area',
				spacingTop: 0,				
				spacingBottom: 0
            },
            title: {
                text: 'Plan VS Actual Glasir Dipping',
				style: {
                        color: '#154C67',
                        fontSize: '14px',
                        fontFamily: 'Verdana, sans-serif'							
                    }
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
				labels: {
                    align: 'center',
                    style: {
                        fontSize: '8px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Pieces',
                    style: {
                        color: '#154C67',
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'						
                    }
                },
				lineColor:'#999',
				lineWidth:1,
				tickColor:'#666',
				tickWidth:1,
				tickLength:3,
				gridLineColor:'#ddd',				
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
            formatter: function () {
                var s = '<b>' + this.x + '</b>';

                $.each(this.points, function () {
                    s += '<br/>' + '<span style="color:' + this.series.color + '"> ●♦▲▼■ </span>' + ' ' + this.series.name + ': ' + this.y + ' pcs';
                });

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
                        line: {
                            dataLabels: {
                                enabled: true,
                                color: 'black',
                                style: { fontFamily: '\'Lato\', sans-serif', lineHeight: '18px', fontSize: '9px' },
                                formatter: function () {
                                    return Highcharts.numberFormat(this.y,0) + ' pcs';
                                     
                                },
                                y : -10
                            },
                            enableMouseTracking: true
                        }
                    },
            series: [{
                name: 'Planning',
                data: [
					<?php 
					foreach ($chart_all as $key => $series ) : 
						echo number_format( $series->pln_dip , 3, '.', '') .",";
					endforeach; 
					?>
				],
				color: '#FF0000'
            },
			{
                name: 'Aktual',
                data: [
					<?php 
					foreach ($chart_all as $key => $series ) : 
						echo number_format( $series->akt_dip , 3, '.', '') .",";
					endforeach; 
					?>
				],
				color: '#33CC33'
            }
            ]
        });
//======================================================================================
chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerc',
                type: 'area',
				spacingTop: 0,				
				spacingBottom: 0
            },
            title: {
                text: 'Plan VS Actual Glasir Konveyer',
				style: {
                        color: '#154C67',
                        fontSize: '14px',
                        fontFamily: 'Verdana, sans-serif'							
                    }
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
				labels: {
                    align: 'center',
                    style: {
                        fontSize: '8px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Pieces',
                    style: {
                        color: '#154C67',
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'						
                    }
                },
				lineColor:'#999',
				lineWidth:1,
				tickColor:'#666',
				tickWidth:1,
				tickLength:3,
				gridLineColor:'#ddd',				
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
            formatter: function () {
                var s = '<b>' + this.x + '</b>';

                $.each(this.points, function () {
                    s += '<br/>' + '<span style="color:' + this.series.color + '"> ●♦▲▼■ </span>' + ' ' + this.series.name + ': ' + this.y + ' pcs';
                });

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
                        line: {
                            dataLabels: {
                                enabled: true,
                                color: 'black',
                                style: { fontFamily: '\'Lato\', sans-serif', lineHeight: '18px', fontSize: '9px' },
                                formatter: function () {
                                    return Highcharts.numberFormat(this.y,0) + ' pcs';
                                     
                                },
                                y : -10
                            },
                            enableMouseTracking: true
                        }
                    },
            series: [{
                name: 'Planning',
                data: [
					<?php 
					foreach ($chart_all as $key => $series ) : 
						echo number_format( $series->pln_kon , 3, '.', '') .",";
					endforeach; 
					?>
				],
				color: '#FF0000'
            },
			{
                name: 'Aktual',
                data: [
					<?php 
					foreach ($chart_all as $key => $series ) : 
						echo number_format( $series->akt_kon , 3, '.', '') .",";
					endforeach; 
					?>
				],
				color: '#33CC33'
            }
            ]
        });
//======================================================================================
chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerd',
                type: 'area',
				spacingTop: 0,				
				spacingBottom: 0
            },
            title: {
                text: 'Plan VS Actual Glasir Mesin',
				style: {
                        color: '#154C67',
                        fontSize: '14px',
                        fontFamily: 'Verdana, sans-serif'							
                    }
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
				labels: {
                    align: 'center',
                    style: {
                        fontSize: '8px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Pieces',
                    style: {
                        color: '#154C67',
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'						
                    }
                },
				lineColor:'#999',
				lineWidth:1,
				tickColor:'#666',
				tickWidth:1,
				tickLength:3,
				gridLineColor:'#ddd',				
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
            formatter: function () {
                var s = '<b>' + this.x + '</b>';

                $.each(this.points, function () {
                    s += '<br/>' + '<span style="color:' + this.series.color + '"> ●♦▲▼■ </span>' + ' ' + this.series.name + ': ' + this.y + ' pcs';
                });

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
                        line: {
                            dataLabels: {
                                enabled: true,
                                color: 'black',
                                style: { fontFamily: '\'Lato\', sans-serif', lineHeight: '18px', fontSize: '9px' },
                                formatter: function () {
                                    return Highcharts.numberFormat(this.y,0) + ' pcs';
                                     
                                },
                                y : -10
                            },
                            enableMouseTracking: true
                        }
                    },
            series: [{
                name: 'Planning',
                data: [
					<?php 
					foreach ($chart_all as $key => $series ) : 
						echo number_format( $series->pln_mes , 3, '.', '') .",";
					endforeach; 
					?>
				],
				color: '#FF0000'
            },
			{
                name: 'Aktual',
                data: [
					<?php 
					foreach ($chart_all as $key => $series ) : 
						echo number_format( $series->akt_mes , 3, '.', '') .",";
					endforeach; 
					?>
				],
				color: '#33CC33'
            }
            ]
        });
//======================================================================================
chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containere',
                type: 'area',
				spacingTop: 0,				
				spacingBottom: 0
            },
            title: {
                text: 'Plan VS Actual Glasir Spray',
				style: {
                        color: '#154C67',
                        fontSize: '14px',
                        fontFamily: 'Verdana, sans-serif'							
                    }
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
				labels: {
                    align: 'center',
                    style: {
                        fontSize: '8px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Pieces',
                    style: {
                        color: '#154C67',
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'						
                    }
                },
				lineColor:'#999',
				lineWidth:1,
				tickColor:'#666',
				tickWidth:1,
				tickLength:3,
				gridLineColor:'#ddd',				
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
            formatter: function () {
                var s = '<b>' + this.x + '</b>';

                $.each(this.points, function () {
                    s += '<br/>' + '<span style="color:' + this.series.color + '"> ●♦▲▼■ </span>' + ' ' + this.series.name + ': ' + this.y + ' pcs';
                });

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
                        line: {
                            dataLabels: {
                                enabled: true,
                                color: 'black',
                                style: { fontFamily: '\'Lato\', sans-serif', lineHeight: '18px', fontSize: '9px' },
                                formatter: function () {
                                    return Highcharts.numberFormat(this.y,0) + ' pcs';
                                     
                                },
                                y : -10
                            },
                            enableMouseTracking: true
                        }
                    },
            series: [{
                name: 'Planning',
                data: [
					<?php 
					foreach ($chart_all as $key => $series ) : 
						echo number_format( $series->pln_spr , 3, '.', '') .",";
					endforeach; 
					?>
				],
				color: '#FF0000'
            },
			{
                name: 'Aktual',
                data: [
					<?php 
					foreach ($chart_all as $key => $series ) : 
						echo number_format( $series->akt_spr , 3, '.', '') .",";
					endforeach; 
					?>
				],
				color: '#33CC33'
            }
            ]
        });
//======================================================================================
chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerf',
                type: 'area',
				spacingTop: 0,				
				spacingBottom: 0
            },
            title: {
                text: 'Plan VS Actual Glasir Waterfall',
				style: {
                        color: '#154C67',
                        fontSize: '14px',
                        fontFamily: 'Verdana, sans-serif'							
                    }
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
				labels: {
                    align: 'center',
                    style: {
                        fontSize: '8px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Pieces',
                    style: {
                        color: '#154C67',
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'						
                    }
                },
				lineColor:'#999',
				lineWidth:1,
				tickColor:'#666',
				tickWidth:1,
				tickLength:3,
				gridLineColor:'#ddd',				
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
            formatter: function () {
                var s = '<b>' + this.x + '</b>';

                $.each(this.points, function () {
                    s += '<br/>' + '<span style="color:' + this.series.color + '"> ●♦▲▼■ </span>' + ' ' + this.series.name + ': ' + this.y + ' pcs';
                });

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
                        line: {
                            dataLabels: {
                                enabled: true,
                                color: 'black',
                                style: { fontFamily: '\'Lato\', sans-serif', lineHeight: '18px', fontSize: '9px' },
                                formatter: function () {
                                    return Highcharts.numberFormat(this.y,0) + ' pcs';
                                     
                                },
                                y : -10
                            },
                            enableMouseTracking: true
                        }
                    },
            series: [{
                name: 'Planning',
                data: [
					<?php 
					foreach ($chart_all as $key => $series ) : 
						echo number_format( $series->pln_wat , 3, '.', '') .",";
					endforeach; 
					?>
				],
				color: '#FF0000'
            },
			{
                name: 'Aktual',
                data: [
					<?php 
					foreach ($chart_all as $key => $series ) : 
						echo number_format( $series->akt_wat , 3, '.', '') .",";
					endforeach; 
					?>
				],
				color: '#33CC33'
            }
            ]
        });
//======================================================================================
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
<form name="my-form" id="my-form" class="form-horizontal" method="post" action="<?php echo base_url();?>index.php/c_grafik_glz/cari_data">		    <div class="control-group">    
    <label class="control-label">Periode Bulan</label>
    <div class="controls">
    <input type="text" name="pb" id="pb" class="span2 date-picker"  data-date-format="dd-mm-yyyy"/>
     <span class="add-on">
                                    Grouping Waktu
                                </span>
                                <select name="grup" id="grup" class="span2">
                                    <option value="day">Harian</option>
                                </select>
    <button type="submit" name="cari" id="cari" class="btn btn-small btn-info"><i class="icon-double-angle-right">FilterData</i></button>
    </div>
    </div>
</form>   
</div>
</div>

<div id="containera" style="float:left; width: 100%; height: 330px; margin: 0 auto"></div>
<div id="containerb" style="float:left; width: 100%; height: 330px; margin: 0 auto"></div>
<div id="containerc" style="float:left; width: 100%; height: 330px; margin: 0 auto"></div>
<div id="containerd" style="float:left; width: 100%; height: 330px; margin: 0 auto"></div>
<div id="containere" style="float:left; width: 100%; height: 330px; margin: 0 auto"></div>
<div id="containerf" style="float:left; width: 100%; height: 330px; margin: 0 auto"></div>