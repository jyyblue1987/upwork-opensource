<!--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"></style>-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<div class="page animsition">
    <div class="page-header">
        <div class="page-header">
            <h1 class="page-title"><?php echo $title; ?></h1>
            <div class="page-header-actions">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <?php echo $loadpage; ?>
                        </a>
                    </li>
                    <li class="active">
                        <?php echo $title; ?>
                    </li>
                </ol>
            </div>
        </div>

        <div class="page-content">
            <!-- Panel -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <!--<h2><?php echo $title; ?></h2>-->
                <div class="first">
                    <h3><?php echo $title; ?></h3>
                    <h4> Search by user name   </h4>
                    <div class="btn-toolbar" role="toolbar" aria-label="...">
                        <div class="btn-group" role="group" aria-label="...">A</div>
                        <div class="btn-group" role="group" aria-label="...">B</div>
                        <div class="btn-group" role="group" aria-label="...">C</div>
                        <div class="btn-group" role="group" aria-label="...">D</div>
                        <div class="btn-group" role="group" aria-label="...">E</div>
                        <div class="btn-group" role="group" aria-label="...">F</div>
                        <div class="btn-group" role="group" aria-label="...">G</div>
                        <div class="btn-group" role="group" aria-label="...">H</div>
                        <div class="btn-group" role="group" aria-label="...">I</div>
                        <div class="btn-group" role="group" aria-label="...">J</div>
                        <div class="btn-group" role="group" aria-label="...">K</div>
                        <div class="btn-group" role="group" aria-label="...">L</div>
                        <div class="btn-group" role="group" aria-label="...">M</div>
                        <div class="btn-group" role="group" aria-label="...">N</div>
                        <div class="btn-group" role="group" aria-label="...">O</div>
                        <div class="btn-group" role="group" aria-label="...">P</div>
                        <div class="btn-group" role="group" aria-label="...">Q</div>
                        <div class="btn-group" role="group" aria-label="...">R</div>
                        <div class="btn-group" role="group" aria-label="...">S</div>
                        <div class="btn-group" role="group" aria-label="...">T</div>
                        <div class="btn-group" role="group" aria-label="...">U</div>
                        <div class="btn-group" role="group" aria-label="...">V</div>
                        <div class="btn-group" role="group" aria-label="...">W</div>
                        <div class="btn-group" role="group" aria-label="...">X</div>
                        <div class="btn-group" role="group" aria-label="...">Y</div>
                        <div class="btn-group" role="group" aria-label="...">Z</div>



                    </div>

                </div>
                <p class="result-msg" style="text-align: center;color: green;font-size: 20px;display: none;"></p>
                <div class="secound">

                    <div class="fabb">
                        Date
                    </div>

                    <div class="fad">
                        To

                    </div>
                    <div class="fabb">
                        Date
                    </div>
                    <div class="faff">
                        SEARCH

                    </div>

                </div>


<div class="third">

    <div class="fab">
        <div class="selector" id="uniform-user_type" style="width: 100px;">
            <select id="user_type" name="user_type" class="form-control">
                <option value="">ID</option>

                <option value="3">
                    Username</option>
                <option value="2">Email</option>


            </select>
        </div>
    </div>
    <div class="fad">
        <i class="fa fa-minus" aria-hidden="true"></i>

    </div>
    <div class="fae">


    </div>
    <div class="faf">
        SEARCH

    </div>

</div>

