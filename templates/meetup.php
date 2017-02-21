<?php
include "../lib.php";
include "base.php";

?>

<div class ="container-fluid">
  <div class ="row">
    <div class="col-xs-12 table-responsive">
      <h2 style="text-align: center; font-family: 'Acme', sans-serif; color:orange">Requested items Meetup</h2>
    <!--<h4>Products</h4>
    <p>A table highlighting the available products</p> -->
      <div id="table_sec_requesting"></div>
    </div>

    <div class ="col-xs-12 table-responsive">
      <h2 style="text-align: center; font-family: 'Acme', sans-serif; color:orange">Requests for items Meetup</h2>
    <!--<h4>Products</h4>
    <p>A table highlighting the available products</p> -->
      <div id="table_sec_requested"></div>
    </div>
  </div>  
</div>

<script type="text/template" id="table_heading_requesting">
  <table class="table table-hover table-condensed">
    <thead>
    <tr>
      <th>My Item</th><th>Their Item</th><th>Requestee</th><th>Contact</th><th>Date</th><th>Location</th><th>Options</th>
    </tr>
    </thead>
    <tbody>
</script>

<script type="text/template" id="table_heading_requested">
  <table class="table table-hover table-condensed">
    <thead>
    <tr>
      <th>My Item</th><th>Their Item</th><th>Requester</th><th>Contact</th><th>Date</th><th>Location</th><th>Options</th>
    </tr>
    </thead>
    <tbody>
</script>
