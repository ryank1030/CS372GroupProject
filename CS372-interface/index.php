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
                <a class="navbar-brand" href="#top">Group Share</a>
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
                    <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    <!-- ./profile logout -->
                    
                </ul>
                
                <!-- Search Bar -->
                <div class="col-md-3">
                    <ul class="nav navbar-nav">
                        <li id="search-group" class="input-group">
                            <span class ="input-group-btn">
                                <input type="text" class="form-control input-sm" placeholder="Search for a group" />
                                <button class="btn btn-info btn-sm" type="button">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
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
                <h3><img src="img/img.png" class="img-circle" alt="Profile Picture" width="70" height="70"> Dashboard</h3>      
            </div>
        </div>
        <!-- /.page header -->
    
        <div class="row">
        
        <!-- Group List -->
        <div class="col-lg-9">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading"><h4><i class="fa fa-users" aria-hidden="true"></i> Groups</h4></div>
                <div class="panel-body">
                    
                    <p><button class="btn btn-info btn-sm" type="button"> Create New Group</button></p>
                    
                    <!-- Group1 -->
                    <div class="panel-group" id="accordion1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse1">
                                        <a href="group_page.php" >Group Name 1 </a>
                                    </a><span class="glyphicon glyphicon-bell icon-notification-off"></span> 
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    
                                    <p><a href="group_page.php"><i class="fa fa-users" aria-hidden="true"></i>  Group Details</a></p>
                                    <p><a target="_blank" href="group_page.php"><i class="fa fa-folder" aria-hidden="true"></i>  Files</a> </p>
                                    <p><a href="group_page.php"><i class="fa fa-calendar" aria-hidden="true"></i>  Calendar</a></p>
                                    <p><a href="group_page.php"><i class="fa fa-comment" aria-hidden="true"></i>  Chat</a></p>
                                    <hr />
                                    <div class="dropdown">
                                        <a href="">Group Management</a>
                                        <a class="dropdown-toggle" data-toggle="dropdown">
                                            <span><i class="fa fa-caret-down fa-lg" aria-hidden="true"></i></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Add Member</a></li>
                                                <li><a href="#">Delete Member</a></li>
                                                <li><a href="#">Assign an Admin</a></li>
                                                <li class="disabled"><a href="#">Review Requests</a></li>
                                            </ul>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.Group1 -->
                    
                    <!-- Group2 -->
                    <div class="panel-group" id="accordion2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2">
                                        <a href="group_page.php" >Group Name 2 </a> 
                                    </a><span class="glyphicon glyphicon-bell icon-notification-on"></span> 
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse in">
                                <div class="panel-body">
                                     
                                    <p><a href="group_page.php"><i class="fa fa-users" aria-hidden="true"></i>  
                                        Group Details</a></p>
                                    <p><a target="_blank" href="group_page.php"><i class="fa fa-folder" aria-hidden="true"></i>        Files  <span class="badge badge-notify ">2</span></a></p>
                                    <p><a href="group_page.php"><i class="fa fa-calendar" aria-hidden="true"></i>  
                                        Calendar <span class="badge badge-notify ">1</span></a></p>
                                    <p><a href="group_page.php"><i class="fa fa-comment" aria-hidden="true"></i>  
                                        Chat  <span class="badge badge-notify ">3</span></a></p>
                                    <hr />
                                    <div class="dropdown">
                                        <a href="">Group Management</a>
                                        <a class="dropdown-toggle" data-toggle="dropdown">
                                            <span><i class="fa fa-caret-down fa-lg" aria-hidden="true"></i></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Add Member</a></li>
                                                <li><a href="#">Delete Member</a></li>
                                                <li><a href="#">Assign an Admin</a></li>
                                                <li><a href="#">Review Requests  
                                                    <span class="badge badge-notify">1</span></a></li>
                                            </ul>
                                        <span class="badge badge-notify ">1</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.Group2 -->
                    
                    <!-- Group3 -->
                    <div class="panel-group" id="accordion3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse3">
                                        <a href="group_page.php" >Group Name 3 </a> 
                                    </a><span class="glyphicon glyphicon-bell icon-notification-off"></span> 
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <p><a href="group_page.php"><i class="fa fa-users" aria-hidden="true"></i>  Group Details</a></p>
                                    <p><a target="_blank" href="group_page.php"><i class="fa fa-folder" aria-hidden="true"></i>  Files</a></p>
                                    <p><a href="group_page.php"><i class="fa fa-calendar" aria-hidden="true"></i>  Calendar</a></p>
                                    <p><a href="group_page.php"><i class="fa fa-comment" aria-hidden="true"></i>  Chat</a></p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.Group3 -->
                    
                </div>
            </div>
        </div>
    </div>
    <!-- ./group section -->
    
    <!-- Private files section -->
    <div class="col-lg-3 panel-group">
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
    <div class="col-lg-3 panel-group">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="fa fa-calendar" aria-hidden="true"></i> Calendar</h4></div>
            <div class="panel-body">
                <br>
                <table class="table table-bordered table-style table-responsive">
                    <tr>
                        <th colspan="2"><a href="#"><span class="glyphicon glyphicon-chevron-left pull-left"></span></a></th>
                        <th colspan="3" class="text-center"> Mar - 2017</th>
                        <th colspan="2"><a href="#>"><span class="glyphicon glyphicon-chevron-right pull-right"></span></a></th>
                    </tr>
                    <tr>
                        <th>S</th>
                        <th>M</th>
                        <th>T</th>
                        <th>W</th>
                        <th>T</th>
                        <th>F</th>
                        <th>S</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>9</td>
                        <td>10</td>
                        <td>11</td>
                        <td class="today">12</td>
                        <td>13</td>
                        <td>14</td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td>16</td>
                        <td>17</td>
                        <td>18</td>
                        <td>19</td>
                        <td>20</td>
                        <td>21</td>
                    </tr>
                    <tr>
                        <td>22</td>
                        <td>23</td>
                        <td>24</td>
                        <td>25</td>
                        <td>26</td>
                        <td>27</td>
                        <td>28</td>
                    </tr>
                    <tr>
                        <td>29</td>
                        <td>30</td>
                        <td>31</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
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
