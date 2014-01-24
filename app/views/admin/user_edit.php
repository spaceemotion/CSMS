<div class="container">
  <form class="form-horizontal" action="/admin/users/update" method="POST" role="form">
    <div class="row">
      <div class="col-sm-8"><h1>Editing Users</h1></div>
      <div class="col-sm-4">
        <br />
        <div class="pull-right">
          <a type="button" href="/admin/users/" class="btn btn-danger">Cancel</a>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
    </div>
    <?php foreach($vars["users"] as $user):?>
    <hr />
    <h2>User #<?php echo $user["id"];?></h1>
    <div class="form-group">
      <label for="name-<?php echo $user["id"];?>" class="col-sm-2 control-label">Username</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="name-<?php echo $user["id"];?>" name="name[<?php echo $user["id"];?>]" value="<?php echo $user["name"];?>" placeholder="username"/>
      </div>
    </div>
    <div class="form-group">
      <label for="full-<?php echo $user["id"];?>" class="col-sm-2 control-label">Full Name</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="name-<?php echo $user["id"];?>" name="full[<?php echo $user["id"];?>]" value="<?php echo $user["full"];?>" placeholder="User's Name"/>
      </div>
    </div>
    <div class="form-group">
      <label for="email-<?php echo $user["email"];?>" class="col-sm-2 control-label">Email</label>
      <div class="col-sm-5">
        <input type="email" class="form-control" id="email-<?php echo $user["id"];?>" name="email[<?php echo $user["id"];?>]" value="<?php echo $user["email"];?>" placeholder="user@example.org"/>
      </div>
    </div>
    <div class="form-group">
      <label for="pass-<?php echo $user["id"];?>" class="col-sm-2 control-label">Change Password</label>
      <div class="col-sm-5">
        <input type="password" class="form-control" id="pass-<?php echo $user["id"];?>" name="pass[<?php echo $user["id"];?>]" placeholder="New Password"/>
      </div>
    </div>
    <div class="form-group">
      <label for="pass_confirm-<?php echo $user["id"];?>" class="col-sm-2 control-label">Confirm Password</label>
      <div class="col-sm-5">
        <input type="password" class="form-control" id="pass_confirm-<?php echo $user["id"];?>" name="pass_confirm[<?php echo $user["id"];?>]" placeholder="New Password"/>
      </div>
    </div>
    <?php endforeach;?>
  </div>
</div>