
	
<section id="big_header" style="margin-top:50px;margin-bottom:50px;height: auto;"> 
    <div class="container">
	  <div class="row">
	  <div class="col-md-6 col-xs-12">
	  <div class="row">
	  <div class="col-md-6 col-xs-12">
	    <img src="<?php echo $res['data']['profile_picture']; ?>" class="img-circle" alt="<?php echo $res['data']['full_name']; ?>" width="200" height="200">

		</div>
	  <div class="col-md-6 col-xs-12 text-right">
		<div class="btn-group">
		  <a type="button" class="btn btn-primary" href="#">Posts</a>
		  <a type="button" class="btn btn-primary" onclick="alert('Coming Soon');">Followers</a>
		  <a type="button" class="btn btn-primary" onclick="alert('Coming Soon');">Following</a>
		</div>
	  </div>
	  <div class="text-right">
	  <b><?php echo $res['data']['full_name']; ?></b><br>
	  <b><?php echo $res['data']['username']; ?></b><br>
		<b><?php echo $res['data']['counts']['media']; ?></b> Posts<br>
		<b><?php echo $res['data']['counts']['followed_by']; ?></b> Followers<br>
		<b><?php echo $res['data']['counts']['follows']; ?></b> Following
	  </div>
	  
	  <input type="hidden" id="instatoken" value="<?php echo $_GET["token"]; ?>">
	  <input type="hidden" id="instaid" value="<?php echo $res['data']['id']; ?>">
	  <input type="hidden" id="loadedxy" value="0">
	  </div>
	  </div>
	  <div class="col-md-6 col-xs-12 text-right">
	<form class="navbar-form navbar-right" role="search" onsubmit="alert('Coming Soon');return false;">
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Search to compare" onclick="alert('Coming Soon');">
    </div>
    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
</form>
	  </div>
	  </div>
	  
	  
<div id="manage" class="ng-scope">




</div>
	
	  
	  
		
</section><!-- big_header-->




	  	<div modal-render="true"   id="modal-wrapper"  onclick="hidepopup();" tabindex="-1" role="dialog" class="modal fade ng-isolate-scope in" uib-modal-animation-class="fade" modal-in-class="in" ng-style="{'z-index': 1050 + index*10, display: 'block'}" uib-modal-window="modal-window" size="lg" index="0" animate="animate" modal-animation="true" style="z-index: 1050; display: none;    background: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-lg"><div class="modal-content" uib-modal-transclude=""  onclick="event.stopPropagation();">
        <div class="modal-body ng-scope" >

            <div class="row">
				<div class="model_content col-md-12">
					<div class="col-sm-12 text-center" id="addhere">
						
					</div>
                    
				</div>
			</div>
        </div>
    </div></div>
</div>


<script>

		
var timer;
var timeout = 500;


function timeConverter(UNIX_timestamp){
  var a = new Date(UNIX_timestamp*1000);
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  var year = a.getFullYear();
  var month = a.getMonth()+1;
  var date = a.getDate();
  var hour = a.getHours();
  var hour = ("0" + hour).slice(-2);
  var min = a.getMinutes();
  var min = ("0" + min).slice(-2);
  var sec = a.getSeconds();
  var time =  month + '/' + date + '/' + year;
  return time;
}
  function numberWithCommas(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
}

function showloader(){
  jQuery("#manage").empty();
	jQuery("#manage").html('<div class="loadpng"></div>');
	
}

function showpost(id){

	// jQuery("#addhere").empty();
	
	// jQuery('#modal-wrapper').modal('show');
// jQuery( "#popup"+id ).clone().prependTo( "#addhere" );


}

function loadpost(start){
	
	jQuery("#manage").show();
	
if(jQuery("#loadedxy").val().toString()=="0"){
timeout=2000;
jQuery("#loadedxy").val("1");		
}else{
timeout=500;
}
      if(start=="start"){
	  showloader();
	  }
 clearTimeout(timer);
 
        timer = setTimeout(function(){
         loadpostload(start);
        }, timeout);
	
}

