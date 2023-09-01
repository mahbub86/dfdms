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
		$query = "SELECT a.ProductId AS id, a.ClientId, a.ProductGroupId, a.ProductCategoryId, a.ProductGenericId, 
		a.ManufacturerId, a.StrengthId, a.ProductShortName, a.ProductName, a.CountryId, a.BoxSize, a.TradePrice, 
		a.MRP, a.SystemBarcode, a.ProductBarcode, a.VatonSales, a.VatonTrade, 
		a.SalesDiscountPercentage, a.SalesDiscountAmount, a.OrderLevel, a.MinOderdQty, a.MaxOderdQty
		,b.GroupName, c.CategoryName, d.GenericName, e.CountryName,f.ManufacturerName, a.IsActive
		, case when a.IsActive=1 then 'Active' else 'In Active' end IsActiveName
		FROM t_product a
		inner join t_productgroup b on a.ProductGroupId=b.ProductGroupId
		INNER JOIN t_productcategory c on a.ProductCategoryId=c.ProductCategoryId
		inner join t_productgeneric d on a.ProductGenericId=d.ProductGenericId
		inner join t_country e on a.CountryId=e.CountryId
		inner join t_manufacturer f on a.ManufacturerId=f.ManufacturerId
		where a.ClientId=$ClientId
		ORDER BY a.ProductName ASC;";		
		
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

		$ProductId = $data->rowData->id;
		$ProductGroupId = $data->rowData->ProductGroupId;
		$ProductCategoryId = $data->rowData->ProductCategoryId;
		$ProductGenericId = $data->rowData->ProductGenericId;
		$ManufacturerId = $data->rowData->ManufacturerId;
		$StrengthId = $data->rowData->StrengthId;
		$ProductShortName = $data->rowData->ProductShortName;
		$ProductName = $data->rowData->ProductName;
		$CountryId = $data->rowData->CountryId;
		$BoxSize = isset($data->rowData->BoxSize) && ($data->rowData->BoxSize !== "") ? $data->rowData->BoxSize : NULL;
		$TradePrice = isset($data->rowData->TradePrice) && ($data->rowData->TradePrice !== "")? $data->rowData->TradePrice : NULL;
		$MRP = isset($data->rowData->MRP) && ($data->rowData->MRP !== "")? $data->rowData->MRP : NULL;
		$SystemBarcode = isset($data->rowData->SystemBarcode) && ($data->rowData->SystemBarcode !== "")? $data->rowData->SystemBarcode : NULL;
		$ProductBarcode = isset($data->rowData->ProductBarcode) && ($data->rowData->ProductBarcode !== "")? $data->rowData->ProductBarcode : NULL;
		$VatonSales = isset($data->rowData->VatonSales) && ($data->rowData->VatonSales !== "")? $data->rowData->VatonSales : NULL;
		$VatonTrade = isset($data->rowData->VatonTrade) && ($data->rowData->VatonTrade !== "")? $data->rowData->VatonTrade : NULL;
		$SalesDiscountPercentage = isset($data->rowData->SalesDiscountPercentage) && ($data->rowData->SalesDiscountPercentage !== "")? $data->rowData->SalesDiscountPercentage : NULL;
		$SalesDiscountAmount = isset($data->rowData->SalesDiscountAmount) && ($data->rowData->SalesDiscountAmount !== "")? $data->rowData->SalesDiscountAmount : NULL;
		$OrderLevel = isset($data->rowData->OrderLevel) && ($data->rowData->OrderLevel !== "")? $data->rowData->OrderLevel : NULL;
		$MinOderdQty = isset($data->rowData->MinOderdQty) && ($data->rowData->MinOderdQty !== "")? $data->rowData->MinOderdQty : NULL;
		$MaxOderdQty = isset($data->rowData->MaxOderdQty) && ($data->rowData->MaxOderdQty !== "")? $data->rowData->MaxOderdQty : NULL;
		$IsActive = isset($data->rowData->IsActive) ? $data->rowData->IsActive : 0;

		try{

			$dbh = new Db();
			$aQuerys = array();

			if($ProductId == ""){
				$q = new insertq();
				$q->table = 't_product';
				$q->columns = ['ClientId', 'ProductGroupId', 'ProductCategoryId', 'ProductGenericId', 'ManufacturerId', 'StrengthId', 'ProductShortName', 'ProductName', 'CountryId', 'BoxSize', 'TradePrice', 'MRP', 'SystemBarcode', 'ProductBarcode', 'VatonSales', 'VatonTrade', 'SalesDiscountPercentage', 'SalesDiscountAmount', 'OrderLevel', 'MinOderdQty', 'MaxOderdQty', 'IsActive'];
				$q->values = [$ClientId,$ProductGroupId,$ProductCategoryId,$ProductGenericId,$ManufacturerId,$StrengthId,$ProductShortName,$ProductName,$CountryId,$BoxSize,$TradePrice,$MRP,$SystemBarcode,$ProductBarcode,$VatonSales,$VatonTrade,$SalesDiscountPercentage,$SalesDiscountAmount,$OrderLevel,$MinOderdQty,$MaxOderdQty,$IsActive];
				$q->pks = ['ProductId'];
				$q->bUseInsetId = false;
				$q->build_query();
				$aQuerys = array($q); 
			}else{
				$u = new updateq();
				$u->table = 't_product';
				$u->columns = ['ProductGroupId', 'ProductCategoryId', 'ProductGenericId', 'ManufacturerId', 'StrengthId', 'ProductShortName', 'ProductName', 'CountryId', 'BoxSize', 'TradePrice', 'MRP', 'SystemBarcode', 'ProductBarcode', 'VatonSales', 'VatonTrade', 'SalesDiscountPercentage', 'SalesDiscountAmount', 'OrderLevel', 'MinOderdQty', 'MaxOderdQty', 'IsActive'];
				$u->values = [$ProductGroupId,$ProductCategoryId,$ProductGenericId,$ManufacturerId,$StrengthId,$ProductShortName,$ProductName,$CountryId,$BoxSize,$TradePrice,$MRP,$SystemBarcode,$ProductBarcode,$VatonSales,$VatonTrade,$SalesDiscountPercentage,$SalesDiscountAmount,$OrderLevel,$MinOderdQty,$MaxOderdQty,$IsActive];
				$u->pks = ['ProductId'];
				$u->pk_values = [$ProductId];
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
		
		$ProductId = $data->rowData->id;
		$lan = trim($data->lan); 
		$UserId = trim($data->UserId); 
		//$ClientId = trim($data->ClientId); 
		//$BranchId = trim($data->BranchId); 

		try{

			$dbh = new Db();
			
            $d = new deleteq();
            $d->table = 't_product';
            $d->pks = ['ProductId'];
            $d->pk_values = [$ProductId];
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