var offset = 1;
var searchData = null;
var target_path = get_target_path();
console.log(target_path);
$(document).ready(function () {    
    sortEvent();
    $(document).on("click",".load-more",function() {
        
        var _this = $(this);
        var sort = $('select[name="postTime"]').val();
        var url = siteurl + target_path +  "/"+offset+'/'+sort;
        
        $('.form-loader').show();
        var keywords = $('#jobsearch').val();
        var jobCatId = "",jobCat = "",jobtype = "",jtypefound = "",jobduratin = "",jobduratinfound = "",jobweekhour = "",jobweekhourfound = "",count = 0;
        var allSelected = 0;
        $('.choose-job-cat').each(function(){
            if($(this).is(":checked")){
                if($(this).val() == 0){
                    allSelected = 1;
                    $('.choose-job-cat').attr('checked',true);
                }else{
                    jobCat += $(this).val()+",";
                    count ++;
                }
            }
        });
        if(count > 0 && allSelected == 0){
            jobCatId = jobCat.substring(0, jobCat.length -1);
        }else{
            jobCatId = 0;
        }
        $('.jtype-check:checked').each(function () {
           if($('.jtype-check').is(":checked")){
               jobtype  += $(this).val()+",";
               jtypefound++;
           }
       });
        if(jtypefound > 0){
                jobtype = jobtype.substring(0, jobtype.length -1);
            }else{
                jobtype = "";
            }
         $('.jduration-check:checked').each(function () {
           if($('.jduration-check').is(":checked")){
               jobduratin  += $(this).val()+",";
               jobduratinfound++;
           }
       });
         if(jobduratinfound > 0){
                jobduratin = jobduratin.substring(0, jobduratin.length -1);
            }else{
                jobduratin = "";
            }
          $('.jhours-check:checked').each(function () {
           if($('.jhours-check').is(":checked")){
               jobweekhour  += $(this).val()+",";
               jobweekhourfound++;
           }
       });
       
        if(jobweekhourfound > 0){
                jobweekhour = jobweekhour.substring(0, jobweekhour.length -1);
            }else{
                jobweekhour = "";
            }
        searchData = {jobCat:jobCatId,limit:offset,keywords:keywords,jobtype:jobtype,jobduratin:jobduratin,jobweekhour:jobweekhour};
        
        $.ajax({
            url: url,
            data:(searchData),
            type:"post", 
            success: function (result) {
                var htmlJson = JSON.parse(result);
                $('.form-loader').hide();
                $('.job-data').append(htmlJson.result);
                offset++;
                
                if(htmlJson.count == 0){
                    _this.hide();
                }
        }});
    });
    
    $('.choose-job-cat').click(function(){
        $('.no-result-container').remove();
        var jobCat = "",jobCatId = "",jobtype = "",jtypefound = "",jobduratin = "",jobduratinfound = "",jobweekhour = "",jobweekhourfound = "",catfound = 0; 
        var val = $(this).val();

        if (val == 0) {
            $('.choose-job-cat[value!=0]').prop('checked', false);
        } else {
            $('.choose-job-cat[value=0]').prop('checked', false);
        }

        if ($('.choose-job-cat:checked').length == 0) {
            $('.choose-job-cat[value=0]').prop('checked', true);
        }

        if(val != 0){
            $('.choose-job-cat').each(function(){
                if($(this).is(":checked")){
                    jobCat += $(this).val()+",";
                    catfound ++;
                }
            });
            if(catfound > 0){
                jobCatId = jobCat.substring(0, jobCat.length -1);
            }else{
                jobCatId = 0;
            }
        }else{
            jobCatId = 0;
        }
        var keywords = $('#jobsearch').val();
        
        $('.jtype-check:checked').each(function () {
           if($('.jtype-check').is(":checked")){
               jobtype  += $(this).val()+",";
               jtypefound++;
           }
       });
        if(jtypefound > 0){
                jobtype = jobtype.substring(0, jobtype.length -1);
            }else{
                jobtype = "";
            }
         $('.jduration-check:checked').each(function () {
           if($('.jduration-check').is(":checked")){
               jobduratin  += $(this).val()+",";
               jobduratinfound++;
           }
       });
         if(jobduratinfound > 0){
                jobduratin = jobduratin.substring(0, jobduratin.length -1);
            }else{
                jobduratin = "";
            }
          $('.jhours-check:checked').each(function () {
           if($('.jhours-check').is(":checked")){
               jobweekhour  += $(this).val()+",";
               jobweekhourfound++;
           }
       });   
        if(jobweekhourfound > 0){
                jobweekhour = jobweekhour.substring(0, jobweekhour.length -1);
            }else{
                jobweekhour = "";
            }
        jobSearch(jobCatId,keywords,jobtype,jobduratin,jobweekhour);
    });
     $('.jtype-check').click(function(){
        var jobCat = "",jobCatId = "",jobtype = "",jtypefound = "",jobduratin = "",jobduratinfound = "",jobweekhour = "",jobweekhourfound = "",catfound = 0; 

        if (!$('.jtype-check[value=hourly]').is(':checked')) {
            $('#tob-hours').prev('li').hide();
            $('#tob-hours').hide();
        } else {
            $('#tob-hours').prev('li').show();
            $('#tob-hours').show();
        }

            $('.choose-job-cat').each(function(){
                if($(this).is(":checked")){
                    jobCat += $(this).val()+",";
                    catfound ++;
                }
            });
            if(catfound > 0){
                jobCatId = jobCat.substring(0, jobCat.length -1);
            }else{
                jobCatId = 0;
            }
       
        var keywords = $('#jobsearch').val();
        
        $('.jtype-check:checked').each(function () {
           if($('.jtype-check').is(":checked")){
               jobtype  += $(this).val()+",";
               jtypefound++;
           }
       });
        if(jtypefound > 0){
                jobtype = jobtype.substring(0, jobtype.length -1);
            }else{
                jobtype = "";
            }
         $('.jduration-check:checked').each(function () {
           if($('.jduration-check').is(":checked")){
               jobduratin  += $(this).val()+",";
               jobduratinfound++;
           }
       });
         if(jobduratinfound > 0){
                jobduratin = jobduratin.substring(0, jobduratin.length -1);
            }else{
                jobduratin = "";
            }
          $('.jhours-check:checked').each(function () {
           if($('.jhours-check').is(":checked")){
               jobweekhour  += $(this).val()+",";
               jobweekhourfound++;
           }
       });   
        if(jobweekhourfound > 0){
                jobweekhour = jobweekhour.substring(0, jobweekhour.length -1);
            }else{
                jobweekhour = "";
            }
        jobSearch(jobCatId,keywords,jobtype,jobduratin,jobweekhour);
    });
      $('.jduration-check').click(function(){
        var jobCat = "",jobCatId = "",jobtype = "",jtypefound = "",jobduratin = "",jobduratinfound = "",jobweekhour = "",jobweekhourfound = "",catfound = 0; 
       
            $('.choose-job-cat').each(function(){
                if($(this).is(":checked")){
                    jobCat += $(this).val()+",";
                    catfound ++;
                }
            });
            if(catfound > 0){
                jobCatId = jobCat.substring(0, jobCat.length -1);
            }else{
                jobCatId = 0;
            }
       
        var keywords = $('#jobsearch').val();
        
        $('.jtype-check:checked').each(function () {
           if($('.jtype-check').is(":checked")){
               jobtype  += $(this).val()+",";
               jtypefound++;
           }
       });
        if(jtypefound > 0){
                jobtype = jobtype.substring(0, jobtype.length -1);
            }else{
                jobtype = "";
            }
         $('.jduration-check:checked').each(function () {
           if($('.jduration-check').is(":checked")){
               jobduratin  += $(this).val()+",";
               jobduratinfound++;
           }
       });
         if(jobduratinfound > 0){
                jobduratin = jobduratin.substring(0, jobduratin.length -1);
            }else{
                jobduratin = "";
            }
          $('.jhours-check:checked').each(function () {
           if($('.jhours-check').is(":checked")){
               jobweekhour  += $(this).val()+",";
               jobweekhourfound++;
           }
       });   
        if(jobweekhourfound > 0){
                jobweekhour = jobweekhour.substring(0, jobweekhour.length -1);
            }else{
                jobweekhour = "";
            }
        jobSearch(jobCatId,keywords,jobtype,jobduratin,jobweekhour);
    });
       $('.jhours-check').click(function(){
        var jobCat = "",jobCatId = "",jobtype = "",jtypefound = "",jobduratin = "",jobduratinfound = "",jobweekhour = "",jobweekhourfound = "",catfound = 0; 
       
            $('.choose-job-cat').each(function(){
                if($(this).is(":checked")){
                    jobCat += $(this).val()+",";
                    catfound ++;
                }
            });
            if(catfound > 0){
                jobCatId = jobCat.substring(0, jobCat.length -1);
            }else{
                jobCatId = 0;
            }
       
        var keywords = $('#jobsearch').val();
        
        $('.jtype-check:checked').each(function () {
           if($('.jtype-check').is(":checked")){
               jobtype  += $(this).val()+",";
               jtypefound++;
           }
       });
        if(jtypefound > 0){
                jobtype = jobtype.substring(0, jobtype.length -1);
            }else{
                jobtype = "";
            }
         $('.jduration-check:checked').each(function () {
           if($('.jduration-check').is(":checked")){
               jobduratin  += $(this).val()+",";
               jobduratinfound++;
           }
       });
         if(jobduratinfound > 0){
                jobduratin = jobduratin.substring(0, jobduratin.length -1);
            }else{
                jobduratin = "";
            }
          $('.jhours-check:checked').each(function () {
           if($('.jhours-check').is(":checked")){
               jobweekhour  += $(this).val()+",";
               jobweekhourfound++;
           }
       });   
        if(jobweekhourfound > 0){
                jobweekhour = jobweekhour.substring(0, jobweekhour.length -1);
            }else{
                jobweekhour = "";
            }
        jobSearch(jobCatId,keywords,jobtype,jobduratin,jobweekhour);
    });
      
     
    $('.search-btn-cat').click(function(){
        var keywords = $('#jobsearch').val();
        var jobCat = "";
        var catfound = 0;
        var jobCatId = "",jobtype = "",jtypefound = "",jobduratin = "",jobduratinfound = "",jobweekhour = "",jobweekhourfound = "";
        $('.choose-job-cat').each(function(){
            if($(this).is(":checked")){
                jobCat += $(this).val()+",";
                catfound ++;
            }
        });
        if(catfound > 0){
            jobCatId = jobCat.substring(0, jobCat.length -1);
        }else{
            jobCatId = 0;
        }
        $('.jtype-check:checked').each(function () {
           if($('.jtype-check').is(":checked")){
               jobtype  += $(this).val()+",";
               jtypefound++;
           }
       });
        if(jtypefound > 0){
                jobtype = jobtype.substring(0, jobtype.length -1);
            }else{
                jobtype = "";
            }
         $('.jduration-check:checked').each(function () {
           if($('.jduration-check').is(":checked")){
               jobduratin  += $(this).val()+",";
               jobduratinfound++;
           }
       });
         if(jobduratinfound > 0){
                jobduratin = jobduratin.substring(0, jobduratin.length -1);
            }else{
                jobduratin = "";
            }
          $('.jhours-check:checked').each(function () {
           if($('.jhours-check').is(":checked")){
               jobweekhour  += $(this).val()+",";
               jobweekhourfound++;
           }
       });   
        if(jobweekhourfound > 0){
                jobweekhour = jobweekhour.substring(0, jobweekhour.length -1);
            }else{
                jobweekhour = "";
            }
        
        if(keywords.length > 0){
           jobSearch(jobCatId,keywords,jobtype,jobduratin,jobweekhour); 
        }else{
            jobSearch(jobCatId,"",jobtype,jobduratin,jobweekhour);
        }
    });
    
    $('.search-btn-home').click(function(){
        var keywords = $('#jobsearch').val();
        if(keywords.length > 0){
           $("#job-search-form").submit();
        }
    });
});

