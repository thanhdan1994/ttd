import React from "react";
import { connect } from "react-redux";
import {handleShowModalLogin, handleShowMenuModal} from '../../redux/actions';
import MenuModal from "../modals/MenuModal";

function Menu({ handleShowMenuModal, handleShowModalLogin, login }) {
    if (!login) {
        return (
            <a className="btn-menu" onClick={handleShowModalLogin}>Menu</a>
        )
    } else {
        return (
            <>
                <a className="btn-menu" onClick={handleShowMenuModal}>Menu</a>
                <MenuModal/>
            </>
        )
    }
}
const mapStateToProps = state => {
    return { login : state.user.login };
};
export default connect(mapStateToProps, { handleShowMenuModal, handleShowModalLogin })(Menu);
