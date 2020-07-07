import React, { useState, useEffect } from "react";
import { connect } from "react-redux";
import Lightbox from 'react-image-lightbox';
import 'react-image-lightbox/style.css';
import PostService from "../services/PostService";
import LikeButton from "../components/Items/LikeButton";
import UnlikeButton from "../components/Items/UnlikeButton";
import { handleLikeUnlike } from "../redux/actions";

function DetailContainer({ match, handleLikeUnlike }) {
    const [data, setData] = useState({});
    const [tab, setTab] = useState('info');
    const [isValid, setIsValid] = useState(false);
    const [settingLightBox, setSettingLightBox] = useState({
        isOpen: false,
        photoIndex: 0
    });

    useEffect( () => {
        let ignore = false;
        async function fetchProductDetail() {
            const response = await PostService.getProductDetail(match.params.slug, match.params.id);
            if (response) {
                handleLikeUnlike({
                    liked: response.product.liked,
                    unliked: response.product.unliked,
                    like: response.product.like,
                    unlike: response.product.unlike,
                });
                setData(response.product);
                setIsValid(true);
            }
        }
        fetchProductDetail();
        return () => { ignore = true };
    }, []);

    function handleSetTabActive(tab, event) {
        event.preventDefault();
        setTab(tab)
    }

    if (isValid) {
        return (
            <section>
                <ul className="nav nav-tabs">
                    <li className="nav-item">
                        {tab === 'info' && <a className="nav-link active" href="#" onClick={e => e.preventDefault()}>Thông tin</a>}
                        {tab !== 'info' && <a className="nav-link" href="#" onClick={(e) => handleSetTabActive('info', e)}>Thông tin</a>}
                    </li>
                    <li className="nav-item">
                        {tab === 'images' && <a className="nav-link active" href="#" onClick={e => e.preventDefault()}>Ảnh chi tiết</a>}
                        {tab !== 'images' && <a className="nav-link" href="#" onClick={(e) => handleSetTabActive('images', e)}>Ảnh chi tiết</a>}
                    </li>
                    <li className="nav-item">
                        {tab === 'reports' && <a className="nav-link active" href="#" onClick={e => e.preventDefault()}>Reports</a>}
                        {tab !== 'reports' && <a className="nav-link" href="#" onClick={(e) => handleSetTabActive('reports', e)}>Reports</a>}
                    </li>
                </ul>
                <div className="tab-content container">
                    {tab === 'info' && <div className="tab-pane active">
                            <div className="row pb-2">
                                <div className="col-4">
                                    <img src={data.thumbnail} />
                                </div>
                                <div className="col-8 d-flex flex-column">
                                    <span><i className="fas fa-money-bill" /> Giá: {data.amount}vnđ</span>
                                    <span><i className="fas fa-phone" /> Số điện thoại: <a href={"tel:"+ data.phone}>{data.phone}</a></span>
                                    <span><i className="fas fa-location" /> {data.address}</span>
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-12">
                                    <table className="table table-dark">
                                        <tbody>
                                        {data.infomation.map((info, index) =>  <tr key={index}>
                                            <th scope="row">{info.key}</th>
                                            <td>{info.value}</td>
                                        </tr>)}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>}
                    {tab === 'images' && <div className="tab-pane active">
                        <div className="row">
                            {settingLightBox.isOpen && (
                                <Lightbox
                                    mainSrc={data.images[settingLightBox.photoIndex].origin}
                                    nextSrc={data.images[(settingLightBox.photoIndex + 1) % data.images.length].origin}
                                    prevSrc={data.images[(settingLightBox.photoIndex + data.images.length - 1) % data.images.length].origin}
                                    onCloseRequest={() => setSettingLightBox({ ...settingLightBox, isOpen: false })}
                                    onMovePrevRequest={() =>
                                        setSettingLightBox({
                                            ...settingLightBox,
                                            photoIndex: (settingLightBox.photoIndex + data.images.length - 1) % data.images.length,
                                        })
                                    }
                                    onMoveNextRequest={() =>
                                        setSettingLightBox({
                                            ...settingLightBox,
                                            photoIndex: (settingLightBox.photoIndex + 1) % data.images.length,
                                        })
                                    }
                                />
                            )}
                            {
                                data.images.map((image, index) =>
                                    <div className="col-6" onClick={() => setSettingLightBox({ isOpen: true, photoIndex: index })} key={index}>
                                        <a href="#" onClick={e => e.preventDefault()}>
                                            <img className="img-fluid img-thumbnail" src={image.thumb} />
                                        </a>
                                    </div>)
                            }
                        </div>
                    </div>}
                    {tab === 'reports' && <div className="tab-pane active">
                        <label>
                            <button className="btn btn-yellow" data-toggle="modal" data-target="#writeReportModal">
                                <i className="fas fa-pen" /> Viết Report
                            </button>
                        </label>
                        <ul className="list-group list-group-flush">
                            <li className="list-group-item">Someone was <a href="#" data-toggle="modal" data-target="#reportModal">report</a> for this Lady</li>
                            <li className="list-group-item">Dapibus ac facilisis in</li>
                            <li className="list-group-item">Morbi leo risus</li>
                            <li className="list-group-item">Porta ac consectetur ac</li>
                            <li className="list-group-item">Vestibulum at eros</li>
                        </ul>
                    </div>}
                </div>
                <LikeButton id={match.params.id}/>
                <UnlikeButton id={match.params.id}/>
            </section>
        )
    } else {
        return (
            <section>
                <ul className="nav nav-tabs">
                    <li className="nav-item">
                        <a className="nav-link active" href="#" onClick={e => e.preventDefault()}>Thông tin</a>
                    </li>
                    <li className="nav-item">
                        <a className="nav-link" href="#" onClick={e => e.preventDefault()}>Ảnh chi tiết</a>
                    </li>
                    <li className="nav-item">
                        <a className="nav-link" href="#" onClick={e => e.preventDefault()}>Reports</a>
                    </li>
                </ul>
                <div className="tab-content container">

                </div>
            </section>
        )
    }
}

export default connect(null, { handleLikeUnlike })(DetailContainer);
