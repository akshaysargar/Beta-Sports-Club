<?php

session_start();
$result1="";
$result2="";
$result3="";
$result4="";
$result5="";
$error="";
$success ="";

if (array_key_exists("id", $_COOKIE)) 
 {
    $_SESSION['id'] = $_COOKIE['id'];
 }

 if (array_key_exists("id", $_SESSION)) 
 {

    $link = mysqli_connect("127.0.0.1" ,"root","root","users");

            if (mysqli_connect_error()) 
            {
                die("database connection failed");
            }

    $query1 = "SELECT * FROM `users` WHERE `id` != 21 AND `timings`= 1";

    $result1 = mysqli_query($link,$query1);

    $query2 = "SELECT * FROM `users` WHERE `id` != 21 AND `timings`= 2";

    $result2 = mysqli_query($link,$query2);

    $query3 = "SELECT * FROM `users` WHERE `id` != 21 AND `timings`= 3";

    $result3 = mysqli_query($link,$query3);

    $query4 = "SELECT * FROM `users` WHERE `id` != 21 AND `timings`= 4";

    $result4 = mysqli_query($link,$query4);

    $query5 = "SELECT * FROM `users` WHERE `id` != 21 AND `timings`= 5";

    $result5 = mysqli_query($link,$query5);

}

