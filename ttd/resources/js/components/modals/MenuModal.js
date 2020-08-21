import React from "react";
import { connect } from "react-redux";
import {Modal} from "react-bootstrap";
import { handleCloseModal } from "../../redux/actions";
import {Link} from "react-router-dom";

function MenuModal({ showMenuModal, handleCloseModal }) {
    return (
        <Modal show={showMenuModal} onHide={handleCloseModal} animation={false}>
            <div className="modal-content animate-bottom">
                <div className="modal-header">
                    <h4 className="modal-title"> Tài khoản của bạn</h4>
                    <button type="button" className="close" onClick={handleCloseModal}><i className="icon icon-close-popup" /></button>
                </div>
                <div className="modal-body">
                    <ul className="modal__menu">
                        <li>
                            <a href="#"><i className="icon icon-exit"></i><span> ĐĂNG XUẤT</span></a>
                        </li>
                        <li>
                            <a href="#"><i className="icon icon-pin"></i><span> QUẬN GÒ VẤP (124)</span></a>
                        </li>
                        <li>
                            <a href="#"><i className="icon icon-pin"></i><span> QUẬN PHÚ NHUẬN (1344)</span></a>
                        </li>
                        <li>
                            <a href="#"><i className="icon icon-pin"></i><span> QUẬN THỦ ĐỨC (1524)</span></a>
                        </li>
                        <li>
                            <a href="#"><i className="icon icon-pin"></i><span> QUẬN 12 (2224)</span></a>
                        </li>
                        <li>
                            <a href="#"><i className="icon icon-pin"></i><span> QUẬN TÂN BÌNH (3324)</span></a>
                        </li>
                        <li>
                            <a href="#"><i className="icon icon-pin"></i><span> QUẬN BÌNH TÂN (3524)</span></a>
                        </li>
                        <li>
                            <a href="#"><i className="icon icon-pin"></i><span> QUẬN 8 (4324)</span></a>
                        </li>
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
    return {showMenuModal: state.modal.showMenuModal};
};
export default connect(mapStateToProps, { handleCloseModal })(MenuModal)
