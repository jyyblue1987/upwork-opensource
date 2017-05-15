define(['require', 'jquery'], function (require, $) {

	require(['chatbox'], function () {
		$('._job_btn_message').chatbox({
			sendto:      site_url + "jobconvrsation/add_conversetion",
			receivefrom: site_url + "jobconvrsation/message_from_superhero",
			boxModal:    '#message_convertionModal'
		});
	});

	$('._js_decline_btn,#btn-decline-applicant').on('click', function(e){
		e.preventDefault();

		var x    = confirm("Are you sure! want to Decline the User?");
		var that = $(this);

		if (x) {
			$.post(this.href, {form: that.data('id')}, function (data) {
				if (data.success) {
					$('.result-msg').eq(0).html('You have successfully Decline the Post');
					if(that.data('redirect')) {
						window.location = that.data('redirect');
					} else {
						window.location =  site_url + "declined?job_id=" + that.data('job');
					}
				} else {
					alert('Opps!! Something went wrong.');
				}
			}, 'json');
		}
	});
});
