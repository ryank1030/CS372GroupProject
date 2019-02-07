<?php

/* -----basic sql queries for Group Logic Requests---- */

/* --- prototypes ---
	

*/




class GroupSQL
{
	public function max_group_id()
	{
		return "SELECT MAX(group_id) FROM Groups";
	}
	
	public function default_group()
	{
		return "INSERT INTO Groups (group_id, group_name) VALUES ( '0', 'blank')";
	}
	
//	public function create_group($group_id, $group_name, $group_descrip)
	public function create_group($group_name, $group_descrip)
	{
		return "INSERT INTO Groups (group_name, group_description) VALUES ('$group_name', '$group_descrip')";
	}
	
	
	public function get_group($groupID)
	{
		return "SELECT * FROM Groups WHERE group_id = '$groupID'";	
	}
	
	
	public function request_join_group($groupID, $userID, $userApproval, $adminApproval)
	{
		return "INSERT INTO Add_Users_Pending (group_id, user_id, user_approval, admin_approval) VALUES ('$groupID', '$userID', '$userApproval', '$adminApproval')";
	}
	
	
	public function join_group($groupID, $userID, $userOrAdmin)
	{
		return "INSERT INTO Group_Users (group_id, user_id, admin_leader) VALUES ('$groupID', '$userID', '$userOrAdmin')";
	}
	
	
	public function user_join_request_status($groupID, $userID)
	{
		return "SELECT admin_approval FROM Add_Users_Pending WHERE group_id = '$groupID' AND user_id = '$userID'";
	}
	
	
	public function group_join_request_status($groupID, $userID)
	{
		return "SELECT user_approval FROM Add_Users_Pending WHERE group_id = '$groupID' AND user_id = '$userID'";
	}
	
	
	public function approve_user($groupID, $userID)
	{
		return "UPDATE Add_Users_Pending SET admin_approval = TRUE WHERE group_id = '$groupID' AND user_id = '$userID'";
	}
	
	public function approve_group($groupID, $userID)
	{
		return "UPDATE Add_Users_Pending SET user_approval = TRUE WHERE group_id = '$groupID' AND user_id = '$userID'";
	}
	
	
	public function leave_group($groupID, $userID)
	{
		return "DELETE FROM Group_Users WHERE group_id = '$groupID' AND user_id = '$userID'";
	}
	
	
	public function leave_group_pending($groupID, $userID)
	{
		return "DELETE FROM Add_Users_Pending WHERE group_id = '$groupID' AND user_id = '$userID'";
	}
	
	
	public function get_group_users($groupID)
	{
		return "SELECT ALL user_id, admin_leader FROM Group_Users WHERE group_id = '$groupID' ORDER BY user_id";
	}
	
	
	public function get_groups_pending($userID)
	{
		return "SELECT ALL group_id FROM Add_Users_Pending WHERE  user_id = '$userID' ORDER BY group_id";
	}
	
	
	public function get_group_admins($groupID)
	{
		return "SELECT ALL user_id FROM Group_Users WHERE group_id = '$groupID' AND admin_leader = TRUE";
	}
	
	
	public function is_admin($groupID, $userID)
	{
		return "SELECT admin_leader FROM Group_Users WHERE group_id = '$groupID' AND user_id = '$userID'";
	}
	
	
	public function num_of_admins($groupID)
	{
		return "SELECT count(*) FROM Group_Users WHERE group_id = '$groupID' AND admin_leader = TRUE" ;
	}
	
	public function num_of_members($groupID)
	{
		return "SELECT count(*) FROM Group_Users WHERE group_id = '$groupID'";
	}
	
	public function delete_group($groupID)
	{
		return "DELETE FROM Groups WHERE group_id = '$groupID'";
		
	}
	
	
	
	
	
}




?>