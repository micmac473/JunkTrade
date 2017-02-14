<?php
include "../lib.php";
include "base.php";
?>
<div class ="container-fluid">
  <div class="jumbotron">
    <div class="row">
      <div class="col-lg-2">
        <img alt ="logo" width ="100px" height ="100px" src =../img/logo.png>
      </div>
      <div class="col-lg-4">
        <div id="profileName"> [Firstname Lastname] </div>
      </div>
      <div class="col-lg-2">
        <a href="#" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Follow</a>
      </div>
    </div>
  </div>
</div>

<div class ="container-fluid">
    <div class="col-lg-6 col-lg-offset-3">
      <h1> A listing of trader items </h1>
      <div id = "itemblockP">
      </div>
    </div>
</div>