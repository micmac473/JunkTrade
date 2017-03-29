<?php
include "../lib.php";
include "base.php";

?>

<div class ="container-fluid">
  <div class ="row">
    <div class="col-xs-12 table-responsive">
      <div class="header text-center"> 
        <h1>Requested Items <i class="fa fa-handshake-o fa-lg" aria-hidden="true" ></i></h1>
      </div>

      <div id="table_sec_requested"></div>
    </div>

    <div class ="col-xs-12 table-responsive">
      <div class="header text-center">
        <h1>Requests For Items <i class="fa fa-handshake-o fa-lg" aria-hidden="true" ></i></h1>
      </div>

      <div id="table_sec_requests"></div>
    </div>
  </div>  
</div>

<script type="text/template" id="table_heading_requested">
  <table class="table table-hover table-condensed">
    <thead>
    <tr>
      <th><i class="fa fa-user" aria-hidden="true" ></i> From</th>
      <th>Chat</th>
      <th><i class="fa fa-phone" aria-hidden="true" ></i> Contact</th>
      <th><i class="fa fa-gift" aria-hidden="true" ></i> With</th>
      <th><i class="fa fa-gift" aria-hidden="true" ></i> For</th>
      <th><i class="fa fa-calendar" aria-hidden="true" ></i> Date</th>
      <th><i class="fa fa-map-marker" aria-hidden="true" ></i> Location</th>
      <th>Feedback</th>
    </tr>
    </thead>
    <tbody>
</script>

<script type="text/template" id="table_heading_requests">
  <table class="table table-hover table-condensed">
    <thead>
    <tr>
      <th><i class="fa fa-user" aria-hidden="true" ></i> From</th>
      <th>Chat</th>
      <th><i class="fa fa-phone" aria-hidden="true" ></i> Contact</th>
      <th><i class="fa fa-gift" aria-hidden="true" ></i> With</th>
      <th><i class="fa fa-gift" aria-hidden="true" ></i> For</th>
      <th><i class="fa fa-calendar" aria-hidden="true" ></i> Date</th>
      <th><i class="fa fa-map-marker" aria-hidden="true" ></i> Location</th>
      <th>Feedback</th>
    </tr>
    </thead>
    <tbody>
</script>

<!-- Requester Feedback Modal -->
  <div class="modal fade" id="requesterFeedbackModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          <form class="form" id="requesterfeedbackform" onsubmit="return requesterFeedback();">
            <fieldset>

              <div class="modal-header">
                <h2 class="modal-title" style="text-align: center">Feedback <i class="fa fa-comment" aria-hidden="true" ></i></h2>
             </div>
              <input id="tradeid" name="tradeid" type="hidden" disabled class="form-control input-md">

              <div class="form-group">
                <label class="control-label text-center" for="textarea">Rate</label>
                <div class="">  
                  <input id="rating" type="hidden" class="rating" data-filled="fa fa-star fa-3x" data-empty="fa fa-star-o fa-3x" data-fractions="2" required/>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label" for="textarea">Comments</label>
                <div class="">                     
                  <textarea class="form-control"  id="feedbackcomment" rows="5" name="feedbackcomment" placeholder="Kindly leave comments about the trade" required></textarea>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <button  class="btn btn-success btn-block" type="submit"><i class="fa fa-paper-plane" aria-hidden="true" ></i>Send</button>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <button  class="btn btn-danger btn-block" data-dismiss="modal" onclick="cancelFeedback()"><i class="fa fa-ban" aria-hidden="true" ></i> Cancel</button>
                  </div>
                </div>
              </div>

            </fieldset>
          </form>

        </div>
      </div>
    </div>
  </div>

  <!-- Requestee Feedback Modal -->
  <div class="modal fade" id="requesteeFeedbackModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          <form class="form" id="requesteefeedbackform" onsubmit="return requesteeFeedback();">
            <fieldset>

              <div class="modal-header">
                <h2 class="modal-title" style="text-align: center">Feedback <i class="fa fa-comment" aria-hidden="true" ></i></h2>
             </div>


              <input id="tradeid" name="tradeid" type="hidden" disabled class="form-control input-md">

              
              <div class="form-group">
                <label class="control-label text-center" for="textarea">Rate</label>
                <div class="">  
                  <input id="rating" type="hidden" class="rating" data-filled="fa fa-star fa-3x" data-empty="fa fa-star-o fa-3x" data-fractions="2" required/>
                </div>
              </div>

              <div class="form-group">
              <label class="control-label" for="textarea">Comments</label>
              <div class="">                     
                <textarea class="form-control"  id="feedbackcomment" rows="5" name="feedbackcomment" placeholder="Comments about the trade" required></textarea>
              </div>
            </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <button  class="btn btn-success btn-block" type="submit"><i class="fa fa-paper-plane" aria-hidden="true" ></i> Send</button>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <button  class="btn btn-danger btn-block" data-dismiss="modal" onclick="cancelFeedback()"><i class="fa fa-ban" aria-hidden="true" ></i> Cancel</button>
                  </div>
                </div>
              </div>

            </fieldset>
          </form>

        </div>
      </div>
    </div>
  </div>

