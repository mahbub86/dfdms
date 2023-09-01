import axios from "axios";

export const body = {
  page_limit: JSON.stringify(100),
  page_number: JSON.stringify(0 + 1),
  search_key: "",
};

const UserInfo = sessionStorage.getItem("User_info") ? JSON.parse(sessionStorage.getItem("User_info")): 0;  
const LoginUser = UserInfo===0 ? [] : UserInfo;
const lan = "en_GB";


const auth_token = sessionStorage.getItem("token") ? sessionStorage.getItem("token") : null;
let options = {};
options = {
  headers: {
    "Content-Type": "application/json",
    "Access-Control-Allow-Origin": "*", 
    Authorization: `Bearer ${auth_token}`,
  },
};

 
export const apiCall = axios.create({
  baseURL: process.env.REACT_APP_API_URL + "source/api/",
 // baseURL: "http://localhost/phamangpl/backend/source/api/",
});

export const apiOption = () => {
  return (
    options
  )
}

export const language = () => {
  return (lan)
}

export const LoginUserInfo = () => {
  return (LoginUser)
}


