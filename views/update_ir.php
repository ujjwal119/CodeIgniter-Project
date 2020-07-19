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
  	<div class="ui massive inverted menu">
      <a class="ui item" href = "<?php echo base_url().'user/task'; ?>"><i class="home icon"></i>Home</a>
      <div class="right menu">
        <a class="ui item" href = "<?php echo base_url().'user/logout'; ?>"><i class="user times icon"></i>Logout</a>
      </div>
    </div><br>
    <h2 class="ui center aligned icon header">
  		<i class="circular book icon"></i>
 		<div class="content">
  			<?php echo $ir_data['project_name']; ?>
   			<div class="sub header"><?php echo $ir_data['install_report']." (".$ir_data['sublocation'].")"; ?></div>
  		</div>
	</h2><br>
    <div class="ui one column stackable center aligned page grid">
      <form class="ui form attached fluid segment" method="post" action ='<?php echo base_url()."user/update_ir";?>' enctype="multipart/form-data">
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
            <input type="text" name ="po" value="<?php echo $ir_data['po']; ?>" readonly> 
          </div>
          <div class="field">
            <label>PO Date</label>
            <input type="date" name="t_date" value="<?php echo date('Y-m-d', strtotime($ir_data['po_date'])); ?>" readonly>
          </div>
          <div class="field">
            <label>Client</label>
            <input type="text" name ="c_name" value="<?php echo $ir_data['client_name']; ?>" readonly>
          </div>
        </div>
        <div class="three fields">
          <div class="field">
            <label>IR Prepared By</label>
            <select class="ui fluid search selection dropdown" id="ir_by" name = "ir_by" required="required">
              <option value="">Select Name</option>
              <?php foreach ($site_engineer as $key => $e_name) { ?>
                <option value="<?php echo $e_name['full_name']; ?>"<?php if($e_name['full_name'] == $ir_data['ir_prepared_by']) { echo "selected"; } ?>><?php echo $e_name['full_name']; ?></option>
              <?php } ?>          
            </select>
            <!-- <input type="text" name ="ir_by" value="<?php//echo $ir_data['ir_prepared_by']; ?>">  -->
          </div>
          <div class="field">
            <label>Client Site Project Manager</label>
            <input type="text" name ="c_manager" value="<?php echo $ir_data['client_manager']; ?>">
          </div>
          <div class="field">
            <label>Eurus Project Manager</label>
            <input type="text" name ="e_manager" value="<?php echo $ir_data['eurus_manager']; ?>" readonly>
          </div>
        </div>
        <div class="two fields">
          <div class="field">
            <label>Project Name</label>
            <input type="text" name="p_name" value="<?php echo $ir_data['project_name']; ?>" readonly>
          </div>
          <div class="field">
            <label>Site Address</label>
            <input type="text" id="site_add" name ="site_add" value="<?php echo $ir_data['site_add']; ?>" readonly>
          </div>
        </div>
        <div class="three fields"> 
          <div class="field">
            <label>Eurus Site Engineer</label>
            <select class="ui fluid dropdown" multiple="" id="e_engnr" name = "e_engnr[]" required="required">
              <option value="">Select Name</option>
              <?php $esite = explode(",", $ir_data['eurus_engineer']); foreach ($site_engineer as $key => $e_name) { ?>
                <option value="<?php echo $e_name['full_name']; ?>"<?php if (in_array($e_name['full_name'], $esite))
  				{ echo "selected";}?>><?php echo $e_name['full_name']; ?></option>
              <?php } ?>          
            </select>
          </div>
          <div class="field">
            <label>Installation Report #</label>
            <input type="text" name ="install_report" value="<?php echo $ir_data['install_report']; ?>" readonly>
          </div>
          <div class="field">
            <label>Date of Completion</label>
            <input type="date" name ="dt_complt" value="<?php echo date('Y-m-d', strtotime($ir_data['completion_date'])); ?>">
          </div>
        </div>
        <?php $i=1; foreach ($get_equipment as $key => $get_data) {  ?>
          <div><br>
          <h4 class="ui dividing header">Machine Details</h4>
          <div class="fields">
            <div class="one wide field">
              <label>S. No.</label>
              <input type="text" name="s_no[]" value="<?php echo $i; ?>" class="s_no" readonly="readonly"> 
            </div>
            <div class="five wide field">
              <label>Equipment Model</label>
              <select class="ui fluid search selection dropdown equip" name = "equip[]" onChange="sel(this);" required="required">
                <option value="">Select model</option>
                <?php foreach ($equi_model as $key => $m_name) { ?>
                <option value="<?php echo $m_name['model']; ?>"<?php if($m_name['model'] == $get_data['equipment']) {echo " selected"; }?>><?php echo $m_name['model']; ?></option>
                <?php } ?>
                <option value="other">Other</option>          
              </select>
            </div>
            <div class="two wide field">
              <label>Rack</label>
              <select class="ui fluid dropdown" name = "rack[]" required="required">
                <option value="">Choose</option>
                <?php for($j = 1; $j <= 10; $j++) {?>
                <option value="<?php echo $get_data['rack'];?>"<?php if($j == $get_data['rack']){echo " selected"; } ?>><?php echo $get_data['rack'];?></option>
              <?php } ?>
              </select>
            </div>
            <div class="four wide field">
              <label>Diagram Ref</label>
              <input type="file" name ="dgm_ref[<?php echo $i;?>][]"><a href ="<?php echo base_url()."uploads/".$project_no."/".$get_data['diagram_ref']; ?>"><?php echo $get_data['diagram_ref'];?></a>
            </div>
            <div class="four wide field">
              <label>Date</label>
              <input type="date" name = "todate[]" value="<?php echo date('Y-m-d', strtotime($get_data['create_date'])); ?>" required="required">
              <input type="hidden" name ="m_sno[]" value="<?php echo $get_data['s_no']; ?>">
            </div>
          </div>
          <h4 class="ui dividing header service">I & C Services Provided by Eurus</h4>
          
            <table class="ui celled table myTable">
              <thead>
                <tr>
                  <th>Services Provided </th>
                  <th>Start Date </th>
                  <th>Completion Date</th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($get_services as $key => $get_service) { if($i == $get_service['m_no']) {?>
                <tr class="tr1">
                  <td>
                    <select class="ui fluid search selection dropdown" name = "tr_services[<?php echo $i;?>][]" required="required">
                      <option value="">Select Service</option>
                      <option value="BOQ Verification"<?php if($get_service['services'] == "BOQ Verification") { echo " selected";} ?>>BOQ Verification</option>
                      <option value="Physical Installation"<?php if($get_service['services'] == "Physical Installation") { echo " selected";} ?>>Physical Installation</option>
                      <option value="Installation of intra/inter rack optical/data cables"<?php if($get_service['services'] == "Installation of intra/inter rack optical/data cables") { echo " selected";} ?>>Installation of intra/inter rack optical/data cables</option>
                      <option value="Labelling of data/optical cables"<?php if($get_service['services'] == "Labelling of data/optical cables") { echo " selected";} ?>>Labelling of data/optical cables</option>
                      <option value="Power up and POST"<?php if($get_service['services'] == "Power up and POST") { echo " selected";} ?>>Power up and POST</option>
                      <option value="Basic configuration as per provided templates"<?php if($get_service['services'] == "Basic configuration as per provided templates") { echo " selected";} ?>>Basic configuration as per provided templates</option>
                      <option value="Acceptance Testing"<?php if($get_service['services'] == "Acceptance Testing") { echo " selected";} ?>>Acceptance Testing</option>
                      <option value="Internal Power Cabling"<?php if($get_service['services'] == "Internal Power Cabling") { echo " selected";} ?>>Internal Power Cabling</option>
                      <option value="Other"<?php if($get_service['services'] == "Other") { echo " selected";} ?>>Other</option>
                    </select>
                  </td>
                  <td><input type="date" name ="tr_date[<?php echo $i;?>][]" value="<?php echo date('Y-m-d', strtotime($get_service['start_date'])); ?>"required="required"></td>
                   <td><input type="date" name ="tr_cdate[<?php echo $i;?>][]" value="<?php echo date('Y-m-d', strtotime($get_service['complete_date'])); ?>" required="required"></td>
                   <input type="hidden" name ="tr_sno[<?php echo $i;?>][]" value="<?php echo $get_service['s_no']; ?>">
                  <td> <button class="ui inverted red button removeoption"><i class="close icon"></i>Remove</button></td>
                </tr>
                <?php } } ?>
              </tbody>
            </table>
            <div class="ui right floated buttons"><button class="ui primary right floated button add_services" type="button" onclick="clk1(<?php echo $i;?>,this);"><i class="plus icon"></i>Add more services</button><div class="or"></div><button class="ui right floated red button removecl" type="button" onclick="remove(<?php echo $i;?>,this);"><i class="close icon"></i>Remove</button></div><br>
          </div>
       	<?php $i = $i+1; } ?>
        <div id="mchn_det"><br></div>
        <div class="three fields">
          <button class="ui primary left floated button add_more" type="button"><i class="plus icon"></i>Add more</button>
        </div>
        <h4 class="ui dividing header">Remarks by Site Engineer</h4>
        <textarea class="form-control" name="remarks" rows="1" required="required"><?php echo $ir_data['remarks']; ?></textarea><br>
        <br><div>
          <input type="hidden" name = "p_num" value="<?php echo $project_no; ?>">
          <button class= "ui primary floated button" style="margin-left: 50%;" type="submit" value="update" name="update"> Update </button>
        </div>
      </form>
    </div>
    <script type="text/javascript">
      $(document).ready(function() { 
        $(".add_more").click(function () {
          var num = $('.s_no').length;
          var s_no = num + 1;
          $("#mchn_det").append('<div><h4 class="ui dividing header">Machine Details</h4><div class=" fields"><div class="one wide field"><label>S. No.</label><input type="text" name="s_no[]" class="s_no" readonly="readonly"></div><div class="five wide field"><label>Equipment Model</label><select class="ui fluid search selection dropdown equip" name = "equip[]" onChange="sel(this);" required><option value="">Select model</option><?php foreach ($equi_model as $key => $m_name) { ?><option value="<?php echo $m_name['model']; ?>"><?php echo $m_name['model']; ?></option><?php } ?><option value="other">Other</option></select></div><div class="four wide field other" style="display:none;"><label>Model Description</label><input type="text" name="other['+ s_no +'][]" id="other" placeholder="Write the model"></div><div class="two wide field"><label>Rack</label><select class="ui fluid dropdown" name = "rack[]" required><option value="">Choose</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select></div><div class="four wide field"><label>Diagram Ref</label><input type="file" name ="dgm_ref['+ s_no +'][]" ></div><div class="four wide field"><label>Date</label><input type="date" name = "todate[]" required></div></div><h4 class="ui dividing header">I & C Services Provided by Eurus</h4><table class="ui celled table myTable"><thead><tr><th>Services Provided </th><th>Start Date</th><th>Completion Date </th><th> Action </th></tr></thead><tbody><tr class="tr1"><td><select class="ui fluid search selection dropdown" name = "tr_services['+ s_no +'][]" required><option value="">Select Service</option><option value="BOQ Verification">BOQ Verification</option><option value="Physical Installation">Physical Installation</option><option value="Installation of intra/inter rack optical/data cables">Installation of intra/inter rack optical/data cables</option><option value="Labelling of data/optical cables">Labelling of data/optical cables</option><option value="Power up and POST">Power up and POST</option><option value="Basic configuration as per provided templates">Basic configuration as per provided templates</option><option value="Acceptance Testing">Acceptance Testing</option><option value="Internal Power Cabling">Internal Power Cabling</option><option value="Other">Other</option></select></td><td><input type="date" name ="tr_date['+ s_no +'][]" required="required"></td><td><input type="date" name ="tr_cdate['+ s_no +'][]" required="required"></td><td> <button class="ui inverted red button removeoption"><i class="close icon"></i>Remove</button></td></tr></tbody></table><div class="ui right floated buttons"><button class="ui primary right floated button add_services" type="button" onclick="clk('+ s_no +',this);"><i class="plus icon"></i>Add more services</button><div class="or"></div><button class="ui right floated red button removeclass"><i class="close icon"></i>Remove</button></div><br><br></div>');
            $('.s_no').each(function(index) {
              $(this).val(index+1); 
            });
            $('.ui.dropdown')
            .dropdown();

            $(function () {
              $('input[type=file]').change(function () {
                var val = $(this).val().toLowerCase(),
                regex = new RegExp("(.*?)\.(pdf|jpg|png|jpeg|csv|xlsx)$");

              if (!(regex.test(val))) {
                $(this).val('');
                alert('Please select correct file format');
              }
            });
          });
        });


        // $(".other").hide();
        $("body").on("click",".removeclass", function(){ 
          $(this).parent().parent().remove();
          $('.s_no').each(function(index) {
              $(this).val(index+1); 
            });
        });

        $("body").on("click",".removeoption", function(){ 
          $(this).parent().parent().remove();
        });

        $('input[type="text"]').keyup(function(evt){
            var txt = $(this).val();
            $(this).val(txt.replace(/^(.)|\s(.)/g, function($1){ return $1.toUpperCase( ); }));
        });
        $('.ui.dropdown')
          .dropdown();

          });
        function sel(obj){
              var value =  $(obj).val();
              if(value == 'other')
              {
                $(obj).parent().parent().next('.field.other').show();
              }
              else
              {
                $(obj).parent().parent().next('.field.other').hide();
              }
          }

          function clk(no,obj) {
            // console.log($(obj).parent().parent().find(".myTable tbody").html());
              $(obj).parent().parent().find("tbody").append('<tr class="tr1"><td><select class="ui fluid search selection dropdown" name = "tr_services['+ no +'][]" required><option value="">Select Service</option><option value="BOQ Verification">BOQ Verification</option><option value="Physical Installation">Physical Installation</option><option value="Installation of intra/inter rack optical/data cables">Installation of intra/inter rack optical/data cables</option><option value="Labelling of data/optical cables">Labelling of data/optical cables</option><option value="Power up and POST">Power up and POST</option><option value="Basic configuration as per provided templates">Basic configuration as per provided templates</option><option value="Acceptance Testing">Acceptance Testing</option><option value="Internal Power Cabling">Internal Power Cabling</option><option value="Other">Other</option></select></td><td><input type="date" name ="tr_date['+ no +'][]" required="required"></td><td><input type="date" name ="tr_cdate['+ no +'][]" required="required"></td><td> <button class="ui inverted red button removeoption"><i class="close icon"></i>Remove</button></td></tr>');
               $('.ui.dropdown')
          .dropdown();
          }
          function clk1(no,obj) {
            // console.log($(obj).parent().prev().html());
            // console.log($(obj).prev().html());
              $(obj).parent().prev().append('<tr class="tr1"><td><select class="ui fluid search selection dropdown" name = "tr_services['+ no +'][]" required><option value="">Select Service</option><option value="BOQ Verification">BOQ Verification</option><option value="Physical Installation">Physical Installation</option><option value="Installation of intra/inter rack optical/data cables">Installation of intra/inter rack optical/data cables</option><option value="Labelling of data/optical cables">Labelling of data/optical cables</option><option value="Power up and POST">Power up and POST</option><option value="Basic configuration as per provided templates">Basic configuration as per provided templates</ooption><option value="Acceptance Testing">Acceptance Testing</option><option value="Internal Power Cabling">Internal Power Cabling</option><option value="Other">Other</option></select></td><td><input type="date" name ="tr_date['+ no +'][]" required="required"></td><td><input type="date" name ="tr_cdate['+ no +'][]" required="required"></td><td> <button class="ui inverted red button removeoption"><i class="close icon"></i>Remove</button></td></tr>');
               $('.ui.dropdown')
               .dropdown();
          }

          function remove(no,obj) {
            $(obj).parent().parent().remove();
            $('.s_no').each(function(index) {
              $(this).val(index+1); 
            });
          }

          $(function () {
            $('input[type=file]').change(function () {
              var val = $(this).val().toLowerCase(),
              regex = new RegExp("(.*?)\.(pdf|jpg|png|jpeg|csv|xlsx)$");

              if (!(regex.test(val))) {
                $(this).val('');
                alert('Please select correct file format');
            }
          });
        });
    </script>
  </body>
</html>  

    