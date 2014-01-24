<div class="container">
  <?php if(isset($vars["post"])): ?>
  <article>
    <header>
      <h1><?php echo $vars["post"]["title"];?></h1>
      <h4>Posted <?php echo $vars["post"]["added"];?> <small>by <?php echo $vars["post"]["by"];?></small></h4>
    </header>
    <section><?php echo $vars["post"]["content"];?></section>
  </article>
  <?php else:?>
  <h1>Couldn't find the article for you guv!</h1>
  <?php endif?>
</div>