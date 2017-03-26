<?php
include "../lib.php";
include "base.php";

?>

<div class ="container-fluid">
  <div class="header text-center">
    <h1> Saved Items <i class="fa fa-bookmark fa-lg" aria-hidden="true" ></i> </h1>
  </div>
  <div class ="row">
    <div class="col-xs-12 table-responsive">
    <!--<h4>Products</h4>
    <p>A table highlighting the available products</p> -->
      <div id="table_sec_saveditems"></div>
    </div>  
</div>

<script type="text/template" id="table_heading_saveditems">
  <table class="table table-hover table-condensed">
    <thead>
    <tr>
      <th></th>
      <th><i class="fa fa-gift" aria-hidden="true" ></i> Item</th>
      <th><i class="fa fa-user" aria-hidden="true" ></i> Owner</th>
      <th><i class="fa fa-calendar" aria-hidden="true" ></i> Date Saved</th>
      <th><i class="fa fa-cog" aria-hidden="true" ></i> Action</th>
    </tr>
    </thead>
    <tbody>
</script>

<script>window.onload = function() {
    getUserSavedItems();
};
</script>
