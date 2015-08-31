<section class="sortable_table">
    <h4>Recipe</h4>
    <section id="msage">

    </section>
    <?php echo anchor('admin/recipe/edit','<i class="glyphicon glyphicon-plus"></i> Add a Recipe'); ?>

    <!-- message displaying-->
    <?php if(isset($_GET['inserted']) && $_GET['inserted']==true){ ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>New Recipe Successfully <b>Inserted</b>!
    </div>
        <?php } ?>
    <?php if(isset($_GET['updated']) && $_GET['updated']==true){ ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>Recipe Details Successfully <b>Updated</b>!
    </div>
        <?php } ?>
    <?php if(isset($_GET['deleted']) && $_GET['deleted']==true){ ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>Recipe Successfully <b>Deleted</b>!
    </div>
        <?php } ?>

    <button type="button" class="btn btn-sm btn-default change_oder_btn_trig change_oder_btn pull-right">Change oder</button>

    <div class="btn-group save_oder_btn_gp pull-right">
        <button type="button" class="btn btn-default btn-sm save_oder_cancel">Cancel</button>
        <button type="button" class="btn btn-sm btn-default save_oder_btn_trig save_oder_btn">Save oder</button>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Recipe Title</th>
                <!-- <th>Recipe Type</th> -->
                <th>Recipe Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="sortable_table_body">
            <?php if (count($recipes)): foreach ($recipes as $recipe): ?>
                <tr id="<?php echo $recipe->order_column; ?>">
                    <td class="hide order_num"><?php echo $recipe->id; ?></td>
                    <td class="hide"><?php echo $recipe->order_column; ?></td>
                    <td><?php echo anchor('admin/recipe/view/'.$recipe->id, $recipe->recipe_title); ?></td>
                    <!-- <td><?php //if($recipe->recipe_type=='1'){//echo '<span class="glyphicon glyphicon-picture"></span> Image';}//elseif($recipe->recipe_type=='2'){//echo '<span class="glyphicon glyphicon-film"></span> Video';}; ?></td> -->
                    <td><?php echo ($recipe->status)?'Enable':'Disable'; ?></td>
                    <td><?php echo btn_edit('admin/recipe/edit/'.$recipe->id); ?></td>
                    <td><?php echo btn_delete('admin/recipe/delete/'.$recipe->id); ?></td>
                </tr>
            <?php endforeach; ?>

            <?php else: ?>
                <tr>
                    <td colspan="5">We could not find any Recipes </td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>
</section>