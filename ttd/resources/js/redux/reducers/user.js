import { LOGIN, SET_NOTIFICATIONS, RECEIVE_NEW_NOTIFICATION } from "../actionTypes";
import CookieService from "../../services/CookieService";

const initialState = {
    login: CookieService.get('access_token') ? true : false,
    notifications: {
        notifications: [],
        numberCommentUnread: 0
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
                    numberCommentUnread: action.data.numberCommentUnread
                }
            }
        }
        case RECEIVE_NEW_NOTIFICATION: {
            return {
                ...state,
                notifications: {
                    notifications: [action.data, ...state.notifications.notifications],
                    numberCommentUnread: ++state.notifications.numberCommentUnread
                }
            }
        }
        default:
            return state;
    }
}
