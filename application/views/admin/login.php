
<?php
$str = is_array($message) ? $message['text'] : $message;
echo (isset($message) && !empty($message)) ? '
                        <div class="alert alert-danger "> 
                <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                </button> ' . $str . '   
            </div>' : '';
?> 
<?php echo form_open("admin/login", 'role="form" id="" role="form"  class="form-login" '); ?>  

<div class="errorHandler alert alert-danger no-display">
    <i class="icon-remove-sign"></i> You have some form errors. Please check below.
</div>
<fieldset>
    <div class="form-group">
        <span class="input-icon">
            <input type="text" class="form-control" name="email" id="username" placeholder="Username">
            <i class="icon-user"></i> 
        </span>
    </div>
    <div class="form-group form-actions">
        <span class="input-icon">
            <input type="password" class="form-control password" name="password" id="passwd" placeholder="Password">
            <i class="icon-lock"></i>
            <a class="forgot" href="#">
                I forgot my password
            </a> </span>
    </div>
    <div class="form-actions">
        <label for="remember" class="checkbox-inline">
            <input type="checkbox" class="grey remember" id="remember" name="remember">
            <span style="color:#FFF !important;">Keep me signed in</span>
        </label>
        <button type="submit" class="btn btn-bricky pull-right">
            Login <i class="icon-circle-arrow-right"></i>
        </button>
    </div>
    
      <div class="new-account">
          &nbsp;
      <?php /*Don't have an account yet?
      <a href="#" class="register">
      Create an account
      </a>*/ ?>
      </div> 
</fieldset>

<?php echo form_close(); ?>


<style>
    .errors-container p{color: #fff;}
</style>