<?php if($msg['error']){ ?>
  <div class="error">
    <?php foreach ($msg['error'] as $key => $value) { ?>
       <label for="<?= $key; ?>"><?= $msg['error'][$key] ?></label><br>
    <?php } ?>
  </div>
<?php } ?>