if ($_GET['id']) {

  

   
$user_id= $_GET['id'];

$query = "DELETE FROM `users` WHERE `id` = '".mysqli_real_escape_string($link,$user_id)."' ";
   

    

    if (!mysqli_query($link,$query)) 
    {
        $error = "<p>Could not Delete</p>";
    }

    else
    {
      $query = "UPDATE `users` SET id = id-1 WHERE id > $user_id " ;

      mysqli_query($link, $query);

      header("Location:admin.php");

      $success = "<p>Sucessfully deleted & updated</p>";
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
    <link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
    
    <style type="text/css">
      
      .container
      {
        margin-top: 100px;
      }

      #ktc
      {
        text-align: center;
        height: 50px;
        padding-top: 10px;
        font-family: 'Arvo', serif;
        font-size: 23px;
        margin-bottom:15px; 

      }
      #btc
      {
        text-align: center;
        height: 50px;
        padding-top: 10px;
        font-family: 'Arvo', serif;
        font-size: 23px;
        margin-bottom:15px;

      }
      .ph
      {
        text-align: center;
        cursor: pointer;
        padding: 10px;
        background-color:grey;
        border-bottom: 2px solid white; 
      

      }
      .ph1
      {
        text-align: center;
        cursor: pointer;
       
        
      }
      
      
      #kothrudcontainer
      {
        margin-top: 100px;
      }
      #bavdhancontainer
      {
        margin-top: 50px;
      }
      a
      {
        color: #A2EE4E;
      }
      a:hover
      {
        text-decoration: none;
      }
      p
      {
        font-size: 25px;
        color: grey;
      
      }
      .img
      {
        float: right;
        
        height: 200px;
        width:250px;
      }
      th
      {
        text-align: center;
      }
      table
      {
        margin: 0px;
      }
      .container
      {
        margin-top: 20px;
        margin-bottom: 30px;
      }

      
      
       

    </style>
  </head>
  <body>

  <nav class="navbar navbar-light bg-faded navbar-fixed-top">
  <a class="navbar-brand" href="#">Player's Data</a>
 
  <div class=" pull-xs-right">
    
     <a href = 'index.php?logout=1'><button class="btn btn-success-outline" type="submit">Logout</button></a>
  </div>
</nav>

  

    <div class="container-fluid" id="kothrudcontainer">

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

        <div class="container-fluid col-md-12 bg-warning" id="ktc" >Kothrud Training Center</div>

          <div id="accordion1" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading ph"  data-toggle="collapse" href="#collapseOne"  role="tab" id="heading1">
                <h4 class="panel-title">
                  <a class="collapsed"  data-parent="#accordion" aria-expanded="false" aria-controls="collapseOne">
                    6:00 - 7:30 PM
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading1">
                <div class="container">  
             
              <?php   

                     echo '
                     <table class="table" >
                     <thead class="thead-inverse">
                      <tr>
                        
                        <th class="col-md-1">SR NO.</th>
                        <th class="col-md-3">NAME</th>
                        <th class="col-md-2">AGE</th>
                        <th class="col-md-3">PHONE</th>
                        <th class="col-md-3">EMAIL</th>
                        
                      
                      </tr>
                    </thead>
                    </table>';
                       
                      $i=1;
                     while($row = mysqli_fetch_array($result1) )
                        {
                          
                          
                        echo'
                          
                            <div class="panel panel-default">
                              <div class="panel-heading ph1">
                                <h5 class="panel-title">
                                  <div data-toggle="collapse"  href="#collapseInnerOne'.$i.'">
                  
                                    <table class="table table-striped" >
                                    <tbody>
                                      <tr>
                                        <td class="col-md-1">'.$i.'</td>                                
                                        <td class="col-md-3">'.$row["name"].'</td>
                                        <td class="col-md-2">'.$row["age"].'</td>
                                        <td class="col-md-3">'.$row["phone"].'</td>
                                        <td class="col-md-3">'.$row["email"].'</td>
                                        
                                      </tr>
                                    </tbody>
                                    </table>
                            
                                  </div>
                                </h5>
                              </div>
                              
                              <div id="collapseInnerOne'.$i.'" class="panel-collapse collapse">
                                  <img src = "'.$row['image_path'] .'" class="img">
                                  <p> Address1 :'.$row["address1"].'</p>
                                  <p> Address2 :'.$row["address2"].'</p>
                                  <p> School Name : '.$row["schoolname"].'</p>
                                  <p> School Time : '.$row["schooltime"].'</p>
                                  <p> Birthdate : '.$row['birthdate'].'</p>
                                  <a href="?id='.$row['id'].' javascript:AlertIt();">delete</a>
                                  
                              </div>
                            </div>';           
                        $i++;
                        }
              
              ?>
              </div>
            
              </div>
            </div>
        
            <div class="panel panel-default">
              <div class="panel-heading ph" data-toggle="collapse" href="#collapseTwo" role="tab" id="heading2">
                <h4 class="panel-title">
                  <a class="collapsed"  data-parent="#accordion"  aria-expanded="false" aria-controls="collapseTwo">
                    7:00 - 8:30 PM
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
              <div class="container">
              <?php  
              echo '
                     <table class="table" >
                     <thead class="thead-inverse">
                      <tr>
                      
                        <th class="col-md-1">SR NO.</th>
                        <th class="col-md-3">NAME</th>
                        <th class="col-md-1">AGE</th>
                        <th class="col-md-3">PHONE</th>
                        <th class="col-md-3">EMAIL</th>
                        <th class="col-md-1">DEL</th>

                      </tr>
                    </thead>
                    </table>';   
                      $i=1;
                     while($row = mysqli_fetch_array($result2))
                        {
                          
                        echo'
                            

                            <div class="panel panel-default">
                              <div class="panel-heading ph1">
                                <h5 class="panel-title">
                                  <div data-toggle="collapse"  href="#collapseInnerTwo'.$i.'">
                  
                                    <table class="table table-striped" >
                                    <tbody  >
                                      <tr >                                
                                        <td class="col-md-1">'.$i.'</td>                                
                                        <td class="col-md-3">'.$row["name"].'</td>
                                        <td class="col-md-1">'.$row["age"].'</td>
                                        <td class="col-md-3">'.$row["phone"].'</td>
                                        <td class="col-md-3">'.$row["email"].'</td>
                                        <td class="col-md-1"><img src= "cross.png" id="cross"></td>
                                      </tr>
                                    </tbody>
                                    </table>
                            
                                  </div>
                                </h5>
                              </div>
                              
                              <div id="collapseInnerTwo'.$i.'" class="panel-collapse collapse">
                              <img src = "'.$row['image_path'] .'" class="img">
                                  <p>'.$row["address1"].'</p>
                                  <p>'.$row["schoolname"].'</p>
                                  <p>'.$row["schooltime"].'</p>
                                  <p>'.$row['birthdate'].'</p>
                                  <a href="?id='.$row['id'].' javascript:AlertIt();">delete</a>
                                 
                              </div>
                            </div>';           
                        $i++;
                        
                            

                        }
              
              ?>
              </div>
          
              </div>
            </div>
        </div>    
        </div>
    
    </div>

   

    <div class="container-fluid" id="bavdhancontainer">
         
      <div class="container-fluid col-md-12 bg-warning" id="btc" >Bavdhan Training Center</div>

              <div id="accordion2" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                  <div class="panel-heading ph" data-toggle="collapse" href="#bavdhan1" cursor= "pointer" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a class="collapsed"  data-parent="#accordion" aria-expanded="false" aria-controls="bavdhan1">
                          4:00 - 5:15 PM
                        </a>
                      </h4>
                  </div>
                  <div id="bavdhan1" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                  <div class="container">
                  <?php
                          echo '
                     <table class="table" >
                     <thead class="thead-inverse">
                      <tr>
                      
                        <th class="col-md-1">SR NO.</th>
                        <th class="col-md-3">NAME</th>
                        <th class="col-md-1">AGE</th>
                        <th class="col-md-3">PHONE</th>
                        <th class="col-md-3">EMAIL</th>
                        <th class="col-md-1">DEL</th>

                      </tr>
                    </thead>
                    </table>';    

                      $i=1;
                     while($row = mysqli_fetch_array($result3))
                        {
                          
                      
                          
                          echo'
                          
                            <div class="panel panel-default">
                              <div class="panel-heading ph1">
                                <h5 class="panel-title">
                                  <div data-toggle="collapse"  href="#collapseInnerThree'.$i.'">
                  
                                    <table class="table table-striped " >
                                    <tbody  >
                                      <tr >                                
                                        <td class="col-md-1">'.$i.'</td>                                
                                        <td class="col-md-3">'.$row["name"].'</td>
                                        <td class="col-md-1">'.$row["age"].'</td>
                                        <td class="col-md-3">'.$row["phone"].'</td>
                                        <td class="col-md-3">'.$row["email"].'</td>
                                        <td class="col-md-1"><img src= "cross.png" id="cross"></td>
                                      </tr>
                                    </tbody>
                                    </table>
                            
                                  </div>
                                </h5>
                              </div>
                              
                              <div id="collapseInnerThree'.$i.'" class="panel-collapse collapse">
                              <img src = "'.$row['image_path'] .'" class="img">
                                  <p>'.$row["address1"].'</p>
                                  <p>'.$row["schoolname"].'</p>
                                  <p>'.$row["schooltime"].'</p>
                                  <p>'.$row['birthdate'].'</p>
                                  <a href="?id='.$row['id'].' javascript:AlertIt();">delete</a>
                              </div>
                            </div>';           
                        $i++;
                        
                            

                        }
              
              ?>
              </div>
              
                  </div>
                </div>
                
                <div class="panel panel-default">
                  <div class="panel-heading ph" data-toggle="collapse" href="#bavdhan2" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                      <a class="collapsed"  data-parent="#accordion"  aria-expanded="false" aria-controls="bavdhan2">
                          5:00 - 6:30 PM
                      </a>
                    </h4>
                  </div>
                  <div id="bavdhan2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="container">
                  <?php     
                          echo '
                     <table class="table" >
                     <thead class="thead-inverse">
                      <tr>
                      
                        <th class="col-md-1">SR NO.</th>
                        <th class="col-md-3">NAME</th>
                        <th class="col-md-1">AGE</th>
                        <th class="col-md-3">PHONE</th>
                        <th class="col-md-3">EMAIL</th>
                        <th class="col-md-1">DEL</th>

                      </tr>
                    </thead>
                    </table>';

                      $i=1;
                     while($row = mysqli_fetch_array($result4))
                        {
                          
                        echo'
                          
                            <div class="panel panel-default">
                              <div class="panel-heading ph1">
                                <h5 class="panel-title">
                                  <div data-toggle="collapse"  href="#collapseInnerFour'.$i.'">
                  
                                    <table class="table table-striped " >
                                    <tbody  >
                                      <tr >                                
                                        <td class="col-md-1">'.$i.'</td>                                
                                        <td class="col-md-3">'.$row["name"].'</td>
                                        <td class="col-md-1">'.$row["age"].'</td>
                                        <td class="col-md-3">'.$row["phone"].'</td>
                                        <td class="col-md-3">'.$row["email"].'</td>
                                        <td class="col-md-1"><a><img src= "cross.png" id="cross"></a></td>
                                      </tr>
                                    </tbody>
                                    </table>
                            
                                  </div>
                                </h5>
                              </div>
                              
                              <div id="collapseInnerFour'.$i.'" class="panel-collapse collapse">
                              <img src = "'.$row['image_path'] .'" class="img">
                                  <p>'.$row["address1"].'</p>
                                  <p>'.$row["schoolname"].'</p>
                                  <p>'.$row["schooltime"].'</p>
                                  <p>'.$row['birthdate'].'</p>
                                  <a href="?id='.$row['id'].' javascript:AlertIt();">delete</a>
                              </div>
                            </div>';           
                        $i++;
                        }
              
              ?>
              </div>
                  </div>
                </div>

                <div class="panel panel-default">
                  <div class="panel-heading ph" data-toggle="collapse" href="#bavdhan3" role="tab" id="headingThree">
                    <h4 class="panel-title">
                      <a class="collapsed"  data-parent="#accordion"  aria-expanded="false" aria-controls="bavdhan3">
                        6:00 - 8:00 PM
                      </a>
                    </h4>
                  </div>
                  <div id="bavdhan3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="container">
                  <?php   

                        echo '
                     <table class="table" >
                     <thead class="thead-inverse">
                      <tr>
                      
                        <th class="col-md-1">SR NO.</th>
                        <th class="col-md-3">NAME</th>
                        <th class="col-md-1">AGE</th>
                        <th class="col-md-3">PHONE</th>
                        <th class="col-md-3">EMAIL</th>
                        <th class="col-md-1">DEL</th>

                      </tr>
                    </thead>
                    </table>';

                      $i=1;
                     while($row = mysqli_fetch_array($result5))
                        {
                          
                        echo'
                          
                            <div class="panel panel-default">
                              <div class="panel-heading ph1">
                                <h5 class="panel-title">
                                  <div data-toggle="collapse"  href="#collapseInnerFive'.$i.'">
                  
                                    <table class="table table-striped " >
                                    <tbody  >
                                      <tr >                                
                                        <td class="col-md-1">'.$i.'</td>                                
                                        <td class="col-md-3">'.$row["name"].'</td>
                                        <td class="col-md-1">'.$row["age"].'</td>
                                        <td class="col-md-3">'.$row["phone"].'</td>
                                        <td class="col-md-3">'.$row["email"].'</td>
                                        <td class="col-md-1"><img src= "cross.png" id="cross"></td>
                                      </tr>
                                    </tbody>
                                    </table>
                            
                                  </div>
                                </h5>
                              </div>
                              
                              <div id="collapseInnerFive'.$i.'" class="panel-collapse collapse">
                              <img src = "'.$row['image_path'] .'" class="img">
                                  <p>'.$row["address1"].'</p>
                                  <p>'.$row["schoolname"].'</p>
                                  <p>'.$row["schooltime"].'</p>
                                  <p>'.$row['birthdate'].'</p>
                                  <a href="?id='.$row['id'].' javascript:AlertIt();">delete</a>
                              </div>
                            </div>';           
                        $i++;
                        }
              
              ?>
                  </div>
                  </div>
                </div>          
              </div>

      </div>    
    </div>

    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
    <script type="text/javascript">
        
        $(document).ready(function() 
        {
    
            function AlertIt() {
var answer = confirm ("Please click on OK to continue.")
if (answer)
window.location="localhost/admin.php";
}

});

    </script>
  </body>
</html>
