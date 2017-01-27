<?php
include "base.php";
?>

    <!--Div that will hold the pie chart-->

    
<div class="container-fluid">
  <div class="row">
    
    <div class="col-xs-2 well">
      <div class="thumbnail">
        <p>A FIXED DROP DOWN MENU LIKE HOW GOOGLE+ HAS IT</p>
      </div>      
      <div class="well">
        <p>HOME</p>
      </div>
      <div class="well">
        <p>PROFILE</p>
      </div>
      <div class="well">
        <p>PEOPLE</p>
      </div>
      <div class="well">
        <p>FOLLOWERS</p>
      </div>
      <div class="well">
        <p>NOTIFICATIONS</p>
      </div>

      <div class="well">
        <p>MEET UP</p>
      </div>
    </div>

    <div id = "itemblock" class="col-lg-7 col-md-4 col-s-4 col-xs-12">
    
    </div>
    <div class="col-xs-3 well">
      <div class="thumbnail">
        <p>NOTIFICATIONS ABOUT FOLLOWERS</p>
      </div>      
      <div class="well">
        <p>FOLLOWER 1 just uploaded an item</p>
      </div>
      <div class="well">
        <p>FOLLOWER 2 just uploaded an item</p>
      </div>
      <div class="well">
        <p>FOLLOWER 3 just uploaded an item</p>
      </div>
      <div class="well">
        <p>FOLLOWER 4 just uploaded an item</p>
      </div>
      <div class="well">
        <p>FOLLOWER 5 just uploaded an item</p>
      </div>
      <div class="well">
        <p>FOLLOWER 6 just uploaded an item</p>
      </div>
    </div>
  </div>
</div>
<script type="text/template" id="table_headingh">
  <table class="table table-hover table-condensed col-xs-3">
    <thead class="thead-inverse">
      <tr>
        <th>Image</th><th>Name</th><th>Views</th><th>Description</th><th>Trader</th><th>Trade</th><th>Uploaded</th>
      </tr>
    </thead>
    <tbody>
</script>

<!-- Modal -->
  <div class="modal fade" id="requestModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center">Request Transaction</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" onsubmit="return sendRequest();">
            <fieldset>

            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Item Owner</label>
              <div class="col-md-8">
                <input id="requestee" name="requestee" type="text" disabled placeholder="Item Owner" class="form-control input-md" required="">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Item</label>
              <div class="col-md-8">
                <input id="requesteditem" name="requesteditem" type="text" disabled placeholder="Requested Item" class="form-control input-md" required="">
              </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="selectbasic">Your Item</label>
              <div class="col-md-8">
                <select id="myitems" name="myitems" class="form-control" required="">
                  
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12">
                <button  class="btn btn-success" type="submit">Send Request</button>
                <button  class="btn btn-danger" data-dismiss="modal">Cancel Request</button>

              </div>
            </div>

            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>

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