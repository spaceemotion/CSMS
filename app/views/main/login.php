<div class="container">
  <br>
  <div class="row">
    <div class="col-sm-8 hidden-xs">
      <h1>Register</h1>
      <div class="row">
        <div class="col-md-4 hidden-sm">
          Register for benefits like:
          <ul>
            <li>Access to maps</li>
          </ul>
        </div>
        <div class="col-md-7 col-sm-10">
          <form role="form">
            <div class="form-group">
              <label for="exampleInputEmail1">Username *</label>
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Full name</label>
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            </div>
            <hr />
            <div class="form-group">
              <label for="exampleInputEmail1">Email address *</label>
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Confirm email address *</label>
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            </div>
            <hr />
            <div class="form-group">
              <label for="exampleInputPassword1">Password *</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Confrim password *</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox"> Sign me up for updates!
              </label>
            </div>
            <button type="submit" class="btn btn-default">Register</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <h1>Login</h1>
      <div class="well well-lg">
        <form role="form" method="POST" action="/login/go">
          <div class="form-group">
            <label for="username">Username or Email</label>
            <input type="email" class="form-control" id="username" name="user" placeholder="test@test.com \ user">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="pass" placeholder="Password">
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="keep"> Keep me logged in
            </label>
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
        </form>
      </div>
      <div class="visible-xs">
        <h1>Register</h1>
        Click here to register: <a role="button" class="pull-right btn btn-success" href="/register">Register</a>
      </div>
    </div>
  </div>
</div>