import { combineReducers } from "redux";
import modal from "./modal";
import user from "./user";
import product from "./product";
import comments from "./comments";
import homepage from "./homepage";
import detailpage from "./detailpage";
import bookmarkpage from "./bookmarkpage";

export default combineReducers({ modal, user, product, comments, homepage, detailpage, bookmarkpage });
