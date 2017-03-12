<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Group Share</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    
</head>

<body>

 <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="row">
                
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Group Share</a>
            </div>
                
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">    
                <ul class="nav navbar-nav navbar-right">
                    
                    <!-- Group request dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" id="menu1" data-toggle="dropdown">
                            <i class="fa fa-users" aria-hidden="true"></i> 
                                Group Requests <span class="badge badge-notify">2</span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1">Group Name 1
                                <button class="btn btn-info btn-sm margin-left" type="button">Accept</button>
                                <button class="btn btn-default btn-sm" type="button">Decline Request</button>
                            </a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1">Group Name 2
                                <button class="btn btn-info btn-sm margin-left" type="button">Accept</button>
                                <button class="btn btn-default btn-sm" type="button">Decline Request</button>
                            </a></li>
                        </ul>
                    </li>
                    <!-- ./group request dropdown -->
                    
                    <!-- profile and logout -->
                    <li><a href="#top"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    <!-- ./profile logout -->
                    
                </ul>
                
                <!-- Search Bar -->
                <div class="col-md-4">
                    <ul class="nav navbar-nav">
                        <li id="search-group" class="input-group">
                            <span class ="input-group-btn">
                                <input type="text" class="form-control input-sm" placeholder="Search for a group" />
                                <button class="btn btn-info dropdown-toggle btn-sm" type="button" data-toggle="dropdown">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                                <ul class="dropdown-menu search-dd">
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Group Name 1
                                        <button class="btn btn-info btn-sm margin-left" type="button"> Join </button></a>
                                    </li>
                                    <li class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Group Name 2
                                        <button class="btn btn-info btn-sm margin-left" type="button"> Join </button></a>
                                    </li>
                                </ul>
                            </span>
                        </li>
                    </ul>
                </div>
                <!-- ./search bar -->
                
                
            </div>
            <!-- /.navbar-collapse -->
            </div>
            <!-- /. row -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        
        <!-- Page Header -->
        <div class="row">
        <div class="page-header">
            <h2><!--<img src="img/img.png" class="img-circle" alt="Profile Picture" width="70" height="70"> -->Profile</h2>      
        </div>
        </div>
        <!-- ./page header -->
        
        <div class="row">
            
        <!-- Progile Picture -->
        <div class="col-lg-3">
            <div class="text-center">
              <img src="img/img.png" class="img-circle" alt="Profile Picture" width="200" height="200">
                <h5>Upload a different photo...</h5>
              <input type="file" class="form-control">
                <br>
                <br>
            </div>
        </div>
        <!-- ./ proflie picture -->
        
            
        <!-- Personal Info -->
        <form class="form-horizontal col-lg-9 border-left" role="form">
            <div class="form-group">
              <label for="fname">First Name:</label>
              <input type="text" class="form-control" id="fname" value="John" />
            </div>

            <div class="form-group ">
              <label for="lname">Last Name:</label>
              <input type="text" class="form-control" id="lname" value="Smith" />
            </div>

            <div class="form-group">
              <label for="uname">Username:</label>
              <input type="text" class="form-control" id="uname" value="john.smith" />
            </div>

            <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" id="email" value="john.smith@gmail.com" />
            </div>

            <div class="form-group">
              <label for="phone">Phone Number:</label>
              <input type="text" class="form-control" id="phone" value="306-555-5555" />
            </div>
        </form>
        
        <!-- ./personal info -->
        
        </div>
        <!-- ./row -->
        <br />
        <br />
        <div class="row">
            <button class="btn btn-info center-block">Save Changes</button>
        </div>
        
    </div>
    <!-- /.container -->
    

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
