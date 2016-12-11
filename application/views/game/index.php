<div class="row">
    <h3>
        <span class="pull-left">Sugoi</span>
        <?php echo anchor("users/logout","Logout",'class="btn btn-danger pull-right"'); ?>
    </h3>
</div>
<div class="row">
    <hr>
    <h3>Select Level</h3><br>
    <?php foreach ($levels as $level) { ?>
        <div class="col-md-2">
            <?php echo anchor("games/level/$level", "Level $level", 'class="btn btn-lg btn-info"'); ?>
        </div>
    <?php } ?>
</div>
<div class="row">
    <hr>
    <h3>Your Scores</h3>
    <?php if (isset($scores) && count($scores)) { ?>
        <?php foreach ($scores as $key => $levels) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?php echo 'Level ' . $key; ?>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <?php foreach ($levels as $score) { ?>
                                    <li> Score : <?php echo $score->score; ?> </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        <?php } ?>
    <?php }else{ ?>
            <div class="col-md-12">
                Why So Serious! Play a game.
            </div>
    <?php } ?>
</div>