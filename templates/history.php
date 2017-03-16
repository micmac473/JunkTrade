<?php
include "../lib.php";
include "base.php";

?>

<div class ="container-fluid">
  <div class ="row">
    <div class="col-xs-12 table-responsive">
      <div class="header text-center"> 
        <h1>Trade History <i class="fa fa-hourglass-o fa-lg" aria-hidden="true" ></i></h1>
      </div>

      <div id="table_sec_history"></div>
    </div>
  </div>  
</div>

<script type="text/template" id="table_heading_history">
  <table class="table table-hover table-condensed">
    <thead>
    <tr>
      <th>Date</th>
      <th>Your Item</th>
      <th>Trader Item</th>
      <th>Location</th>
      <th>Feedback</th>
      <th>Rating</th>
    </tr>
    </thead>
    <tbody>
</script>




<script>
window.onload = function() {
  getRequestedMeetUp();
  getRequestsMeetUp();
};
</script>
