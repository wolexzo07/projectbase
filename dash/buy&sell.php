<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">
<h3 class="yii"><font style="color:green;"><i class="glyphicon glyphicon-shopping-cart"></i> Buy & Sell</font> Project(s)<br/><small>Buy and sell a completed final year projects, Theses and Dissertations</small></h3>

<div class="row">

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
		<button onclick="load('buyprojectbase')" id="boxmo" class="btn btn-success">
			<span class="fa fa-shopping-cart gll"></span>
			<br/><br/>
			<p class="tti">Buy Completed Project</p>
			</button>
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
				<button onclick="load('sellprojectbase')" id="boxmo" class="btn btn-primary">
			<span class="fa fa-money gll"></span>
			<br/><br/>
			<p class="tti">Sell Completed Project</p>
			</button>
			</div>
			
			<?php include("ads.php");?>
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
			<?php include_once("propost.php");?>
			</div>
			
			
			

</div>

</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
</div>
