<div class="container">
  <div class="row">
    <div class="col-sm-8"><h1>Modify Maps</h1></div>
    <div class="col-sm-4">
      <br />
      <div class="btn-group pull-right">
        <a type="button" href="/admin/projects/edit/new" class="btn btn-success">New</a>
        <a type="button" class="btn btn-primary">Search</a>
      </div>
    </div>
  </div>
  <?php foreach($vars["projects"] as $project):?>
  <hr />
  <div class="row">
    <div class="col-sm-8">
      <h3><?php echo $project["name"];?></h3>
      <section><?php echo $project["info"];?></section>
    </div>
    <div class="col-sm-4">
      <br />
      <div class="btn-group pull-right">
        <a type="button" href="/project/<?php echo $project["id"];?>"class="btn btn-info">View</a>
        <a type="button" href="/admin/projects/edit/<?php echo $project["id"];?>" class="btn btn-warning">Edit</a>
        <a type="button" href="/admin/projects/delete/<?php echo $project["id"];?>" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
  <?php endforeach;?>
  <hr />
  <ul class="pager">
    <?php if($vars["pages"]["previous"] !== null):?>
    <li class="previous"><a href="/admin/projects/<?php echo $vars["pages"]["previous"];?>">&larr; Previous</a></li>
    <?php endif;?>
    <?php if($vars["pages"]["next"] !== null):?>
    <li class="next"><a href="/admin/projects/<?php echo $vars["pages"]["next"];?>">Next &rarr;</a></li>
    <?php endif;?>
  </ul>
</div>