<div class="table">

    <table class="table table-bordered" id="example">
        <thead>
            <tr>
                <th> ID </th>
                <th> Name </th>
                <th> Subject </th>
                <th> Email </th>
                <th> Ticket </th>
                <th> Message </th>
                <th> Status</th>
                <th>Action </th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($result as $index => $row) {?>
          <tr data-index="<?php echo $index; ?>" id="row_<?php echo $index; ?>">
              <td><?php echo $row->message_id; ?></td>
              <td><?php echo $row->fname." ".$row->lname; ?></td>
              <td><?php echo $row->subject; ?></td>
              <td><?php echo $row->email; ?></td>
              <td><?php echo $row->ticket_id; ?></td>
              <td><?php echo $row->message; ?></td>
                <?php if ($row->status == 'red') {?>
                <td style="text-align:center; color:#F43880">
                <?php } else {?>
                <td style="text-align:center; color:#72B110">
                <?php } ?>
                    <i class="fa fa-check" aria-hidden="true"></i></td>
                <td style="text-align:center; color:#F43880">
                    <span><a href='#' class="sendMessage"><span class = "unread_count"><?php if($row->unread_messages != '0'){ echo $row->unread_messages; } ?></span><i class="fa fa-envelope-o" aria-hidden="true"></i></a></span>&nbsp;
                    <a href='#' class='deleteRed' style="color:#F43880;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="contactForm" tabindex="-1" role="dialog" aria-labelledby="contactFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="main">
            <div class="modal-header main_header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="myModalLabel">View Enquiry</h3>
            </div>
            <form enctype = 'multipart/form-data' id="enquiryForm" action="<?php echo site_url("administrator/userpage/loadpage/contactmanagement/subpage/contactcheck"); ?>" method="POST">
                <input type="hidden" name="ticket_id">
                <input type="hidden" name="webuser_id">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="txt_name" id="name" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="subject" class="subject">Subject:</label>
                <input type="text" class="txt_sub" id="subject" name="subject" placeholder="Subject">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="txt_email" id="email" name="email" placeholder="Email">
            </div>

            <div class="sent_msg">
                <ul>

                </ul>
                <div class="form-group" style="padding: inherit;">
                <div class="write_msg_area textarea_wrapper">
                    <!-- Added by Armen start -->
                    <div class = "attach_icon">
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                    </div>
                    <div class = "uploaded_files">
                        
                    </div>
                    <input type = "hidden" name = "removed_files" value = "" id = "removed_files">
                    <input type="file" name="fileupload[]" class = "hidden" value="fileupload" id="fileupload" multiple>
                    <!-- Added by Armen end -->
                    <textarea rows="3" cols="55" name="message"></textarea>
                    <button type="submit" class="send_btn">Send</button>
                </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    // save all rows in javascript array
    var rows = <?php echo json_encode($result); ?>;

    $(document).ready(function() {
        $('#example').DataTable({
            bFilter: false
        });

        // Added by Armen start

        $('.attach_icon').click(function(event) {
            $('#fileupload').trigger('click');
        });
        $ ('#fileupload').on('change', function () {
            $('.uploaded_files').addClass('show_files');
            var filename = $('#fileupload').prop("files");
            var names = $.map(filename, function(val) { return val.name; });
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
     
        $("a.sendMessage").click(function(event) {
            event.preventDefault();
            var tr = $(this).closest('tr');
            var index = tr.data().index;
            var data = rows[index];
            var icon = $(this);
            $("#enquiryForm input[name=ticket_id]").val(data.ticket_id);
            var ticket_id = $("#enquiryForm input[name=ticket_id]").val();
            // added by Armen start
                $.post("<?php echo base_url() ?>administrator/userpage/loadpage/contactmanagement/subpage/contactupdatecount",
                {
                    ticket_id: data.ticket_id
                },
                function(data) {
                    if(data.success){
                        icon.find('.unread_count').text('');
                    }
                       
                }, 'json');

         





            // added by Armen end




            $("#enquiryForm input[name=webuser_id]").val(data.webuser_id);
            $("#name").val(data.fname + ' ' + data.lname);
            $("#subject").val(data.subject);
            $("#email").val(data.email);
            $("span.details").html(data.message);
            // forming conversation
            var conv_html = "";
            var conv_images = "";
            $.each(data.conversation, function(index, message) {
                conv_html += '<li> ';
                if ( message.sender == 'user' ) {
                    conv_html += ' <span class="name"> ';
                        if (message.webuser_picture) {
                            conv_html += '<img src="<?php echo base_url(); ?>' + message.webuser_picture + '" alt="">'
                        } else {
                            conv_html += '<img src="<?php echo base_url(); ?>assets/img/user.png" alt="">'
                        }
                        conv_html += '<span class="user_name">'
                        + data.fname + ' ' + data.lname
                        + '</span>'
                        + '</span>';
                } else {
                    conv_html += ' <span class="name"> '
                        + '<span class="support">'
                        + 'Support'
                        + '</span>'
                        + '</span>';
                }

                conv_html += '<span class="chart_date">' + message.created + '</span>'
                            + '<span class="details">'
                            + message.message
                            + '</span>';
                // added by Armen start 
                $.each(message.files, function(key, file) {
                    conv_html+='<div class = "chat_image">'
                                    +'<a href = "<?php echo base_url("uploads/"); ?>/'+ file.name +'" download target = "blank">'+ file.name +'</a>'
                                    +'</div>';
                });
                // added by Armen end 
                conv_html+='</li>';
                           
            });
            $("#contactForm .sent_msg ul").html(conv_html);
            $("#contactForm").modal();
        });

        $('#enquiryForm').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            message: 'This value is not valid',
            resetForm: 'true',
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'Enter Name'
                        }
                    }
                },
                subject: {
                    validators: {
                        notEmpty: {
                            message: 'Enter Subject'
                        }
                    }
                },
                email: {
                    threshold: 10,
                    validators: {
                        notEmpty: {
                            message: 'Enter Your Email'
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'Not valid email address'
                        }
                    }
                },
                message: {
                    validators: {
                        notEmpty: {
                            message: 'Write Something to us'
                        }
                    }
                }
            }
        }).on('success.field.fv', function (e, data) {
            e.preventDefault();
            data.fv.disableSubmitButtons(false);

        }).on('err.field.fv', function (e, data) {
            data.fv.disableSubmitButtons(false);
        });

        $("a.deleteRed").click(function(event) {
            event.preventDefault();
            var tr = $(this).closest('tr');
            var index = tr.data().index;
            var data = rows[index];
            console.log(data);
            $.post("<?php echo base_url() ?>administrator/userpage/loadpage/contactmanagement/subpage/Contactdeleteredstatus",
                {
                    ticket_id: data.ticket_id,
                    webuser_id: data.webuser_id,
                    email: data.email
                },
                function(data) {
                    console.log(data);
                    if(data.success){
                        rows[index].status = 'green';
                        rows[index].conversation = data.conversation;

                        var td6 = $("#row_"+index).children('td')[6];
                        $(td6).css('color','#72B110');

                        $('.result-msg').html('You have successfully changed The Status');
                        $(".result-msg").show().delay(5000).fadeOut();
                    }
                    else{
                        alert('Opps!! Something went wrong.');
                    }

            }, 'json');
        });

    });
    
    function changestatus(id){
        
        $.post("<?php echo base_url() ?>administrator/userpage/changeactiveTosuspend", { id: id },  function(data) {

					if(data.success){
							
							$('.result-msg').html('You have successfully change The Status');
							$(".result-msg").show().delay(5000).fadeOut();
							setTimeout(function(){ window.location = "<?php echo base_url();?>administrator/userpage/loadpage/webuser/subpage/suspendclient"; }, 5000);
					}
					else{
							alert('Opps!! Something went wrong.');
					}
			   
			}, 'json');
        
    }
    
