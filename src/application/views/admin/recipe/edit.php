<div class="modal-header">
    <h4><?php echo empty($recipes ->id)?'Add a New Recipe':'Edit Recipe :: '.$recipes->recipe_title; ?></h4>
</div>
<div>
    <?php echo validation_errors('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>','</div>'); ?>
    <?php echo form_open_multipart(); ?>
    <table class="table">
 
        <tr>
            <td class="tablefield">Recipe Title<span class="mandatory">*</span></td>
            <td><?php echo form_input('recipe_title', set_value('recipe_title',$recipes->recipe_title)); ?></td>
            <!-- <td><input type="text"   value="a" name="recipe_title" id="recipe_title"></td> -->
        </tr>

         <tr>
            <td class="tablefield">Recipe Image</td>
            <td>
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Select files...</span>
                    <!-- The file input field used as target for the file upload widget -->
                    <input id="fileupload" type="file" name="fileupload">
                    <!-- File name set in hidden field -->
                    <input type="hidden" name="recipe_image" id="recipe_image" value="<?php echo set_value('recipe_image',$recipes->recipe_image)?>">
                </span>
                <span class="tooltipnew">*The photo you upload must be <b>160px</b> width and <b>110px</b> height</span><br/>
                <!-- Erro message -->
                <span class="tooltip_error" id='error_msg'></span><br/>
                <!-- Image preview -->
                <?php $image = (set_value('recipe_image',$recipes->recipe_image)=='')?'no_image.gif':'recipes/'.set_value('recipe_image',$recipes->recipe_image);?>
                <img src="<?php echo base_url('uploads/'.$image); ?>" width="200" id='image_pre'/>
            </td>
 
        </tr>
        <!--<tr>
            <td class="tablefield">Recipe Vedio</td>
            <td>
                <?php //echo form_input('recipe_vedio', set_value('recipe_vedio',$recipes->recipe_vedio)); ?>
            </td>
        </tr> -->
        <tr>
        <td class="tablefield">Status</td>
        <td><?php

                $enable_options = array(
                    '1'   => 'Enable',
                    '0'   => 'Disable',
                );

                echo form_dropdown('status', $enable_options, $recipes->status); ?></td>
        </tr>        
                    
        <tr>
            <td></td>
            <td><?php echo form_submit('submit','Save', 'class="btn btn-success" onclick="form_validate(this)"'); ?>
            <?php echo anchor('admin/recipe/','Cancel','class="btn btn-default"'); ?></td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>

<!-- Ajax File uploader -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery.fileupload.blueimp.css') ?>">
<script src="<?php echo base_url('js/jquery.fileupload.blueimp.js') ?>"></script>
<script>
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : '<?php echo base_url("admin/recipe/do_upload") ?>';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        success:function(e, data) {
            // check error occur
            if(e.status==='error'){
                // set codeigniter validation error
                $("#error_msg").append().html('<div class="alert alert-danger">'+e.ci_error+'.</div>');
                // remove the image name in hidden field
                $('#recipe_image').val('');
                // set no image
                $('#image_pre').attr('src', "<?php echo base_url('uploads/no_image.gif') ?>");
                // show message 4 sec and slide up
                $("#error_msg .alert").delay( 4000 ).slideUp( 500,function()
                {
                    // remove the error message
                    $("#error_msg").html('');
                });
            }
            else
            {
                // remove error masage 
                $('#error_msg').html('');
                // set the renamed img name in hidden field
                $('#recipe_image').val(e.image_name);
                // set image in preview section
                var image_full_path = "<?php echo base_url('uploads/recipes') ?>/"+e.image_name;
                $('#image_pre').attr('src', image_full_path);
            }
        },
        done: function (e, data) {
            // $.each(data.result.files, function (index, file) {
            //     $('<p/>').text(file.name).appendTo('#fileupload');
            // });
        },
        progressall: function (e, data) {
            // var progress = parseInt(data.loaded / data.total * 100, 10);
            // $('#progress .progress-bar').css(
            //     'width',
            //     progress + '%'
            // );
        },
        error:function(e,data) {
            console.log(e);
            // set codeigniter validation error
            $("#error_msg").append().html('<div class="alert alert-danger">Your file is not uploaded.</div>');
            $("#error_msg .alert").slideDown('slow');
            // remove the image name in hidden field
            $('#recipe_image').val('');
            // set no image
            $('#image_pre').attr('src', "<?php echo base_url('uploads/no_image.gif') ?>");
            // show message 4 sec and slide up
            $("#error_msg .alert").delay( 4000 ).slideUp( 500,function()
            {
                // remove the error message
                $("#error_msg").html('');
            });
        }

    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
<script type="text/javascript">
    // validate the image upload part using submit button onclick event using
    // bz if ajax submit validate after submit the form
    function form_validate(event) {
        var recipe_image = document.getElementById('fileupload');        
        // is image set?
        if ($('#recipe_image').val()=='')
        {
            //  remove the image upload back end error message
            $('#error_msg').html('')
            // set html5 custome message
            recipe_image.setCustomValidity('Please upload the image');
            // focus the error
            recipe_image.focus();
            return false;           
        }
        else
        {
            // remove html5 custome message
            recipe_image.setCustomValidity('');
        }
    }
</script>