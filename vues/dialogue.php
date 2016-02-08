<?php if(isset($msg['error']) && !empty($msg['error'])){ ?>
  <div class="error <?php if(isset($msg['error']['confirm'])) echo 'confirm' ?>">
    <?php foreach ($msg['error'] as $key => $value) {
      if(isset($msg['error']['confirm']) || isset($msg['error']['generale'])) {
        echo $msg['error'][$key];
      } else { ?>
        <label for="<?= $key; ?>"><?= $msg['error'][$key] ?></label><br>
      <?php }
    } ?>
  </div>
<?php } ?>
