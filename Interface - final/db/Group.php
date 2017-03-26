<?php


/* -----basic sql queries for Group Logic requests----
	### all of this is untested and currently in procedural form, This probably doesn't work yet and is heavily subject to change.
	
	Every one of these functions requires the connection to be established, tested, and closed down outside of the function. If there's a connection error or a NULL result, they'll all return FALSE. Do error handling outside.
	
	none of the processing of the returned data has been handled in any of these functions as of yet.
	
	none of the input/output has been sanitized for sql or html at this point, so use at your own risk.
	
*/ 


/*	basic query prototypes for class Group:

	---- Basic getters ----
	get_this_group()
	get_group_id()
	get_group_name()
	get_group_descrip()
	
	---- Basic setters ----
	set_group($group_id_in, $group_name_in, $group_descrip_in)
	set_group_id($group_id_in)
	set_group_name($group_name_in)
	set_group_descrip($group_descrip_in)
	
	----- info retrieval, group, and group users list operations -----
	create_group($conn, $gSql, $group_name_in, $group_descrip_in, $userID)
	get_group_info($conn, $gSql ,$groupID)
	get_group_users($conn, $gSql)
	num_of_members ($conn, $gSql)
	
	group_join_request($conn, $gSql, $groupID, $userID,  $userApproval, $adminApproval)
	user_join_request_status($conn, $gSql, $groupID, $userID)
	group_join_request_status($conn, $gSql, $groupID, $userID)
	join_group($conn, $gSql, $groupID, $userID, $userOrAdmin)
	process_join_requests($conn, $gSql, $groupID, $userID)
	admin_approve_user($conn, $gSql, $userID)
	user_approve_group($conn, $gSql, $userID)
	
	leave_group_pending($conn, $gSql, $userID)
	get_groups_pending($conn, $gSql, $userID)
	
	
	---- admin leader functions ----
	get_group_admins ($conn, $gSql)
	is_admin ($conn, $gSql, $userID)
	num_of_admins ($conn, $gSql)
	kick_user($conn, $gSql, $adminUser, $userID)
	
	---- private functions ----
	delete_group($conn, $gSql)
	leave_group($conn, $gSql, $userID)

	
	---- Leave Group Public Functions ----
	request_leave_group($conn, $gSql, $userID)
	normal_leave_group($conn, $gSql, $userID)
	last_member_leave_group($conn, $gSql, $userID)		//	ALWAYS CALL request_leave_group($conn, $gSql, $userID) before using this, since it deletes the entire group.
	
	- Return Codes For request_leave_group and normal_leave_group (see comments at function code for details):
		-1 = error
		0 = user removed
		1 = only 1 admin, switch admin first
		2 = only 1 group member left, confirm group delete
	
	
	
*/


include_once 'dataAccess.php';
include_once 'groupSQL.php';


// server info class
// note: you may have to pass this into your calls every time you do a server call. Instancing this inside the class didn't work.
if (!defined($conn))
{	
	$conn = new DataAccess;
}



// group sql command variable
// note: you may have to pass this into your calls every time you do a server call. Instancing this inside the class didn't work.
if (!defined($gSql))
{	
	$gSql = new GroupSQL;
}



// class for holding basic group information and operations
class Group
{
	private $group_id;
	private $group_name;
	private $group_description;


	// constructor
	function __construct() 
	{}

	// destructor
	function __destruct() 
	{
		$this->group_id = null;
		$this->group_name = null;
		$this->group_description = null;
	}


	// ---- Basic Getters ----
	
	
	public function get_this_group()
	{
		return $this;
	}
	
	// #works
	public function get_group_id()
	{
		return $this->group_id;
	}
	
	// # works
	public function get_group_name()
	{
		return $this->group_name;
	}
	
	// #works
	public function get_group_descrip()
	{
		return $this->group_description;
	}
	
	
	// ---- Basic Setters ----

	
	// sets a group from the given input
	public function set_group($group_id_in, $group_name_in, $group_descrip_in)
	{
		$this->group_id = $group_id_in;
		$this->group_name = $group_name_in;
		$this->group_description = $group_descrip_in;
	}
	
	public function set_group_id($group_id_in)
	{
		$this->group_id = $group_id_in;
	}
	
	public function set_group_name($group_name_in)
	{
		$this->group_name = $group_name_in;
	}
	
	public function set_group_descrip($group_descrip_in)
	{
		$this->group_description = $group_descrip_in;
	}

	
// ----- info retrieval, group, and group users list operations -----
	
	
	// creates a group with the and adds the current user as its admin leader
	// Precondition: -user_id should be an existing user
	//		- creates a group based off of the inputs currently in $this, use a setter first
	
