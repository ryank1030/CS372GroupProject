<?php
session_start();

//create calendar entry
if (isset($_POST["StartDate"]) && $_POST["StartDate"] && isset($_POST["EndDate"]) && $_POST["EndDate"] && isset($_POST["Summary"]) && $_POST["Summary"] && isset($_POST['addButton']) && $_POST['addButton'])
{
    //we have enough values to make an event
    $_SESSION['StartDate'] = $_POST["StartDate"];
    $_SESSION['EndDate'] = $_POST["EndDate"];
    $_SESSION['Summary'] = $_POST["Summary"];
    $_SESSION['Description'] = $_POST["Description"];
    $redirect = "signin-addEvent.php";
    header('Location: ' . $redirect);
}
else
{
 //remove our session variables
    unset($_SESSION['StartDate']);
    unset($_SESSION['EndDate']);
    unset($_SESSION['Summary']);
    unset($_SESSION['Description']);
}

?>





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
            <h2>Group Name 
                
            <!-- Leave Group -->
            <a href="homepage.php"><button class="btn btn-info pull-right">Leave Group</button></a>
            <!-- ./leave group -->
    
            </h2>
        </div>
        </div>  
    <!-- ./page header -->
    
    <!-- Group Tabs -->
    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#group-details"><h4>Group Details</h4></a></li>
            <li><a data-toggle="tab" href="#files-tab"><h4>Files</h4></a></li>
            <li><a data-toggle="tab" href="#calendar-tab"><h4>Calendar</h4></a></li>
            <li><a data-toggle="tab" href="#chat-tab"><h4>Chat</h4></a></li>
            <li><a data-toggle="tab" href="#manage-tab"><h4>Group Management</h4></a></li>
        </ul>
        <div class="tab-content">
                        
            
            <!-- Group Details -->
            <div id="group-details" class="tab-pane fade in active">
                <br>
                
                <!-- Group name and description -->
                <div class="panel panel-default">
                    <div class="panel-heading">Group Name 1</div>
                    <div class="panel-body"><p>The is a group project for CS 372 - Software Engineering</p></div>
                </div>
                <!-- ./group name description -->
                
                <!-- Group Members -->
                <div class="panel panel-default">
                    <div class="panel-heading">Group Members</div>
                    <div class="panel-body">
                    
                    <!-- User1 -->
                    <div class="panel-group" id="accordion1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h6 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse1">
                                        User Name 1
                                    </a> 
                                </h6>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p><i class="fa fa-envelope-o" aria-hidden="true"></i> username1@gmail.com</p>
                                    <p><i class="fa fa-phone" aria-hidden="true"></i> 306-555-5555</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.User1 -->
                    
                    <!-- User2 -->
                    <div class="panel-group" id="accordion2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h6 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2">
                                        User Name 2
                                    </a> 
                                </h6>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p><i class="fa fa-envelope-o" aria-hidden="true"></i> username2@gmail.com</p>
                                    <p><i class="fa fa-phone" aria-hidden="true"></i> 306-555-5555</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.User2 -->
                    
                    <!-- User3 -->
                    <div class="panel-group" id="accordion3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h6 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse3">
                                        User Name 3
                                    </a> 
                                </h6>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p><i class="fa fa-envelope-o" aria-hidden="true"></i> username3@gmail.com</p>
                                    <p><i class="fa fa-phone" aria-hidden="true"></i> 306-555-5555</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.User3 -->
                        
                    
                    <!-- Admin Leaders -->
                    <!-- User4 -->
                    <div class="panel-group" id="accordion4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h6 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapse4">
                                        Admin Leader: User Name 4  
                                    </a> 
                                </h6>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p><i class="fa fa-envelope-o" aria-hidden="true"></i> username4@gmail.com</p>
                                    <p><i class="fa fa-phone" aria-hidden="true"></i> 306-555-5555</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.User4 -->
                            
                    <!-- User5 -->
                    <div class="panel-group" id="accordion5">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h6 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion5" href="#collapse5">
                                        Admin Leader: User Name 5 
                                    </a> 
                                </h6>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p><i class="fa fa-envelope-o" aria-hidden="true"></i> username5@gmail.com</p>
                                    <p><i class="fa fa-phone" aria-hidden="true"></i> 306-555-5555</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.User5 -->
                    <!-- ./admin leaders -->
                          
                    </div>
                </div>
                <!-- ./group members -->
                
                
            </div>
            <!--./ group details -->
            
            <!-- Group Files  -->
            <div id="files-tab" class="tab-pane fade">
                
                <!-- ENTER FILE STUFF HERE -->
                
            </div>
            <!-- ./group files -->
            
            <!-- Group Calendar -->
            <div id="calendar-tab" class="tab-pane fade">
                
                <!-- ENTER CALENDAR STUFF HERE -->
                <br />
                <div class="row">
                    
                    <!-- Create New Event -->
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h5>Create New Event</h5></div>
                            <div class="panel-body">
                                <form action="group_page.php#calendar" method="post">

                                    <div class="input-group">
                                        <label>Start Date:</label>
                                        <input type="text" class="form-control" name="StartDate">
                                    </div>

                                    <div class="input-group">
                                        <label>End Date:</label>
                                        <input type="text" class="form-control" name="EndDate">
                                    </div>

                                    <div class="input-group">                
                                        <label>Summary:</label>
                                        <input type="text" class="form-control" name="Summary">
                                    </div>

                                    <div class="input-group">
                                        <label>Description:</label>
                                        <textarea name="Description" class="form-control"></textarea>
                                    </div>
                                    <br/>
                                    <input type="submit" class="btn btn-info" name="addButton" value="Create Event">

                                </form>
                            </div>
                        </div>
                    </div>
                    
                    
                    <!-- Calendar -->
                    <div class="col-md-9">
                        <div class="well">
                        
                        </div> 
                    </div>
                    
                    
                    
                
                
            </div>
            <!-- ./group calendar -->
            
            <!-- Group Chat -->
            <div id="chat-tab" class="tab-pane fade">
                
                <!-- ENTER CHAT STUFF HERE -->
                
            </div>
            <!-- ./group chat -->
            
            <!-- Group Management -->
            <div id="manage-tab" class="tab-pane fade">
                
                <br>
                <!-- Add Member -->
                <div class="panel-group" id="add-member-accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#add-member-accordion" href="#add-member-collapse">
                                   Add Member
                                </a> 
                            </h6>
                        </div>
                        <div id="add-member-collapse" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">

                                    <!-- Add Member dual list -->
                                    <div class="dual-list list-left col-md-5">
                                        <div class="well text-right">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <input type="text" name="SearchDualList" class="form-control" placeholder="Search for users" />
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-info" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                        </span>
                                                    </div>
                                                </div>  

                                            </div>
                                            <ul class="list-group">
                                                <li class="list-group-item">User Name 1</li>
                                                <li class="list-group-item">User Name 2</li>
                                                <li class="list-group-item">User Name 3</li>
                                                <li class="list-group-item">User Name 4</li>
                                                <li class="list-group-item">User Name 5</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- arrow to move users over -->
                                    <div class="list-arrows col-md-1 text-center">
                                        <button class="btn btn-default btn-sm move-right">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                        </button>
                                    </div>

                                    <!-- List users are being added to -->
                                    <div class="dual-list list-right col-md-5">
                                        <div class="well">
                                            <ul class="list-group" id="add-member-list">
                                            </ul>
                                        </div>
                                    </div>    
                                    
                                </div>
                            
                                <!-- add members button -->
                                <div class="row">
                                    <br/>
                                    <button class="btn btn-info btn-xl center-block">Add Members</button>
                                </div>
                                <!-- ./ add member dual list -->
                                
                            </div>                       
                        </div>
                    </div>
                </div>
                <!-- /.add member -->
                    
                
                <!-- Add Admin Leader -->
                <div class="panel-group" id="add-admin-accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#add-admin-accordion" href="#add-admin-collapse">
                                   Add Admin Leader
                                </a> 
                            </h6>
                        </div>
                        <div id="add-admin-collapse" class="panel-collapse collapse">
                            <div class="panel-body">
                            
                            <h5>User Name 1 <button class="btn btn-info btn-sm margin-left" type="button">Add Amin</button></h5>
                            <h5>User Name 2 <button class="btn btn-info btn-sm margin-left" type="button">Add Amin</button></h5>  
                            <h5>User Name 3 <button class="btn btn-info btn-sm margin-left" type="button">Add Amin</button></h5>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.add admin leader --> 
                
                
                <!-- Remove Member -->
                <div class="panel-group" id="remove-member-accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#remove-member-accordion" href="#remove-member-collapse">
                                   Remove Member
                                </a> 
                            </h6>
                        </div>
                        <div id="remove-member-collapse" class="panel-collapse collapse">
                            <div class="panel-body">

                            <h5>User Name 1 <button class="btn btn-info btn-sm margin-left" type="button">Remove User</button></h5>
                            <h5>User Name 2 <button class="btn btn-info btn-sm margin-left" type="button">Remove User</button></h5>  
                            <h5>User Name 3 <button class="btn btn-info btn-sm margin-left" type="button">Remove User</button></h5>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.remove member -->
                
                
                <!-- Review Requests -->
                <div class="panel-group" id="review-accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#review-accordion" href="#review-collapse">
                                   Review Requests
                                </a> 
                            </h6>
                        </div>
                        <div id="review-collapse" class="panel-collapse collapse">
                            <div class="panel-body">

                            <h5>User Name 6 
                                <button class="btn btn-info btn-sm margin-left" type="button">Accept</button>
                                <button class="btn btn-default btn-sm" type="button">Decline Request</button>
                            </h5>
                            <h5>User Name 7
                                <button class="btn btn-info btn-sm margin-left" type="button">Accept</button>
                                <button class="btn btn-default btn-sm" type="button">Decline Request</button>
                            </h5>  
                                                                                        
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.revew requests -->

            </div>
            <!-- ./group management -->
            
            
            </div>
            <!-- ./group tabs -->
        </div>
        <!-- ./row -->
    </div> 
    <!-- /.container -->
    

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script src="js/custominterface.js"></script>

    
    

</body>

</html>
