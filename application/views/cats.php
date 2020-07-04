<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Categories</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>

<div id="container">
	<h1>Select category</h1>

	<div id="body">
		<label class="control-label col-md-3">Main category</label>
        <div class="col-md-4">
            <?php echo form_dropdown('main_cats', $main_categories, 0, 'class="form-control cat main-cats"');?>
        </div>
        
        <div class="sub_cat"></div>
	</div>


</div>

<script>

$('body').on("change", ".main-cats", function(){
    $("div.sub_cat").remove();
    $( "#body" ).append( "<div class='sub_cat'></div>" );    
});

$('body').on("change", '.cat', function(){
    var parentId = $(this).find('option:selected').val();
    
    if(parentId != 0)
    {
        
        postData = {parentId: parentId};
        if($("#catsDiv" + parentId).length == 0) {
            $.post( 'http://localhost/multi-level-cats/Home/get_sub_cats/', postData, function(result){
                $('.sub_cat').last().html(result);
            });
        }
    }
});
</script>

</body>
</html>