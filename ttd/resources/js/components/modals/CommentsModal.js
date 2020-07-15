import React, { useState, useEffect } from "react";
import { Modal } from 'react-bootstrap';
import { connect } from "react-redux";
import { handleCloseModal } from "../../redux/actions";
import CommentSkeleton from "../skeleton/CommentSkeleton";
import Skeleton from "react-loading-skeleton";
import Comment from "../Items/Comment";
import UrlService from "../../services/UrlService";

function CommentsModal({
    showCommentsModal,
    handleCloseModal,
    productId
}) {
    const [loading, setLoading] = useState(true);
    const [comments, setComments] = useState([]);
    const [totalPages, setTotalPages] = useState(1);
    const [perPage, setPerPage] = useState(5);
    const [page, setPage] = useState(1);
    useEffect(() => {
        let cancel;
        axios({
            method: 'GET',
            url: UrlService.getProductCommentsUrl(productId, page),
            cancelToken: new axios.CancelToken(c => cancel = c)
        }).then(response => {
            setTotalPages(response.data.total_pages);
            setPerPage(response.data.per_page);
            if ((response.data.per_page * response.data.current_page + response.data.per_page) > response.data.total) {
                setPerPage(response.data.total - (response.data.per_page * response.data.current_page))
            }
            setComments(response.data.data);
            setLoading(false);
        }).catch(e => {
            if (axios.isCancel(e)) return;
        });
        return () => cancel();
    }, []);

    function seeMoreComments() {
        let cancel;
        let pageCurrent = page + 1;
        setPage(pageCurrent);
        axios({
            method: 'GET',
            url: UrlService.getProductCommentsUrl(productId, pageCurrent),
            cancelToken: new axios.CancelToken(c => cancel = c)
        }).then(response => {
            if ((response.data.per_page * response.data.current_page + response.data.per_page) > response.data.total) {
                setPerPage(response.data.total - (response.data.per_page * response.data.current_page))
            }
            setComments([...comments, ...response.data.data]);
        }).catch(e => {
            if (axios.isCancel(e)) return;
        });
        return () => cancel();
    }
    return (
        <Modal show={showCommentsModal} onHide={handleCloseModal} animation={false}>
            <div className="modal-content animate-bottom">
                <div className="modal-header">
                    <h4 className="modal-title"> Bình luận</h4>
                    <button type="button" className="close" onClick={handleCloseModal} aria-label="Close"><i className="icon icon-close-popup" /></button>
                </div>
                <div className="modal-body">
                    <div className="container">
                        <div className="detail-comment">
                            <div className="form-group">
                                <textarea placeholder="Nhập và nhấn enter để gửi" spellCheck="false" defaultValue={""} />
                            </div>
                            <div className="wrapper-comment cm-wrap">
                                {loading && Array(5).fill().map((item, index) => <CommentSkeleton key={index}/>)}
                                {comments.map(comment => <Comment data={comment} key={comment.id}/>)}
                            </div>
                            {loading && <Skeleton width={120} height={16}/>}
                            {(totalPages > 1 && perPage > 1) && <span className="more-comment" onClick={seeMoreComments}>Xem thêm {perPage} Bình luận</span>}
                        </div>
                    </div>
                </div>
            </div>
        </Modal>
    )
}

const mapStateToProps = state => {
    return { showCommentsModal: state.modal.showCommentsModal };
};

export default connect(mapStateToProps, { handleCloseModal })(CommentsModal);
