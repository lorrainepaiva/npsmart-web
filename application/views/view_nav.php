<script type="text/javascript" >
$(document).ready(function () {
    //override jQuery UI draggable
    $.extend($.ui.sortable.prototype, {
        _mouseInit: function () {
            var that = this;
            if (!this.options.mouseButton) {
                this.options.mouseButton = 1;
            }

            $.ui.mouse.prototype._mouseInit.apply(this, arguments);

            if (this.options.mouseButton === 3) {
                this.element.bind("contextmenu." + this.widgetName, function (event) {
                    if (true === $.data(event.target, that.widgetName + ".preventClickEvent")) {
                        $.removeData(event.target, that.widgetName + ".preventClickEvent");
                        event.stopImmediatePropagation();
                        return false;
                    }
                    event.preventDefault();
                    return false;
                });
            }

            this.started = false;
        },
        _mouseDown: function (event) {

            // we may have missed mouseup (out of window)
            (this._mouseStarted && this._mouseUp(event));

            this._mouseDownEvent = event;

            var that = this,
                btnIsLeft = (event.which === this.options.mouseButton),
                // event.target.nodeName works around a bug in IE 8 with
                // disabled inputs (#7620)
                elIsCancel = (typeof this.options.cancel === "string" && event.target.nodeName ? $(event.target).closest(this.options.cancel).length : false);
            if (!btnIsLeft || elIsCancel || !this._mouseCapture(event)) {
                return true;
            }

            this.mouseDelayMet = !this.options.delay;
            if (!this.mouseDelayMet) {
                this._mouseDelayTimer = setTimeout(function () {
                    that.mouseDelayMet = true;
                }, this.options.delay);
            }

            if (this._mouseDistanceMet(event) && this._mouseDelayMet(event)) {
                this._mouseStarted = (this._mouseStart(event) !== false);
                if (!this._mouseStarted) {
                    event.preventDefault();
                    return true;
                }
            }

            // Click event may never have fired (Gecko & Opera)
            if (true === $.data(event.target, this.widgetName + ".preventClickEvent")) {
                $.removeData(event.target, this.widgetName + ".preventClickEvent");
            }

            // these delegates are required to keep context
            this._mouseMoveDelegate = function (event) {
                return that._mouseMove(event);
            };
            this._mouseUpDelegate = function (event) {
                return that._mouseUp(event);
            };
            $(document)
                .bind("mousemove." + this.widgetName, this._mouseMoveDelegate)
                .bind("mouseup." + this.widgetName, this._mouseUpDelegate);

            event.preventDefault();

            mouseHandled = true;
            return true;
        }
    });

    $(".sortable1").sortable({
        mouseButton: 3
    });
	
});
	
$(document).ready( function () {
  $('#table_id').DataTable( {
    "bPaginate": true,
	processing: true,
	"aaSorting": [],
	"bInfo": false,
	"pageLength": 15
  } );
} );






$(function() {	
	$('#weekdate').datepicker()
  .on('changeDate', function(date){
	var date = $(this).val();
	var week = $.datepicker.iso8601Week(date);
	alert(week);
	    });
  });

// //let's create arrays
	<?php 
	// foreach($rncs as $row){
		// echo $row->node;
	// }
#echo json_encode($rncs);

// foreach($custom as $row){
		// $custom_cluster[] = $row->node;
		// }	


?>
var reportagg = "<?php echo $reportagg; ?>";
var reportnetype = "<?php echo $reportnetype; ?>";
var reportkpi = "<?php echo $reportkpi; ?>";
var reportnename = "<?php echo $reportnename; ?>";
var reportdate = "<?php echo $reportdate; ?>";
var rnc = <?php echo json_encode($rncs); ?>;	
var region = <?php echo json_encode($regional); ?>;	
var cidade = <?php echo json_encode($cidades); ?>;	
var cluster = <?php echo json_encode($clusters); ?>;	
//var cell = <?php #echo json_encode($cells); ?>;	
var nodeb = <?php echo json_encode($nodebs); ?>;	
var uf = <?php echo json_encode($ufs); ?>;	
var custom = <?php echo json_encode($custom); ?>;	

