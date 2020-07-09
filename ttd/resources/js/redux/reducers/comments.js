const initialState = [];

Array.prototype.remove = function() {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};

export default function (state = initialState, action) {
    const commentId = action.commentId;
    switch (action.type) {
        case 'SET_LIKE_COMMENT':
            return [...state, commentId];
        case 'REMOVE_LIKE_COMMENT':
            let newState = state.remove(commentId);
            console.log(newState);
            return newState;
        default:
            return state;
    }
}
