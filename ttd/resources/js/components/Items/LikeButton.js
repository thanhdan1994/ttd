import React from "react";
import { connect } from "react-redux";
import { handleShowModalLogin, handleLikeUnlike } from "../../redux/actions";
import ProductService from "../../services/ProductService";

function LikeButton({ login, handleShowModalLogin, liked, like, unliked, unlike, id, handleLikeUnlike }) {
    async function handleLikeProduct(event) {
        event.preventDefault();
        const unlikeNumber = unliked ? --unlike : unlike;
        handleLikeUnlike({liked: true, unliked: false, like: like + 1, unlike: unlikeNumber});
        const response = await ProductService.doLikeProduct(id);
    }
    if (!login) {
        return (
            <button className="btn-like btn-outline-primary" onClick={handleShowModalLogin}>{like} <i className="far fa-thumbs-up"></i>
            </button>
        )
    } else {
        return (
            <button className={liked === true ?
                "btn-like btn-outline-primary active"
                : "btn-like btn-outline-primary"}
                onClick={liked === false ? handleLikeProduct : e => e}
            >
                {like} <i className="far fa-thumbs-up"></i>
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
export default connect(mapStateToProps, { handleShowModalLogin, handleLikeUnlike })(LikeButton);
