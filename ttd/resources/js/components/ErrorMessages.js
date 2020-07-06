import React from "react";

function ErrorMessages(props) {
    return (
        props.errors.map((error, index) =>
            <div className="alert alert-danger" role="alert" key={index}>
                {error}
            </div>
        )
    );
}
export default ErrorMessages