// var chocolates = [
    // {display: "Dark chocolate", value: "dark-chocolate" },
    // {display: "Milk chocolate", value: "milk-chocolate" },
    // {display: "White chocolate", value: "white-chocolate" },
    // {display: "Gianduja chocolate", value: "gianduja-chocolate" }];

// //If parent option is changed
// $("#parent_selection").change(function() {
        // var parent = $(this).val(); //get option value from parent
       
        // switch(parent){ //using switch compare selected option and populate child
              // case 'rncs':
                // list(chocolates);
                // break;
              // case 'regional':
                // list(regional);
                // break;             
              // case 'cidades':
                // list(cidades);
                // break;
			  // case 'cluster':
                // list(cluster);
                // break;	
            // default: //default child option is blank
                // $("#child_selection").html('');  
                // break;
           // }
// });

// //function to populate child select box
// function list(array_list)
// {
	// alert("ola");
    // $("#child_selection").html(""); //reset child options
    // $(array_list).each(function (i) { //populate child options
        // $("#child_selection").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
    // });
// }	
	
$(document).ready(function(){

//If parent option is changed
$("#parent_selection").change(function() {
        var parent = $(this).val(); //get option value from parent
       
        switch(parent){ //using switch compare selected option and populate child
              case 'rnc':
                list(rnc);
                break;
              case 'region':
                list(region);
                break;             
              case 'cidade':
                list(cidade);
                break;
              case 'uf':
                list(uf);
                break;
              case 'nodeb':
                list(nodeb);
                break;				
			case 'cluster':
                list(cluster);
                break;
			case 'custom':
                list(custom);
                break;					
            default: //default child option is blank
                $("#child_selection").html('');  
                break;
           }
		    $(function() {
  $('#child_selection').filterByText($('#myInput'));
});
});

//function to populate child select box
function list(array_list)
{
    $("#child_selection").html(""); //reset child options
    $(array_list).each(function (i) { //populate child options
        $("#child_selection").append("<option value=\""+array_list[i].node+"\">"+array_list[i].node+"</option>");
    });
}

//jQuery extension method:
jQuery.fn.filterByText = function(textbox) {
  return this.each(function() {
    var select = this;
    var options = [];
    $(select).find('option').each(function() {
      options.push({
        value: $(this).val(),
        text: $(this).text()
      });
    });
    $(select).data('options', options);

    $(textbox).bind('change keyup', function() {
      var options = $(select).empty().data('options');
      var search = $.trim($(this).val());
      var regex = new RegExp(search, "gi");

      $.each(options, function(i) {
        var option = options[i];
        if (option.text.match(regex) !== null) {
          $(select).append(
            $('<option>').text(option.text).val(option.value)
          );
        }
      });
    });
  });
};



});
	
	
</script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<head>
<style>
#Filtro {
  width: 200px;
  font-size: 16px;
  padding: 5px 5px 6px 5px;
  border: 1px solid #ddd;
  margin-bottom: 5px;
  margin-top: 5px;
}

#myInput{
border: 1px solid transparent;
margin-left: 10px;
width:120px;
}

#myInput:focus{
outline:none;
}

</style>
</head>
<body>
<?php
 $attributes = array('name' => 'reportopt', 'method' => 'post');
echo form_open('', $attributes);
?>
<!--<input type="hidden" id="reportname" name="reportname" value="" />-->
<input type="hidden" id="reportnetype" name="reportnetype" value="" />
<input type="hidden" id="reportnename" name="reportnename" value="" />
<input type="hidden" id="reportdate" name="reportdate" value="" />
<input type="hidden" id="reportkpi" name="kpi" value="" />
</form>


<?php 
if (isset($monthnum)){
	$calendarinfo = $monthnum;
}
elseif (isset($weeknum)){
	$calendarinfo = "Week ".$weeknum;
} else{
	$calendarinfo = $reportdate;
}

