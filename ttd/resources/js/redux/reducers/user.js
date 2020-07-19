import { LOGIN, SET_NOTIFICATIONS, RECEIVE_NEW_NOTIFICATION } from "../actionTypes";
import CookieService from "../../services/CookieService";

const initialState = {
    login: CookieService.get('access_token') ? true : false,
    notifications: {
        notifications: [],
        numberNotSeen: 0
    },

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
                notifications: {
                    notifications: [...state.notifications.notifications, ...action.data.notifications],
                    numberNotSeen: action.data.numberNotSeen
                }
            }
        }
        case RECEIVE_NEW_NOTIFICATION: {
            return {
                ...state,
                notifications: {
                    notifications: [action.data, ...state.notifications.notifications],
                    numberNotSeen: ++state.notifications.numberNotSeen
                }
            }
        }
        default:
            return state;
    }
}
