import React from "react";
import { connect } from "react-redux";
import { handleShowModalLogin } from "../../redux/actions";
import ProductService from "../../services/ProductService";

const SendCommentButton = ({ login, handleShowModalLogin, productId, content, parent }) => {
    async function handleSendComment(e) {
        e.preventDefault();
        if (content === '') {
            alert('Nội dung bình luận không được để trống');
            return false;
        }
        const response = await ProductService.sendComment(productId, {content: content, parent: parent});
    }
    if (!login) {
        return (
            <button className="send-comment" onClick={handleShowModalLogin}><i className="far fa-paper-plane"></i></button>
        )
    } else {
        return (
            <button className="send-comment" onClick={handleSendComment}><i className="far fa-paper-plane"></i></button>
        )
    }
};

const mapStateToProps = state => {
    return {
        login: state.user.login,
    };
};

export default connect(mapStateToProps, { handleShowModalLogin })(SendCommentButton)
