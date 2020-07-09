import { combineReducers } from "redux";
import modal from "./modal";
import user from "./user";
import product from "./product";
import comments from "./comments";

export default combineReducers({ modal, user, product, comments });
