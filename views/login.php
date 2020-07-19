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
    <style>
      body {
        background-color: #ECF0F1;
      }
      .page-login {
      margin-top: 100px;
      }
    </style>
  </head>
  <body>
    <div class="page-login">
      <div class="ui centered grid container">
        <div class="nine wide column">
          <h2 class="ui center aligned icon header">
            <i class="circular user icon"></i>
            Log-in to your account
          </h2>
          <div class="ui fluid card">
            <div class="content">
              <form class="ui form" method="POST" action='<?php echo base_url()."auth/login";?>'>
                <div class="field">
                  <label>User</label>
                  <input type="text" name="user" placeholder="User ID">
                </div>
                <div class="field">
                  <label>Password</label>
                  <input type="password" name="pass" placeholder="Password">
                </div>
                <button class="ui primary labeled icon button" type="submit">
                  <i class="unlock alternate icon"></i>
                   Login
                </button>
                 <div class="ui error message"></div>
              </form>
              <?php if(isset($error) && !empty($error)) { ?>
                <div class="ui negative message">
                  <i class="close icon"></i>
                  <div class="header"> We're sorry we can't log you in to the account</div>
                  <?php if($error[0] == "Incorrect password entered") { ?><p>Incorrect Password Entered</p><?php } else { ?><p>No such user Exist.</p><?php } ?>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script>
     $(document).ready(function() {
      $('.ui.form')
        .form({
          fields: {
            user: {
              identifier  : 'user',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your user id'
                }
              ]
            },
            pass: {
              identifier  : 'pass',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your password'
                }
              ]
            }
          }
        })
      ;
    });
</script>
  </body>
</html>