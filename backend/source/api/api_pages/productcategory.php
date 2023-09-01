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
		$query = "SELECT a.ProductCategoryId AS id,a.ProductGroupId, b.GroupName, a.CategoryName, a.DiscountAmount, a.DiscountPercentage, a.IsActive
		, case when a.IsActive=1 then 'Active' else 'In Active' end IsActiveName
		FROM t_productcategory a
		INNER JOIN t_productgroup b on a.ProductGroupId=b.ProductGroupId
		where a.ClientId=$ClientId
		ORDER BY b.GroupName ASC, a.CategoryName ASC;";		
		
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

		$ProductCategoryId = $data->rowData->id;
		$ProductGroupId = $data->rowData->ProductGroupId;
		$CategoryName = $data->rowData->CategoryName;
		$DiscountAmount = isset($data->rowData->DiscountAmount) && ($data->rowData->DiscountAmount !== "") ? $data->rowData->DiscountAmount : NULL;
		$DiscountPercentage = isset($data->rowData->DiscountPercentage) && ($data->rowData->DiscountPercentage !== "")? $data->rowData->DiscountPercentage : NULL;
		$IsActive = isset($data->rowData->IsActive) ? $data->rowData->IsActive : 0;

		try{

			$dbh = new Db();
			$aQuerys = array();

			if($ProductCategoryId == ""){
				$q = new insertq();
				$q->table = 't_productcategory';
				$q->columns = ['ClientId','ProductGroupId','CategoryName','DiscountAmount','DiscountPercentage','IsActive'];
				$q->values = [$ClientId,$ProductGroupId,$CategoryName,$DiscountAmount,$DiscountPercentage,$IsActive];
				$q->pks = ['ProductCategoryId'];
				$q->bUseInsetId = false;
				$q->build_query();
				$aQuerys = array($q); 
			}else{
				$u = new updateq();
				$u->table = 't_productcategory';
				$u->columns = ['ProductGroupId','CategoryName','DiscountAmount','DiscountPercentage','IsActive'];
				$u->values = [$ProductGroupId,$CategoryName,$DiscountAmount,$DiscountPercentage,$IsActive];
				$u->pks = ['ProductCategoryId'];
				$u->pk_values = [$ProductCategoryId];
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
		
		$ProductCategoryId = $data->rowData->id;
		$lan = trim($data->lan); 
		$UserId = trim($data->UserId); 
		//$ClientId = trim($data->ClientId); 
		//$BranchId = trim($data->BranchId); 

		try{

			$dbh = new Db();
			
            $d = new deleteq();
            $d->table = 't_productcategory';
            $d->pks = ['ProductCategoryId'];
            $d->pk_values = [$ProductCategoryId];
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