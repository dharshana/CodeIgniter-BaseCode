<section>
    <h4>Downloads</h4>
    <?php echo anchor('admin/download/edit','<i class="glyphicon glyphicon-plus"></i> Add a Download'); ?>

    <!-- message displaying-->
    <?php if(isset($_GET['inserted']) && $_GET['inserted']==true){ ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>New Download Item Successfully <b>Inserted</b>!
    </div>
        <?php } ?>
    <?php if(isset($_GET['updated']) && $_GET['updated']==true){ ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>Download Item Details Successfully <b>Updated</b>!
    </div>
        <?php } ?>
    <?php if(isset($_GET['deleted']) && $_GET['deleted']==true){ ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>Download Item Successfully <b>Deleted</b>!
    </div>
        <?php } ?>
    <table>
    <?php echo form_open('admin/download/search');?>
        <tr>
            <td style="padding-bottom: 12px;"> Select Category : </td>
            <td> <?php echo form_dropdown('download_type',$download_type_list,isset($_REQUEST['download_type'])?$_REQUEST['download_type']:''); ?></td>
            <td style="padding-bottom: 12px;"> <?php echo ' &nbsp; '.form_submit('submit','Search','class="btn btn-success"'); ?>
            </td>
        </tr>
        <?php echo form_close();?>
    </table>

    <?php if(isset($_GET['error'])){ ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button><b><?php echo urldecode($_GET['error']); ?></b>
    </div>
    <?php } ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Download Type</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($downloadLists)): foreach ($downloadLists as $downloadList): ?>
                <tr>
                    <td><?php echo anchor('admin/download/edit/'.$downloadList->id, $downloadList->title); ?></td>
                    <td><?php echo $this->download_type_m->get($downloadList->download_type_id)->download_type; ?></td>
                    <td><?php echo ($downloadList->enable=='1')?'Enabled':'Disabled'; ?></td>
                    <td><?php echo btn_edit('admin/download/edit/'.$downloadList->id); ?></td>
                    <td><?php echo btn_delete('admin/download/delete/'.$downloadList->id); ?></td>
                </tr>
            <?php endforeach; ?>
                <tr>
                    <td colspan="6"><?php echo $paginationLinks; ?></td>
                </tr>

            <?php else: ?>
                <tr>
                    <td colspan="6">We could not find any downloads </td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>
</section>