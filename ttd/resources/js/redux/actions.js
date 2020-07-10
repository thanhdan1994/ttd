import {
    SHOW_MODAL_LOGIN,
    SHOW_MODAL_REGISTER,
    SHOW_MODAL_LATEST,
    SHOW_SEARCH_MODAL,
    CLOSE_MODAL_LOGIN,
    CLOSE_MODAL_REGISTER,
    CLOSE_MODAL_LATEST,
    CLOSE_SEARCH_MODAL,
    SHOW_POST_MODAL,
    CLOSE_POST_MODAL,
    LOGIN,
    CLOSE_COMMENTS_MODAL,
    SHOW_COMMENTS_MODAL
} from './actionTypes';

export const handleShowModalLogin = () => ({
    type: SHOW_MODAL_LOGIN
});

export const handleCloseModalLogin = () => ({
    type: CLOSE_MODAL_LOGIN
});


export const handleShowModalRegister = () => ({
    type: SHOW_MODAL_REGISTER
});

export const handleCloseModalRegister = () => ({
    type: CLOSE_MODAL_REGISTER
});

export const handleShowLatestModal = () => ({
    type: SHOW_MODAL_LATEST
});

export const handleCloseLatestModal = () => ({
    type: CLOSE_MODAL_LATEST
});

export const handleShowSearchModal = () => ({
    type: SHOW_SEARCH_MODAL
});

export const handleCloseModalSearch = () => ({
    type: CLOSE_SEARCH_MODAL
});

export const handleShowPostModal = () => ({
    type: SHOW_POST_MODAL
});

export const handleClosePostModal = () => ({
    type: CLOSE_POST_MODAL
});


export const handleLogin = () => ({
    type: LOGIN
});

export const handleShowCommentsModal = () => ({
    type: SHOW_COMMENTS_MODAL
});

export const handleCloseCommentsModal = () => ({
    type: CLOSE_COMMENTS_MODAL
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

