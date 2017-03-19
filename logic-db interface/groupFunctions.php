<?php


/* -----basic sql queries for Group Logic requests----
	### all of this is untested and currently in procedural form, This probably doesn't work yet and is heavily subject to change.
	
	Every one of these functions requires the connection to be established, tested, and closed down outside of the function. If there's a connection error or a NULL result, they'll all return FALSE. Do error handling outside.
	
	none of the processing of the returned data has been handled in any of these functions as of yet.
	
	none of the input/output has been sanitized for sql or html at this point, so use at your own risk.
	
*/ 


/*	basic query prototypes:
	sql_get_max_group_id($conn)
	sql_new_group_id($conn)
	sql_init_group($conn)
	sql_make_group($conn, $groupName, $groupDescrip)
	sql_get_group_info($conn, $groupID)
	sql_group_join_request($conn, $groupID, $userID,  $userApproval, $adminApproval)
	sql_get_join_request_status($conn, $groupID, $userID)
	sql_join_group($conn, $groupID, $userID)
	sql_leave_group($conn, $groupID, $userID)
	sql_leave_group_pending($conn, $groupID, $userID)
	sql_get_group_users($conn, $groupID)	
	sql_get_group_pending($conn, $userID)
	sql_get_all_admins ($conn, $groupID)
	sql_is_admin ($conn, $groupID, $userID)
	sql_num_of_admins ($conn, $groupID)
	
*/



/* get maximum group id, for generating a new group id */
function sql_get_max_group_id($conn)
{
	$sql =	"SELECT MAX(group_id) FROM Groups";
	
	$result = mysqli_query($conn, $query);
	
	if (!result)
	{
		return FALSE;
	}
	
	return $result;
}


/* create new group id */
function sql_new_group_id($conn)
{
	$old_id = get_max_group_id($conn);
	
	if ($old_id == FALSE)
	{
		return FALSE;
	}
	
	return $old_id + 1;
}



/* use when building the database to initialize the group_id 0 */
function sql_init_group($conn)
{
	$sql = "INSERT INTO Groups (group_id, group_name)
	VALUES ( '0', 'blank')";

	$result = mysqli_query($conn, $query);
	
	if (!$result)
	{
		return FALSE;
	}
	
	return TRUE;
}



/* make group */


function sql_make_group($conn, $groupName, $groupDescrip)
{	
	$group_id = new_group_id($conn);

	$sql = "INSERT INTO Groups (group_id, group_name, group_description) VALUES ( '$group_id', '$groupName', '$groupDescrip')";
	
	$result = mysqli_query($conn, $query);
	
	if (!$result)
	{
		return FALSE;
	}
	
	return TRUE;
}

	

/* get group info*/ 
function sql_get_group_info($conn, $groupID)
{
	$sql = "SELECT group_name, group_description FROM Groups
	WHERE group_id = '$groupID'";
	
	$result = mysqli_query($conn, $query);
	
	if (!$result)
	{
		return FALSE;
	}
	
	return $result;
}



/* request join group */
function sql_group_join_request($conn, $groupID, $userID,  $userApproval, $adminApproval)
{
	$sql = "INSERT INTO Add_Users_Pending (group_id, user_id, user_approval, admin_approval) VALUES ( '$groupID', '$userID', '$userApproval', '$adminApproval')";
	
	$result = mysqli_query($conn, $query);
	
	if (!$result)
	{
		return FALSE;
	}
	
	return TRUE;
}



/* get group request status for a user */
function sql_get_join_request_status($conn, $groupID, $userID)
{
	$sql = "SELECT user_approval, admin_approval FROM Add_Users_Pending WHERE group_id = '$groupID' AND user_id = '$userID'";
	
	$result = mysqli_query($conn, $query);
	
	if (!$result)
	{
		return FALSE;
	}
	
	return $result;
}


/* compete join group */
function sql_join_group($conn, $groupID, $userID)
{
	$sql = "INSERT INTO Group_Users (group_id, user_id, admin_user) VALUES ('$groupID', '$userID', '$userOrAdmin')";
	
	$result = mysqli_query($conn, $query);	
	
	if (!$result)
	{
		return FALSE;
	}
	
	return TRUE;
}


/* leave add user to group pending list */
function sql_leave_group($conn, $groupID, $userID)
{
	$sql = "DELETE FROM Group_Users WHERE group_id = '$groupID' AND user_id '$userID'";
	
	$result = mysqli_query($conn, $query);	
	
	if (!$result)
	{
		return FALSE;
	}
	
	return TRUE;
}


/* leave add user to group pending list */
function sql_leave_group_pending($conn, $groupID, $userID)
{
	$sql = "DELETE FROM Add_Group_Pending WHERE group_id = '$groupID' AND user_id '$userID'";
	
	$result = mysqli_query($conn, $query);	
	
	if (!$result)
	{
		return FALSE;
	}
	
	return TRUE;
}








/* get group members */
function sql_get_group_users($conn, $groupID)
{
	$sql = "SELECT ALL user_id, admin_leader FROM Group_Users WHERE group_id = '$groupID' ORDER BY user_id";
	
	$result = mysqli_query($conn, $query);	
	
	if (!$result)
	{
		return FALSE;
	}
	
	return $result;
}


/* get pending group requests */
function sql_get_group_pending($conn, $userID)
{
	$sql = "SELECT ALL group_id FROM Add_Users_Pending WHERE  user_id = '$userID' ORDER BY group_id";
	
	$result = mysqli_query($conn, $query);
	
	if (!$result)
	{
		return FALSE;
	}
	
	return $result
}

/* get the userIDs f ever admin leader in a group */
function sql_get_all_admins ($conn, $groupID)
{
	$sql = "SELECT ALL user_id FROM Group_Users
	WHERE group_id = '$groupID' AND admin_leader = 'TRUE'";
	
	$result = mysqli_query($conn, $query);	
	
	if (!$result)
	{
		return FALSE;
	}
	
	return $result;
}


/* check if a user is an admin leader for a group */
function sql_is_admin ($conn, $groupID, $userID)
{
	$sql = "SELECT admin_leader FROM Group_Users WHERE group_id = '$groupID' AND user_id = '$userID'";
	
	$result = mysqli_query($conn, $query);
	
	if (!$result)
	{
		return FALSE;
	}
	
	return $result;
}


function sql_num_of_admins ($conn, $groupID)
{
	$sql = "SUM(IF(admin_leader = 'TRUE', 1, 0)) FROM Group_Users WHERE group_id = '$groupID';"
	
	$result = mysqli_query($conn, $query);
	
	if (!$result)
	{
		return FALSE;
	}
	
	return $result;
}



?>