import { LOGIN } from "../actionTypes";

const initialState = {
    login: false,
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
