import React, { useState } from "react";
import { connect } from "react-redux";
import { Modal } from 'react-bootstrap';
import { handleCloseModal } from "../../redux/actions";
import UrlService from "../../services/UrlService";

function PostModal({ showPostModal, handleCloseModal }) {
    const initialState = {
        name: '',
        category_id: 1,
        excerpt: '',
        content: 'tét content',
        phone: '',
        amount: '',
        address: '',
        lat: '',
        long: '',
        services: [],
        properties: [
            {key: 'Chiều cao', value: '1m55'},
            {key: 'Cân nặng', value: '45kg'},
            {key: 'Giờ hoạt động', value: '10h-24h'}
            ],
        images: []
    };
    const [data, setData] = useState(initialState);
    const [creating, setCreating] = useState(false);

    function removeImage(event) {
        let nodes = Array.prototype.slice.call(document.querySelector('div.file-preview').children),
            thisNode = event.target.closest('div.file-catcher');
        let index = nodes.indexOf(thisNode);
        data.images.splice(index, 1);
        setData({...data, images: data.images});
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
                if (data.images.length < 9) {
                    let previewImageHtml = document.createElement('div');
                    previewImageHtml.className = "file-catcher";
                    let imgPreview = document.createElement('img');
                    imgPreview.src = reader.result;
                    let closePreviewIcon = document.createElement('span');
                    closePreviewIcon.className = "close-file-preview";
                    closePreviewIcon.addEventListener('click', removeImage)
                    let icon = document.createElement('i');
                    icon.className = "fas fa-times-circle";
                    closePreviewIcon.append(icon);
                    previewImageHtml.append(imgPreview);
                    previewImageHtml.append(closePreviewIcon);
                    previewsElement.append(previewImageHtml);
                    data.images.push(reader.result);
                    setData({...data, images: data.images});
                }
            };
            reader.readAsDataURL(file);
        }
    }

    function handleServices(event) {
        if (event.target.checked) {
            setData({...data, services: [...data.services, event.target.value]});
        } else {
            let arr = data.services;
            for (let i = 0; i < arr.length; i++) {
                 if (arr[i] === event.target.value) {
                    arr.splice(i, 1);
                }
            }
            setData({...data, services: arr});
        }
    }

    function setProperties(index, event) {
        let properties = data.properties;
        properties[index].value = event.target.value;
        setData({...data, properties: properties});
    }

    function handlePost() {
        setCreating(true);
        let { name, description, phone, amount, address, latitude, longitude, images } = data;
        if (
            name === '' ||
            description === '' ||
            phone === '' ||
            amount === '' ||
            address === '' ||
            latitude === '' ||
            longitude === '' ||
            images.length < 1
        ) {
            alert('Vui lòng nhập đầy đủ thông tin được đánh dấu (*)');
            setCreating(false);
            return false;
        }
        axios({
            url: UrlService.createProductUrl(),
            method: 'post',
            data: data
        }).then(response => {
            alert('Bài viết của bạn đã được gửi thành công! vui lòng đợi duyệt.');
            setCreating(false);
            handleCloseModal();
            setData(initialState);
        }).catch(function (error) {
            setCreating(false);
            alert(error.response.data.errors[0]);
        });
    }
    return (
        <Modal show={showPostModal} onHide={handleCloseModal} animation={false}>
            <div className="modal-content animate-bottom">
                <div className="modal-header">
                    <h4 className="modal-title"> Đăng bài</h4>
                    <button type="button" className="close" onClick={handleCloseModal}><i className="icon icon-close-popup" /></button>
                </div>
                <div className="modal-body">
                    <div className="form-group">
                        <label htmlFor="namePost">TÊN BÀI VIẾT:<span style={{color: 'red'}}>*</span></label>
                        <input type="text" id="namePost" defaultValue={data.name} onChange={e => setData({...data, name: e.target.value})}/>
                    </div>
                    <div className="form-group">
                        <label htmlFor="desSendNews">MÔ TẢ:</label>
                        <textarea id="desSendNews" defaultValue={data.excerpt} onChange={e => setData({...data, excerpt: e.target.value})} />
                    </div>
                    <div className="form-group">
                        <label htmlFor="phoneNumber">SỐ ĐIỆN THOẠI:<span style={{color: 'red'}}>*</span></label>
                        <input type="text" id="phoneNumber" defaultValue={data.phone} onChange={e => setData({...data, phone: e.target.value})} />
                        <span className="error" style={{display: 'none'}} />
                    </div>
                    <div className="form-group">
                        <label htmlFor="amount">GIÁ:<span style={{color: 'red'}}>*</span></label>
                        <input type="text" id="amount" defaultValue={data.amount} onChange={e => setData({...data, amount: e.target.value})} />
                    </div>
                    <div className="form-group">
                        <label htmlFor="address">ĐỊA CHỈ:<span style={{color: 'red'}}>*</span></label>
                        <input type="text" id="address" defaultValue={data.address} onChange={e => setData({...data, address: e.target.value})} />
                    </div>
                    <div className="form-group">
                        <label htmlFor="latitude">LATITUDE:<span style={{color: 'red'}}>*</span></label>
                        <input type="text" id="latitude" defaultValue={data.lat} onChange={e => setData({...data, lat: e.target.value})} />
                    </div>
                    <div className="form-group">
                        <label htmlFor="longitude">LONGITUDE:<span style={{color: 'red'}}>*</span></label>
                        <input type="text" id="longitude" defaultValue={data.long} onChange={e => setData({...data, long: e.target.value})} />
                    </div>
                    <div className="form-group">
                        <label>HÌNH ẢNH:<span style={{color: 'red'}}>*</span></label>
                        <label className="file-container">
                            <input type="file" multiple aria-label onChange={(e) => handlePreviewImage(e)} />
                            <span><i className="fas fa-upload" /> Tải lên ảnh chi tiết</span>
                        </label>
                        <div className="file-preview" />
                        <span className="note"><span style={{color: 'red'}}>*</span> Bạn phải có ít nhất 1 ảnh (tối đa là 9 ảnh)</span>
                    </div>
                    <div className="form-group">
                        <label>Dịch vụ:<span style={{color: 'red'}}>*</span></label>
                        <div className="list-services">
                            <div className="custom-control custom-switch">
                                <input type="checkbox" className="custom-control-input" name="post_services[]" onChange={handleServices} value="1" />
                                <label className="custom-control-label">Giao hàng nhanh</label>
                            </div>
                            <div className="custom-control custom-switch">
                                <input type="checkbox" className="custom-control-input" name="post_services[]" onChange={handleServices} value="2"/>
                                <label className="custom-control-label">Giao hàng 24/24</label>
                            </div>
                            <div className="custom-control custom-switch">
                                <input type="checkbox" className="custom-control-input" name="post_services[]" onChange={handleServices} value="3"/>
                                <label className="custom-control-label">Nghỉ thứ 7</label>
                            </div>
                        </div>
                    </div>
                    <div className="form-group">
                        <label htmlFor="information">Thông tin bổ sung</label>
                        <table className="table">
                            <thead>
                            <tr>
                                <th scope="col">Thuộc tính</th>
                                <th scope="col">Giá trị</th>
                            </tr>
                            </thead>
                            <tbody id="content-properties">
                                {
                                    data.properties.map((property, index) => <tr key={index}>
                                            <th scope="row"><input type="text" readOnly className="form-control" defaultValue={property.key} /></th>
                                            <td><input type="text" onChange={e => setProperties(index, e)} className="form-control" defaultValue={property.value}/></td>
                                        </tr>
                                    )
                                }
                            </tbody>
                        </table>
                    </div>
                    <div className="form-group text-center mt-5">
                        {!creating && <button type="button" className="btnSendNews text-uppercase" onClick={handlePost}>Đăng bài</button>}
                    </div>
                </div>
            </div>
        </Modal>
    )
};
const mapStateToProps = state => {
    return {showPostModal: state.modal.showPostModal};
};
export default connect(mapStateToProps, { handleCloseModal })(PostModal);
