import React from "react";
import { connect } from "react-redux";
import { Modal } from 'react-bootstrap';
import { handleCloseModal } from '../../redux/actions';

function SearchModal({ showSearchModal, handleCloseModal}) {
    return (
        <Modal show={showSearchModal} onHide={handleCloseModal} animation={false}>
            <div className="modal-content animate-top">
                <div className="modal-header">
                    <h4 className="modal-title"> Tìm kiếm</h4>
                    <button type="button" className="close" onClick={handleCloseModal}><i className="icon icon-close-popup" /></button>
                </div>
                <div className="modal-body">
                    <form action="#">
                        <div className="form-group">
                            <label htmlFor="inputName">Lọc theo tên:</label>
                            <input type="text" className="form-control" name="name" placeholder="Enter name" id="inputName" />
                        </div>
                        <div className="form-group">
                            <label>Chọn dịch vụ</label>
                            <div className="list-services">
                                <div className="custom-control custom-switch">
                                    <input type="checkbox" className="custom-control-input" id="services1" name="service1" />
                                    <label className="custom-control-label" htmlFor="services1">services1</label>
                                </div>
                                <div className="custom-control custom-switch">
                                    <input type="checkbox" className="custom-control-input" id="services2" name="service2" />
                                    <label className="custom-control-label" htmlFor="services2">services2</label>
                                </div>
                                <div className="custom-control custom-switch">
                                    <input type="checkbox" className="custom-control-input" id="services3" name="service3" />
                                    <label className="custom-control-label" htmlFor="services3">services3</label>
                                </div>
                            </div>
                        </div>
                        <div className="form-group">
                            <label htmlFor="category">Chọn quận/huyện:</label>
                            <select className="form-control" id="category">
                                <option value="all">--Tất cả--</option>
                                <option>Gò Vấp</option>
                                <option>Phú Nhuận</option>
                                <option>Thủ Đức</option>
                            </select>
                        </div>
                        <br />
                        <button type="submit" className="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </Modal>
    )
}
const mapStateToProps = state => {
    return { showSearchModal: state.modal.showSearchModal };
};
export default connect(mapStateToProps, { handleCloseModal })(SearchModal);
