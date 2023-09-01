<?php
include("global.php");

$task = '';
if(isset($data->action)) {
	$task = trim($data->action);
}

switch($task){
	
	case "ProductGroupList":
		$returnData = ProductGroupList($data);
		break;
	
	case "ProductCategoryList":
		$returnData = ProductCategoryList($data);
		break;
		break;
	
	case "ProductGenericList":
		$returnData = ProductGenericList($data);
		break;
	
	case "SupplierTypeList":
		$returnData = SupplierTypeList($data);
		break;
	
	case "MembershipTypeList":
		$returnData = MembershipTypeList($data);
		break;
	
	case "StrengthList":
		$returnData = StrengthList($data);
		break;
	
	case "ManufacturerList":
		$returnData = ManufacturerList($data);
		break;
	
	case "CountryList":
		$returnData = CountryList($data);
		break;
	
	case "SupplierList":
		$returnData = SupplierList($data);
		break;
	
	case "ClientList":
		$returnData = ClientList($data);
		break;
	
	case "ProductList":
		$returnData = ProductList($data);
		break;
	
	case "NextProductSystemCode":
		$returnData = NextProductSystemCode($data);
		break;
		
	case "NextInvoiceNumber":
		$returnData = NextInvoiceNumber($data);
		break;
		
		
}

// echo json_encode($returnData);
return $returnData;


function ProductGroupList($data) {
	try{
		$ClientId = trim($data->ClientId); 
		// $BranchId = trim($data->BranchId); 

		$dbh = new Db();
		$query = "SELECT ProductGroupId id, GroupName `name` FROM t_productgroup where ClientId=$ClientId ORDER BY GroupName;"; 
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


function ProductCategoryList($data) {
	try{
		$ClientId = trim($data->ClientId); 
		$ProductGroupId = trim($data->ProductGroupId)?trim($data->ProductGroupId):0; 

		$dbh = new Db();
		$query = "SELECT ProductCategoryId id, CategoryName `name` FROM t_productcategory 
		where ClientId=$ClientId 
		and ProductGroupId=$ProductGroupId
		ORDER BY CategoryName;"; 
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


function ProductGenericList($data) {
	try{
		$ClientId = trim($data->ClientId); 
		$ProductGroupId = trim($data->ProductGroupId)?trim($data->ProductGroupId):0; 
		// $ProductCategoryId = trim($data->ProductCategoryId)?trim($data->ProductCategoryId):0; 

		$dbh = new Db();
		$query = "SELECT ProductGenericId id, GenericName `name` FROM t_productgeneric 
		where ClientId=$ClientId 
		and ProductGroupId=$ProductGroupId
		ORDER BY GenericName;"; 
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


function SupplierTypeList($data) {
	try{
		

		$dbh = new Db();
		$query = "SELECT SupplierTypeId id, SupplierType `name` FROM t_suppliertype 
		ORDER BY SupplierTypeId;"; 
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


function MembershipTypeList($data) {
	try{
		

		$dbh = new Db();
		$query = "SELECT MembershipTypeId id, MembershipType `name` FROM t_membershiptype 
		ORDER BY MembershipTypeId;"; 
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


function StrengthList($data) {
	try{
		
		$ClientId = trim($data->ClientId); 

		$dbh = new Db();
		$query = "SELECT StrengthId id, StrengthName `name` FROM t_strength
		where ClientId =$ClientId
		ORDER BY StrengthName;"; 
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


function ManufacturerList($data) {
	try{
		
		$ClientId = trim($data->ClientId); 

		$dbh = new Db();
		$query = "SELECT ManufacturerId id, ManufacturerName `name` FROM t_manufacturer
		where ClientId =$ClientId
		ORDER BY ManufacturerName;"; 
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

function CountryList($data) {
	try{
		

		$dbh = new Db();
		$query = "SELECT CountryId id, CountryName `name` FROM t_country
		ORDER BY CountryName;"; 
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

function SupplierList($data) {
	try{

		$ClientId = trim($data->ClientId);

		$dbh = new Db();
		$query = "SELECT SupplierId id, SupplierName `name` FROM t_supplier
		where ClientId = $ClientId
		ORDER BY SupplierName;"; 
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

function ClientList($data) {
	try{

		$ClientId = trim($data->ClientId);

		$dbh = new Db();
		$query = "SELECT ClientId id, ClientName `name` 
		FROM t_client
		ORDER BY ClientName;"; 
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

function ProductList($data) {
	try{

		$ClientId = trim($data->ClientId);

		$dbh = new Db();
		$query = "SELECT ProductId id, CONCAT(ProductName,' (',SystemBarcode,')') `name`,TradePrice,MRP,SystemBarcode,VatonSales,VatonTrade,SalesDiscountPercentage,SalesDiscountAmount FROM t_product
		where ClientId = $ClientId
		ORDER BY ProductName limit 0,100;"; 
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

function NextProductSystemCode($data) {
	try{

		$ClientId = trim($data->ClientId);
		$NSBarCode = getProductSystemBarcode($ClientId);

		$returnData = [
			"success" => 1,
			"status" => 200,
			"message" => "",
			"datalist" => $NSBarCode
		];

	}catch(PDOException $e){
		$returnData = msg(0,500,$e->getMessage());
	}
	
	return $returnData;
}

function NextInvoiceNumber($data) {
	try{

		$ClientId = trim($data->ClientId);
		$BranchId = trim($data->BranchId);
		$TransactionTypeId = trim($data->TransactionTypeId);
		$InvNo = getNextInvoiceNumber($ClientId,$BranchId,$TransactionTypeId);

		$returnData = [
			"success" => 1,
			"status" => 200,
			"message" => "",
			"datalist" => $InvNo
		];

	}catch(PDOException $e){
		$returnData = msg(0,500,$e->getMessage());
	}
	
	return $returnData;
}
