<?php
include "../lib.php";
include "base.php";

?>

<div class ="container-fluid">
  <div class="page-header text-center">
    <h2><i class="fa fa-bookmark" aria-hidden="true" ></i> Saved Items  
      <small> <span class="label label-primary" id="savedcount"></span> </small>
    </h2>
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
      <th colspan="2" class="text-center"><i class="fa fa-gift" aria-hidden="true" ></i> Item</th>
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


var currSaved = <?php echo json_encode(getUserSavedItems()) ?>;

setInterval(function(){
    querySaved();
},2500);

function querySaved(){
  $.get("../index.php/getsaveditems", function(saved){
    if(JSON.stringify(saved) !== JSON.stringify(currSaved)){
      currSaved = saved;
      getUserSavedItems();
    }
  },"json");
}
</script>
