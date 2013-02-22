<style type = "text/css">
<!--
table.self-style tr th {
    width: 200px;
}
--> 
</style>

<table class="table table-bordered table-condensed self-style">
    <tr>
        <th>
            <?php echo __('Username'); ?>
        </th>
        <td>
            <?php echo $this->Form->input('username', array('type' => 'text')); ?>
        </td>
    </tr>
    <tr>
        <th>
            <?php echo __('Name'); ?>
        </th>
        <td>
            <?php echo $this->Form->input('name', array('type' => 'text')); ?>
        </td>
    </tr>
</table>

<?php
    if ( $this->Form->params['action'] == 'edit' ) {
        echo $this->Form->input('update_password_flg', array('type' => 'checkbox', 'id'=>'update_password_flg', 'label' => __('Update Password Flg'), 'div'=>false));
    }
?>

<div id="password_wrapper">
    <table class="table table-bordered table-condensed self-style">
        <tr>
            <th>
                <?php echo __('Password'); ?>
            </th>
            <td>
                <?php echo $this->Form->input('password'); ?>
            </td>
        </tr>
        <tr>
            <th>
                <?php echo __('Password Confirm'); ?>
            </th>
            <td>
                <?php echo $this->Form->input('password_confirm', array('type' => 'password')); ?>
            </td>
        </tr>
    </table>
</div>