	// # works
	public function create_group($conn, $gSql, $group_name_in, $group_descrip_in, $userID)
	{	
		// assign the new incoming variables to this instance
		$this->group_name = $group_name_in;
		$this->group_description = $group_descrip_in;
	
		// connect to the server
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;
		}

		// create the group from the info in this class	
		if (!$result2 = mysqli_query($db, $gSql->create_group($this->group_name, $this->group_description)))
		{
			//echo mysqli_error($result2);
			mysqli_close($db);
			return FALSE;
		}

		if (!$result3 = mysqli_query($db, $gSql->max_group_id()))
		{
			return FALSE;
		}
		
		$row = mysqli_fetch_row($result3);		
		$this->group_id = $row[0];

		
		// add in the user as the group admin 
		if(!$result5 = $this->join_group($conn, $gSql, $this->group_id, $userID, TRUE))
		{
			
			echo "group join fail";
			mysqli_close($db);
			return FALSE;
		}	
		
		echo "join succeed";
		
		mysqli_close($db);
		return TRUE;
	}

		
	// get group information from the database based on a group id and sets this instance to 
	// Precondition: $groupID exists
	
	// #works
	public function get_group_info($conn, $gSql ,$groupID)
	{
		
		
				// connect to the server
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;
		}
	
		// query the server for the group info
		if (!$result = mysqli_query($db, $gSql->get_group($groupID)))
		{
			mysqli_close($db);
			return FALSE;
		}
		
		// fill $this with the retrieved data
		while ($row = mysqli_fetch_row($result)) 
		{		
			$this->group_id = $row[0];
			$this->group_name = $row[1];
			$this->group_description = $row[2];
		}
		
		mysqli_close($db);
		return $result;
		
		
	}


	// request join group
	// Preconditions: user exists, group exists
	// 		- don't call this if the user already has a pending group request for this group. always check first.
	
	// #works
	public function group_join_request($conn, $gSql, $groupID, $userID,  $userApproval, $adminApproval)
	{
		
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;
		}
		
		// add to request list
		if (!$result = mysqli_query($db, $gSql->request_join_group($groupID, $userID, $userApproval, $adminApproval)))
		{
			mysqli_close($db);
			return FALSE;
		}

		mysqli_close($db);
		return TRUE;
	}


	// get group request status for a user - user view
	// this returns whether or not a user has admin approval to join a group
	// Preconditions: group and user exists
	// This may return false if either the group doesn't exist, the user doesn't exist, the connection fails or the user doesn't have approval.
	
	// # works
	public function user_join_request_status($conn, $gSql, $groupID, $userID)
	{
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;
		}
		
		
		// get user group join status
		if (!$result = mysqli_query($db, $gSql->user_join_request_status($groupID, $userID)))
		{
			mysqli_close($db);
			return FALSE;
		}
		
		mysqli_close($db);
		
		// process result
		$row = mysqli_fetch_row($result);
		
		return $row[0];
	}


	// get group request status for a user - group view
	// this returns whether or not a user has requested or submitted approval to join a group
	// Preconditions: group and user exists
	// This may return false if either the group doesn't exist, the user doesn't exist, the connection fails or the user doesn't have approval.
	
	// # works
	public function group_join_request_status($conn, $gSql, $groupID, $userID)
	{
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;
		}
		
		
		// get user group join status
		if (!$result = mysqli_query($db, $gSql->group_join_request_status($groupID, $userID)))
		{
			mysqli_close($db);
			return FALSE;
		}
		
		mysqli_close($db);
		
		// process result
		$row = mysqli_fetch_row($result);
		
		return $row[0];
	}
	

	// compete join group
	// do not use this for requesting group membership
	// Precondition: groupID must be for an existing group
	//		- userID must be and existing user
	//	Inputs: $userOrAdmin: 	TRUE = admin leader
	//							FALSE = normal group member
	
	// This doesn't prevent duplicate user entries in the same group
	
	// # Works
	public function join_group($conn, $gSql, $groupID, $userID, $userOrAdmin)
	{
		
		echo "join attempt";
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;	
		}
		
		// add user to group
		if (!$result = mysqli_query($db, $gSql->join_group($groupID, $userID, $userOrAdmin)))
		{
			echo "join fail";
			mysqli_close($db);
			return FALSE;
		}
		
		echo "join succeeed";
		mysqli_close($db);
		return TRUE;
	}
	

	// checks against the Add_Users_Pending table for confirmation from both the user and admin to join a group. If both are confirmed, this will take the user out of the pending list and add them to the group.
	// always call this after adding an accept to the pending request
	// Preconditions: group and user exists, the user has a pending add to group request	
	
