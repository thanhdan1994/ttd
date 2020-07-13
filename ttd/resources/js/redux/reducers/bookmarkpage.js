const initialState = {
    bookmarks: [],
    page: 1,
    hasMore: true
};
export default function (state = initialState, action) {
    switch (action.type) {
        case 'SET_BOOKMARKS_BOOKMARKPAGE':
            return {
                ...state,
                bookmarks: [...state.bookmarks,...action.data],
            };
        case 'SET_PAGE_BOOKMARKPAGE':
            return {
                ...state,
                page: action.data,
            };
        case 'SET_HAS_MORE_BOOKMARKPAGE':
            return {
                ...state,
                hasMore: action.data,
            };
        default:
            return state;
    }
}