<!-- Edit Date Modal -->
  <div class="modal fade" id="editDateModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          <form class="form" id="editdateform" onsubmit="return changeTradeDate();">
            <fieldset>

              <div class="modal-header">
                <h2 class="modal-title" style="text-align: center">Modify Trade Date <i class="fa fa-calendar" aria-hidden="true" ></i></h2>
             </div>


             <input class="form-control" id="tradeid" name="tradeid" type="hidden" required disabled/>

              <div class="form-group"> <!-- Date input -->
                <label class="control-label" for="date">New Trade Date</label>
                <div class="">
                  <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input class="form-control" id="newtradedate" name="newtradedate" placeholder="Select a new date" type="text" required/>
                  </div>
                </div>
              </div> 

              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <button  class="btn btn-success btn-block" type="submit"><i class="fa fa-paper-plane" aria-hidden="true" ></i> Save</button>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <button  class="btn btn-danger btn-block" data-dismiss="modal" onclick="cancelEdit()"><i class="fa fa-ban" aria-hidden="true" ></i> Cancel</button>
                  </div>
                </div>
              </div>

            </fieldset>
          </form>

        </div>
      </div>
    </div>
  </div>

<!-- Edit Location Modal -->
  <div class="modal fade" id="editLocationModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          <form class="form" id="editlocationform" onsubmit="return changeTradeLocation();">
            <fieldset>

              <div class="modal-header">
                <h2 class="modal-title" style="text-align: center">Modify Trade Location <i class="fa fa-map-marker" aria-hidden="true" ></i></h2>
             </div>


             <input class="form-control" id="tradeid" name="tradeid" type="hidden" required disabled/>

              <div class="form-group">
                <label class="control-label" for="selectbasic">UWI Location</label>
                <div class="">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                  <select id="newtradelocation" name="newtradelocation" class="form-control" required>
                    <option value="" disabled selected> Select a campus location</option>
                    <option value="Food Court">Food Court</option>
                    <option value="JFK Quadrangle">JFK Quadrangle</option>
                    <option value="LRC Greens">LRC Greens</option>
                    <option value="DAAGA">DAAGA</option>
                    <option value="Student Admin">Student Admin</option>
                    <option value="Bookstore">Bookstore</option>
                  </select>
                </div>
              </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <button  class="btn btn-success btn-block" type="submit"><i class="fa fa-paper-plane" aria-hidden="true" ></i> Save</button>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <button  class="btn btn-danger btn-block" data-dismiss="modal" onclick="cancelEdit()"><i class="fa fa-ban" aria-hidden="true" ></i> Cancel</button>
                  </div>
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
  getRequestedMeetUp();
  getRequestsMeetUp();

};
var currRequestedMeetUpRequestee = <?php echo json_encode(getRequestedMeetupRequestee())?>;
var currRequestedMeetUpRequester = <?php echo json_encode(getRequestedMeetupRequester())?>; 
var currRequestsMeetUpRequestee = <?php echo json_encode(getRequestsMeetupRequestee())?>;
var currRequestsMeetUpRequester = <?php echo json_encode(getRequestsMeetupRequester())?>;

setInterval(function(){
    queryRequestedMeetUp();
    queryRequestsMeetUp();
},2500);


function queryRequestedMeetUp(){
  $.get("../index.php/requestedmeetuprequestee", function(res1){
    $.get("../index.php/requestedmeetuprequester",function(res2){
      if(JSON.stringify(res1) !== JSON.stringify(currRequestedMeetUpRequestee) || JSON.stringify(res2) !== JSON.stringify(currRequestedMeetUpRequester) ){
      //toastr["success"]("New Message");
        currRequestedMeetUpRequestee = res1;
        currRequestedMeetUpRequester = res2;
        processRequestedMeetUp(res1, res2);
      }
    },"json");
  },"json");
} 

function queryRequestsMeetUp(){
  $.get("../index.php/requestsmeetuprequestee", function(res1){
    $.get("../index.php/requestsmeetuprequester",function(res2){
      if(JSON.stringify(res1) !== JSON.stringify(currRequestsMeetUpRequestee) || JSON.stringify(res2) !== JSON.stringify(currRequestsMeetUpRequester) ){
      //toastr["success"]("New Message");
        currRequestsMeetUpRequestee = res1;
        currRequestsMeetUpRequester = res2;
        processRequestsMeetUp(res1, res2);
      }
    },"json");
  },"json");
} 

$(document).ready(function(){
      var date_input=$('input[name="newtradedate"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'DD MM dd, yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
        startDate: new Date()
      };
      date_input.datepicker(options);
    })
</script>