//test this	
	public function process_join_requests($conn, $gSql, $groupID, $userID)
	{
		// check if the user has both user and group admin confirmation
		
		if (!(($this->user_join_request_status($conn, $gSql, $groupID, $userID)) && ($this->group_join_request_status($conn, $gSql, $groupID, $userID))))
		{
			return FALSE;
		}
		
		//	add the user to the group
		if (!($this->join_group($conn, $gSql, $groupID, $userID, $userOrAdmin)))
		{
			return FALSE;	// add failed
		}
		
		// remove the user from group pending
		return $this->leave_group_pending($conn, $gSql, $userID);	
	}	
	

	// group admin leader function for approving a user join request for this group.
	// Preconditions: user must exist, $group_id must be set to the group in question
	//		- always check is_admin before calling this
	// Postcondition: always call process_join_requests after calling this
	
	// # works
	public function admin_approve_user($conn, $gSql, $userID)
	{	
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;
		}
		
		// add to request list
		if (!$result = mysqli_query($db, $gSql->approve_user($this->group_id, $userID)))
		{
			mysqli_close($db);
			return FALSE;
		}
		
		mysqli_close($db);
		return TRUE;
	}
	
	
	// requesting user function for approving a group join request for this group.
	// Preconditions: user must exist, $group_id must be set to the group in question
	// Postcondition: always call process_join_requests after calling this
	
	// # works
	public function user_approve_group($conn, $gSql, $userID)
	{	
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;
		}
		
		// add to request list
		if (!$result = mysqli_query($db, $gSql->approve_group($this->group_id, $userID)))
		{
			mysqli_close($db);
			return FALSE;
		}
		
		mysqli_close($db);
		return TRUE;
	}
	
	
	// removes a user from this group
	// Preconditions: - User must exist
	//				- $group_id must be set	
	// Note: don't use this directly in your leave group calls, since this only removes the user from the database but doesn't check if they are an admin or the last member of the group. That's a multiple step operation that requires more user input in some cases.

	// # works
	private function leave_group($conn, $gSql, $userID)
	{		
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;
		}

		// remove the user from the group
		if (!$result = mysqli_query($db, $gSql->leave_group($this->group_id, $userID)))
		{
			mysqli_close($db);
			return FALSE;
		}
		
		mysqli_close($db);
		return TRUE;
	}


	// remove a user from the group pending list for this group
	// Preconditions: - User must exist
	//				- $group_id must be set	
	
	// # works
	public function leave_group_pending($conn, $gSql, $userID)
	{		
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;
		}

		// remove the user from the group
		if (!$result = mysqli_query($db, $gSql->leave_group_pending($this->group_id, $userID)))
		{
			mysqli_close($db);
			return FALSE;
		}
		
		mysqli_close($db);
		return TRUE;
	}


	// returns the user_ids for members of this group, as well as their admin leader status
	//	Precondition: $group_id is set
	// 	Returns: this will return an array which will have to be processed by each row for each group member using mysqli_fetch_row.
	// Postcondition: you'll have to get the user info for each row via the Users class
	
	// # works
	public function get_group_users($conn, $gSql)
	{
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;
		} 
		
		if (!$result = mysqli_query($db, $gSql->get_group_users($this->group_id)))
		{
			mysqli_close($db);
			return FALSE;
		}

		mysqli_close($db);
		return $result;
	}


	// get all group_ids for a user's group pending requests
	//	Precondition: $group_id is set
	// 	Returns: this will return an array which will have to be processed by each row for each group member using mysqli_fetch_row.
	// Postcondition: you'll have to get the user info for each row via the Users class
	
	// # works
	public function get_groups_pending($conn, $gSql, $userID)
	{
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;
		} 
		
		if (!$result = mysqli_query($db, $gSql->get_groups_pending($userID)))
		{
			mysqli_close($db);
			return FALSE;
		}
		
		mysqli_close($db);
		return $result;
	}

		
	// get the userIDs of every admin leader in this group
	// Precondition: $group_id is set
	// 	Returns: this will return an array which will have to be processed by each row for each group member using mysqli_fetch_row.
	// Postcondition: you'll have to get the user info for each row via the Users class
	
	// # works
	public function get_group_admins ($conn, $gSql)
	{
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;
		} 
		
		if (!$result = mysqli_query($db, $gSql->get_group_admins($this->group_id)))
		{
			mysqli_close($db);
			return FALSE;
		}
		
		mysqli_close($db);
		return $result;
	}

	
	// check if a user is an admin leader for this group
	// Precondition: the user is a member of the group
	
	// # works	
	public function is_admin ($conn, $gSql, $userID)
	{
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;
		} 
		
		if (!$result = mysqli_query($db, $gSql->is_admin($this->group_id, $userID)))
		{
			mysqli_close($db);
			return FALSE;
		}
		
		mysqli_close($db);
		
		$row = mysqli_fetch_row($result);
		return $row[0];
	}


	// returns the amount of admin leaders that the group currently has
	// Precondition: The group_id is set to an existing group
	
	// # works
	public function num_of_admins ($conn, $gSql)
	{
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;
		} 
		
		if (!$result = mysqli_query($db, $gSql->num_of_admins($this->group_id)))
		{
			mysqli_close($db);
			return FALSE;
		}
		
		mysqli_close($db);
		
		$row = mysqli_fetch_row($result);
		return $row[0];
	}

	
	// returns the amount of members that this group currently has
	// Precondition: the group exists
	// # works
	public function num_of_members ($conn, $gSql)
	{
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;
		} 
		
		if (!$result = mysqli_query($db, $gSql->num_of_members($this->group_id)))
		{
			mysqli_close($db);
			return FALSE;
		}
		
		mysqli_close($db);
		
		$row = mysqli_fetch_row($result);
		return $row[0];
	}
	
	
	// kicks a user from this group
	// This first checks the current admin user's credentials, then kicks the other user from the group. This will not kick another member
	// Preconditions: $adminUser is one of this group's admin users,
	
	// # works
	public function kick_user($conn, $gSql, $adminUser, $userID)
	{
		
		// prevent the adminUser from kicking themselves
		if ($adminUser == $userID)
		{
			return FALSE;
		}
		
		// check if the $adminUser is an admin leader for this group
		if (!$this->is_admin($conn, $gSql, $adminUser))
		{
			return FALSE;
		}
		
		// prevent the admin from kicking another admin user
		if ($this->is_admin($conn, $gSql, $userID))
		{
			return FALSE;
		}
		
		// kick the user from the group
		return $this->leave_group($conn, $gSql, $userID);
	}
	
	
