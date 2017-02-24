 <script>
    var data = [];
</script>
<?php  
if(sizeof($skillList) > 0){
    foreach($skillList as $skill){
     ?>
    <script>
        data.push("<?php echo $skill->skill_name; ?>");
    </script>
    <?php
            }
        }
    ?>
<script type="text/javascript">
$(function() {
    function split( val ) {
        return val.split( /,\s*/ );
    }
    function extractLast( term ) {
        return split( term ).pop();
    }
    
    $( ".autocomplete" ).bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
            event.preventDefault();
        }
    })
    .autocomplete({
        minLength: 1,
        source: function( request, response ) {
            // delegate back to autocomplete, but extract the last term//
            //$.getJSON("", { term : extractLast( request.term )},response);
            var searched = extractLast( request.term );
            var i;
            var matchWord = [];
            for (i = 0; i < data.length; i++) {
                if(data[i].substr(0, searched.length).toUpperCase() == searched.toUpperCase()){
                   matchWord.push(data[i]); 
                }
            }
            response(matchWord
            /*$.map( values, function( item ) {
                    var code = item.split(",");
                    return {
                        label: code[0],
                        value: code[0],
                        data : item
                    }
            })*/
            );
        },
        focus: function() {
            // prevent value inserted on focus
            return false;
        },
        select: function( event, ui ) {
            var terms = split( this.value );
            if(terms.length <= 5) {
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.value );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( ", " );
                return false;
            }else{
                var last = terms.pop();
                $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                $(this).effect("highlight", {}, 1000);
                $(this).attr("style","border: solid 1px red;");
                return false;
            }
        }
    });
});

</script>
