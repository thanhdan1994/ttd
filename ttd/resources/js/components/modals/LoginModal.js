import React, {useState} from "react";
import { connect } from "react-redux";
import { Modal } from 'react-bootstrap';
import { handleCloseModalLogin, handleShowModalRegister, handleLogin } from '../../redux/actions';
import AuthService from "../../services/AuthService";

function LoginModal(props) {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');
    const [showError, setShowError] = useState(false);

    async function handleFormSubmit(event) {
        event.preventDefault();
        const postData = {
            username,
            password
        };
        const response = await AuthService.doUserLogin(postData);
        if (response) {
            AuthService.handleLoginSuccess(response, true);
            alert('Đăng nhập thành công!');
            window.location.reload(false)
        } else {
            setShowError(true);
        }
    }
    return (
        <Modal show={props.showLoginModal} onHide={props.handleCloseModalLogin} animation={false}>
            <div className="modal-content animate-bottom">
                <div className="modal-header">
                    <h4 className="modal-title"> Đăng nhập</h4>
                    <button type="button" className="close" onClick={props.handleCloseModalLogin}><i className="icon icon-close-popup" /></button>
                </div>
                <div className="modal-body">
                    {showError && <span className="error" style={{color: 'red'}}>Thông tin đăng nhập không chính xác!</span>}
                    <div className="myform form ">
                        <div className="form-group">
                            <label htmlFor="account">Tài khoản</label>
                            <input type="text" onChange={(e) => setUsername(e.target.value)} className="form-control" />
                        </div>
                        <div className="form-group">
                            <label htmlFor="password">Mật khẩu</label>
                            <input type="password" onChange={(e) => setPassword(e.target.value)} className="form-control" />
                        </div>
                        <div className="form-group">
                            <p className="text-center">Khi đăng nhập bạn đã đồng ý với <a href="#">điều khoản</a> của chúng tôi</p>
                        </div>
                        <div className="col-md-12 text-center ">
                            <button type="button" onClick={(e) => handleFormSubmit(e)} className="btn btn-block btn-yellow">Đăng nhập</button>
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
                    </div>
                </div>
            </div>
        </Modal>
    )
}

const mapStateToProps = state => {
    return { showLoginModal: state.modal.showLoginModal, login : state.user.login };
};
export default connect(mapStateToProps, {
    handleCloseModalLogin,
    handleShowModalRegister,
    handleLogin
})(LoginModal)
