<div class="jumbotron jumbo-image jumbo-header" style="">
    <div class = "container">
        <h1>Blog</h1>
        <p>What's happening?</p>
    </div>
</div>
<div class="container">
  <?php if($vars["posts"] != null):?>
  <?php foreach($vars["posts"] as $post):?>
  <article>
    <header>
      <h1><?php echo $post["title"];?></h1>
      <h4>Posted <?php echo $post["added"];?> <small>by <?php echo $post["by"];?></small></h4>
    </header>
    <section><?php echo $post["content"];?></section>
  </article>
  <hr />
  <?php endforeach;?>
  <ul class="pager">
    <?php if($vars["pages"]["previous"] !== null):?>
    <li class="previous"><a href="/blog/<?php echo $vars["pages"]["previous"];?>">&larr; Newer</a></li>
    <?php endif;?>
    <?php if($vars["pages"]["next"] !== null):?>
    <li class="next"><a href="/blog/<?php echo $vars["pages"]["next"];?>">Older &rarr;</a></li>
    <?php endif;?>
  </ul>
  <?php else:?>
  <h3>No posts have been made</h3>
  <?php endif;?>
</div>