// ------- Leave Group Functions ------	
	
	// makes a request to the database to leave the group
	// Precondition: User must be a member of this group, group_id must be set
	// Return Codes: -1 = error
	//				0 = user removed
	//				1 = only 1 admin, switch admin first
	//				2 = only 1 group member left, confirm group delete
	
	// # works
	public function request_leave_group($conn, $gSql, $userID)
	{
		// check if the user is an admin
		if($this->is_admin ($conn, $gSql, $userID))
		{
			// user is admin, check the number of admins in the group
			if($this->num_of_admins ($conn, $gSql, $groupID) == 1)
			{
				// there's only 1 admin, check the number of members left in the group
				if($this->num_of_members ($conn, $gSql, $groupID) == 1)
				{
					// The admin is the only group member left, so they need to confirm that they want the group deleted, otherwise they can't leave. Send this to the UI.
					return 2;
				}
				
				else
				{
					// The group has multiple members, but another user must be made an admin leader before this user can leave the group. Send this to the UI.
					return 1;
				}
			}
		}
		
		// remove the user from the group
		return $this->normal_leave_group($conn, $gSql, $userID);
	}
	
	
	// removes a user from a group
	// Use this instead of leave_group for finishing leave group requests. This does the same thing but gives different return codes, which works better with request_leave_group. 
	// Call in the case where an admin assigns a new admin another group to remove themselves from the group.
	// Precondition: User must be a member of this group, group_id must be set
	// Return Codes: -1 = error
	//				0 = user removed
	
	// # works
	public function normal_leave_group($conn, $gSql, $userID)
	{
		// user leaves group
		if (!$this->leave_group($conn, $gSql, $userID))
		{
			return -1;	// error removing user from group
		}	
		
		return 0;
	}
	

	// Removes a member from a group and deletes the group.
	// Only use this when there is only one user left in the group.
	// Preconditions: this group exists and the user is the group admin leader
	//	ALWAYS CALL request_leave_group($conn, $gSql, $userID) before using this, since it deletes the entire group.	
	
	// # works
	public function last_member_leave_group($conn, $gSql, $userID)
	{
				// user leaves group
		if (!$this->leave_group($conn, $gSql, $userID))
		{
			return FALSE;	// error removing user from group
		}	
		
		return $this->delete_group($conn, $gSql);
	}
	
		
	// deletes this group from the database
	// Precondition: group exists
	
	// *** DO NOT USE THIS DIRECTLY. Always call through another function and check the admin level of the user calling it and the number of users in the group before deleting it! This will wipe the group, it's member tables, calendar and chat via cascade.
	
	// # works	
	private function delete_group($conn, $gSql)
	{
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return FALSE;
		} 
		
		if (!$result = mysqli_query($db, $gSql->delete_group($this->group_id)))
		{
			mysqli_close($db);
			return FALSE;
		}
		
		mysqli_close($db);
		return TRUE;		
	}
}



?>