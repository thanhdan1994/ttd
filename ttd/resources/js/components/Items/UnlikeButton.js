import React, { useState } from "react";
import { connect } from "react-redux";
import {handleLikeUnlike, handleShowModalLogin} from "../../redux/actions";
import UrlService from "../../services/UrlService";

function UnlikeButton({login, handleShowModalLogin, unliked, unlike, liked, like, id, handleLikeUnlike}) {
    function handleUnlikeProduct(event) {
        event.preventDefault();
        const likeNumber = liked ? --like : like;
        handleLikeUnlike({liked: false, unliked: true, like: likeNumber, unlike: unlike + 1});
        axios({
            url: UrlService.dislikeProductUrl(id),
            method: 'post'
        });
    }
    if (!login) {
        return (
            <button className="btn-dislike btn-outline-danger" onClick={handleShowModalLogin}>
                {unlike} <i className="far fa-thumbs-down"></i>
            </button>
        )
    } else {
        return (
            <button className={unliked === true
                ? "btn-dislike btn-outline-danger active"
                : "btn-dislike btn-outline-danger"}
                    onClick={unliked === false ? handleUnlikeProduct : e => e}
            >
                {unlike} <i className="far fa-thumbs-down"></i>
            </button>
        )
    }
}

const mapStateToProps = state => {
    return {
        login: state.user.login,
        liked: state.product.liked,
        unliked: state.product.unliked,
        like: state.product.like,
        unlike: state.product.unlike,
    };
};
export default connect(mapStateToProps, { handleShowModalLogin, handleLikeUnlike })(UnlikeButton);
