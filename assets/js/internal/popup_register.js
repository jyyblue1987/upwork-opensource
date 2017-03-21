$("#place_bid").click(function(){
    var url = base_url() +'freelancersignup/popup_signup';
    $.ajax({
        type: "GET",
        url: url,
        success:function(result){
            $('.modal-content').html(result);
        },
        error:function(err){
            console.log(err.responseText);
        }
    });
});