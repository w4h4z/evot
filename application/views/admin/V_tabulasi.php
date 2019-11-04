<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tabulasi</title>
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.6.2.js"></script>
    <style type="text/css">
      body {
        padding-top: 0px;
        padding-bottom: 0px;
		background-color:#0e90d2;
      }
	  #style_vote{
		font-size:200px;
		color:#0e90d2;
	  }
    </style>
</head>
<body>
	<div class="container">
    <div class="hero-unit">
    
	<div class="row">
		<div class="span6">
			<h1>Perhitungan Suara</h1>
		</div>
		<div class="span3">
			
			<h3>Jumlah total suara : </h3>
		</div>
	</div>		
    <br/>		
	<div class="row">
    	<div class="span6">
			<button id="mulai" class="btn btn-success btn-large"  autofocus>Hitung suara</button>
		</div>
		<div class="span4">
			<div class="row-fluid">
            	<table>
	                <td><div class="span3" align="center">Suara terhitung<h1><span id="nomer">0</span></h1></div></td>
                    <td>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</td>
                    <td><div class="span3" align="center">Suara tersisa<h1><span id="nomersisa">0</span></h1></div></td>
					<td>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</td>
                    <td><div class="span3" align="center">Persentase Suara terhitung<h1><span id="persentase">0</span>%</h1></div></td>
                </table>
			</div>
		</div>
	</div>
    <hr style="border-color:#000;"/>
    <div class="row">
    	<div class="span6"> 

		</div>
        <div class="span4">
    		<table border="0">
            <tr><div class="span3" style="font-size:50px;padding-top:40px;color:#0e90d2;">ID . <span id="id" style="font-size:100px;">-</span></div></tr>
				<td><div class="span3" align="right" style="font-size:50px; padding-top:50px;">Suara<h1><span id="vote" style="color:#0e90d2;font-size:200px;"> - </span></h1></div></td>
    		</table>
    	</div>
    </div> 
    <hr style="border-color:#000;">
    
<!-- /container -->
	<script>
		 //setTimeout(function(){
		var total= <?php echo $num_suara; ?>;	 
		var ii = 0;
		var inc = 0;
		var hitung =1;
		
		function getSuara(id) {
			$.post("ajax-handler.php", {operation: 4, limit: id}, function(q) {
				s = q.split("+");
				r = s[1];
				$("#spoil").html('<h1>' + r + '</h1>');
				$("#vote").html('<h1 id="style_vote">' + r + '</h1>');
				$("#id").html(s[0]);
				$("#nomer").text(ii);
				$("#persentase-" + r).text(Number((Number($("#store-" + r).val())+Number(hitung))*100/total).toFixed(2));
				$("#persentase").text((ii*100/total).toFixed(2));
				$("#nomersisa").text(total-ii);
				$("#store-" + r).val(Number($("#store-" + r).val()) + 1);
				$("#bar-" + r).css('width', String(Number($("#store-" + r).val())*inc) + '%');
				$("#bar-" + r).text($("#store-" + r).val() + ' suara');
			});
		}
        
        inc = 100/total;
        
        $("#mulai").click(function() {
			if (ii<total) {
				getSuara(ii);
				ii++;
				if (ii>=total) {
					$("#spoil").html('<h1> - </h1>');
					$("#nomer").text(1);
								};
							};
				});
		</script>
       <div class="copy" style="margin-top:0px;">
		   <p>&copy; Design by HIMA STSN </p>
	   </div>
</body>

</html>
