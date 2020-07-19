<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html>
  <head>
    <title>Navy</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url();?>Semantic-UI-CSS-master/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url();?>Semantic-UI-CSS-master/semantic.min.js"></script>
  </head>
  <body>
    <div class="ui massive inverted menu">
      <div class="header item">
        <i class="user circle icon"></i>
       Hello <?php echo $name; ?>
      </div>
      <div class="right menu">
        <a class="ui item" href = "<?php echo base_url().'user/logout'; ?>"> Logout</a>
      </div>
    </div>

    <a class="ui right labeled icon button" href = "<?php echo base_url().'user/add_ir'; ?>" style="margin-left: 30px;" data-content="Click to add new IR" data-variation="large">
      <i class="plus icon"></i> Add New IR
    </a>
    <button class="ui right labeled icon button" id="filter_modal" data-content="Click to apply Filter" data-variation="large">
      <i class="filter icon"></i> Apply Filter
    </button>

    <?php if(!empty($start_date) && !empty($start_date) && !empty($form_data)) { ?>
          <div class="ui info message">
            <div class="header" style="text-align: center;">
             This table shows data between data <?php echo $start_date; ?> and <?php echo $end_date; ?>
            </div>
          </div>
    <?php } if(empty($form_data)) { ?>
    <div class="ui negative message">
      <div class="header" style="text-align: center;">
        No data found
      </div>
    </div>

    <?php }if(!empty($form_data)) { ?>

    <table class="ui striped table">
      <thead>
        <tr>
          <th>P No.</th>
          <th>Location</th>
          <th>Sublocation</th>
          <th>IR Date</th>
          <!-- <th>Invoice No</th> -->
          <th>Site Engineer</th>
          <!-- <th>Preview</th> -->
          <th>Action</th>
          <?php if($usr_name == 'tajamul' || $usr_name =='ujjwal') { ?><th>Upload Signed IR</th><?php } ?>
          <?php if($usr_name == 'tajamul' || $usr_name =='priyanka' ||  $usr_name =='vikas' || $usr_name =='dgdg' || $usr_name =='ujjwal' ) { ?><th>Uploaded IR</th><?php } ?>
          <?php if($usr_name == 'priyanka' || $usr_name =='ujjwal') { ?><th>Comment</th><?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($form_data as $key => $value) { ?>
        <tr>
          <td><?php echo $value['id']; ?></td>
          <td><?php echo $value['location']; ?></td>
          <td><?php echo $value['sublocation']; ?></td>
          <td><?php echo $value['completion_date']; ?></td>
          <!-- <td><?php //echo $value['invoice_no']; ?></td> -->
          <td><?php echo $value['eurus_engineer']; ?></td>
          <?php if($usr_name =='priyanka' ||  $usr_name =='vikas' || $usr_name =='dgdg' || $usr_name =='ujjwal' ) { ?><td><span> <a style="color: white;" href="<?php echo base_url().'user/download_file/'.$value['id'] ?>" target="_blank"><i class="file pdf blue icon" data-content="Preview the details in PDF format " data-variation="large inverted"></i></a><a  href="<?php echo base_url().'user/update_ir/'.$value['id'] ?>"><i class="edit blue icon" data-content="Click to Update the details" data-variation="large inverted"></i></a></td><?php } else { ?>
          <td><a  href="<?php echo base_url().'user/update_ir/'.$value['id'] ?>"><i class="edit blue icon" data-content="Click to Previev & Update the details" data-variation="large inverted"></i></a></td><?php } ?>
          <?php if($usr_name == 'tajamul' || $usr_name =='ujjwal') { ?><td style="width: 15%;">
            <form  name = "form" class ="ui form" action = "<?php echo base_url().'user/upload_file/'.$value['id']; ?>" method = "post" enctype="multipart/form-data">
            <input type = "file" name = "userfile" size = "20" id="fUpload"/><button class ="ui button" type = "submit" value = "upload"><i class="upload blue icon"></i>Upload</button>
            </form> 
          </td><?php } ?>
          <?php if($usr_name == 'tajamul' || $usr_name =='priyanka' ||  $usr_name =='vikas' || $usr_name =='dgdg' || $usr_name =='ujjwal' ) {  ?>
          <td> <?php if($value['file_path'] != "") { echo "<a class='ui right labeled icon button' href='".$value['file_path']."' download><i class='download blue icon'></i>Download File</a>"; } else { echo "File not exist"; } ?></td><?php } ?>
          <?php if($usr_name == 'priyanka' || $usr_name =='ujjwal') { ?><td><button class='ui right labeled icon button' onclick="add_comment(<?php echo $value['id']; ?>);">Comment<i class="comment icon"></i></button><?php echo $value['comments']; ?></td><?php } ?>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>

    <div class="ui small modal filter">
      <i class="close icon"></i>
      <div class="ui middle aligned center aligned grid">
        <div class="column">
          <h2 class="ui blue image header">
            <div class="content" style="margin-top: 15px;">
              Choose Filter
            </div>
          </h2>
          <form class="ui form" method="get" action ='<?php echo base_url()."user/task";?>'>
            <div class="ui segment">
              <div class="two fields">
                <div class="field">
                  <label>Start Date</label>
                  <input type="date" name ="s_date" id="start_date">
                </div>
                <div class="field">
                  <label>End Date</label>
                  <input type="date" name ="e_date" id="end_date">
                </div>
              </div>
              <div class="two fields">
                <div class="field">
                   <label>Location</label>
                  <select class="ui fluid dropdown" id="location" name = "location">
                  <option value="">State</option>
                  <?php foreach ($city as $key => $c_name) { ?>
                  <option value="<?php echo $c_name['city']; ?>"><?php echo $c_name['city']; ?></option>
                  <?php } ?>          
                  </select>
                </div>
                <div class="field">
                  <label>Site Engineer</label>
                  <input type="text" name="s_engineer" placeholder="Last Name">
                </div>   
              </div>
            </div>
             <div class="actions">
                <div class="ui black deny button" style="margin-left: 65%" >
                 Cancel
                </div>
                <div style="float: right;">
           
            <button class= "ui positive right labeled icon button" type="submit" id="submit" name="filter" value="filter" style="margin-right: 10px;"> Apply Filter<i class="checkmark icon"></i> </button></div></div>

          </form>
        </div>
      </div>
    </div>

    <div class="ui small modal b_comment">
      <i class="close icon"></i>
      <div class="ui grid">
        <div class="column">
          <form class="ui form" method="post" action ='<?php echo base_url()."user/task";?>'>
            <div class="ui segment">
              <div class="field">
                <label>Comment</label>
                <input type="text" name ="comment" placeholder="write your comment here">
                <input type="hidden" name ="pid" id="c_id" readonly="readonly">
              </div>
              <div class="actions">
                <div class="ui black cancel button" style="margin-left: 63%" >Cancel</div>
                <div style="float: right;">
                  <button class= "ui positive right labeled icon button" type="submit" name="add_comment" value="comment"> Add Comment<i class="checkmark icon"></i> </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
   <script type="text/javascript">

     $(document).ready(function(){
        $('#filter_modal').click(function(){
          $('.ui.modal.filter').modal('show');    
        });

        $('.icon')
          .popup({
            inline: true
          })
        ;

        $("#end_date").on('change', function() {
          var s_date = $("input[name=s_date]").val();
          var e_date = $("input[name=e_date]").val();
          var dateTime1 = new Date(s_date).getTime(),
           dateTime2 = new Date(e_date).getTime();
          var diff = dateTime2 - dateTime1;
          if (diff < 0) {
            alert("EndDate is less than StartDate"); 
            $('#end_date').val('');}
        });
     });
     function add_comment(id){
            // alert(id);
            $("#c_id").val(id);
            $('.ui.modal.b_comment').modal('show');    
      }

    $(function () {
      $('input[type=file]').change(function () {
          var val = $(this).val().toLowerCase(),
              regex = new RegExp("(.*?)\.(pdf)$");

          if (!(regex.test(val))) {
              $(this).val('');
              alert('Please select PDF file');
          }
      });
    });

    </script>
</html>
     
