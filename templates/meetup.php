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
      <th>From</th>
      <th>Contact</th>
      <th>With</th>
      <th>For</th>
      <th>Date</th>
      <th>Location</th>
      <th>Chat</th>
      <th>Feedback</th>
    </tr>
    </thead>
    <tbody>
</script>

<script type="text/template" id="table_heading_requests">
  <table class="table table-hover table-condensed">
    <thead>
    <tr>
      <th>From</th>
      <th>Contact</th>
      <th>With</th>
      <th>For</th>
      <th>Date</th>
      <th>Location</th>
      <th>Chat</th>
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
                <h2 class="modal-title" style="text-align: center">Trade Feedback</h2>
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
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <button  class="btn btn-success btn-block" type="submit">Send</button>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <button  class="btn btn-danger btn-block" data-dismiss="modal" onclick="cancelFeedback()">Cancel</button>
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
                <h2 class="modal-title" style="text-align: center">Trade Feedback</h2>
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

  <!-- Chat Modal -->
  <div class="modal fade" id="chatmodal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-body" >
          <form class="form" id="chatform" onsubmit="return sendMessage();">
            <fieldset>

              <div class="modal-header" style="background-color:#096790; color: white">
                <h2 class="modal-title" style="text-align: center" ><i class="fa fa-user fa-lg" aria-hidden="true"></i> <span id="tradername"></span> <i class="fa fa-comment-o fa-lg" aria-hidden="true"></i></h2>
             </div>

              <input id="traderusername" name="traderusername" type="hidden" disabled class="form-control input-md">
              <input id="userid" name="userid" type="hidden" disabled class="form-control input-md">
              <input id="traderid" name="traderid" type="hidden" disabled class="form-control input-md">
              <!-- <div class="form-group">
                <div class="">                     
                  <textarea class="form-control"  id="messages" rows="10" name="messages" readonly="readonly"></textarea>
                </div>
              </div> -->

              <div class="form-group" style="background-color:#f6f6f6">
                <div class="">                     
                  <div id="divmessages" style="overflow-y: scroll; height: 250px;">
                  </div>
                </div>
              </div>
              <div class="form-group" >
                <div class="row" >
                  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                  <input autofocus class="form-control" type="text" id="message" maxlength="200" placeholder="Message" autocomplete="off"  required/>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <button class="btn btn-primary btn-block" type="submit">Send</button> 
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

/*setInterval(function(){
    queryChat();
},2500);

var currNewMessages = <?php echo json_encode(getNewMessages())?> 
function queryChat(){
  $.get("../index.php/newmessages", function(messages){
    if(JSON.stringify(messages) !== JSON.stringify(currNewMessages)){
      toastr["success"]("New Message");
      currNewMessages = messages;
    }
  },"json");
} */

</script>
