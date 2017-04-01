<?php
include "../lib.php";
include "adminbase.php";

?>

<div class ="container-fluid">
  <div class ="row">
    <div class="text-center jumbotron"> 
      <h1>Activity <i class="fa fa-cogs fa-lg" aria-hidden="true" ></i></h1>
    </div>  
  </div>
</div>




<script>
window.onload = function() {
  getTradeHistory();
  getIncomingRequests();
};
</script>
