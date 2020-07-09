import React, {  useRef } from "react";
import SendCommentButton from "./SendCommentButton";
import ProductService from "../../services/ProductService";

const BlockSendComment = ({productId , parent}) => {
    const refContent = useRef('');
    async function handleSendComment(e) {
        e.preventDefault();
        let content = refContent.current.value;
        if (content === '') {
            alert('Nội dung bình luận không được để trống');
            return false;
        }
        const response = await ProductService.sendComment(productId, {content: content, parent: parent});
        if (response) {
            alert('Bình luận đã được gửi! Vui lòng đợi duyệt.');
            refContent.current.value = '';
        }
    }
    return (
        <div className="form-group d-flex flex-row">
            <textarea placeholder="Nhập nội dung và nhấn nút gửi"
                      spellCheck="false"
                      ref={refContent} />
            <SendCommentButton productId={productId} handleSendComment={handleSendComment}/>
        </div>
    )
};
export default BlockSendComment;
