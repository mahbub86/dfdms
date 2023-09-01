import React, { forwardRef, useRef } from "react";
import swal from "sweetalert";
import { DeleteOutline, Edit } from "@material-ui/icons";
import {Button}  from "../../../components/CustomControl/Button";

import CustomTable from "components/CustomTable/CustomTable";
import { apiCall, apiOption , LoginUserInfo, language} from "../../../actions/api";
import ExecuteQueryHook from "../../../components/hooks/ExecuteQueryHook";

import ProductAddEditModal from "./ProductAddEditModal";

const Product = (props) => {
  const serverpage = "product"; // this is .php server page

  const { useState } = React;
  const [bFirst, setBFirst] = useState(true);
  const [currentRow, setCurrentRow] = useState([]);
  const [showModal, setShowModal] = useState(false); //true=show modal, false=hide modal
  
  const {isLoading, data: dataList, error, ExecuteQuery} = ExecuteQueryHook(); //Fetch data

  const UserInfo = LoginUserInfo();

  /* =====Start of Excel Export Code==== */
  const EXCEL_EXPORT_URL = process.env.REACT_APP_API_URL;

  const PrintPDFExcelExportFunction = (reportType) => {
    let finalUrl = EXCEL_EXPORT_URL + "report/print_pdf_excel_server.php";

    window.open(
      finalUrl +
        "?action=StrengthExport" +
        "&reportType=" +
        reportType +
        "&TimeStamp=" +
        Date.now()
    );
  };
  /* =====End of Excel Export Code==== */


  const columnList = [
    { field: "rownumber", label: "SL", align: "center", width: "3%" },
    // { field: 'SL', label: 'SL',width:'10%',align:'center',visible:true,sort:false,filter:false },
    {
      field: "ProductName",
      label: "Product Name",
      width:'10%',
      align: "left",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "GroupName",
      label: "Group",
      width:'5%',
      align: "left",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "CategoryName",
      label: "Category",
      width:'5%',
      align: "left",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "GenericName",
      label: "Generic",
      width:'5%',
      align: "left",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "TradePrice",
      label: "TP",
      width: "3%",
      align: "right",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "VatonTrade",
      label: "T.VAT",
      width: "3%",
      align: "right",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "MRP",
      label: "MRP",
      width: "3%",
      align: "right",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "VatonSales",
      label: "S.VAT",
      width: "3%",
      align: "right",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "SalesDiscountPercentage",
      label: "Dis(%)",
      width: "3%",
      align: "right",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "SalesDiscountAmount",
      label: "Dis(Amt)",
      width: "4%",
      align: "right",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "CountryName",
      label: "Origin",
      width: "6%",
      align: "left",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "ManufacturerName",
      label: "Manufacturer",
      width: "10%",
      align: "left",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "IsActiveName",
      label: "Status",
      width: "4%",
      align: "center",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "custom",
      label: "Action",
      width: "4%",
      align: "center",
      visible: true,
      sort: false,
      filter: false,
    },
  ];

  
  if (bFirst) {
    /**First time call for datalist */
    getDataList();
    setBFirst(false);
  }

  /**Get data for table list */
  function getDataList(){

    let params = {
      action: "getDataList",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
    };
    // console.log('LoginUserInfo params: ', params);

    ExecuteQuery(serverpage, params);
  }

  /** Action from table row buttons*/
  function actioncontrol(rowData) {
    return (
      <>
        <Edit
          className={"table-edit-icon"}
          onClick={() => {
            editData(rowData);
          }}
        />

        <DeleteOutline
          className={"table-delete-icon"}
          onClick={() => {
            deleteData(rowData);
          }}
        />
      </>
    );
  }

  const addData = () => {


    let params = {
      action: "NextProductSystemCode",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
    };

    apiCall.post("combo_generic", { params }, apiOption()).then((res) => {
   
      setCurrentRow({
        id: "",
        ProductGroupId: "",
        ProductCategoryId: "",
        ProductGenericId: "",
        ManufacturerId: "",
        StrengthId: "",
        ProductShortName: "",
        ProductName: "",
        CountryId: "",
        BoxSize: "",
        TradePrice: "",
        MRP: "",
        SystemBarcode: res.data.datalist,
        ProductBarcode: "",
        VatonSales: "",
        VatonTrade: "",
        SalesDiscountPercentage: "",
        SalesDiscountAmount: "",
        OrderLevel: "",
        MinOderdQty: "",
        MaxOderdQty: "",
        IsActive: true,
      });
      openModal();


    });


  };
 



  const editData = (rowData) => {

    setCurrentRow(rowData);
    openModal();
  };

  
  function openModal() {
    setShowModal(true); //true=modal show, false=modal hide
  }

  function modalCallback(response) {
    getDataList();
    setShowModal(false); //true=modal show, false=modal hide

  }

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
      console.log('res: ', res);
      props.openNoticeModal({
        isOpen: true,
        msg: res.data.message,
        msgtype: res.data.success,
      });
      getDataList();
    });

  }

  return (
    <>
      <div class="bodyContainer">
        {/* <!-- ######-----TOP HEADER-----####### --> */}
        <div class="topHeader">
          <h4>
            <a href="#">Home</a> ❯ Product ❯ Product
          </h4>
        </div>

        {/* <!-- TABLE SEARCH AND GROUP ADD --> */}
        <div class="searchAdd">
          {/* <input type="text" placeholder="Search Product Group"/> */}
          <label></label>

          <Button label={"ADD"} class={"btnAdd"} onClick={addData} />

        </div>

        {/* <!-- ####---THIS CLASS IS USE FOR TABLE GRID PRODUCT INFORMATION---####s --> */}
        <div class="subContainer">
          <div className="App">
            <CustomTable
              columns={columnList}
              rows={dataList?dataList:{}}
              actioncontrol={actioncontrol}
              ispagination={true}
            />
          </div>
        </div>
      </div>
      {/* <!-- BODY CONTAINER END --> */}


      {showModal && (<ProductAddEditModal masterProps={props} currentRow={currentRow} modalCallback={modalCallback} />)}


    </>
  );
};

export default Product;