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
        <? if($vars['servers']):?>
        <div class="list-item col-sm-6">
          <div class="media">
            <a class="pull-left" href="/server/{{id}}">
              <img class="media-object" src="/img/server/{{id}}" alt="...">
            </a>
            <div class="media-body">
              <h4 class="media-heading"><?=$vars['servers']['name']?></h4>
              <h5>Owner: <?=$vars['servers']['by']?></h5>
            </div>
          </div>
        </div>
        <? else:?>
        <h2>No Servers Found!</h2>
        <? endif;?>
      </div>
    </div>
  </div>
</div>