function jobSearch(val,keywords,jobtype,jobduratin,jobweekhour){
    $('.job-searching').html("Searching......");
    var offset=1;
    var sort = $('select[name="postTime"]').val();
    var url = siteurl + target_path + "/"+offset+'/'+sort;
    //console.log(url);
    var data = {
                jobCat:val,
                limit:0,
                keywords:keywords,
                jobtype:jobtype,
                jobduratin:jobduratin,
                jobweekhour:jobweekhour};
    searchData = data;
    console.log(searchData);
    $.ajax({
        url: url,
        data:(data),
        type:"post",
        success: function (result) {
        result = JSON.parse(result);
        console.log(result);
            $('.job-searching').html("My Job Feed");
            $('#all-jobs').html(result.result.trim());
            $('.jobs-found').text('Total ' + result.count + ' jobs found');

            offset++;
            if(result.count == 0){
                $('.load-more').hide();
            }else if(result.count > 0){
                $('.load-more').show();
            }
            
    },error:function(error){
        console.log(error.responseText);
        $('.job-searching').html("My Job Feed");
    }});
}

function getCat() {
    var pathparts = window.location.pathname.split('/');
    return pathparts[pathparts.length-1];
}

function sortEvent(offset){
    var url = siteurl + target_path +  "/"+offset;
    $('select[name=postTime]').change(function() {
        $('.no-result-container').remove();
        $('.load-more').show();
        var orderby = $(this).val();
        if(searchData == null){
            var selCat = getCat();
            console.log($.isNumeric(selCat));
            var keywords = $('#jobsearch').val();
            var jobCat = $.isNumeric(selCat) ? selCat : "";
            var catfound = 0;
            var jobCatId = "",jobtype = "",jtypefound = "",jobduratin = "",jobduratinfound = "",jobweekhour = "",jobweekhourfound = "";
            searchData = {
                jobCat:jobCat,
                //limit:offset,
                keywords:keywords,
                jobtype:jobtype,
                jobduratin:jobduratin,
                jobweekhour:jobweekhour,
                orderby: orderby
            };
        }
        if(typeof searchData.limit !== 'undefined'){
            delete searchData.limit;
        }
        
        console.log(searchData);
           var sort = $(this).val();
           $.ajax({
               url: url + '/' + sort,
               data:searchData,
               type:"post",
               success: function (result) {
                    //console.log(result);
                    var htmlJson = JSON.parse(result);
                    $('.form-loader').hide();
                    //$('.job-data').html(htmlJson.result);
                    $('#all-jobs').html(htmlJson.result);
                    offset++;
                    
                    if(htmlJson.count == 0){
                        $('.load-more').hide();
                    }
//                    else if(htmlJson.count > 0){
//                         $('.load-more').show();
//                    }else{
//                        $('.load-more').hide();
//                    }
                },
                error:function(err){
                    console.log(err.responseText);
                }
            });
       });
}