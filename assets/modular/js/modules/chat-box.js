define(['jquery', 'bootstrap'], function ($) {
    
    // APP MESSAGE BOX CLASS DEFINITION
    // =========================
    
    //GLOBAL CHATBOX VARIABLE
    var interval_id = null;  //Identifier of refresher to delete it when modal is closed.
    
    var ChatBox = function (element, options) {
        
        this.type       = null
        this.options    = null
        this.enabled    = null
        this.$element   = null
        this.options    = options
        
        this.init('chatbox', element, options)
    }
    
    ChatBox.VERSION  = '0.0.1';

    ChatBox.DEFAULTS = {
        
    }
    
    ChatBox.prototype.init = function (type, element, options) {
        this.enabled   = true
        this.type      = type
        this.$element  = $(element)
        this.box       = this.box || $(options.boxModal || this.$element.attr('data-messagebox'))
        this.bindEventsUI()
    }
    
    ChatBox.prototype.isRefresherDefined  = function(){
        return interval_id != null;
    }
    
    ChatBox.prototype.bindEventsUI  = function(){
        
        var chatbox = this;
        
        this.$element.on('click.wj.' + this.type, $.proxy(this.initializeChatBoxUI, this))
    }
    
    ChatBox.prototype.initializeChatBoxUI = function(){
        var jqxhr           = this.loadMessages(),
            chatbox         = this,
            btn_close_modal = this.box.find('._js_modal_close'),
            form_modal      = this.box.find('#conversion_message');
    
        btn_close_modal.off('click.wj.' + this.type);
        btn_close_modal.on('click.wj.' + this.type, function(event){
            event.preventDefault();
            chatbox.box.hide();
            chatbox.stopToRefreshListMessagUI();
        });
        
        form_modal.off('submit.wj.' + this.type);
        form_modal.on('submit.wj.' + this.type, function(event){
            
            event.preventDefault();
            
            var that         = $(this);
            var message      = that.find('#usermsg').val().trim();
            
            if (message.length > 0) {
                
                var messageDatas = $.param({
                    bid_id:      chatbox.options.bid, 
                    receiver_id: chatbox.options.uid, 
                    job_id:      chatbox.options.jid,
                    sender_id:   that.find('#sender_id').val(),
                    usermsg:     message
                });
                
                $.post( chatbox.options.sendto, {form: messageDatas, csrf_test_name: csrf_token}, function (data) {
                    if (data.success) {
                        that[0].reset();
                        chatbox.loadMessages();
                    } else {
                        //TODO: set a better error handler strategy here.
                        alert('Opps!! Something went wrong.');
                    }
                }, 'json');
            }
        });
        chatbox.box.find('.chat_user_name').html( this.options.uname );
        chatbox.box.find('.chat_job_title').html( this.options.title );
        
    }
    
    ChatBox.prototype.stopToRefreshListMessagUI = function(){
        
        if(interval_id){
            console.log('clear the previous interval ID');
            clearInterval(interval_id);
        }
        
    }
    
    ChatBox.prototype.loadMessages = function(){
        
        var post_datas = {
                job_bid_id: this.options.bid, 
                user_id: this.options.uid, 
                job_id: this.options.jid,
                csrf_test_name: csrf_token
            },
            that = this;
        
        jqxhr = $.post( this.options.receivefrom, post_datas, $.noop, 'json');
        
        jqxhr.done(function(data){
            that.box.find('.message_lists').html(data.html);
            that.box.show();
            that.refreshListMessageUI();
        })
    }
    
    ChatBox.prototype.refreshListMessageUI = function(){
        
        if(this.isRefresherDefined()) return; //Refresher has already been defined.
        
        this.stopToRefreshListMessagUI();
        var that = this;
        interval_id = setInterval(function(){ that.loadMessages(); }, 5000);
    }
    
    
  // CHATBOX PLUGIN DEFINITION
  // =======================
 
  function Plugin(option) {
    console.log('Initialized chatbox')
    return this.each(function () {
        var data    = $(this).data('wj.chatbox')
        var options = $.extend({}, ChatBox.DEFAULTS, $(this).data(), typeof option == 'object' && option)
        
        if (!data){
          $(this).data('wj.chatbox', (data = new ChatBox(this, options)))  
        }else{
            data.initializeChatBoxUI();
        } 
    });
  }
    
   var old = $.fn.chatbox

   $.fn.chatbox             = Plugin
   $.fn.chatbox.Constructor = ChatBox


   // CHATBOX NO CONFLICT
   // ===============

   $.fn.chatbox.noConflict = function () {
     $.fn.chatbox = old
     return this
   }
    
    
  // CHATBOX DATA-API
  // ==============

  $(document).on('click.wj.chatbox.data-api', '[data-launch="chatbox"]', function (e) {
    Plugin.call(this, $(this).data())
  })
  
});

