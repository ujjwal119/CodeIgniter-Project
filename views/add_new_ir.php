<?php
foreach ($machines as $key => $m_name) { 
	$key = $m_name['id']; $value=$m_name['model']; 
	$arr[$key] = $value; 
} 
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html>
  <head>
    <title>Navy</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url();?>Semantic-UI-CSS-master/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>Semantic-UI-CSS-master/semantic.min.js"></script>
    
    <!-- <style>
      input[type=text]{
       text-transform: capitalize;
      }
    </style> -->
    <script>
    
		</script>
  </head>
  <body>
    
    <div class="ui massive inverted menu">
      <a class="ui item" href = "<?php echo base_url().'user/task'; ?>"><i class="home icon"></i>Home</a>
      <div class="right menu">
        <a class="ui item" href = "<?php echo base_url().'user/logout'; ?>"><i class="user times icon"></i>Logout</a>
      </div>
    </div><br>
    <div class="ui two column stackable center aligned page grid">
    <div class="ui attached message">
      <div class="header">
        Welcome Again <?php echo $name;?>!
      </div>
      <p>Fill out the location below to fill the form to add a new IR</p>
    </div>
    <form class="ui form attached fluid segment" method="post" action ='<?php echo base_url()."user/add_ir";?>' autocomplete="off" enctype="multipart/form-data">
    <div class="two fields">
      <div class="field">
        <label>Location</label>
        <select class="ui fluid search selection dropdown" id="location" name = "location">
          <option value="All">Select City</option>
          <?php foreach ($city as $key => $c_name) { ?>
           <option value="<?php echo $c_name['city']; ?>"><?php echo $c_name['city']; ?></option>
          <?php } ?>          
        </select>
      </div>
      <div class="field" id="area">
        <label>Area</label>
          <input type="text" name="area" id="sublocation">
        </div>
    </div><br>

      <div class="form_fill">
        <h3 class="ui header" style="text-align: center;"><u>INSTALLATION REPORT FORM</u></h3><br>
        <div class="three fields">
          <div class="field">
            <label>PO#</label>
            <input type="text" value ="IG232071" name ="po" readonly> 
          </div>
          <div class="field">
            <label>PO Date</label>
            <input type="date" name="t_date" value ="2019-06-20" readonly >
          </div>
          <div class="field">
            <label>Client</label>
            <input type="text" value ="IBM India Pvt Ltd" name ="c_name" readonly>
          </div>
        </div>
        <div class="three fields">
          <div class="field">
            <label>IR Prepared By</label>
            <select class="ui fluid search selection dropdown" id="ir_by" name = "ir_by" required="required">
              <option value="">Select Name</option>
              <?php foreach ($site_engineer as $key => $e_name) { ?>
                <option value="<?php echo $e_name['full_name']; ?>"><?php echo $e_name['full_name']; ?></option>
              <?php } ?>          
            </select>
          </div>
          <div class="field">
            <label>Client Site Project Manager</label>
            <input type="text" name ="c_manager" placeholder="Enter the name" required="required">
          </div>
          <div class="field">
            <label>Eurus Project Manager</label>
            <input type="text" value ="Vikas Kumar" name ="e_manager" readonly>
          </div>
        </div>
        <div class="two fields">
          <!-- <div class="field">
            <label>Client Contact Email</label>
            <input type="email" value="zaakhtar@in.ibm.com" name ="c_email"  readonly>
          </div> -->
          <div class="field">
            <label>Project Name</label>
            <input type="text" value ="Navy NFS Network Implementation - West India" name="p_name" readonly>
          </div>
          <div class="field">
            <label>Site Address</label>
            <input type="text" id="site_add" name ="site_add" readonly>
          </div>
        </div>
        <div class="three fields">
          <!-- <div class="field">
            <label>Site Address</label>
            <input type="text" id="site_add" name ="site_add" readonly>
          </div> -->
          <div class="field">
            <label>Eurus Site Engineer</label>
            <select class="ui fluid dropdown" multiple="" id="e_engnr" name = "e_engnr[]" required="required">
              <option value="">Select Name</option>
              <?php foreach ($site_engineer as $key => $e_name) { ?>
                <option value="<?php echo $e_name['full_name']; ?>"><?php echo $e_name['full_name']; ?></option>
              <?php } ?>          
            </select>
          </div>
          <div class="field">
            <label>Installation Report #</label>
            <input type="text" value = "<?php echo 'Navy - 00'.($last_id['id'] + 1);?>" name ="install_report" readonly>
          </div>
          <div class="field">
            <label>Date of Completion</label>
            <input type="date" name ="dt_complt" required="required">
          </div>
        </div>
        <!-- <div class="three fields">
          <div class="field">
            <label>Date of Completion</label>
            <input type="date" name ="dt_complt" required="required">
          </div>
          <div class="field">
            <label>Invoice #</label>
            <input type="text" name ="invoice">
          </div>
        </div> -->
        <h4 class="ui dividing header">Machine Details</h4>
        <!-- <div id="mchn_det"> -->
        <div class="fields">
          <div class="one wide field">
            <label>S. No.</label>
            <input type="text" name="s_no[]" value ="1" class="s_no" readonly="readonly"> 
          </div>
          <div class="five wide field">
            <label>Equipment Model</label>
            <select class="ui fluid search selection dropdown equip" name = "equip[]" onChange="sel(this);" required="required">
            <!-- <select class="ui fluid dropdown equip" name = "equip[]"  required="required"> -->
              <option value="">Select model</option>
              <?php foreach ($equi_model as $key => $m_name) { ?>
              <option value="<?php echo $m_name['model']; ?>"><?php echo $m_name['model']; ?></option>
              <?php } // $key = $m_name['id']; $value=$m_name['model']; 
              // $arr[$key] = $value; } /*echo json_encode($arr);*/  ?>
              <option value="other">Other</option>          
            </select>
          </div>
          <div class="four wide field other">
            <label>Model Description</label>
            <input type="text" name = "other[1][]" id ="other" placeholder="Write the model">
          </div>
          <div class="two wide field">
            <label>Rack</label>
            <select class="ui fluid dropdown" name = "rack[]" required="required">
              <option value="">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
          <div class="four wide field">
            <label>Diagram Ref</label>
            <input type="file" name ="dgm_ref[1][]">
          </div>
          <div class="four wide field">
            <label>Date</label>
            <input type="date" name = "todate[]" required="required">
          </div>
          <!-- <div class="field"></div> -->
        </div>
        <!-- </div> -->
        <!--div class="four fields" id="mchn_det"></div-->  
        <h4 class="ui dividing header service">I & C Services Provided by Eurus</h4>
        <div id="mchn_det">
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
                <tr class="tr1">
                  <!-- <td>BOQ Verification <input type="hidden" name ="tr_services[]" value ="BOQ Verification"></td> -->
                  <td>
                    <select class="ui fluid search selection dropdown" name = "tr_services[1][]" required="required">
                      <option value="">Select Service</option>
                      <option value="BOQ Verification">BOQ Verification</option>
                      <option value="Physical Installation">Physical Installation</option>
                      <option value="Installation of intra/inter rack optical/data cables">Installation of intra/inter rack optical/data cables</option>
                      <option value="Labelling of data/optical cables">Labelling of data/optical cables</option>
                      <option value="Power up and POST">Power up and POST</option>
                      <option value="Basic configuration as per provided templates">Basic configuration as per provided templates</option>
                      <option value="Acceptance Testing">Acceptance Testing</option>
                      <option value="Internal Power Cabling">Internal Power Cabling</option>
                      <option value="Other">Other</option>
                    </select>
                  </td>
                  <td><input type="date" name ="tr_date[1][]" required="required"></td>
                   <td><input type="date" name ="tr_cdate[1][]" required="required"></td>
                  <td> <button class="ui inverted red button removeoption"><i class="close icon"></i>Remove</button></td>
                </tr>
                <!-- <tr id="tr2">
                  <td>Physical Installation <input type="hidden" name ="tr_services[]" value ="Physical Installation"> </td>
                  <td><input type="date" name ="tr_date[]" required="required"></td>
                   <td><input type="date" name ="tr_cdate[]" required="required"></td>
                  <td> <button class="ui inverted red button removeoption"><i class="close icon"></i>Remove</button></td>
                </tr>
                <tr id="tr3">
                  <td>Installation of intra/inter rack optical/data cables <input type="hidden" name ="tr_services[]" value ="Installation of intra/inter rack optical/data cables"></td>
                  <td><input type="date" name ="tr_date[]" required="required"></td>
                   <td><input type="date" name ="tr_cdate[]" required="required"></td>
                  <td> <button class="ui inverted red button removeoption"><i class="close icon"></i>Remove</button></td>
                </tr>
                <tr id="tr4">
                  <td>Labelling of data/optical cables <input type="hidden" name ="tr_services[]" value ="Labelling of data/optical cables"> </td>
                  <td><input type="date" name ="tr_date[]" required="required"></td>
                   <td><input type="date" name ="tr_cdate[]" required="required"></td>
                  <td> <button class="ui inverted red button removeoption"><i class="close icon"></i>Remove</button></td>
                </tr>
                <tr id="tr5">
                  <td>Power up and POST <input type="hidden" name ="tr_services[]" value ="Power up and POST"></td>
                  <td><input type="date" name ="tr_date[]" required="required"></td>
                   <td><input type="date" name ="tr_cdate[]" required="required"></td>
                  <td> <button class="ui inverted red button removeoption"><i class="close icon"></i>Remove</button></td>
                </tr>
                <tr id="tr6">
                  <td>Basic configuration as per provided templates <input type="hidden" name ="tr_services[]" value ="Basic configuration as per provided templates"></td>
                  <td><input type="date" name ="tr_date[]" required="required"></td>
                   <td><input type="date" name ="tr_cdate[]" required="required"></td>
                  <td> <button class="ui inverted red button removeoption"><i class="close icon"></i>Remove</button></td>
                </tr>
                <tr id="tr7">
                  <td>Acceptance Testing <input type="hidden" name ="tr_services[]" value ="Acceptance Testing"></td>
                  <td><input type="date" name ="tr_date[]" required="required"></td>
                   <td><input type="date" name ="tr_cdate[]" required="required"></td>
                  <td> <button class="ui inverted red button removeoption"><i class="close icon"></i>Remove</button></td>
                </tr> -->
              </tbody>
            </table>
            <button class="ui primary right floated button add_services" type="button" onclick="clk1(1,this);"><i class="plus icon"></i>Add more services</button><br><br>
          </div><br>
        <div class="three fields">
          <button class="ui primary left floated button add_more" type="button"><i class="plus icon"></i>Add more</button>
        </div>
        <h4 class="ui dividing header">Remarks by Site Engineer</h4>
        <textarea class="form-control" name="remarks" rows="1" required="required"></textarea><br>
        <!-- <h4 class="ui dividing header">Signatures</h4>
        <div class=" two fields">
          <div class=" field">
           <table class="ui small celled table">
            <thead>
            <tr>
              <th colspan="4">For Eurus Internetworks Private Limited</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="4">Site Engineer : <?php echo $name; ?></td>
            </tr>
            <tr>
              <td>Sign</td>
              <td style="border-left: 0px solid rgba(34,36,38,.1);"><input type="text" name="s_date"></td>
              <td>Date</td>
              <td style="border-left: 0px solid rgba(34,36,38,.1);"><input type="date" name="s_date"></td>
            </tr>
            <tr>
              <td colspan="4">Project Engineer : Vikas Kumar</td>
            </tr>
            <tr>
              <td>Sign</td>
              <td style="border-left: 0px solid rgba(34,36,38,.1);"><input type="text" name="s_date"></td>
              <td>Date</td>
              <td style="border-left: 0px solid rgba(34,36,38,.1);"><input type="date" name="s_date"></td>
            </tr>
           </table>
          </div>
            <div class="field">
              <table class="ui small celled table">
                <thead>
                  <tr>
                    <th colspan="2">For IBM India Pvt Ltd</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Sign</td>
                    <td>Date </td>
                  </tr>
                  <tr><td colspan="2">Name</td></tr>
                </tbody>
              </table>
            </div>
        </div> -->

        <div><br>
         <button class= "ui primary floated button" style="margin-left: 50%;" type="submit" value="submit" name="form_submit"> Submit </button></div>
      </div>

    </form>
  </div>

    <script type="text/javascript">

      $('.ui.basic.modal')
         .modal('setting', 'closable', false)
        .modal('show')
        ;
      $(document).ready(function() { 
        $("#area").hide();
        $(".form_fill").hide();
        $('#location').on('change', function() {
          $("#area").show();
        });
        $('#area').on('keyup', function() {
          $(".form_fill").show();
          $('#site_add').val($('#sublocation').val());
        });

        $('#e_engnr').on('change', function() {
          var ename = $('#e_engnr').val();
          $('.tr_engineer').click(function(){
            $(this).val(ename);
          });
        });

        // $(".myTable").hide();
        // $(".service").hide();
        // $('#s_no').on('change', function() {
        //   $(".service").show();
        //   $(".myTable").show();
        // });
        // other

        // $('#tr_engineer').on('change', function() {
          // $('#tr_engineer').val($('#e_engnr').val());
        // });

      //     $(".equip").on('change', function() {
      //       //alert("Ujjwal");
      //       var id =  $(this).val();
  		  //  alert(id);
      //       console.log(id);
  		  // console.log(model);
      //        //$("#model").val("123");
  			 // if (id in model)
  			 // {
  			 //   $("#e_model").val(model[id]);
  			 // }
      //     });
        $(".add_more").click(function () {
          var num = $('.s_no').length;
          var s_no = num + 1;
          // // var num = $('div').find('.s_no').length;
          // alert(s_no);
          //$("#mchn_det").append('<div><input type="text" name="s_no[]">  <a href="#" class="removeclass">Remove</a></div>');
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

        // $(".add_services").click(function () { 
        //   $("table tbody").append('<tr class="tr1"><td><select class="ui fluid search selection dropdown" name = "tr_services[][]"><option value="">Select Service</option><option value="BOQ Verification">BOQ Verification</option><option value="Physical Installation">Physical Installation</option><option value="Installation of intra/inter rack optical/data cables">Installation of intra/inter rack optical/data cables</option><option value="Labelling of data/optical cables">Labelling of data/optical cables</option><option value="Power up and POST">Power up and POST</option><option value="Basic configuration as per provided templates">Basic configuration as per provided templates</option><option value="Acceptance Testing">Acceptance Testing</option></select></td><td><input type="date" name ="tr_date[]" required="required"></td><td><input type="date" name ="tr_cdate[]" required="required"></td><td> <button class="ui inverted red button removeoption"><i class="close icon"></i>Remove</button></td></tr>');
        //   $('.ui.dropdown')
        //   .dropdown();
        // });

        $(".other").hide();
        $("body").on("click",".removeclass", function(){ 
        $(this).parent().parent().remove();
        $('.s_no').each(function(index) {
              $(this).val(index+1); 
            });
        });

        $("body").on("click",".removeoption", function(){ 
          $(this).parent().parent().remove();
          // $('.myTable td:first-child').each(function(index) {
          //   $(this).text(index+1);
          // }); 
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
            // console.log($(obj).parent().parent().find(".myTable tbody").html());
              $(obj).prev().append('<tr class="tr1"><td><select class="ui fluid search selection dropdown" name = "tr_services['+ no +'][]" required><option value="">Select Service</option><option value="BOQ Verification">BOQ Verification</option><option value="Physical Installation">Physical Installation</option><option value="Installation of intra/inter rack optical/data cables">Installation of intra/inter rack optical/data cables</option><option value="Labelling of data/optical cables">Labelling of data/optical cables</option><option value="Power up and POST">Power up and POST</option><option value="Basic configuration as per provided templates">Basic configuration as per provided templates</option><option value="Acceptance Testing">Acceptance Testing</option><option value="Internal Power Cabling">Internal Power Cabling</option><option value="Other">Other</option></select></td><td><input type="date" name ="tr_date['+ no +'][]" required="required"></td><td><input type="date" name ="tr_cdate['+ no +'][]" required="required"></td><td> <button class="ui inverted red button removeoption"><i class="close icon"></i>Remove</button></td></tr>');
               $('.ui.dropdown')
               .dropdown();
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