    <h4><?php echo empty($recipes->id)?'Add a New Recipe':'View Recipe Details of '.$recipes->recipe_title;  ?></h4>
    
    <input type="hidden" id="hiddenBaseUrl" value="<?php echo(base_url()); ?>" />
    
    <table class="table ">
        <tr>
            <td class="tablefield">Recipe Title</td>
            <td class="tabledata"><?php echo $recipes->recipe_title; ?></td>
        </tr> 
        <tr>
            <td class="tablefield">Recipe Description</td>
            <td class=""><?php echo $recipes->recipe_description; ?></td>            
        </tr>              
        <tr>
            <td class="tablefield">Recipe Image</td>
            <td class="" colspan="1"><?php $image = ($recipes->recipe_image=='')?'no_image.gif':'recipes/'.$recipes->recipe_image;?>
                <img src="<?php echo base_url('uploads/'.$image); ?>" width="200"/></td>
        </tr>        
        <tr>
            <td class="tablefield">Status</td>
            <td class=""><?php echo ($recipes->status=='1')?'Enabled':'Disabled'; ?></td>
        </tr>      

        <tr>
            <td></td>
            <td  colspan="6"><?php echo anchor('admin/recipe/edit/'.$recipes->id,'Edit','class="btn btn-success"'); ?> &nbsp;
                <?php echo anchor('admin/recipe/','Cancel','class="btn btn-default"'); ?>&nbsp;
            </td>
        </tr>
    </table>
   