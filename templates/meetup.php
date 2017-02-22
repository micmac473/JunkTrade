<?php
include "../lib.php";
include "base.php";

?>

<div class ="container-fluid">
  <div class="header text-center">
    <h1> Meet Up </h1>
  </div>
  <div class ="row">
    <div class="col-xs-12 table-responsive">
      <h2 style="text-align: center; font-family: 'Acme', sans-serif; color:orange">Items you requested</h2>
    <!--<h4>Products</h4>
    <p>A table highlighting the available products</p> -->
      <div id="table_sec_requested"></div>
    </div>

    <div class ="col-xs-12 table-responsive">
      <h2 style="text-align: center; font-family: 'Acme', sans-serif; color:orange">Requests for your items</h2>
    <!--<h4>Products</h4>
    <p>A table highlighting the available products</p> -->
      <div id="table_sec_requests"></div>
    </div>
  </div>  
</div>

<script type="text/template" id="table_heading_requested">
  <table class="table table-hover table-condensed">
    <thead>
    <tr>
      <th>From</th><th>Contact</th><th>With</th><th>For</th><th>Date</th><th>Location</th><th>Suggest Location</th><th>Decision</th><th>Feedback</th>
    </tr>
    </thead>
    <tbody>
</script>

<script type="text/template" id="table_heading_requests">
  <table class="table table-hover table-condensed">
    <thead>
    <tr>
      <th>From</th><th>Contact</th><th>With</th><th>For</th><th>Date</th><th>Location</th><th>Suggested Location</th><th>Feedback</th>
    </tr>
    </thead>
    <tbody>
</script>
