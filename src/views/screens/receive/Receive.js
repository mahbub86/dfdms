import React, { forwardRef, useRef, useContext, useEffect } from "react";
import swal from "sweetalert";
import { DeleteOutline, Edit, ViewList } from "@material-ui/icons";

import { Button } from "../../../components/CustomControl/Button";
import moment from "moment";

// import Select from 'react-select';
// import { FixedSizeList } from 'react-window';

// import PropTypes from 'prop-types';
// // import TextField from '@mui/material/TextField';
// import Autocomplete, { autocompleteClasses } from '@material-ui/lab/Autocomplete';
// // import useMediaQuery from '@mui/material/useMediaQuery';
// // import ListSubheader from '@mui/material/ListSubheader';
// // import Popper from '@mui/material/Popper';
// // import { useTheme, styled } from '@mui/material/styles';
// import { VariableSizeList } from 'react-window';
// // import Typography from '@mui/material/Typography';

import {
  Typography,
  TextField,
  // Popper,
  // useTheme,
  // styled,
  // ListSubheader,
  // useMediaQuery,
  // Card,
  // CardHeader,
  // CardContent,
  // Grid,
  // FormControl,
  // Select,
  // MenuItem,
} from "@material-ui/core";
import Autocomplete from "@material-ui/lab/Autocomplete";

import CustomTable from "components/CustomTable/CustomTable";
import {
  apiCall,
  apiOption,
  LoginUserInfo,
  language,
} from "../../../actions/api";
import ExecuteQueryHook from "../../../components/hooks/ExecuteQueryHook";

