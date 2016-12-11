<div id="reg_form">

        <hi>Register! ect...</hi>


    <?php
    echo form_open('login/create_account');
    echo form_input('email', set_value('email', 'Email Address'));
    echo form_input('username', set_value('username','Username'));
    echo form_password('password', '', 'placeholder="Password" class="Password"');
    echo form_password('password_confirm', '', 'placeholder="Confirm Password" class="Password_confirm"');
    echo form_submit('submit', 'Create Account');
    echo form_close();
    ?>

    <?php echo validation_errors('<p class="error">');?>

</div>