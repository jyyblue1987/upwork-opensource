
    function editClickedMilestone(clicked_id, buser_id_value, fuser_id_value, job_id_value) {

        var key = $(this).attr('accesskey');
     
        $.ajax({
            url: site_url + "pay/add_milestone/" + clicked_id,
            data: ({key: key, buser_id: buser_id_value, fuser_id: fuser_id_value, job_id: job_id_value}),
            dataType: "html",
            type: "post",
            success: function (response) {
                $('#milestone-details-modal').html(response.trim());
                $('#edit-milestone').modal('show');
            },
            error: function (status, error, textStatus) {
                alert(error);
            }
        });
        $('#edit-milestone').modal('show');
    }

    function editClickedPayment(clicked_id, buser_id_value, fuser_id_value, job_id_value) {
        (function($){
            var key = $(this).attr('accesskey');
            
            $.ajax({
                url: site_url + "pay/full_milestone/" + clicked_id,
                data: ({key: key, buser_id: buser_id_value, fuser_id: fuser_id_value, job_id: job_id_value}),
                dataType: "html",
                type: "post",
                success: function (response) {
                    $('#payment-details-modal').html(response.trim());
                    $('#edit-payment').modal('show');
                },
                error: function (status, error, textStatus) {
                    alert(error);
                }
            });
            $('#edit-payment').modal('show');
        })(jQuery);
    }


    function loadmessage(b_id, u_id, j_id) {
        var modal = document.getElementById('message_convertionModal');
        $.post( site_url + "jobconvrsation/message_from_superhero", {job_bid_id: b_id, user_id: u_id, job_id: j_id}, function (data) {
            $('.message_lists').html(data.html);
            $('#job_id').val(j_id);
            $('#bid_id').val(b_id);
            $('#receiver_id').val(u_id);
            modal.style.display = "block";
            autoloading();
        }, 'json');
    }

    function hidemessagepopup() {
        var modal = document.getElementById('message_convertionModal');
        modal.style.display = "none";
    }

    $("#conversion_message").on("submit", function (e) {
        e.preventDefault();
        var $form = $("#conversion_message");
        if ($('#usermsg').val().trim().length > 0) {
            $.post(site_url + "jobconvrsation/add_conversetion", {form: $form.serialize()}, function (data) {
                if (data.success) {
                    $form[0].reset();
                    loadmessage($('#bid_id').val(), $('#receiver_id').val(), $('#job_id').val());
                } else {
                    alert('Opps!! Something went wrong.');
                }
            }, 'json');
        }
    });

    function loadmessage_auto( ) {
        var auto_job_id = $('#job_id').val();
        var auto_bid_id = $('#bid_id').val();
        var auto_receiver_id = $('#receiver_id').val();
        var modal = document.getElementById('message_convertionModal');
        $.post( site_url + "jobconvrsation/message_from_superhero", {job_bid_id: auto_bid_id, user_id: auto_receiver_id, job_id: auto_job_id}, function (data) {
            $('.message_lists').html(data.html);
        }, 'json');
    }

    function autoloading() {
        var auto_job_id = $('#job_id').val();
        var auto_bid_id = $('#bid_id').val();
        var auto_receiver_id = $('#receiver_id').val();

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

        if (auto_job_id && auto_bid_id && auto_receiver_id) {
            setInterval('loadmessage_auto()', 5000);
        }
    }

    autoloading();