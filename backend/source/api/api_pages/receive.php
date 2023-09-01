<?php
include("posttransaction.php");

$task = '';
if (isset($data->action)) {
	$task = trim($data->action);
}

switch ($task) {

	case "getDataList":
		$returnData = getDataList($data);
		break;

	case "getDataSingle":
		$returnData = getDataSingle($data);
		break;

	case "dataAddEdit":
		$returnData = dataAddEdit($data);
		break;

	case "deleteData":
		$returnData = deleteData($data);
		break;

	default:
		echo "{failure:true}";
		break;
}

function getDataList($data)
{
	$ClientId = trim($data->ClientId);
	$BranchId = trim($data->BranchId);
	$TransactionTypeId = trim($data->TransactionTypeId);

	try {
		$dbh = new Db();

		$query = "SELECT a.`TransactionId` AS id, a.`TransactionDate`, a.`InvoiceNo`, a.`SupplierId`,b.SupplierName,
		a.`ChallanNo`, a.`BPosted`, a.`Remarks`, a.`ImageUrl`, a.`SumSubTotalAmount`, a.`SumVatAmount`, a.`SumDiscountAmount`, 
		a.`SumTotalAmount`, a.`SumCommission`, a.`NetPaymentAmount`, 
		case when a.BPosted=1 then 'Posted' else 'Draft' end StatusName
		FROM t_transaction a
		INNER JOIN t_supplier b on a.SupplierId=b.SupplierId
		where a.ClientId=$ClientId
		and a.BranchId=$BranchId
		and a.TransactionTypeId=$TransactionTypeId
		ORDER BY a.TransactionDate DESC, a.`InvoiceNo` DESC;";

		$resultdata = $dbh->query($query);

		$returnData = [
			"success" => 1,
			"status" => 200,
			"message" => "",
			"datalist" => $resultdata
		];
	} catch (PDOException $e) {
		$returnData = msg(0, 500, $e->getMessage());
	}

	return $returnData;
}



function getDataSingle($data)
{
	$TransactionId = trim($data->id);
	// $ClientId = trim($data->ClientId); 
	// $BranchId = trim($data->BranchId); 
	// $TransactionTypeId = trim($data->TransactionTypeId); 

	try {
		$dbh = new Db();

		/**Master Data */
		$query = "SELECT `TransactionId` AS id, `ClientId`, `BranchId`, `TransactionTypeId`, `TransactionDate`, `InvoiceNo`,
		 `SupplierId`, `ChallanNo`, `BPosted`, `Remarks`, `ImageUrl`, `SumSubTotalAmount`, `SumVatAmount`, `SumDiscountAmount`, 
		 `SumTotalAmount`,  `SumCommission`, `NetPaymentAmount`
		FROM t_transaction
		where TransactionId=$TransactionId;";
		$resultdataMaster = $dbh->query($query);

		/**Items Data */
		$query = "SELECT a.TransactionItemsId as autoId,a.`TransactionItemsId`, a.`TransactionId`, a.`ProductId`,b.ProductName, a.`Quantity`, 
		a.`BonusQty`, a.`TradePrice`, a.`VatonTrade`, a.`MRP`, a.`OrderQty`, a.`MfgDate`, a.`ExpDate`, a.`VatAmount`, 
		a.`DiscountPercentage`, a.`DiscountAmount`, a.`SubTotalAmount`, a.`NewCost`, a.`Commission`, a.`TotalAmount`
		FROM t_transactionitems a
		inner join t_product b on a.ProductId=b.ProductId
		where a.TransactionId=$TransactionId
		order by a.TransactionItemsId ASC;";
		$resultdataItems = $dbh->query($query);


		$returnData = [
			"success" => 1,
			"status" => 200,
			"message" => "",
			"datalist" => array("master" => $resultdataMaster, "items" => $resultdataItems)
		];
	} catch (PDOException $e) {
		$returnData = msg(0, 500, $e->getMessage());
	}

	return $returnData;
}



