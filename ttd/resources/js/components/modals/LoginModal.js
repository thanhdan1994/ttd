import React from "react";
import { connect } from "react-redux";
import { Modal } from 'react-bootstrap';
import { handleCloseModalLogin, handleShowModalRegister } from '../../redux/actions';

function LoginModal(props) {
    return (
        <Modal show={props.showLoginModal} onHide={props.handleCloseModalLogin} animation={false}>
            <div className="modal-content animate-bottom">
                <div className="modal-header">
                    <h4 className="modal-title"> Đăng nhập</h4>
                    <button type="button" className="close" onClick={props.handleCloseModalLogin}><i className="icon icon-close-popup" /></button>
                </div>
                <div className="modal-body">
                    <div className="myform form ">
                        <form method="post" name="login">
                            <div className="form-group">
                                <label htmlFor="account">Tài khoản</label>
                                <input type="text" name="account" className="form-control" id="account" />
                            </div>
                            <div className="form-group">
                                <label htmlFor="password">Mật khẩu</label>
                                <input type="password" name="password" id="password" className="form-control" />
                            </div>
                            <div className="form-group">
                                <p className="text-center">Khi đăng nhập bạn đã đồng ý với <a href="#">điều khoản</a> của chúng tôi</p>
                            </div>
                            <div className="col-md-12 text-center ">
                                <button type="submit" className="btn btn-block btn-yellow">Đăng nhập</button>
                            </div>
                            <div className="col-md-12 ">
                                <div className="login-or">
                                    <hr className="hr-or" />
                                    <span className="span-or">or</span>
                                </div>
                            </div>
                            <div className="col-md-12 mb-3">
                                <p className="text-center">
                                    <a className="google btn">
                                        <i className="icon icon-google" /> Đăng nhập bằng google
                                    </a>
                                </p>
                            </div>
                            <div className="form-group">
                                <p className="text-center">Bạn vẫn chưa có tài khoản? <a href="#" onClick={props.handleShowModalRegister}>Đăng ký</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </Modal>
    )
}

const mapStateToProps = state => {
    return { showLoginModal: state.modal.showLoginModal };
};
export default connect(mapStateToProps, { handleCloseModalLogin, handleShowModalRegister })(LoginModal)
