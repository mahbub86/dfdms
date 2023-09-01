import React, { useState } from "react";
//import { useQuery, useMutation, useQueryClient } from "react-query";
import * as api from "../../../actions/api";
import MyprofileFormData from "./MyprofileFormData.js";
 

//get DispensingLanguage
const DispensingLanguage = JSON.parse(
  localStorage.getItem("DispensingLanguage")
);
const lan = localStorage.getItem("LangCode");
const menukey = "my-profile";

const UserInfo = sessionStorage.getItem("User_info")
  ? JSON.parse(sessionStorage.getItem("User_info"))
  : 0;  
const userId = UserInfo==0?'': UserInfo[0].id;

const EditMyprofile = (props) => {

 

  const [formData, setFormData] = useState({
    id: "",
    name: "",
    email: "",
    loginname: "",
    password: "",
    confirmChangePassword: "",
    designation: "",
    LangCode: "",
  });
  const [errorObject, setErrorObject] = useState({});
  // const { id } = useParams();
  const id = userId;


  const queryClient = useQueryClient();

  const { data } = useQuery(
    ["Myprofile", id],
    () =>
      api.getUserProfile(id).then((res) => {
        
        setFormData(res.data);
        return res.data;
      }),
    {
      enabled: Boolean(id),
    }
  );

  const { mutate } = useMutation(api.UserProfileupdate, {
    onSuccess: (data) => {

      if (data.status == 200) {
        api.getAllDropdown('ALL').then((response) => {
          if (response.success == 1) {

            localStorage.setItem(
              "language_preference",
              JSON.stringify(response.datalist.t_language_preference)
            );
            localStorage.setItem("LangCode", data.data.LangCode);
          }

          //
        });
        props.openNoticeModal({
          isOpen: true,
          msg: data.data.message,
          msgtype: data.data.success,
        });
        queryClient.getQueriesData("userlist");
        //props.history.push("/pack-size");
      }else{

        props.openNoticeModal({
          isOpen: true,
          msg: data.message,
          msgtype: data.success,
        });
       
      }
    },
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    let data = { ...formData };
    data[name] = value;
    setFormData(data);
    setErrorObject({ ...errorObject, [name]: null });

  };

  const handleCheck = (e) => {
     

    const { name, checked } = e.target;
    setFormData({ ...formData, [name]: checked });
  };

  const handleReset = () => {
    setFormData({
      adminid: "",
      name: "",
      email: "",
      loginname: "",
      password: "",
      confirmChangePassword: "",
      designation: "",
      LangCode: "",
    });
  };

  const validateForm = (formData) => {
    let validateFields = [
      "name",
      "email",
      "loginname",
      "designation",
      "LangCode",
    ];
    let errorData = {};
    let isValid = true;
    validateFields.map((field) => {
      if (!formData[field]) {
        errorData[field] =
          DispensingLanguage[lan][menukey]["field is Required !"];
        isValid = false;
      }

      if (formData["loginname"].indexOf(" ") >= 0) {
        errorData["loginname"] =
          DispensingLanguage[lan][menukey][
            "White space is not allowed in login name."
          ];
        isValid = false;
      }

       //-----start confirm change password-----
       let cpassword = '';
       let cconfirmChangePassword = '';

       if(formData["password"]){
         cpassword = formData["password"].trim();
       }else{
         cpassword = '';
       }

       if(formData["confirmChangePassword"]){
         cconfirmChangePassword = formData["confirmChangePassword"].trim();
       }else{
         cconfirmChangePassword = '';
       }
       
       if (cpassword !== ''){

         
         //let strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])');
         //let passStrengthCheck = strongPassword.test(cpassword);
         
       
          if (cconfirmChangePassword == ''){
                errorData["confirmChangePassword"] = DispensingLanguage[lan][menukey]["Enter Confirm Change Password"];
                isValid = false;
            }else if (cpassword != cconfirmChangePassword){
              errorData["confirmChangePassword"] = DispensingLanguage[lan][menukey]["Password did not match"];
              isValid = false;
            } else{
              errorData["confirmChangePassword"] = '';
            }
                

        } 

     //-----end confirm change password-----


    });
    setErrorObject(errorData);
    return isValid;
  };

  const handleUpdate = async (e) => {
    if (validateForm(formData)) {
      mutate(formData);
     // swal("Success!", "", "success");
    }
  };

  return (
    <>
      <MyprofileFormData
        errorObject={errorObject}
        addProductForm={false}
        formData={formData}
        handleChange={handleChange}
        handleCheck={handleCheck}
        handleReset={handleReset}
        handleUpdate={handleUpdate}
        {...props}
      />
    </>
  );
};

export default EditMyprofile;