</script>
<style>
/* Added by Armen Start*/
.textarea_wrapper{
    position: relative;
}
.unread_count{
    margin-right: 3px;
}
.attach_icon{ 
    position: absolute;
    right: 22%;
    font-size: 26px;
    top: 20%;
    color:#a2a2a2;
}
.show_files{
    position: absolute;
    left: 2%;
    top: 3%;
}
.show_files span{
    font-size: 12px;
}
.show_files .delete_item{
    margin-left: 5px;
}
/* Added by Armen End*/ 
.dataTables_length {
  display: none;
}
.dataTables_info {
  float: left;
  margin-bottom: 25px;
}
.dataTables_paginate.paging_simple_numbers {
    float: right;
    position: relative;
    top: 0;
    width: auto;
}
#example_paginate a {
    padding: 5px;
}
.facd {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border-bottom: 1px solid #929292;
  border-right: 1px solid #929292;
  border-top: 1px solid #929292;
  display: block;
  float: none;
  overflow: hidden;
  padding: 0;
}
.table td span {
    color: #3093DC;
}

#main {
    margin: 0 auto;
    width:570px;
    height: 570px;
    border: 15px solid #AADCAA;
    border-radius: 15px;
}
.main_header {
    border-bottom: 2px solid #AADCAA;
}
.sent_msg {
    border: 2px solid #708C90;
    margin: 12px 15px 12px 15px;
    border-radius: 5px;
}
.sent_msg ul {
    overflow: scroll;
    overflow: auto;
    height: 150px;
}
.sent_msg li{
    list-style: none
}
.sent_msg ul li span.details{
    display: block;
}
.user_img p{
    display: inline-block;

}
.sent_msg img{
    height: 50px;
    width: 50px;
}

.write_msg_area {
    border: 2px solid #ededed;
    margin-top: 20px;
}
.form-group {
    //padding: 10px;
    padding-left: 25px;
    padding-top: 10px;
}
.form-group label {
    font-weight: bold;
    color: #000;
}
.name span {
    color: red;
}

.name .support {
        font-weight: bold;
        color: #000;
}
.form-group [type=text]{
    width: 235px;
    //height: 25px;
    color: #C292FF;
    margin-left: 15px;
}
.form-group [type=email]{
    width: 235px;
    //height: 25px;
    color: #C292FF;
    margin-left: 15px;
}
.subject {
    margin-right: -10px;
}
.send_btn {
    vertical-align: top;
    margin-top: 18px;
    padding: 5px 15px 5px 15px;
    background: #1AA8D8;
    color: #fff;
    font-weight: bold;
    //font-size: 10px;
    border-radius: 5px;
}
.chart_date {
    color: #A6A6A6;
    font-size: 12px;
    margin-left: 10px;
}
.details {
    margin-top: 5px;
}
</style>
