				<script src="qrcode/src/jquery-1.11.1.min.js"></script>
			<script src="qrcode/jquery.qrcode.min.js"></script>
				<div id="output"></div>
				
			<script>
jQuery(function(){
	jQuery('#output').qrcode({width: 64,height: 64,text: "https://projectbase.ng?ref_code="});
})
</script>
