<div id="loginPg" class="container">

  <?php echo form_open( '/account/login/', array('class' => 'form-signin') ) ; ?>
    <h3 class="form-signin-heading">Sign in to your Account</h3>

    <?php if( !empty($message) ) : ?>
      <div class="alert alert-danger">Invalid Login</div>
    <?php endif ; ?>

    <input name="email" type="text" class="form-control" placeholder="Email address" required>
    <input name="password" type="password" class="form-control" placeholder="Password" required>

		<div class="button-cont">
			<button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
			<a class="forgot-password" href="/recover">I forgot my password</a>
		</div>
  <?php echo form_close() ; ?>

  <hr class="faded" />

  <ul class="nav nav-pills nav-justified">
      <li><a href="#">About Us</a></li>
      <li><a href="#">Terms of Use</a></li>
  </ul>

</div> <!-- /container -->