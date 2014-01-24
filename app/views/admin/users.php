<?php if($vars["users"] != null):?>
<div class="container">
  <form action="/admin/test" method="POST">
    <div class="row">
      <div class="col-sm-7"><h1>Modify Users</h1></div>
      <div class="col-sm-5">
        <br />
        <div class="btn-group pull-right">
          <a type="button" href="/admin/users/new" class="btn btn-success">New</a>
          <button type="submit" formaction="/admin/users/edit" class="btn btn-warning">Edit</button>
          <button type="submit" formaction="/admin/users/delete" class="btn btn-danger">Delete</button>
          <a type="button" class="btn btn-primary">Search</a>
        </div>
      </div>
    </div>
    <hr />
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Select</th>
          <th>Username</th>
          <th>Full Name</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($vars["users"] as $user):?>
        <tr>
          <td><input type="checkbox" name="user[]" value="<?php echo $user["id"];?>"/>
          <td><?php echo $user["name"];?></td>
          <td><?php echo $user["full"];?></td>
        </tr>
      <?php endforeach;?>
      </tbody>
    </table>
  </form>
  <hr />
  <ul class="pager">
    <?php if($vars["pages"]["previous"] !== null):?>
    <li class="previous"><a href="/admin/blog/<?php echo $vars["pages"]["previous"];?>">&larr; Previous</a></li>
    <?php endif;?>
    <?php if($vars["pages"]["next"] !== null):?>
    <li class="next"><a href="/admin/blog/<?php echo $vars["pages"]["next"];?>">Next &rarr;</a></li>
    <?php endif;?>
  </ul>
</div>
<?php endif;?>