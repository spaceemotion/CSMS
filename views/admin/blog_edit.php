<div class="container">
  <br />
  <form role="form" action="/admin/blog/post/<?php echo $vars["post"]["id"];?>" method="POST">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php echo $vars["post"]["title"];?>"/>
    </div>
    <div class="form-group">
      <label for="content">Content</label>
      <textarea class="form-control" id="content" rows="10" name="content" placeholder="Enter some content..."><?php echo $vars["post"]["content"];?></textarea>
    </div>
    <div class="form-group">
      <label class="control-label" for="posted">Posted</label>
      <input type="date" class="form-control" id="posted" name="posted" value="<?php echo $vars["post"]["added"]; ?>" max="<?php echo date("Y-m-d");?>"/>
    </div>
    <div class="pull-right">
      <a href="/admin/blog" class="btn btn-danger">Cancel</a>
      <button type="submit" class="btn btn-success">Post</button>
    </div>
    <div class="clearfix"></div>
  </form>
</div>