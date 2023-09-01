<?php

$task = '';
if(isset($data->action)) {
	$task = trim($data->action);
}

switch($task){
	
	case "getDataList":
		$returnData = getDataList($data);
	break;

	default :
		echo "{failure:true}";
		break;
}

function getDataList($data){
	
	$ClientId = trim($data->ClientId); 
	$BranchId = trim($data->BranchId); 
	$ProductGroupId = trim($data->ProductGroupId); 
	// $ProductGroupId = isset($data->ProductGroupId) ? $data->ProductGroupId : 0;
	$ProductGroupId = trim($data->ProductGroupId);


	try{
		$dbh = new Db();
		$query = "SELECT ProductStockId AS id, a.ProductId,b.ProductName, a.Quantity,
		c.GroupName,d.CategoryName, e.GenericName,b.MRP,b.TradePrice,b.SystemBarcode
		FROM t_productstock a
		inner join t_product b on a.ProductId=b.ProductId
		inner join t_productgroup c on b.ProductGroupId=c.ProductGroupId
		inner join t_productcategory d on b.ProductCategoryId=d.ProductCategoryId
		inner join t_productgeneric e on b.ProductGenericId=e.ProductGenericId
		
		where a.ClientId=$ClientId
		and a.BranchId=$BranchId
		and (b.ProductGroupId = $ProductGroupId OR $ProductGroupId=0)
		ORDER BY c.`GroupName` ASC, b.ProductName ASC;";		
		
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

?>