function dataAddEdit($data)
{

	if ($_SERVER["REQUEST_METHOD"] != "POST") {
		return $returnData = msg(0, 404, 'Page Not Found!');
	} else {

		try {

			$dbh = new Db();

			$data = $data->params;
			$lan = trim($data->lan);
			$UserId = trim($data->UserId);
			$ClientId = trim($data->ClientId);
			$BranchId = trim($data->BranchId);

			$InvoiceMaster = isset($data->InvoiceMaster) ? ($data->InvoiceMaster) : [];
			$InvoiceItems = isset($data->InvoiceItems) ? ($data->InvoiceItems) : [];
			$DeletedItems = isset($data->DeletedItems) ? ($data->DeletedItems) : [];

			$TransactionId = $InvoiceMaster->id;
			$TransactionTypeId = $InvoiceMaster->TransactionTypeId;
			$TransactionDate = $InvoiceMaster->TransactionDate;
			$InvoiceNo = $InvoiceMaster->InvoiceNo;
			$SupplierId = $InvoiceMaster->SupplierId;
			$ChallanNo = isset($InvoiceMaster->ChallanNo) && ($InvoiceMaster->ChallanNo !== "") ? $InvoiceMaster->ChallanNo : NULL;
			$BPosted = $InvoiceMaster->BPosted;
			$Remarks = isset($InvoiceMaster->Remarks) && ($InvoiceMaster->Remarks !== "") ? $InvoiceMaster->Remarks : NULL;
			$ImageUrl = isset($InvoiceMaster->ImageUrl) && ($InvoiceMaster->ImageUrl !== "") ? $InvoiceMaster->ImageUrl : NULL;

			$SumSubTotalAmount = isset($InvoiceMaster->SumSubTotalAmount) && ($InvoiceMaster->SumSubTotalAmount !== "") ? $InvoiceMaster->SumSubTotalAmount : 0;
			$SumVatAmount = isset($InvoiceMaster->SumVatAmount) && ($InvoiceMaster->SumVatAmount !== "") ? $InvoiceMaster->SumVatAmount : NULL;
			$SumDiscountAmount = isset($InvoiceMaster->SumDiscountAmount) && ($InvoiceMaster->SumDiscountAmount !== "") ? $InvoiceMaster->SumDiscountAmount : NULL;
			$SumTotalAmount = isset($InvoiceMaster->SumTotalAmount) && ($InvoiceMaster->SumTotalAmount !== "") ? $InvoiceMaster->SumTotalAmount : 0;
			$SumCommission = isset($InvoiceMaster->SumCommission) && ($InvoiceMaster->SumCommission !== "") ? $InvoiceMaster->SumCommission : NULL;
			$NetPaymentAmount = isset($InvoiceMaster->NetPaymentAmount) && ($InvoiceMaster->NetPaymentAmount !== "") ? $InvoiceMaster->NetPaymentAmount : 0;


			$aQuerys = array();

			/**Invoice Master */
			if ($TransactionId === "") {
				$q = new insertq();
				$q->table = 't_transaction';
				$q->columns = ['ClientId', 'BranchId', 'TransactionTypeId', 'TransactionDate', 'InvoiceNo', 'SupplierId', 'ChallanNo', 'Remarks', 'ImageUrl', 'SumSubTotalAmount', 'SumVatAmount', 'SumDiscountAmount', 'SumTotalAmount', 'SumCommission', 'NetPaymentAmount'];
				$q->values = [$ClientId, $BranchId, $TransactionTypeId, $TransactionDate, $InvoiceNo, $SupplierId, $ChallanNo, $Remarks, $ImageUrl, $SumSubTotalAmount, $SumVatAmount, $SumDiscountAmount, $SumTotalAmount, $SumCommission, $NetPaymentAmount];
				$q->pks = ['TransactionId'];
				$q->bUseInsetId = true;
				$q->build_query();
				$aQuerys[] = $q;
			} else {
				$u = new updateq();
				$u->table = 't_transaction';
				$u->columns = ['TransactionDate', 'InvoiceNo', 'SupplierId', 'ChallanNo', 'Remarks', 'ImageUrl', 'SumSubTotalAmount', 'SumVatAmount', 'SumDiscountAmount', 'SumTotalAmount', 'SumCommission', 'NetPaymentAmount'];
				$u->values = [$TransactionDate, $InvoiceNo, $SupplierId, $ChallanNo, $Remarks, $ImageUrl, $SumSubTotalAmount, $SumVatAmount, $SumDiscountAmount, $SumTotalAmount, $SumCommission, $NetPaymentAmount];
				$u->pks = ['TransactionId'];
				$u->pk_values = [$TransactionId];
				$u->build_query();
				$aQuerys[] = $u;
			}


			/**Delete many items */
			foreach ($DeletedItems as $key => $Many) {
				$TransactionItemsId = $Many->TransactionItemsId;
				if ($TransactionItemsId !== "") {
					//TransactionItemsId not blank means this item has in DB.

					$d = new deleteq();
					$d->table = 't_transactionitems';
					$d->pks = ['TransactionItemsId'];
					$d->pk_values = [$TransactionItemsId];
					$d->build_query();
					$aQuerys[] = $d;
				}
			}

			/**Invoice Items */
			foreach ($InvoiceItems as $key => $Many) {

				$TransactionItemsId = $Many->TransactionItemsId;
				$ProductId = $Many->ProductId;
				$Quantity = isset($Many->Quantity) && ($Many->Quantity !== "") ? $Many->Quantity : 0;
				$BonusQty = isset($Many->BonusQty) && ($Many->BonusQty !== "") ? $Many->BonusQty : null;
				$TradePrice = isset($Many->TradePrice) && ($Many->TradePrice !== "") ? $Many->TradePrice : null;
				$VatonTrade = isset($Many->VatonTrade) && ($Many->VatonTrade !== "") ? $Many->VatonTrade : null;
				$MRP = isset($Many->MRP) && ($Many->MRP !== "") ? $Many->MRP : null;
				$OrderQty = isset($Many->OrderQty) && ($Many->OrderQty !== "") ? $Many->OrderQty : NULL;
				$MfgDate = isset($Many->MfgDate) && ($Many->MfgDate !== "") ? $Many->MfgDate : NULL;
				$ExpDate = isset($Many->ExpDate) && ($Many->ExpDate !== "") ? $Many->ExpDate : NULL;
				$VatAmount = isset($Many->VatAmount) && ($Many->VatAmount !== "") ? $Many->VatAmount : null;
				$DiscountPercentage = isset($Many->DiscountPercentage) && ($Many->DiscountPercentage !== "") ? $Many->DiscountPercentage : null;
				$DiscountAmount = isset($Many->DiscountAmount) && ($Many->DiscountAmount !== "") ? $Many->DiscountAmount : null;
				$SubTotalAmount = isset($Many->SubTotalAmount) && ($Many->SubTotalAmount !== "") ? $Many->SubTotalAmount : 0;
				$NewCost = isset($Many->NewCost) && ($Many->NewCost !== "") ? $Many->NewCost : null;
				$Commission = isset($Many->Commission) && ($Many->Commission !== "") ? $Many->Commission : null;
				$TotalAmount = isset($Many->TotalAmount) && ($Many->TotalAmount !== "") ? $Many->TotalAmount : 0;

				if ($TransactionItemsId === "") {

					if ($TransactionId === "") {
						$ididid = "[LastInsertedId]";
					} else {
						$ididid = $TransactionId;
					}

					$q = new insertq();
					$q->table = 't_transactionitems';
					$q->columns = ['TransactionId', 'ProductId', 'Quantity', 'BonusQty', 'TradePrice', 'VatonTrade', 'MRP', 'OrderQty', 'MfgDate', 'ExpDate', 'VatAmount', 'DiscountPercentage', 'DiscountAmount', 'SubTotalAmount', 'NewCost', 'Commission', 'TotalAmount'];
					$q->values = [$ididid, $ProductId, $Quantity, $BonusQty, $TradePrice, $VatonTrade, $MRP, $OrderQty, $MfgDate, $ExpDate, $VatAmount, $DiscountPercentage, $DiscountAmount, $SubTotalAmount, $NewCost, $Commission, $TotalAmount];
					$q->pks = ['TransactionItemsId'];
					$q->bUseInsetId = false;
					$q->build_query();
					$aQuerys[] = $q;
				} else {
					$u = new updateq();
					$u->table = 't_transactionitems';
					$u->columns = ['ProductId', 'Quantity', 'BonusQty', 'TradePrice', 'VatonTrade', 'MRP', 'OrderQty', 'MfgDate', 'ExpDate', 'VatAmount', 'DiscountPercentage', 'DiscountAmount', 'SubTotalAmount', 'NewCost', 'Commission', 'TotalAmount'];
					$u->values = [$ProductId, $Quantity, $BonusQty, $TradePrice, $VatonTrade, $MRP, $OrderQty, $MfgDate, $ExpDate, $VatAmount, $DiscountPercentage, $DiscountAmount, $SubTotalAmount, $NewCost, $Commission, $TotalAmount];
					$u->pks = ['TransactionItemsId'];
					$u->pk_values = [$TransactionItemsId];
					$u->build_query();
					$aQuerys[] = $u;
				}
			}


			$res = exec_query($aQuerys, $UserId, $lan);

			if ($res['msgType'] === 'success' && $BPosted === 1) {
				/**When POST */
				$TransactionId = ($TransactionId === "" ? $res["id"] : $TransactionId);
				$p = array(
					"lan" => $lan, 
					"UserId" => $UserId, 
					"ClientId" => $ClientId,
					"BranchId" => $BranchId, 
					"TransactionTypeId" => $TransactionTypeId,
					"TransactionId" => $TransactionId
				);
				$res1 = postStock($p);
				// echo "<pre>";
				// print_r($res1 );

				$success = ($res1['msgType'] === 'success') ? 1 : 0;
				$status = ($res1['msgType'] === 'success') ? 200 : 500;

				$returnData = [
					"success" => $success,
					"status" => $status,
					"id" => $res['id'],
					"message" => "Invoice Posted Successfully" //$res1['msg']
				];
				
			} else {
				/**When add/edit except POST */

				$success = ($res['msgType'] === 'success') ? 1 : 0;
				$status = ($res['msgType'] === 'success') ? 200 : 500;
				$returnData = [
					"success" => $success,
					"status" => $status,
					"id" => $res['id'],
					"message" => $res['msg']
				];
			}





		} catch (PDOException $e) {
			$returnData = msg(0, 500, $e->getMessage());
		}

		return $returnData;
	}
}

