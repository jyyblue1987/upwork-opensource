
	var objcountry=jQuery.parseJSON(countrylist);
	
	function showhidetitle(val){
	if(val=="other"){
		$("#elemotitle").removeClass("hide");
	}else{
		$("#elemotitle").addClass("hide");
		
	}
	
}

function oncheckotheroffer(val){
	if(val){
		$("#elemotherofferdata").removeClass("hide");
	}else{
		$("#elemotherofferdata").addClass("hide");
		
	}
	
}
function oncheckothermodel(val){
	if(val){
		$("#elemothermodeldata").removeClass("hide");
	}else{
		$("#elemothermodeldata").addClass("hide");
		
	}
	
}


function emailcheck(val){

	
}

function oncheckmonth (val){
if(val){
		$("#othermonthsec").show();
}else{
		$("#othermonthsec").hide();
	}
	
}
(function(document, window, $) {
  'use strict';


  (function() {
    var defaults = $.components.getDefaults("wizard");
    var options = $.extend(true, {}, defaults, {
      onInit: function() {
        $('#institueReg').formValidation({
          framework: 'bootstrap',
          fields: {
            otitle: {
                validators: {
                    callback: {
                        message: 'Please specify the title',
                        callback: function (value, validator, $field) {
                            var title = $('#institueReg').find('[name="title"] option:selected').val();
                            return (title !== 'other') ? true : (value !== '');
                        }
                    }

                }
            },
           fname: {
                validators: {
                    notEmpty: {
                        message: 'Enter Firstname'
                    }
                }
            },
            lname: {
                validators: {
                    notEmpty: {
                        message: 'Enter Lastname'
                    }
                }
            },
            institue_name: {
                validators: {
                    notEmpty: {
                        message: 'Enter institue name'
                    }
                }
            },
            institue_postal: {
                validators: {
                    notEmpty: {
                        message: 'Enter institue name'
                    }
                }
            },
        password: {
          validators: {
            notEmpty: {
              message: 'The password is required'
            },
            stringLength: {
              min: 8
            }
          }
        },
        vpassword: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    }
                }
        },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Enter Your Email'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Not valid email address'
                    },
                    callback: {
                            message: 'Free Email are not allowed',
                            callback: function (value, validator, $field) {
								    var re = '[a-zA-Z_\\.-]+@((hotmail)|(yahoo)|(gmail))\\.[a-z]{2,4}';

    if(value.match(re)){
        return false;
    } else {
        return true;
    }
	
	
                            }
					}
                }
            },
            institue_officialemail: {
                validators: {
                    notEmpty: {
                        message: 'Enter Your Email'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Not valid email address'
                    },
                    callback: {
                            message: 'Free Email are not allowed',
                            callback: function (value, validator, $field) {
								    var re = '[a-zA-Z_\\.-]+@((hotmail)|(yahoo)|(gmail))\\.[a-z]{2,4}';

    if(value.match(re)){
        return false;
    } else {
        return true;
    }
	
	
                            }
					}
                }
            }
          }
        });
      },
      validator: function() {
        var fv = $('#institueReg').data('formValidation');

        var $this = $(this);

        // Validate the container
        fv.validateContainer($this);

        var isValidStep = fv.isValidContainer($this);
        if (isValidStep === false || isValidStep === null) {
          return false;
        }

        return true;
      },
      onFinish: function() {
		  
		  
		  var sFileName=$('input#photo').val();
		  if(sFileName==""){
		toastr["warning"]("Please Select Institute Logo.");

		
		return false;
	}else{
		var isOk = true;
		
		var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    

               var maxSize = 2097153;
               var size = $("input#photo").get(0).files[0].size;
               var isOk = maxSize > size;
	if(isOk){
	}else{
		
		toastr["warning"]("Maximum 2mb file are allowed");
	 // $("#photo").val("");
		return false;
	
	}
	
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
                }
				
		 if (!blnValid) {
		toastr["warning"]("Invalid file Type");
	 // $("#photo").val("");
                return false;
            }
			
			
	}
	
   var data = new FormData();
