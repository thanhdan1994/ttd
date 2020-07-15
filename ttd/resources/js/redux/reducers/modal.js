import {
    SHOW_MODAL_LOGIN,
    SHOW_MODAL_REGISTER,
    SHOW_MODAL_LATEST,
    SHOW_SEARCH_MODAL,
    SHOW_POST_MODAL,
    SHOW_COMMENTS_MODAL,
    SHOW_REPORT_MODAL,
    SHOW_WRITE_REPORT_MODAL,
    SHOW_MENU_MODAL,
    CLOSE_MODAL
} from "../actionTypes";

const initialState = {
    showLoginModal: false,
    showLatestModal: false,
    showRegisterModal: false,
    showSearchModal: false,
    showPostModal: false,
    showCommentsModal: false,
    showReportModal: false,
    showWriteReportModal: false,
    showMenuModal: false,
    reportId: 0
};

export default function (state = initialState, action) {
    switch (action.type) {
        case SHOW_MODAL_LOGIN: {
            return {
                ...initialState,
                showLoginModal: true,
            }
        }
        case SHOW_MODAL_REGISTER: {
            return {
                ...initialState,
                showRegisterModal: true,
            }
        }
        case SHOW_MODAL_LATEST: {
            return {
                ...initialState,
                showLatestModal: true,
            }
        }
        case SHOW_SEARCH_MODAL: {
            return {
                ...initialState,
                showSearchModal: true,
            }
        }
        case SHOW_POST_MODAL: {
            return {
                ...initialState,
                showPostModal: true,
            }
        }
        case SHOW_COMMENTS_MODAL: {
            return {
                ...initialState,
                showCommentsModal: true,
            }
        }
        case SHOW_REPORT_MODAL: {
            return {
                ...initialState,
                showReportModal: true,
                reportId: action.reportId
            }
        }
        case SHOW_WRITE_REPORT_MODAL: {
            return {
                ...initialState,
                showWriteReportModal: true,
            }
        }
        case SHOW_MENU_MODAL: {
            return {
                ...initialState,
                showMenuModal: true,
            }
        }
        case CLOSE_MODAL: {
            return initialState;
        }
        default:
            return state;
    }
}
