<?php
$_data = array();
foreach ($messages as $v) {
	$v = (array) $v;
  if (isset($_data[$v['job_id']])) {
    continue;
  }
  $_data[$v['job_id']] = $v;
}
$messages = array_values($_data);
 ?>

<style>
/* Added by Armen Start*/
.textarea_wrapper{position: relative;}
.attach_icon{position: absolute;
right: 3%;transform: rotate(90deg);
font-size: 26px;
top: 2%;
color: #a2a2a2;}
.show_files{
    position: absolute;
    left: 5%;
    top: 3%;
}
.show_files span{
	font-size: 12px;
}
.show_files .delete_item{
	margin-left: 5px;
}
/* Added by Armen End*/
.sidebar-block.seen { background: #fff;border: 1px solid #ccc;}
.sidebar-block.seen:hover{ background: #F9F9F9;}
div.chat-box .chat-sidebar {border: 1px solid #ccc;
padding: 8px 13px;
min-height: 600px;
border-right: none;
overflow-x: hidden;
overflow-y: scroll;
height: 600px;}
div.sidebar-block { background: rgba(0, 0, 0, 0.18); min-height: 35px; min-height: 82px; margin-bottom: 10px; }
div.chat-box .chat-sidebar p { padding: 8px;padding-top: 5px;margin: 0;}
span.text1, span.text2, span.text3 {  display: block;}
span.text2 ,span.text1{ font-size: 13px;}
span.text3 { font-size: 13px; color: #717171;margin-top: 3px;}
span.text4 { position: absolute; top: 8px; right: 0px; font-size: 9px; color: #717171;}
.row.chat-box { min-height: 400px; border: 1px solid #ccc; padding: 20px;background:#fff;}
div.chat-box .chat-screen { border: 1px solid #ccc; padding: 0; min-height: 600px;}
.chat-details-topbar { min-height: 74px; position: absolute; top: 0; background: #fff; width: 100%; z-index: 99; border-bottom: 1px solid #ccc;}
span.text2{margin-top: 5px;}


.chat-details { width: 100%; z-index: 1; bottom: 0; min-height: 450px; height: 450px; position: absolute; background: #fff; overflow-x: hidden; overflow-y: scroll;top: 80px;border-bottom: 1px solid #ccc;}

/*.chat-details {
    width: 100%;
    z-index: 1;
    min-height: 380px;
    position: absolute;
    background: #fff;
    overflow-x: hidden;
    overflow-y: scroll;
    top: auto;
    height: 380px;
    margin-top: -380px;
    bottom: 100px;
}
.chat-details ul { margin-top: -380px;}*/

.chat-details ul li { list-style-type: none; padding: 10px 0;}
.chat-details ul li span img { width: 50px; border-radius: 50%; margin: 0 15px 0 10px;}
.chat-details-topbar h3 { padding: 0 10px; font-weight: bold;}
.chat-details-topbar h5 { padding: 0 10px;}
.chat-details-topbar p { padding: 24px 0 0px 10px; margin: 0;  color: #757575;}
.chat-details ul li span.details { display: block; margin-left: 75px;  font-size: 14px;  color: #757474; word-wrap: break-word;
max-width: 85%}
.chat-details ul li .chat_image { margin-left: 75px;  font-size: 14px;}
textarea#chat-input { width: 95%; height: 40px; margin: 0 0 0 30px;  border: 2px solid #1ca7db;}
textarea#chat-input.has-error { border-color: #a94442;	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);}
.active { border: 2px solid #ccc;  color: #1ca7db;background-color: #F9F9F9 !important;}
.chat-sidebar a { color: #000;}
.chat-bar { width: 100%; z-index: 1;position: absolute; background: #fff; top: 545px; }
form#chat_form a {display: inline-block;
background: #1ca7db;
color: #fff;
text-align: center;
font-size: 18px;
padding: 7px 25px;
text-decoration: none;
font-family: calibri;}
span.chat-date { font-size: 13px; padding: 0 0 0 50px; color: #949494;}
span.group-date { display: block; text-align: center; font-size: 16px; color: #7d7b7b;}
span.name { text-transform: capitalize;font-size: 16px;}
span.text1 {text-transform: capitalize;}
.chat-details-topbar p{padding:0;}

/*textarea {
    width:100%;
    resize:none;
    overflow:hidden;
    font-size:18px;
    height:1.1em;
    min-height: 40px;
    padding: 10px 10px;
    padding-right: 50px;
    max-height: 50px;
    overflow-x: hidden;
    overflow-y: auto;
    margin-left: 10px;
    border-radius: 4px;
}*/
</style>

<section id="big_header" style="margin-top:40px;margin-bottom:40px;height: auto;">
    <div style="width: 970px !important;" class="container">



		<?php if(empty($messages)){ ?>
			<h2 class="text-center" style="font-size:22px;">Sorry! No Message Available right now</h2>
		<?php } ?>

		<?php if(!empty($messages)){ ?>

		<div class="row chat-box ">
			<div class="col-lg-3 col-md-3 col-sm-3 chat-sidebar">

				<?php foreach($messages as $message) {
					$name = $message['webuser_fname']." ".$message['webuser_lname'];
				?>

				<a onclick="chat_details(<?=$message['bid_id']?>, <?=$message['is_ticket']?>);" style="cursor: pointer;">
				<div id="<?=$message['bid_id']?>" class="sidebar-block <?php if($message['have_seen'] == 0){echo "seen";}?> <?php if($message['bid_id'] == ($chat_details[0]->bid_id)){ echo "active";}?>">
					<p style="width: 18%; display: block; float: left; margin: 0 5px 0 0;"><i class="fa fa-comments fa-3x" aria-hidden="true"></i></p>
					<p style="width: 75%; display: block; float: left; position:relative;">
						<span class="text1"><?= substr($name, 0, 15) ?></span>
						<span class="text2"><?=substr($message['title'], 0, 25)?></span>
						<span class="text3"><?=substr($message['message_conversation'], 0, 28)?></span>
						<span class="text4"><?=date("d-m-Y", strtotime($message['created']))?></span>
					</p>
				</div>
				</a>

				<?php } ?>

			</div>
			<div class="col-lg-9 col-md-9 col-sm-9 chat-screen">
				<div class="chat-details-topbar custom_chat-details-topbar">
					<h3><?=$chat_details[0]->fname?>  <?=$chat_details[0]->lname?></h3>
					<h5 style="margin-bottom: 0;"><?=$chat_details[0]->title?></h5>
				</div>
				<div class="chat-details">
					<ul id="scroll-ul">
					<?php
					$chat_details = array_reverse($chat_details);
					$group_time = false;
					$current_date = strtotime(date("d-m-Y"));
					$date ='';$temp_date ='';
					foreach($chat_details as $chat_data) {
						if (!empty($timezone)) {
						$date2 =  new DateTime(date('Y-m-d h:i:s',strtotime($chat_data->created)), new DateTimezone('UTC'));
						$date2->setTimezone(new \DateTimezone($timezone['gmt']));

						$time = $date2->format('g:i A');
						} else {
						$time = date('g:i A',strtotime($chat_data->created));
						}

					if(($chat_data->cropped_image) == "") {
						$src = site_url("assets/user.png");
					 } else {
						$src =$chat_data->cropped_image;
					 }




					$temp_date = date("d-m-Y", strtotime($chat_data->created));
					if($date != strtotime($temp_date)){
						$date = strtotime($temp_date);
						$group_time = true;
					}
					else {
						$group_time = false;
					}

					if($group_time){

					?>
					<li><span class="group-date"><?php if($date == $current_date) { echo "Today";} else { echo date("l, F j, Y", $date);}?></span></li>

					<?php } ?>
						<li>
							<span class="name"><img src="<?=$src?>"><?=$chat_data->webuser_fname?> <?=$chat_data->webuser_lname?></span> <span class="chat-date"><?= $time;?></span>
							<span id="scroll" class="details"><?=$chat_data->message_conversation?></span>
							<?php if(count($chat_data->images_array) > 0):?>
								<?php foreach ($chat_data->images_array as $key => $image):?>
									<div class = "chat_image">
										<a href = "<?=base_url('uploads')."/".$image->name?>" download target = "blank"><?=$image->name?></a>
									</div>
								<?php endforeach;?>
							<?php endif;?>
						</li>
					<?php } ?>
					</ul>
				</div>
				<div class="chat-bar">
					<form id="chat_form" action="" enctype = 'multipart/form-data'>
					<input type="hidden" id="job_id" name="job_id" value="<?=$chat_details[0]->job_id?>">
					<input type="hidden" id="bid_id" name="bid_id" value="<?=$chat_details[0]->bid_id?>">
					<input type="hidden" id="bid_id" name="r_id" value="<?=$chat_details[0]->r_id?>">
					<input type="hidden" id="is_ticket" name="is_ticket" value="<?=$chat_details[0]->is_ticket?>">
					<div class = "textarea_wrapper" style="width:80%;float: left;">
						<!-- Added by Armen start -->
						<div class = "attach_icon">
							<i style="cursor: pointer;" class="fa fa-paperclip" aria-hidden="true"></i>
						</div>
						<div class = "uploaded_files">

						</div>
						<input type = "hidden" name = "removed_files" value = "" id = "removed_files">
						<input type="file" name="fileupload[]" class = "hidden" value="fileupload" id="fileupload" multiple>
						<!-- Added by Armen End -->

						<textarea id="chat-input" name="chat-input" style="resize: none; padding-right: 50px; border-radius: 4px;"></textarea>
						<div style="clear:both;"></div>
					</div>
					<div class="ccc_send ccc_sms_send_btn" style="float: left;margin-left: 20px;"><a href="" id="chat-btn" role="button" type="submit">SEND</a></div>
					</form>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>

		<?php } ?>


</section><!-- big_header-->
<script>
$(document).ready(function(){
	$('.chat-details').animate({scrollTop: $('.chat-details').prop("scrollHeight")}, 1);
	// Added by Armen start
	$(document).on("click",".attach_icon", function() {
		$('#fileupload').trigger('click');
	});
	$(document).on("change","#fileupload", function() {
	    var filename = $('#fileupload').prop("files");
		var names = $.map(filename, function(val) { return val.name; });
		$('.uploaded_files').addClass('show_files');
		$.each(names, function( index, value ) {
		  	$('.uploaded_files').append('<div class = "item"><span class = "item_name">'+value+'</span><span class = "delete_item"><i class="fa fa-times" aria-hidden="true"></i></span></div>')
		});
	});
	var removed_files = [];
    $(document).on("click",".delete_item", function() {
        var img_name = $(this).prev().html();
        $(this).parent().remove();
        removed_files.push(img_name);
        $('#removed_files').val(removed_files);
    });
	// Added by Armen end

/*	var span = $('<span>').css('display','inline-block')
	.css('word-break','break-all').appendTo('body').css('visibility','hidden');
	function initSpan(textarea){
	  span.text(textarea.text())
	      .width(textarea.width())      
	      .css('font',textarea.css('font'));
	}
	$('textarea').on({
	    input: function(){
	      var text = $(this).val();      
	      span.text(text);      
	      $(this).height(text ? span.height() : '1.1em');
	    },
	    focus: function(){
	     initSpan($(this));
	    },
	    keypress: function(e){
	        if(e.which == 13) e.preventDefault();
	    }
	});*/
});
function chat_details(bid_id, is_ticket) {
			$.post('<?php echo base_url() ?>Messageboard/chatdetails', { bid_id: bid_id, is_ticket: is_ticket},  function(data) {
				if(data) {
					$('.sidebar-block').removeClass('active');
					$('#'+bid_id).addClass('seen');
					$('#'+bid_id).addClass('active');
					$('.chat-screen').html(data);
					$('.chat-details').animate({scrollTop: $('.chat-details').prop("scrollHeight")}, 1);
				} else {

				}
			}, 'json');
}

$('.chat-screen').on('click','#chat-btn',function(event) {
	console.log('click');
	event.preventDefault();
 	if ( !$('#chat-input').val() ) {
		$('#chat-input').addClass('has-error');
		return;
	} else {
		$('#chat-input').removeClass('has-error');
		$(this).text('Sending');
		$(this).button().button('disable');
	}
	// added by Armen

        var form_data = new FormData($('#chat_form')[0]);
        $.ajax({
            url: '<?php echo base_url() ?>Messageboard/chatinsert',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (data) {
                $('.chat-details ul').append(data);
				$('.chat-details').animate({scrollTop: $('.chat-details').prop("scrollHeight")}, 1);
				$('#chat_form')[0].reset();
				$('#chat-btn').text('Send');
				$('.uploaded_files').empty();
				$('#chat-btn').button().button('enable');
            }
        });


	// added by Armen end

});


function checkForUpdate() {
	$('#bid_id').click();
}
var refreshId = setInterval(checkForUpdate, 5000);
</script>
