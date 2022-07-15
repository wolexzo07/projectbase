$(document).ready(function(e){
	
	$("#uploadForm").on('submit',(function(e) {
		$("#gallery").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "loginpro",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").html(data);
		    },
		  	error: function(){} 	        
	   });
	}));



	$("#formjobm").on('submit',(function(e) {
		$("#gallery").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "fpine/jm.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").html(data);
		    },
		  	error: function(){} 	        
	   });
	}));

	$("#formcur").on('submit',(function(e) {
		$("#gallery").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "fpine/jmm.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").html(data);
		    },
		  	error: function(){} 	        
	   });
	}));	
	
	

});
