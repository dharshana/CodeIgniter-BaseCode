<div class="modal-header">
    <h3>Log in</h3>
    <p>Please log in using your credentials</p>
</div>
<div class="modal-body">
    <pre><?php //echo print_r($this->session->userdata); ?></pre>
    <?php //var_dump( hash('sha1', '111111')); ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open(); ?>
        <table>
            <tr>
                <td>Email</td>
                <td><?php echo form_input('email'); ?></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><?php echo form_password('password'); ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?php echo form_submit('submit','Log in', 'class="btn btn-primary"'); ?></td>
            </tr>
        </table>
    <?php echo form_close(); ?>
</div>