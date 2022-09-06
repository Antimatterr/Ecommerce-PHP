<?php
require('./top.php')
?>


<div class="container rounded bg-white mt-5 mb-5">
  <div class="row">
    <div class="col-md-3 border-right">

    </div>
    <div class="col-md-5 border-right">
      <div class="p-3 py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="text-center">Edit account details</h4>
        </div>
        <div class="row mt-3">
          <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" value=""></div>

          <div class="row mt-3">
            <div class="col-md-12"><label class="labels">PhoneNumber</label><input type="text" class="form-control" placeholder="enter phone number" value=""></div>
            <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control" placeholder="enter address" value=""></div>
            <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control" placeholder="enter email id" value=""></div>
            
          <div class="row mt-3">
            <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value=""></div>
            <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>
          </div>
          <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
        </div>
      </div>
      
    </div>
  </div>
</div>
</div>
<?php
require('./footer.php')
?>