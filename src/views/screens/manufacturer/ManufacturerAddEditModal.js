import React, { forwardRef, useRef, useEffect, useState } from "react";
import { Button } from "../../../components/CustomControl/Button";
import {
  apiCall,
  apiOption,
  LoginUserInfo,
  language,
} from "../../../actions/api";

const ManufacturerAddEditModal = (props) => {
  // console.log('props modal: ', props);
  const serverpage = "manufacturer"; // this is .php server page

  const [supplierTypeList, setSupplierTypeList] = useState(null);
  const [currentRow, setCurrentRow] = useState([]);
  const [errorObject, setErrorObject] = useState({});

  React.useEffect(() => {
    getSupplierType();
  }, []);

  function getSupplierType() {
    let UserInfo = LoginUserInfo();

    let params = {
      action: "SupplierTypeList",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
      // rowData: rowData,
    };

    apiCall.post("combo_generic", { params }, apiOption()).then((res) => {
      setSupplierTypeList(
        [{ id: "", name: "Select type" }].concat(res.data.datalist)
      );
      setCurrentRow(props.currentRow);
    });
  }

  const handleChange = (e) => {
    const { name, value } = e.target;
    let data = { ...currentRow };
    data[name] = value;
    setCurrentRow(data);

    setErrorObject({ ...errorObject, [name]: null });
  };

  function handleChangeCheck(e) {
    // console.log('e.target.checked: ', e.target.checked);
    const { name, value } = e.target;

    let data = { ...currentRow };
    data[name] = e.target.checked;
    setCurrentRow(data);
    //  console.log('aaa data: ', data);
  }

  const validateForm = () => {
    // let validateFields = ["GroupName", "DiscountAmount", "DiscountPercentage"]
    let validateFields = ["ManufacturerName", "SupplierTypeId"];
    let errorData = {};
    let isValid = true;
    validateFields.map((field) => {
      if (!currentRow[field]) {
        errorData[field] = "validation-style";
        isValid = false;
      }
    });
    setErrorObject(errorData);
    return isValid;
  };

  function addEditAPICall() {
    if (validateForm()) {
      let UserInfo = LoginUserInfo();
      let params = {
        action: "dataAddEdit",
        lan: language(),
        UserId: UserInfo.UserId,
        ClientId: UserInfo.ClientId,
        BranchId: UserInfo.BranchId,
        rowData: currentRow,
      };

      apiCall.post(serverpage, { params }, apiOption()).then((res) => {
        // console.log('res: ', res);

        props.masterProps.openNoticeModal({
          isOpen: true,
          msg: res.data.message,
          msgtype: res.data.success,
        });

        // console.log('props modal: ', props);
        if (res.data.success === 1) {
          props.modalCallback("addedit");
        }
      });
    }
  }

  function modalClose() {
    props.modalCallback("close");
  }

  return (
    <>
      {/* <!-- GROUP MODAL START --> */}
      <div id="groupModal" class="modal">
        {/* <!-- Modal content --> */}
        <div class="modal-content">
          <div class="modalHeader">
            <h4>Add/Edit Manufacturer</h4>
          </div>



          <div class="contactmodalBody pt-10">

                <label>Manufacturer Name *</label>
                <input
                  type="text"
                  id="ManufacturerName"
                  name="ManufacturerName"
                  class={errorObject.ManufacturerName}
                  placeholder="Enter manufacturer name"
                  value={currentRow.ManufacturerName}
                  onChange={(e) => handleChange(e)}
                />
                
                <label>Type *</label>               
                <select
                  id="SupplierTypeId"
                  name="SupplierTypeId"
                  class={errorObject.SupplierTypeId}
                  value={currentRow.SupplierTypeId}
                  onChange={(e) => handleChange(e)}
                >
                  {supplierTypeList &&
                    supplierTypeList.map((item, index) => {
                      return <option value={item.id}>{item.name}</option>;
                    })}
                </select>
                

                <label>Address</label>
                <textarea 
                  id="Address"
                  name="Address"
                  value={currentRow.Address}
                  onChange={(e) => handleChange(e)}
                >
                </textarea>

                <label>Email</label>
                <input
                  type="text"
                  id="Email"
                  name="Email"
                  // class={errorObject.Email}
                  placeholder="Enter email"
                  value={currentRow.Email}
                  onChange={(e) => handleChange(e)}
                />


                <label>Office Phone</label>
                <input
                  type="text"
                  id="OfficePhone"
                  name="OfficePhone"
                  // class={errorObject.OfficePhone}
                  placeholder="Enter office phone"
                  value={currentRow.OfficePhone}
                  onChange={(e) => handleChange(e)}
                />

                <label>Contact Name</label>
                <input
                  type="text"
                  id="ContactName"
                  name="ContactName"
                  // class={errorObject.ContactName}
                  placeholder="Enter contact name"
                  value={currentRow.ContactName}
                  onChange={(e) => handleChange(e)}
                />

                <label>Contact Phone</label>
                <input
                  type="text"
                  id="ContactPhone"
                  name="ContactPhone"
                  // class={errorObject.ContactPhone}
                  placeholder="Enter contact phone"
                  value={currentRow.ContactPhone}
                  onChange={(e) => handleChange(e)}
                />

            </div>
 
            <div class="modalItem">
            <label> Is Active?</label>
            <input
              id="IsActive"
              name="IsActive"
              type="checkbox"
              checked={currentRow.IsActive}
              onChange={handleChangeCheck}
            />
          </div> 

          <div class="modalItem">
            <Button label={"Close"} class={"btnClose"} onClick={modalClose} />
            {props.currentRow.id && (
              <Button
                label={"Update"}
                class={"btnUpdate"}
                onClick={addEditAPICall}
              />
            )}
            {!props.currentRow.id && (
              <Button
                label={"Save"}
                class={"btnSave"}
                onClick={addEditAPICall}
              />
            )}
          </div>
        </div>
      </div>
      {/* <!-- GROUP MODAL END --> */}
    </>
  );
};

export default ManufacturerAddEditModal;
