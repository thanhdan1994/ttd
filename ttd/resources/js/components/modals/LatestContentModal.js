import React from "react";
import { Modal } from 'react-bootstrap';
import Service from "../slider/ServiceSlider";
import { connect } from "react-redux";
import { handleCloseLatestModal } from "../../redux/actions";

function LatestContentModal({handleCloseLatestModal, showLatestModal}) {
    return (
        <Modal show={showLatestModal} onHide={handleCloseLatestModal} animation={false}>
            <div className="modal-content animate-bottom">
                <div className="modal-header">
                    <h4 className="modal-title"> Tin Mới Nhất</h4>
                    <button type="button" className="close" onClick={handleCloseLatestModal}><i className="icon icon-close-popup" /></button>
                </div>
                <div className="modal-body mt-3">
                    <article className="art-3">
                        <h3><a href="/tin-tuc/an-do-xay-benh-vien-da-chien-lon-nhat-the-gioi-chong-covid19-2020061820172715.html">Ấn Độ xây bệnh viện dã chiến lớn nhất thế giới chống Covid-19</a></h3>
                        <div className="outer-time">
                            <a className="category" href="/tin-tuc">Tin ...Tức Cười</a>
                        </div>
                        <div className="outer-thumb">
                            <a className="thumbs" href="/tin-tuc/an-do-xay-benh-vien-da-chien-lon-nhat-the-gioi-chong-covid19-2020061820172715.html">
                                <img className="lazyload" src="https://cuoifly.tuoitre.vn/475/297/ttc/r/2020/06/18/sung-dai-hay-ky-thuat-1592471751-16x9.jpg" alt="Ấn Độ xây bệnh viện dã chiến lớn nhất thế giới chống Covid-19" />
                            </a>
                        </div>
                        <div className="info">
                            <div className="info1">
                                <span><i className="fas fa-money-bill" /> Giá: 500,000vnđ</span>
                                <span>Khu vực: Gò vấp <i className="fas fa-location" /></span>
                            </div>
                            <div className="info2">
                                <span><i className="fas fa-comment" /> Bình luận: 5</span>
                                <span><a href="tel:0982390731">0982390731</a> <i className="fas fa-phone" /></span>
                            </div>
                        </div>
                        <Service />
                        <div className="detail-comment">
                            <a className="more-comment">Xem thêm 2 bình luận</a>
                            <ul className="wrapper-comment cm-wrap">
                                <div className="comment" data-id={76781} style={{animationDelay: '0s'}}>
                                    <span className="comment-avatar" style={{backgroundColor: '#172b4d'}}>V</span>
                                    <div className="comment-media" data-cmid={76781} data-author="Vikinh">
                                        <div className="comment-content">
                                            <span className="comment-name">
                                              Vikinh
                                            </span>
                                            <span className="comment-text">
                                                <pre>Nghề của các cô đúng ra không có mang vác nặng ! Nhưng lại nhọc nhằn , trong việc trông giữ , dạy trẻ chứ bộ chơi sao !? Còn phải yêu thương trẻ dù không phải con đẻ ! Gặp kiểu dì ghẻ là hổi ôi cho các bé lun !? Chứ sao !</pre>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                            <div className="form-group">
                                <textarea placeholder="Nhập và nhấn enter để gửi" spellCheck="false" defaultValue={""} />
                            </div>
                        </div>
                    </article>
                    <button className="btn-more-down" style={{backgroundSize: '55px'}} />
                </div>
            </div>
        </Modal>
    )
}
const mapStateToProps = state => {
    return { showLatestModal: state.modal.showLatestModal };
};
export default connect(mapStateToProps, { handleCloseLatestModal })(LatestContentModal);
