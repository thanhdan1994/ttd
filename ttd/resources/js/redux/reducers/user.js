import { LOGIN, SET_NOTIFICATIONS } from "../actionTypes";
import CookieService from "../../services/CookieService";

const initialState = {
    login: CookieService.get('access_token') ? true : false,
    notifications: [],
};

export default function (state = initialState, action) {
    switch (action.type) {
        case LOGIN: {
            return {
                ...state,
                login: true
            }
        }
        case SET_NOTIFICATIONS: {
            return {
                ...state,
                notifications: [...state.notifications, ...action.data]
            }
        }
        default:
            return state;
    }
}
