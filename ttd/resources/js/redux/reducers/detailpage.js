const initialState = {
    reported: false,
};

export default function (state = initialState, action) {
    switch (action.type) {
        case 'SET_REPORTED':
            return {
                ...state,
                reported: action.reported
            };
        default:
            return state;
    }
}
