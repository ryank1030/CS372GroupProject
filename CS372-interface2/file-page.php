<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Google Sign-in Stuff-->
    <meta name="google-signin-client_id" content="575498541884-dl7r3sns0rf1khmbe09sp7qqlml2rjrm.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>

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
                <a class="navbar-brand" href="homepage.php">Group Share</a>
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
                            <li class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1">Group Name 2
                                <button class="btn btn-info btn-sm margin-left" type="button">Accept</button>
                                <button class="btn btn-default btn-sm" type="button">Decline Request</button>
                            </a></li>
                        </ul>
                    </li>
                    <!-- ./group request dropdown -->
                    
                    <!-- profile and logout -->
                    <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                    <li>
                        <a href="index.php" onclick="signOut();"><span class="glyphicon glyphicon-log-out"></span> Sign out</a>
                    </li>
                    
                    <script>
                        function signOut() {
                            var auth2 = gapi.auth2.getAuthInstance();
                            auth2.signOut().then(function () {
                            console.log('User signed out.');
                            });
                        }
                    </script>
                    <!-- ./profile and sign out -->
                    
                </ul>
                
                <!-- Search Bar -->
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
                <!-- ./search bar -->
                
                
            </div>
            <!-- /.navbar-collapse -->
            </div>
            <!-- /. row -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    
    <!-- Page Header -->
    <div class="container">
        <div class="row">
        <div class="page-header">
            <h2> Private Files</h2>      
        </div>
        </div>
    </div>               
    
    <!-- /.container -->
    

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
