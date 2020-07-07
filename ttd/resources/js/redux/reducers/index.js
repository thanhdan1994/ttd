import { combineReducers } from "redux";
import modal from "./modal";
import user from "./user";
import product from "./product";

export default combineReducers({ modal, user, product });
