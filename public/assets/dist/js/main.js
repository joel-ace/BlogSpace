//Update site social media aaccounts
$(function(){
    socialUpdateButton = $('#update_social_media'),
    socialUpdateButton.click(function(submit){ 
    	submit.preventDefault();
    	$this = $(this);
    	facebook = $("#fb_").val();
    	twitter = $("#tw_").val();
    	instagram = $("#ig_").val();
    	linkedin = $("#li_").val();
    	google_plus = $("#gp_").val();

    	$(".soc_spinner").removeClass("hidden").addClass("shown");

    	$this.attr('disabled', true);

    	$.post( "index.php", { pap: "update-social-media", jmod: "others", fb: facebook, tw: twitter, ig: instagram, li: linkedin, gp: google_plus}, function(response){
    		results = JSON.parse(response);
    		if(results.completed){
		    	$this.attr('disabled', false);
		    	$("#fb_").val(results.facebook);
		    	$("#tw_").val(results.twitter);
		    	$("#ig_").val(results.instagram);
		    	$("#li_").val(results.linkedin);
		    	$("#gp_").val(results.google_plus);
		    	$(".soc_res").html(results.msg);
		    	$(".soc_spinner").removeClass("shown").addClass("hidden");
    		} else {
		    	$(".soc_res").html("<div class=\"alert alert-danger\" alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button><ul><li>Your request wasn't processed. Seems there's a glitch in the system. Please try again later</li></ul></div>");
		    	$(".soc_spinner").removeClass("shown").addClass("hidden");
    		}
    	});
    });
})

//Update site contact information
$(function(){
    site_contact_btn = $('#site_contact_btn'),
    site_contact_btn.click(function(e){ 
    	e.preventDefault();
    	$this = $(this);
    	site_name = $("#site_name").val();
    	phone = $("#phone").val();
    	email = $("#email").val();
    	address = $("#address").val();

    	$(".site_info_spinner").removeClass("hidden").addClass("shown");

    	$this.attr('disabled', true);

    	$.post( "index.php", { pap: "update-site-contact", jmod: "others", site_name: site_name, phone: phone, email: email, address: address}, function(response){
    		results = JSON.parse(response);
    		if(results.completed){
		    	$this.attr('disabled', false);
		    	$("#site_name").val(results.site_name);
		    	$("#phone").val(results.phone);
		    	$("#email").val(results.email);
		    	$("#address").val(results.address);
		    	$(".sup_res").html(results.msg);
		    	$(".site_info_spinner").removeClass("shown").addClass("hidden");
    		} else {
		    	$(".sup_res").html("<div class=\"alert alert-danger\" alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button><ul><li>Your request wasn't processed. Seems there's a glitch in the system. Please try again later</li></ul></div>");
		    	$(".site_info_spinner").removeClass("shown").addClass("hidden");
    		}
    	});
    });
})

//Update site Logo
$(function(){
    logoUpBtn = $('#upload_logo'),
    logoUpBtn.click(function(e){ 
    	e.preventDefault();
    	$this = $(this);
    	form = $("#uploadLogo");
    	fileInput = $('#logoPic');
		file_data = fileInput.prop('files')[0]; 
		formData = new FormData($('#uploadLogo')[0]);  

	    console.log(formData);

    	$this.attr('disabled', true);
    	fileInput.attr('disabled', true);

    	$(".lup_spinner").removeClass("hidden").addClass("shown");

    	if(file_data){
	    	$.post( "index.php", formData, function(response){
	    		console.log(response);
	    		// results = JSON.parse(response);
	    		// if(results.completed){
			    // 	$(".lup_res").html(results.msg);
			    // 	$this.attr('disabled', false);
		    	// 	fileInput.attr('disabled', false);
			    // 	$(".lup_spinner").removeClass("shown").addClass("hidden");
	    		// } else {
			    // 	$(".sup_res").html("<div class=\"alert alert-danger\" alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button><ul><li>Your request wasn't processed. Seems there's a glitch in the system. Please try again later</li></ul></div>");
			    // 	$(".lup_spinner").removeClass("shown").addClass("hidden");
	    		// }
	    	});
    	} else {
	    	$(".lup_res").html("<div class=\"alert alert-danger\" alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button><ul><li>Please Select a file</li></ul></div>");
	    	$(".lup_spinner").removeClass("shown").addClass("hidden");
	    	$this.attr('disabled', false);
    		fileInput.attr('disabled', false);

		}

    });
})



