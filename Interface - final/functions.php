<?php

//class needs a handler for review requests
//needs query that based on user finds all groups they are in and if they are an admin for that group
//if they are admin need query to determine if there are any requests for that group
function createGroup($count, $group_name, $admin_bool)
{
    echo "<div class='panel-group' id='accordion".$count."'><div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'>";    
    echo "<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion".$count."' href='#collapse".$count."'>";     
    echo "<a href='group_page.php' >".$group_name."</a>";   
    echo "</a><span class='glyphicon glyphicon-bell icon-notification-off'></span> </h4> </div>
            <div id='collapse1' class='panel-collapse collapse in'>
                <div class='panel-body'>

                    <p><a href='group_page.php'><i class='fa fa-users' aria-hidden='true'></i>  Group Details</a></p>
                    <p><a  href='group_page.php#files'><i class='fa fa-folder' aria-hidden='true'></i>  Files</a> </p>
                    <p><a href='group_page.php#calendar'><i class='fa fa-calendar' aria-hidden='true'></i>  Calendar</a></p>
                    <p><a href='group_page.php#chat'><i class='fa fa-comment' aria-hidden='true'></i>  Chat</a></p>
                    <hr />";
    
    if($admin_bool == true){
        
                echo "<div class='dropdown'>
                        <a href='group_page.php#manage'>Group Management</a>
                        <a class='dropdown-toggle' data-toggle='dropdown'>
                            <span><i class='fa fa-caret-down fa-lg' aria-hidden='true'></i></span></a>
                            <ul class='dropdown-menu'>
                                <li><a href='group_page.php#manage#add-member-collapse'>Add Member</a></li>
                                <li><a href='group_page.php#manage#remove-member-collapse'>Delete Member</a></li>
                                <li><a href='group_page.php#manage#add-admin-collapse'>Assign an Admin</a></li>
                                <li class='disabled'><a href='#'>Review Requests</a></li>
                            </ul>
                        </div>";
        
    }   
    echo"</div></div></div></div>";
    
}

//needs query for the groups that have added this user
function createGroupRequests($group_list)
{
   
    if($group_list == null){
        echo " <li class='dropdown'>
                        <a class='dropdown-toggle' id='menu1' data-toggle='dropdown'>
                            <i class='fa fa-users' aria-hidden='true'></i> 
                                Group Requests </a></li>";
    }
    else{
        echo " <li class='dropdown'><a class='dropdown-toggle' id='menu1' data-toggle='dropdown'>
            <i class='fa fa-users' aria-hidden='true'></i> Group Requests ";
        echo "<span class='badge badge-notify'>".count($group_list)."</span></a>";
        echo "<ul class='dropdown-menu' role='menu' aria-labelledby='menu1'>";
        foreach ($group_list as $name)
        {
             echo "<li role='presentation'><a role='menuitem' tabindex='-1'>".$name.
                    "<button class='btn btn-info btn-sm margin-left' type='button'>Accept</button>
                    <button class='btn btn-default btn-sm' type='button'>Decline Request</button>
                </a></li>
                <li class='divider'></li>"; 
        }
        echo "</ul></li>";
    }

}


//needs simple group quesy based off the search input
function groupSearch($group_list) {

    if($group_list != null)
    {
        echo "<ul class='dropdown-menu search-dd'>";
        foreach ($group_list as $name){
        
            echo "<li role='presentation'><a role='menuitem' tabindex='-1'>".$name."<button class='btn btn-info btn-sm margin-left' type='button'> Join </button></a></li>";
        }

        echo "</ul>";
    }
    
}

//needs user query of those who are not admins to find first name, last name, email, phone number
function createUser($count, $fname, $lname, $email, $phone){
    
    echo "<div class='panel-group' id='accordion".$count."'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>
                                <h6 class='panel-title'>
                                    <a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion".$count."' href='#collapse".$count."'>"
                                        .$fname." ".$lname.
                                    "</a> 
                                </h6>
                            </div>
                            <div id='collapse".$count."' class='panel-collapse collapse'>
                                <div class='panel-body'>
                                    <p><i class='fa fa-envelope-o' aria-hidden='true'></i> ".$email."</p>
                                    <p><i class='fa fa-phone' aria-hidden='true'></i> ".$phone."</p>
                                </div>
                            </div>
                        </div>
                    </div>";
    
}

//needs user query of those who are admins to find first name, last name, email, phone number
function createUserAdmin($count, $name, $email, $phone){
    
    echo "<div class='panel-group' id='accordion".$count."'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>
                                <h6 class='panel-title'>
                                    <a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion".$count."' href='#collapse".$count."'>Admin Leader: "
                                        .$name.
                                    "</a> 
                                </h6>
                            </div>
                            <div id='collapse".$count."' class='panel-collapse collapse'>
                                <div class='panel-body'>
                                    <p><i class='fa fa-envelope-o' aria-hidden='true'></i> ".$email."</p>
                                    <p><i class='fa fa-phone' aria-hidden='true'></i> ".$phone."</p>
                                </div>
                            </div>
                        </div>
                    </div>";
    
}

//query user tables based on search value
function userSearch($user_List)
{

    if($user_list != null)
    {
        echo "<ul class='list-group'>";
        foreach($user_list as $name)
        {
            "<li class='list-group-item'>".$name."</li>";
        }
        echo "</ul>";
    }

}

//requires a query to produce the list of users who are not admins in the chosen group
function addAdminList($user_List)
{
    if($user_list != null)
    {
        foreach($user_list as $name)
        {
            echo "<h5>".$name."<button class='btn btn-info btn-sm margin-left' type='button'>Add Amin</button></h5>";
        }   
    }
    else
    {
        echo "<div><h5>There are no members to promote to Admin Leader</h5></div>";
    }
}

//requires a query to produce the list of users who are not admins in the chosen group
function removeUserList($user_List)
{
    if($user_list != null)
    {
        foreach($user_list as $name)
        {
            echo "<h5>".$name."<button class='btn btn-info btn-sm margin-left' type='button'>Remove User</button></h5>";
        }   
    }
    else
    {
        echo "<div><h5>There are no members that can be removed</h5></div>";
    }
}


//requires a query to find users who are requesting to join the group in question
function reviewRequestList($user_List)
{     
    if($user_list != null)
    {
        foreach($user_list as $name)
        {
           "<h5>".$name."<button class='btn btn-info btn-sm margin-left' type='button'>Accept</button>
            <button class='btn btn-default btn-sm' type='button'>Decline Request</button></h5>";  
        }  
    }
    else{
        echo "<div><h5>There are no requests to join your group at this time</h5></div>";
    }

}







?>