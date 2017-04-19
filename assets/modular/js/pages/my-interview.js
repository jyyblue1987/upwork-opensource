define(function (require) {
    
    /**
     * LOAD DEPENDENCIES
     */
    var $                = require('jquery'),
        bootstrap        = require('bootstrap'),
        jquery_form      = require('jquery_form'),
        formValidation   = require('form_validation'),
        bootstrap_form_validation = require('bootstrap_form_validation');
        
    function makeExpandingArea(container) 
    {
        if ( window.opera && /Mac OS X/.test( navigator.appVersion ) ) {
            container
                .querySelector( 'pre' )
                .appendChild( document.createElement( 'br' ));
        }
        
        var area = container.querySelector('textarea');
        var span = container.querySelector('span');

        if (area.addEventListener) {
            area.addEventListener('input', function () {
                span.textContent = area.value;
            }, false);
            span.textContent = area.value;
        } else if (area.attachEvent) {
            // IE8 compatibility
            area.attachEvent('onpropertychange', function () {
                span.innerText = area.value;
            });
            span.innerText = area.value;
        }
        // Enable extra CSS
        container.className += ' active-textbox';
    }
    
    function removeFrom(value, table){
        var index = table.indexOf(value);
        if( index !== -1){
            table.splice(index, 1);
        }
    }

    var container = document.querySelector('.expandingArea');
    if( container )
        makeExpandingArea( container );
    
    var files_loaded = [];
    $(document).on("click.fileuploadIcon", ".attach_icon i", function () {
        $('#fileupload').trigger('click');
    });
    
    var $uploaded_files = $('.uploaded_files');
    $(document).on("change", "#fileupload", function () {
        var fileList = $('#fileupload').prop("files");
        var names    = $.map(fileList, function (val) {
            return val.name;
        });
        
        if( ! $uploaded_files.hasClass('show_files'))
            $uploaded_files.addClass('show_files');
        
        $.each(names, function (index, value) {
            if($.inArray(value, files_loaded) !== -1) return;
            files_loaded.push(value);
            $uploaded_files.append(
                '<div class = "item">' +
                   '<span class = "item_name">' + value + '</span>' +
                   '<span class = "delete_item">' +
                        '<i class="fa fa-times" aria-hidden="true"></i>' +
                   '</span>' +
                '</div>'
            );
        });
    });
    
    var removed_files = [];
    $(document).on("click.deleteItem", ".delete_item", function () {
        var img_name = $(this).prev().html();
        $(this).parent().remove();
        removed_files.push(img_name);
        removeFrom(img_name, files_loaded);
        $('#removed_files').val(removed_files);
        return false;
    });
    
    function display_message(notif_container, addClass, removeClass, message){
        notif_container.text(message);
        notif_container
            .addClass(addClass)
            .removeClass(removeClass)
            .show()
            .delay(5000)
            .fadeOut("slow", function(){
                notif_container
                    .addClass(removeClass)   
                    .removeClass(addClass);
            });
    }
    
    function fireEvent(target, evt) {
        if (document.createEvent) 
        {
            var event = new Event(evt);
            return target.dispatchEvent(event);
        }
        else 
        {
            return target.fireEvent('');
        }
    }
    
    
    var notif_container  = $('#msg_container');
    var chatbox          = $('textarea[name="chat_message"]');
    var $chat_detail     = $('.chat-details');
    var $scroll_up       = $('#scroll-ul');
    var sending_message  = false;
    
    $('#chat-submit').on('click', function () {
        
        if(sending_message) return;
        
        var message = chatbox.val();
        
        if (message == "") {
            display_message(notif_container, 'alert-danger', 'hide', 'Please enter your message')
            chatbox[0].focus();
            return false;
        }

        var form_data = new FormData($('#chat_form')[0]);
        
        $.ajaxSetup({
            cache: false,
            contentType: false,
            processData: false
        });

        sending_message  = true;
        var jqXhr = $.post(site_url + 'applicants/post_message', form_data, $.noop, 'json');
        
        jqXhr.done(function(result){
            if(result.status == 'success')
            {
                var empty_message = $scroll_up.find('li.no-messages'); 
                if(empty_message)
                {
                    empty_message.remove();
                }
                
                var today_group = $('#group-chat-today');
                if(!today_group)
                {
                    $scroll_up.append('<li id="group-chat-today"><span class="group-date"><b>Today</b></span></li>');
                }
                
                $uploaded_files.find('.item').remove();
                $uploaded_files.removeClass('show_files');
                
                $scroll_up.append(result.message);
                
                $('#chat_form')[0].reset();
                $chat_detail.animate({scrollTop: $chat_detail.prop("scrollHeight")}, 1);
                display_message(notif_container, 'alert-success', 'hide', 'Message send successfully.');
                //For IE
                fireEvent(chatbox[0],'onpropertychange');
                //For others
                fireEvent(chatbox[0], 'input');
                
            }
            else
            {
                display_message(notif_container, 'alert-danger', 'hide', result.message);
            }
        });
        
        jqXhr.always(function(){
            sending_message  = false;
        });
    });
    
    $chat_detail.animate({scrollTop: $chat_detail.prop("scrollHeight")}, 1);
    
    
    $('#btn-decline-applicant').on('click', function(){
        var x    = confirm("Are you sure! want to Decline the User?");
        var that = $(this);
               
        if (x) {
            $.post(site_url + 'jobs/bid_decline', {form: that.data('id')}, function (data) {
                if (data.success) {
                    $('.result-msg').html('You have successfully Decline the Post');
                    window.location =  site_url + "declined?job_id=" + that.data('job');
                } else {
                    alert('Opps!! Something went wrong.');
                }
            }, 'json');
        }
    });
    
    
    var $bid_amount  = $('#bid_amount');
    var $bid_fee     = $('#bid_fee');
    var $bid_earning = $('#bid_earning');
    var $jobApplyBtn = $('#jobApply');
    
    function setFee() 
    {
        var myRate = parseInt($bid_amount.val());
        
        if ( ! isNaN( myRate ) ) 
        {
            $bid_fee.val( myRate / 10 );
            $bid_earning.val( myRate - ( myRate / 10 ) );
        } 
        else 
        {
            $bid_fee.val('');
            $bid_earning.val('');
        }
    }
    
    
    setFee();
    $bid_amount.keyup(function () {
        setFee();
    });
    
    
    $jobApplyBtn.formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        message: 'This value is not valid',
        resetForm: 'true',
        fields: {
            bid_amount: {
                validators: {
                    notEmpty: {
                        message: '&nbsp;'
                    }
                }
            }
        }
    }).on('success.field.fv', function (e, data) {
        e.preventDefault();
        data.fv.disableSubmitButtons(false);

    }).on('err.field.fv', function (e, data) {
        data.fv.disableSubmitButtons(false);
    });
    
    
    var notif_interview_container = $('#notif-interview-container');
    $jobApplyBtn.ajaxForm({
        beforeSubmit: function () {
            if (! $jobApplyBtn.data('formValidation').isValid() )
            {
                return false;
            }
            else
            {
                $('input:submit').prop('disabled', true);
            }
        },
        success: function (rs) 
        {   
            var data  = JSON.parse(rs);
            var _class = 'success';
            
            if ( data.code == '0' )
            {
                $('input:submit').prop('disabled', false);
                _class = 'danger';
            }
            else
            {
                if( data.amt == '1' )
                {
                    $('#_bid_amount').text($bid_amount.val());
                    $('#_bid_earning').text($bid_earning.val());
                }
                
                $(data.modal).find('.close').click();
            }
            
            display_message(notif_interview_container, 'alert-' + _class, 'hide', data.msg);
        }
    });
});