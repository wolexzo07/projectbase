$(document).ready(function(e){
	
	$("#uploadForm").on('submit',(function(e) {
	$("#sign-in-Result").show("slow");
	$("#sign-in-Result").fadeIn(400).html('<center><img src="image/ajax-loader.gif" /></center>');
	e.preventDefault();
	$.ajax({
        	url: "loginpro",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#sign-in-Result").fadeIn(400).html(data);
		    },
		  	error: function(){} 	        
	   });
	}));
	
	$("#uploadFormnow").on('submit',(function(e) {
	$("#gallery").show("slow");
	$("#gallery").fadeIn(400).html('<center><img src="image/ajax-loader.gif" /></center>');
	e.preventDefault();
	$.ajax({
        	url: "regprocessor",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").fadeIn(400).html(data);
		    },
		  	error: function(){}
	   });
	}));
	
	$("#writepostnow").on('submit',(function(e) {
	$("#gallery").show("slow");
	$("#gallery").fadeIn(400).html('<center><img src="image/load.gif" /></center>');
	e.preventDefault();
	$.ajax({
			url: "fpine/process_post",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
					cache: false,
			processData:false,
			success: function(data){
			$("#gallery").fadeIn(400).html(data);
			$("#ptitle").val("");
			$("#ptext").val("");
				$("#pfile").val("");
				},
				error: function(){}
		 });
	}));


	$("#updatenow").on('submit',(function(e) {
	$("#gallery").show("slow");
	$("#gallery").fadeIn(400).html('<center><img src="../image/load.gif" /></center>');
	e.preventDefault();
	$.ajax({
        	url: "completeprofile",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").fadeIn(400).html(data);
		    },
		  	error: function(){}
	   });
	}));
	

	
	$("#chatme").on('submit',(function(e) {
	$("#gallery").show("slow");
	e.preventDefault();
	$.ajax({
        	url: "profbase/chatterbox",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").html(data);
			scroll_it();
			scroll_up();
			cloe();
			
			document.getElementById("pdes").value='';
		    },
		  	error: function(){} 	        
	   });
	}));

	$("#bidnow").on('submit',(function(e) {
	$("#gallery").show("slow");
	e.preventDefault();
	$.ajax({
        	url: "profbase/bidbase",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").html(data);
			document.getElementById("pdes").value='';
			document.getElementById("pin").value='';
		    },
		  	error: function(){} 	        
	   });
	}));

	$("#testifynow").on('submit',(function(e) {
	$("#gallery").show("slow");
	e.preventDefault();
	$.ajax({
        	url: "textus",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").html(data);
			document.getElementById("pdes").value='';
			document.getElementById("pin").value='';
		    },
		  	error: function(){} 	        
	   });
	}));
	
	$("#contactme").on('submit',(function(e) {
	$("#gallery").show("slow");
	e.preventDefault();
	$.ajax({
        	url: "feedbak",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").html(data);
			document.getElementById("title").value='';
			document.getElementById("pdes").value='';
			document.getElementById("pin").value='';
		    },
		  	error: function(){} 	        
	   });
	}));
	
	$("#projectpy").on('submit',(function(e) {
	$("#gallery").show("slow");
	e.preventDefault();
	$.ajax({
        	url: "paypy",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").html(data);
			document.getElementById("cat").value='';
			document.getElementById("pin").value='';
		    },
		  	error: function(){} 	        
	   });
	}));
	

	$("#verify").on('submit',(function(e) {
	$("#gallery").show("slow");
	e.preventDefault();
	$.ajax({
        	url: "verifyid",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").html(data);
			document.getElementById("identity").value='';
			document.getElementById("file").value='';
			document.getElementById("cardnum").value='';
			document.getElementById("pin").value='';
		    },
		  	error: function(){} 	        
	   });
	}));

	
	$("#bankForm").on('submit',(function(e) {
	$("#gallery").show("slow");
	e.preventDefault();
	$.ajax({
        	url: "bankpro",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").html(data);
			document.getElementById("acname").value='';
			document.getElementById("acnumb").value='';
			document.getElementById("pin").value='';
		    },
		  	error: function(){} 	        
	   });
	}));
	
	$("#writepost").on('submit',(function(e) {
	$("#gallery").show("slow");
	e.preventDefault();
	$.ajax({
        	url: "process_post",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").html(data);
			document.getElementById("title").value='';
			document.getElementById("naira").value='';
			document.getElementById("pin").value='';
			document.getElementById("pdes").value='';
			document.getElementById("datetimepicker").value='';
			document.getElementById("datetimepickerr").value='';
		    },
		  	error: function(){} 	        
	   });
	}));
	
	$("#contactus").on('submit',(function(e) {
		$("#gallery").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "contactme",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").html(data);
			$(".relv").val("");
		    },
		  	error: function(){} 	        
	   });
	}));
	
	$("#subscribebase").on('submit',(function(e) {
		$("#gallo").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "subscriber",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallo").html(data);
			$(".relvv").val("");
		    },
		  	error: function(){} 	        
	   });
	}));
	

	$("#withdraw").on('submit',(function(e) {
		$("#gallery").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "withdrawme",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").html(data);
			document.getElementById("amount").value='';
			document.getElementById("pin").value='';
		    },
		  	error: function(){} 	        
	   });
	}));
	
	$("#topitup").on('submit',(function(e) {
		$("#galleryy").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "topitup.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#galleryy").html(data);
			
			document.getElementById("amount").value='';
			document.getElementById("pin").value='';
		    },
		  	error: function(){} 	        
	   });
	}));

	$("#formaction").on('submit',(function(e) {
		$("#gallery").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "fpine/sbact",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").html(data);
			
			document.getElementById("email").value='';
			document.getElementById("word").value='';
			document.getElementById("cat").value='';
		    },
		  	error: function(){} 	        
	   });
	}));


	$("#formuser").on('submit',(function(e) {
		$("#gallery").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "fpine/formuser",
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
	
	$("#uploadproduct").on('submit',(function(e) {
		$("#gallery").show("slow");
		$("#gallery").fadeIn(400).html('<center><img src="../image/load.gif" /></center>');
		e.preventDefault();
		$.ajax({
        	url: "processbuyseller",
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

	$("#uploadjobs").on('submit',(function(e) {
		document.getElementById("bup").disabled='disabled';
			$("#gallery").show("slow");
			e.preventDefault();
			$.ajax({
				url: "upload_jobs",
				type: "POST",
				data:  new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success: function(data){
				$("#gallery").html(data);
				document.getElementById("pdes").value='';
				},
				error: function(){} 	        
		   });
		}));
	
	function chatall(str){
		$("#gallery").show("slow");
		$.ajax({
        	url: "profbase/chatmsg?"+str,
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#gallery").html(data);
			document.getElementById("pdes").value='';
		    },
		  	error: function(){} 	        
	   });
	}
	
	function readURL(input){
		var file_size = input.files[0].size / 1024;
		if(file_size > 200){
			alert("You can not upload file that exceeds 200kb in size!");
		}else{
			if(input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function (e) {
			$('#img_prev').attr('src' , e.target.result);

			};
			reader.readAsDataURL(input.files[0]);
			}	
		}
	}
	
	function validatesize(file){
		var file_size = file.files[0].size / 1024;
		if(file_size > 200){
			
			alert("File size exceeds 200kb!");
			
		}else{
			
		}
		
	}
	
	function scroll_it(){
		  $(".chatme").scrollTop($(".chatme")[0].scrollHeight);
		}
		
	function scroll_up(){
		$(".chatme").scrollTop(0);
	}
	
	function getid(elem){
		document.getElementById(elem).value="";
	}	
	
	function proform(formid,url_link,showid,extra){
	$(formid).on('submit',(function(e) {
			$(showid).show("slow");
			e.preventDefault();
			$.ajax({
				url: url_link,
				type: "POST",
				data:  new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success: function(data){
				$(showid).html(data);
					extra;
				},
				error: function(){} 	        
		   });
		}));
	}
	
	function generate_captcha(){
		$("#captcha").attr("src", "captcha.php?"+Math.random());
	}
});
