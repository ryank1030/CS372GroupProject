<?php 
session_start();

include "functions.php";
include "db/User.php";
include "db/Group.php";


$google_id = $_SESSION['ID'];


$user = new User;
$group = new Group;

$user->get_user($conn, $uSql, $google_id);
$userID = $user->get_user_id();

echo "after";

$group_name_in = $_POST['gname'];
$group_descrip_in = $_POST['gdesc'];

// create group
// if this succeeds, it creates the group and auto adds the user to the group
if ($group->create_group($conn, $gSql, $group_name_in, $group_descrip_in, $userID))
{
	$_SESSION["group_id"] = $group->get_group_id();
	
	// redirect to group page or whatever
}
else
{
//	$redirect = "new-group.php";
//	header('Location: '.$redirect);
	// whatever you do on fail
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
                    <?php /*Lists the groups that the user needs to accept or reject*/ createGroupRequests(null); ?>
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
                                <?php /*Lists the search results*/ groupSearch(null) ?>
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
    <!-- ./navigation -->
    


    <!-- Page Content -->
    
    <!-- Page Header -->
    <div class="container">
        <div class="page-header">
            <h2>Create New Group</h2>      
        </div>
        
        <div class="panel">
        
            <!-- Create Group Name and Description -->
            <form class="form-horizontal" method="GET" action="new-group-add.php" >

                <!-- Group Name -->
                <div class="form-group">
                    <Label>Group Name:</Label>
                    <input type="text" class="form-control" id="gname" name="gname" readonly="readonly" value="<?php echo $_POST['gname']; ?>"/>
                </div>

                <!-- Group Description -->
                <div class="form-group">
                    <label>Group Description:</label>
                    <textarea class="form-control" id="gdesc" name="gdesc" readonly="readonly"><?php echo $_POST['gdesc']; ?></textarea>
                </div>
                <br/>

            </form>
            <!-- ./group name and description -->
                
        </div>
        <!-- ./panel -->
        
        
        <!-- Add Group Members -->
        <div class="row col-lg-4 max-width4">  
            <h4>Add Group Members:</h4>
            <br/>
            
            <!-- Search for group -->
            <form class="form-horizontal" method="POST" action="new-group-add.php">
                <input type="hidden" name="gname" value="<?php echo $_POST['gname']; ?>">
                <input type="hidden" name="gdesc" value="<?php echo $_POST['gdesc']; ?>">
                <div class="input-group">
                    <input type="text" name="searchUsers" class="form-control" placeholder="Search for users" />
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
                </div>

            </form>
            <!-- ./end of search -->
        
            <!-- User search results -->
            <form class="form-horizontal" method="POST" action="new-group-add.php">
                <input type="hidden" name="gname" value="<?php echo $_POST['gname']; ?>">
                <input type="hidden" name="gdesc" value="<?php echo $_POST['gdesc']; ?>">
                    <div>
                        <table class="table table-condensed table-hover">
                            <tbody>
                            <?php 
/*
                                if(isset($_POST['searchUsers']))
                                {
                                    $searchValue = $_POST['searchUsers'];

                                    if($db = mysqli_connect( $conn->host_name() , $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
                                    {

                                        $sql = "SELECT user_id, first_name, last_name FROM Users WHERE first_name LIKE '$searchValue' AND user_id NOT IN (SELECT user_id FROM Add_Users_Pending WHERE group_id='<?php echo $_SESSION['group_id']; ?>' AND (SELECT user_id FROM Group_Users WHERE group_id='<?php echo $_SESSION['group_id']; ?>'))";
                                        
                                        if ($result = mysqli_query($db ,$sql))
                                        {
                                            if ($result->num_rows > 0) 
                                            {
                                                while($row = $result->fetch_assoc()) 
                                                {
                                                    echo "<tr>";
                                                    echo "<td>".$row['first_name']." ".$row['last_name']."<a onclick='myFunction(".$row['user_id'].")' id='".$row['user_id']."' name='".$row['user_id']."' class='pull-right'><i class='fa fa-user-plus fa-lg imageBtn' aria-hidden='true'></i></a></td>";
                                                    echo "</tr>";

                                                }
                                            }
                                            else 
                                            {
                                                echo "<tr><td>No results</td></tr>";
                                            }
                                        } 
                                    }
                                }
*/
                            ?>
                            </tbody>
                        </table>
                    </div>

                    <button class="btn btn-info btn-xl center-block " type="submit">Create Group</button>
                </form>
                <!-- ./user search results -->
            </div>
            <!-- ./row -->
        
        </div>
        <!-- container -->

<script>
    
function myFunction(value) {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "handler.php?q="+value, true);
  xhttp.send();
  document.getElementById(value).setAttribute("class", "pull-right hidden");  
}
</script>
    
    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script src="js/custominterface.js"></script>

</body>

</html>