var totaldatax=0;
function loadpostload(start){
	

var xpostcountx=0;
 
	
	  var clientid= jQuery("#instaid").val();
	  var clienttoken= jQuery("#instatoken").val();


  
if(start=="start"){
	var append="";
	
}else{
	
	var append="&max_id="+start;
}



  var urlxj='https://api.instagram.com/v1/users/'+clientid+'/media/recent/?access_token='+clienttoken+append;
   $.ajax({
  type: "POST",
  "method": "POST",
  url: urlxj,
  dataType: "jsonp", 

  success: function(_d){
	  
					      
      if(start=="start"){

newhtml='';

newhtml+='<ul class="posts-gallery horizontal cols-6 ng-scope" id="posttag">';


newhtml+='</ul>';
newhtml+='<div id="clm"></div>';


  jQuery("#manage").empty();
  jQuery("#manage").html(newhtml);
  
  
		}


					var json =JSON.stringify(_d);
					
		sagar=jQuery.parseJSON(json);
		newsagar=sagar.data;
		
		jQuery("#clm").empty();
		
			   jQuery.each(newsagar, function() {
					   

var xpostcountx=1;

newhtml="";
newhtml+='<li class="ng-scope" style="cursor:pointer;">';
newhtml+='<div class="post" onclick="showpost(\''+this.id+'\');">';
newhtml+=' <div class="padded text-left" style="position:relative;">';
newhtml+='<div style="width:160px;height:160px;"><img style="cursor:pointer;" src="'+this.images['thumbnail']['url']+'"></div>';

if(this.type=="video"){
	
newhtml+='<div style="background:url(\'play.png\');height:160px;width:160px;position:absolute;margin-top:-160px;opacity:0.5;"></div>';
}
newhtml+='<span class="ng-binding">Posted on '+timeConverter(this.created_time)+'</span>';
newhtml+='</div>';
newhtml+=' <p>';

if(this.user_has_liked==true){
newhtml+='  <a class="ng-binding" onclick="event.stopPropagation();unlikepost(\''+this.id+'\');" id="likeax'+this.id+'"><i class="fa  fa-heart  active" id="likea'+this.id+'"></i><span id="likec'+this.id+'">'+numberWithCommas(this.likes['count'])+'</span></a>';
}else{
newhtml+='  <a class="ng-binding" onclick="event.stopPropagation();likepost(\''+this.id+'\');" id="likeax'+this.id+'"><i class="fa  fa-heart" id="likea'+this.id+'"></i><span id="likec'+this.id+'">'+numberWithCommas(this.likes['count'])+'</span></a>';
}

xxvcount=this.comments['count'];
if(this.comments['count']>0){
newhtml+='<a class="ng-binding"><i class="fa fa-comment"></i>'+numberWithCommas(this.comments['count'])+'</a>';
}else{
newhtml+='<a class="ng-binding"><i class="fa fa-comment"></i>'+numberWithCommas(this.comments['count'])+'</a>';
}

newhtml+=' </p>';
newhtml+='   </div>';




newhtml+='<div style="display:none;">';

newhtml+='<div class="single-post popup-purancontainer ng-scope" id="popup'+this.id+'">';
newhtml+='<div class="tr">';
newhtml+='<div class="td w40">';

	try {
		
   	videourl=this['videos'].standard_resolution.url;
	
newhtml+='<video width="100%" controls>';
newhtml+='<source src="'+videourl+'" type="video/mp4">';
newhtml+='</video>';

}
catch(err) {
   
newhtml+='<img alt="post image" src="'+this.images['standard_resolution']['url']+'">';
}




newhtml+='<p class="ng-binding">';


  if(this.caption === null){
	  
  }else{
   newhtml+=this.caption['text'];
  }
  newhtml+='</p><span onclick="loaduser(\''+clientid+'\');" style="cursor:pointer;">'+$("#uselectedc"+clientid).html()+"</span>";
    newhtml+='        <div class="date ng-binding">'+timeConverter(this.created_time)+'</div>';
   newhtml+='     </div>';
    newhtml+='    <div class="td w60">';

    newhtml+='        <div>';
    newhtml+='            <ul><li><i class="icon-tags"></i></li><li style="margin-left: 5px;">Hashtags: </li>';
	
	if(this['tags'].length>0){
		totaltag=0;
		this['tags'].forEach(function(entry) {
			if(totaltag==0){
				newhtml+='<li></li>';
				totaltag=1;
			}else{
				newhtml+='<li>,  </li>';
			}
			newhtml+='<li onclick="hidepopup();loadtag(\''+entry+'\',\'start\')" style="cursor:pointer;margin-left:10px;">'+entry+'</li>';
		});
	}else{
		
			newhtml+='<li onclick="hidepopup();" style="cursor:pointer;margin-left:5px;">0</li>';
		
	}
	
	
    newhtml+='            </ul>';
    newhtml+='        </div>';

     newhtml+='       <div>';
	 
if(this.user_has_liked==true){
      newhtml+='          <i class="icon-heart active" id="likeay'+this.id+'" onclick="unlikepost(\''+this.id+'\');" style="cursor:pointer;"></i>';
}else{
      newhtml+='          <i class="icon-heart" id="likeay'+this.id+'" onclick="likepost(\''+this.id+'\');" style="cursor:pointer;"></i>';
}


       newhtml+='         <span style="font-size: 14px;" class="ng-binding">Likes: <span id="newcountlike'+this.id+'">'+numberWithCommas(this.likes['count'])+'</span></span>';
        newhtml+='    </div>';

    newhtml+='        <div>';
	
if(this.comments['count']>0){
   newhtml+='             <i class="icon-comment"></i>';
}else{
   newhtml+='             <i class="icon-comment"></i>';
}
   newhtml+='             <span style="font-size: 14px;" class="ng-binding">Comments: '+numberWithCommas(this.comments['count'])+'</span>';
    newhtml+='        </div>';
	
    newhtml+='        <div class="comments-purancontainer" id="addcomment'+this.id+'">';

              newhtml+='  <div onclick="morecomment(\''+this.id+'\');" style="cursor:pointer;text-align:center;padding:10px 0px;">Load comments</div>';

      newhtml+='      </div>';



      newhtml+='      <div class="new-comment">';
          newhtml+='      <h5>Leave a Comment</h5><br>';
           newhtml+='  <textarea rows="3"   id="comment'+this.id+'" class="ng-pristine ng-valid"></textarea>';
             newhtml+='  <button class="btn blue" onclick="commentpost(\''+this.id+'\');">Add comment</button>';
			
			
var res = this.link.replace("https://instagram.com/p/", "");
var resb = res.replace("/", "");
var commentlink="https://instagram.com/accounts/login/?next=%2Fp%2F"+resb+"%2F";
	
             // newhtml+='  <a class="btn blue comtin" href="'+commentlink+'" target="_blank">Comment through Instagram</a>';
          newhtml+='  </div>';
    newhtml+='    </div>';
  newhtml+='  </div>';
newhtml+='</div>';

newhtml+='</div>';


newhtml+='   </li>';



  jQuery("#posttag").append(newhtml);
  

			   });
	
				
			
	
		


  
  

  }
}).fail(function (_d) {
  
  

 
	menucontrol(2,1,1);
	
shownoti("Something went wrong, Error Loading posts.");
	


            });


		
    
		
           
         
     

  
}
</script>