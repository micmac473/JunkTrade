<?php
include "../lib.php";
include "base.php";

?>

<div class="container-fluid">
    <div class="row">

      <div class="col-lg-4 col-lg-offset-1 col-md-6 col-sm-12 col-xs-12" style="background-color: white; box-shadow: 5px 5px 5px #888888;">
        <h3 class="header text-center"><u>Events</u> <i class="fa fa-calendar" aria-hidden="true"></i></h3>
        <div id="reminders" style="overflow-y: scroll; height:70px"> 
          
        </div>
      </div>

      <div class="col-lg-4 col-lg-offset-1 col-md-6 col-sm-12 col-xs-12" style="background-color: white; box-shadow: 5px 5px 5px #888888;">
        <h3 class="header text-center" ><u>Followers</u> <i class="fa fa-rss" aria-hidden="true"></i></h3>
        <div id="followerupdates" style="overflow-y: scroll; height:70px"> 
          
        </div>
      </div>

    </div>

    <br>
    <div class="row">
    <form class="">
      <fieldset>
        <!-- Select Basic -->
        <div class="form-group col-lg-6 col-lg-offset-3">
          <label class="control-label" for="selectbasic">Sort by</label>
          <div class="">
            <select id="selectbasic" name="selectbasic" class="form-control" onChange="sortHomepageItems(this.value);">
              <option value="mra">Date: Most Recently Added (Default)</option>
              <option value="lra">Date: Least Recently Added</option>
              <option value="mv">Views: High to Low</option>
              <option value="lv">Views: Low to High</option>
              <option value="ia-z">Items: A-Z</option>
              <option value="iz-a">Items: Z-A</option>
              <option value="ta-z">Trader: A-Z</option>
              <option value="tz-a">Trader: Z-A</option>
            </select>
          </div>
        </div>

      </fieldset>
    </form>
  </div>

    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="header text-center">
          <h1><u>Tradable Items</u> <i class="fa fa-gift fa-lg" aria-hidden="true" ></i></h1>
      </div>
      <!-- <div id = "itemblock" class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12"> -->
      <div id = "itemblock"> </div>
    </div>
  </div>

  
</div>

<script type="text/template" id="table_headingh">
  <table class="table table-hover table-condensed col-xs-3">
    <thead class="thead-inverse">
      <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Views</th>
        <th>Description</th>
        <th>Trader</th>
        <th>Trade</th>
        <th>Uploaded</th>
      </tr>
    </thead>
    <tbody>
</script>



  <!-- Image Modal -->
  <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div>
    </div>
  </div>
</div>

<!-- Trader items Modal -->
  <div class="modal fade" id="profileModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <form class="">
            <fieldset>

            <div class="form-group">
              <label class="control-label" for="name">Trader</label>
              <div class="">
                <input id="trader" name="trader" type="text" disabled placeholder="Requested Item" class="form-control input-md" required="">
              </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
              <label class="control-label" for="selectbasic">Items</label>
              <div class="">
                <select id="items" name="items" class="form-control" required="">
                  
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="">
                <button class="btn btn-success btn-block" type="submit">View item</button>
              </div>
            </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Item description Modal -->
  <div class="modal fade" id="itemModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <form class="">
            <fieldset>
            <!-- Select Basic -->
            <div class="form-group">
              <label class="control-label" for="textarea">Description</label>
              <div class="">                     
                <textarea class="form-control" disabled id="description" rows="10" name="description">Description....</textarea>
              </div>
            </div>

            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>

<script>
  window.onload = function() {
    getAllItems();
    userMeetUp();
    userFollowerUpdates();
  };

  var currAllItems = [], currAllRequests = [] ,currMeetup = [], currFollowerUpdates = [], sort="mra";
  setInterval(function(){
    queryAllItems(sort);
    queryMeetUp();
    queryFollowerUpdates();
  },2500);


    
  function queryAllItems(sort){
    $.get("../index.php/homepage/"+sort, function(res){
      $.get("../index.php/allnonuseritemsstate", function(reqs){
        if(JSON.stringify(res) !== JSON.stringify(currAllItems) || JSON.stringify(reqs) !== JSON.stringify(currAllRequests)){
          console.log("Item Change");
          //toastr["success"]("New Item Uploaded");
          currAllItems = res;
          currAllRequests = reqs;
          processAllItems(res);
        }
      },"json");
    }, "json");  
   }

  function queryMeetUp(){
    $.get("../index.php/usermeetup", function(res){
      if(JSON.stringify(res) !== JSON.stringify(currMeetup)){
        console.log("New Event!");
        //toastr["success"]("New Event");
        currMeetup = res;
        processUserMeetUp(res);
      }
    }, "json");  
  }

  function queryFollowerUpdates(){
    $.get("../index.php/userfollowerupdates", function(res){
      if(JSON.stringify(res) !== JSON.stringify(currFollowerUpdates)){
        console.log("New Follower item added!");
        currFollowerUpdates = res;
        processUserFollowerUpdates(res);
      }
    }, "json");  
  }
</script>