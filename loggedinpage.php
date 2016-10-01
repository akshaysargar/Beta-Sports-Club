<?php

session_start();

if (array_key_exists("id", $_SESSION)) 
{
  

    $link = mysqli_connect("127.0.0.1" ,"root","root","users");

      if (mysqli_connect_error()) 
      {
          die("database connection failed");
      }

    $query = "SELECT * FROM `users` WHERE id = ".mysqli_real_escape_string($link,$_SESSION['id'])."  LIMIT 1";

    $row = mysqli_fetch_array(mysqli_query($link , $query));

    
}

else
{
  header("Location:search.php");
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

    <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Neuton" rel="stylesheet">

  

    <style type="text/css">

        body
        {             
            font-size: 21px;
            font-family: 'Neuton', serif;
            background: #FF5F6D; 
            background: -webkit-linear-gradient(to left, #FF5F6D , #FFC371); 
            background: linear-gradient(to left, #FF5F6D , #FFC371);       
        }
        
        #infoContainer
        {
            padding: 30px;
            background: rgba(243,242,240,0.5);
            margin-top: 50px; 
            margin-bottom: 50px;  
            height: auto;
            border:2px solid #D40472;
            border-radius: 10px;
            -webkit-box-shadow: 2px 1px 22px 3px rgba(212,4,114,1);
            -moz-box-shadow: 2px 1px 22px 3px rgba(212,4,114,1);
            box-shadow: 2px 1px 22px 3px rgba(212,4,114,1);
        }

        label
        { 
          font-size: 20px;
          color: #D40472;
          font-family: 'Karla', sans-serif;
        }

        .heading
        {
          font-size: 25px;
          color:#D40472;
          text-align: center;
        }
        
        .heading
        {
          text-align: center;
          display: flex;
          flex-direction: row;
          justify-content: center;
          font-family: 'Fira Sans', sans-serif;
        }

        .heading:before, .heading:after 
        {
          flex-grow: 1;
          height: 1px;
          content: '\a0';
          background-color: #D40472;
          position: relative;
          top: 0.7em;
        }

        .heading:before 
        {
          margin-right:10px;
        }

        .heading:after 
        {
          margin-left:10px;
        }
        
        
        #half
        {
          border-right: 1px solid #D40472;
        }

        img
        {
          height: 180px;
          width:280px;
          border:1px solid black;
          border-radius: 10px;
          margin-left: 110px;
        }
        #mainHeading
        {
            margin: 0 auto;
            text-align: center;
            font-size: 28px;
            border:2px solid #DFF0D8;
        }
        span
        {
          margin-left: 100px;
        }
        h1
        {
          margin-top: 23px;
          text-align: center;
        }
        a
        {
          float: right;
        }

    </style>

  </head>
  
  <body>

   
      <div id="mainHeading" class="alert alert-success" role="alert"><span>PAYMENT PORTAL</span>
      <a href="index.html"><button type="button" class="btn btn-outline-danger">Back To Website</button></a></div>

      <h1>Welcome <?php echo $row['name'] ?></h1>
       
      
    <div class="container" id="infoContainer">
   
      <div id="half"  class="col-md-6">

          <p class="lead col-sm-12 heading">Personal Details</p>

          <div class="form-group row ">
          
            <div class="col-sm-10">
              <p><?php echo '<img src = "'.$row['image_path'].'">' ?></p>
            </div>
        
          </div>

        
          <div class="form-group row ">
            
            <label  class="col-sm-2 form-control-label">Name</label>
            <div class="col-sm-10">
              <p><?php echo $row['name'] ?></p>
            </div>
          
          </div>

          <div class="form-group row ">
            
            <label class="col-sm-2 form-control-label">Address</label>
            
            <div class="col-sm-10">
            
              <p><?php echo $row['address1'].' '.$row['address2']  ?></p>
          
            </div>
          
          </div>

          <div class="form-group row">
            
            <label  class="col-sm-2 form-control-label">Birthdate</label>
              
              <div class="col-sm-10">
                
                <p><?php echo $row['birthdate'] ?></p>
              
              </div>
          
          </div>

          <div class="form-group row">
            
            <label class="col-sm-2 form-control-label">Age</label>
            
            <div class="col-sm-10">
              
              <p><?php echo $row['age'] ?></p>
            
            </div>
          
          </div>

          <div class="form-group row ">
            
            <label class="col-md-2 form-control-label">School Name</label>
            
            <div class="col-md-10">
              
              <p><?php echo $row['schoolname'] ?></p>
            
            </div>
        
          </div>
        
        

          <div class="form-group row ">
            
            <label class="col-sm-2 form-control-label">School Time</label>
            
            <div class="col-sm-5">
              
              <p><?php echo $row['schooltime'] ?></p>
            
            </div>
          
          </div>

      </div>

      <div id="secondHalf" class="col-md-6">
          
          <p class="lead heading">Contact Details</p>

          <div class="form-group row">
            
            <label class="col-sm-2 form-control-label">Phone</label>
            
            <div class="col-sm-5">
              
              <p><?php echo $row['phone'] ?></p>
            
            </div>
          
          </div>

          <div class="form-group row">
              
              <label class="col-sm-2 form-control-label">Email</label>
              
                <div class="col-sm-10">
                  
                  <p><?php echo $row['email'] ?></p>
                
                </div>
            
            </div>

          <p class="lead heading">Batch Timings</p>

            <div class="form-group row ">

              <label  class="col-sm-2  form-control-label ">Training Center</label>
                
                <div class="col-sm-5 ">
                
                  <p><?php echo $row['trainingcenter'] ?></p>
                  
                </div>  

            </div>

            <div class="form-group row ">

              <label  class="col-sm-2  form-control-label ">Timing</label>
                
                <div class="col-sm-5 ">
                
                  <p><?php echo $row['timings'] ?></p>
                  
                </div>  

            </div>



            

            <div class="form-group row">
              
              <div class="col-sm-offset-5 col-sm-8">
                
                <input type="submit" id = "submit1"class="btn btn-success btn-lg" value="Sign In" name="submit">
              
              </div>  
            
            </div>

      </div>

    </div>  

      
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/js/bootstrap.min.js" integrity="sha384-ux8v3A6CPtOTqOzMKiuo3d/DomGaaClxFYdCu2HPMBEkf6x2xiDyJ7gkXU0MWwaD" crossorigin="anonymous"></script>
  </body>
</html>