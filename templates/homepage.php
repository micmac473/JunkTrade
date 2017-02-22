<?php
include "../lib.php";
include "base.php";

?>

    <!--Div that will hold the pie chart-->

    
<div class="container-fluid">
  <div class="row">
    <div id = "itemblock" class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
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

<!-- Item Request Modal -->
  <div class="modal fade" id="requestModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center">Request Transaction</h4>
        </div>
        <div class="modal-body">
          <form class="" onsubmit="return sendRequest();">
            <fieldset>

            <div class="form-group">
              <label class="control-label" for="name">Item Owner</label>
              <div class="">
                <input id="requestee" name="requestee" type="text" disabled placeholder="Item Owner" class="form-control input-md" required="">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label" for="name">Item</label>
              <div class="">
                <input id="requesteditem" name="requesteditem" type="text" disabled placeholder="Requested Item" class="form-control input-md" required="">
              </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
              <label class="control-label" for="selectbasic">Your Item</label>
              <div class="">
                <select id="myitems" name="myitems" class="form-control" required="">
                  
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="">
                <button  class="btn btn-success btn-block" type="submit">Send Request</button>
                <button  class="btn btn-danger btn-block" data-dismiss="modal">Cancel Request</button>

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