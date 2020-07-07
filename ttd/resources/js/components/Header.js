import React, { Fragment } from "react";
import Bookmark from "./Items/Bookmark";
import { connect } from "react-redux";
import { handleShowSearchModal } from '../redux/actions';
import {Link} from "react-router-dom";

function Header({handleShowSearchModal}) {
    return (
        <Fragment>
            <header className="header d-flex justify-content-between">
                <h1>
                    <Link className="logo" to="/">
                        <img src="https://cdncuoi.tuoitre.vn/ttc/sources/mimg/logo.svg" alt="hihi" />
                    </Link>
                </h1>
                <button className="btn btn-search text-light" type="button" onClick={handleShowSearchModal}>
                    <i className="fas fa-search" />
                </button>
            </header>
            <section className="tool-top">
                <ul className="list-tool d-flex justify-content-around">
                    <li>
                        <a>
                            <i className="icon icon-nearby" /> Tìm quanh đây
                        </a>
                    </li>
                    <li>
                        <a>
                            <i className="icon icon-hot" /> Nổi bật
                        </a>
                    </li>
                    <li>
                        <Bookmark />
                    </li>
                </ul>
            </section>
        </Fragment>
    )
}
export default connect(null, { handleShowSearchModal })(Header)
