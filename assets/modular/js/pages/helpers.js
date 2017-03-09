//This file will help us to define function helpers which will 
//be used by js module.

define(['jquery'], function ($) {
    return {
        getBody: function () {
            return $('body');
        },
        /**
         * 
         * @param jquery modal
         * @param int b_id
         * @param int u_id
         * @param int j_id
         * @param int url
         * @param function callback
         * @returns promise
         */
        loadmessage: function(b_id, u_id, j_id, url, callback) {
            
            var post_datas = {
                job_bid_id: b_id, 
                user_id: u_id, 
                job_id: j_id
            };
            
            var inner_callback = function(data){
                callback(data, b_id, u_id, j_id);
            }
            
            return $.post( url, post_datas, inner_callback, 'json');
            
        },
        
        onClickMessageBtn: function( context, url, callback ){
            var b_id = context.data('bid'),
                u_id = context.data('uid'),
                j_id = context.data('jid');
        
            this.loadmessage(b_id, u_id, j_id, url, callback);
        },
        
        /**
         * 
         * @param {type} modal
         * @returns {undefined}
         */
        hideMessagePopup: function ( modal ) {
            $(modal).hide();
        },
        
        /**
         * 
         * @param {string} url
         * @param {int} job_id
         * @param {int} bid_id
         * @param {int} receiver_id
         * @param {function} callback
         * @returns {jqXHR}
         */
        loadMessageAuto: function(url, job_id, bid_id, receiver_id, callback ){
            
            callback = callback || $.noop;
            
            var post_data = {
                job_bid_id: bid_id, 
                user_id:    receiver_id,
                job_id:     job_id
            };
            
            return $.post( url, post_data , callback, 'json');
        },
        
        /**
         * 
         * @param {string} conversation_form_id
         * @param {function} callback
         * @returns {void}
         */
        listenConversationSubmission: function( conversation_form_id, callback ){
            
            var form = $(conversation_form_id);
            
            if(form){
                form.on('submit', function(event){
                    event.preventDefault();
                    callback(this);
                });
            }
        }, 
        
        /**
         * 
         * @param {string} job_id
         * @param {string} bid_id
         * @param {string} receiver_id
         * @returns {undefined}
         */
        autoLoadMessage: function(url, job_id, bid_id, receiver_id, callback){
            
            var auto_job_id      = $(job_id).val();
            var auto_bid_id      = $(bid_id).val();
            var auto_receiver_id = $(receiver_id).val();

            if (auto_job_id) {
                auto_job_id = auto_job_id;
            } else {
                auto_job_id = 0;
            }

            if (auto_bid_id) {
                auto_bid_id = auto_bid_id;
            } else {
                auto_bid_id = 0;
            }

            if (auto_receiver_id) {
                auto_receiver_id = auto_receiver_id;
            } else {
                auto_receiver_id = 0;
            }

            var that = this;
            if (auto_job_id && auto_bid_id && auto_receiver_id) {
                setInterval(function(){
                    that.loadMessageAuto(url, auto_job_id, auto_bid_id, auto_receiver_id, callback);
                }, 5000);
            }
        }
    };
});

