function editClickedExp(clicked_id) {
    var key = $(this).attr('accesskey');
    $.ajax({
        url: base_url + "profile/addexp/" + clicked_id,
        data: ({key: key}),
        dataType: "html",
        type: "post",
        success: function (response) {
            $('#exp-details-modal').html(response.trim());
            $('#edit-exp').modal('show');
        },
        error: function (status, error, textStatus) {
            alert(error);
        }
    });
    $('#edit-exp').modal('show');
}

function editClickedEdu(clicked_id) {
    var key = $(this).attr('accesskey');
    $.ajax({
        url: base_url + "profile/addedu/" + clicked_id,
        data: ({key: key}),
        dataType: "html",
        type: "post",
        success: function (response) {
            $('#edu-details-modal').html(response.trim());
            $('#edit-edu').modal('show');
        },
        error: function (status, error, textStatus) {
            alert(error);
        }
    });
    $('#edit-edu').modal('show');
}

$(document).ready(function() {

    $('.edit-exp').click(function (e) {
        e.preventDefault();
        var key = $(this).attr('accesskey');
        $.ajax({
            url: base_url + "profile/add-exp",
            data: ({key: key}),
            dataType: "html",
            type: "post",
            success: function (response) {
                $('#exp-details-modal').html(response.trim());
                $('#edit-exp').modal('show');
            },
            error: function (status, error, textStatus) {
                alert(error);
            }
        });
        $('#edit-exp').modal('show');
    });

    $('.edit-edu').click(function (e) {

        e.preventDefault();
        var key = $(this).attr('accesskey');
        $.ajax({
            url: base_url + "profile/addedu/",
            data: ({key: key}),
            dataType: "html",
            type: "post",
            success: function (response) {

                $('#edu-details-modal').html(response.trim());
                $('#edit-edu').modal('show');
            },
            error: function (status, error, textStatus) {
                alert(error);
            }
        });
        $('#edit-edu').modal('show');
    });

    $('.remove-portfolio').click(function (e) {
        e.preventDefault();
        var key = $(this).attr('accesskey');
        var div = $(this).attr('alt');
        var con = confirm("Are you sure to remove?");
        if (con) {
            $.ajax({
                url: base_url + "profile/remove-portfolio",
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
            url: base_url + "profile/edit-portfolio",
            data: ({key: key}),
            dataType: "html",
            type: "post",
            success: function (response) {
                
                $('#portfolio-details-modal').html(response.trim());
                $('#edit-portfolio').modal('show');
            },
            error: function (status, error, textStatus) {
                alert(error);
            }
        });
        $('#edit-portfolio').modal('show');
    });
   
});
