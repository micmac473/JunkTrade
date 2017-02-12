<?php
include "../lib.php";
include "base.php";
?>
<div class ="container">
  <div class="header">
    <div class="row">
      <div class="col-lg-2">
        <img alt ="logo" width ="100px" height ="100px" src =../img/logo.png>
      </div>
      <div class="col-lg-4">
        <h3> [Firstname Lastname] </h3>
      </div>
      <div class="col-lg-2">
        <a href="#" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Follow</a>
      </div>
    </div>
  </div>
</div>

<div class ="container-fluid">
    <div class="col-lg-6 col-lg-offset-3">
      <p> A listing of trader items </p>
      <div id = "itemblock">
      </div>
    </div>
</div>