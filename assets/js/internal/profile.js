function editClickedExp(clicked_id) {
    var key = $(this).attr('accesskey');
    $.ajax({
        url: "/profile/addexp/" + clicked_id,
        data: ({key: key}),
        dataType: "html",
        type: "post",
        success: function (response) {
            $('#exp-details-modal').html(response.trim());
            
        },
        error: function (status, error, textStatus) {
            alert(error);
        }
    });
    $('.edit-exp-modal').trigger('click');
}

function editClickedEdu(clicked_id) {
    var key = $(this).attr('accesskey');
    $.ajax({
        url: "/profile/addedu/" + clicked_id,
        data: ({key: key}),
        dataType: "html",
        type: "post",
        success: function (response) {
            $('#edu-details-modal').html(response.trim());
			$('.edit-edu-modal').trigger('click');
        },
        error: function (status, error, textStatus) {
            alert(error);
        }
    });
    
}

$(document).ready(function() {

    $('.edit-exp').click(function (e) {
        e.preventDefault();
        var key = $(this).attr('accesskey');
        $.ajax({
            url: "/profile/add-exp",
            data: ({key: key}),
            dataType: "html",
            type: "post",
            success: function (response) {
                $('#exp-details-modal').html(response.trim());
				 $('.edit-exp-modal').trigger('click');
            },
            error: function (status, error, textStatus) {
                alert(error);
            }
        });
       
    });

    $('.edit-edu').click(function (e) {

        e.preventDefault();
        var key = $(this).attr('accesskey');
        $.ajax({
            url: "/profile/addedu/",
            data: ({key: key}),
            dataType: "html",
            type: "post",
            success: function (response) {
                $('#edu-details-modal').html(response.trim());
				$('.edit-edu-modal').trigger('click');
            },
            error: function (status, error, textStatus) {
                alert(error);
            }
        });
        
    });

    $('.remove-portfolio').click(function (e) {
        e.preventDefault();
        var key = $(this).attr('accesskey');
        var div = $(this).attr('alt');
        var con = confirm("Are you sure to remove?");
        if (con) {
            $.ajax({
                url: "/profile/remove-portfolio",
                data: ({key: key}),
                dataType: "json",
                type: "post",
                success: function (response) {
                    if (response.status == "success") {
                        $('#div-' + div).remove();
                    } else {
                        alert(response.msg);
                    }
                },
                error: function (status, error, textStatus) {
                    alert(error);
                }
            });
        }
    });

    $('.edit-portfolio').click(function (e) {
        e.preventDefault();
        var key = $(this).attr('accesskey');
        $.ajax({
            url: "/profile/edit-portfolio",
            data: ({key: key}),
            dataType: "html",
            type: "post",
            success: function (response) {
                $('#portfolio-details-modal').html(response.trim());
				$('.edit-portfolio-modal').trigger('click');
            },
            error: function (status, error, textStatus) {
                alert(error);
            }
        });
       
    });
   
});
