<?php
include "../lib.php";
include "base.php";
?>
<div class ="container-fluid">

  <div class="row">
    <div class="col-xs-12 table-responsive">
      <div class="header text-center">
        <h1>Outgoing Requests <i class="fa fa-paper-plane fa-lg" aria-hidden="true" ></i></h1>
      </div>
    <!--<h4>Products</h4>
    <p>A table highlighting the available products</p> -->
      <div id="table_sect"></div>
    </div>

  
    <div class="col-md-4">
      <div id="trades_chart_div"></div>
    </div>
  </div>
</div>  <!-- close container -->  



<script type="text/template" id="table_headingt">
  <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th><i class="fa fa-user" aria-hidden="true" ></i> To</th>
        <th><i class="fa fa-gift" aria-hidden="true" ></i> For</th>
        <th><i class="fa fa-gift" aria-hidden="true" ></i> With</th>
        <th><i class="fa fa-calendar" aria-hidden="true" ></i> Date Requested</th>
        <th><i class="fa fa-question-circle" aria-hidden="true" ></i> Status</th>
        <th><i class="fa fa-cog" aria-hidden="true" ></i> Action</th>
      </tr>
    </thead>
    <tbody>
</script>

<script>window.onload = function() {
    getTrade();
    setInterval(function(){
      queryOutgoingRequests();
    },5000);

    var currOutgoingRequests = [];
    function queryOutgoingRequests(){
      $.get("../index.php/trade", function(res){
        if(JSON.stringify(res) !== JSON.stringify(currOutgoingRequests)){
          console.log("Outgoing request decision!");
          currOutgoingRequests = res;
          processUserTrade(res);
        }
      }, "json");  
    }
};
</script>

</body>
</html>
