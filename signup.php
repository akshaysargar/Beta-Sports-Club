<?php

include("age.php");

session_start();

$error = "";
$success = "";
$emailval="";
$mob="";
if (array_key_exists("submit", $_POST)) 
{
   $link = mysqli_connect("127.0.0.1" ,"root","root","users");

            if (mysqli_connect_error()) 
            {
                die("database connection failed");
            }

         

        $emailval = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
        $mob="/^[0-9]{10}$/"; 

        if (!$_FILES['uploadedimage']['name']) 
        {
          $error .= "Please upload your photo<br>";
        }
        if (!$_POST['name']) 
        {
          $error .= "Name field is empty<br>";
        }
        if (!$_POST['address1'])
        {
          $error .= "Address1 field is empty<br>";
        }
        if (!$_POST['address2'])
        {
          $error .= "Address2 field is empty<br>";
        }
        if (!$_POST['birthdate']) 
        {
          $error .= "Enter correct birthdate<br>";
        }
        
        if (!$_POST['schooltime']) 
        {
         $error .= "Enter your school timings<br>";
        }
        if (!$_POST['trainingcenter']) 
        {
         $error .= "Enter Training Center<br>";
        }
        if (!$_POST['timings']) 
        {
         $error .= "Select your batch timimgs<br>";
        }
        if (!$_POST['phone']) 
        {
          $error .="Enter your mobile number<br>";
        }
        if (!$_POST['email']) 
        {    
            $error .= "An email address is required<br>";   
        } 
        if (!$_POST['password']) 
        {    
            $error .= "A password is required<br>";   
        } 

        if (!preg_match($emailval, $_POST['email'])) 
        {
          $error .=  "Enter a valid email ID<br>";
        }

        if (!preg_match($mob, $_POST['phone'])) 
        {
          $error .=  "Enter a valid mobile number<br>";
        }

        if ($error != "") 
        {   
            $error = "<p>There were error(s) in your form:</p>".$error;  
        }

        else
        {  

         
         
            $query = "SELECT id FROM `users` WHERE email ='".mysqli_real_escape_string($link , $_POST['email'])."' LIMIT 1";

            $result = mysqli_query($link,$query);

              if (mysqli_num_rows($result)>0) 
              {
                    $error = "That email address is already taken.";
              }

              else
              {
                function GetImageExtension($imagetype)
                 {
                   if(empty($imagetype)) return false;
                   switch($imagetype)
                   {
                       case 'image/bmp': return '.bmp';
                       case 'image/gif': return '.gif';
                       case 'image/jpeg': return '.jpg';
                       case 'image/png': return '.png';
                       default: return false;
                   }
                 } 

                $file_name=$_FILES["uploadedimage"]["name"];
                $temp_name=$_FILES["uploadedimage"]["tmp_name"];
                $imgtype=$_FILES["uploadedimage"]["type"];
                $ext= GetImageExtension($imgtype);
                $imagename=$_POST['name'].$ext;
                $target_path = "img/".$imagename;
                move_uploaded_file($temp_name, $target_path);

                


                $query = "INSERT INTO `users` (`name` ,`address1`,`address2` , `birthdate` ,`age` , `schoolname` ,`schooltime`,   `phone`,`trainingcenter`,`timings`,`email` ,`password`,`image_path`)

                          VALUES (  
                                   '".mysqli_real_escape_string($link, $_POST['name'])."' ,
                                   '".mysqli_real_escape_string($link, $_POST['address1'])."' ,
                                   '".mysqli_real_escape_string($link, $_POST['address2'])."' ,
                                   '".mysqli_real_escape_string($link, $_POST['birthdate'])."' ,
                                   '".mysqli_real_escape_string($link, $_POST['age'])."' ,
                                   '".mysqli_real_escape_string($link, $_POST['schoolname']).mysqli_real_escape_string($link, $_POST['options'])."' ,
                                   '".mysqli_real_escape_string($link, $_POST['schooltime'])."' ,                               
                                   '".mysqli_real_escape_string($link, $_POST['phone'])."' ,
                                   '".mysqli_real_escape_string($link, $_POST['trainingcenter'])."' ,
                                   '".mysqli_real_escape_string($link, $_POST['timings'])."' ,
                                   '".mysqli_real_escape_string($link, $_POST['email'])."' ,
                                   '".mysqli_real_escape_string($link, $_POST['password'])."' ,
                                   '".mysqli_real_escape_string($link, $target_path)."')";

                    
                                  
                      if (!mysqli_query($link , $query)) 
                      {
                          $error = "<p>Could not sign up</p>";
                      }



                  else
                  {
                       //$query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";

                       //mysqli_query($link, $query);

                     


                      require 'PHPMailer/PHPMailerAutoload.php';

                      $mail = new PHPMailer;

                      //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                      $mail->isSMTP();                                      // Set mailer to use SMTP
                      $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                      $mail->SMTPAuth = true;                               // Enable SMTP authentication
                      $mail->Username = 'akshaysargar789@gmail.com';                 // SMTP username
                      $mail->Password = 'fcchelsea10';                           // SMTP password
                      $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                      $mail->Port = 587;                                    // TCP port to connect to

                      $mail->setFrom('akshaysargar789@gmail.com');
                      $mail->addAddress($_POST['email'], $_POST['name']);     // Add a recipient
                      //$mail->addAddress('ellen@example.com');               // Name is optional
                      $mail->addReplyTo('akshaysargar789@gmail.com', 'Information');
                      //$mail->addCC('cc@example.com');
                      //$mail->addBCC('bcc@example.com');

                      //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                      $mail->isHTML(true);
                                                        // Set email format to HTML
                      if ($_POST['schoolname'] === "MIT School") 
                      {
                        
                        $message  = "<html><body>";
   
                        $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
                       
                        $message .= "<tr><td>";
                       
                        $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
                        
                        $message .= "<thead>
                          <tr height='80'>
                           <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 2px #00a2d1; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >Beta Sports Club</th>
                           
                          </tr>
                          </thead>";
                        
                        $message .= "<tbody>
                          
                          
                          <tr align='center' >
                           <td colspan='4' style='padding:15px;'>
      
                            <p style='font-size:25px; text-align:center;'>Congrats ".$_POST['name']."</p>
                            <p style='font-size:20px;text-align:center;'>You are now a Beta Sports Club PLayer </p>
                            
                            <hr />
                            
                            <p style='font-size:23px; text-align:center;'>Your Unique ID :".mysqli_insert_id($link)."A </p>
                            <p style='font-color:#00a2d1; font-size:18px; text-align:center;'><a href='https://www.betasportsclub.com/' style='text-decoration:none;' target='_blank'>Make Payment</a></p>
                           </td>
                          </tr>
                          
                          <tr height='80'>
                           <td colspan='4' align='center' style='background-color:#f5f5f5; border-top:solid #00a2d1 2px; font-size:24px; '>
                           <label>
                           Beta Sports Club On : 
                           <a href='https://www.facebook.com/betasportsclub/' target='_blank'><img style='vertical-align:middle' src='https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-facebook-m.png' /></a>
                           <a href='https://twitter.com/BetaFC_Pune' target='_blank'><img style='vertical-align:middle' src='https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-twitter-m.png' /></a>
                           <a href='https://plus.google.com/u/0/101752366025782950515/posts' target='_blank'><img style='vertical-align:middle' src='https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-googleplus-m.png' /></a>
                    
                           </label>
                           </td>
                          </tr>
                          
                          </tbody>";
                        
                        $message .= "</table>";
                       
                        $message .= "</td></tr>";
                        $message .= "</table>";
                       
                        $message .= "</body></html>";

                      $mail->Subject = 'Unique Id';
                      $mail->Body    = 'Hello, you are now ready to get your membership of Beta Sports Club and enjoy its facilities'.$message ;
                      }
                      else
                      {
                        $message  = "<html><body>";
   
                        $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
                       
                        $message .= "<tr><td>";
                       
                        $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
                        
                        $message .= "<thead>
                          <tr height='80'>
                           <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 2px #00a2d1; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >Beta Sports Club</th>
                           
                          </tr>
                          </thead>";
                        
                        $message .= "<tbody>
                          
                          
                          <tr align='center' >
                           <td colspan='4' style='padding:15px;'>
      
                            <p style='font-size:25px; text-align:center;'>Congrats ".$_POST['name']."</p>
                            <p style='font-size:20px;text-align:center;'>You are now a Beta Sports Club PLayer </p>
                            
                            <hr />
                            
                            <p style='font-size:23px; text-align:center;'>Your Unique ID :".mysqli_insert_id($link)."B </p>
                            <p style='font-color:#00a2d1; font-size:18px; text-align:center;'><a href='https://www.betasportsclub.com/' target='_blank' style='text-decoration:none;'>Make Payment</a></p>
                           </td>
                          </tr>
                          
                          <tr height='80'>
                           <td colspan='4' align='center' style='background-color:#f5f5f5; border-top:solid #00a2d1 2px; font-size:24px; '>
                           <label>
                           Beta Sports Club On : 
                           <a href='https://www.facebook.com/betasportsclub/' target='_blank'><img style='vertical-align:middle' src='https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-facebook-m.png' /></a>
                           <a href='https://twitter.com/BetaFC_Pune' target='_blank'><img style='vertical-align:middle' src='https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-twitter-m.png' /></a>
                           <a href='https://plus.google.com/u/0/101752366025782950515/posts' target='_blank'><img style='vertical-align:middle' src='https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-googleplus-m.png' /></a>
                    
                           </label>
                           </td>
                          </tr>
                          
                          </tbody>";
                        
                        $message .= "</table>";
                       
                        $message .= "</td></tr>";
                        $message .= "</table>";
                       
                        $message .= "</body></html>";

                        $mail->Subject = 'Unique Id';
                        $mail->Body    = 'Hello, you are now ready to get your membership of Beta Sports Club and enjoy its facilities'.$message ;
                      }

                      if(!$mail->send()) 
                      {
                          $error = 'Message could not be sent.';
                          $error = 'Mailer Error: ' . $mail->ErrorInfo;
                      } 
                      else 
                      {
                          $success = 'Message has been sent';
                      }

                       
                  }


              }

        }

         
            
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    <style type="text/css">
     
    body
    {
      background: none;
      color: white;
      font-size: 22px;
      font-family: 'Arvo', serif;
       background: url(field.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
    }   
    h1
    {
      font-size: 80px;
      font-family: 'Great Vibes', cursive;;
      text-align: center;
      letter-spacing: 7px;
      color: #A2EE4E;
      font-weight: bold;
      
      margin-top:40px; 
    }
    #address
    {
      height: 50px; 
    }
    .fa 
    {
    float: right;
    margin-right: 6px;
    margin-top: -29px;
    color: black;
    }
    .fa-calendar
    {
      float: right;
      margin-right: 1px;
      margin-top: -5px;
      font-size: 20px;
      color: black;
    }
    html 
    { 
      background: url(field.jpg) no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }   
    #signupContainer
    {
      padding: 30px;
      background: rgba(70,65,65,0.5);
      width: 900px;
      height: 1600px;
      border-radius: 10px;
    }
    a
    {
      color: #A2EE4E;
    }
    a:hover
    {
      text-decoration: none;
      color: #1AB188;
      cursor: pointer;
    }
    #error
    {
      font-size: 15px;
    }
    p
      {
        text-align: center;
        display: flex;
        flex-direction: row;
        justify-content: center;
      }

      p:before, p:after 
      {
        flex-grow: 1;
        height: 2px;
        content: '\a0';
        background-color: white;
        position: relative;
        top: 0.7em;
      }

      p:before 
      {
        margin-right:10px;
      }

      p:after 
      {
        margin-left:10px;
      }
      .c-radio
      {
        color: white;
      }
      #bavdhantimings
      {
        display: none;
      }
      #kothrudtimings
      {
        display: none;
      }
      #others
      {
        display:none;
      }
      #image
      {
        border:2px solid white;
        border-radius: 5px;
      }
      #note
      {
        font-size: 20px;
        color: red;
      }

      
    </style>

  </head>
  
  <body>

    <form method="post" id="signUpForm" enctype="multipart/form-data">
    
    <div class="container-fluid" id="signupContainer">

    
    <h1 class="col-sm-9 col-sm-offset-">Sign Up</h1>

    <div class="col-sm-3">
<div class="fileinput fileinput-new" data-provides="fileinput">
  <div class="fileinput-preview thumbnail " id="image" data-trigger="fileinput" style="width: 200px; height: 130px;"></div>
  <div>
    <span class="btn btn-success btn-file "><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="uploadedimage"></span>
    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
  </div>
</div>
</div>

    <div id="error" class="col-sm-12">
      
      <?php if ($error!="") 
        {
          echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
        } 
      ?>
      
    </div>

    <div id="success" class="col-sm-12">
      
      <?php if ($success!="") 
        {
          echo '<div class="alert alert-success" role="alert">'.$success.'</div>';
        } 
      ?>
      
    </div>




  
    <p class="lead col-sm-12">Personal Details</p>



  
  <div class="form-group row ">
    
    <label  class="col-sm-2 form-control-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" placeholder="Full Name">
      <span class="fa fa-user"></span>
    </div>
</div>

  

   <div class="form-group row ">
    <label class="col-sm-2 form-control-label">Address1</label>
    <div class="col-sm-10">
      <input type="text" id="address1" class="form-control" name="address1" placeholder="Home address">
      <span class="fa fa-map-marker"></span>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 form-control-label">Address2</label>
    <div class="col-sm-10">
      <input type="text" id="address2" class="form-control" name="address2" placeholder="City,Pincode....">
      <span class="fa fa-map-marker"></span>
    </div>
  </div>



  <div class="form-group row">
    <label  class="col-sm-2 form-control-label">Birthdate</label>
      <div class="col-sm-5">
         <div class='input-group date' id='datepicker8'>
        <input type='text' id="birthdate" class="form-control" placeholder="D.O.B" name="birthdate" >
        <span class="input-group-addon">
          <i class="fa fa-calendar" aria-hidden="true"></i>
        </span>
      </div>
    </div>

    <label class="col-sm-1 form-control-label">Age:</label>
    <div class="col-sm-4">
      <input type="text" id="age" class="form-control" name="age" placeholder="Age" readonly="readonly" >
      
    </div>
  </div>

  <div class="form-group row ">
    
    <label class="col-md-2 form-control-label">School <br>Option</label>
    <div class="col-md-3">  
      <select class="form-control c-select" id="schoolis" name="schoolname">
        <option value="" disabled selected>Select school</option>
        <option>MIT School</option>
        <option id="other" value="">Other</option>
      </select>
    </div>

    <div id="others">
      
      <label class="col-md-2 form-control-label">Name:</label>
      <div class="col-md-5">
        <input type="text" id="options" class="form-control" name="options" placeholder="School Name">
        <span class="fa fa-graduation-cap" aria-hidden="true"></span>
      </div>
    
    </div>

  </div>
  
  

 <div class="form-group row ">
    <label class="col-sm-2 form-control-label">School Time</label>
    <div class="col-sm-5">
      <input type="text" id="schooltime" class="form-control" name="schooltime" placeholder="8:00 AM to 1:00 PM ">
      <span class="fa fa-clock-o" aria-hidden="true"></span>

    </div>
  </div>


<p class="lead">Contact Details</p>

  <div class="form-group row">
    <label class="col-sm-2 form-control-label">Phone</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="phone" placeholder="Mobile Number">
      <span class="fa fa-phone"></span>
    </div>
  </div>

<p class="lead">Batch Timings</p>

   <div class="form-group row ">

    <label  class="col-sm-2  form-control-label ">Training Center</label>
    <div class="col-sm-5 ">
      <select class="form-control c-select" id="ground" name="trainingcenter">
        <option value="" disabled selected>Select ground</option>
        <option id="kothrud">Kothrud</option>
        <option id="bavdhan">Bavdhan</option>
      </select>
        
    </div>  


    <div class="c-inputs-stacked col-sm-4 col-sm-offset-1" id="bavdhantimings">
  <label class="c-input c-radio  ">
    <input id="radioStacked1"  name="timings" type="radio" value="3">
    <span class="c-indicator"></span>
    4 - 5:15 pm
  </label>
  <label class="c-input c-radio  ">
    <input id="radioStacked2 "  name="timings" type="radio" value="4">
    <span class="c-indicator"></span>
    5 - 6:30 pm
  </label>
  <label class="c-input c-radio  ">
    <input id="radioStacked2"   name="timings" type="radio" value="5">
    <span class="c-indicator"></span>
    6 - 8:00 pm
  </label>
</div>

<div class="c-inputs-stacked col-sm-4 col-sm-offset-1" id="kothrudtimings">
  <label class="c-input c-radio  ">
    <input id="radioStacked1"  name="timings" type="radio" value="1">
    <span class="c-indicator"></span>
    6 - 7:30 pm
  </label>
  <label class="c-input c-radio  ">
    <input id="radioStacked2 "  name="timings" type="radio" value="2">
    <span class="c-indicator"></span>
    7 - 8:30 pm
  </label>
</div>


</div>

  

  

  <p class="lead">Login Details</p>

  <div class="form-group row">
    <label class="col-sm-2 form-control-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="email" placeholder="Email Address">
      <span class="fa fa-envelope"></span>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 form-control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="password" placeholder="Password">
      <span class="fa fa-key"></span>
    </div>
  </div>

  
  <div class="form-group row">
    <div class="col-sm-offset-5 col-sm-8">
      <input type="submit" id = "submit1"class="btn btn-success btn-lg" value="Sign In" name="submit">
    </div>
    
  </div>

<div class="form-group row">
<span id="note" class="col-sm-9 lead ">Note : All fields are compulsory</span>
  <div class=" col-sm-3">
      <a href = 'index.php'>Back to Log In</a>
    </div>
  </div>



  </div>
</form>

    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>

    <script type="text/javascript">
      

      $(document).ready(function () 
      {
        
          $('#datepicker8').datepicker({
            
          format: 'yyyy-mm-dd',
          
      
          icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
          }
              });  



            $(document).on('change','#birthdate',function()
            {
              $('#datepicker8').datepicker('hide');
              var birthdate1 = $('#birthdate').val();

                 
                 $.ajax({ 
                        
                          url: 'age.php',
                          data:{ 
                                  birthdate:birthdate1,
                                  action: 'birthage'
                              },
                          type: 'post',
                          success: function(data) 
                          {
                          
                            $("#age").val(data);
                          }
                      });
            });

            $(document).on('change','#ground',function()
            {
              if ($(this).val() === "Kothrud") 
              {

                $("#kothrudtimings").show();
                $("#bavdhantimings").hide();
              }
              else
              {
                $("#bavdhantimings").show();
                $("#kothrudtimings").hide();
              }

            });

            $(document).on('change','#schoolis',function()
            {
              if ($("#other").is(':selected'))
              {
                $("#others").show();
              }
              else
              {
                $("#others").hide();
              }  
   
            });


        });
    </script>
  </body>
</html>
          