function deleteData($data)
{

	if ($_SERVER["REQUEST_METHOD"] != "POST") {
		return $returnData = msg(0, 404, 'Page Not Found!');
	}
	// CHECKING EMPTY FIELDS
	elseif (!isset($data->rowData->id)) {
		$fields = ['fields' => ['id']];
		return $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
	} else {

		$TransactionId = $data->rowData->id;
		$lan = trim($data->lan);
		$UserId = trim($data->UserId);
		//$ClientId = trim($data->ClientId); 
		//$BranchId = trim($data->BranchId); 

		try {

			$dbh = new Db();

			$aQuerys = array();


			$d = new deleteq();
			$d->table = 't_transactionitems';
			$d->pks = ['TransactionId'];
			$d->pk_values = [$TransactionId];
			$d->build_query();
			$aQuerys[] = $d;

			$d = new deleteq();
			$d->table = 't_transaction';
			$d->pks = ['TransactionId'];
			$d->pk_values = [$TransactionId];
			$d->build_query();
			$aQuerys[] = $d;


			$res = exec_query($aQuerys, $UserId, $lan);
			$success = ($res['msgType'] == 'success') ? 1 : 0;
			$status = ($res['msgType'] == 'success') ? 200 : 500;

			$returnData = [
				"success" => $success,
				"status" => $status,
				"UserId" => $UserId,
				"message" => $res['msg']
			];
		} catch (PDOException $e) {
			$returnData = msg(0, 500, $e->getMessage());
		}

		return $returnData;
	}
}
