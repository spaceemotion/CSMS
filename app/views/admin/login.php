<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h1>Admin Login</h1>
      <h4>Welcome to beCyCle's admin pages</h4>
      <p>You need to be authorised to access this page, please use the login form to identify yourself</p>
    </div>
    <div class="col-sm-6 well well-lg">
      <?php if($vars['error']):?>
      <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Error!</strong> Username/Passsword is incorrect
      </div>
      <?php endif;?>
      <form role="form" class="form-horizontal" action="/admin/login" method="POST">
        <div class="form-group<?php if($vars['error']) { echo ' has-error';}?>">
          <label class="col-sm-3 control-label" for="username">Username</label>
          <div class="col-sm-9">
            <input type="text" class=" form-control" id="username" name="user" placeholder="Username">
          </div>
        </div>
        <div class="form-group<?php if($vars['error']) { echo ' has-error';}?>">
          <label class="col-sm-3 control-label" for="password">Password</label>
          <div class="col-sm-9">
            <input type="password" class="form-control" id="password" name="pass" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
              <label><input type="checkbox" name="keep" value="true"> Keep Me Logged In</label>
            </div>
          </div>
        </div>
        <div class="pull-right">
          <a role="button" href="/" class="btn btn-info">Return</a>
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
        <div class="clearfix"></div>
      </form>
    </div>
  </div>
</div>