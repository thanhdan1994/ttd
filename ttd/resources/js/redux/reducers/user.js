import { LOGIN } from "../actionTypes";
import CookieService from "../../services/CookieService";

const initialState = {
    login: CookieService.get('access_token') ? true : false,
};

export default function (state = initialState, action) {
    switch (action.type) {
        case LOGIN: {
            return {
                ...state,
                login: true
            }
        }
        default:
            return state;
    }
}