const Receive = (props) => {
  const serverpage = "receive"; // this is .php server page

  const { useState } = React;
  const [bFirst, setBFirst] = useState(true);
  const [listEditPanelToggle, setListEditPanelToggle] = useState(true); //when true then show list, when false then show add/edit
  const [supplierList, setSupplierList] = useState(null);
  const [productList, setProductList] = useState(null);
  // const [selectedSupplier, setSelectedSupplier] = useState({});
  // const [selectedValue, setSelectedValue] = useState("");
  // const [selectedSupplier, setSelectedSupplier] = useState({
  //   id: "",
  //   name: "Select supplier",
  // });
  // const [selectedSupplier, setSelectedSupplier] = useState(null);
  // const [isLoading, setIsLoading] = useState(true);
  // const [supplierList, setSupplierList] = useState([{ id: "", name: "Select supplier" }]);

  const [currentInvoice, setCurrentInvoice] = useState([]); //this is for master information. It will send to sever for save
  const [currentMany, setCurrentMany] = useState([]); //this is for many one record add/edit
  const [manyDataList, setManyDataList] = useState([]); //This is for many table. It will send to sever for save
  const [deletedItems, setDeletedItems] = useState([]); //Which products delete from many

  const [currentDate, setCurrentDate] = useState(
    //new Date()
    moment().format("YYYY-MM-DD")
  );

  // const [currentRow, setCurrentRow] = useState([]);
  const [errorObjectMaster, setErrorObjectMaster] = useState({});
  const [errorObjectMany, setErrorObjectMany] = useState({});

  // const [showModal, setShowModal] = useState(false); //true=show modal, false=hide modal

  const { isLoading, data: dataList, error, ExecuteQuery } = ExecuteQueryHook(); //Fetch data master list

  const {
    isLoading: isLoadingSingle,
    data: dataListSingle,
    error: errorSingle,
    ExecuteQuery: ExecuteQuerySingle,
  } = ExecuteQueryHook(); //Fetch data for single

  const UserInfo = LoginUserInfo();

  /* =====Start of Excel Export Code==== */
  // const EXCEL_EXPORT_URL = process.env.REACT_APP_API_URL;

  // const PrintPDFExcelExportFunction = (reportType) => {
  //   let finalUrl = EXCEL_EXPORT_URL + "report/print_pdf_excel_server.php";

  //   window.open(
  //     finalUrl +
  //       "?action=StrengthExport" +
  //       "&reportType=" +
  //       reportType +
  //       "&TimeStamp=" +
  //       Date.now()
  //   );
  // };
  /* =====End of Excel Export Code==== */

  const newInvoice = () => {

    setManyDataList([]);
    setDeletedItems([]);

    let params = {
      action: "NextInvoiceNumber",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
      TransactionTypeId: 1,
    };

    apiCall.post("combo_generic", { params }, apiOption()).then((res) => {
      setCurrentInvoice({
        id: "",
        TransactionTypeId: 1,
        TransactionDate: currentDate,
        InvoiceNo: res.data.datalist,
        SupplierId: "",
        ChallanNo: "",
        BPosted: 0,
        Remarks: "",
        ImageUrl: "",

        SumSubTotalAmount: "",
        SumVatAmount: "",
        SumDiscountAmount: "",
        SumCommission: "",
        SumTotalAmount: "",
        NetPaymentAmount: "",
      });
    });

    resetMany();
  };

  function resetMany() {
    setCurrentMany({
      TransactionItemsId: "",
      TransactionId: "",
      ProductId: "",
      Quantity: "",
      BonusQty: "",
      TradePrice: "",
      VatonTrade: "",
      MRP: "",
      OrderQty: "",
      MfgDate: "",
      ExpDate: "",
      VatAmount: "",
      DiscountPercentage: "",
      DiscountAmount: "",
      SubTotalAmount: "",
      NewCost: "",
      Commission: "",
      TotalAmount: "",
    });
  }

  /**Get data for table list */
  function getDataList() {
    let params = {
      action: "getDataList",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
      TransactionTypeId: 1,
    };
    // console.log('LoginUserInfo params: ', params);

    ExecuteQuery(serverpage, params);
  }

  if (bFirst) {
    /**First time call for datalist */
    newInvoice();

    getSupplierList();
    getProductList();

    getDataList(); //invoice list

    setBFirst(false);
  }

  function addData() {
    newInvoice();
    setListEditPanelToggle(false); // false = hide list and show add/edit panel
  }

  function getSupplierList() {
    let params = {
      action: "SupplierList",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
    };

    apiCall.post("combo_generic", { params }, apiOption()).then((res) => {
      setSupplierList(
        [{ id: "", name: "Select supplier" }].concat(res.data.datalist)
      );
    });
  }

  function getProductList() {
    let params = {
      action: "ProductList",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
    };

    apiCall.post("combo_generic", { params }, apiOption()).then((res) => {
      setProductList(
        [{ id: "", name: "Select product" }].concat(res.data.datalist)
      );
    });
  }

  const masterColumnList = [
    { field: "rownumber", label: "SL", align: "center", width: "5%" },
    // { field: 'SL', label: 'SL',width:'10%',align:'center',visible:true,sort:false,filter:false },
    {
      field: "TransactionDate",
      label: "Date",
      width: "10%",
      align: "left",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "InvoiceNo",
      label: "Invoice No.",
      width: "15%",
      align: "left",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "SupplierName",
      label: "Supplier",
      align: "left",
      // width: "30%",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "ChallanNo",
      label: "Challan No.",
      width: "10%",
      align: "left",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "NetPaymentAmount",
      label: "Net Payment",
      width: "10%",
      align: "right",
      type: "number",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "StatusName",
      label: "Status",
      width: "5%",
      align: "center",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "custom",
      label: "Action",
      width: "5%",
      align: "center",
      visible: true,
      // sort: false,
      // filter: false,
    },
  ];

  /** Action from table row buttons*/
  function actioncontrolmaster(rowData) {
    return (
      <>
        {rowData.BPosted === 0 && (
          <Edit
            className={"table-edit-icon"}
            onClick={() => {
              editData(rowData);
            }}
          />
        )}

        {rowData.BPosted === 0 && (
          <DeleteOutline
            className={"table-delete-icon"}
            onClick={() => {
              deleteData(rowData);
            }}
          />
        )}

        {rowData.BPosted === 1 && (
          <ViewList
            className={"table-view-icon"}
            onClick={() => {
              viewData(rowData);
            }}
          />
        )}
      </>
    );
  }

  const editData = (rowData) => {
    getDataSingleFromServer(rowData.id);
  };

  const viewData = (rowData) => {
    getDataSingleFromServer(rowData.id);
  };

  const getDataSingleFromServer = (id) => {
    let params = {
      action: "getDataSingle",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
      id: id,
    };

    
    // const [currentInvoice, setCurrentInvoice] = useState([]); //this is for master information. It will send to sever for save
    // const [currentMany, setCurrentMany] = useState([]); //this is for many one record add/edit
    // const [manyDataList, setManyDataList] = useState([]); //This is for many table. It will send to sever for save
    // const [deletedItems, setDeletedItems] = useState([]); //Which products delete from many
    setDeletedItems([]);

    ExecuteQuerySingle(serverpage, params);
    resetMany();

    setListEditPanelToggle(false); // false = hide list and show add/edit panel
  };

  useEffect(() => {
    console.log('dataListSingle: ', dataListSingle);

    if (dataListSingle.master) {
      // console.log('dataListSingle: ', dataListSingle.master[0]);
      setCurrentInvoice(dataListSingle.master[0]);
    }
    if (dataListSingle.items) {
      setManyDataList(dataListSingle.items);
      // console.log('dataListSingle: ', dataListSingle.items[0]);
    }
  }, [dataListSingle]);





  const backToList = () => {
    setListEditPanelToggle(true); // true = show list and hide add/edit panel
    getDataList(); //invoice list
  };


  const printInvoice = () => {

    console.log("Print not done yet.");
    
  };

  

  const deleteData = (rowData) => {
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this data!",
      icon: "warning",
      buttons: {
        confirm: {
          text: "Yes",
          value: true,
          visible: true,
          className: "",
          closeModal: true,
        },
        cancel: {
          text: "No",
          value: null,
          visible: true,
          className: "",
          closeModal: true,
        },
      },
      dangerMode: true,
    }).then((allowAction) => {
      if (allowAction) {
        deleteApi(rowData);
      }
    });
  };

  function deleteApi(rowData) {
    let params = {
      action: "deleteData",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
      rowData: rowData,
    };

    apiCall.post(serverpage, { params }, apiOption()).then((res) => {
      // console.log('res: ', res);
      props.openNoticeModal({
        isOpen: true,
        msg: res.data.message,
        msgtype: res.data.success,
      });
      getDataList();
    });
  }

  const handleChangeMaster = (e) => {
    // console.log('e: ', e);

    const { name, value } = e.target;
    // console.log('value: ', value);
    // console.log('name: ', name);
    let data = { ...currentInvoice };
    data[name] = value;

    if (name === "SumCommission") {
      let SumTotalAmount =
        data["SumTotalAmount"] === "" ? 0 : parseFloat(data["SumTotalAmount"]);
      let SumCommission =
        data["SumCommission"] === "" ? 0 : parseFloat(data["SumCommission"]);
      let NetPaymentAmount = (SumTotalAmount - SumCommission).toFixed(0);

      data["NetPaymentAmount"] = NetPaymentAmount;
    }
    setCurrentInvoice(data);
    // console.log("data handleChangeMaster: ", data);

    setErrorObjectMaster({ ...errorObjectMaster, [name]: null });
    // const [errorObjectMaster, setErrorObjectMaster] = useState({});
  };

  const handleChangeChoosenMaster = (name, value) => {
    let data = { ...currentInvoice };
    data[name] = value;
    setCurrentInvoice(data);
    // console.log("data: ", data);

    // setErrorObject({ ...errorObject, [name]: null });
    setErrorObjectMaster({ ...errorObjectMaster, [name]: null });
  };

  const handleChangeMany = (e) => {
    // console.log('e: ', e);

    const { name, value } = e.target;
    // console.log('value: ', value);
    // console.log('name: ', name);
    let data = { ...currentMany };
    data[name] = value;

    // console.log("data handleChangeMany: ", data);
    if (
      name === "TradePrice" ||
      name === "Quantity" ||
      name === "BonusQty" ||
      name === "VatonTrade" ||
      name === "DiscountPercentage" ||
      name === "DiscountAmount" ||
      name === "SubTotalAmount"
    ) {
      setCurrentMany(calculationManyFields(name, data));
    } else {
      setCurrentMany(data);
    }

    setErrorObjectMany({ ...errorObjectMany, [name]: null });
  };

  const handleChangeChoosenMany = (name, value) => {
    let data = { ...currentMany };
    data[name] = value;

    /**when select product then some value take from product metadata */
    if (name === "ProductId") {
      var selectedProduct = productList.filter((prod) => prod.id === value);

      // console.log('selectedProduct: ', selectedProduct);
      // console.log('selectedProduct TradePrice: ', selectedProduct[0].TradePrice);
      // console.log('selectedProduct MRP: ', selectedProduct[0].MRP);
      // console.log('selectedProduct VatonTrade: ', selectedProduct[0].VatonTrade);

      data["TradePrice"] = selectedProduct[0].TradePrice;
      data["MRP"] = selectedProduct[0].MRP;
      data["VatonTrade"] = selectedProduct[0].VatonTrade;

      setCurrentMany(calculationManyFields(name, data));
    } else {
      setCurrentMany(data);
    }

    // console.log("data handleChangeChoosenMany: ", data);

    setErrorObjectMany({ ...errorObjectMany, [name]: null });
  };

  const calculationManyFields = (name, data) => {
    // console.log("data: ", data);

    /**when type subtotal then no need calculate subtotal */
    if (name !== "SubTotalAmount") {
      data["SubTotalAmount"] = parseFloat(
        (data["TradePrice"] === "" ? 0 : parseFloat(data["TradePrice"])) *
          (data["Quantity"] === "" ? 0 : parseInt(data["Quantity"]))
      ).toFixed(2);
    }

    data["VatAmount"] = parseFloat(
      ((data["SubTotalAmount"] === ""
        ? 0
        : parseFloat(data["SubTotalAmount"])) *
        (data["VatonTrade"] === "" ? 0 : parseFloat(data["VatonTrade"]))) /
        100
    ).toFixed(2);

    /**when type DiscountAmount then no need calculate DiscountAmount */
    if (name !== "DiscountAmount" && data["DiscountPercentage"] !== "") {
      data["DiscountAmount"] = parseFloat(
        ((data["SubTotalAmount"] === ""
          ? 0
          : parseFloat(data["SubTotalAmount"])) *
          (data["DiscountPercentage"] === ""
            ? 0
            : parseFloat(data["DiscountPercentage"]))) /
          100
      ).toFixed(2);
    }

    /**when type TotalAmount then no need calculate TotalAmount */
    // if (name !== "TotalAmount") {
    data["TotalAmount"] = parseFloat(
      (data["SubTotalAmount"] === "" ? 0 : parseFloat(data["SubTotalAmount"])) +
        (data["VatAmount"] === "" ? 0 : parseFloat(data["VatAmount"])) -
        (data["DiscountAmount"] === "" ? 0 : parseFloat(data["DiscountAmount"]))
    ).toFixed(2);
    // }

    /**when type NewCost then no need calculate NewCost */
    if (name !== "NewCost") {
      data["NewCost"] = parseFloat(
        (data["TotalAmount"] === "" ? 0 : parseFloat(data["TotalAmount"])) /
          ((data["Quantity"] === "" ? 0 : parseFloat(data["Quantity"])) +
            (data["BonusQty"] === "" ? 0 : parseFloat(data["BonusQty"])))
      ).toFixed(2);
    }

    // console.log("data calculationManyFields: ", data);

    return data;
  };

  const calculationMasterFields = (list) => {
    console.log('list: ', list);
    let SumSubTotalAmount = 0;
    let SumVatAmount = 0;
    let SumDiscountAmount = 0;
    // let SumCommission = 0;
    let SumTotalAmount = 0;

    list.forEach((row, i) => {
      console.log('row: ', row);
      SumSubTotalAmount +=
        (row.SubTotalAmount === "" || row.SubTotalAmount === null) ? 0 : parseFloat(row.SubTotalAmount);
      SumVatAmount += (row.VatAmount === "" || row.VatAmount === null)? 0 : parseFloat(row.VatAmount);
      SumDiscountAmount +=
        (row.DiscountAmount === "" || row.DiscountAmount === null)? 0 : parseFloat(row.DiscountAmount);
      SumTotalAmount +=
        (row.TotalAmount === "" || row.TotalAmount === null) ? 0 : parseFloat(row.TotalAmount);
    });

    let data = { ...currentInvoice };
    data["SumSubTotalAmount"] = SumSubTotalAmount.toFixed(2);
    data["SumVatAmount"] = SumVatAmount.toFixed(2);
    data["SumDiscountAmount"] = SumDiscountAmount.toFixed(2);
    data["SumTotalAmount"] = SumTotalAmount.toFixed(0);

    // SumCommission =
    //   (data["SumCommission"] === "" || data["SumCommission"] === null) ? 0 : parseFloat(data["SumCommission"]);

    data["NetPaymentAmount"] = (
      ((data["SumTotalAmount"] === "" || data["SumTotalAmount"] === null) ? 0 : parseFloat(data["SumTotalAmount"])) - 
      ((data["SumCommission"] === "" || data["SumCommission"] === null) ? 0 : parseFloat(data["SumCommission"]))).toFixed(0);
    console.log('data: ', data);

    setCurrentInvoice(data);
  };

  const addEditManyItem = () => {
    if (validateFormMany()) {
      // console.log("currentMany: ", currentMany);
      // console.log("data.TransactionItemsId: ", currentMany.TransactionItemsId);

      let isExist = 0;
      manyDataList.forEach((row, i) => {
        if (currentMany.ProductId === row.ProductId && isExist === 0) {
          isExist = 1;
        }
      });

      if (isExist === 1) {
        props.openNoticeModal({
          isOpen: true,
          msg: "Already added this product",
          msgtype: 0,
        });

        return;
      }

      let rows = [];
      var selectedProduct = productList.filter(
        (prod) => prod.id === currentMany.ProductId
      );

      // console.log('selectedProduct: ', selectedProduct);


      // console.log("oldManyDataList: ", manyDataList);

      manyDataList.forEach((row, i) => {
        let newRow = {};

        newRow.autoId = row.autoId; //Just unique id for delete/update
        newRow.TransactionItemsId = row.TransactionItemsId;
        newRow.TransactionId = row.TransactionId;
        newRow.ProductId = row.ProductId;
        newRow.ProductName = row.ProductName;
        newRow.Quantity = row.Quantity;
        newRow.TradePrice = row.TradePrice;
        newRow.MRP = row.MRP;
        newRow.OrderQty = row.OrderQty;
        newRow.BonusQty = row.BonusQty;
        newRow.MfgDate = row.MfgDate;
        newRow.ExpDate = row.ExpDate;
        newRow.VatonTrade = row.VatonTrade;
        newRow.VatAmount = row.VatAmount;
        newRow.DiscountPercentage = row.DiscountPercentage;
        newRow.DiscountAmount = row.DiscountAmount;
        newRow.SubTotalAmount = row.SubTotalAmount;
        newRow.NewCost = row.NewCost;
        newRow.Commission = row.Commission;
        newRow.TotalAmount = row.TotalAmount;
        rows.push(newRow);
      });


      
      let newRow = {};
      newRow.autoId = currentMany.ProductId + moment().milliseconds(); //Just unique id for delete/update
      newRow.TransactionItemsId = currentMany.TransactionItemsId;
      newRow.TransactionId = currentMany.TransactionId;
      newRow.ProductId = currentMany.ProductId;
      newRow.ProductName = selectedProduct[0].name;
      newRow.Quantity = currentMany.Quantity;
      newRow.BonusQty = currentMany.BonusQty;
      newRow.TradePrice = currentMany.TradePrice;
      newRow.VatonTrade = currentMany.VatonTrade;
      newRow.MRP = currentMany.MRP;
      newRow.OrderQty = currentMany.OrderQty;
      newRow.MfgDate = currentMany.MfgDate;
      newRow.ExpDate = currentMany.ExpDate;
      newRow.VatAmount = currentMany.VatAmount;
      newRow.DiscountPercentage = currentMany.DiscountPercentage;
      newRow.DiscountAmount = currentMany.DiscountAmount;
      newRow.SubTotalAmount = currentMany.SubTotalAmount;
      newRow.NewCost = currentMany.NewCost;
      newRow.Commission = currentMany.Commission;
      newRow.TotalAmount = currentMany.TotalAmount;
      rows.push(newRow);


      setManyDataList(rows);
      // console.log("manyDataList: ", rows);
      calculationMasterFields(rows);

      resetMany();
    }
  };

  const validateFormMaster = () => {
    let validateFields = ["TransactionDate", "SupplierId", "InvoiceNo"];
    let errorData = {};
    let isValid = true;
    validateFields.map((field) => {
      if (!currentInvoice[field]) {
        errorData[field] = "validation-style";
        isValid = false;
      }
    });
    setErrorObjectMaster(errorData);
    return isValid;
  };

  const validateFormMany = () => {
    let validateFields = [
      "ProductId",
      "Quantity",
      "SubTotalAmount",
      "TotalAmount",
    ];
    let errorData = {};
    let isValid = true;
    validateFields.map((field) => {
      if (!currentMany[field]) {
        errorData[field] = "validation-style";
        isValid = false;
      }
    });
    setErrorObjectMany(errorData);
    return isValid;
  };

  const manyColumnList = [
    { field: "rownumber", label: "SL", align: "center", width: "3%" },
    // { field: 'SL', label: 'SL',width:'10%',align:'center',visible:true,sort:false,filter:false },
    {
      field: "ProductName",
      label: "Product",
      // width: "10%",
      align: "left",
      visible: true,
      // sort: true,
      // filter: false,
    },
    {
      field: "TradePrice",
      label: "T_Price",
      width: "4%",
      align: "right",
      type: "number",
      visible: true,
      // sort: true,
      // filter: true,
    },
    {
      field: "OrderQty",
      label: "O_Qnty",
      align: "right",
      width: "5%",
      visible: true,
      // sort: true,
      // filter: true,
    },
    {
      field: "Quantity",
      label: "R_Qnty",
      width: "5%",
      align: "right",
      visible: true,
      // sort: true,
      // filter: true,
    },
    {
      field: "BonusQty",
      label: "B_Qnty",
      width: "5%",
      align: "right",
      visible: true,
      // sort: true,
      // filter: true,
    },
    {
      field: "SubTotalAmount",
      label: "S_Total",
      width: "5%",
      align: "right",
      type: "number",
      visible: true,
      // sort: true,
      // filter: true,
    },
    {
      field: "VatonTrade",
      label: "VAT (%)",
      width: "4%",
      align: "right",
      visible: true,
      // sort: true,
      // filter: true,
    },
    {
      field: "VatAmount",
      label: "VAT (Amt)",
      width: "5%",
      align: "right",
      type: "number",
      visible: true,
      // sort: true,
      // filter: true,
    },
    {
      field: "DiscountAmount",
      label: "Dis (Amt)",
      width: "5%",
      align: "right",
      type: "number",
      visible: true,
      // sort: true,
      // filter: true,
    },
    {
      field: "NewCost",
      label: "New Cost",
      width: "5%",
      align: "right",
      visible: true,
      // sort: true,
      // filter: true,
    },
    {
      field: "MRP",
      label: "MRP",
      width: "4%",
      align: "right",
      type: "number",
      visible: true,
      // sort: true,
      // filter: true,
    },
    {
      field: "MfgDate",
      label: "Mfg. Date",
      width: "5%",
      align: "left",
      visible: true,
      // sort: true,
      // filter: true,
    },
    {
      field: "ExpDate",
      label: "Exp. Date",
      width: "5%",
      align: "left",
      visible: true,
      // sort: true,
      // filter: true,
    },
    {
      field: "TotalAmount",
      label: "Total",
      width: "5%",
      align: "right",
      type: "number",
      visible: true,
      // sort: true,
      // filter: true,
    },
    /*
    {
      field: "Commission",
      label: "Com (Amt)",
      width: "5%",
      align: "right",
      visible: true,
      // sort: true,
      // filter: true,
    },*/
    {
      field: "custom",
      label: "Action",
      width: "4%",
      align: "center",
      visible: true,
      // sort: false,
      // filter: false,
    },
  ];



  /** Action from table row buttons*/
  function actioncontrol(rowData) {
    return (
      <>
        {!currentInvoice.BPosted && (<DeleteOutline
          className={"table-delete-icon"}
          onClick={() => {
            deleteDataMany(rowData);
          }}
        />)}
      </>
    );
  }

  const deleteDataMany = (rowData) => {
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this data!",
      icon: "warning",
      buttons: {
        confirm: {
          text: "Yes",
          value: true,
          visible: true,
          className: "",
          closeModal: true,
        },
        cancel: {
          text: "No",
          value: null,
          visible: true,
          className: "",
          closeModal: true,
        },
      },
      dangerMode: true,
    }).then((allowAction) => {
      if (allowAction) {
        deleteInvoiceItem(rowData);
      }
    });
  };

  function deleteInvoiceItem(rowData) {
    // console.log("manyDataList: ", manyDataList);
    // console.log("rowData for delete: ", rowData);

    let data = manyDataList.filter(function (obj) {
      return obj.autoId !== rowData.autoId;
    });

    setManyDataList(data);

    let delItems = [...deletedItems];
    delItems.push(rowData);
    console.log('delItems: ', delItems);

    setDeletedItems(delItems);
  }



  const postInvoice = () => {

   
    swal({
      title: "Are you sure?",
      text: "Do you really want to post the stock?",
      icon: "warning",
      buttons: {
        confirm: {
          text: "Yes",
          value: true,
          visible: true,
          className: "",
          closeModal: true,
        },
        cancel: {
          text: "No",
          value: null,
          visible: true,
          className: "",
          closeModal: true,
        },
      },
      dangerMode: true,
    }).then((allowAction) => {
      if (allowAction) {


        let cInvoiceMaster = {...currentInvoice};
        cInvoiceMaster["BPosted"] = 1;

          let params = {
          action: "dataAddEdit",
          lan: language(),
          UserId: UserInfo.UserId,
          ClientId: UserInfo.ClientId,
          BranchId: UserInfo.BranchId,
          InvoiceMaster: cInvoiceMaster,
          InvoiceItems: manyDataList,
          DeletedItems: deletedItems,
        };
    
        addEditAPICall(params);

      }else{

        
      }
    });
    
  };

  function saveData(p) {

    let params = {
      action: "dataAddEdit",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
      InvoiceMaster: currentInvoice,
      InvoiceItems: manyDataList,
      DeletedItems: deletedItems,
    };

    addEditAPICall(params);

  }


  function addEditAPICall(params) {
    if (validateFormMaster()) {

      apiCall.post(serverpage, { params }, apiOption()).then((res) => {
        // console.log('res: ', res);

        props.openNoticeModal({
          isOpen: true,
          msg: res.data.message,
          msgtype: res.data.success,
        });

        // console.log('currentInvoice: ', currentInvoice);
        if(currentInvoice.id === ""){
          //New
          getDataSingleFromServer(res.data.id);
        }else{
          //Edit
          getDataSingleFromServer(currentInvoice.id);
        }

        /**after save refresh the master list */
        // getDataList(); //invoice list
        // getDataSingleFromServer(res.data.id);


        // console.log('props modal: ', props);
        // if (res.data.success === 1) {
        //   props.modalCallback("addedit");
        // }
      });
    }
  }

  return (
    <>
      <div class="bodyContainer">
        <div class="topHeader">
          <h4>
            <a href="#">Home</a> ❯ Product ❯ Receive
          </h4>
        </div>

        {listEditPanelToggle && (
          <>
            {/* <!-- TABLE SEARCH AND GROUP ADD --> */}
            <div class="searchAdd">
              {/* <input type="text" placeholder="Search Product Group"/> */}
              <label></label>

              {/* <Button label={"ADD"} class={"btnAdd"} onClick={addData} /> */}
              <Button label={"ADD"} class={"btnAdd"} onClick={addData} />
            </div>

            {/* <!-- ####---Master invoice list---####s --> */}
            <div class="subContainer">
              <div className="App">
                <CustomTable
                  columns={masterColumnList}
                  rows={dataList ? dataList : {}}
                  actioncontrol={actioncontrolmaster}
                />
              </div>
            </div>
          </>
        )}

        {!listEditPanelToggle && (
          <>
            <div class="subContainer rcvHeader">
              {/* <!-- HEADER DIV GRID-ITEM-1 --> */}
              <div class="header-item" id="headerItem-1">
                <div>
                  <label>Date *</label>
                </div>
                <div>
                  <input
                    type="date"
                    id="TransactionDate"
                    name="TransactionDate"
                    disabled={ currentInvoice.BPosted}
                    class={errorObjectMaster.TransactionDate}
                    value={currentInvoice.TransactionDate || ""}
                    onChange={(e) => handleChangeMaster(e)}
                  />
                </div>
              </div>

              {/* <!-- HEADER DIV GRID-ITEM-2 --> */}
              <div class="header-item" id="headerItem-2">
                <div>
                  <label>Supplier *</label>
                </div>
                {/* <div class="plusGroup"> */}
                <div class="">
                  <Autocomplete
                    autoHighlight
                    disabled={ currentInvoice.BPosted}
                    className="chosen_dropdown"
                    id="SupplierId"
                    name="SupplierId"
                    class={errorObjectMaster.SupplierId}
                    autoComplete
                    options={supplierList ? supplierList : []}
                    getOptionLabel={(option) => option.name}
                    // value={selectedSupplier}
                    value={
                      supplierList
                        ? supplierList[
                            supplierList.findIndex(
                              (list) => list.id === currentInvoice.SupplierId
                            )
                          ]
                        : null
                    }
                    onChange={(event, valueobj) =>
                      handleChangeChoosenMaster(
                        "SupplierId",
                        valueobj ? valueobj.id : ""
                      )
                    }
                    renderOption={(option) => (
                      <Typography className="chosen_dropdown_font">
                        {option.name}
                      </Typography>
                    )}
                    renderInput={(params) => (
                      <TextField {...params} variant="standard" fullWidth />
                    )}
                  />

                  {/* <button class="btnPlus">+</button> */}
                </div>
              </div>

              {/* <!-- HEADER DIV GRID-ITEM-3 --> */}
              <div class="header-item" id="headerItem-3">
                <div>
                  <label for="invoiceno">Invoice No. *</label>
                </div>
                <div>
                  <input
                    type="text"
                    id="InvoiceNo"
                    name="InvoiceNo"
                    disabled
                    class={errorObjectMaster.InvoiceNo}
                    value={currentInvoice.InvoiceNo || ""}
                    onChange={(e) => handleChangeMaster(e)}
                  />
                </div>
              </div>

              {/* <!-- HEADER DIV GRID-ITEM-4 --> */}
              <div class="header-item" id="headerItem-4">
                <div>
                  <label for="challanno">Challan No.</label>
                </div>
                <div>
                  <input
                    type="text"
                    id="ChallanNo"
                    name="ChallanNo"
                    disabled={ currentInvoice.BPosted}
                    // class={errorObject.ChallanNo}
                    value={currentInvoice.ChallanNo || ""}
                    onChange={(e) => handleChangeMaster(e)}
                  />
                </div>
              </div>
            </div>

            {/* <!-- ##########-----PRODUCT RECEIVED INPUT AREA----############  --> */}
           {!currentInvoice.BPosted && (<div class="subContainer inputArea">
              {/* <!-- INPUR AREA PARTITION-1 INSERTION AREA --> */}
              <div class="input-areaPartition" id="areaPartion-1">
                {/* <!--nth-child(1) = 1st GRID ITEM = 3rf--> */}
                <div>
                  <div>
                    <label>Product Name *</label>
                  </div>
                  {/* <div class="plusGroup ">
                <input type="text" />
                <button class="btnPlus">+</button>
              </div> */}
                  <div>
                    <Autocomplete
                      autoHighlight
                      // freeSolo
                      className="chosen_dropdown"
                      id="ProductId"
                      name="ProductId"
                      autoComplete
                      class={errorObjectMany.ProductId}
                      options={productList ? productList : []}
                      getOptionLabel={(option) => option.name}
                      // value={selectedSupplier}
                      value={
                        productList
                          ? productList[
                              productList.findIndex(
                                (list) => list.id == currentMany.ProductId
                              )
                            ]
                          : null
                      }
                      onChange={(event, valueobj) =>
                        handleChangeChoosenMany(
                          "ProductId",
                          valueobj ? valueobj.id : ""
                        )
                      }
                      renderOption={(option) => (
                        <Typography className="chosen_dropdown_font">
                          {option.name}
                        </Typography>
                      )}
                      renderInput={(params) => (
                        <TextField {...params} variant="standard" fullWidth />
                      )}
                    />

                    {/* <Select
      // isLoading={isLoading}
      options={productList}
      components={{ MenuList: renderVirtualList }}
      isSearchable
      onChange={onChange}
      // Other props and styling options
    /> */}

                    {/* <Autocomplete
                id="virtualize-demo"
                sx={{ width: 300 }}
                disableListWrap
                PopperComponent={StyledPopper}
                ListboxComponent={ListboxComponent}
                options={productList ? productList : []}
                groupBy={(option) => option[0].toUpperCase()}
                renderInput={(params) => <TextField {...params} label="10,000 options" />}
                renderOption={(props, option, state) => [props, option, state.index] }
                // TODO: Post React 18 update - validate this conversion, look like a hidden bug
                renderGroup={(params) => params }
              /> */}

                    {/* <Autocomplete
                autoHighlight
                // freeSolo
                // disableListWrap
                className="chosen_dropdown"
                id="ProductId"
                name="ProductId" 
  
                noOptionsText="No locations"
                options={productList ? productList : []}
                getOptionLabel={(option) => option.name}
                // value={selectedSupplier}
                value={productList?productList[productList.findIndex(list => list.id == currentInvoice.ProductId)]:null}
                onChange={(event, valueobj) =>
                  handleChangeChoosen("ProductId", valueobj ? valueobj.id : "")
                }
                renderOption={(option) => (
                  <Typography className="chosen_dropdown_font">{option.name}</Typography>
                )}
                // renderInput={(params) => (
                //   <TextField {...params} variant="standard" fullWidth />
                // )}
                // ListboxComponent={(props) => (
                //   <FixedSizeList height={200} itemCount={productList.length} itemSize={35} {...props} />
                // )}

              /> */}
                  </div>
                </div>

                {/* <!--nth-child(2) = 2nd GRID ITEM = 3rf--> */}
                <div>
                  <div>
                    <label>Trade Price</label>
                  </div>
                  <div>
                    {/* <input type="number" /> */}
                    <input
                      type="number"
                      id="TradePrice"
                      name="TradePrice"
                      // class={errorObject.TradePrice}
                      value={currentMany.TradePrice}
                      onChange={(e) => handleChangeMany(e)}
                    />
                  </div>
                </div>
                {/* <!--nth-child(3) = 3rd GRID ITEM = 3rf--> */}
                <div>
                  <div>
                    <label>Vat on Trade (%)</label>
                  </div>
                  <div>
                    {/* <input type="number" /> */}
                    <input
                      type="number"
                      id="VatonTrade"
                      name="VatonTrade"
                      // class={errorObject.VatonTrade}
                      value={currentMany.VatonTrade}
                      onChange={(e) => handleChangeMany(e)}
                    />
                  </div>
                </div>
                {/* <!--nth-child(4) = 4t GRID ITEM = 3rf--> */}
                <div>
                  <div>
                    <label>MRP</label>
                  </div>
                  <div>
                    {/* <input type="number" /> */}
                    <input
                      type="number"
                      id="MRP"
                      name="MRP"
                      // class={errorObject.MRP}
                      value={currentMany.MRP}
                      onChange={(e) => handleChangeMany(e)}
                    />
                  </div>
                </div>

                {/* <!--nth-child(5) = 5th GRID ITEM = 3rf--> */}
                <div>
                  <div>
                    <label>Receive Qty *</label>
                  </div>
                  <div>
                    {/* <input type="number" /> */}
                    <input
                      type="number"
                      id="Quantity"
                      name="Quantity"
                      class={errorObjectMany.Quantity}
                      value={currentMany.Quantity}
                      onChange={(e) => handleChangeMany(e)}
                    />
                  </div>
                </div>
                {/* <!--nth-child(6) = 6th GRID ITEM = 3rf--> */}
                <div>
                  <div>
                    <label>Order Qty</label>
                  </div>
                  <div>
                    {/* <input type="number" /> */}
                    <input
                      type="number"
                      id="OrderQty"
                      name="OrderQty"
                      // class={errorObject.OrderQty}
                      value={currentMany.OrderQty}
                      onChange={(e) => handleChangeMany(e)}
                    />
                  </div>
                </div>
                {/* <!--nth-child(7) = 7th GRID ITEM = 3rf--> */}
                <div>
                  <div>
                    <label>Bonus Qty</label>
                  </div>
                  <div>
                    {/* <input type="number" /> */}
                    <input
                      type="number"
                      id="BonusQty"
                      name="BonusQty"
                      // class={errorObject.BonusQty}
                      value={currentMany.BonusQty}
                      onChange={(e) => handleChangeMany(e)}
                    />
                  </div>
                </div>
                {/* <!--nth-child(8) = 8th GRID ITEM = 3rf--> */}
                <div>
                  <div>
                    <label>Discount (%)</label>
                  </div>
                  <div>
                    {/* <input type="number" /> */}
                    <input
                      type="number"
                      id="DiscountPercentage"
                      name="DiscountPercentage"
                      // class={errorObject.DiscountPercentage}
                      value={currentMany.DiscountPercentage}
                      onChange={(e) => handleChangeMany(e)}
                    />
                  </div>
                </div>
                {/* <!--nth-child(9) = 9th GRID ITEM = 3rf--> */}
                <div>
                  <div>
                    <label>Discount (Amt)</label>
                  </div>
                  <div>
                    {/* <input type="number" /> */}
                    <input
                      type="number"
                      id="DiscountAmount"
                      name="DiscountAmount"
                      // class={errorObject.DiscountAmount}
                      value={currentMany.DiscountAmount}
                      onChange={(e) => handleChangeMany(e)}
                    />
                  </div>
                </div>

                {/* <!--nth-child(10) = 10th GRID ITEM = 3rf--> */}
                <div>
                  <div>
                    <label>Mfg. Date</label>
                  </div>
                  <div>
                    {/* <input type="date" /> */}
                    <input
                      type="date"
                      id="MfgDate"
                      name="MfgDate"
                      // class={errorObject.MfgDate}
                      value={currentMany.MfgDate}
                      onChange={(e) => handleChangeMany(e)}
                    />
                  </div>
                </div>
                {/* <!--nth-child(11) = 11th GRID ITEM = 3rf--> */}
                <div>
                  <div>
                    <label>Exp. Date</label>
                  </div>
                  <div>
                    {/* <input type="date" /> */}
                    <input
                      type="date"
                      id="ExpDate"
                      name="ExpDate"
                      // class={errorObject.ExpDate}
                      value={currentMany.ExpDate}
                      onChange={(e) => handleChangeMany(e)}
                    />
                  </div>
                </div>
                {/* <!--nth-child(12) = 12th GRID ITEM = 3rf--> */}
                <div>
                  <div>
                    <label>New Cost</label>
                  </div>
                  <div>
                    {/* <input type="number" /> */}
                    <input
                      type="number"
                      id="NewCost"
                      name="NewCost"
                      // class={errorObject.NewCost}
                      value={currentMany.NewCost}
                      onChange={(e) => handleChangeMany(e)}
                    />
                  </div>
                </div>

                {/* <!--nth-child(13) = 14th GRID ITEM = 3rf--> */}
                <div>
                  <div>
                    {/* <button class="btnAdd">ADD</button> */}

                    <Button
                      label={"Add"}
                      class={"btnAdd"}
                      onClick={addEditManyItem}
                    />
                  </div>
                </div>
              </div>

              {/* <!-- INPUT AREA PARTITION-2 INFORMATION AREA --> */}
              <div id="areaPartion-2">
                {/* <!-- SUBTOTAL --> */}
                <label>Sub Total *</label>
                {/* <input type="number" /> */}
                <input
                  type="number"
                  id="SubTotalAmount"
                  name="SubTotalAmount"
                  class={errorObjectMany.SubTotalAmount}
                  value={currentMany.SubTotalAmount}
                  onChange={(e) => handleChangeMany(e)}
                />

                {/* <!-- VAT AMOUNT --> */}
                <label>VAT (Amt)</label>
                {/* <input type="number" /> */}
                <input
                  type="number"
                  id="VatAmount"
                  name="VatAmount"
                  disabled
                  // class={errorObject.VatAmount}
                  value={currentMany.VatAmount}
                  // onChange={(e) => handleChangeMany(e)}
                />

                {/* <!-- DISCOUNT AMOUNT --> */}
                <label>Discount (Amt)</label>
                {/* <input type="number" /> */}
                <input
                  type="number"
                  id="DiscountAmountDisable"
                  name="DiscountAmountDisable"
                  disabled
                  // class={errorObject.DiscountAmount}
                  value={currentMany.DiscountAmount}
                  // onChange={(e) => handleChangeMany(e)}
                />

                {/* <!-- TOTAL AMOUNT --> */}
                <label id="note">Total *</label>
                {/* <input type="number" /> */}
                <input
                  type="number"
                  id="TotalAmount"
                  name="TotalAmount"
                  disabled
                  class={errorObjectMany.TotalAmount}
                  value={currentMany.TotalAmount}
                  // onChange={(e) => handleChangeMany(e)}
                />
              </div>
            </div>)}

            {/* <!-- ########-------PRODUCT RECEIVE TABLE DESIGN USING TABLE----###### --> */}

            <div class="subContainer">
              <div class="rcvInfo">
                <CustomTable
                  columns={manyColumnList}
                  rows={manyDataList ? manyDataList : {}}
                  actioncontrol={actioncontrol}
                  ispagination={false}
                />
              </div>

              {/* <!-- ########-----PRODUCT RECEIVE SUBMISSION AND CONFIRMATION AREA----######## --> */}
              <div class="rcvFooter">
                {/* <!-- FOOTER PARTITION-1 CALCULATION AREA --> */}
                <div class="footerPartion-1">
                  {/* <!-- GRID CHIELD-1 --> */}
                  <label>Sub Total</label>
                  {/* <!-- GRID CHIELD-2 --> */}
                  {/* <input type="number" /> */}
                  <input
                    type="number"
                    id="SumSubTotalAmount"
                    name="SumSubTotalAmount"
                    disabled
                    // class={errorObjectMaster.SumSubTotalAmount}
                    value={currentInvoice.SumSubTotalAmount || ""}
                  />

                  {/* <!-- GRID CHIELD-3 --> */}
                  <label>VAT (Amt)</label>
                  {/* <!-- GRID CHIELD-4 --> */}
                  {/* <input type="number" /> */}
                  <input
                    type="number"
                    id="SumVatAmount"
                    name="SumVatAmount"
                    disabled
                    // class={errorObjectMaster.SumVatAmount}
                    value={currentInvoice.SumVatAmount || ""}
                  />

                  {/* <!-- GRID CHIELD-5 --> */}
                  <label>Discount (Amt)</label>
                  {/* <!-- GRID CHIELD-6 --> */}
                  {/* <input type="number" /> */}
                  <input
                    type="number"
                    id="SumDiscountAmount"
                    name="SumDiscountAmount"
                    disabled
                    // class={errorObjectMaster.SumDiscountAmount}
                    value={currentInvoice.SumDiscountAmount || ""}
                  />

                  {/* <!-- GRID CHIELD-7 --> */}
                  <label>Total</label>
                  {/* <!-- GRID CHIELD-8 --> */}
                  {/* <input type="number" /> */}
                  <input
                    type="number"
                    id="SumTotalAmount"
                    name="SumTotalAmount"
                    disabled
                    // class={errorObjectMaster.Remarks}
                    value={currentInvoice.SumTotalAmount || ""}
                  />

                  {/* <!-- GRID CHIELD-9 --> */}
                  <label>Remarks</label>
                  {/* <!-- GRID CHIELD-10 --> */}
                  {/* <input type="text" /> */}
                  <input
                    type="text"
                    id="Remarks"
                    name="Remarks"
                    disabled={currentInvoice.BPosted}
                    // class={errorObjectMaster.Remarks}
                    value={currentInvoice.Remarks || ""}
                    onChange={(e) => handleChangeMaster(e)}
                  />

                  {/* <!-- GRID CHIELD-11 --> */}
                  {/* <label>Upload Invoice</label> */}
                  <label></label>
                  <label></label>
                  {/* <!-- GRID CHIELD-12 --> */}
                  {/* <input type="file" /> */}
                  {/* <!-- GRID CHIELD-13 --> */}
                  <label>Commission (Amt)</label>
                  {/* <!-- GRID CHIELD-14 --> */}
                  {/* <input type="number" /> */}
                  <input
                    type="number"
                    id="SumCommission"
                    name="SumCommission"
                    disabled={currentInvoice.BPosted}
                    // class={errorObjectMaster.Remarks}
                    value={currentInvoice.SumCommission || ""}
                    onChange={(e) => handleChangeMaster(e)}
                  />

                  {/* <!-- GRID CHIELD-15 --> */}
                  <label>Net Payment</label>
                  {/* <!-- GRID CHIELD-16 --> */}
                  {/* <input type="number" /> */}
                  <input
                    type="number"
                    id="NetPaymentAmount"
                    name="NetPaymentAmount"
                    disabled
                    // class={errorObjectMaster.Remarks}
                    value={currentInvoice.NetPaymentAmount || ""}
                    // onChange={(e) => handleChangeMaster(e)}
                  />
                </div>

                {/* <!-- FOOTER PARTITION-2 OPERATION AREA--> */}
                <div class="footerPartion-2">
                  <Button
                    disabled={false} 
                    label={"Back"}
                    class={"btnClose"}
                    onClick={backToList}
                  />

                  <Button
                    disabled={false} 
                    label={"Print"}
                    class={"btnPrint"}
                    onClick={printInvoice}
                  />

                  <Button
                    disabled={currentInvoice.BPosted} 
                    label={"Save"}
                    class={"btnSave"}
                    onClick={saveData}
                  />

                  <Button
                    disabled={currentInvoice.BPosted} 
                    label={"Post"}
                    class={"btnPost"}
                    onClick={postInvoice}
                  />
                  

                </div>
              </div>
            </div>
          </>
        )}
      </div>
    </>
  );
};

export default Receive;
