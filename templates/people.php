<?php
include "../lib.php";
include "base.php";

?>

<div class ="container-fluid">
  <div class ="row">
    <div class="header text-center">
    <h1>Following</h1>
  </div>
    <div class="col-xs-12 table-responsive">
    <!--<h4>Products</h4>
    <p>A table highlighting the available products</p> -->
      <div id="table_sec_followees"></div>
    </div> 
    <div class="header text-center">
    <h1>Followers</h1>
  </div>
    <div class="col-xs-12 table-responsive">
    <!--<h4>Products</h4>
    <p>A table highlighting the available products</p> -->
      <div id="table_sec_followers"></div>
    </div>

</div>

<script type="text/template" id="table_heading_followees">
  <table class="table table-hover table-condensed">
    <thead>
    <tr>
      <th>Trader</th>
      <th>Date Followed</th>
      <th>Unfollow</th>
    </tr>
    </thead>
    <tbody>
</script>

<script type="text/template" id="table_heading_followers">
  <table class="table table-hover table-condensed">
    <thead>
    <tr>
      <th>Follower</th>
      <th>Date followed</th>
    </tr>
    </thead>
    <tbody>
</script>

