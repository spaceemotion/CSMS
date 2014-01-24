<div class="container">
  <br />
  <form role="form" action="/admin/projects/post/<?php echo $vars["project"]["id"];?>" method="POST">
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Title" value="<?php echo $vars["project"]["name"];?>"/>
    </div>
    <div class="form-group">
      <label for="content">Content</label>
      <textarea class="form-control" id="content" rows="10" name="content" placeholder="Enter some content..."><?php echo $vars["project"]["info"];?></textarea>
    </div>
    <div class="form-group">
      <label class="control-label" for="added">Added</label>
      <input type="date" class="form-control" id="added" name="added" value="<?php echo $vars["project"]["added"]; ?>" max="<?php echo date("Y-m-d");?>"/>
    </div>
    <div class="pull-right">
      <a href="/admin/projects" class="btn btn-danger">Cancel</a>
      <button type="submit" class="btn btn-success">Post</button>
    </div>
    <div class="clearfix"></div>
  </form>
</div>