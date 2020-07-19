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
  	<?php if(isset($success) && !empty($success)) { ?>
			<div class="ui tiny modal file_upload">
				<i class="close icon"></i>
				<div class="header" style=" text-align: center;color: green; font-size: 30px;">
					<i class="thumbs up icon"></i>
					Success !! 
				</div>
				<div class="image content" style="text-align: center;">
					<div class="description">
						<h3 >The file has been uploaded successfully <i class="smile icon"></i></h3>
					</div>
				</div>
				<div class="actions">
					<a class="ui green ok inverted button" href='<?php echo base_url()."user/task";?>'>
						<i class="checkmark icon"></i>
						Ok
					</a>
				</div>
			</div>
		<?php } elseif(isset($error) && !empty($error)) { ?>
			<!-- <div class="ui negative message">
				<i class="close icon"></i>
				<div class="header">
					 Unsuccessful.
				</div>
				<p> We're sorry the fie has not been uploaded.<h3>Try again.</h3>.</p>
			</div> -->
			<div class="ui tiny modal file_upload_failed">
				<i class="close icon"></i>
				<div class="header" style=" text-align: center;color: green; font-size: 30px;">
					<i class="thumbs down icon"></i>
					Unsuccessful !! 
				</div>
				<div class="image content" style="text-align: center;">
					<div class="description">
						<h3 > We're sorry the fie has not been uploaded.<br>Kindly check the file type or size and Try again. <i class="frown icon"></i></h3>
					</div>
				</div>
				<div class="actions">
					<a class="ui green ok inverted button" href='<?php echo base_url()."user/task";?>'>
						<i class="checkmark icon"></i>
						Ok
					</a>
				</div>
			</div>
		<?php } ?>

			<?php if(isset($details) && !empty($details)) {  ?>
			<div class="ui tiny modal data_update">
				<i class="close icon"></i>
				<div class="header" style=" text-align: center;color: green; font-size: 30px;">
					<i class="thumbs up icon"></i>
					Success !! 
				</div>
				<div class="image content" style="text-align: center;">
					<div class="description">
						<h3 >The data has been updated successfully<i class="smile icon"></i></h3>
					</div>
				</div>
				<div class="actions">
					<a class="ui green ok inverted button" href='<?php  echo base_url()."user/task";?>'>
						<i class="checkmark icon"></i>
						Ok
					</a>
				</div>
			</div>
		<?php } ?>
		<?php if((isset($form) && !empty($form))) { 
	    // if($service == "true" && $equipment == "true") { // ?>
		<div class="ui basic modal form_submit">
		  <div class="ui icon header">
		    <i class="thumbs up outline icon"></i>
		      Success
		  </div>
		  <div class="content">
		    <h2 style="text-align: center;">You have submitted the form successfully.</h2>
		  </div>
		  <div class="actions">
		    <div class="ui green ok button">
		      <a style="color: green;" href='<?php  echo base_url()."user/task";?>'><i class="checkmark icon"></i>
		      <strong>OK</strong></a>
		    </div>
		  </div>
		</div>
	<?php  } ?>

		<script type="text/javascript">
			$('.file_upload')
		.modal({
			blurring: true,
			onHide    : function(){
			 window.location.href='<?php echo base_url()."user/task";?>';
			},
		})
		.modal('show')
		;

		$('.message .close')
		.on('click', function() {
			$(this)
			.closest('.message')
			.transition('fade')
		;
		})
		;

		$('.data_update')
		.modal({
			blurring: true,
			onHide    : function(){
			 window.location.href='<?php echo base_url()."user/task";?>';
			},
		})
		.modal('show')
		;

		$('.message .close')
		.on('click', function() {
			$(this)
			.closest('.message')
			.transition('fade')
		;
		})
		;

		$('.form_submit')
		.modal({
			blurring: true,
			onHide    : function(){
			 window.location.href='<?php echo base_url()."user/task";?>';
			},
		})
		.modal('show')
		;

		$('.message .close')
		.on('click', function() {
			$(this)
			.closest('.message')
			.transition('fade')
		;
		})
		;

		$('.file_upload_failed')
		.modal({
			blurring: true,
			onHide    : function(){
			 window.location.href='<?php echo base_url()."user/task";?>';
			},
		})
		.modal('show')
		;

		</script>
  </body>
</html>