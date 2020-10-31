import React, { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import { connect } from "react-redux";
import {Modal} from "react-bootstrap";
import { handleCloseModal, handleShowModalLogin } from "../../redux/actions";
import AuthService from "../../services/AuthService";
import UrlService from "../../services/UrlService";

function MenuModal({ showMenuModal, handleCloseModal, login, handleShowModalLogin }) {
    const [categories, setCategories] = useState([]);
    useEffect(() => {
        let cancel;
        axios({
            method: 'GET',
            url: UrlService.getCategoriesUrl(),
            cancelToken: new axios.CancelToken(c => cancel = c)
        }).then(response => {
            setCategories(response.data);
        }).catch(e => {
            if (axios.isCancel(e)) return;
        });
        return () => cancel();
    }, []);
    return (
        <Modal show={showMenuModal} onHide={handleCloseModal} animation={false}>
            <div className="modal-content animate-bottom">
                <div className="modal-header">
                    <h4 className="modal-title"> Tài khoản của bạn</h4>
                    <button type="button" className="close" onClick={handleCloseModal}><i className="icon icon-close-popup" /></button>
                </div>
                <div className="modal-body">
                    <ul className="modal__menu">
                        {login && <li><a href="#" onClick={() => AuthService.doUserLogout()}><i className="icon icon-logout"></i><span> ĐĂNG XUẤT</span></a></li>}
                        {!login && <li><a href="#" onClick={handleShowModalLogin}><i className="icon icon-login"></i><span> ĐĂNG NHẬP</span></a></li>}
                        {categories.map((item, index) => <li key={index}>
                            <Link to={`/categories/${item.id}/products`} onClick={handleCloseModal}><i className="icon icon-pin"></i><span> {item.name} ({item.products_count})</span></Link>
                        </li>)}
                    </ul>
                    <section>
                        <article className="art-thumb-left border-2">
                            <div className="thumbnail"><a href="/test-lai-lan-nua-1/43"><img
                                src="https://ttd.com/storage/157/conversions/dROYH1djTMQzUsAt0nzF-thumb-150.jpg"/></a>
                            </div>
                            <div className="info"><h4><a href="/test-lai-lan-nua-1/43">test lại lần nữa 1</a></h4><span><i
                                className="fas fa-money-bill"></i> Giá: 50.000 VND</span><span><i
                                className="fas fa-location"></i> Khu vực: Trái cây</span><span><i
                                className="fas fa-phone"></i> SĐT: <a href="tel:0982390731">0982390731</a></span></div>
                        </article>
                        <article className="art-thumb-left border-2">
                            <div className="thumbnail"><a href="/iphone-12-ne/39"><img
                                src="https://ttd.com/storage/151/conversions/U65tTgD4Gjglsa5Ub84G-thumb-150.jpg" /></a>
                            </div>
                            <div className="info"><h4><a href="/iphone-12-ne/39">Iphone 12 nè</a></h4><span><i
                                className="fas fa-money-bill"></i> Giá: 999.000 VND</span><span><i
                                className="fas fa-location"></i> Khu vực: Trái cây</span><span><i
                                className="fas fa-phone"></i> SĐT: <a href="tel:0982390731">0982390731</a></span></div>
                        </article>
                        <article className="art-thumb-left border-2">
                            <div className="thumbnail"><a href="/create-product-ne/42"><img
                                src="https://ttd.com/storage/156/conversions/VdCwdnILkPDLngrjjRGs-thumb-150.jpg" /></a>
                            </div>
                            <div className="info"><h4><a href="/create-product-ne/42">create product nè</a></h4><span><i
                                className="fas fa-money-bill"></i> Giá: 500.000 VND</span><span><i
                                className="fas fa-location"></i> Khu vực: Trái cây</span><span><i
                                className="fas fa-phone"></i> SĐT: <a href="tel:1900 6005">1900 6005</a></span></div>
                        </article>
                    </section>
                </div>
            </div>
        </Modal>
    )
}
const mapStateToProps = state => {
    return {showMenuModal: state.modal.showMenuModal, login : state.user.login};
};
export default connect(mapStateToProps, { handleCloseModal, handleShowModalLogin })(MenuModal)