$( "input:text" ).each(function() {
         data.append($(this).attr("name"), $(this).val());
});
$( "input:checkbox" ).each(function() {
         data.append($(this).attr("name"), $(this)[0].checked);
});
$( "textarea" ).each(function() {
         data.append($(this).attr("name"), $(this).val());
});
$( "select" ).each(function() {
         data.append($(this).attr("name"), $(this).val());
});



         var files = $("#photo").get(0).files;
         data.append("photo", files[0]);
		 
		 
         $.ajax({
             type: "POST",
             url: baseurl + 'instituesignupcheck/',
             data: data,
             contentType: false,
             processData: false,
             success: function (_d) {
 
             }
         }).fail(function (_d) {



		 
         });
		 
		 
        $('#institueReg').submit();
      },
      buttonsAppendTo: '.panel-body'
    });

    $("#instituewReg").wizard(options);
  })();


})(document, window, jQuery);







var tempval;
var tempvalb;
function selectstate(val){
	
	var tempvalb=$("#country").val();
	var tempval=val;
	
	if(val=="other"){
		
		
		 
		 $("#elemxcountry").removeClass("col-md-4");
		 $("#elemxcountry").addClass("col-md-6");
		 $("#elemxstatescity").removeClass("col-md-4");
		 $("#elemxstatescity").addClass("col-md-6");
		 $("#elemxonlycity").removeClass("col-md-4");
		 $("#elemxonlycity").addClass("col-md-6");
		 
		 
		 
		 $("#elemonlycity").addClass("hide");
		 $("#elemonlystates").addClass("hide");
		
		$("#elemxocountrytype").addClass("hide");
		$("#elemxostates").removeClass("hide");
		$("#elemxocity").removeClass("hide");
		
		
	}else{
	
		$("#elemxocountry").addClass("hide");
		$("#elemxostates").addClass("hide");
		$("#elemxocity").addClass("hide");
		
 $.each(objcountry, function( index, value ) {
	 if(tempvalb==value.id){ 

	 
	 
	 
	 if(tempval==""){
		 
		 
	 }else{
		 
		 
		 
		$.each(value.data, function( index, valuex ) {
			
			
			 if(valuex.id==tempval){
			 
			 		 $("select#onlycity").html('<option value="">Select City</option>');



$.each(valuex.data, function( index, valuexz ) {
  $("select#onlycity").append('<option value="'+valuexz.id+'">'+valuexz.name+'</option>');
});	



			 		 $("select#onlycity").append('<option value="other">Other City</option>');

			 }
			 
		});	
			
	
	
		 
		 $("#elemxcountry").removeClass("col-md-6");
		 $("#elemxcountry").addClass("col-md-4");
		 $("#elemxstatescity").removeClass("col-md-6");
		 $("#elemxstatescity").addClass("col-md-4");
		 
		 $("#elemonlycity").removeClass("hide");
		 $("#elemxonlycity").removeClass("col-md-6");
		 $("#elemxonlycity").addClass("col-md-4");
		 
	 }
	 
	 }
});	
	
}
}


