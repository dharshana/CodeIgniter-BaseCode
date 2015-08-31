<div class="modal-header">
    <h4><?php echo empty($download ->id)?'Add a New Download':'Edit Download :: '.$download->title; ?></h4>
</div>
<div>
    <?php //echo print_r($this->session->userdata); ?>
    <?php //var_dump( hash('sha1', '111111')); ?>
    <?php if(isset($_GET['invalied'])){ ?>
            <div class="alert alert-danger">Invalied file type for selected upload type<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
        <?php } ?>
    <?php echo validation_errors('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>','</div>'); ?>
    <?php echo form_open_multipart(); ?>
    <table class="table">
        <tr>
            <td class="tablefield">Title<span class="mandatory">*</span></td>
            <td><?php echo form_input('title', set_value('title',$download->title)); ?></td>
        </tr>
        <tr>
            <td colspan="2"> 
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Select file...</span>
                    <!-- The file input field used as target for the file upload widget -->
                    <input id="fileupload" type="file" name="fileupload">
                    <!-- File name set in hidden field -->
                    <input type="hidden" name="path" id="path" value="<?php echo set_value('path',$download->path)?>" >
                    <input type="hidden" name="download_type_id" id="download_type_id" value="<?php echo set_value('download_type_id',$download->download_type_id)?>" >
                </span>
                <span class="tooltipnew">*The photo you uploaded must be 600 pixels wide and 300 pixels height</span><br/>
                <div id="progress" class="progress" style="width:440px">
                    <div class="progress-bar progress-bar-success"></div>
                </div>
                <!-- /.progress bar -->
                <!-- Erro message -->
                <span class="tooltip_error" id='error_msg'></span><br/>
                
                <!-- file uploader preview -->
                <div id='file_upload_pre'>
                    <?php 
                        // audio element
                        if ((set_value('download_type_id',$download->download_type_id) == 1) &&( set_value('path',$download->path)!='') ) {

                            $sound = (set_value('path',$download->path)=='')?'uploads/no_image.gif':'uploads/download/'.set_value('path',$download->path); 

                             $html = '<audio controls>
                                        <source src="'.base_url($sound).'" type="audio/mpeg">
                                           Your browser does not support the audio element.
                                    </audio>';

                            echo($html);
                            
                        }
                        // video element
                        elseif ((set_value('download_type_id',$download->download_type_id) == 2) &&( set_value('path',$download->path)!='') ) {
                            
                            $video = 'uploads/download/'.set_value('path',$download->path); 

                            $html = '<video width="320" height="240" controls>
                                        <source src="'.base_url($video).'" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>';

                            echo($html);
                        }
                        // image element
                        elseif ((set_value('download_type_id',$download->download_type_id) == 3) &&( set_value('path',$download->path)!='') ) {

                            $image = (set_value('path',$download->path)=='')?'uploads/no_image.gif':'uploads/download/'.set_value('path',$download->path);

                            $html = '<img src="'.base_url($image).'" width="200"/>';

                            echo($html);

                        }
                        // not upload the file
                        else{

                            $html = "<img src='".base_url('uploads/no_image.gif')."'>";
                            echo($html);
                        }
                    ?>
                </div><!-- /.file_upload_pre -->
            </td>            
        </tr>
        <tr>
            <td class="tablefield">Status<span class="mandatory">*</span></td>
            <td><?php

                    $enable_options = array(
                        '1'   => 'Enable',
                        '0'   => 'Disable',
                    );

                    echo form_dropdown('enable', $enable_options, $download->enable); ?>
            </td>
        </tr>        
           
        <tr>
            <td></td>
            <td><?php echo form_submit('submit','Save', 'class="btn btn-success" onclick="form_validate(this)"'); ?>
            <?php echo anchor('admin/download/','Cancel','class="btn btn-default"'); ?></td>

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
                '//jquery-file-upload.appspot.com/' : '<?php echo base_url("admin/download/do_upload") ?>';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        success:function(e, data) {
            // check error occur
            if(e.status==='error'){
                // set codeigniter validation error
                $("#error_msg").append().html('<div class="alert alert-danger">'+e.ci_error+'.</div>');
                // remove the image name in hidden field
                $('#path').val('');
                $('#download_type_id').val('');
                // set image in preview section
                    var full_path = "<?php echo base_url('uploads/no_image.gif') ?>";
                    // $('#image_pre').attr('src', full_path);
                    var html ="<img src='"+full_path+"' width='200px'>";
                    $('#file_upload_pre').html(html);

                // show message 4 sec and slide up
                $("#error_msg .alert").delay( 4000 ).slideUp( 500,function()
                {
                    // remove the error message
                    $("#error_msg").html('');
                });
            }
            else
            {
                
                // set the renamed img name in hidden field
                $('#path').val(e.file_name);
                $('#download_type_id').val(e.download_type_id);
                
                // audio file type
                if (e.download_type_id=='1')
                {
                    var full_path = "<?php echo base_url('uploads/download') ?>/"+e.file_name;
                    var html ="<audio controls>"+
                                "<source src='"+full_path+"' type='audio/mpeg'>"+
                                   "Your browser does not support the audio element."+
                                "</audio>";
                    $('#file_upload_pre').html(html);
                }
                // video file type
                else if (e.download_type_id=='2')
                {
                    var full_path = "<?php echo base_url('uploads/download') ?>/"+e.file_name;
                    var html ="<video width='320' height='240' controls>"+
                                    "<source src='"+full_path+"' type='video/mp4'>"+
                                    "Your browser does not support the video tag."+
                                "</video>";
                    $('#file_upload_pre').html(html);

                }
                // image file type
                else if (e.download_type_id=='3')
                {
                    // set image in preview section
                    var full_path = "<?php echo base_url('uploads/download') ?>/"+e.file_name;
                    // $('#image_pre').attr('src', full_path);
                    var html ="<img src='"+full_path+"' width='200px'>";
                    $('#file_upload_pre').html(html);
                }
                // if other file type
                else
                {
                    // #code
                }

                
            }
        },
        done: function (e, data) {
            // $.each(data.result.files, function (index, file) {
            //     $('<p/>').text(file.name).appendTo('#fileupload');
            // });
        },
        progressall: function (e, data) {
            console.log(data.loaded);
            // remove the preview
            $('#file_upload_pre').html('');
            // progress bar value change
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css('width', progress + '%');

        },
        error:function(e,data) {
            // remove the progress bar 
            $('#progress .progress-bar').css('width','0%');
            // set codeigniter validation error
            $("#error_msg").append().html('<div class="alert alert-danger">Your file is not uploaded.</div>');
            // clear hidden fields
            $('#path').val('');
            $('#download_type_id').val('');
            // set image in preview section
            var full_path = "<?php echo base_url('uploads/no_image.gif') ?>";
            var html ="<img src='"+full_path+"' width='200px'>";
            $('#file_upload_pre').html(html);

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
        var download_image = document.getElementById('fileupload');        
        // is image set?
        if ($('#path').val()=='')
        {
            //  remove the image upload back end error message
            $('#error_msg').html('')
            // set html5 custome message
            download_image.setCustomValidity('Please upload file');
            // focus the error
            download_image.focus();
            return false;           
        }
        else
        {
            // remove html5 custome message
            download_image.setCustomValidity('');
        }
    }
</script>