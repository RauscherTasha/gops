<div id="login_form">
    <?php if (isset($accoun_created)) { ?>
        <h3><?php echo $accoun_created; ?></h3>
    <?php } else { ?>
        <hi>Login & enter blabla TODO</hi>
    <?php } ?>

    <?php
    echo form_open('login/validate_credentials');
    echo form_input('username', 'Username');
    echo form_password('password', '', 'placeholder="Password" class="Password"');
    echo form_submit('submit', 'Login');
    echo anchor('login/signup', 'Create Account');
    echo form_close();
    ?>
    <?php echo validation_errors('<p class="error">');?>

</div>