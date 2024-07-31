var amount_starter_plan = '120';
var amount_basic_plan = '230';
var amount_advance_plan = '540';
var amount_professional_plan = '780';  
 
var email_filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
var password_valid = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
var file_format = /^[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/;
//test commit 2018 june 04-05
$("#wizard").bootstrapWizard({
      nextSelector: ".btn-next",
      previousSelector: ".btn-previous",
      onNext: function(tab, navigation, index) {
        var $current, $percent, $total;
         if (index == 1) {           
	        $('span.error-box').remove();

	        var file_data = $('#logo_upload').prop('files')[0];   
		    var form_data = new FormData();                  
		    form_data.append('file', file_data);
 
			var agency_name = $('form.form-personal-detail').find('input[name="agency_name"]');		
			var agent_name = $('form.form-personal-detail').find('input[name="agent_name"]');		
			var email = $('form.form-personal-detail').find('input[name="email"]');		
			var phone = $('form.form-personal-detail').find('input[name="phone"]');		
			var username = $('form.form-personal-detail').find('input[name="username"]');		
			var password = $('form.form-personal-detail').find('input[name="password"]');
			var confirm_password = $('form.form-personal-detail').find('input[name="confirm_password"]');

			var upload_logo = $('form.form-personal-detail').find('input[name="logo_upload"]');
			var logo_upload = $('#responsive_img').attr('src');
			
			var upload_logo_err = $('form.form-personal-detail').find('input[name="logo_upload_err"]');
			var mobile_err = $('form.form-personal-detail').find('input[name="mobile_err"]');
			var agency_names = form_data.append('agency_name',agency_name.val());
			var agent_names = form_data.append('agent_name',agent_name.val());
			var emails = form_data.append('email',email.val());
			var phones = form_data.append('phone',phone.val());
			var usernames = form_data.append('username',username.val());
			var passwords = form_data.append('password',password.val());
			var upload_logos = form_data.append('ad_file',upload_logo.val());
			
			var check_valid = 0;
			$.cookie("color_cok", null);
            $.removeCookie("color_cok");
			
			//if(agency_name.val()=='' || agent_name.val()=='' || email.val()=='' || phone.val()=='' || username.val()=='' || password.val()=='' || upload_logo.val()=='' || phone.val().length< 9 || !email_filter.test(email.val()) || password.val().length < 8 || password.val().length > 15 || !password_valid.test(password.val()) || password.val() != confirm_password.val() || logo_upload === undefined || logo_upload === null || upload_logo.val()!="" && !(/\.(gif|jpg|jpeg|tiff|png|bmp)$/i).test(upload_logo.val() )) {
			if(agency_name.val()=='' || agent_name.val()=='' || email.val()=='' || phone.val()=='' || username.val()=='' || password.val()=='' || phone.val().length< 9 || !email_filter.test(email.val()) || password.val().length < 8 || password.val().length > 15 || !password_valid.test(password.val()) || password.val() != confirm_password.val() ) {	
					if(agency_name.val()==""){
						agency_name.parents('div.form-group').addClass('has-error');
						$(get_error_msg(agency_name_err)).insertAfter(agency_name);			
						check_valid = 1;
					}
					if(agent_name.val()==""){ 
						agent_name.parents('div.form-group').addClass('has-error');
						$(get_error_msg(agent_name_err)).insertAfter(agent_name);			
						check_valid = 1;
					}
					if(email.val()==""){
						email.parents('div.form-group').addClass('has-error');
						$(get_error_msg(email_err)).insertAfter(email);			
						check_valid = 1;
					}			
					if(phone.val()==""){
						phone.parents('div.form-error').addClass('has-error');
						$(get_error_msg(phone_err)).insertAfter(mobile_err);			
						check_valid = 1;
					}
					if(username.val()==""){
						username.parents('div.form-group').addClass('has-error');
						$(get_error_msg(username_err)).insertAfter(username);			
						check_valid = 1;
					}
					if(password.val()==""){
						password.parents('div.form-group').addClass('has-error');
						$(get_error_msg(password_err)).insertAfter(password);			
						check_valid = 1;
					} 
					// if (upload_logo.val()!="" && !(/\.(gif|jpg|jpeg|tiff|png)$/i).test(upload_logo.val() )) {
					// 	upload_logo_err.parents('div.form-group').addClass('has-error');
					// 	$(get_error_msg(upload_logo_format_err)).insertAfter(upload_logo_err);			
					// 	check_valid = 1;	
					// }
				// 	if(logo_upload === undefined || logo_upload === null){
				// 		upload_logo_err.parents('div.form-group').addClass('has-error');
				// 		$(get_error_msg(upload_logos_err)).insertAfter(upload_logo_err);			
				// 		check_valid = 1;	
				// 	}
						
					if(password.val() != ''){
						if(password.val().length < 8){
							password.addClass('has-error-custom');
							$(get_error_msg(password_length_err)).insertAfter(password);
							check_valid = 1;
						}
						if(password.val().length > 15){
							password.addClass('has-error-custom');
							$(get_error_msg(password_length_err)).insertAfter(password);
							check_valid = 1;
						}	
					}
					
					//if(password.val().length > 8){
						if(!password_valid.test(password.val())) {
							password.addClass('has-error-custom');
							$(get_error_msg(password_valid_err)).insertAfter(password);
							check_valid = 1;
						}
					//}	

					if(password.val() != confirm_password.val()) {
							confirm_password.addClass('has-error-custom');
							$(get_error_msg(confirm_password_valid_err)).insertAfter(confirm_password);
							check_valid = 1;
					} 

					if(phone.val()!=""){
						if(phone.val().length < 9) {
							phone.parents('div.form-error').addClass('has-error');
							$(get_error_msg(valid_phone_err)).insertAfter(mobile_err);			
							check_valid = 1;
						}
					}
					if(email.val() != '' &&  !email_filter.test(email.val())) {
						email.parents('div.form-group').addClass('has-error');
						$(get_error_msg(valid_email_err)).insertAfter(email);			
						check_valid = 1;
					}
				} else {					
					
					$.ajax({
							url: base_url+"common_admin/add_personal_details/",
			                dataType: 'JSON',  // what to expect back from the PHP script, if anything
			                cache: false,
			                contentType: false,
			                processData: false,
			                data: form_data,
			                type: 'post',						
				             success : function(data) { 
				             }
				       }); 
				} if (check_valid == 1){
					return false;
			} 
        }
        else if (index == 2) {
        	$('span.error-box').remove();
        	var contract_title = $('form.form-contract-detail').find('input[name="contract_title"]');		
			var start_date = $('form.form-contract-detail').find('input[name="start_date"]');		
			var end_date = $('form.form-contract-detail').find('input[name="end_date"]');
			var membership_plan = $('form.form-contract-detail').find('input[name="membership_plan"]');
			//var membership_plan = $('form.form-contract-detail').find('#membership_plan option:selected');	
			var membership_plans_err = $('form.form-contract-detail').find('input[name="membership_plans_err"]');				
			var check_valid = 0;
        	if(contract_title.val()=='' || start_date.val()=='' || end_date.val()=='' || membership_plan.val()=="" || start_date.val()>=end_date.val()){
				if(contract_title.val()==""){
					contract_title.parents('div.form-group').addClass('has-error');
					$(get_error_msg(contract_title_err)).insertAfter(contract_title);			
					check_valid = 1;
				}
				if(start_date.val()==""){
					start_date.parents('div.form-group').addClass('has-error');
					$(get_error_msg(start_date_err)).insertAfter(start_date);			
					check_valid = 1;
				}
				if(end_date.val()==""){
					end_date.parents('div.form-group').addClass('has-error');
					$(get_error_msg(end_date_err)).insertAfter(end_date);			
					check_valid = 1;
				}
				if(membership_plan.val()==""){
					sweetAlert("Please Select Membership Plan!...", "", "error");
					//membership_plans_err.parents('div.form-group').addClass('has-error');
					//$(get_error_msg(membership_plan_err)).insertAfter(membership_plans_err);			
					check_valid = 1;
				}
				if(start_date.val()!="" && end_date.val()!="")
				{
					if(start_date.val()>=end_date.val())
					{
						end_date.parents('div.form-group').addClass('has-error');
						$(get_error_msg(START_END_DATE)).insertAfter(end_date);		
						check_valid = 1;										
					}
				}
			} else {

				var hash = $.cookie("color_cok");

			    if(hash == 'green'){			  
			    	$('#form_starter_plan').hide();
			        $('#form_basic_plan').hide();
			        $('#form_advance_plan').hide();
			        $('#form_professional_plan').hide();

			        //window.location.href=base_url+"common_admin/makeProductpayment/1/start_plan/"+amount_starter_plan+"";
			    }
			    if(hash == 'orange'){			      
			    	$('#form_starter_plan').hide();
			        $('#form_basic_plan').hide();
			        $('#form_advance_plan').hide();
			        $('#form_professional_plan').hide();
			      //window.location.href=base_url+"common_admin/makeProductpayment/1/basic_plan/"+amount_basic_plan+"";
			    }
			    if(hash == 'blue'){			   
			    	$('#form_starter_plan').hide();
			        $('#form_basic_plan').hide();
			        $('#form_advance_plan').hide();
			        $('#form_professional_plan').hide();   
			      //window.location.href=base_url+"common_admin/makeProductpayment/1/advance_plan/"+amount_advance_plan+"";
			    }
			    if(hash == 'red'){
			    	$('#form_starter_plan').hide();
			        $('#form_basic_plan').hide();
			        $('#form_advance_plan').hide();
			        $('#form_professional_plan').hide();
			      //window.location.href=base_url+"common_admin/makeProductpayment/1/professional_plan/"+amount_professional_plan+"";
			    }

				$.ajax({
						type: "POST",				 
						url: base_url+"common_admin/add_contract_details/",
						data:{
							contract_title : contract_title.val(),
							start_date : start_date.val(),
							end_date : end_date.val(),
							membership_plan_id : membership_plan.val()
						},
						dataType:"text",						
						cache: true,							
			             success : function(data) { 

			            }
			       }); 
	        } if(check_valid == 1) {
				return false;
			}  
        } 
        else{
       		var payment_type = $('form.form-payment-detail').find('input[name="payment_type"]:checked');        	
        	if(payment_type.val() == 'online'){
        		var hash = $.cookie("color_cok");

			    if(hash == 'green'){			  
			    	$('#form_starter_plan').hide();
			        $('#form_basic_plan').hide();
			        $('#form_advance_plan').hide();
			        $('#form_professional_plan').hide();
			        $('#starter_form').find('input[type=image]').trigger('click');
			        //window.location.href=base_url+"common_admin/makeProductpayment/1/start_plan/"+amount_starter_plan+"";
			    }
			    if(hash == 'orange'){			      
			    	$('#form_starter_plan').hide();
			        $('#form_basic_plan').hide();
			        $('#form_advance_plan').hide();
			        $('#form_professional_plan').hide();
			        $('#basic_form').find('input[type=image]').trigger('click');
			      //window.location.href=base_url+"common_admin/makeProductpayment/1/basic_plan/"+amount_basic_plan+"";
			    }
			    if(hash == 'blue'){			   
			    	$('#form_starter_plan').hide();
			        $('#form_basic_plan').hide();
			        $('#form_advance_plan').hide();
			        $('#form_professional_plan').hide();   
			        $('#advance_form').find('input[type=image]').trigger('click');
			      //window.location.href=base_url+"common_admin/makeProductpayment/1/advance_plan/"+amount_advance_plan+"";
			    }
			    if(hash == 'red'){
			    	$('#form_starter_plan').hide();
			        $('#form_basic_plan').hide();
			        $('#form_advance_plan').hide();
			        $('#form_professional_plan').hide();
			        $('#professional_form').find('input[type=image]').trigger('click');
			     // window.location.href=base_url+"common_admin/makeProductpayment/1/professional_plan/"+amount_professional_plan+"";
			    }
        		//window.location.href=base_url+"common_admin/makeProductpayment";
        	} else {
        		$.cookie("color_cok", null);
                $.removeCookie("color_cok");
        		$.ajax({
					type: "POST",				 
					url: base_url+"common_admin/add_payment_details/",
					data:{
						payment_type : payment_type.val(),
					},
					dataType:"text",						
					cache: true,							
		             success : function(data) { 
		             	$('.loader').hide();
		             	swal({ 
							  title: "Congratulation!",
							  text: "Your Rydlr account activation link has been sent to your email",
							  type: "success" 
							  },
							  function(){
							  		alert('ok');
								});	
		             			$('.swal2-confirm').click(function(){
						                window.location.href = base_url+'common_admin/view_admin_login';
						          });
		             	// swal("Congratulation!", "You have registered into Rydlr account!", "success");             		          	             			             	
		             	// window.location= base_url+"common_admin/view_admin_login";
		             }
			    }); 	
        	}
        	$('.loader').show();
        	
        	
        }
	        $total = navigation.find("li").length;
	        $current = index + 1;
	        $percent = ($current / $total) * 100;
	        return $("#wizard").find(".progress-bar").css("width", $percent + "%");
      },
      onPrevious: function(tab, navigation, index) {
        var $current, $percent, $total;
        $total = navigation.find("li").length;
        $current = index + 1;
        $percent = ($current / $total) * 100;
        return $("#wizard").find(".progress-bar").css("width", $percent + "%");
      },
      onTabShow: function(tab, navigation, index) {
        var $current, $percent, $total;
        $total = navigation.find("li").length;
        $current = index + 1;
        $percent = ($current / $total) * 100;
        return $("#wizard").find(".progress-bar").css("width", $percent + "%");
      }
    });
  
	function get_error_msg(msg){
	        return '<span class="text-danger error-box">'+msg+'</span>';
	}  	

$(document).ready(function(){
	function get_error_msg(msg){
        return '<span class="text-danger error-box">'+msg+'</span>';
    }  

    $('.update_profile').on('click', function(){
    	$('span.error-box').remove();
    	var file_data = $('#new-image').prop('files')[0];   
	    var form_data = new FormData();                  
	    form_data.append('file', file_data);

    	var agency_name = $('form.update_user_profile').find('input[name="agency_name"]');
    	var agent_name = $('form.update_user_profile').find('input[name="agent_name"]');
    	var email = $('form.update_user_profile').find('input[name="email"]');
    	var phone = $('form.update_user_profile').find('input[name="phone"]');
    	var username = $('form.update_user_profile').find('input[name="username"]');
    	var change_plan = $('form.update_user_profile').find('input[name="membership_plan"]');
    	var password = $('form.update_user_profile').find('input[name="password"]');
    	var confirm_password = $('form.update_user_profile').find('input[name="confirm_password"]');
    	var user_id = $('form.update_user_profile').find('input[name="user_id"]');
    	var membership_id = $('#membership_id');

    	var old_file = $('form.update_user_profile').find('input[name="old-image"]');
    	var new_file = $('form.update_user_profile').find('input[name="new_file"]');
    	
    	var ad_files_img = form_data.append('ad_file',new_file.val());
    	var agency_names = form_data.append('media_agency_name',agency_name.val());
    	var agent_names = form_data.append('agent_name',agent_name.val());
    	var emails = form_data.append('email',email.val());
    	var phones = form_data.append('phone',phone.val());
    	var usernames = form_data.append('username',username.val());
    	var passwords = form_data.append('password',password.val());
    	var user_ids = form_data.append('user_id',user_id.val());
    	var change_plans = form_data.append('change_plan',change_plan.val());
    	var membership_ids = form_data.append('membership_id',membership_id.val());
    	var old_files = form_data.append('old_file',old_file.val());

		var check_valid = 0;

		if(agency_name.val()=='' || agent_name.val()=='' || email.val()=='' || phone.val()=='' || username.val()=='' || password.val()=='' || phone.val().length<9 || !email_filter.test(email.val()) || password.val().length < 8 || password.val().length > 15 || password.val() != confirm_password.val()) {

				if(agency_name.val()==""){
					agency_name.parents('div.form-group').addClass('has-error');
					$(get_error_msg(agency_name_err)).insertAfter(agency_name);			
					check_valid = 1;
				}
				if(agent_name.val()==""){ 
					agent_name.parents('div.form-group').addClass('has-error');
					$(get_error_msg(agent_name_err)).insertAfter(agent_name);			
					check_valid = 1;
				}				

				if(email.val()==""){
					email.parents('div.form-group').addClass('has-error');
					$(get_error_msg(email_err)).insertAfter(email);			
					check_valid = 1;
				}			
				if(phone.val()==""){
					phone.parents('div.form-group').addClass('has-error');
					$(get_error_msg(phone_err)).insertAfter(phone);			
					check_valid = 1;
				}
				if(username.val()==""){
					username.parents('div.form-group').addClass('has-error');
					$(get_error_msg(username_err)).insertAfter(username);			
					check_valid = 1;
				}
				if(password.val()==""){
					password.parents('div.form-group').addClass('has-error');
					$(get_error_msg(password_err)).insertAfter(password);			
					check_valid = 1;
				}
				if(password.val() != '' &&  password.val().length < 8){
					password.addClass('has-error-custom');
					$(get_error_msg(password_length_err)).insertAfter(password);
					check_valid = 1;
				}
				if(password.val() != '' &&  password.val().length > 15){
					password.addClass('has-error-custom');
					$(get_error_msg(password_length_err)).insertAfter(password);
					check_valid = 1;
				}
				if(confirm_password.val() != "") {
					if(password.val() != confirm_password.val()) {
						confirm_password.addClass('has-error-custom');
						$(get_error_msg(confirm_password_valid_err)).insertAfter(confirm_password);
						check_valid = 1;		
					}
				}
				if(phone.val()!=""){
					if(phone.val().length<9){
						phone.parents('div.form-group').addClass('has-error');
						$(get_error_msg(valid_phone_err)).insertAfter(phone);			
						check_valid = 1;
					}
				}
				if(email.val() != '' &&  !email_filter.test(email.val())){
					email.parents('div.form-group').addClass('has-error');
					$(get_error_msg(valid_email_err)).insertAfter(email);			
					check_valid = 1;
				}
			} else {
				$('.loader').show();
				$.ajax({
						type: "POST",				 
						url: base_url+"common_admin/update_users_profile/",
						cache: false,
		                contentType: false,
		                processData: false,
						data:form_data,
						dataType:"JSON",						
			             success : function(data) { 
			             	$('.loader').hide();	        
			             	if(data.status == 1){
			             		swal({  
			                      title: "Congratulation!",
			                      text: "Profile has been updated successfully",
			                      type: "success" 
			                      },
			                      function(){
			                          alert('ok');
			                      }); 
			                      $('.swal2-confirm').click(function(){
			                            location.reload();
			                      });
			             	}else if(data.status == 5){
			             		swal({ 
			                      title: "",
			                      text: "Valid file types are .jpg, .jpeg and .png only.",
			                      type: "warning" 
			                      });
			             	} else {
			             		location.reload();
			             	}    		          	             			             	
			             }
			       }); 
			} if (check_valid == 1){
				return false;
			} 

    });
	

	$('.update_contact_info').on('click', function(){
		$('span.error-box').remove();
    	var name = $('form.form_contact_us').find('input[name="name"]');
    	var email = $('form.form_contact_us').find('input[name="email"]');
    	var message = $('form.form_contact_us').find('textarea[name="message"]');
		var phone = $('form.form_contact_us').find('input[name="phone"]');
		var msg_er = $('form.form_contact_us').find('input[name="msg_er"]');

		if(name.val()=='' || message.val()=='' || email.val()=='' || phone.val()=='' || !email_filter.test(email.val()) || phone.val().length<9 ) {
			
			if(name.val()=="") {
				name.parents('div.form-group').addClass('has-error');
				$(get_error_msg(name_err)).insertAfter(name);			
				check_valid = 1;
			}

			if(email.val()=="") {
				email.parents('div.form-group').addClass('has-error');
				$(get_error_msg(email_err)).insertAfter(email);			
				check_valid = 1;
			}

			if(message.val()=="") {
				msg_er.parents('div.form-group').addClass('has-error');
				$(get_error_msg('Please enter Message')).insertAfter(msg_er);			
				check_valid = 1;
			}

			if(phone.val()=="") {
				phone.parents('div.form-group').addClass('has-error');
				$(get_error_msg(phone_err)).insertAfter(phone);			
				check_valid = 1;
			}	

			if(email.val() != '' &&  !email_filter.test(email.val())) {
				email.parents('div.form-group').addClass('has-error');
				$(get_error_msg(valid_email_err)).insertAfter(email);			
				check_valid = 1;
			}
			if(phone.val() != "") {
				if(phone.val().length<9){
					phone.parents('div.form-group').addClass('has-error');
					$(get_error_msg(valid_phone_err)).insertAfter(phone);			
					check_valid = 1;
				}	
			}
		} else {
			$('.loader').show();
			$('#membership_plan').val('');
        	var tst = $('#membership_plan').val('contact_request - 00 SH');
        	//Professional Plan - 51000 SH
			$.ajax({
						type: "POST",				 
						url: base_url+"common_admin/update_contact_info/",
						data:{
							name : name.val(),
							email : email.val(),
							phone : phone.val(),
							message : message.val()
						},
						dataType:"JSON",						
			             success : function(data) {
			             	$('.loader').hide();	
			             	if(data.status == 1){
			             		$('#myModal1').modal('hide');
			             		$('#myModal').modal('hide');
			             	} else {
			             		alert('fail');
			             	}    		          	             			             	
			             }
			}); 
		}

	});
	

	$('#upload_multiple_docs').on('click', function(){
		var form_data = new FormData();
        var ins = document.getElementById('multiFiles').files.length;

        for (var x = 0; x < ins; x++) {
            form_data.append("files[]", document.getElementById('multiFiles').files[x]);
        }

        var contract_id = $('form.form_update_multiple_docs').find('input[name="contract_id"]');
        var contract_ids  = form_data.append('contract_id', contract_id.val()); 
        $('.loader').show();
        $.ajax({
            url: base_url+'common_admin/upload_multiple_docs', // point to server-side PHP script 
            dataType: 'JSON',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(data){
            	$('.loader').hide();
            	if(data.status == '1'){
            		window.location.href = base_url+'common_admin/view_admin_contract';
            	} else {
            		window.location.href = base_url+'common_admin/view_admin_contract';
            	}
                // $('#msg').html(response); // display success response from the PHP script
            }
        });
	});
	
    
    $('.add_campaign_details').on('click', function(){
    	$('span.error-box').remove();
    	var campaign_title = $('form.form_add_campaign_details').find('input[name="campaign_title"]');
    	var budget = $('form.form_add_campaign_details').find('input[name="budget"]');
    	var status = $('form.form_add_campaign_details').find('input[name="status"]:checked');
    	var plans_values = $('form.form_add_campaign_details').find('input[name="plan_values"]');
    	var user_type =$('form.form_add_campaign_details').find('input[name="user_type"]');
    	
    	if(campaign_title.val()=='' || /\S/.test(campaign_title.val()) == "" || budget.val()=='' || +budget.val() >= +plans_values.val() ) {
				if(campaign_title.val()==""){
					campaign_title.parents('div.form-group').addClass('has-error');
					$(get_error_msg(campaign_title_err)).insertAfter(campaign_title);			
					check_valid = 1;
				}
        		if(campaign_title.val() != ""){
        			if(/\S/.test(campaign_title.val())=="") {
						campaign_title.parents('div.form-group').addClass('has-error');
						$(get_error_msg("please enter correct title")).insertAfter(campaign_title);			
						check_valid = 1;
					}
                }
        
				if(budget.val()==""){
					budget.parents('div.form-group').addClass('has-error');
					$(get_error_msg(budget_err)).insertAfter(budget);			
					check_valid = 1;
				}
           		
       			
              if(budget.val() != "" ){                 
                 if(+budget.val() >= +plans_values.val()) {
                     budget.parents('div.form-group').addClass('has-error');
                    //$(get_error_msg('Please enter budget according to your current balance')).insertAfter(budget);			
                 	$(get_error_msg('Please enter budget according to your current balance. If you wish to upgrade your account you can do so from your profile page.')).insertAfter(budget);			
                        check_valid = 1;
                 	 }
                 }
              	  
          	  } else {
				$('.loader').show();
				$.ajax({
						type: "POST",				 
						url: base_url+"common_admin/insert_campaign_detail/",
						data:{
							campaign_title : campaign_title.val(),
							budget : budget.val(),
							status : status.val()
						},
						dataType:"JSON",						
			             success : function(data) { 
			             $('.loader').hide();	        
			             	if(data.status == 1){
			             		swal({ 
			                      title: "Congratulation!",
			                      text: "Campaign added successfully... !!",
			                      type: "success" 
			                      },
			                      function(){
			                          alert('ok');
			                      }); 
			                      $('.swal2-confirm').click(function(){
			                            window.location.href = base_url+'common_admin/view_admin_campaigns';
			                      });
			             	} else {
			             		location.reload();
			             	}    		          	             			             	
			             }
			       }); 
			}
    });

    $('.add_advertise').on('click', function(){ 
    	$('span.error-box').remove();
    	var file_data = $('#the-video-file-field').prop('files')[0];   
	    var form_data = new FormData();                  
	    form_data.append('file', file_data); 

	    var file_data1 = $('#the-photo-file-field').prop('files')[0];   
	    form_data.append('file_img', file_data1); 


	   	var campaign_id = $('form.form_add_advertise').find('#campaign_id option:selected');	
    	var ad_title = $('form.form_add_advertise').find('input[name="ad_title"]');
    	var ad_location = $('form.form_add_advertise').find('#ad_location option:selected');	
    	var ad_file = $('form.form_add_advertise').find('input[name="video_file"]');
    	var status = $('form.form_add_advertise').find('input[name="status"]:checked');
    	var spend = $('form.form_add_advertise').find('input[name="spend"]:checked');
    	var campaign_field_err = $('form.form_add_advertise').find('input[name="campaign_err"]');
    	var ad_location_field_err = $('form.form_add_advertise').find('input[name="location_err"]');
    	var ad_file_field_err = $('form.form_add_advertise').find('input[name="file_err"]');
    	var ad_description = $('form.form_add_advertise').find('textarea[name="description"]');
    	var ad_description_err = $('form.form_add_advertise').find('input[name="description_err"]');

    	var ad_video_size = $('form.form_add_advertise').find('input[name="video_upload_size"]');
    	var ad_video_duration = $('form.form_add_advertise').find('input[name="f_du"]');    	

    	var ad_file_img = $('form.form_add_advertise').find('input[name="image_file"]');
		var ad_file_image_field_err = $('form.form_add_advertise').find('input[name="image_file_err"]');

    	var campaigns_id = form_data.append('campaign_id',campaign_id.val());
    	var ads_title = form_data.append('ad_title',ad_title.val());
    	var ads_location = form_data.append('ad_location',ad_location.val());
    	var statuss = form_data.append('status',status.val());
    	var spends = form_data.append('spend',spend.val());
    	var ad_files_img = form_data.append('file_image',ad_file_img.val());
    	var ad_descriptions = form_data.append('description',ad_description.val());
    	var ad_size = form_data.append('video_size',ad_video_size.val());
    	var ad_duration = form_data.append('video_duration',ad_video_duration.val());		
		
	    
    	var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-=";
			var check = function(string){
			    for(i = 0; i < specialChars.length;i++){
			        if(string.indexOf(specialChars[i]) > -1){
			            return true
			        }
			    }
			    return false;
			}

		//for video file size and special charecter validation
			if(ad_file.val() != ''){
				var fi = document.getElementById('the-video-file-field');  //for video file
		        var fsize = fi.files.item(0).size;
		        totalFileSize = 0 + fsize;            
		        var video_name = (fi.files.item(0).name);
		        var video_size =( Math.round((fsize / 1024))); //DEFAULT SIZE IS IN BYTES SO WE DIVIDING BY 1024 TO CONVERT IT IN KB
		        var video_type = (fi.files.item(0).type);
		        video_name = video_name.replace(/\\/g, '/');
			    var video_file_name = video_name.substring(video_name.lastIndexOf('/')+1, video_name.lastIndexOf('.'));
				
			    if(check(video_file_name) == true){					
				    ad_file_field_err.parents('div.form-group').addClass('has-error');
					$(get_error_msg('Special characters are not allowed in file name. Change filename with characters only')).insertAfter(ad_file_field_err);			
					return false;
					//check_valid = 1;
				}else if(video_size > 30000){
					ad_file_field_err.parents('div.form-group').addClass('has-error');
					$(get_error_msg('Max file size 30 MB is allowed')).insertAfter(ad_file_field_err);			
					return false;
					//check_valid = 1;
				}

			}
		// for image file special charecter validation..
			if(ad_file_img.val() != ''){
				var di = document.getElementById('the-photo-file-field');	// for image file			
			    var Isize = di.files.item(0).size;
		        totalimgSize = 0 + Isize;            
		        var image_name = (di.files.item(0).name);
		        var image_size =( Math.round((Isize / 1024))); //DEFAULT SIZE IS IN BYTES SO WE DIVIDING BY 1024 TO CONVERT IT IN KB
		        var image_type = (di.files.item(0).type);
		        image_name = image_name.replace(/\\/g, '/');
			    var image_file_name = image_name.substring(image_name.lastIndexOf('/')+1, image_name.lastIndexOf('.'));

			    if(check(image_file_name) == true){					
				   ad_file_image_field_err.parents('div.form-group').addClass('has-error');
					$(get_error_msg('Special characters are not allowed in file name. Change filename with characters only')).insertAfter(ad_file_image_field_err);			
					return false;
					//check_valid = 1;	
				}

			}



    	//var val = $(this).val().toLowerCase();
		var regex = new RegExp("(.*?)\.(jpg|png|jpeg|mp4)$");
//  		if(!(regex.test(ad_file.val().toLowerCase()))) {
			
// 			alert('Please select correct file format');
// 		}  else {
//         	alert('yeh hoti hey baat');
//         }
    
    	var regex1 = new RegExp("(.*?)\.(jpg|png|jpeg)$");
//  		if(!(regex1.test(ad_file_img.val().toLowerCase()))) {
			
// 			alert('Please select correct file format');
// 		}  else {
//         	alert('yeh hoti hey baat');
//         }
    
    	
    	
//     	var allowedFiles = [".jpg", ".png", ".mp4"];
//     	var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
		
//     	var allowedFiles_image = [".jpg",".png"];
//     	var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles_image.join('|') + ")$");
    
    	if(campaign_id.val() == '0' || ad_title.val() == '' || /\S/.test(ad_title.val()) == "" || ad_location.val() == '0' || ad_file.val()=='' ||  !(regex.test(ad_file.val().toLowerCase())) ||  ad_description.val() == '' || ad_description.val().length >= '160' ){
    		if(campaign_id.val() == "0") {
				campaign_field_err.parents('div.form-group').addClass('has-error');
				$(get_error_msg(campaign_id_err)).insertAfter(campaign_field_err);			
				check_valid = 1;
			}
			if(ad_title.val() == "") {
				ad_title.parents('div.form-group').addClass('has-error');
				$(get_error_msg(ad_title_err)).insertAfter(ad_title);			
				check_valid = 1;
			}
        	if(ad_title.val() != ""){
            	if(/\S/.test(ad_title.val()) == "") {
					ad_title.parents('div.form-group').addClass('has-error');
					$(get_error_msg('Please enter correct Ad Title')).insertAfter(ad_title);			
					check_valid = 1;
				}	
            }
			if(ad_location.val() == "0") {
				ad_location_field_err.parents('div.form-group').addClass('has-error');
				$(get_error_msg(ad_location_err)).insertAfter(ad_location_field_err);			
				check_valid = 1;
			}
			if(ad_file.val() == "") {
				ad_file_field_err.parents('div.form-group').addClass('has-error');
				$(get_error_msg(ad_file_err)).insertAfter(ad_file_field_err);			
				check_valid = 1;
			}
			
        	if(ad_file.val() != ""){
				if(!(regex.test(ad_file.val().toLowerCase()))) {
					ad_file_field_err.parents('div.form-group').addClass('has-error');
					$(get_error_msg('Please enter correct file format')).insertAfter(ad_file_field_err);			
					check_valid = 1;	
				}
			}
        	
        	if(ad_file_img.val() != ""){
				if(!(regex1.test(ad_file_img.val().toLowerCase()))){
					ad_file_image_field_err.parents('div.form-group').addClass('has-error');
					$(get_error_msg('Please enter correct file format')).insertAfter(ad_file_image_field_err);			
					check_valid = 1;	
				}
			}
        	
        	
			if(ad_description.val() == "") {
				ad_description_err.parents('div.form-group').addClass('has-error');
				$(get_error_msg(ad_description_errs)).insertAfter(ad_description_err);			
				check_valid = 1;
			}
			if(ad_description.val().length >= '160') {
				ad_description_err.parents('div.form-group').addClass('has-error');
				$(get_error_msg(ad_description_length_errs)).insertAfter(ad_description_err);			
				check_valid = 1;	
			} 

   	} else {  




    	//$('.loader').show();	
    	$('.add_advertise').attr('disabled', 'disabled');
    	$('.hide_progress').show();
    	setTimeout( function(){ 			    
			$('.progress-bar').width('10%');			    
		}  , 1000 );
		setTimeout( function(){ 			    
			$('.progress-bar').width('30%');			    
		}  , 1000 );
		setTimeout( function(){ 			    
			$('.progress-bar').width('50%');			    
		}  , 5000 );
		setTimeout( function(){ 			    
			$('.progress-bar').width('70%');			    
		}  , 5000 );		

		var fi = document.getElementById('the-video-file-field');  //for video file
		        var fsize = fi.files.item(0).size;
		        totalFileSize = 0 + fsize;            
		        var video_name = (fi.files.item(0).name);
		        form_data.append('file', video_name); 

	    $.ajax({
	                url: base_url+"common_admin/insert_advertise_detail/",
	                dataType: 'JSON',  // what to expect back from the PHP script, if anything
	                cache: false,
	                contentType: false,
	                processData: false,
	                data: form_data,
	                type: 'post',
	                success: function(data){
	                	//$('.loader').hide();
	                	setTimeout( function(){ 			    
								$('.progress-bar').width('80%');			    
							}  , 5000 );	
	                    if(data.status == 1){
	                    	
	                    	setTimeout( function(){ 			    
								$('.progress-bar').width('100%');			    
								swal({ 
			                      title: "Congratulations!",
			                      text: " New ad is successfully added and sent for approval to rydlr admin / staff",
			                      type: "success" 
			                      },
			                      function(){
			                          alert('ok');
			                      }); 
			                      $('.swal2-confirm').click(function(){
			                            window.location.href = base_url+'common_admin/view_admin_advertisment';
			                      });
			                      $('.hide_progress').hide();	
							}  , 1000 );
							
		             		  
		             	} else {
		             		 location.reload(); 
		             	}
	                }
	     });	    
	} 
    });

    $('.edit_advertise').on('click', function() {
    	
    	$('span.error-box').remove();

    	var file_data = $('#the-video-file-field').prop('files')[0];  
    	
		var form_data = new FormData();                  
    	form_data.append('file', file_data); 
    	
    	var file_data1 = $('#the-photo-file-field').prop('files')[0];   
    	form_data.append('file_img', file_data1); 

	   	var campaign_id = $('form.form_edit_advertise').find('#campaign_id option:selected');	
    	var ad_title = $('form.form_edit_advertise').find('input[name="ad_title"]');
    	var ad_location = $('form.form_edit_advertise').find('#ad_location option:selected');	
    	var ad_file = $('form.form_edit_advertise').find('input[name="video_file"]');
    	var status = $('form.form_edit_advertise').find('input[name="status"]:checked');
    	var spend = $('form.form_edit_advertise').find('input[name="spend"]:checked');
    	var campaign_field_err = $('form.form_edit_advertise').find('input[name="campaign_err"]');
    	var ad_location_field_err = $('form.form_edit_advertise').find('input[name="location_err"]');
    	var ad_file_field_err = $('form.form_edit_advertise').find('input[name="file_err"]');
    	var ad_id = $('form.form_edit_advertise').find('input[name="advertise_id"]');
    	var ad_description = $('form.form_edit_advertise').find('textarea[name="description"]');
    	var ad_description_err = $('form.form_edit_advertise').find('input[name="description_err"]');
		var ad_video_format_err = $('form.form_edit_advertise').find('input[name="fetch_file_name"]');	
		var banner = $('form.form_edit_advertise').find('input[name="banner_file"]');	
    	var ad_file_img = $('form.form_edit_advertise').find('input[name="image_file"]');
    	var ad_file_img_err = $('form.form_edit_advertise').find('input[name="banner_file_err"]');
    	
    	var fetch_image_data = $('form.form_edit_advertise').find('input[name="fetch_image_data"]');
    	var ad_video_duration = $('form.form_edit_advertise').find('input[name="f_du"]');		

    	var fetch_video_data = $('form.form_edit_advertise').find('input[name="fetch_video_data"]');	
		
		var fetch_video_datas = form_data.append('files', fetch_video_data.val()); 
		var fetch_image_datas = form_data.append('file_imgs', fetch_image_data.val()); 
    	
		form_data.append('file_imgs', fetch_image_data.val());    	

    	var ads_id = form_data.append('ad_id',ad_id.val());
    	var campaigns_id = form_data.append('campaign_id',campaign_id.val());
    	var ads_title = form_data.append('ad_title',ad_title.val());
    	var ads_location = form_data.append('ad_location',ad_location.val());
    	var statuss = form_data.append('status',status.val());
    	var spends = form_data.append('spend',spend.val());
    	var ad_files_img = form_data.append('file_image',ad_file_img.val());
    	var ad_files_video = form_data.append('file_video',ad_file.val());
    	var ad_descriptions = form_data.append('description',ad_description.val());
    	var ad_duration = form_data.append('video_duration',ad_video_duration.val());
    	
    	    	
    	var regex = new RegExp("(.*?)\.(jpg|png|jpeg|mp4)$");
    
    	var regex1 = new RegExp("(.*?)\.(jpg|png|jpeg)$");
    	


    	var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-=";
			var check = function(string){
			    for(i = 0; i < specialChars.length;i++){
			        if(string.indexOf(specialChars[i]) > -1){
			            return true
			        }
			    }
			    return false;
			}

		//for video file size and special charecter validation
			if(ad_file.val() != ''){
				var fi = document.getElementById('the-video-file-field');  //for video file
		        var fsize = fi.files.item(0).size;
		        totalFileSize = 0 + fsize;            
		        var video_name = (fi.files.item(0).name);
		        var video_size =( Math.round((fsize / 1024))); //DEFAULT SIZE IS IN BYTES SO WE DIVIDING BY 1024 TO CONVERT IT IN KB
		        var video_type = (fi.files.item(0).type);
		        video_name = video_name.replace(/\\/g, '/');
			    var video_file_name = video_name.substring(video_name.lastIndexOf('/')+1, video_name.lastIndexOf('.'));
				
			    if(check(video_file_name) == true){					
				    ad_file_field_err.parents('div.form-group').addClass('has-error');
					$(get_error_msg('Special characters are not allowed in file name. Change filename with characters only')).insertAfter(ad_file_field_err);			
					return false;
					//check_valid = 1;
				}else if(video_size > 30000){
					ad_file_field_err.parents('div.form-group').addClass('has-error');
					$(get_error_msg('Max file size 30 MB is allowed')).insertAfter(ad_file_field_err);			
					return false;
					//check_valid = 1;
				}

			}
		// for image file special charecter validation..
			if(ad_file_img.val() != ''){
				var di = document.getElementById('the-photo-file-field');	// for image file			
			    var Isize = di.files.item(0).size;
		        totalimgSize = 0 + Isize;            
		        var image_name = (di.files.item(0).name);
		        var image_size =( Math.round((Isize / 1024))); //DEFAULT SIZE IS IN BYTES SO WE DIVIDING BY 1024 TO CONVERT IT IN KB
		        var image_type = (di.files.item(0).type);
		        image_name = image_name.replace(/\\/g, '/');
			    var image_file_name = image_name.substring(image_name.lastIndexOf('/')+1, image_name.lastIndexOf('.'));

			    if(check(image_file_name) == true){					
				   ad_file_img_err.parents('div.form-group').addClass('has-error');
					$(get_error_msg('Special characters are not allowed in file name. Change filename with characters only')).insertAfter(ad_file_img_err);			
					return false;
					//check_valid = 1;	
				}

			}




    		
        	if(banner.val() != "") {
            	if(!(regex1.test(banner.val().toLowerCase()))) {
					ad_file_img_err.parents('div.form-group').addClass('has-error');
					$(get_error_msg('Please enter correct file format')).insertAfter(ad_file_img_err);			
					return false;
				}
            }
    
    	if(campaign_id.val() == '0' || ad_title.val() == '' || /\S/.test(ad_title.val()) == "" || ad_location.val() == '0' ||  ad_description.val() == '' || !(regex.test(ad_video_format_err.val().toLowerCase())) || ad_description.val().length >= '160' ) {
    		if(campaign_id.val() == "0"){
				campaign_field_err.parents('div.form-group').addClass('has-error');
				$(get_error_msg(campaign_id_err)).insertAfter(campaign_field_err);			
				check_valid = 1;
			}
			if(ad_title.val() == ""){
				ad_title.parents('div.form-group').addClass('has-error');
				$(get_error_msg(ad_title_err)).insertAfter(ad_title);			
				check_valid = 1;
			}
        	if(ad_title.val() != ""){
            	if(/\S/.test(ad_title.val()) == ""){
					ad_title.parents('div.form-group').addClass('has-error');
					$(get_error_msg("Please enter correct Ad Title")).insertAfter(ad_title);			
					check_valid = 1;
				}
            }
        	
        
			if(ad_location.val() == "0"){
				ad_location_field_err.parents('div.form-group').addClass('has-error');
				$(get_error_msg(ad_location_err)).insertAfter(ad_location_field_err);			
				check_valid = 1;
			}
        	
        	if(ad_video_format_err.val() != ""){
				if(!(regex.test(ad_video_format_err.val().toLowerCase()))) {
					ad_file_field_err.parents('div.form-group').addClass('has-error');
					$(get_error_msg('Please enter correct file format')).insertAfter(ad_file_field_err);			
					check_valid = 1;	
				}
			}
        	
        
        	
			if(ad_description.val() == "") {
				ad_description_err.parents('div.form-group').addClass('has-error');
				$(get_error_msg(ad_description_errs)).insertAfter(ad_description_err);			
				check_valid = 1;
			}	
			if(ad_description.val().length >= '160') {
				ad_description_err.parents('div.form-group').addClass('has-error');
				$(get_error_msg(ad_description_length_errs)).insertAfter(ad_description_err);			
				check_valid = 1;	
			}		
			
    	} else {  
    	$('.edit_advertise').attr('disabled', 'disabled');
    	$('.hide_progress').show();
    	setTimeout( function(){ 			    
			$('.progress-bar').width('10%');			    
		}  , 1000 );
		setTimeout( function(){ 			    
			$('.progress-bar').width('30%');			    
		}  , 1000 ); 
		setTimeout( function(){ 			    
			$('.progress-bar').width('50%');			    
		}  , 5000 );
		setTimeout( function(){ 			    
			$('.progress-bar').width('70%');			    
		}  , 5000 );		
	    $.ajax({
	                url: base_url+"common_admin/update_advertise_detail/",
	                dataType: 'JSON',  // what to expect back from the PHP script, if anything
	                cache: false,
	                contentType: false,
	                processData: false,
	                data: form_data,
	                type: 'post',
	                success: function(data){
	                	setTimeout( function(){ 			    
							$('.progress-bar').width('80%');			    
							}  , 5000 );
	                    if(data.status == 1){
	                    	setTimeout( function(){ 			    
								$('.progress-bar').width('100%');	
		             		swal({ 
		                      title: "Congratulations!",
		                      text: "Ad successfully updated!!",
		                      type: "success" 
		                      },
		                      function(){
		                          alert('ok');
		                      }); 
		                      $('.swal2-confirm').click(function(){
		                            window.location.href = base_url+'common_admin/view_admin_advertisment';
		                      }); 
		                   }  , 1000 );   
		             	} else {
		             		window.location.href = base_url+'common_admin/view_admin_advertisment';
		             		//alert('not ok');
		             	}

	                }
	     	});
		} 
    });
	
	$("#datatable-editable").on("click", ".delete_advertise", function(){
    	
    	//var ad_id = $('form.advertise_remove').find('input[name="ad_id"]');	 
    	var ad_id = $(this).closest('td').find('span#ad_id').text();
    	//var ad_id = $('#ad_id').val();   
    	console.log(ad_id);
    	//var vars = $('#ad_id').closest('table').attr('id');
		//console.log(vars);
		swal({
			  title: 'Are you sure?',
			  text: "You won't delete this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then(function () {
				$('.loader').show();
			  $.ajax({
				type: "POST",				 
				url: base_url+"common_admin/delete_ads/",
				data:{
					advertise_id : ad_id,
				},
				dataType:"JSON",						
				cache:false,
	             success : function(data) { 
	             	$('.loader').hide();
		            if(data.status == '1') {
		            	var vars = $('#ad_id').closest('tr').remove();
	            		swal({ 
		                      title: "Delete!",
		                      text: "successfully deleted",
		                      type: "success" 
		                      },
		                      function(){
		                          alert('ok');
		                      }); 
		                      $('.swal2-confirm').click(function(){
		                            window.location.href = base_url+'common_admin/view_admin_advertisment';
		                      }); 
		            } else {
		            	location.reload();
		            }
	            }
			});
			})
    });

    $("#datatable-editable").on("click", ".approve_status", function(){
    	//var ad_id = $('form.advertise_remove').find('input[name="ad_id"]');	 
    	var approve_id = $(this).closest('td').find('span#approve_id').text();
    	//var ad_id = $('#ad_id').val();   
    	//var vars = $('#ad_id').closest('table').attr('id');
		//console.log(vars);
		swal({
			  title: 'Are you sure?',
			  text: "You won't approve this ad!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, approve it!'
			}).then(function () {
			  $.ajax({
				type: "POST",				 
				url: base_url+"common_admin/update_approval_status/",
				data:{
					approve_id : approve_id,
				},
				dataType:"JSON",						
				cache:false,
	             success : function(data) { 
		            if(data.status == '1'){
	            		swal({ 
		                      title: "Approved!",
		                      text: "The Ad has been approved and available for all riders",
		                      type: "success" 
		                      },
		                      function(){
		                          alert('ok');
		                      }); 
		                      $('.swal2-confirm').click(function(){
		                            window.location.href = base_url+'common_admin/view_admin_advertisment';
		                      }); 
		            } else {
		            	location.reload();
		            }
	            }
			}); 
		})
	});

	$('.search_campaign_name').on('click', function(){
		$('.loader').show();
		var campaign_id =  $('#select_campaign').val();
		var status = $('form.form_search_campaign').find('input[name="campaign_status"]:checked').val();
		var get_ads_count = $('#campaign_ads_count').val();
		
		$.ajax({
				type: "POST",				 
				url: base_url+"common_admin/search_campaign/",
				data:{
					campaign_id : campaign_id,
					campaign_status : status
				},
				dataType:"JSON",						
				cache:false,
	             success : function(data) {
	             		$('.loader').hide();
     					$(".dataTables_wrapper").remove();
     					if(data.status == 0){
     						htmls +='<table class="table table-bordered table-striped  tbl_search_campaign" id="datatable-editable">';
							htmls += '<thead><tr>';
							htmls += '<th> Campaign Name </th>';
							htmls += '<th> Budget ($) </th>';
							htmls += '<th> Ad Spend ($) </th>';
							htmls += '<th> Status </th>';
							htmls += '<th> Total Ads </th>';
							htmls += '<th> Contract </th>';
							htmls += '<th width="60"></th>';
                    		htmls += '<th width="65"></th>';
                    		htmls += '<th width="65"></th>';
							htmls += '</tr></thead><tbody>';		            
							
								'<tr><td>' + '' +
								'</td><td>' + '' + 
								'</td><td>' + '' + 
								'</td><td>' + '<center> no data found </center> ' +
								'</td><td>' + '' +
								'</td><td>' + '' +
								'</td><td>'+ ' ' +
								'</td><td>'+ '' +
								'</td><td>'+ ' ' +
								'</td>'+ ''+
								'</td></tr>';
							htmls +='</thead></tbody>';	
							htmls +='</thead></tbody>';	
							
							$(".table-responsive").append(htmls);
							$('.loader-search').addClass('hide');
							$('#datatable-editable').dataTable({
								columnDefs: [{
									orderable: false, targets: -1
								}], 
								stateSave: true
							});
							$('[data-toggle="tooltip"]').tooltip();	
     					} else{
                        	
							var htmls = '';
							htmls +='<table class="table table-bordered table-striped  tbl_search_campaign" id="datatable-editable">';
							htmls += '<thead><tr>';
							htmls += '<th> Campaign Name </th>';
							htmls += '<th> Budget ($) </th>';
							htmls += '<th> Ad Spend ($) </th>';
							htmls += '<th> Status </th>';
							htmls += '<th> Total Ads </th>';
							htmls += '<th> Contract </th>';
							htmls += '<th width="60"></th>';
                    		htmls += '<th width="65"></th>';
                    		htmls += '<th width="65"></th>';
							htmls += '</tr></thead><tbody>';		            
							// htmls += '<input type="hidden" name="campaign_id" id="campaign_id_edit" value="'+data.id+'"><input type="hidden" name="campaign_title" id="campaign_title" value="'+data.title+'"><input type="hidden" name="campaign_budget" id="campaign_budget" value="'+data.budget+'"><input type="hidden" name="campaign_status" id="campaign_status" value="'+data.status+'"><input type="hidden" name="campaign_ads_count" id="campaign_ads_count" value="'+data.ad_title+'">';
                        	$.each(data, function(i, value) {
							edit = '<td> <a class="edit_campaign" href="'+base_url+'common_admin/edit_admin_campaign/'+value.campaign_id+'" ><i class="fa fa-pencil"></i> </a></td>';
							// edit = '<td> <a class="edit_campaign" href="#" data-toggle="modal" data-target="#myModal1" onclick="edit_campaign('+value.id+')" ><i class="fa fa-pencil"><span class="hidden" name="campaign_id" id="campaign_id"> '+value.id+' </span> <span class="hidden" name="campaign_title" id="campaign_title"> '+value.title+' </span> <span class="hidden" name="campaign_budget" id="campaign_budget"> '+value.budget+' </span> <span class="hidden" name="campaign_status" id="campaign_status"> '+value.status+' </span> </i> </a></td>';
							deletes = '<td> <a class="delete_campaign" href="#" onclick="delete_campaigns('+value.campaign_id+')"><i class="fa fa-trash-o"> <span class="hidden" name="campaign_id" id="deleted_id"> '+value.campaign_id+' </span>  </i></a> </td>';
							view  = '<td> <a class="" href="'+base_url+'common_admin/read_view_admin_campaign/'+value.campaign_id+'"><i class="fa fa-eye"></i></a> </td>';

							htmls +=
							
							'</td><td>' + value.title +
							'</td><td>' + value.budget + 
							'</td><td>' + value.ad_spend + 
							'</td><td>' + value.status +
							'</td><td>' + value.ads_count +
							'</td><td>' + value.contract_title +
							'</td>'+ edit + view + deletes+
							'</td></tr>';
                            });
							htmls +='</thead></tbody>';	

							
							$(".table-responsive").append(htmls);
							$('.loader-search').addClass('hide');
							$('#datatable-editable').dataTable({
								columnDefs: [{
									orderable: false, targets: -1
								}],
								stateSave: true
							});
							$('[data-toggle="tooltip"]').tooltip();	
							// '</td><td> <a href="'+base_url+'admin/view_fixer_details/'+value.id+'"><span data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="fa fa-eye edit-icon"></i></span></a>'+edit+deletes+ approve
							// '</td></tr>';
	
						}	
	            }
			}); 
	});

	$('.search_advertisements').on('click', function(){
		
		$('.loader').show();
		var campaign_id =  $('#select_campaign_advertise').val();
		var status = $('form.form_search_campaign_advertise').find('input[name="campaign_status"]:checked').val();

		$.ajax({
				type: "POST",				 
				url: base_url+"common_admin/search_campaign_ads/",
				data:{
					campaign_id : campaign_id,
					campaign_status : status
				},
				dataType:"JSON",						
				cache:false,
	             success : function(data) {
	             	
	             	$('.loader').hide();
     					$(".dataTables_wrapper").remove();
     					if(data.status == 0){
                            var htmls = '';
     						htmls +='<table class="table table-bordered table-striped  tbl_search_campaign_advertise" id="datatable-editable">';
							htmls += '<thead><tr>';
							htmls += '<th> Ad Name </th>';
							htmls += '<th> Campaign Name </th>';
							htmls += '<th> Status </th>';
							htmls += '<th> Spend </th>';
							htmls += '<th> Approval Status </th>';
                        	htmls += '<th width="60"> View </th>';
							htmls += '<th width="60"> Edit </th>';
                    		htmls += '<th width="65"> Delete </th>';
                    		htmls += '<th width="65"> Target Ads </th>';
							htmls += '</tr></thead><tbody>';		            
							htmls += '<tr><td>' + '</td>' +
							'<td>' + '</td>' + 
							'<td>' + '</td>' + 
							'<td>' + '<center> no data found </center> </td>' +
							'<td>' + '</td>' +
							'<td>' + '</td>' +
							'<td>'+ '</td>' +
                            '<td>'+ '</td>' +
							'<td>'+ '</td>' +
							//'</td>'+ ''+
							'</tr>';
							htmls +='</thead></tbody>';	
							
							$(".table-responsive").append(htmls);
							$('.loader-search').addClass('hide');
							$('#datatable-editable').dataTable({
								columnDefs: [{
									orderable: false, targets: -1
								}],
								stateSave: true
							});
							$('[data-toggle="tooltip"]').tooltip();	
     					} else{

     						// if("<?php echo isset($_SESSION['admin_login'];)?>"){
     							// <?php if(isset($_SESSION['admin_login'])){ ?>
								var htmls = '';
								htmls +='<table class="table table-bordered table-striped  tbl_search_campaign_advertise" id="datatable-editable">';
								htmls += '<thead><tr>';
								htmls += '<th> Ad Name </th>';
								htmls += '<th> Campaign Name </th>';
								htmls += '<th> Status </th>';
								htmls += '<th> Spend </th>';
								htmls += '<th> Approval Status </th>';
                        		//htmls += '<th> View </th>';
                        		htmls += '<th> Action </th>';
								//htmls += '<th width="60"> Edit </th>';
	                    		//htmls += '<th width="65"> Delete </th>';
	                    		//htmls += '<th width="65"> Target Ads </th>';
								htmls += '</tr></thead><tbody>';		            
								// htmls += '<input type="hidden" name="campaign_id" id="campaign_id_edit" value="'+data.id+'"><input type="hidden" name="campaign_title" id="campaign_title" value="'+data.title+'"><input type="hidden" name="campaign_budget" id="campaign_budget" value="'+data.budget+'"><input type="hidden" name="campaign_status" id="campaign_status" value="'+data.status+'"><input type="hidden" name="campaign_ads_count" id="campaign_ads_count" value="'+data.ad_title+'">';
								// edit = '<td> <a class="edit_campaign" href="#" data-toggle="modal" data-target="#myModal1" onclick="edit_campaign()" ><i class="fa fa-pencil"><span class="hidden" name="campaign_id" id="campaign_id"> '+data.id+' </span> <span class="hidden" name="campaign_title" id="campaign_title"> '+data.title+' </span> <span class="hidden" name="campaign_budget" id="campaign_budget"> '+data.budget+' </span> <span class="hidden" name="campaign_status" id="campaign_status"> '+data.status+' </span> </i> </a></td>';
								// deletes = '<td> <a class="delete_campaign" href="#" onclick="delete_campaigns()"><i class="fa fa-trash-o"> <span class="hidden" name="campaign_id" id="deleted_id"> '+data.id+' </span>  </i></a> </td>';
								// view  = '<td> <a class="" href="#"><i class="fa fa-eye"></i></a> </td>';
								$.each(data, function(i, value) {
							  	var approval_status_var = '';
                                
							 //  	if(value.approval_status == 0){
							 //  		approval_status_var = '<td><span class="label label-warning">Approval Pending</span></td>';
							 //  		edit = '<td><a href="'+base_url+'common_admin/view_edit_admin_advertisement/'+value.id+'"><i class="fa fa-pencil"></i></a></td>';
								// deletes = '<td><a class="delete_advertise" href="#" onclick="delete_advertise()"><i class="fa fa-trash-o"> <span class="hidden" name="ad_id" id="ad_id"> '+value.id+' </span> </i></a></td>';
								// targets = '<td><a class="span_id" href="'+base_url+'common_admin/view_target_advertise/'+value.id+'"><i class="fa fa-sitemap"> <span class="hidden" id="ading_id"> '+value.id+' </span> <span class="hidden" id="campaign_title"> '+value.id+' </span> <span class="hidden" id="ads_title"> '+value.ad_title+' </span> </i> </a></td>';
                                
							 //  	} else {
        //                         	approval_status_var = '<td><span class="label label-success">Approved</span></td>';
							 //  		edit = '<td></td>';
								// 	deletes = '<td></td>';
								// 	targets = '<td></td>';
							  		
							 //  	}

							 	if(value.approval_status == 0){
							  		approval_status_var = '<span class="label label-warning">Approval Pending</span>';
							  		view = '<a href="'+base_url+'common_admin/view_only_admin_advertisement/'+value.id+'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>'
									edit = '<a href="'+base_url+'common_admin/view_edit_admin_advertisement/'+value.id+'"><i class="fa fa-pencil"></i></a>';
									deletes = '<a class="delete_advertise" href="#" onclick="delete_advertise('+value.id+')"><i class="fa fa-trash-o"> <span class="hidden" name="ad_id" id="ad_id"> '+value.id+' </span> </i></a>';
									targets = '<a class="span_id" href="'+base_url+'common_admin/view_target_advertise/'+value.id+'"><i class="fa fa-sitemap"> <span class="hidden" id="ading_id"> '+value.id+' </span> <span class="hidden" id="campaign_title"> '+value.id+' </span> <span class="hidden" id="ads_title"> '+value.ad_title+' </span> </i> </a>';
							  	
							  	} else {
							  		approval_status_var = '<span class="label label-success">Approval</span>';
							  		view = '<a href="'+base_url+'common_admin/view_only_admin_advertisement/'+value.id+'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>'
							  		edit = '';
							  		deletes = '';
							  		targets = '<a class="span_id" href="'+base_url+'common_admin/view_target_advertise/'+value.id+'"><i class="fa fa-sitemap"> <span class="hidden" id="ading_id"> '+value.id+' </span> <span class="hidden" id="campaign_title"> '+value.id+' </span> <span class="hidden" id="ads_title"> '+value.ad_title+' </span> </i> </a>';

							  		
							  	}

                                if(value.status == 'Active'){
                                	ad_status = 'Active';
                                } else {
                                    ad_status = 'Inactive';
                                }
                                if(value.spend == 'CPM'){
                                	spend = 'CPM';
                                } else {
                                    spend = 'CPV';
                                }
									
                              //  view = '<td><a href="'+base_url+'common_admin/view_only_admin_advertisement/'+value.id+'"><i class="fa fa-eye"></i></a></td>';
                                
								htmls +=
								'</td><td>' + value.ad_title +
								'</td><td>' + value.title + 
								'</td><td>' + ad_status +
								'</td><td>'+ spend +
								'</td><td>' + approval_status_var +
                                '</td><td>' + view +" "+ edit +" "+ deletes +" "+ targets +
								// '</td><td>' + data.contract_title +
								//''+ edit + deletes + targets+
								'</td></tr>';
								});
								htmls +='</thead></tbody>';	   
							


							$(".table-responsive").append(htmls);
							$('.loader-search').addClass('hide');
							$('#datatable-editable').dataTable({
								columnDefs: [{
									orderable: false, targets: -1
								}],
								stateSave: true
							});
							$('[data-toggle="tooltip"]').tooltip();	
							// '</td><td> <a href="'+base_url+'admin/view_fixer_details/'+value.id+'"><span data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="fa fa-eye edit-icon"></i></span></a>'+edit+deletes+ approve
							// '</td></tr>';
	
						}	
	             }
	         });

	});	

	$('.search_advertisements_for_admin').on('click', function(){
		
		$('.loader').show();
		var campaign_id =  $('#select_campaign_advertise').val();
		var status = $('form.form_search_campaign_advertise').find('input[name="campaign_status"]:checked').val();
		
		$.ajax({
				type: "POST",				 
				url: base_url+"common_admin/search_campaign_ads/",
				data:{
					campaign_id : campaign_id,
					campaign_status : status
				},
				dataType:"JSON",						
				cache:false,
	             success : function(data) {
	             	
	             	$('.loader').hide();
     					$(".dataTables_wrapper").remove();
     					if(data.status == 0){
     						htmls +='<table class="table table-bordered table-striped  tbl_search_campaign_advertise" id="datatable-editable">';
							htmls += '<thead><tr>';
							htmls += '<th> Media Agency Name </th>';
							htmls += '<th> Ad Name </th>';
							htmls += '<th> Campaign Name </th>';
							htmls += '<th> Status </th>';
							htmls += '<th> Spend </th>';
							htmls += '<th> Approval Status </th>';
							htmls += '<th> Approve </th>';
							htmls += '<th width="60"> Edit </th>';
                    		htmls += '<th width="65"> Delete </th>';
                    		htmls += '<th width="65"> Target Ads </th>';
							htmls += '</tr></thead><tbody>';		            
							'<tr><td>' + '' +
							'</td><td>' + '' + 
							'</td><td>' + '<center> no data found </center> ' +
							'</td><td>' + '' +
							'</td><td>' + '' +
							'</td><td>' + '' +
							'</td><td>'+ '' +
							'</td><td>'+ ' ' +
							'</td>'+ ''+
							'</td></tr>';
							htmls +='</thead></tbody>';	
							
							$(".table-responsive").append(htmls);
							$('.loader-search').addClass('hide');
							$('#datatable-editable').dataTable({
								columnDefs: [{
									orderable: false, targets: -1
								}],
								stateSave: true
							});
							$('[data-toggle="tooltip"]').tooltip();	
     					} else{

     						// if("<?php echo isset($_SESSION['admin_login'];)?>"){
     							// <?php if(isset($_SESSION['admin_login'])){ ?>
								var htmls = '';
								htmls +='<table class="table table-bordered table-striped  tbl_search_campaign_advertise" id="datatable-editable">';
								htmls += '<thead><tr>';
								htmls += '<th> Media Agency Name </th>';
								htmls += '<th> Ad Name </th>';
								htmls += '<th> Campaign Name </th>';
								htmls += '<th> Status </th>';
								htmls += '<th> Spend </th>';
								htmls += '<th> Approval Status </th>';
								htmls += '<th> Approve </th>';
								htmls += '<th> Action </th>';
								//htmls += '<th width="60"> Edit </th>';
	                    		//htmls += '<th width="65"> Delete </th>';
	                    		//htmls += '<th width="65"> Target Ads </th>';
								htmls += '</tr></thead><tbody>';		            
								// htmls += '<input type="hidden" name="campaign_id" id="campaign_id_edit" value="'+data.id+'"><input type="hidden" name="campaign_title" id="campaign_title" value="'+data.title+'"><input type="hidden" name="campaign_budget" id="campaign_budget" value="'+data.budget+'"><input type="hidden" name="campaign_status" id="campaign_status" value="'+data.status+'"><input type="hidden" name="campaign_ads_count" id="campaign_ads_count" value="'+data.ad_title+'">';
								// edit = '<td> <a class="edit_campaign" href="#" data-toggle="modal" data-target="#myModal1" onclick="edit_campaign()" ><i class="fa fa-pencil"><span class="hidden" name="campaign_id" id="campaign_id"> '+data.id+' </span> <span class="hidden" name="campaign_title" id="campaign_title"> '+data.title+' </span> <span class="hidden" name="campaign_budget" id="campaign_budget"> '+data.budget+' </span> <span class="hidden" name="campaign_status" id="campaign_status"> '+data.status+' </span> </i> </a></td>';
								// deletes = '<td> <a class="delete_campaign" href="#" onclick="delete_campaigns()"><i class="fa fa-trash-o"> <span class="hidden" name="campaign_id" id="deleted_id"> '+data.id+' </span>  </i></a> </td>';
								// view  = '<td> <a class="" href="#"><i class="fa fa-eye"></i></a> </td>';
								$.each(data, function(i, value) {
							  	approval_status_var = '';
							  	if(value.approval_status == 0){
							  		approval_status_var = '<span class="label label-warning">Approval Pending</span>';
							  		approve_icons = '<a class="approve_status" herf="#" onclick="approve_new_ads('+value.id+')"> <i class="fa fa-fw fa-thumbs-up"> <span class="hidden" name="approve_id" id="approve_id"> '+value.id+' </span> </i> </a>';
							  	} else {
							  		approval_status_var = '<span class="label label-success">Approval</span>';							  		
							  		approve_icons = '';
							  	}
								// edit = '<td><a href="'+base_url+'common_admin/view_edit_admin_advertisement/'+value.id+'"><i class="fa fa-pencil"></i></a></td>';
								// deletes = '<td><a class="delete_advertise" href="#" onclick="delete_advertise('+value.id+')"><i class="fa fa-trash-o"> <span class="hidden" name="ad_id" id="ad_id"> '+value.id+' </span> </i></a></td>';
								// targets = '<td><a class="span_id" href="'+base_url+'common_admin/view_target_advertise/'+value.id+'"><i class="fa fa-sitemap"> <span class="hidden" id="ading_id"> '+value.id+' </span> <span class="hidden" id="campaign_title"> '+value.id+' </span> <span class="hidden" id="ads_title"> '+value.ad_title+' </span> </i> </a></td>';
								view = '<a href="'+base_url+'common_admin/view_only_admin_advertisement/'+value.id+'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>'
								edit = '<a href="'+base_url+'common_admin/view_edit_admin_advertisement/'+value.id+'"><i class="fa fa-pencil"></i></a>';
								deletes = '<a class="delete_advertise" href="#" onclick="delete_advertise('+value.id+')"><i class="fa fa-trash-o"> <span class="hidden" name="ad_id" id="ad_id"> '+value.id+' </span> </i></a>';
								targets = '<a class="span_id" href="'+base_url+'common_admin/view_target_advertise/'+value.id+'"><i class="fa fa-sitemap"> <span class="hidden" id="ading_id"> '+value.id+' </span> <span class="hidden" id="campaign_title"> '+value.id+' </span> <span class="hidden" id="ads_title"> '+value.ad_title+' </span> </i> </a>';
								htmls +=
								'</td><td>' + value.media_agency_name +
								'</td><td>' + value.ad_title +
								'</td><td>' + value.title + 
								'</td><td>' + value.status +
								'</td><td>' + value.spend +
								'</td><td>' + approval_status_var +
								'</td><td>' + approve_icons +
								// '</td><td>' + data.contract_title +
								//'</td>'+ edit + deletes + targets+
								'</td><td>' + view +" "+ edit +" "+ deletes +" "+ targets +
								'</td></tr>';
								});
								htmls +='</thead></tbody>';	
							


							$(".table-responsive").append(htmls);
							$('.loader-search').addClass('hide');
							$('#datatable-editable').dataTable({
								columnDefs: [{
									orderable: false, targets: -1
								}],
								stateSave: true
							});
							$('[data-toggle="tooltip"]').tooltip();	
							// '</td><td> <a href="'+base_url+'admin/view_fixer_details/'+value.id+'"><span data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="fa fa-eye edit-icon"></i></span></a>'+edit+deletes+ approve
							// '</td></tr>';
	
						}	
	             }
	         });

	});	

//24/1/2018 now not in use
	// $('.edit_campaign').on('click', function(){
		
	// 	var campaign_title = $(this).closest('td').find('span#campaign_title').text();	
	// 	var campaign_id = $(this).closest('td').find('span#campaign_id').text();	
	// 	var campaign_budget = $(this).closest('td').find('span#campaign_budget').text();	
	// 	var campaign_status = $(this).closest('td').find('span#campaign_status').text();	
	// 	//console.log('campaign_title '+campaign_title+ 'campaign_id '+campaign_id+'campaign_budget '+campaign_budget+'campaign_status '+campaign_status+'');
		
	// 	var form_campaign_title = $('form.update_campaign_details').find('input[name="campaign_title"]');
	// 	var form_campaign_id = $('form.update_campaign_details').find('input[name="campaign_id"]');
	// 	var form_campaign_budget = $('form.update_campaign_details').find('input[name="budget"]');
	// 	var form_campaign_statuss = $('form.update_campaign_details').find('input[name="statuss"]');
	// 	var form_campaign_status = $('form.update_campaign_details').find('input[name="status"]:checked');
	// 	//form_campaign_status.attr('checked', true);

	// 	var white_campaign_title = campaign_title.split(' ').join('');
	// 	var white_budget = campaign_budget.split(' ').join('');

	// 	form_campaign_title.val(white_campaign_title);
	// 	form_campaign_id.val(campaign_id);
	// 	form_campaign_budget.val(white_budget);
	// 	form_campaign_statuss.val(campaign_status);
	// 	form_campaign_status.val(campaign_status);	
	// 	console.log(form_campaign_statuss.val());

	// 	if(form_campaign_statuss.val() == ' active '){			
	// 		$('form.update_campaign_details').find(':radio[name=status][value="active"]').prop('checked', true);
	// 	} else {
	// 		$('form.update_campaign_details').find(':radio[name=status][value="inactive"]').prop('checked', true);	
	// 	}
	// 	//$('form.update_campaign_details').find(':radio[name=status][value="active"]').prop('checked', true);			
	// });

	// $('.view_campaign').on('click', function(){
		
	// 	var campaign_title = $(this).closest('td').find('span#campaign_title').text();	
	// 	var campaign_id = $(this).closest('td').find('span#campaign_id').text();	
	// 	var campaign_budget = $(this).closest('td').find('span#campaign_budget').text();	
	// 	var campaign_status = $(this).closest('td').find('span#campaign_status').text();	
	// 	//console.log('campaign_title '+campaign_title+ 'campaign_id '+campaign_id+'campaign_budget '+campaign_budget+'campaign_status '+campaign_status+'');
		
	// 	var form_campaign_title = $('form.view_campaign_campaign_details').find('input[name="campaign_title"]');
	// 	var form_campaign_id = $('form.view_campaign_campaign_details').find('input[name="campaign_id"]');
	// 	var form_campaign_budget = $('form.view_campaign_campaign_details').find('input[name="budget"]');
	// 	var form_campaign_statuss = $('form.view_campaign_campaign_details').find('input[name="statuss"]');
	// 	var form_campaign_status = $('form.view_campaign_campaign_details').find('input[name="status"]:checked');
	// 	//form_campaign_status.attr('checked', true);

	// 	form_campaign_title.val(campaign_title);
	// 	form_campaign_id.val(campaign_id);
	// 	form_campaign_budget.val(campaign_budget);
	// 	form_campaign_statuss.val(campaign_status);
	// 	form_campaign_status.val(campaign_status);	
	// 	console.log(form_campaign_statuss.val());

	// 	if(form_campaign_statuss.val() == ' active '){			
	// 		$('form.view_campaign_campaign_details').find(':radio[name=status][value="active"]').prop('checked', true);
	// 	} else {
	// 		$('form.view_campaign_campaign_details').find(':radio[name=status][value="inactive"]').prop('checked', true);	
	// 	}
	// 	//$('form.update_campaign_details').find(':radio[name=status][value="active"]').prop('checked', true);			
	// });	

	$('.update_campaign_detail').on('click', function(){

		$('span.error-box').remove();
		var form_campaign_title = $('form.update_campaign_details').find('input[name="campaign_title"]');
		var form_campaign_id = $('form.update_campaign_details').find('input[name="campaign_id"]');
		var form_campaign_budget = $('form.update_campaign_details').find('input[name="budget"]');
		var form_campaign_status = $('form.update_campaign_details').find('input[name="status"]:checked');
		var plans_values = $('form.update_campaign_details').find('input[name="plan_values"]');	
    	
		var check_valid = 0;
		if(form_campaign_title.val() == '' || /\S/.test(form_campaign_title.val())=="" || form_campaign_budget.val() == '' || form_campaign_status.val() == 'undefined' || +form_campaign_budget.val() >= +plans_values.val())
		{
			if(form_campaign_title.val() == ''){
				form_campaign_title.parents('div.form-group').addClass('has-error');
				$(get_error_msg('Please enter Title')).insertAfter(form_campaign_title);			
				check_valid = 1;
			}
        	if(form_campaign_title.val() != ""){
        		if(/\S/.test(form_campaign_title.val())=="") {
					form_campaign_title.parents('div.form-group').addClass('has-error');
					$(get_error_msg('Please enter correct Title')).insertAfter(form_campaign_title);			
					check_valid = 1;
				}
            }
        	
			if(form_campaign_budget.val() == ''){
				form_campaign_budget.parents('div.form-group').addClass('has-error');
				$(get_error_msg('Please enter Budget')).insertAfter(form_campaign_budget);			
				check_valid = 1;	
			}
			if(form_campaign_status.val() == 'undefined'){
				form_campaign_status.parents('div.form-group').addClass('has-error');
				$(get_error_msg('Please select Status')).insertAfter(form_campaign_status);			
				check_valid = 1;	
			}
			if(form_campaign_budget.val() != "") {
				if(+form_campaign_budget.val() >= +plans_values.val()) {
					form_campaign_budget.parents('div.form-group').addClass('has-error');
					//$(get_error_msg('Please enter budget according to your current balance')).insertAfter(form_campaign_budget);
					$(get_error_msg('Please enter budget according to your current balance. If you wish to upgrade your account you can do so from your profile page.')).insertAfter(form_campaign_budget);			
					check_valid = 1;
					
				}
			}

		} else {

			var Inactive = "Inactive";
			//alert(form_campaign_status.val());
			if(form_campaign_status.val().match(Inactive)){

			swal({
			  title: 'Do you want to continue?',
			  text: "All ads inside the campaign will become inactive.",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes'
			}).then(function () {
			$('.loader').show();
			$.ajax({
				type: "POST",				 
				url: base_url+"common_admin/update_campaign_details/",
				data:{
					id : form_campaign_id.val(),
					title : form_campaign_title.val(),
					budget : form_campaign_budget.val(),
					status : form_campaign_status.val(),
					confirm : "yes"
				},
				dataType:"JSON",						
				cache:false,
	             success : function(data) {
	             	$('.loader').hide(); 
	             	window.location.href = base_url+'common_admin/view_admin_campaigns';
	             }
			});

				});
			}else{
				$('.loader').show();
			$.ajax({
				type: "POST",				 
				url: base_url+"common_admin/update_campaign_details/",
				data:{
					id : form_campaign_id.val(),
					title : form_campaign_title.val(),
					budget : form_campaign_budget.val(),
					status : form_campaign_status.val(),
					confirm : "no"
				},
				dataType:"JSON",						
				cache:false,
	             success : function(data) {
	             	$('.loader').hide(); 
	             	window.location.href = base_url+'common_admin/view_admin_campaigns';
	             }
			});

			}

			
		} if(check_valid == 1){
			return false;
		}

	});

	$('.delete_campaign').on('click', function(){
		var campaign_id = $(this).closest('td').find('span#deleted_id').text();	

		swal({
			  title: 'Are you sure?',
			  text: "You won't delete this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then(function () {
			  $.ajax({
				type: "POST",				 
				url: base_url+"common_admin/delete_campaigns/",
				data:{
					campaign_id : campaign_id,
				},
				dataType:"JSON",						
				cache:false,
	             success : function(data) { 
		            if(data.status == '1'){
		            	var vars = $('#ad_id').closest('tr').remove();
	            		swal({ 
		                      title: "Delete!",
		                      text: "successfully deleted",
		                      type: "success" 
		                      },
		                      function(){
		                          alert('ok');
		                      }); 
		                      $('.swal2-confirm').click(function(){
		                            window.location.href = base_url+'common_admin/view_admin_campaigns';
		                }); 
		            } else {
		            	swal(
							  'Can not be deleted!',
							  'Campaign can not be deleted it is already associated with ads',
							  'warning'
						)
		            }
	            }
			});
			})

	});
	

    $("#phone").keypress(function(event){
	        var inputValue = event.which;
	        // allow letters and whitespaces only.
	        if(inputValue > 31 && (inputValue < 48 || inputValue > 57)) { 
	            event.preventDefault(); 
	        }
	});

	$("#phone_number").keypress(function(event){
	        var inputValue = event.which;
	        // allow letters and whitespaces only.
	        if(inputValue > 31 && (inputValue < 48 || inputValue > 57)) { 
	            event.preventDefault(); 
	        }
	});

    $("#start_date").keydown(false);

    $("#end_date").keydown(false);

});	

function edit_campaign(){
		
		var campaign_title = $('span#campaign_title').text();	
		var campaign_id = $('span#campaign_id').text();	
		var campaign_budget = $('span#campaign_budget').text();	
		var campaign_status = $('span#campaign_status').text();	
		//console.log('campaign_title '+campaign_title+ 'campaign_id '+campaign_id+'campaign_budget '+campaign_budget+'campaign_status '+campaign_status+'');
		
		var form_campaign_title = $('form.update_campaign_details').find('input[name="campaign_title"]');
		var form_campaign_id = $('form.update_campaign_details').find('input[name="campaign_id"]');
		var form_campaign_budget = $('form.update_campaign_details').find('input[name="budget"]');
		var form_campaign_statuss = $('form.update_campaign_details').find('input[name="statuss"]');
		var form_campaign_status = $('form.update_campaign_details').find('input[name="status"]:checked');
		//form_campaign_status.attr('checked', true);

		form_campaign_title.val(campaign_title);
		form_campaign_id.val(campaign_id);
		form_campaign_budget.val(campaign_budget);
		form_campaign_statuss.val(campaign_status);
		form_campaign_status.val(campaign_status);	
		console.log(form_campaign_statuss.val());

		if(form_campaign_statuss.val() == ' active '){			
			$('form.update_campaign_details').find(':radio[name=status][value="active"]').prop('checked', true);
		} else {
			$('form.update_campaign_details').find(':radio[name=status][value="inactive"]').prop('checked', true);	
		}
	}
function delete_campaigns(campaign_id){
	// var campaign_id = $('span#deleted_id').text();	
	// alert(campaign_id);
		swal({
			  title: 'Are you sure?',
			  text: "You won't delete this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then(function () {
			  $.ajax({
				type: "POST",				 
				url: base_url+"common_admin/delete_campaigns/",
				data:{
					campaign_id : campaign_id,
				},
				dataType:"JSON",						
				cache:false,
	             success : function(data) { 
		            if(data.status == '1'){
		            	var vars = $('#ad_id').closest('tr').remove();
	            		swal({ 
		                      title: "Delete!",
		                      text: "successfully deleted",
		                      type: "success" 
		                      },
		                      function(){
		                          alert('ok');
		                      }); 
		                      $('.swal2-confirm').click(function(){
		                            window.location.href = base_url+'common_admin/view_admin_campaigns';
		                }); 
		            } else {
		            	swal(
							  'Can not be deleted!',
							  'Campaign can not be deleted it is already associated with ads',
							  'warning'
						)
		            }
	            }
			});
			})
}	

function delete_advertise(ad_id){
	// var ad_id = $('#datatable-editable a.delete_advertise').closest('td').find('span#ad_id').text();
	// alert(id);
    	//var ad_id = $('#ad_id').val();   
    	console.log(ad_id);
    	//var vars = $('#ad_id').closest('table').attr('id');
		//console.log(vars);
		swal({
			  title: 'Are you sure?',
			  text: "You won't delete this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then(function () {
				$('.loader').show();
			  $.ajax({
				type: "POST",				 
				url: base_url+"common_admin/delete_ads/",
				data:{
					advertise_id : ad_id,
				},
				dataType:"JSON",						
				cache:false,
	             success : function(data) { 
	             	$('.loader').hide();
		            if(data.status == '1') {
		            	var vars = $('#ad_id').closest('tr').remove();
	            		swal({ 
		                      title: "Delete!",
		                      text: "successfully deleted",
		                      type: "success" 
		                      },
		                      function(){
		                          alert('ok');
		                      }); 
		                      $('.swal2-confirm').click(function(){
		                            window.location.href = base_url+'common_admin/view_admin_advertisment';
		                      }); 
		            } else {
		            	location.reload();
		            }
	            }
			});
			})
}

function approve_new_ads(approve_id){

	// var approve_id = $('#datatable-editable a.approve_status').closest('td').find('span#approve_id').text();
	// alert(id);
    	//var ad_id = $('#ad_id').val();   
    	//var vars = $('#ad_id').closest('table').attr('id');
		//console.log(vars);
		swal({
			  title: 'Are you sure?',
			  text: "You won't approve this ad!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, approve it!'
			}).then(function () {
			  $.ajax({
				type: "POST",				 
				url: base_url+"common_admin/update_approval_status/",
				data:{
					approve_id : approve_id,
				},
				dataType:"JSON",						
				cache:false,
	             success : function(data) { 
		            if(data.status == '1'){
	            		swal({ 
		                      title: "Approved!",
		                      text: "The Ad has been approved and available for all riders",
		                      type: "success" 
		                      },
		                      function(){
		                          alert('ok');
		                      }); 
		                      $('.swal2-confirm').click(function(){
		                            window.location.href = base_url+'common_admin/view_admin_advertisment';
		                      }); 
		            } else {
		            	location.reload();
		            }
	            }
			});
		})
}

// function alpha(e) {
//     var k;
//     document.all ? k = e.keyCode : k = e.which;
//     return ( (k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || (k >= 48 && k <= 57) );
// }