<?php
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
	<h3 class="yii"><i class="glyphicon glyphicon-edit"></i> Write <font style="color:green;">Post</font></h3>

<script type="text/javascript" src="../online.js"></script>
<form method="POST" id="writepostnow">
	<p class="title_write">Post Category:</p>
	<select required="" class="form-control slec" name="cat">
		<option value="">Select Category....</option>
		<option value="news">Write news</option>
	</select>
<p class="title_write">Enter Post Title:</p>
<input type="text" class="form-control ttx" id="ptitle" placeholder="ENTER POST TITLE" name="title"/>
<p class="title_write">Attach Image:</p>
<input type="file" name="userphoto" id="pfile" class="vphoto"/>
<p class="title_write">Enter Post content:</p>
<textarea class="form-control pdes" id="ptext" cols="" rows="" name="readpost"></textarea>
<input type="hidden" name="blessme" value="<?php echo sha1("GodOverEverything");?>"/>
<button id="bup" type="submit" class="btn btn-success"><i class="fa fa-check"></i> SUBMIT POST</button>
</form>

<div id="gallery"><img src="../image/load.gif"/></div>


</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>
