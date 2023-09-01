<?php
/*
$task = '';
if(isset($data->action)) {
	$task = trim($data->action);
}

switch($task){

    case "getUser":
		$returnData = getUser($data);
		break;
	
    case "dataUpdate":
		$returnData = dataUpdate($data);
		break;


	default :
		echo "{failure:true}";
		break;
}


function getSingleUserList($userId) {
	
	$dbh = new Db();		
	$query = "SELECT *
		FROM users 
		WHERE `id` =".$userId."  ;"; 
	$data = $dbh->query($query);
	return $data; 
}

//Use For User Entry Page
function dataUpdate($data) {
	
	if($_SERVER["REQUEST_METHOD"] != "PUT"){
		return $returnData = msg(0,404,'Page Not Found!');
	}
	// CHECKING EMPTY FIELDS
	elseif(!isset($data->name) 
		|| !isset($data->email) 
		|| !isset($data->designation) 
		|| !isset($data->LangCode)
		|| !isset($data->role_id)
		|| !isset($data->loginname)
	){
		$fields = ['fields' => ['name','email', 'designation', 'LangCode', 'role_id', 'loginname']];
		return $returnData = msg(0,422,'Please Fill in all Required Fields!', $fields);
	
	}else{



		$user_id = trim($data->user_id);
		
		$name = trim($data->name);
		$email = trim($data->email);
		$designation = trim($data->designation);
		$LangCode = trim($data->LangCode);
		$role_id = trim($data->role_id);
		$loginname = trim($data->loginname);
        $oldUserData=getSingleUserList($user_id);
		$switchUserData=0;
        if($oldUserData[0]['LangCode']!=$LangCode)
		 $switchUserData=1;

		$lan = trim($data->lan); 
		$UserName = trim($data->UserName);	
		$Cpassword =  empty($data->password) ?  '':$data->password;		


		try{
 
			$dbh = new Db();
			$aQuerys = array();
			$u = new updateq();
            $u->table = 'users';

		 
			if($Cpassword != ''){
				//if(isset($data->password)){
				$pass_word = trim($data->password);
				$password = password_hash($pass_word, PASSWORD_DEFAULT);
				
				$u->columns = ['name','email','password','designation','LangCode','loginname'];
				$u->values = [$name, $email, $password, $designation, $LangCode, $loginname];
			}else{
				$u->columns = ['name','email','designation','LangCode','loginname'];
				$u->values = [$name, $email, $designation, $LangCode, $loginname];
			}

            $u->pks = ['id'];
            $u->pk_values = [$user_id];
            $u->build_query();
            $aQuerys[]= $u;
			
			$res = exec_query($aQuerys, $UserName, $lan);  
			$success=($res['msgType']=='success')?1:0;
			$status=($res['msgType']=='success')?200:500; 
		 
			if($res['msgType']=='success')
			$returnData = [
				"success" => $success ,
				"status" => $status,
				"FacilityId" => $FacilityId,
				"UserId" => $user_id,
				"LangCode" => $LangCode,
				"switchUserData" => $switchUserData,  			
				"UserName"=> $UserName,
				"message" => $res['msg']
	
				
			];
			else 
			$returnData = [
				"success" => $success ,
				"status" => $status,
				"UserName"=> $UserName,
				"message" => $res['msg']
			];

		}catch(PDOException $e){
			$returnData = msg(0,500,$e->getMessage());
		}
		
		return $returnData;
	}
}

//Use For User Entry Page
function getUser($data) {

	$dbh = new Db();

	$id = trim($data->id);
  
	$query = "SELECT  a.id, a.`name`, a.`loginname`, a.`email`, a.`designation`, 
	a.`LangCode`, b.role_id, a.IsActive, a.FacilityId
	FROM `users` a 
	LEFT JOIN user_role b ON a.id = b.user_id
	WHERE a.id = $id;"; 

	$returnData = $dbh->query($query);

	return $returnData[0];
}
*/
?>