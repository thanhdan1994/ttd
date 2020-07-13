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
                page: data,
            };
        case 'SET_HAS_MORE':
            return {
                ...state,
                hasMore: data,
            };
        default:
            return state;
    }
}
