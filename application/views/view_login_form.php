<div id="login_form">
    <?php if (isset($result)) { ?>
        <div id="welome">
            <h1>Welcome <?php echo $result; ?></h1>
            You have successfully Registered yourself. </br> Please check your emails for a validation link & then login ;)
        </div>


    <?php } else { ?>
        <h1>Login & enter blabla TODO</h1>
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