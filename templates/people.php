<?php
include "../lib.php";
include "base.php";

?>

<div class ="container-fluid">

  <div class ="row">
    <div class="col-lg-7">
      <div class="page-header text-center">
        <h2><i class="fa fa-rss" aria-hidden="true" ></i> Following 
          <small> <span class="label label-primary" id="followingcount">s</span> </small>
        </h2>
      </div>
      <div class="table-responsive">
        <div id="table_sec_followees"></div>
      </div> 
    </div>

    <div class="col-lg-5">
      <div class="page-header text-center">
        <h2><i class="fa fa-rss-square" aria-hidden="true" ></i> Followers 
          <small> <span class="label label-primary" id="followerscount"></span> </small>
        </h2>
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
      <th colspan="2" class="text-center"><i class="fa fa-user" aria-hidden="true" ></i> Trader</th>
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
      <th colspan="2" class="text-center"><i class="fa fa-user" aria-hidden="true" ></i> Trader</th>
      <th><i class="fa fa-calendar" aria-hidden="true" ></i> Date Followed</th>
    </tr>
    </thead>
    <tbody>
</script>

<script>
  window.onload = function() {
    getUserFollowees();
    getUserFollowers();
  };

  var currFollowers = <?php echo json_encode(getAllUserTrade()) ?>;

  setInterval(function(){
      queryUserFollowers();
  },2500);

  function queryUserFollowers(){
    $.get("../index.php/followers", function(followers){
      if(JSON.stringify(followers) !== JSON.stringify(currFollowers)){
        currFollowers = followers;
        processUserFollowers(followers);
      }
    },"json");

  }
</script>


