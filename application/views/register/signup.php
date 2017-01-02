<div id="reg_form">

       <!--<h1>Register! ect...</h1>-->
    <script>
        $(document).ready(function() {
            $('#identicalForm').formValidation();
        });
    </script>

    <?php
    echo form_open('register/create_account','"class="form-horizonta" data-fv-framework="bootstrap"
    data-fv-icon-valid="glyphicon glyphicon-ok"
    data-fv-icon-invalid="glyphicon glyphicon-remove"
    data-fv-icon-validating="glyphicon glyphicon-refresh"');
    echo '<legend>Register!</legend>';
    echo form_fieldset();

    echo '<div class="form-group">';
    echo form_label('Email:','',['class'=>'col-md-5 control-label']);
    echo '<div class="col-md-5">';
    echo form_input('email', set_value('email', 'Email Address'),'class="form-control"');
    echo '</div></div>';

    echo '<div class="form-group">';
    echo form_label('Username:','',['class'=>'col-md-5 control-label']);
    echo '<div class="col-md-5">';
    echo form_input('username', set_value('username','Username'),'class="form-control"');
    echo '</div></div>';

    echo '<div class="form-group">';
    echo form_label('Password:','',['class'=>'col-md-5 control-label']);
    echo '<div class="col-md-5">';
    echo form_password('password', '', 'placeholder="Password" class="form-control"');
    echo '</div></div>';

    echo '<div class="form-group">';
    echo form_label('Password confirmation:','',['class'=>'col-md-5 control-label']);
    echo '<div class="col-md-5">';
    echo form_password('password_confirm', '', 'placeholder="Confirm Password" class="form-control" name="confirmPassword"
                data-fv-identical="true"
                data-fv-identical-field="password"
                data-fv-identical-message="The password and its confirm are not the same"');
    echo '</div></div>';


    echo form_submit('submit', 'Create Account');

    echo form_fieldset_close();
    echo form_close();
    ?>


    <?php echo validation_errors('<p class="error">');?>

</div>