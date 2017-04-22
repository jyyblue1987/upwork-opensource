define(function (require) {
    
    /**
     * LOAD DEPENDENCIES
     */
    var $           = require('jquery'),
        bootstrap   = require('bootstrap');
        
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
    if( container)
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
            console
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
    
    $(document).on('click', '#chat-submit', function () {
        
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
        var jqXhr = $.post(site_url + 'messageboard/post_message', form_data, $.noop, 'json');
        
        jqXhr.done(function(result){
            if(result.status == 'success')
            {
                var empty_message = $scroll_up.find('li.no-messages'); 
                if(empty_message && empty_message.length)
                {
                    empty_message.remove();
                }
                
                var today_group = $('#group-chat-today');
                if( today_group.length <= 0 )
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
    
    var $chat_screen     = $('.chat-screen');
    var $notif_msg_item  = $('.notif-message-details');
    var current_bid      = null;
    
    var chat_selected    = $notif_msg_item.filter('.chat-item-active');
        
    function checkForUpdate()
    {   
        if(chat_selected == null || !chat_select.length) return;
        
        var datas = { bid_id: chat_selected.data('bid'), is_ticket: chat_selected.data('ticket')};
        checkForNewMessages(datas, chat_selected);
    }
    
    
    function checkForNewMessages( datas, context ){
        
        var jqXhr = $.post(site_url + 'messageboard/load_new_message', datas, $.noop, 'json'); 

        jqXhr.done(function(result){
            
            if(current_bid !== context.data('bid')) return; //OLD SELECTED CHAT
            
            current_id = context.data('bid');
            
            $scroll_up.append( result.message );
        });
        
        jqXhr.always(function(){
            setTimeout(checkForUpdate, 5000);
        });
    }
        
    $notif_msg_item.on('click', function(event){

        event.preventDefault();

        chat_selected  = $(this);
        var datas = { bid_id: chat_selected.data('bid'), is_ticket: chat_selected.data('ticket')};
        
        if(current_bid === chat_selected.data('bid')) return;
        
        current_id = chat_selected.data('bid');

        var jqXhr = $.post(site_url + 'messageboard/load_details', datas, $.noop, 'json'); 

        jqXhr.done(function(result){
            
            if(result.status == 'success') {
                $notif_msg_item.removeClass('chat-item-active');
                chat_selected.addClass('seen chat-item-active');
                $chat_screen.html( result.message );

                notif_container  = $('#msg_container');
                chatbox          = $('textarea[name="chat_message"]');
                $chat_detail     = $('.chat-details');
                $scroll_up       = $('#scroll-ul');
                container        = document.querySelector('.expandingArea');
                $uploaded_files   = $('.uploaded_files');

                if( container)
                    makeExpandingArea( container );
                $chat_detail.animate({scrollTop: $('.chat-details').prop("scrollHeight")}, 1);

            } else {
               display_message(notif_container, 'alert-danger', 'hide', result.message);
            }
        });
        
        jqXhr.always(function(){
            //setTimeout(checkForUpdate, 5000);
        });
    });
    
    //poll new messages for active chat.
    //checkForUpdate();
});