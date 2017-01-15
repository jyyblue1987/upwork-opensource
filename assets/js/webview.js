  


  $('#contactform').bootstrapValidator({
        excluded: ':disabled',
        message: 'not valid',
        fields: {
            email: {
                messgae: 'The Email field is required',
                validators: {
                    notEmpty: {
                        message: 'The Email is required'
                    },
                    emailAddress: {
                        message: 'Invalid Email address'

                    }
                }
            },
            name: {
                messgae: 'The Name field is required',
                validators: {
                    notEmpty: {
                        message: 'The name is required'
                    }
                }
            },
            message: {
                messgae: 'The Message field is required',
                validators: {
                    notEmpty: {
                        message: 'The Message is required'
                    }
                }
            }
        }
    }).on('success.form.bv', function (e) {
      
	  $("input#submit").html('Sending...');
        e.preventDefault();
        var data = $(this).serializeArray();
        var o = {};
        $.each(data, function () {
            o[this.name] = this.value;
        });
		$('#contactmodal').modal('show');
		
        $.ajax({
            url: "contact.php",
            dataType: "json",
            type: "POST",
            data: {
                form_data: o
            },
            success: function (data) {
			
			
			
			
			
			
			
            }
        });
    });
	
	
	
			jQuery(document).ready(function() {
			jQuery('.fancybox').fancybox();
		});
		
		
		
		function opentos(){
			
				jQuery.fancybox.open({
					href : baseurl+'tos',
					type : 'iframe',
					padding : 20
				});
				
		}
		
		function openpolicy(){
			
				jQuery.fancybox.open({
					href : baseurl+'staticpages/tos.html',
					type : 'iframe',
					padding : 20
				});
				
		}
		
		
		function scrolltocontact(){
    $('html, body').animate({
        scrollTop: $("#contacted").offset().top-50
    }, 1000);
	return true;
}

		function showerror(msg){
 toastr["error"](msg);

}
