<div class="container">
  <div class="row">
    <div class="col-sm-8 col-xs-12">
      <div class="page-header">
        <h1>Site Statistics</h1>
      </div>
      <div class="row">
        <div class="col-sm-4 col-xs-6">
          <h2>Posts Read</h2>
          <h1><?php echo 0;?></h1><i>in the last 7 days</i>
        </div>
        <div class="col-sm-4 col-xs-6">
          <h2>Posts Created</h2>
          <h1><?php echo $vars["stats"]["posts"];?></h1><i>in the last 7 days</i>
        </div>
        <div class="col-sm-4 col-xs-6">
          <h2>User Comments</h2>
          <h1><?php echo 0;?></h1><i>in the last 7 days</i>
        </div>
      </div>
      <p><br /><i>N.B. Might scrap this page completely (it's nice but requires work)</i></p>
    </div>
    <div class="col-sm-4 hidden-xs">
      <br />
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Quick Post</h3>
        </div>
        <div class="panel-body">
          <form role="form" action="/admin/blog/post" method="POST">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Title">
            </div>
            <div class="form-group">
              <label for="content">Content</label>
              <textarea class="form-control" id="content" rows="5" name="content" placeholder="Enter some content..."></textarea>
            </div>
            <div class="pull-right">
              <button type="submit" class="btn btn-primary">Post</button>
            </div>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>