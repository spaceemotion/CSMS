<div class="container">
  <div class="row">
    <div class="col-sm-8"><h1>Modify Blog Posts</h1></div>
    <div class="col-sm-4">
      <br />
      <div class="btn-group pull-right">
        <a type="button" href="/admin/blog/edit/new" class="btn btn-success">New</a>
        <a type="button" class="btn btn-primary">Search</a>
      </div>
    </div>
  </div>
  <?php foreach($vars["posts"] as $post):?>
  <hr />
  <div class="row">
    <div class="col-sm-8">
      <h3><?php echo $post["title"];?></h3>
      <section><?php echo $post["info"];?></section>
    </div>
    <div class="col-sm-4">
      <br />
      <div class="btn-group pull-right">
        <a type="button" href="/blog/article/<?php echo $post["id"];?>"class="btn btn-info">View</a>
        <a type="button" href="/admin/blog/edit/<?php echo $post["id"];?>" class="btn btn-warning">Edit</a>
        <a type="button" href="/admin/blog/delete/<?php echo $post["id"];?>" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
  <?php endforeach;?>
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