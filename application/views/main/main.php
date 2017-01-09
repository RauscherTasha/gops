
<?php if ($logged_in) { ?>
    <div id="welome">
        <h1>Welcome to the main menu <?php echo $this->session->userdata('username'); ?></h1>
    </div>
    <?php     echo anchor('main/add_friend', 'add_friend_Test');
?>


    <?php } else { ?>
    <h1>O.o why are you doing here?</h1>
<?php } ?>