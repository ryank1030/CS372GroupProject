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

<body class="landing-body">
    
    <!--used to save the users google info-->
    <script>
        function onSignIn(googleUser) {
          var profile = googleUser.getBasicProfile();
          console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
          console.log('Name: ' + profile.getName());
          console.log('Image URL: ' + profile.getImageUrl());
          console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
          window.location = "homepage.php"
        }
    </script>

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
                    
                    <!-- Signup and Login -->
                    <li><a href="sign-up.php"><i class="fa fa-user-plus" aria-hidden="true"></i> Sign up</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-sign-in" aria-hidden="true"></i> Sign in <span class="caret"></span></a>
			             <ul id="login-dp" class="dropdown-menu padding">
				            <li>
					           <div class="row">
							     <div class="col-md-12">
								    <div class="g-signin2" data-width="210" data-longtitle="true" data-onsuccess="onSignIn"></div>
                                    <p class="line-around white padding-top center"> or </p>
								    <form class="form" role="form" method="post" action="homepage.php" accept-charset="UTF-8" id="login-nav">
										<div class="form-group">
											 <label class="sr-only" >Email address</label>
											 <input type="email" class="form-control" id="signin-email" placeholder="Email address">
										</div>
										<div class="form-group">
											 <label class="sr-only">Password</label>
											 <input type="password" class="form-control" id="signin-password" placeholder="Password">
                                             <div class="help-block"><a href="">Forget the password?</a></div>
										</div>
										<div class="form-group">
											 <button type="submit" class="btn btn-info btn-block">Sign in</button>
										</div>
								    </form>
							     </div>
					       </div>
				        </li>
			         </ul>
                </li>
                    
                <!-- ./signup login -->
                    
                </ul>
                
                
            </div>
            <!-- /.navbar-collapse -->
            </div>
            <!-- /. row -->
        </div>
        <!-- /.container -->

        
    </nav>
    
    

    <div class="container">
        <div class="jumbotron text-center transparent">
            <div class="container vert-center light">
            <h1><strong>Group Share</strong></h1>
            <hr/>
            <p>Easily manage group projects with built in group chat, file sharing, and calendar!</p>
            <a href="sign-up.php" class="btn btn-info btn-xl page-scroll">Sign up Now!</a>
            </div>
        </div>
    </div>
    
    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    
    
</body>

</html>

