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
            const articles = [...state.articles,...data];
            const uniqueArticles = Array.from(new Set(articles.map(a => a.id)))
                .map(id => {
                    return articles.find(a => a.id === id)
                });
            return {
                ...state,
                articles: uniqueArticles,
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
