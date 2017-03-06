<?php
include "../lib.php";
include "base.php";

?>

<div class ="container-fluid">
  <div class="row">
    <div class ="">
      <div class="header text-center">
        <h1>Incoming Requests <i class="fa fa-envelope-open" aria-hidden="true" ></i></h1>
      </div>
      <div id="table_secr"></div>
    </div>
  </div>

</div>  <!-- close container -->  

<script type="text/template" id="table_headingr">
  <table class="table table-hover table-condensed table-responsive">
    <thead>
      <tr>
        <th>From</th>
        <th>With</th>
        <th>For</th>
        <th>Accept Request</th>
        <th>Deny Request</th>
      </tr>
    </thead>
    <tbody>
</script>

<!-- View Modal -->
  <div class="modal fade" id="requestModalP" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <form class="form" id="viewrequestform">
            <fieldset>

            <div class="form-group">
              <label class="col-md-12 control-label" for="name">Requester</label>
              <div class="col-md-12">
                <input id="requester" name="requester" type="text" disabled placeholder="Item Owner" class="form-control input-md" required="">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-12 control-label" for="name">Item</label>
              <div class="col-md-12">
                <input id="requesteritem" name="requesteritem" type="text" disabled placeholder="Requested Item" class="form-control input-md" required="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 control-label" for="name"></label>
              <div class="col-md-12">
                <img src="" id="imagepreview" style="width: 100%">
              </div>
            </div>
            </fieldset>
          </form>

        </div>
      </div>
    </div>
  </div> 

<!-- Meet up Modal -->
  <div class="modal fade" id="meetUpModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <form class="form" id="meetupform" onsubmit="return sendArrangement();">
            <fieldset>

              <div class="modal-header">
                <h2 class="modal-title" style="text-align: center">Request Details <i class="fa fa-envira" aria-hidden="true"></i></h2>
             </div>
              <input id="requestid" name="requestid" type="hidden" disabled placeholder="Requested Item" class="form-control input-md">

              <div class="form-group"> 
                <label class="control-label" for="date">Requester</label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <input class="form-control" id="requester" name="requester" type="text" required disabled/>
                  </div>
                </div>
              </div> 

              <div class="form-group"> 
                <label class="control-label" for="date">Requester Item</label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-gift" aria-hidden="true"></i></span>
                    <input class="form-control" id="requesteritem" name="requesteritem" type="text" required disabled/>
                  </div>
                </div>
              </div> 

              <div class="form-group"> 
                <label class="control-label" for="date">Requester Phone Number</label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone-square" aria-hidden="true"></i></span>
                    <input class="form-control" id="requestercontact" name="requestercontact" type="text" disabled/>
                  </div>
                </div>
              </div> 

              <div class="form-group"> 
                <label class="control-label" for="date">Your Item</label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-gift" aria-hidden="true"></i></span>
                    <input class="form-control" id="requesteeitem" name="requesteeitem" type="text" required disabled/>
                  </div>
                </div>
              </div> 

              <div class="modal-header">
                <h2 class="modal-title" style="text-align: center">Meetup Details <i class="fa fa-handshake-o" aria-hidden="true"></i></h2>
              </div>

              <div class="form-group"> <!-- Date input -->
                <label class="control-label" for="date">Date</label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input class="form-control" id="tradedate" name="tradedate" placeholder="MM/DD/YYY" type="text" required/>
                  </div>
                </div>
              </div> 

              <div class="form-group">
                <label class="control-label" for="selectbasic">UWI Location</label>
                <div class="">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                  <select id="tradelocation" name="tradelocation" class="form-control" required>
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
                <label class="control-label" for="date">Phone Number</label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone-square" aria-hidden="true"></i></span>
                    <input class="form-control" id="requesteecontact" name="requesteecontact" type="tel" placeholder="868-123-4567"required pattern="\d{3}[\-]\d{3}[\-]\d{4}"/>
                    
                  </div>
                  <span class="help-block">Format: 868-123-4567</span>
                </div>
              </div> 

              <div class="form-group">
                <div class="">
                  <button  class="btn btn-success btn-block" type="submit">Send Arrangement</button>
                  <button  class="btn btn-danger btn-block" data-dismiss="modal" onclick="cancelArrangement()">Cancel Arrangement</button>
                </div>
              </div>

            </fieldset>
          </form>

        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
      var date_input=$('input[name="tradedate"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>