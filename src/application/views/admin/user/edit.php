<div class="modal-header">
    <h3><?php echo empty($user->id)?'Add a new User':'Edit User '.$user->name; ?></h3>
    <p>Please log in using your credentials</p>
</div>
<div class="modal-body">
    <?php //echo print_r($this->session->userdata); ?>
    <?php //var_dump( hash('sha1', '111111')); ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open(); ?>
    <table>
        <tr>
            <td>Name</td>
            <td><?php echo form_input('name', set_value('name',$user->name)); ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo form_input('email',set_value('email',$user->email)); ?></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><?php echo form_password('password'); ?></td>
        </tr>
        <tr>
            <td>Confirm Password</td>
            <td><?php echo form_password('password_confirm'); ?></td>
        </tr>
        <tr>
            <td></td>
            <td><?php echo form_submit('submit','Log in', 'class="btn btn-primary"'); ?></td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>