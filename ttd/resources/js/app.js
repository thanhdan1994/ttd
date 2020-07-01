
require('./bootstrap');
import React, { useEffect } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from "react-router-dom";
import { Provider } from 'react-redux'
import store from './redux/store'

import Main from "./Main";

ReactDOM.render(
    <Provider store={store}>
        <Router>
            <Main/>
        </Router>
    </Provider>,
document.getElementById('app')
);
