<?php
include "../lib.php";
include "base.php";

?>

<div class ="container-fluid">

  <div class ="row">
    <div class="col-lg-7">
      <div class="page-header text-center">
        <h1>Following <i class="fa fa-rss fa-lg" aria-hidden="true" ></i></h1>
      </div>
      <div class="table-responsive">
        <div id="table_sec_followees"></div>
      </div> 
    </div>

    <div class="col-lg-5">
      <div class="page-header text-center">
        <h1>Followers <i class="fa fa-rss-square fa-lg" aria-hidden="true" ></i></h1>
      </div>
      <div class="table-responsive">
        <div id="table_sec_followers"></div>
      </div>
    </div>
  </div>
</div>

<script type="text/template" id="table_heading_followees">
  <table class="table table-hover table-condensed">
    <thead>
    <tr>
      <th><i class="fa fa-user" aria-hidden="true" ></i> Trader</th>
      <th><i class="fa fa-calendar" aria-hidden="true" ></i> Date Followed</th>
      <th><i class="fa fa-cog" aria-hidden="true" ></i> Action</th>
    </tr>
    </thead>
    <tbody>
</script>

<script type="text/template" id="table_heading_followers">
  <table class="table table-hover table-condensed">
    <thead>
    <tr>
      <th><i class="fa fa-user" aria-hidden="true" ></i> Follower</th>
      <th><i class="fa fa-calendar" aria-hidden="true" ></i> Date Followed</th>
    </tr>
    </thead>
    <tbody>
</script>

<script>window.onload = function() {
  getUserFollowees();
  getUserFollowers();
  setInterval(function(){
      getUserFollowers();
  },2000);
};
</script>


