import React from "react";
import { connect } from "react-redux";
import {Modal} from "react-bootstrap";
import { handleCloseModal } from "../../redux/actions";

function MenuModal({ showMenuModal, handleCloseModal }) {
    return (
        <Modal show={showMenuModal} onHide={handleCloseModal} animation={false}>
            <div className="modal-content animate-bottom">
                <div className="modal-header">
                    <h4 className="modal-title"> Tài khoản của bạn</h4>
                    <button type="button" className="close" onClick={handleCloseModal}><i className="icon icon-close-popup" /></button>
                </div>
                <div className="modal-body">
                </div>
            </div>
        </Modal>
    )
}

const mapStateToProps = state => {
    return {showMenuModal: state.modal.showMenuModal};
};
export default connect(mapStateToProps, { handleCloseModal })(MenuModal)
