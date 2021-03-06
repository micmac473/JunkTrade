<?php
include "../lib.php";
include "base.php";

?>

<div class ="container-fluid">
  <div class ="row">
    <div class="col-xs-12 table-responsive">
      <div class="page-header text-center"> 
        <h2><i class="fa fa-handshake-o" aria-hidden="true" ></i> Trades 
          <small> <span class="label label-primary" id="tradeshistorycount">0</span> </small>
        </h2>
      </div>

      <div id="table_sec_tradehistory"></div>
    </div>

    <div class="col-xs-12 table-responsive">
      <div class="page-header text-center"> 
        <h2><i class="fa fa-envelope" aria-hidden="true" ></i> Incoming Requests
          <small> <span class="label label-primary" id="incomingrequestshistorycount">0</span> </small> 
        </h2>
        <h4>
          Accepted <span class="label label-success" id="acceptedrequestshistory">0</span>
          Denied <span class="label label-danger" id="deniedrequestshistory">0</span>
        </h4>
      </div>

      <div id="table_sec_incomingrequestshistory"></div>
    </div>
    
  </div>  
</div>

<script type="text/template" id="table_heading_tradehistory">
  <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th><i class="fa fa-calendar" aria-hidden="true" ></i> Date </th>
        <th><i class="fa fa-map-marker" aria-hidden="true" ></i> Location</th>
        <th><i class="fa fa-user" aria-hidden="true" ></i> Requester</th>
        <th><i class="fa fa-gift" aria-hidden="true" ></i> With</th>
        <th><i class="fa fa-comment" aria-hidden="true" ></i> Your Feedback</th>
        <th><i class="fa fa-star" aria-hidden="true" ></i> Rating</th>
        <th><i class="fa fa-user-o" aria-hidden="true" ></i> Requestee</th>
        <th><i class="fa fa-gift" aria-hidden="true" ></i> For</th>
        <th><i class="fa fa-comment" aria-hidden="true" ></i> Trader Feedback</th>
        <th><i class="fa fa-star" aria-hidden="true" ></i> Rating</th>
      </tr>
      </thead>
    <tbody>
</script>

<script type="text/template" id="table_heading_incomingrequestshistory">
  <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th><i class="fa fa-calendar" aria-hidden="true" ></i> Date</th>
        <th><i class="fa fa-user" aria-hidden="true" ></i> From</th>
        <th><i class="fa fa-gift" aria-hidden="true" ></i> With</th>
        <th><i class="fa fa-gift" aria-hidden="true" ></i> For</th>
        <th><i class="fa fa-gavel" aria-hidden="true" ></i> Your Decision</th>
        <th><i class="fa fa-comment" aria-hidden="true" ></i> Denied Reason</th>
      </tr>
    </thead>
    <tbody>
</script>


<script>
window.onload = function() {
  getTradeHistory();
  getIncomingRequests();
};
</script>
