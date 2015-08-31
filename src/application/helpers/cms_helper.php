<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Dharshana
 * Date: 6/2/13
 * Time: 12:10 PM
 * To change this template use File | Settings | File Templates.
 */
function btn_edit($uri){
    return anchor($uri, '<i class="icon-edit"></i>');
}
function btn_delete($uri){
    return anchor($uri, '<i class="icon-remove"></i>', array(
        'onclick' => "return confirm('Are you sure you want to delete this User?');")
    );
}