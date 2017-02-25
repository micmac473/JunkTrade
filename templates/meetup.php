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

<!-- Meet up Modal -->
  <div class="modal fade" id="feedbackModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <form class="form" id="meetupform" onsubmit="return feedback();">
            <fieldset>

              <div class="modal-header">
                <h2 class="modal-title" style="text-align: center">Trade Feedback</h2>
             </div>

              <input id="rating" type="hidden" class="rating" data-filled="fa fa-star fa-3x" data-empty="fa fa-star-o fa-3x" required/>

              <div class="form-group">
              <label class="control-label" for="textarea">Comments</label>
              <div class="">                     
                <textarea class="form-control"  id="feedbackcomment" rows="5" name="feedbackcomment" placeholder="Comments about the trade" required></textarea>
              </div>
            </div>

              <div class="form-group">
                <div class="">
                  <button  class="btn btn-success btn-block" type="submit">Send</button>
                  <button  class="btn btn-danger btn-block" data-dismiss="modal" onclick="cancelFeedback()">Cancel</button>
                </div>
              </div>

            </fieldset>
          </form>

        </div>
      </div>
    </div>
  </div>

