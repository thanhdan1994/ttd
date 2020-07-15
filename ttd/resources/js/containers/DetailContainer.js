import React, { useState, useEffect } from "react";
import { connect } from "react-redux";
import Lightbox from 'react-image-lightbox';
import 'react-image-lightbox/style.css';
import LikeButton from "../components/Items/LikeButton";
import UnlikeButton from "../components/Items/UnlikeButton";
import { handleLikeUnlike, handleShowCommentsModal } from "../redux/actions";
import DetailContainerSkeleton from "../components/skeleton/DetailContainerSkeleton";
import Comment from "../components/Items/Comment";
import CommentsModal from "../components/modals/CommentsModal";
import BlockSendComment from "../components/Items/BlockSendComment";
import UrlService from "../services/UrlService";
import WriteReportButton from "../components/Items/WriteReportButton";
import WriteReportModal from "../components/modals/WriteReportModal";
import BlockListReport from "../components/Items/BlockListReport";
import ReportModal from "../components/modals/ReportModal";
import CookieService from "../services/CookieService";
import { handleSetReported, handleBookmark } from "../redux/actions/detailpage";
import BookmarkButton from "../components/Items/BookmarkButton";

function DetailContainer({ match, handleLikeUnlike, handleShowCommentsModal, modal, reported, handleSetReported, handleBookmark }) {
    const [data, setData] = useState({});
    const [tab, setTab] = useState('info');
    const [loading, setLoading] = useState(true);
    const [settingLightBox, setSettingLightBox] = useState({
        isOpen: false,
        photoIndex: 0
    });

    useEffect( () => {
        let cancel;
        axios({
            method: 'GET',
            url: UrlService.getProductDetailUrl(match.params.slug, match.params.id),
            cancelToken: new axios.CancelToken(c => cancel = c)
        }).then(response => {
            handleLikeUnlike({
                liked: response.data.product.liked,
                unliked: response.data.product.unliked,
                like: response.data.product.like,
                unlike: response.data.product.unlike,
            });
            setData(response.data.product);
            setLoading(false);
            handleSetReported(response.data.product.report);
            handleBookmark(response.data.product.bookmark);
        }).catch(e => {
            if (axios.isCancel(e)) return;
        });
        return () => cancel();
    }, []);

    function handleSetTabActive(tab, event) {
        event.preventDefault();
        setTab(tab)
    }
    if (!loading) {
        return (
            <>
                <section>
                    <ul className="nav nav-tabs">
                        <li className="nav-item">
                            {tab === 'info' && <a className="nav-link active" href="#" onClick={e => e.preventDefault()}>Thông tin</a>}
                            {tab !== 'info' && <a className="nav-link" href="#" onClick={(e) => handleSetTabActive('info', e)}>Thông tin</a>}
                        </li>
                        <li className="nav-item">
                            {tab === 'images' && <a className="nav-link active" href="#" onClick={e => e.preventDefault()}>Ảnh chi tiết</a>}
                            {tab !== 'images' && <a className="nav-link" href="#" onClick={(e) => handleSetTabActive('images', e)}>Ảnh chi tiết</a>}
                        </li>
                        <li className="nav-item">
                            {tab === 'reports' && <a className="nav-link active" href="#" onClick={e => e.preventDefault()}>Reports</a>}
                            {tab !== 'reports' && <a className="nav-link" href="#" onClick={(e) => handleSetTabActive('reports', e)}>Reports</a>}
                        </li>
                    </ul>
                    <div className="tab-content container">
                        <div className={tab === 'info' ? "tab-pane active" : "tab-pane"}>
                            <div className="row pb-2">
                                <div className="col-4">
                                    <img src={data.thumbnail} />
                                </div>
                                <div className="col-8 d-flex flex-column">
                                    <span><i className="fas fa-money-bill" /> Giá: {data.amount} VND</span>
                                    <span><i className="fas fa-phone" /> Số điện thoại: <a href={"tel:"+ data.phone}>{data.phone}</a></span>
                                    <span><i className="fas fa-location" /> {data.address}</span>
                                    <BookmarkButton productId={match.params.id}/>
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-12">
                                    <table className="table table-dark">
                                        <tbody>
                                        {data.infomation.map((info, index) =>  <tr key={index}>
                                            <th scope="row">{info.key}</th>
                                            <td>{info.value}</td>
                                        </tr>)}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div className="container">
                                <div className="detail-comment">
                                    <BlockSendComment productId={match.params.id} parent={0}/>
                                    {data.comment_count > 1 && <span onClick={handleShowCommentsModal} className="more-comment">Xem tất cả bình luận</span>}
                                    {data.comment && <div className="wrapper-comment cm-wrap">
                                        <Comment data={data.comment} />
                                    </div>}
                                </div>
                            </div>
                        </div>
                        <div className={tab === 'images' ? "tab-pane active" : "tab-pane"}>
                            <div className="row">
                                {settingLightBox.isOpen && (
                                    <Lightbox
                                        mainSrc={data.images[settingLightBox.photoIndex].origin}
                                        nextSrc={data.images[(settingLightBox.photoIndex + 1) % data.images.length].origin}
                                        prevSrc={data.images[(settingLightBox.photoIndex + data.images.length - 1) % data.images.length].origin}
                                        onCloseRequest={() => setSettingLightBox({ ...settingLightBox, isOpen: false })}
                                        onMovePrevRequest={() =>
                                            setSettingLightBox({
                                                ...settingLightBox,
                                                photoIndex: (settingLightBox.photoIndex + data.images.length - 1) % data.images.length,
                                            })
                                        }
                                        onMoveNextRequest={() =>
                                            setSettingLightBox({
                                                ...settingLightBox,
                                                photoIndex: (settingLightBox.photoIndex + 1) % data.images.length,
                                            })
                                        }
                                    />
                                )}
                                {
                                    data.images.map((image, index) =>
                                        <div className="col-6" onClick={() => setSettingLightBox({ isOpen: true, photoIndex: index })} key={index}>
                                            <a href="#" onClick={e => e.preventDefault()}>
                                                <img className="img-fluid img-thumbnail" src={image.thumb} />
                                            </a>
                                        </div>)
                                }
                            </div>
                        </div>
                        <div className={tab === 'reports' ? "tab-pane active" : "tab-pane"}>
                            <WriteReportButton reported={reported}/>
                            <BlockListReport productId={match.params.id} />
                        </div>
                    </div>
                    <LikeButton id={match.params.id}/>
                    <UnlikeButton id={match.params.id}/>
                </section>
                <WriteReportModal productId={match.params.id}/>
                <CommentsModal productId={match.params.id}/>
                {modal.showReportModal && <ReportModal show={modal.showReportModal} reportId={modal.reportId}/>}
            </>
        )
    } else {
        return (
            <DetailContainerSkeleton />
        )
    }
}
const mapStateToProps = state => {
    return { modal: state.modal, reported: state.detailpage.reported }
};
export default connect(mapStateToProps, { handleLikeUnlike, handleShowCommentsModal, handleSetReported, handleBookmark })(DetailContainer);
