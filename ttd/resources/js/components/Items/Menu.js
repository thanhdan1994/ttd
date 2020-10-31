import React from "react";
import { connect } from "react-redux";
import { handleShowMenuModal} from '../../redux/actions';
import MenuModal from "../modals/MenuModal";

function Menu({ handleShowMenuModal }) {
    return (
        <>
            <a className="btn-menu" onClick={handleShowMenuModal}>Menu</a>
            <MenuModal/>
        </>
    )
}

export default connect(null, { handleShowMenuModal })(Menu);
