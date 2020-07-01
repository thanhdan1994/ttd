import React from "react";
import { connect } from "react-redux";
import { Modal } from 'react-bootstrap';
import { handleCloseModalRegister, handleShowModalLogin } from "../../redux/actions";

function RegisterModal(props) {
return (
        <Modal show={props.showRegisterModal} onHide={props.handleCloseModalRegister} animation={false}>
            <div className="modal-content animate-bottom">
                <div className="modal-header">
                    <h4 className="modal-title"> Đăng ký tài khoản</h4>
                    <button type="button" className="close" onClick={props.handleCloseModalRegister}><i className="icon icon-close-popup" /></button>
                </div>
                <div className="modal-body">
                    <div className="myform form ">
                        <form action="#" name="registration">
                            <div className="form-group">
                                <label htmlFor="exampleInputEmail1">First Name</label>
                                <input type="text" name="firstname" className="form-control" id="firstname" aria-describedby="emailHelp" placeholder="Enter Firstname" />
                            </div>
                            <div className="form-group">
                                <label htmlFor="exampleInputEmail1">Last Name</label>
                                <input type="text" name="lastname" className="form-control" id="lastname" aria-describedby="emailHelp" placeholder="Enter Lastname" />
                            </div>
                            <div className="form-group">
                                <label htmlFor="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" className="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" />
                            </div>
                            <div className="form-group">
                                <label htmlFor="exampleInputEmail1">Password</label>
                                <input type="password" name="password" id="password" className="form-control" aria-describedby="emailHelp" placeholder="Enter Password" />
                            </div>
                            <div className="col-md-12 text-center mb-3">
                                <button type="submit" className="btn btn-block btn-yellow tx-tfm">Đăng ký</button>
                            </div>
                            <div className="col-md-12 ">
                                <div className="form-group">
                                    <p className="text-center">Bạn đã có tài khoản?<a href="#" onClick={props.handleShowModalLogin}> Đăng nhập</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </Modal>
    )
}
const mapStateToProps = state => {
    return { showRegisterModal: state.modal.showRegisterModal };
};
export default connect(mapStateToProps, {handleCloseModalRegister, handleShowModalLogin})(RegisterModal);
