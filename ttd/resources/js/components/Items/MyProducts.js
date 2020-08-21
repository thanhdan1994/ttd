import React from "react";
import { connect } from "react-redux";
import {handleShowModalLogin, handleShowPostModal} from '../../redux/actions';
import {Link} from "react-router-dom";

function MyProducts({ handleShowModalLogin, login }) {
    if (!login) {
        return (
            <a className="btn-myProducts" onClick={handleShowModalLogin}><i className="icon icon-myProducts"></i> Sản phẩm của tôi</a>
        )
    } else {
        return (
            <>
                <Link className="btn-myProducts" to='/my-products'><i className="icon icon-myProducts"></i> Sản phẩm của tôi</Link>
            </>
        )
    }
}
const mapStateToProps = state => {
    return { login : state.user.login };
};
export default connect(mapStateToProps, { handleShowPostModal, handleShowModalLogin })(MyProducts);