#echo count($cells);
		// foreach($cells as $row){
			// $cellinfo[$row->cellname] = $row->cellid;
			// $rnc[] = $row->rnc;
			// $cellid[] =  $row->cellid;
			// $cellname[] = $row->cellname;
			// $site[] = $row->site;
			// $regional[] = $row->regional;
			// $uf[] = $row->uf;	
			// $cluster[] = $row->cluster;
			// $cidade[] = $row->cidade;
			
		// }
		// $rncunique = $array = array_values(array_filter(array_unique($rnc)));;
		// $clusterunique = $array = array_values(array_filter(array_unique($cluster)));;
		// $cidadeunique = $array = array_values(array_filter(array_unique($cidade)));;
		?>


       <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <div class="navbar-header" >
                <button type="button" class="navbar-toggle collapsed" id="toggleButton" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://support.huawei.com"><img src="/npsmart/images/huawei_logo_icon.png" style="padding:0px; top:0px; width:30px; margin-top:-15%; height:30px;"/></a>
               
                <a class="navbar-brand" id="aTitleVersion" href="/npsmart/umts/" style="width:170px;"><span id="aTitle">NPSmart</span>&nbsp; <span id="sVersion" style="font-size:12px; font-family:Calibri;">
                     v2.1</span></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
                <ul class="nav navbar-nav" id="mainMenu">
                     <li id="menuItemnqi" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Performance<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="menuItemnqi"><a href="/npsmart/umts/">Main KPIs</a></li>
                            <li class="menuItemnqi"><a onclick='selectreportname(this)'>AMX NQI HS</a></li>
                            <li class="menuItemnqi"><a onclick='selectreportname(this)'>AMX NQI CS</a></li>
                            <li class="menuItemnqi"><a href="/npsmart/umts/tx_integrity">TX Integrity</a></li>
                            <li class="menuItemnqi"><a href="/npsmart/umts/overshooters">Overshooters</a></li>
                            <!--<li class="menuItemnqi"><a href="/npsmart/umts/feature_phase2">Feature Report</a></li>-->
                            <li class="menuItemnqi"><a href="/npsmart/umts/radar">AMX Radar</a></li>
							<li class="menuItemnqi"><a href="/npsmart/umts/unbalance">EE/Load Unbalance</a></li>
                        </ul>
                    </li>

                    <li id="menuItemwaf" class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Capacity<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
						<li class="menuItemnqi"><a href="/npsmart/umts/capacity">Cell & NodeB Capacity</a></li>
						<li class="menuItemnqi"><a href="/npsmart/umts/rnc_capacity">RNC Capacity</a></li>
                        </ul>
						</li>	
  
                    <li id="menuItemwaf" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">RNP<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="menuItemnqi"><a href="/npsmart/umts/rfpar">Cells Database</a></li>
                            <li><a href="/npsmart/umts/cfg">RNC & Cell Configuration</a></li>
                            <li class="menuItemnqi"><a href="/npsmart/umts/nodebcfg">NodeB Configuration</a></li>  
                            <li class="menuItemnqi"><a href="/npsmart/umts/srancfg">Single-RAN Configuration</a></li>  
							<li class="menuItemnqi"><a href="/npsmart/umts/inventory">Inventory</a></li>							  
							<!--<li class="menuItemnqi"><a href="/npsmart/umts/gis">GIS</a></li>-->
							<li class="disabled"><a href="#">GIS</a></li>
							<li class="menuItemnqi"><a href="/npsmart/umts/alarm">Alarm</a></li>	
                        </ul>
                    </li>	

                    <li id="menuItemwaf" class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Baseline<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
							<li class="menuItemnqi"><a href="/npsmart/umts/baseline_nodeb">Baseline NodeB Audit</a></li>
                            <li class="menuItemnqi"><a href="/npsmart/umts/baseline">Baseline Cell & RNC Audit</a></li>
                        </ul>
                    </li>
					
					<li class="menuItemnqi"><a href="/npsmart/umts/triage">Cell Mapping</a></li>
					
					<!--<li class="disabled"><a href="#">Degradation Summary</a></li>-->
					<li id="menuItemwaf" class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Settings<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li class="disabled"><a href="#">Counters</a></li>
							<li class="disabled"><a href="#">KPIs Target</a></li>
                        </ul>
					</li>
                
                    <li class="disabled"><a href="#">Log</a></li>
					<li><a href="/npsmart/quickreport">Quick Report</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
	
	 <li class="dropdown" id="dateMenu1">
	 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">UMTS<span class="glyphicon glyphicon-phone pull-left" style="margin-top:2px;margin-right:4px;"></span><span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
                              <li id="menuItemwaf"><a href="/npsmart/gsm/">GSM</a></li>
                              <li id="menuItemwaf"><a href="/npsmart/umts/">UMTS</a></li>
                              <li id="menuItemwaf"><a href="/npsmart/lte/">LTE</a></li>
         </ul>
     </li>

	 	 	 <li class="dropdown" id="dateMenu1">
	 <a style="text-transform: capitalize" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $reportagg ?> <span class="glyphicon glyphicon-calendar pull-left" style="margin-top:2px;margin-right:4px;"></span><span id="caretOptions1" class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
                              <li id="menuItemnqi"><a onclick='selecttimeagg(this)'>Daily</a></li>
                              <li id="menuItemnqi"><a onclick='selecttimeagg(this)'>Weekly</a></li>
                              <li id="menuItemnqi"><a onclick='selecttimeagg(this)'>Monthly</a></li>
         </ul>
     </li>
 
    <li class="dropdown" id="dateMenu1">
        <a href="#" id="daterange" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span id="spDate"><?php echo $calendarinfo;?></span> <span class="glyphicon glyphicon-calendar pull-left" style="margin-top:2px;margin-right:4px;"></span><span id="caretOptions1" class="caret"></span></a>
        <div class="week-picker" id="calendarDiv" style="position:absolute;z-index:10"></div>
    </li>

                    <li class="dropdown" id="optionsMenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span id="spOptions"><?php echo $reportnename;?></span> <span class="glyphicon glyphicon-th-list pull-left" style="margin-top:2px;margin-right:4px;"></span><span id="caretOptions" class="caret"></span></a>
                        <div class="dropdown-menu" style="padding:12px;margin-bottom:0px;padding-bottom:0px;">
                            <form class="form" id="formOptions">
                                     
    


   <!--   <div class="form-group">
        <label class="control-label" for="inputSmall">Network Node</label>
	<select name="parent_selection" id="parent_selection">
    <option value="">-- Please Select --</option>
    <option value="regional">Region</option>
    <option value="rncs">RNC</option>
    <option value="cidades">City</option>
    <option value="clusters">Cluster</option>
