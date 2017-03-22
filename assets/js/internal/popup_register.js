$(".place_bid").click(function(){
    var job_id = $(this).data('job-id');
    var title = $(this).data('title');
    var url = base_url() +'freelancersignup/popup_signup';
    $.ajax({
        type: "GET",
        url: url,
        success:function(result){
            $('.modal-content').html(result);
            $('#job_id').val(job_id);
            $('#title').val(title);
        },
        error:function(err){
            console.log(err.responseText);
        }
    });
});