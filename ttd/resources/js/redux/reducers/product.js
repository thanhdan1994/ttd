const initialState = {
    liked: false,
    unliked: false,
    like: 0,
    unlike: 0,
};

export default function (state = initialState, action) {
    switch (action.type) {
        case 'LIKE_UNLIKE': {
            return action.data;
        }
        default:
            return state;
    }
}
