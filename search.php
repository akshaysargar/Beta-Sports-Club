<?php


session_start();

$error = "";

if (array_key_exists("submit", $_POST)) 
{
            $link = mysqli_connect("127.0.0.1" ,"root","root","users");

            if (mysqli_connect_error()) 
            {
                die("database connection failed");
            }

        
        if (!$_POST['id']) 
        {    
            $error .= "Unique Id is not entered<br>";   
        } 
        


        else
        {  
            $str = $_POST['id'];

            preg_match("/(\\d+)([a-zA-Z]+)/", $str, $matches);

            $number = $matches[1];
            $character = $matches[2];

            
                        
            $query = "SELECT * FROM `users` WHERE id = '".mysqli_real_escape_string($link,$number)."'";

            $result = mysqli_query($link,$query);

            /*if (!$result) {
            printf("Error: %s\n", mysqli_error($link));
            exit();
            }*/

            $row = mysqli_fetch_array($result);
                
                    if (isset($row)) 
                    {
                                                
                        if ($number == $row['id']) 
                        {
                            if ($character == 'A' && $row['schoolname'] === "MIT School") 
                            {
                                $_SESSION['id'] = $row['id'];
                                header("Location: loggedinpage.php");
                            }

                            elseif ($character == 'B' && $row['schoolname'] !== "MIT School") 
                            {
                                $_SESSION['id'] = $row['id'];
                                header("Location: loggedinpage.php");
                            }
                            else
                            {
                                $error = "Entered Id is not valid <br> Please enter correct ID";
                            }
                           
                                
                        }
                        else 
                        {
                            
                          $error = "Valid unique id is reqiured";
                            
                        }

                    }
                    else
                    {
                      $error = "Valid Unique Id is reqiured";
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
            background: url(images/search.jpg) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            font-size: 21px;
            font-family: 'Arvo', serif;

        }

        #searchContainer
        {
            padding: 30px;
            background: rgba(243,242,240,0.5);
            margin-top: 130px;   
            height: 250px;
            border-radius: 10px;
            -webkit-box-shadow: 2px 1px 35px 8px rgba(62,179,173,1);
            -moz-box-shadow: 2px 1px 35px 8px rgba(62,179,173,1);
            box-shadow: 2px 1px 35px 8px rgba(62,179,173,1);
        }
        #error
        {
            margin: 0 auto;
            text-align: center;
        }
        #info
        {
            text-align: center;
            font-size: 15px;
            color:tomato;
        }
        #submit1
        {
            margin-left: 25px;
        }




    </style>

  </head>
  
  <body>

  <div id="error" class="col-sm-12">
      
      <?php if ($error!="") 
        {
          echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
        } 
      ?>
      
    </div>

    <form method="post" id="searchForm" >

        <div class="container-fluid col-md-6 col-md-offset-3" id="searchContainer" >

            <div class="form-group row">

                <p class="container col-md-12 col-md-offset-3 h4">Enter your Unique Id</p>

            </div>

                <div class="form-group row">

                    <div class="col-md-6 col-md-offset-3" id="input">
                    
                        <input type="text" class="form-control" name="id" placeholder="Unique Id">
      
                    </div>

                </div>

                <div class="form-group row">
            
                    <div class="col-md-12 col-md-offset-4">
                        
                        <input type="submit" id = "submit1"class="btn btn-success btn-lg" value="Submit" name="submit">
                    
                    </div>
        
                </div>

                <div class="form-group row">

                    <div class="col-md-12 ">

                        <p id="info">Contact on the number given on the website footer asap to get your ID.<br>An ID is sent to you by email after you contact your coach.</p>

                    </div>

                </div>

        </div><!--End signupcontainer -->

    </form>



  <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
  

  </body>

</html>