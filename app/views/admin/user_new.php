<div class="container">
  <br />
  <form role="form" class="form-horizontal" action="/admin/users/new" method="POST">
    <div class="row">
      <div class="col-sm-9">
        <div class="form-group">
          <label class="col-sm-3 control-label" for="username">Username</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="username" name="user" placeholder="username"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="fullname">Full Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="fullname" name="full" placeholder="User's Name"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="email">Email</label>
          <div class="col-sm-9">
            <input type="email" class="form-control" id="email" name="email" placeholder="user@example.org"/>
          </div>
        </div>
        <fieldset>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="password">Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="password" name="pass" placeholder="Password"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="password_confirm">Confirm Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="password_confirm" name="pass_confirm" placeholder="Password"/>
            </div>
          </div>
        </fieldset>
      </div>
      <div class="col-sm-3">
        <div class="pull-right">
          <a href="/admin/users" class="btn btn-danger">Cancel</a>
          <button type="submit" class="btn btn-success">Create</button>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </form>
</div>