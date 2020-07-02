import React from "react";
import { Link } from "react-router-dom";
import { connect } from "react-redux";
import { handleShowModalLogin } from '../../redux/actions';

function Bookmark({handleShowModalLogin, login}) {
    if (!login) {
        return (
            <a onClick={handleShowModalLogin}>
                <i className="fas fa-bookmark" /> Đánh dấu
            </a>
        )
    } else {
        return (
            <Link to="/bookmarks"><i className="fas fa-bookmark" /> Đánh dấu</Link>
        )
    }
}
const mapStateToProps = state => {
    return { login : state.user.login };
};
export default connect(mapStateToProps, { handleShowModalLogin })(Bookmark);
