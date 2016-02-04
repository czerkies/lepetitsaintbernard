<?php if(isset($msg['error'])){ ?>
  <div class="error">
    <?php foreach ($msg['error'] as $key => $value) {echo $msg['error'][$key].'<br>';} ?>
  </div>
<?php } ?>
