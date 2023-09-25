  <style>
    .card {
      width: 95%; /* Adjust the width as needed */
      margin: 0 auto; /* Center the card on the page horizontally */
    }
    .row {
      margin-top: 25px;
    }
    .col-sm-6{
      margin-left: 20px;
      margin-bottom: 10px;
    }

  </style>
<div class="row mb-2">
    <div class="col-sm-6">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Customer List</h1>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="card card-outline card-success" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
          
        <div class="card-body">
             <div class="table-responsive">
                <table class="table table-bordered table-stripped table-sm" id="user-datatables">
                    <thead>
                        <tr class="text-center">
                            <th>No.</th>
                            <th>Account No.</th>
                            <th>Customer Name</th>
                            <th>Contact No</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                          if (isset($result) && !empty($result)) {
                          $count = 1;
                          foreach ($result as $row) { // Loop through customer records
                      ?>
                          <tr class="text-center">
                          <td><?php echo $count++; ?></td>
                          <td><?php echo $row->account_no ?></td>
                          <td><?php echo $row->customer_fname . ' ' . $row->customer_lname; ?></td>
                          <td><?php echo $row->contact_no; ?></td>
                          <td><?php echo $row->balance; ?></td>
                          </tr>
                      <?php
                      }   
                      } else {
                      // Handle the case when there are no customer records to display
                      ?>
                        <tr>
                          <td colspan="5">No customer records found.</td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
        <script>
        $(document).ready(function(){
        <?php if ($this->session->flashdata('success')) { ?>
        toastr.success('<?php echo $this->session->flashdata('success'); ?>');
        <?php } elseif ($this->session->flashdata('error')) { ?>
        toastr.error('<?php echo $this->session->flashdata('error'); ?>');
        <?php } ?>
        });
        </script>