<?php
include "../lib.php";
include "base.php";

?>

<div class ="container-fluid">
  <div class ="row">
    <h1> Arrange Meet Up </h1>

    <form class="form-horizontal col-xs-6 col-xs-offset-3" >
<fieldset>

<!-- Form Name -->
<legend>Form Name</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Requestee</label>  
  <div class="col-md-4">
  <input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Multiple Radios -->
<div class="form-group">
  <label class="col-md-4 control-label" for="location">UWI Location</label>
  <div class="col-md-4">
  <div class="radio">
    <label for="location-0">
      <input type="radio" name="location" id="location-0" value="1" checked="checked">
      Food Court
    </label>
  </div>
  <div class="radio">
    <label for="location-1">
      <input type="radio" name="location" id="location-1" value="2">
      JFK
    </label>
  </div>
  <div class="radio">
    <label for="location-2">
      <input type="radio" name="location" id="location-2" value="">
      DAAGA
    </label>
  </div>
  <div class="radio">
    <label for="location-3">
      <input type="radio" name="location" id="location-3" value="">
      Student Admin
    </label>
  </div>
  <div class="radio">
    <label for="location-4">
      <input type="radio" name="location" id="location-4" value="">
      Alma Jordan Library
    </label>
  </div>
  </div>
</div>

</fieldset>
</form>

  </div>
</div>
