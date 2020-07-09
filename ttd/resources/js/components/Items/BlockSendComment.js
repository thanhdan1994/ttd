import React, { useState } from "react";
import SendCommentButton from "./SendCommentButton";

const BlockSendComment = ({productId , parent}) => {
    const [content, setContent] = useState('');
    return (
        <div className="form-group d-flex flex-row">
            <textarea placeholder="Nhập nội dung và nhấn nút gửi"
                      spellCheck="false"
                      onChange={e => setContent(e.target.value)} />
            <SendCommentButton productId={productId} content={content} parent={parent}/>
        </div>
    )
};
export default BlockSendComment;
