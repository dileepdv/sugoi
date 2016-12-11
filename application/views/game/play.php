<div class="row">
    <h3>
        <span class="pull-left">Sugoi</span>
        <?php echo anchor("users/logout","Logout",'class="btn btn-danger pull-right"'); ?>
    </h3>
</div>
<div class="row">
    <hr>
    <div class="col-md-3">
        <h2>Max Time : </h2>
        <h4 id="time" class="padding-5 bg-success" data-time="<?php echo $time; ?>">
            <?php echo $time; ?> Sec
        </h4>
        <hr>
        <h2>Time Remaining : </h2>
        <h4 id="s_timer" class="padding-5 btn-success size_lg">Click On Start</h4>
    </div>
    <div class="col-md-3 col-md-offset-3 start">
        <button class="btn btn-block btn-danger margin-top-100">Start</button>
    </div>
    <div class="col-md-9 hide play-area">
        <?php foreach (array_chunk($blocks, 5) as $block) { ?>
            <div class="row">
                <?php foreach ($block as $one_elemeny) { ?>
                    <div class="col-md-2 margin-2">
                        <div class="shape-<?php echo $one_elemeny; ?> <?php echo $one_elemeny; ?>">
                            &nbsp;
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <div class="col-md-8 save-score hide margin-top-100">
        <form action="<?php echo base_url('games/save'); ?>" method="post">
            <input type="hidden" class="form-control" name="total"
                   value="<?php echo $count_of_blocks['square']; ?>"/>
            <input type="hidden" class="form-control" id="score" name="score" value="0"/>
            <input type="hidden" class="form-control" name="level"
                   value="<?php echo $this->uri->segment('3'); ?>"/>
            <input type="submit" class="btn btn-block btn-primary" value="Save My Score"/>
        </form>
    </div>
</div>