import React, { forwardRef, useRef, useEffect, useState } from "react";
import { Button } from "../../../components/CustomControl/Button";
import {
  apiCall,
  apiOption,
  LoginUserInfo,
  language,
} from "../../../actions/api";


const ProductGenericAddEditModal = (props) => {

  const serverpage = "productgeneric"; // this is .php server page
  const [productGroupList, setProductGroupList] = useState(null);

  const [currentRow, setCurrentRow] = useState(props.currentRow);
  const [errorObject, setErrorObject] = useState({});

  const UserInfo = LoginUserInfo();

  React.useEffect(() => {

    getProductGroup();
  }, []);

  function getProductGroup() {
 
    let params = {
      action: "ProductGroupList",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
      // rowData: rowData,
    };

    apiCall.post("combo_generic", { params }, apiOption()).then((res) => {
      setProductGroupList([{id:"", name: "Select product group"}].concat(res.data.datalist));
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
    const { name, value } = e.target;

    let data = { ...currentRow };
    data[name] = e.target.checked;
    setCurrentRow(data);
  }

  const validateForm = () => {
    console.log('currentRow validateForm: ', currentRow);
    console.log('currentRow errorObject: ', errorObject);

    // let validateFields = ["GroupName", "DiscountAmount", "DiscountPercentage"]
    let validateFields = ["ProductGroupId","GenericName"];
    let errorData = {};
    let isValid = true;
    validateFields.map((field) => {
      if (!currentRow[field]) {
        errorData[field] = "validation-style";
        isValid = false;
      }
    });
    setErrorObject(errorData);
    // console.log('errorData validateForm: ', errorData);
    return isValid;
  };

  function addEditAPICall() {
    if (validateForm()) {
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
    console.log("props modal: ", props);
    props.modalCallback("close");
  }

  return (
    <>
      {/* <!-- GROUP MODAL START --> */}
      <div id="groupModal" class="modal">
        {/* <!-- Modal content --> */}
        <div class="modal-content">
          <div class="modalHeader">
            <h4>Add/Edit Product Generic</h4>
          </div>

          <div class="modalItem">
            <label>Product Group *</label>
            <select
              id="ProductGroupId"
              name="ProductGroupId"
              class={errorObject.ProductGroupId}
              // value={currProductGroupId}
              value={currentRow.ProductGroupId}
              onChange={(e) => handleChange(e)}
            >
              {/* <option value="">Select Product Group</option>
                    <option value="1">Pharma</option>
                    <option value="2">Non Pharma</option> */}

              {productGroupList &&
                productGroupList.map((item, index) => {
                  return <option value={item.id}>{item.name}</option>;
                })}
            </select>
            {/* <button class="btnPlus">+</button> */}
          </div>

          <div class="modalItem">
            <label>Product Generic *</label>
            <input
              type="text"
              id="GenericName"
              name="GenericName"
              class={errorObject.GenericName}
              placeholder="Enter product generic name"
              value={currentRow.GenericName}
              onChange={(e) => handleChange(e)}
            />
          </div>

          <div class="modalItem">
            <label for="">Discount (Amount)</label>
            <input
              type="number"
              id="DiscountAmount"
              name="DiscountAmount"
              class={errorObject.DiscountAmount}
              value={currentRow.DiscountAmount}
              onChange={(e) => handleChange(e)}
            />
          </div>

          <div class="modalItem">
            <label for="">Discount (%)</label>
            <input
              type="number"
              id="DiscountPercentage"
              name="DiscountPercentage"
              class={errorObject.DiscountPercentage}
              value={currentRow.DiscountPercentage}
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

export default ProductGenericAddEditModal;
