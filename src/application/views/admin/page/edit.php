<div class="modal-header">
    <h3><?php echo empty($page ->id)?'Add a new page':'Edit Page '.$page->title; ?></h3>
    <p>Please log in using your credential</p>
</div>
<div>
    <?php //echo print_r($this->session->userdata); ?>
    <?php //var_dump( hash('sha1', '111111')); ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open(); ?>
    <table>
        <tr>
            <td>Parent </td>
            <td><?php echo form_dropdown('parent_id', $pages_no_parents, $this->input->post('parent_id')?$this->input->post('parent_id'):$page->parent_id); ?></td>
        </tr>
        <tr>
            <td>Title</td>
            <td><?php echo form_input('title', set_value('title',$page->title)); ?></td>
        </tr>
        <tr>
            <td>Slug</td>
            <td><?php echo form_input('slug',set_value('slug',$page->slug)); ?></td>
        </tr>
        <tr>
            <td>Body</td>
            <td><?php echo form_textarea('body', set_value('body', $page->body)); ?></td>
        </tr>
        <tr>
            <td>Meta Keywords</td>
            <td><?php echo form_input('meta_keywords',set_value('meta_keywords',$page->meta_keywords)); ?></td>
        </tr>
        <tr>
            <td>Meta Description</td>
            <td><?php echo form_input('meta_description',set_value('meta_description',$page->meta_description)); ?></td>
        </tr>
        <tr>
            <td></td>
            <td><?php echo form_submit('submit','Save', 'class="btn btn-primary"'); ?></td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>