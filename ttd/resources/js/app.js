
require('./bootstrap');
import React, { useEffect } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, useLocation } from "react-router-dom";
import { Provider } from 'react-redux'
import store from './redux/store'

import Main from "./Main";

export default function ScrollToTop() {
    const { pathname } = useLocation();

    useEffect(() => {
        window.scrollTo(0, 0);
    }, [pathname]);

    return null;
}

ReactDOM.render(
    <Provider store={store}>
        <Router>
            <ScrollToTop/>
            <Main/>
        </Router>
    </Provider>,
document.getElementById('app')
);
