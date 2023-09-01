<?php

function getProductSystemBarcode($ClientId) {

	$dbh = new Db();
	$query = "SELECT ClientCode FROM t_client where ClientId=$ClientId;"; 
	$resultdata = $dbh->query($query);
	$ClientCode = $resultdata[0]["ClientCode"];

	$query = "SELECT IFNULL(MAX(SUBSTRING(SystemBarcode, 5, 8)),0)+1 NextSystemBarcode FROM t_product WHERE ClientId = $ClientId;"; 
	$resultdata = $dbh->query($query);
	$NextSystemBarcode = $resultdata[0]["NextSystemBarcode"];

	$returnData = $ClientCode. str_pad($NextSystemBarcode,8,0,STR_PAD_LEFT);
	
	return $returnData;
}

function getNextInvoiceNumber($ClientId,$BranchId,$TransactionTypeId) {

	$dbh = new Db();

	$query = "SELECT IFNULL(MAX(InvoiceNo),0)+1 NextNo 
	FROM t_transaction 
	WHERE ClientId = $ClientId
	AND BranchId = $BranchId
	AND TransactionTypeId = $TransactionTypeId;"; 
	$resultdata = $dbh->query($query);
	$NextNo = $resultdata[0]["NextNo"];

	return $NextNo;
}
