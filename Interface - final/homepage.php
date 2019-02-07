<?php
session_start();

include "functions.php";
include 'db/User.php';

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
                <a class="navbar-brand" href="#top">Group Share</a>
            </div>
                
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">    
                <ul class="nav navbar-nav navbar-right">
                    
                    <!-- Group request dropdown -->
                    <?php /*Lists the groups that the user needs to accept or reject*/ 
                    createGroupRequests(null); 
                    ?>
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
                                <form action='$_SERVER["PHP_SELF"]' method='post'>
                                    <input type="text" class="form-control input-sm" placeholder="Search for a group" name="searchForGroups" id="searchForGroups"/>
                                    <button class="btn btn-info dropdown-toggle btn-sm" type="button" data-toggle="dropdown">
                                        <i class="glyphicon glyphicon-search"></i>
                                </button>
                                </form>
                                <?php /*Lists the search results*/ 
                                groupSearch(null) 
                                ?>
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
    <div class="container">
    
        <!-- Page Header -->
        <div class="row">
            <div class="page-header">
                <h2><img src="
                <?php echo $_SESSION['image']; ?>
                " class="img-circle" alt="Profile Picture" width="70" height="70"> Dashboard</h2>
            </div>
        </div>
        <!-- /.page header -->
    
        <div class="row">
        
        <!-- Group List -->
        <div class="col-lg-9 max-width9">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading"><h4><i class="fa fa-users" aria-hidden="true"></i> Groups</h4></div>
                <div class="panel-body">
                    
                    <p><a href="new-group.php"><button class="btn btn-info btn-sm" type="button"> Create New Group</button></a></p>
                    
                    
                    <!-- List Groups -->
                    <?php
                    
                    //$sql = "SELECT * FROM table";
                    //$result = $conn->query($sql);
                    $count = 0;
                    $result->num_rows = 0;
                    if($result->num_rows > 0)
                    {
                        while($row= $result->fetch_assoc()){
                            //need to determine if user is an admin for this group
                            $admin_bool = "true";
                            createGroup($count, $row['group_name'], $admin_bool);
                            $count++;
                        }
                    }
                    else
                    {
                        echo "<div><br/><h5>You currently have no groups.</h5></div>";
                    }
                    
                    ?>

                    
                    
                </div>
            </div>
        </div>
    </div>
    <!-- ./group section -->
    
    <!-- Private files section -->
    <div class="col-lg-3 panel-group max-width3">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="fa fa-folder-open" aria-hidden="true"></i> Private Files</h4></div>
            <div class="panel-body">
                <p>There are no files.</p>
                <a href="file-page.php">Manage Private Files</a>
            </div>
        </div>
    </div>
    <!-- /.Private Files -->
    
    <!--Calendar Section --> 
    <div class="col-lg-3 panel-group max-width3">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="fa fa-calendar" aria-hidden="true"></i> Upcoming Events</h4></div>
            <div class="panel-body">
               <?php
                $newEmail = str_replace("@", "%40", $_SESSION['email']);
                $iframeSRC = "https://calendar.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=330&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=" . $newEmail . "&amp;color=%234E5D6C&amp;";
                ?>
                <iframe src="<?php echo $iframeSRC; ?>" style="border-width:0" width="230" height="300" frameborder="0" scrolling="no"></iframe>
                <br />
                <a href="calendar-page.php">Manage Calendar</a>
                
            </div>
        </div> 
    </div>
    <!-- /.calendar -->        
            
    </div>
    <!-- ./row -->
        
    </div>            
    <!-- /.container -->
    

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    
</body>

</html>

