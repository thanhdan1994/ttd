import React from "react";
import Skeleton from "react-loading-skeleton";

const DetailContainerSkeleton = () => {
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
                <div className="row pb-2">
                    <div className="col-4">
                        <Skeleton width={120} height={90}/>
                    </div>
                    <div className="col-8 d-flex flex-column">
                        <span><i className="fas fa-money-bill" /> Giá: <Skeleton height={21} width={56}/> VND</span>
                        <span><i className="fas fa-phone" /> Số điện thoại: <Skeleton height={21} width={80}/></span>
                        <span><i className="fas fa-location" /> <Skeleton height={21} width={150} /></span>
                        <span><i className="far fa-bookmark" /> Đánh dấu</span>
                    </div>
                </div>
                <div className="row">
                    <div className="col-12">
                        <table className="table table-dark">
                            <tbody>
                            {
                                Array(5).fill().map((item, index) =>
                                <tr key={index}>
                                    <th scope="row"><Skeleton height={20}/></th>
                                    <td><Skeleton height={20}/></td>
                                </tr>
                            )}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    )
};
export default DetailContainerSkeleton
