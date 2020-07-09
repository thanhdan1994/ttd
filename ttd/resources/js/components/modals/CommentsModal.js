import React, { useState, useEffect } from "react";
import { Modal } from 'react-bootstrap';
import { connect } from "react-redux";
import { handleCloseCommentsModal } from "../../redux/actions";
import CommentSkeleton from "../skeleton/CommentSkeleton";
import Skeleton from "react-loading-skeleton";
import ProductService from "../../services/ProductService";
import Comment from "../Items/Comment";

function CommentsModal({
    showCommentsModal,
    handleCloseCommentsModal,
    productId
}) {
    const [loading, setLoading] = useState(true);
    const [comments, setComments] = useState([]);
    const [totalPages, setTotalPages] = useState(1);
    const [perPage, setPerPage] = useState(5);
    const [page, setPage] = useState(1);
    useEffect(() => {
        async function fetchComments() {
            const response = await ProductService.getComments(productId, page);
            if (response) {
                setTotalPages(response.total_pages);
                setPerPage(response.per_page);
                if ((response.per_page * response.current_page + response.per_page) > response.total) {
                    setPerPage(response.total - (response.per_page * response.current_page))
                }
                setComments(response.data);
                setLoading(false);
            }
        }
        fetchComments();
    }, []);

    async function seeMoreComments() {
        let pageCurrent = page + 1;
        const response = await ProductService.getComments(productId, pageCurrent);
        if (response) {
            if ((response.per_page * response.current_page + response.per_page) > response.total) {
                setPerPage(response.total - (response.per_page * response.current_page))
            }
            setComments([...comments, ...response.data]);
        }
        setPage(pageCurrent);
    }
    return (
        <Modal show={showCommentsModal} onHide={handleCloseCommentsModal} animation={false}>
            <div className="modal-content animate-bottom">
                <div className="modal-header">
                    <h4 className="modal-title"> Bình luận</h4>
                    <button type="button" className="close" onClick={handleCloseCommentsModal} aria-label="Close"><i className="icon icon-close-popup" /></button>
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

export default connect(mapStateToProps, {handleCloseCommentsModal})(CommentsModal);
