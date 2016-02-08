<?php if(isset($msg['error']) && !empty($msg['error'])){ ?>
  <div class="error">
    <?php foreach ($msg['error'] as $key => $value) { ?>
       <label for="<?= $key; ?>"><?= $msg['error'][$key] ?></label><br>
    <?php } ?>
  </div>
<?php } ?>
<?php if(isset($msg['confirm']) && !empty($msg['confirm'])){ ?>
  <div class="confirm">
    <?php foreach ($msg['confirm'] as $key => $value) { ?>
       <?= $msg['confirm'][$key] ?><br>
    <?php } ?>
  </div>
<?php } ?>