</select>
<select name="child_selection" id="child_selection">
</select>
</div>-->

<div class="form-group">
Network Node : <select name="parent_selection" id="parent_selection" style="width:200px;">
    <option value="">-- Please Select --</option>
    <option value="region">Region</option>
    <option value="rnc">RNC</option>
    <option value="uf">UF</option>
    <option value="cidade">City</option>
    <option value="cluster">Cluster</option>
	<!--<option value="custom">Custom Cluster</option>-->
    <option value="nodeb">NodeB</option>
    <!--<option value="cluster">Cluster</option>-->
</select>
<div id="Filtro">

<span id="SearchIcon"><i class="fa fa-search" style="font-size:15px;color:gray"></i></span>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names ..." title="Type in a name">

</div>
<select name="child_selection" id="child_selection" style="width:200px;">
</select>
</div>

     <a href="#" id="btnSubmit" class="btn btn-default btn-sm" onclick='selectnenav($("#child_selection").val(),$("#parent_selection").val())';>Update</a>
     <div class="form-group">
      </div>

                            </form>
                        </div>
                    </li>
<!--                    <li id="liAmdocsLogo"><img src="/npsmart/images/huawei-logo.png" width="130" height="30"" style="margin-top:5px;margin-right:-8px;padding-left:4px;" /></li>-->
                </ul>
            </div>
        </div>
    </nav>
	