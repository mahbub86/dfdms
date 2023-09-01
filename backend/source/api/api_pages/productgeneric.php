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
		$query = "SELECT a.ProductGenericId AS id, a.ProductGroupId, a.GenericName,
		b.GroupName, a.DiscountAmount, a.DiscountPercentage, a.IsActive
		, case when a.IsActive=1 then 'Active' else 'In Active' end IsActiveName
		FROM t_productgeneric a
		inner join t_productgroup b on a.ProductGroupId=b.ProductGroupId
		where a.ClientId=$ClientId
		ORDER BY b.GroupName ASC, a.GenericName ASC;";		
		
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

		$ProductGenericId = $data->rowData->id;
		$ProductGroupId = $data->rowData->ProductGroupId;
		$GenericName = $data->rowData->GenericName;
		$DiscountAmount = isset($data->rowData->DiscountAmount) && ($data->rowData->DiscountAmount !== "") ? $data->rowData->DiscountAmount : NULL;
		$DiscountPercentage = isset($data->rowData->DiscountPercentage) && ($data->rowData->DiscountPercentage !== "")? $data->rowData->DiscountPercentage : NULL;
		$IsActive = isset($data->rowData->IsActive) ? $data->rowData->IsActive : 0;

		try{

			$dbh = new Db();
			$aQuerys = array();

			if($ProductGenericId == ""){
				$q = new insertq();
				$q->table = 't_productgeneric';
				$q->columns = ['ClientId','ProductGroupId','GenericName','DiscountAmount','DiscountPercentage','IsActive'];
				$q->values = [$ClientId,$ProductGroupId,$GenericName,$DiscountAmount,$DiscountPercentage,$IsActive];
				$q->pks = ['ProductGenericId'];
				$q->bUseInsetId = false;
				$q->build_query();
				$aQuerys = array($q); 
			}else{
				$u = new updateq();
				$u->table = 't_productgeneric';
				$u->columns = ['ProductGroupId','GenericName','DiscountAmount','DiscountPercentage','IsActive'];
				$u->values = [$ProductGroupId,$GenericName,$DiscountAmount,$DiscountPercentage,$IsActive];
				$u->pks = ['ProductGenericId'];
				$u->pk_values = [$ProductGenericId];
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
		
		$ProductGenericId = $data->rowData->id;
		$lan = trim($data->lan); 
		$UserId = trim($data->UserId); 
		//$ClientId = trim($data->ClientId); 
		//$BranchId = trim($data->BranchId); 

		try{

			$dbh = new Db();
			
            $d = new deleteq();
            $d->table = 't_productgeneric';
            $d->pks = ['ProductGenericId'];
            $d->pk_values = [$ProductGenericId];
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