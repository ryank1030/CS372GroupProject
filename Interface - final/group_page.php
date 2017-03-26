<?php
session_start();
include "functions.php";
include "User.php";


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
    unset($_SESSION['access_token']);
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
                    <?php createGroupRequests(null); ?>
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
                                <?php groupSearch(null) ?>
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
                    
                    <?php
    
                    $count = 0;
                    $result->num_rows = 0;
                    if($result->num_rows > 0)
                    {
                        while($row = $result->fetch_assoc()){
                            if($admin = false){
                                createUser($count, $row['name'], $row['email'], $row['phone']);
                                $count++;   
                            }
                        }
                        while($row = $result->fetch_assoc()){
                            if($admin = true){
                                createUserAdmin($count, $row['name'], $row['email'], $row['phone']);
                                $count++;   
                            }
                        }
                    }
                    else
                    {
                        echo "<div><h5>There are currently no members in this group.</h5></div>";
                    }
    
                    ?>
               
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
                        <br/>
                        <div class="panel panel-default">
                            <div class="panel-heading"><h5>Create New Event</h5></div>
                            <div class="panel-body">
                                <form action="group_page.php#calendar" method="post">

                                    <div class="input-group">
                                        <label>Start Date:</label>
                                        <input type="text" class="form-control" name="StartDate" placeholder="YYYY-MM-DD">
                                    </div>

                                    <div class="input-group">
                                        <label>End Date:</label>
                                        <input type="text" class="form-control" name="EndDate" placeholder="YYYY-MM-DD">
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
                        <div class="panel">
                            <?php
                            $newEmail = str_replace("@", "%40", $_SESSION['email']);
                            $iframeSRC = "https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=" . $newEmail . "&amp;color=%234E5D6C&amp;";
                            ?>
                            <iframe src="<?php echo $iframeSRC; ?>" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
                        </div> 
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
	
				<!-- Add Group Members -->
        			<div class="row col-lg-4 max-width4">  
            				<br/>
       
            				<!-- Search for group -->
            				<form class="form-horizontal" method="" action="">
               				    <div class="input-group">
                    				<input type="text" name="searchUsers" class="form-control" placeholder="Search for users" />
                    				<span class="input-group-btn">
                        				<button class="btn btn-info disabled"><i class="fa fa-search" aria-hidden="true"></i></button>
                    				</span>
                			    </div>
            				</form>
           				<!-- ./end of search -->
					<br/>
        
            			</div>
            			<!-- ./row -->
                             
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
                                
                            <?php /*Lists member who do not have admin status*/ addAdminList(null); ?>
                                
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

                                <?php /*Lists members who do not have admin status*/ removeUserList(null) ?>
                                
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

                                <?php /*lists the users who are wanting to join the group*/ reviewRequestList(null) ?>
                                                                                        
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
