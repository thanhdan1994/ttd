import React from "react";
import { connect } from "react-redux";
import { Modal } from 'react-bootstrap';
import { handleClosePostModal } from "../../redux/actions";

function PostModal({ showPostModal, handleClosePostModal }) {
    return (
        <Modal show={showPostModal} onHide={handleClosePostModal} animation={false}>
            <div className="modal-content animate-bottom">
                <div className="modal-header">
                    <h4 className="modal-title"> Đăng bài</h4>
                    <button type="button" className="close" onClick={handleClosePostModal}><i className="icon icon-close-popup" /></button>
                </div>
                <div className="modal-body">
                    <form encType="multipart/form-data">
                        <div className="form-group">
                            <label htmlFor="namePost">TÊN BÀI VIẾT:<span style={{color: 'red'}}>*</span></label>
                            <input type="text" id="namePost" />
                            <span className="error" style={{display: 'none'}} />
                        </div>
                        <div className="form-group">
                            <label htmlFor="desSendNews">MÔ TẢ:</label>
                            <textarea id="desSendNews" name="author_description" spellCheck="false" defaultValue={""} />
                        </div>
                        <div className="form-group">
                            <label htmlFor="phoneNumber">SỐ ĐIỆN THOẠI:<span style={{color: 'red'}}>*</span></label>
                            <input type="text" id="phoneNumber" />
                            <span className="error" style={{display: 'none'}} />
                        </div>
                        <div className="form-group">
                            <label htmlFor="amount">GIÁ:<span style={{color: 'red'}}>*</span></label>
                            <input type="text" id="amount" />
                            <span className="error" style={{display: 'none'}} />
                        </div>
                        <div className="form-group">
                            <label htmlFor="address">ĐỊA CHỈ:<span style={{color: 'red'}}>*</span></label>
                            <input type="text" id="address" />
                            <span className="error" style={{display: 'none'}} />
                        </div>
                        <div className="form-group">
                            <label htmlFor="latitude">LATITUDE:<span style={{color: 'red'}}>*</span></label>
                            <input type="text" id="latitude" />
                            <span className="error" style={{display: 'none'}} />
                        </div>
                        <div className="form-group">
                            <label htmlFor="longitude">LONGITUDE:<span style={{color: 'red'}}>*</span></label>
                            <input type="text" id="longitude" />
                            <span className="error" style={{display: 'none'}} />
                        </div>
                        <div className="form-group">
                            <label>ẢNH ĐẠI DIỆN:<span style={{color: 'red'}}>*</span></label>
                            <label className="file-container">
                                <input type="file" multiple aria-label />
                                <span><i className="fas fa-upload" /> Tải lên ảnh chi tiết</span>
                            </label>
                            <div className="file-preview" />
                            <span className="error" style={{display: 'none'}} />
                        </div>
                        <div className="form-group">
                            <label>CHỌN DỊCH VỤ:<span style={{color: 'red'}}>*</span></label>
                            <div className="list-services">
                                <div className="custom-control custom-switch">
                                    <input type="checkbox" className="custom-control-input" id="post_services1" name="post_services1" />
                                    <label className="custom-control-label" htmlFor="post_services1">services1</label>
                                </div>
                                <div className="custom-control custom-switch">
                                    <input type="checkbox" className="custom-control-input" id="post_services2" name="post_services2" />
                                    <label className="custom-control-label" htmlFor="post_services2">services2</label>
                                </div>
                                <div className="custom-control custom-switch">
                                    <input type="checkbox" className="custom-control-input" id="post_services3" name="post_services3" />
                                    <label className="custom-control-label" htmlFor="post_services3">services3</label>
                                </div>
                                <div className="custom-control custom-switch">
                                    <input type="checkbox" className="custom-control-input" id="post_services6" name="post_services6" />
                                    <label className="custom-control-label" htmlFor="post_services6">services6</label>
                                </div>
                                <div className="custom-control custom-switch">
                                    <input type="checkbox" className="custom-control-input" id="post_services5" name="post_services5" />
                                    <label className="custom-control-label" htmlFor="post_services5">services5</label>
                                </div>
                                <div className="custom-control custom-switch">
                                    <input type="checkbox" className="custom-control-input" id="post_services4" name="post_services4" />
                                    <label className="custom-control-label" htmlFor="post_services4">services4</label>
                                </div>
                            </div>
                        </div>
                        <div className="form-group">
                            <label htmlFor="information">Thông tin bổ sung</label>
                            <table className="table">
                                <thead>
                                <tr>
                                    <th scope="col">Thuộc tính</th>
                                    <th scope="col">Giá trị</th>
                                </tr>
                                </thead>
                                <tbody id="content-properties">
                                <tr>
                                    <th scope="row"><input type="text" name="properties[101][key]" className="form-control" defaultValue="Chiều cao" /></th>
                                    <td><input type="text" name="properties[101][value]" className="form-control" /></td>
                                </tr>
                                <tr>
                                    <th scope="row"><input type="text" name="properties[102][key]" defaultValue="Cân nặng" className="form-control" /></th>
                                    <td><input type="text" name="properties[102][value]" className="form-control" /></td>
                                </tr>
                                <tr>
                                    <th scope="row"><input type="text" name="properties[103][key]" defaultValue="Giờ hoạt động" className="form-control" /></th>
                                    <td><input type="text" name="properties[103][value]" className="form-control" /></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div className="form-group text-center mt-5">
                            <button type="submit" className="btnSendNews text-uppercase">Đăng bài</button>
                        </div>
                    </form>
                </div>
            </div>
        </Modal>
    )
};
const mapStateToProps = state => {
    return {showPostModal: state.modal.showPostModal};
};
export default connect(mapStateToProps, { handleClosePostModal })(PostModal);
