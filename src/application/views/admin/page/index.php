<section class="sortable_table">
    <h2>Pages</h2>
    <?php echo anchor('admin/page/edit','<i class="icon-plus"></i> Add a page'); ?>

    <button type="button" class="btn btn-sm btn-default change_oder_btn_trig change_oder_btn pull-right">Change oder</button>

    <div class="btn-group save_oder_btn_gp pull-right">
        <button type="button" class="btn btn-default btn-sm save_oder_cancel">Cancel</button>
        <button type="button" class="btn btn-sm btn-default save_oder_btn_trig save_oder_btn">Save oder</button>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="hide">#</th>
                <th class="hide">Order</th>
                <th>Title</th>
                <th>Parent</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="sortable_table_body">
            <?php if (count($pages)): foreach ($pages as $page): ?>
                <tr id="<?php echo $page->order_column; ?>">
                    <td class="hide order_num"><?php echo $page->id; ?></td>
                    <td class="hide"><?php echo $page->order_column; ?></td>
                    <td><?php echo anchor('admin/page/edit/'.$page->id, $page->title); ?></td>
                    <td><?php echo ($page->parent_id==0)?'':$this->page_m->get($page->parent_id)->title; ?></td>
                    <td><?php echo btn_edit('admin/page/edit/'.$page->id); ?></td>
                    <td><?php echo btn_delete('admin/page/delete/'.$page->id); ?></td>
                </tr>
            <?php endforeach; ?>
                <tr>
                    <td colspan="4"><?php echo $paginationLinks; ?></td>
                </tr>

            <?php else: ?>
                <tr>
                    <td colspan="4">We could not find any users </td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>
</section>