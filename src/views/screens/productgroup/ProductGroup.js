import React, { forwardRef, useRef } from "react";
import swal from "sweetalert";
import { DeleteOutline, Edit } from "@material-ui/icons";
import {Button}  from "../../../components/CustomControl/Button";

import CustomTable from "components/CustomTable/CustomTable";
import { apiCall, apiOption , LoginUserInfo, language} from "../../../actions/api";
import ExecuteQueryHook from "../../../components/hooks/ExecuteQueryHook";

import ProductGroupAddEditModal from "./ProductGroupAddEditModal";

const ProductGroup = (props) => {
  const serverpage = "productgroup"; // this is .php server page

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
    { field: "rownumber", label: "SL", align: "center", width: "5%" },
    // { field: 'SL', label: 'SL',width:'10%',align:'center',visible:true,sort:false,filter:false },
    {
      field: "GroupName",
      label: "Product Group Name",
      align: "left",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "DiscountAmount",
      label: "Discount Amount",
      width: "10%",
      align: "right",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "DiscountPercentage",
      label: "Discount (%)",
      width: "10%",
      align: "right",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "IsActiveName",
      label: "Status",
      width: "10%",
      align: "center",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "custom",
      label: "Action",
      width: "7%",
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
    // console.log("rowData: ", rowData);
    // console.log("dataList: ", dataList);

    setCurrentRow({
            id: "",
            GroupName: "",
            DiscountAmount: "",
            DiscountPercentage: "",
            IsActive: true,
          });
    openModal();
  };

  const editData = (rowData) => {
    // console.log("rowData: ", rowData);
    // console.log("dataList: ", dataList);

    setCurrentRow(rowData);
    openModal();
  };

  
  function openModal() {
    setShowModal(true); //true=modal show, false=modal hide
  }

  function modalCallback(response) {
    //response = close, addedit
    // console.log('response: ', response);
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

    // apiCall.post("productgroup", { params }, apiOption()).then((res) => {
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




  // const handleChange = (e) => {
  //   const { name, value } = e.target;
  //   let data = { ...currentRow };
  //   console.log("data: ", data);
  //   data[name] = value;
  //   console.log("name: ", name);
  //   console.log("value: ", value);

  //   setCurrentRow(data);
  //   // setErrorObject({ ...errorObject, [name]: null });
  // };

  // function saveData() {
  //   var groupModal = document.getElementById("groupModal");
  //   groupModal.style.display = "none";
  //   // modal.style.display = "block";
  //   // document.querySelector(".btnUpdate").style.display = "none";
  // }

  // function updateData() {
  //   var groupModal = document.getElementById("groupModal");
  //   groupModal.style.display = "none";
  //   // modal.style.display = "block";
  //   // document.querySelector(".btnUpdate").style.display = "none";
  // }

  // function MyClickEvent(){
  //   alert(52);
  // }

  // const columns2 = [
  //   { field: 'rownumber', label: 'SL' ,align:'center',width:'5%'},
  //   // { field: 'SL', label: 'SL',width:'10%',align:'center',visible:true,sort:false,filter:false },
  //   { field: 'ProductCetegoryName', label: 'Product Cetegory Name',align:'left',visible:true,sort:true,filter:true },
  //   { field: 'ProductGroup', label: 'Product Group',width:'25%',align:'left',visible:true,sort:true,filter:true },
  //   { field: 'Status', label: 'Status',width:'15%',align:'left',visible:false,sort:true,filter:true },
  //   { field: 'custom', label: 'Action',width:'7%',align:'center',visible:true,sort:false,filter:false },
  // ]

  // const rows2 = [
  //   { id: 1, SL: '1', ProductCetegoryName: "Tablet", ProductGroup: "Pharma", Status: 'Active', Action: "11"},
  //   { id: 2, SL: '2', ProductCetegoryName: "Food & Brevarage", ProductGroup: "Departmental", Status: 'Active', Action: "Edit Delete"},
  //   { id: 3, SL: '3', ProductCetegoryName: "Syrup", ProductGroup: "Pharma", Status: 'Active', Action: "Edit Delete"},
  //   { id: 4, SL: '4', ProductCetegoryName: "Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care Baby Care", ProductGroup: "Departmental", Status: 'Active', Action: "Edit Delete"},
  //   { id: 5, SL: '5', ProductCetegoryName: "Baby Care2", ProductGroup: "Departmental", Status: 'Active', Action: "Edit Delete"},
  //   { id: 6, SL: '6', ProductCetegoryName: "Baby Care3", ProductGroup: "Departmental", Status: 'Active', Action: "Edit Delete"},
  //   { id: 7, SL: '7', ProductCetegoryName: "Baby Care4", ProductGroup: "Departmental", Status: 'Active', Action: "Edit Delete"},
  //   { id: 8, SL: '8', ProductCetegoryName: "Baby Care5", ProductGroup: "Departmental", Status: 'Active', Action: "Edit Delete"},
  //   { id: 9, SL: '9', ProductCetegoryName: "Baby Care6", ProductGroup: "Departmental", Status: 'Active', Action: "Edit Delete"},
  //   { id: 10, SL: '10', ProductCetegoryName: "Baby Care7", ProductGroup: "Departmental", Status: 'Active', Action: "Edit Delete"},
  //   { id: 11, SL: '11', ProductCetegoryName: "Baby Care8", ProductGroup: "Departmental", Status: 'Active', Action: "Edit Delete"},
  //   { id: 12, SL: '12', ProductCetegoryName: "zBaby Care9", ProductGroup: "Departmental", Status: 'Active', Action: "Edit Delete"},

  // ]


  // function HookOutput(){
  //   console.log(123);
  //   console.log("HookOutput data",dataList);
  //   console.log("HookOutput error",error);
  // }

  return (
    <>
      <div class="bodyContainer">
        {/* <!-- ######-----TOP HEADER-----####### --> */}
        <div class="topHeader">
          <h4>
            <a href="#">Home</a> ❯ Settings ❯ Product Group Information
          </h4>
        </div>

        {/* <!-- TABLE SEARCH AND GROUP ADD --> */}
        <div class="searchAdd">
          {/* <input type="text" placeholder="Search Product Group"/> */}
          <label></label>
          {/* <button
            onClick={() => {
              addData();
            }}
            className="btnAdd"
          >
            ADD
          </button> */}

          <Button label={"ADD"} class={"btnAdd"} onClick={addData} />



          {/* <button onClick={() => {
                    setShowModal(true);
                  }} 
                  className="btnAdd">Modal</button> */}

          {/* <button onClick={() => {
                    getDataList();
                  }} 
                  className="btnAdd">Hook</button>

          <button onClick={() => {
                    HookOutput();
                  }} 
                  className="btnAdd">Hook Output</button> */}

          {/* 
  <button onClick={() => {
                    getDataList();
                  }} 
                  className="btnAdd">Show</button> */}
        </div>

        {/* <!-- ####---THIS CLASS IS USE FOR TABLE GRID PRODUCT INFORMATION---####s --> */}
        <div class="subContainer">
          <div className="App">
            <CustomTable
              columns={columnList}
              rows={dataList?dataList:{}}
              actioncontrol={actioncontrol}
            />
          </div>
        </div>
      </div>
      {/* <!-- BODY CONTAINER END --> */}


      {showModal && (<ProductGroupAddEditModal masterProps={props} currentRow={currentRow} modalCallback={modalCallback}/>)}


    </>
  );
};

export default ProductGroup;