import React, { useEffect, useState } from "react";
import { connect } from "react-redux";
import { handleLikeComment, handleShowModalLogin, handleRemoveLikeComment } from "../../redux/actions";
import UrlService from "../../services/UrlService";

const LikeCommentButton = ({ comments, handleLikeComment, id, likeNumberDefault, login, handleShowModalLogin, like, handleRemoveLikeComment }) => {
    const [likeNumber, setLikeNumber] = useState(likeNumberDefault);
    useEffect(() => {
        if (like) {
            handleLikeComment(id);
        }
    }, []);
    function handleLike() {
        setLikeNumber(likeNumber + 1);
        handleLikeComment(id);
        axios({
            url: UrlService.likeCommentUrl(id),
            method: 'post'
        });
    }
    function handleRemoveLike() {
        setLikeNumber(likeNumber - 1);
        handleRemoveLikeComment(id);
        axios({
            url: UrlService.unlikeCommentUrl(id),
            method: 'delete'
        });
    }
4
    if (login) {
        if (typeof comments.find(element => element == id) !== 'undefined') {
            return (
                <span className="like-comment" onClick={handleRemoveLike}>{likeNumber} <i className="fa fa-thumbs-up"></i></span>
            )
        }
        return (
            <span className="like-comment" onClick={handleLike}>{likeNumber} <i className="far fa-thumbs-up"></i></span>
        )
    }
    return <span className="like-comment" onClick={handleShowModalLogin}>{likeNumber} <i className="far fa-thumbs-up"></i></span>
};

const mapStateToProps = state => {
    return { comments: state.comments, login: state.user.login }
};
export default connect(mapStateToProps, { handleLikeComment, handleShowModalLogin, handleRemoveLikeComment })(LikeCommentButton);
