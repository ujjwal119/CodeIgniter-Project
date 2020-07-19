<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
  <head>
    <title>Update IR</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url();?>Semantic-UI-CSS-master/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>Semantic-UI-CSS-master/semantic.min.js"></script>
  </head>
  <body>
    <h2 class="ui center aligned icon header">
      <i class="circular book icon"></i>
      <div class="content">
      <?php echo $ir_data['project_name']; ?>
      <div class="sub header"><?php echo $ir_data['install_report']." (".$ir_data['sublocation'].")"; ?></div>
      </div>
    </h2><br>
    <div class="ui one column stackable center aligned page grid">
      <form class="ui form attached fluid segment">
        <div class="two fields">
          <div class="field">
            <label>Location</label>
            <input type="text" name="location" value="<?php echo $ir_data['location']; ?>">
          </div>
          <div class="field" id="area">
            <label>Area</label>
            <input type="text" name="area" id="sublocation" value="<?php echo $ir_data['sublocation']; ?>">
          </div>
        </div><br>

        <div class="three fields">
          <div class="field">
            <label>PO#</label>
            <input type="text" name ="po" value="<?php echo $ir_data['po']; ?>"> 
          </div>
          <div class="field">
            <label>PO Date</label>
            <input type="date" name="t_date" value="<?php echo date('Y-m-d', strtotime($ir_data['po_date'])); ?>">
          </div>
          <div class="field">
            <label>Client</label>
            <input type="text" name ="c_name" value="<?php echo $ir_data['client_name']; ?>">
          </div>
        </div>
        <div class="three fields">
          <div class="field">
            <label>IR Prepared By</label>
            <input type="text" name ="ir_by" value="<?php echo $ir_data['ir_prepared_by']; ?>"> 
          </div>
          <div class="field">
            <label>Client Site Project Manager</label>
            <input type="text" name ="c_manager" value="<?php echo $ir_data['client_manager']; ?>">
          </div>
          <div class="field">
            <label>Eurus Project Manager</label>
            <input type="text" name ="e_manager" value="<?php echo $ir_data['eurus_manager']; ?>">
          </div>
        </div>
        <div class="two fields">
          <div class="field">
            <label>Project Name</label>
            <input type="text" name="p_name" value="<?php echo $ir_data['project_name']; ?>">
          </div>
          <div class="field">
            <label>Site Address</label>
            <input type="text" id="site_add" name ="site_add" value="<?php echo $ir_data['site_add']; ?>">
          </div>
        </div>
        <div class="three fields">
          <div class="field">
            <label>Eurus Site Engineer</label>
            <input type="text" name ="e_engnr" value="<?php echo $ir_data['eurus_engineer']; ?>">
          </div>
          <div class="field">
            <label>Installation Report #</label>
            <input type="text" name ="install_report" value="<?php echo $ir_data['install_report']; ?>">
          </div>
          <div class="field">
            <label>Date of Completion</label>
            <input type="date" name ="dt_complt" value="<?php echo date('Y-m-d', strtotime($ir_data['completion_date'])); ?>">
          </div>
        </div>
      </form>
    </div>
  </body>
</html>  