function showocountrytype(val){
	
	if(val==""){
		$("#elemxocountry").addClass("hide");
		$("#elemxostates").addClass("hide");
		$("#elemxocity").addClass("hide");
		
	}else if(val=="statescity"){
		$("#elemxostates").removeClass("hide");
		$("#elemxocity").removeClass("hide");
	}else if(val=="onlycity"){
		$("#elemxostates").addClass("hide");
		$("#elemxocity").removeClass("hide");
	}else if(val=="onlystates"){
		$("#elemxostates").removeClass("hide");
		$("#elemxocity").addClass("hide");
	}
		
	
}
function selectonlycity(val){
	
	if(val=="other"){
		
		$("#elemxostates").addClass("hide");
		$("#elemxocity").removeClass("hide");
	
	}else{
		
		$("#elemxostates").addClass("hide");
		$("#elemxocity").addClass("hide");
	}
	
}
function selectonlystates(val){
	
	if(val=="other"){
		
		$("#elemxocity").addClass("hide");
		$("#elemxostates").removeClass("hide");
	
	}else{
		
		$("#elemxocity").addClass("hide");
		$("#elemxostates").addClass("hide");
	}
	
}
function selectcountry(val){
	
	var tempval=val;
	
	if(val=="other"){
		
		
		  $('[name=ocountrytype]').val("");
		 $("#elemxcountry").removeClass("col-md-6");
		 $("#elemxcountry").addClass("col-md-4");
		
		 $("#elemonlycity").addClass("hide");
		 $("#elemstatescity").addClass("hide");
		 $("#elemonlystates").addClass("hide");
		
		$("#elemxocountry").removeClass("hide");
		$("#elemxocountrytype").removeClass("hide");
		 
	}else{
		
		
		$("#elemxocountry").addClass("hide");
		$("#elemxostates").addClass("hide");
		$("#elemxocity").addClass("hide");
		
		$("#elemxocountrytype").addClass("hide");
		
 $.each(objcountry, function( index, value ) {
	 if(tempval==value.id){



		 
		 $("#elemxcountry").removeClass("col-md-4");
		 $("#elemxcountry").addClass("col-md-6");
		 $("#elemxstatescity").removeClass("col-md-4");
		 $("#elemxstatescity").addClass("col-md-6");
		 $("#elemxonlycity").removeClass("col-md-4");
		 $("#elemxonlycity").addClass("col-md-6");
		 
		 

	 
	 if(value.type=="city"){
		 
		  $('[name=ocountrytype]').val("onlycity");
		 
		 
		 
		 $("#elemonlycity").removeClass("hide");
		 $("#elemstatescity").addClass("hide");
		 $("#elemonlystates").addClass("hide");
		 
		 	
		 $("select#onlycity").html('<option value="">Select City</option>');
		 
  $.each(value.data, function( index, valuex ) {
  $("select#onlycity").append('<option value="'+valuex.id+'">'+valuex.name+'</option>');
});	

		 $("select#onlycity").append('<option value="other">Other City</option>');

		 
	 }else if(value.type=="states"){
		 
		  $('[name=ocountrytype]').val("onlystates");
		  
		 $("#elemonlystates").removeClass("hide");
		 $("#elemstatescity").addClass("hide");
		 $("#elemonlycity").addClass("hide");
		 
		  
		 $("select#onlystates").html('<option value="">Select State</option>');
		 	
  $.each(value.data, function( index, valuex ) {
  $("select#onlystates").append('<option value="'+valuex.id+'">'+valuex.name+'</option>');
});	

		 $("select#onlystates").append('<option value="other">Other States</option>');
		 
	 }else if(value.type=="statescity"){
		 
		  $('[name=ocountrytype]').val("statescity");
		  
		 $("#elemstatescity").removeClass("hide");
		 $("#elemonlystates").addClass("hide");
		 $("#elemonlycity").addClass("hide");

		 $("select#statescity").html('<option value="">Select State</option>');

$.each(value.data, function( index, valuex ) {
  $("select#statescity").append('<option value="'+valuex.id+'">'+valuex.name+'</option>');
});	

		 $("select#statescity").append('<option value="other">Other States</option>');
	 }
	 
	 
	 
	 }
});	
	
}
}



$(document).ready(function(){
	
  $.each(objcountry, function( index, value ) {
  $("select#country").append('<option value="'+value.id+'">'+value.name+'</option>');
});		
  $("select#country").append('<option value="other">Other Country</option>');

                // Basic
                $('.dropify').dropify();

                // Translated
                $('.dropify-fr').dropify({
                    messages: {
                        default: 'Glissez-déposez un fichier ici ou cliquez',
                        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                        remove:  'Supprimer',
                        error:   'Désolé, le fichier trop volumineux'
                    }
                });

                // Used events
                var drEvent = $('#input-file-events').dropify();

                drEvent.on('dropify.beforeClear', function(event, element){
                    return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
                });

                drEvent.on('dropify.afterClear', function(event, element){
                    alert('File deleted');
                });

                drEvent.on('dropify.errors', function(event, element){
                    console.log('Has Errors');
                });

                var drDestroy = $('#input-file-to-destroy').dropify();
                drDestroy = drDestroy.data('dropify')
                $('#toggleDropify').on('click', function(e){
                    e.preventDefault();
                    if (drDestroy.isDropified()) {
                        drDestroy.destroy();
                    } else {
                        drDestroy.init();
                    }
                })
            });