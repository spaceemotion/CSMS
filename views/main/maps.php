<div class="container">
  <br />
  <div class="row">
    <div class="col-sm-3">
      <div id="sidebar">
        test
        <? // add css code to switch ?>
      </div>
    </div>
    <div class="col-sm-9">
      <div class="row">
        <? if($vars['maps']):?>
        <? foreach($vars['maps'] as $map)?>
        <div class="list-item col-sm-6">
          <div class="media">
            <a class="pull-left" href="/map/<?=$map['id']?>">
              <img class="media-object" src="/img/map/<?=$map['id']?>" alt="...">
            </a>
            <div class="media-body">
              <h4 class="media-heading"><?=$map['name']?></h4>
              <h5>Owner: <?=$map['by']?></h5>
            </div>
          </div>
        </div>
        <? endforeach;?>
        <? else:?>
        <h2>No Maps Found!</h2>
        <? endif;?>
      </div>
    </div>
  </div>
</div>