import React, { useState } from "react";
import { connect } from "react-redux";
import { Modal } from 'react-bootstrap';
import { handleCloseModal } from '../../redux/actions';
import {handleSetReported} from "../../redux/actions/detailpage";
import UrlService from "../../services/UrlService";
import CookieService from "../../services/CookieService";

function WriteReportModal({ showWriteReportModal, handleCloseModal, productId, handleSetReported }) {
    const initialState = {
        excerpt: '',
        properties: [
            {key: 'Đánh giá 1', value: 7},
            {key: 'Đánh giá 2', value: 7},
            {key: 'Đánh giá 3', value: 7}
        ],
        images: []
    };
    const [data, setData] = useState(initialState);
    const [sending, setSending] = useState(false);

    var filesList = new Array();
    function removeImage(event) {
        let nodes = Array.prototype.slice.call(document.querySelector('div.file-preview').children),
            thisNode = event.target.closest('div.file-catcher');
        let index = nodes.indexOf(thisNode);
        filesList.splice(index, 1);
        setData({...data, images: filesList});
        thisNode.remove();
    }

    function handlePreviewImage(event) {
        let files = event.target.files;
        let filesAmount = files.length;
        for (let i = 0; i < filesAmount; i++) {
            let reader = new FileReader();
            let file = files[i];
            let previewsElement = document.querySelector('div.file-preview');
            reader.onloadend = () => {
                if (filesList.length < 9) {
                    let previewImageHtml = document.createElement('div');
                    previewImageHtml.className = "file-catcher";
                    let imgPreview = document.createElement('img');
                    imgPreview.src = reader.result;
                    let closePreviewIcon = document.createElement('span');
                    closePreviewIcon.className = "close-file-preview";
                    closePreviewIcon.addEventListener('click', removeImage);
                    let icon = document.createElement('i');
                    icon.className = "fas fa-times-circle";
                    closePreviewIcon.append(icon);
                    previewImageHtml.append(imgPreview);
                    previewImageHtml.append(closePreviewIcon);
                    previewsElement.append(previewImageHtml);
                    filesList.push(reader.result);
                    setData({...data, images: filesList});
                }
            };
            reader.readAsDataURL(file);
        }
    }

    function setProperties(key, value) {
        let properties = data.properties;
        properties[key].value = value;
        setData({...data, properties: properties});
    }

    function handleSendReport() {
        let cancel;
        let { excerpt, images } = data;
        if (
            excerpt === '' ||
            images.length < 1
        ) {
            alert('Vui lòng nhập đầy đủ thông tin được đánh dấu (*)');
            return false;
        }
        setSending(true);
        axios({
            url: UrlService.sendReportUrl(productId),
            method: 'POST',
            data: data,
            cancelToken: new axios.CancelToken(c => cancel = c)
        }).then(response => {
            if (response.data.status === 200) {
                alert('Report của bạn đã được gửi thành công! vui lòng đợi duyệt.');
                handleSetReported(true);
                handleCloseModal();
                setData(initialState);
                setSending(false);
            }
        }).catch(e => {
            if (axios.isCancel(e)) return;
        });
        return () => cancel();
    }

    return (
        <Modal show={showWriteReportModal} onHide={handleCloseModal} animation={false} id="writeReportModal">
            <div className="modal-content animate-bottom">
                <div className="modal-header">
                    <h4 className="modal-title"><i className="fas fa-pen" /> Viết report</h4>
                    <button type="button" className="close" onClick={handleCloseModal}><i className="icon icon-close-popup" /></button>
                </div>
                <div className="modal-body">
                    <div className="form-group">
                        <label htmlFor="description">MÔ TẢ <span style={{color: 'red'}}>*</span></label>
                        <textarea cols={30} rows={10} className="form-control" defaultValue={data.excerpt} onChange={e => setData({...data, excerpt: e.target.value})} />
                    </div>
                    <div className="form-group">
                        <label htmlFor="votePost">ĐÁNH GIÁ CHI TIẾT: </label>
                        {
                            data.properties.map((property, key) => <div className="vote-detail" key={key}>
                                    <span>{property.key}: </span>
                                    <ul className="rate-star">
                                        {Array(10).fill().map((item, value) => {
                                            if (value < property.value) {
                                                return (
                                                    <li key={value} onClick={() => setProperties(key, value + 1)}><i className="fas fa-star" /></li>
                                                )
                                            }
                                            return <li key={value} onClick={() => setProperties(key, value + 1)}><i className="far fa-star" /></li>
                                        })}
                                    </ul>
                                </div>
                            )
                        }
                    </div>
                    <div className="form-group">
                        <label>ẢNH REPORTS:</label>
                        <label className="file-container">
                            <input type="file" multiple aria-label id="reportImages" onChange={(e) => handlePreviewImage(e)} />
                            <span><i className="fas fa-upload" /> Tải lên ảnh chi tiết</span>
                        </label>
                        <div className="file-preview">
                        </div>
                        <span className="note"><span style={{color: 'red'}}>*</span> Vui lòng chọn ảnh tải lên để đảm bảo report hợp lệ (chỉ có thể tải tối đa 9 ảnh)</span>
                    </div>
                    <div className="form-group text-center">
                        {sending
                            ? <div className="loader"></div>
                            : <button type="button" className="btn btn-block btn-yellow" onClick={handleSendReport}>Gửi đánh giá</button>}
                    </div>
                </div>
            </div>
        </Modal>
    )
}

const mapStateToProps = state => {
    return { showWriteReportModal: state.modal.showWriteReportModal };
};
export default connect(mapStateToProps, {
    handleCloseModal,
    handleSetReported
})(WriteReportModal)
