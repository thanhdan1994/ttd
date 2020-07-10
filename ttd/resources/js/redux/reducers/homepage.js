const initialState = {
    articles: [],
    loading: true,
    page: 1,
    hasMore: true
};
export default function (state = initialState, action) {
    const data = action.data;
    switch (action.type) {
        case 'SET_ARTICLES_HOMEPAGE':
            return {
                ...state,
                articles: [...state.articles,...data],
            };
        case 'SET_PAGE_HOMEPAGE':
            return {
                ...state,
                page: data,
            };
        case 'SET_LOADING_HOMEPAGE':
            return {
                ...state,
                loading: data,
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
