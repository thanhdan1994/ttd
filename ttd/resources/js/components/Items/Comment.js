import React, {useState} from "react";
import LikeCommentButton from "./LikeCommentButton";
import ReplyCommentButton from "./ReplyCommentButton";
import BlockSendComment from "./BlockSendComment";

function Comment({ data }) {
    const [showBlockSendComment, setShowBlockSendComment] = useState(false);
    function handleShowBlockSendComment() {
        setShowBlockSendComment(true);
    }
    return (
        <div className="comment">
            <span className="comment-avatar">{data.author.name.charAt(0)}</span>
            <div className="comment-media">
                <div className="comment-content">
                    <span className="comment-name">{data.author.name}</span>
                    <span className="comment-text">
                       <pre>{data.content}</pre>
                    </span>
                </div>
                <div className="comment-tool">
                    <LikeCommentButton id={data.id} likeNumberDefault={data.like_count} like={data.like}/>
                    <ReplyCommentButton handleShowBlockSendComment={handleShowBlockSendComment}/>
                    <span className="time">{data.timeAgo}</span>
                </div>
                {showBlockSendComment && <BlockSendComment productId={data.product_id} parent={data.id}/>}
                {data.child && data.child.map(comment => {
                    return (
                        <div className="comment" key={comment.id}>
                            <span className="comment-avatar">{comment.author.name.charAt(0)}</span>
                            <div className="comment-media">
                                <div className="comment-content">
                                    <span className="comment-name">{comment.author.name}</span>
                                    <span className="comment-text">
                                       <pre>{comment.content}</pre>
                                    </span>
                                </div>
                                <div className="comment-tool">
                                    <LikeCommentButton id={comment.id} likeNumberDefault={comment.like_count} like={data.like}/>
                                    <span className="time">{comment.timeAgo}</span>
                                </div>
                            </div>
                        </div>
                    )
                })}
            </div>
        </div>
    )
}

export default Comment;
