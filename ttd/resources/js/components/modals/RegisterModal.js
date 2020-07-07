import React, { useState } from "react";
import { connect } from "react-redux";
import { Modal } from 'react-bootstrap';
import { handleCloseModalRegister, handleShowModalLogin, handleLogin } from "../../redux/actions";
import AuthService from "../../services/AuthService";
import ErrorMessages from "../ErrorMessages";

function RegisterModal(props) {
    const [errors, setErrors] = useState([]);
    const [data, setData] = useState({
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
    });
    async function handleRegisterUser(event) {
        event.preventDefault();
        const response = await AuthService.registerUser(data);
        if (response.token) {
            setErrors([]);
            AuthService.handleRegisterSuccess(response);
            alert('Đăng ký tài khoản thành công!');
            window.location.reload(false)
        } else {
            setErrors(response.errors)
        }
    }
    return (
            <Modal show={props.showRegisterModal} onHide={props.handleCloseModalRegister} animation={false}>
                <div className="modal-content animate-bottom">
                    <div className="modal-header">
                        <h4 className="modal-title"> Đăng ký tài khoản</h4>
                        <button type="button" className="close" onClick={props.handleCloseModalRegister}><i className="icon icon-close-popup" /></button>
                    </div>
                    <div className="modal-body">
                        {errors && <ErrorMessages errors={errors}/>}
                        <div className="myform form ">
                            <div className="form-group">
                                <label>Tên của bạn</label>
                                <input type="text" name="name" onChange={e => setData({...data, name: e.target.value})} className="form-control" id="firstname" placeholder="Nguyễn Văn A" />
                            </div>
                            <div className="form-group">
                                <label htmlFor="exampleInputEmail1">Địa chỉ email</label>
                                <input type="email" name="email" onChange={e => setData({...data, email: e.target.value})} className="form-control" id="email" aria-describedby="emailHelp" placeholder="example@gmail.com" />
                            </div>
                            <div className="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" name="password" id="password" onChange={e => setData({...data, password: e.target.value})} className="form-control" />
                            </div>
                            <div className="form-group">
                                <label>Mật khẩu xác nhận</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" onChange={e => setData({...data, password_confirmation: e.target.value})} className="form-control" />
                            </div>
                            <div className="col-md-12 text-center mb-3">
                                <button type="button" className="btn btn-block btn-yellow tx-tfm" onClick={handleRegisterUser}>Đăng ký</button>
                            </div>
                            <div className="col-md-12 ">
                                <div className="form-group">
                                    <p className="text-center">Bạn đã có tài khoản?<a href="#" onClick={props.handleShowModalLogin}> Đăng nhập</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </Modal>
        )
}
const mapStateToProps = state => {
    return { showRegisterModal: state.modal.showRegisterModal };
};
export default connect(mapStateToProps, {handleCloseModalRegister, handleShowModalLogin, handleLogin})(RegisterModal);
