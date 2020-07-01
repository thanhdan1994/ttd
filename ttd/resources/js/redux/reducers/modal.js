import {
    SHOW_MODAL_LOGIN,
    SHOW_MODAL_REGISTER,
    SHOW_MODAL_LATEST,
    SHOW_SEARCH_MODAL,
    CLOSE_MODAL_LOGIN,
    CLOSE_MODAL_REGISTER,
    CLOSE_MODAL_LATEST, CLOSE_SEARCH_MODAL, SHOW_POST_MODAL, CLOSE_POST_MODAL
} from "../actionTypes";

const initialState = {
    showLoginModal: false,
    showLatestModal: false,
    showRegisterModal: false,
    showSearchModal: false,
    showPostModal: false,
};

export default function (state = initialState, action) {
    switch (action.type) {
        case SHOW_MODAL_LOGIN: {
            return {
                ...initialState,
                showLoginModal: true,
            }
        }
        case CLOSE_MODAL_LOGIN: {
            return initialState;
        }
        case SHOW_MODAL_REGISTER: {
            return {
                ...initialState,
                showRegisterModal: true,
            }
        }
        case CLOSE_MODAL_REGISTER: {
            return initialState;
        }
        case SHOW_MODAL_LATEST: {
            return {
                ...initialState,
                showLatestModal: true,
            }
        }
        case CLOSE_MODAL_LATEST: {
            return initialState;
        }
        case SHOW_SEARCH_MODAL: {
            return {
                ...initialState,
                showSearchModal: true,
            }
        }
        case CLOSE_SEARCH_MODAL: {
            return initialState;
        }
        case SHOW_POST_MODAL: {
            return {
                ...initialState,
                showPostModal: true,
            }
        }
        case CLOSE_POST_MODAL: {
            return initialState;
        }
        default:
            return state;
    }
}
