import React, { useState, useEffect } from "react";
import { connect } from "react-redux";
import { handleCloseModal } from "../../redux/actions";
import Modal from "react-bootstrap/Modal";
import DetailReportSkeleton from "../skeleton/DetailReportSkeleton";
import UrlService from "../../services/UrlService";
import Lightbox from "react-image-lightbox";

const ReportModal = ({ show, handleCloseModal, reportId }) => {
    const initialState = {
        excerpt: '',
        properties: [],
        images: []
    };
    const [report, setReport] = useState(initialState);
    const [loading, setLoading] = useState(true);
    const [settingLightBox, setSettingLightBox] = useState({
        isOpen: false,
        photoIndex: 0
    });

    useEffect(() => {
        let cancel;
        axios({
            method: 'GET',
            url: UrlService.getReportUrl(reportId),
            cancelToken: new axios.CancelToken(c => cancel = c)
        }).then(response => {
            setReport({...report, excerpt: response.data.excerpt, properties: response.data.infomation, images: response.data.reportImages});
            setLoading(false);
        }).catch(e => {
            if (axios.isCancel(e)) return;
        });
        return () => cancel();
    }, []);
    return (
        <Modal show={show} onHide={handleCloseModal} animation={false} id="reportModal">
            <div className="modal-content animate-bottom">
                <div className="modal-header">
                    <h4 className="modal-title"> Chi tiết report #{reportId}</h4>
                    <button type="button" className="close" onClick={handleCloseModal}><i className="icon icon-close-popup" /></button>
                </div>
                <div className="modal-body">
                    {!loading ? <>
                        <div className="report-content">{report.excerpt}</div>
                        <div className="form-group">
                            {
                                report.properties.map((property, key) => <div className="vote-detail" key={key}>
                                        <span>{property.key}: </span>
                                        <ul className="rate-star">
                                            {Array(10).fill().map((item, value) => {
                                                if (value < property.value) {
                                                    return (
                                                        <li key={value}><i className="fas fa-star" /></li>
                                                    )
                                                }
                                                return <li key={value}><i className="far fa-star" /></li>
                                            })}
                                        </ul>
                                    </div>
                                )
                            }
                        </div>
                        <div className="row">
                            {settingLightBox.isOpen && (
                                <Lightbox
                                    mainSrc={report.images[settingLightBox.photoIndex].origin}
                                    nextSrc={report.images[(settingLightBox.photoIndex + 1) % report.images.length].origin}
                                    prevSrc={report.images[(settingLightBox.photoIndex + report.images.length - 1) % report.images.length].origin}
                                    onCloseRequest={() => setSettingLightBox({ ...settingLightBox, isOpen: false })}
                                    onMovePrevRequest={() =>
                                        setSettingLightBox({
                                            ...settingLightBox,
                                            photoIndex: (settingLightBox.photoIndex + report.images.length - 1) % report.images.length,
                                        })
                                    }
                                    onMoveNextRequest={() =>
                                        setSettingLightBox({
                                            ...settingLightBox,
                                            photoIndex: (settingLightBox.photoIndex + 1) % report.images.length,
                                        })
                                    }
                                />
                            )}
                            {
                                report.images.map((image, index) =>
                                    <div className="col-6" onClick={() => setSettingLightBox({ isOpen: true, photoIndex: index })} key={index}>
                                        <a href="#" onClick={e => e.preventDefault()}>
                                            <img className="img-fluid img-thumbnail" src={image.thumb} />
                                        </a>
                                    </div>)
                            }
                        </div>
                    </> : <DetailReportSkeleton/>}
                </div>
            </div>
        </Modal>
    )
};

export default connect(null, { handleCloseModal })(ReportModal)
