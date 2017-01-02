<div id="login_form">
    <?php if (isset($result)) { ?>
        <div id="welome">
            <h1>Welcome <?php echo $result; ?></h1>
            You have successfully Registered yourself. </br> Please check your emails for a validation link & then login ;)
        </div>


    <?php } else { ?>
        <h1>Login</h1>
    <?php } ?>

    <?php
    echo form_open('login/validate_credentials','"class="form-horizonta"');

    echo '<div class="form-group">';
    echo form_label('Email:','',['class'=>'col-md-5 control-label']);
    echo '<div class="col-md-5">';
    echo form_input('email', set_value('email', 'Email Address'),'class="form-control"');
    echo '</div></div>';


    echo '<div class="form-group">';
    echo form_label('Password:','',['class'=>'col-md-5 control-label']);
    echo '<div class="col-md-5">';
    echo form_password('password', '', 'placeholder="Password" class="form-control"');
    echo '</div></div>';

    echo form_submit('submit', 'Login');
    echo anchor('register', 'Create Account');
    echo form_close();
    ?>
    <?php echo validation_errors('<p class="error">');?>

</div>