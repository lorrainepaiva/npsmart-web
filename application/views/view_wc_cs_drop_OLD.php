	<?php 
		foreach($result as $row){
			$node = $row->rnc;
			#$cellname =  $row->cellname;
			#$cellid = $row->cellid;
			$datetime[] = $row->datetime;
			$drop_cs[] = $row->drop_cs;	
			$drop_ps[] = $row->drop_ps;	
			$drop_hsdpa[] = $row->drop_hsdpa;	
			$drop_hsupa[] = $row->drop_hsupa;	
			$fails_drop_cs[] = $row->fails_drop_cs;	
			$fails_drop_ps[] = $row->fails_drop_ps;	
			$fails_drop_hsdpa[] = $row->fails_drop_hsdpa;	
			$fails_drop_hsupa[] = $row->fails_drop_hsupa;				
		}
		#echo $cellid;
		#echo $cellname;
		#echo $node;
		array_walk($datetime, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime
		//echo "RNC= ".$rnc.", cellname= ".$cellname.", cellid= ".$cellid."<br><br>";
		//echo join($datetime, ',');
		//echo "<br><br>";
		#echo join($fails_drop_cs, ',');
		#echo '<span size="4" color="#E0E0E3">'.$ne.'</span>';
		?>
		
<script>
///	for (i = 0; i < cars.length; i++) { 
///    text += cars[i] + "<br>";
///}
var node = "<?php echo $ne; ?>";
var datetime = <?php echo json_encode($datetime); ?>;	

var datetime = JSON.parse("[" + datetime + "]");
///alert(datetime[0]);	
$(function () {
    var chart;
    $(document).ready(function() {
	
///////////////////////////////////////////////////////////ACCESSIBILITY RRC/////////////////////////////////////////////	
		
	var acc_rrc = new Highcharts.Chart({
		chart: {
				renderTo: 'wcchart1',
				alignTicks:false,
				//backgroundColor:'transparent',
				zoomType: 'x'//,
				//borderWidth: 2
						///type: 'line',
						///height: 195		
				},
					credits: {
					   enabled: false
					},		
					exporting: { 
					enabled: true 
					},
					title: {
						text: 'RRC Accessibility',
						x: -20 //center
					},
					subtitle: {
						text: '<i>' + node + '</i>',
						x: -20
					},
					xAxis: {
						categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},

					yAxis: [{ // Primary yAxis
						max: 100,
						labels: {
							format: '{value}%',
					///		style: {
					///			color: Highcharts.getOptions().colors[1]
					///		}
						},
						title: {
						///	text: '',
					///		style: {
					///			color: Highcharts.getOptions().colors[1]
					///		}
						},
						
						plotLines: [{
								value: 0,
								width: 1,
								color: '#808080'
							}]
					}, { // Secondary yAxis
						title: {
							text: 'RRC Fails',
				///			style: {
				///				color: Highcharts.getOptions().colors[0]
				///			}
						},
						labels: {
						///	format: '{value}%',
				///			style: {
				///				color: Highcharts.getOptions().colors[0]
				///			}
						},
						opposite: true
					}],
				tooltip: {
					shared: true
				},
					
					legend: {
						layout: 'horizontal',
						align: 'center',
						verticalAlign: 'bottom',
						floating: false,
						borderWidth: 0
					},
					
					plotOptions: {
						series: {
							cursor: 'pointer',
							events: {
								click: function(e) {
								// Log to console
									alert(this.name + ' clicked\n' +
									  'Alt: ' + event.altKey + '\n' +
									  'Control: ' + event.ctrlKey + '\n'+
									  'Shift: ' + event.shifkKey + '\n'+
									  'Datetime: ' + datetime[event.point.x]);
								}
							}
						}
					},
					
					series: [{
					///	showInLegend: false,
						name: 'RRC Accessibility',
						data: [<?php echo join($drop_cs, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
			            name: 'RRC Fails',
						type: 'column',
						color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',

						yAxis: 1,
			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($fails_drop_cs, ',') ?>]
			        }
					]							
		});		
		// var acc_rrc = new Highcharts.Chart({
		// chart: {
				// renderTo: 'wcchart1',
				// alignTicks:false,
				// //backgroundColor:'transparent',
				// zoomType: 'x'//,
				// //borderWidth: 2
						// ///type: 'line',
						// ///height: 195		
				// },
					// credits: {
					   // enabled: false
					// },		
					// exporting: { 
					// enabled: true 
					// },
					// title: {
						// text: 'CS Retainability',
						// x: -20 //center
					// },
					// subtitle: {
						// text: '<i>' + node + '</i>',
						// x: -20
					// },
					// xAxis: {
						// categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					// },

					// yAxis: [{ // Primary yAxis
						// max: 100,
						// labels: {
							// format: '{value}%',
					// ///		style: {
					// ///			color: Highcharts.getOptions().colors[1]
					// ///		}
						// },
						// title: {
						// ///	text: '',
					// ///		style: {
					// ///			color: Highcharts.getOptions().colors[1]
					// ///		}
						// },
						
						// plotLines: [{
								// value: 0,
								// width: 1,
								// color: '#808080'
							// }]
					// }, { // Secondary yAxis
						// title: {
							// text: 'Abnormal Releases',
				// ///			style: {
				// ///				color: Highcharts.getOptions().colors[0]
				// ///			}
						// },
						// labels: {
						// ///	format: '{value}%',
				// ///			style: {
				// ///				color: Highcharts.getOptions().colors[0]
				// ///			}
						// },
						// opposite: true
					// }],
				// tooltip: {
					// shared: true
				// },
					
					// legend: {
						// layout: 'horizontal',
						// align: 'center',
						// verticalAlign: 'bottom',
						// floating: false,
						// borderWidth: 0
					// },
					
					// plotOptions: {
						// series: {
							// cursor: 'pointer',
							// events: {
								// click: function(e) {
								// // Log to console
									// alert(this.name + ' clicked\n' +
									  // 'Alt: ' + event.altKey + '\n' +
									  // 'Control: ' + event.ctrlKey + '\n'+
									  // 'Shift: ' + event.shifkKey + '\n'+
									  // 'Datetime: ' + datetime[event.point.x]);
								// }
							// }
						// }
					// },
					
					// series: [{
					// ///	showInLegend: false,
						// name: 'Retainability CS',
						// data: [<?php echo join($drop_cs, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						// ///data: JSON.parse("[" + acc_rrc + "]")
					// }
					// ,{
			            // name: 'Abnormal Releases',
						// type: 'column',
						// color: 'rgba(0, 255, 0, 0.8)',
						// ///borderColor:'#C80000',
						// ///borderColor:'rgba(0, 255, 0)',

						// yAxis: 1,
			            // ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						// data: [<?php echo join($fails_drop_cs, ',') ?>]
			        // }
					// ]							
		// });
		
///////////////////////////////////////////////////////////DROP CS FAILS/////////////////////////////////////////////		
	
		// var fails_rrc = new Highcharts.Chart({
		// chart: {
				// renderTo: 'wcchart2',
				// alignTicks:false,
				// //backgroundColor:'transparent',
				// zoomType: 'xy',
				// //borderWidth: 2		
						// type: 'column'//,
						// ///height: 195		
				// },
					// credits: {
					   // enabled: false
					// },		
					// exporting: { 
					// enabled: true 
					// },
					// title: {
						// text: 'RRC Fails',
					// //	 floating: true,
						// x: -20, //center
						// //y: 0
					// },
					// subtitle: {
						// text: '<i>' + node + '</i>',
						// x: -20
					// },
					// xAxis: {
						// categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					// },
					// yAxis: {
						// ///max: 100,
						// min: 0,
						// title: {
							// //text: 'Temperature (°C)'
						// },
						// //{  },
						// plotLines: [{
							// value: 0,
							// width: 1,
							// color: '#808080'
						// }]
						
					// },
					// tooltip: {
					// ///	valueSuffix: '%'
					// shared: true
					// },
					// plotOptions: {
								// column: {
									// stacking: 'normal',
									// dataLabels: {
										// enabled: false,
										// color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
										// style: {
											// textShadow: '0 0 3px black'
										// }
									// }
								// }
							// },
					// legend: {
						// layout: 'horizontal',
						// align: 'center',
						// verticalAlign: 'bottom',
						// floating: false,
						// borderWidth: 0
					// },
					// series: [{
						// name: 'Code Congestion',
						// data: [<?php echo join($vs_rrc_rej_code_cong, ',') ?>]
					// },
					// {
			            // name: 'DLPower Congestion',
						// data: [<?php echo join($vs_rrc_rej_dlpower_cong, ',') ?>]
			        // },
					// {
			            // name: 'ULPower Congestion',
						// data: [<?php echo join($vs_rrc_rej_ulpower_cong, ',') ?>]
			        // },
					// {
			            // name: 'DLCE Congestion',
						// data: [<?php echo join($vs_rrc_rej_dlce_cong, ',') ?>]
			        // },
					// {
			            // name: 'ULCE Congestion',
						// data: [<?php echo join($vs_rrc_rej_ulce_cong, ',') ?>]
			        // },
					
					// {
			            // name: 'DLIUBBAND Congestion',
						// data: [<?php echo join($vs_rrc_rej_dliubband_cong, ',') ?>]
			        // },
					
					// {
			            // name: 'ULIUBBAND Congestion',
						// data: [<?php echo join($vs_rrc_rej_uliubband_cong, ',') ?>]
			        // },
					
					// {
			            // name: 'No Reply',
						// data: [<?php echo join($vs_rrc_failconnestab_noreply, ',') ?>]
			        // },	
					// {
			            // name: 'NodeB Resource Unavailable',
						// data: [<?php echo join($vs_rrc_rej_nodebresunavail, ',') ?>]
			        // },	
					// {
			            // name: 'RL Fail',
						// data: [<?php echo join($vs_rrc_rej_rl_fail, ',') ?>]
			        // }
											
					// ]							
		// });			

  });


    // $('.chart_content').bind('dblclick', function () {
        // var $this = $(this);
        // $this.toggleClass('modal');
        // $('.chart1', $this).highcharts().reflow();
    // });	
	
   });
</script>