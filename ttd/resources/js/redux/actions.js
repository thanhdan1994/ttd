import {
    SHOW_MODAL_LOGIN,
    SHOW_MODAL_REGISTER,
    SHOW_MODAL_NOTIFICATION,
    SHOW_SEARCH_MODAL,
    SHOW_POST_MODAL,
    LOGIN,
    SHOW_COMMENTS_MODAL, SHOW_REPORT_MODAL, SHOW_WRITE_REPORT_MODAL,
    SET_NOTIFICATIONS
} from './actionTypes';

export const handleShowModalLogin = () => ({
    type: SHOW_MODAL_LOGIN
});

export const handleShowModalRegister = () => ({
    type: SHOW_MODAL_REGISTER
});

export const handleShowNotificationModal = () => ({
    type: SHOW_MODAL_NOTIFICATION
});

export const handleShowSearchModal = () => ({
    type: SHOW_SEARCH_MODAL
});

export const handleShowPostModal = () => ({
    type: SHOW_POST_MODAL
});

export const handleLogin = () => ({
    type: LOGIN
});

export const handleSetNotifications = notifications => ({
    type: SET_NOTIFICATIONS,
    data: notifications
});

export const handleShowCommentsModal = () => ({
    type: SHOW_COMMENTS_MODAL
});

export const handleShowReportModal = reportId => ({
    type: SHOW_REPORT_MODAL,
    reportId: reportId
});

export const handleShowWriteReportModal = () => ({
    type: SHOW_WRITE_REPORT_MODAL
});

export const handleLikeUnlike = data => ({
    type: 'LIKE_UNLIKE',
    data: data
});

export const handleLikeComment = commentId => ({
    type: 'SET_LIKE_COMMENT',
    commentId: commentId
});

export const handleRemoveLikeComment = commentId => ({
    type: 'REMOVE_LIKE_COMMENT',
    commentId: commentId
});

export const handleCloseModal = () => ({
    type: 'CLOSE_MODAL',
});

export const handleShowMenuModal = () => ({
    type: 'SHOW_MENU_MODAL',
});
