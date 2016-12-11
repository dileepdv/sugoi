<div class="row">
    <h4>
        Sugoi Labs
    </h4>
    <hr>
</div>
<div class="row">
    <?php if (isset($errors) && !is_null($errors)) { ?>
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                x
            </button>
            <h4>Oh snap! You got an error!</h4>
            <?php echo $errors; ?>
        </div>
    <?php } ?>
    <?php if (isset($success) && !is_null($sucess)) { ?>
        <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                ×
            </button>
            <h4>Oh snap! You got an error!</h4>
            <?php echo $sucess; ?>
        </div>
    <?php } ?>
</div>
<div class="row">
    <div class="col-md-2">
        <h2>Register</h2>
    </div>
    <div class="col-md-6 col-md-offset-1">
        <div class="row">
            <div class="label label-error">
                <?php echo validation_errors(); ?>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane active" id="login">
            <form action="<?php echo base_url('users/post_registration'); ?>" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Email"/>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="phone" placeholder="Phone"/>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password"/>
                </div>
                <input type="submit" class="btn btn-success" value="Register"/>
                <a href="<?php echo base_url('users/get_login'); ?>" class="btn btn-warning">
                    Login
                </a>
            </form>
        </div>
    </div>
</div>
