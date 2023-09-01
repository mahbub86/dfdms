 
 <?php


function postStock($data){
	$lan = trim($data['lan']);
	$UserId = trim($data['UserId']);
	$ClientId = trim($data['ClientId']);
	$BranchId = trim($data['BranchId']); 
	$TransactionTypeId = trim($data['TransactionTypeId']); 
	$TransactionId = trim($data['TransactionId']);

	$dbh = new Db();

	$sql = "SELECT BPosted,AdjTypeId FROM t_transaction WHERE TransactionId = $TransactionId;";
	$dRow = $dbh->query($sql);
	$BPosted = $dRow[0]['BPosted'];
	$AdjTypeId = $dRow[0]['AdjTypeId'];
	/**If this invoice is already posted then return */
	if ($BPosted === 1) {
		$returnData = array();
		$returnData['msgType'] = 'success';
		$returnData['msg'] = "Invoice Posted Successfully";
		$returnData['id'] = $TransactionId;
		return $returnData;
	}







	$aQuerys = array();
	$IsPositive = 1;
	$StockUpdateErrMsg = "";

	/**TransactionTypeId=3=Adjustment */
	if($TransactionTypeId === 3){
		$sql = "SELECT IsPositive FROM t_adj_type WHERE AdjTypeId = $AdjTypeId;";
		$dRow = $dbh->query($sql);
		$IsPositive = $dRow[0]['IsPositive'];

	}else{
		$sql = "SELECT IsPositive FROM t_transaction_type WHERE TransactionTypeId = $TransactionTypeId;";
		$dRow = $dbh->query($sql);
		$IsPositive = $dRow[0]['IsPositive'];

	}

	$sql = "SELECT a.TransactionItemsId,a.ProductId,c.ProductName, 
	(IFNULL(a.Quantity,0) + IFNULL(a.BonusQty,0)) AS TransQuantity, 
	d.ProductStockId, IFNULL(d.Quantity,0) AS StockQuantity
	FROM t_transactionitems a
	INNER JOIN t_transaction b ON a.TransactionId=b.TransactionId
	INNER JOIN t_product c ON a.ProductId=c.ProductId
	LEFT JOIN t_productstock d ON a.ProductId=d.ProductId AND d.ClientId=1 AND d.BranchId=1
	WHERE a.TransactionId = $TransactionId
	AND (a.Quantity > 0 OR IFNULL(a.BonusQty,0) > 0);";
	$dResult = $dbh->query($sql);

	foreach ($dResult as $row) {

		$ProductId = $row['ProductId'];
		$ProductName = $row['ProductName'];
		$TransQuantity = $row['TransQuantity'];

		$ProductStockId = $row['ProductStockId'];
		$StockQuantity = $row['StockQuantity'];
		
		$Quantity = 0;
		if($IsPositive === 1){
			$Quantity = $StockQuantity + $TransQuantity;
		}else{
			$Quantity = $StockQuantity - $TransQuantity;
		}

		if($Quantity < 0){
			$StockUpdateErrMsg = "Stock will be negative. $ProductName: $Quantity";
		}

		if($ProductStockId === null){
			$q = new insertq();
			$q->table = 't_productstock';
			$q->columns = ['ClientId', 'BranchId', 'ProductId', 'Quantity'];
			$q->values = [$ClientId, $BranchId, $ProductId, $Quantity];
			$q->pks = ['ProductStockId'];
			$q->bUseInsetId = false;
			$q->build_query();
			$aQuerys[] = $q;

		}else{

			$u = new updateq();
			$u->table = 't_productstock';
			$u->columns = ['Quantity'];
			$u->values = [$Quantity];
			$u->pks = ['ProductStockId'];
			$u->pk_values = [$ProductStockId];
			$u->build_query();
			$aQuerys[] = $u;
		}

	}

	$u = new updateq();
	$u->table = 't_transaction';
	$u->columns = ['BPosted'];
	$u->values = [1];
	$u->pks = ['TransactionId'];
	$u->pk_values = [$TransactionId];
	$u->build_query();
	$aQuerys[] = $u;

// 	echo "<pre>";
// print_r($aQuerys);

	if($StockUpdateErrMsg !== ""){
		$returnData = array();
		$returnData['msgType'] = 'fail';
		$returnData['msg'] = $StockUpdateErrMsg;
		$returnData['id'] = $TransactionId;

	}else{
		$returnData = exec_query($aQuerys, $UserId, $lan);

	}


	return $returnData;

}