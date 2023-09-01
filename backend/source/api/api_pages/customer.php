<?php

$task = '';
if(isset($data->action)) {
	$task = trim($data->action);
}

switch($task){
	
	case "getDataList":
		$returnData = getDataList($data);
	break;

	case "dataAddEdit":
		$returnData = dataAddEdit($data);
	break;
	
	case "deleteData":
		$returnData = deleteData($data);
	break;

	default :
		echo "{failure:true}";
		break;
}

function getDataList($data){

	
	$ClientId = trim($data->ClientId); 
	//$BranchId = trim($data->BranchId); 

	try{
		$dbh = new Db();
		$query = "SELECT a.CustomerId AS id, a.CustomerName, a.MembershipTypeId, b.MembershipType, a.Address, 
		a.Email, a.ContactPhone, a.IsActive
		, case when a.IsActive=1 then 'Active' else 'In Active' end IsActiveName
		FROM t_customer a
		INNER JOIN t_membershiptype b on a.MembershipTypeId=b.MembershipTypeId
		where a.ClientId=$ClientId
		ORDER BY a.CustomerName ASC;";		
		
		$resultdata = $dbh->query($query);
		
		$returnData = [
			"success" => 1,
			"status" => 200,
			"message" => "",
			"datalist" => $resultdata
		];

	}catch(PDOException $e){
		$returnData = msg(0,500,$e->getMessage());
	}
	
	return $returnData;
}



function dataAddEdit($data) {

	if($_SERVER["REQUEST_METHOD"] != "POST"){
		return $returnData = msg(0,404,'Page Not Found!');
	}else{
		
		
		$lan = trim($data->lan); 
		$UserId = trim($data->UserId); 
		$ClientId = trim($data->ClientId); 
		//$BranchId = trim($data->BranchId); 

		$CustomerId = $data->rowData->id;
		$CustomerName = $data->rowData->CustomerName;
		$MembershipTypeId = $data->rowData->MembershipTypeId;
		$Address = isset($data->rowData->Address) && ($data->rowData->Address !== "") ? $data->rowData->Address : NULL;
		$Email = isset($data->rowData->Email) && ($data->rowData->Email !== "")? $data->rowData->Email : NULL;
		$ContactPhone = isset($data->rowData->ContactPhone) && ($data->rowData->ContactPhone !== "")? $data->rowData->ContactPhone : NULL;
		$IsActive = isset($data->rowData->IsActive) ? $data->rowData->IsActive : 0;

		try{

			$dbh = new Db();
			$aQuerys = array();

			if($CustomerId == ""){
				$q = new insertq();
				$q->table = 't_customer';
				$q->columns = ['ClientId','CustomerName','MembershipTypeId','Address','Email','ContactPhone','IsActive'];
				$q->values = [$ClientId,$CustomerName,$MembershipTypeId,$Address,$Email,$ContactPhone,$IsActive];
				$q->pks = ['CustomerId'];
				$q->bUseInsetId = false;
				$q->build_query();
				$aQuerys = array($q); 
			}else{
				$u = new updateq();
				$u->table = 't_customer';
				$u->columns = ['CustomerName','MembershipTypeId','Address','Email','ContactPhone','IsActive'];
				$u->values = [$CustomerName,$MembershipTypeId,$Address,$Email,$ContactPhone,$IsActive];
				$u->pks = ['CustomerId'];
				$u->pk_values = [$CustomerId];
				$u->build_query();
				$aQuerys = array($u);
			}
			
			$res = exec_query($aQuerys, $UserId, $lan);  
			$success=($res['msgType']=='success')?1:0;
			$status=($res['msgType']=='success')?200:500;

			$returnData = [
			    "success" => $success ,
				"status" => $status,
				"UserId"=> $UserId,
				"message" => $res['msg']
			];

		}catch(PDOException $e){
			$returnData = msg(0,500,$e->getMessage());
		}
		
		return $returnData;
	}
}


function deleteData($data) {
 
	if($_SERVER["REQUEST_METHOD"] != "POST"){
		return $returnData = msg(0,404,'Page Not Found!');
	}
	// CHECKING EMPTY FIELDS
	elseif(!isset($data->rowData->id)){
		$fields = ['fields' => ['id']];
		return $returnData = msg(0,422,'Please Fill in all Required Fields!',$fields);
	}else{
		
		$CustomerId = $data->rowData->id;
		$lan = trim($data->lan); 
		$UserId = trim($data->UserId); 
		//$ClientId = trim($data->ClientId); 
		//$BranchId = trim($data->BranchId); 

		try{

			$dbh = new Db();
			
            $d = new deleteq();
            $d->table = 't_customer';
            $d->pks = ['CustomerId'];
            $d->pk_values = [$CustomerId];
            $d->build_query();
            $aQuerys = array($d);

			$res = exec_query($aQuerys, $UserId, $lan);  
			$success=($res['msgType']=='success')?1:0;
			$status=($res['msgType']=='success')?200:500;

			$returnData = [
				"success" => $success ,
				"status" => $status,
				"UserId"=> $UserId,
				"message" => $res['msg']
			];
			
		}catch(PDOException $e){
			$returnData = msg(0,500,$e->getMessage());
		}
		
		return $returnData;
	}
}


?>