import React, {Fragment, useState} from "react";
import Header from "./components/Header";
import Footer from "./components/Footer";
import LatestContentModal from "./components/modals/LatestContentModal";
import LoginModal from "./components/modals/LoginModal";
import RegisterModal from "./components/modals/RegisterModal";
import Latest from "./components/Items/Latest";
import Post from "./components/Items/Post";
import SearchModal from "./components/modals/SearchModal";
import PostModal from "./components/modals/PostModal";

function Main() {
    return (
        <Fragment>
            <Header/>
            <section>
                <article className="w-475 border-2">
                    <div className="thumbnail">
                        <a href="#">
                            <img src="https://cuoifly.tuoitre.vn/475/297/ttc/r/2020/06/16/thumb-giao-duc-truyen-kieu-1592304211-16x9.jpg" />
                        </a>
                    </div>
                    <h4>Trả hết, trả hết cho người, trả luôn toán sinh sử địa...</h4>
                    <div className="info">
                        <div className="info1">
                            <span><i className="fas fa-money-bill" /> Giá: 500,000vnđ</span>
                            <span>Khu vực: Gò vấp <i className="fas fa-location" /></span>
                        </div>
                        <div className="info2">
                            <span><i className="fas fa-comment" /> Bình luận: 5</span>
                            <span><a href="tel:0982390731">0982390731</a> <i className="fas fa-phone" /></span>
                        </div>
                    </div>
                </article>
                <article className="art-thumb-left border-2">
                    <div className="thumbnail">
                        <a href="#">
                            <img src="https://cuoifly.tuoitre.vn/300/188/ttc/r/2020/06/24/ai-dau-tien-1592991316-26x17.jpg" />
                        </a>
                    </div>
                    <div className="info">
                        <h4>AI 'tình yêu' đầu tiên trên thế giới, hứa hẹn bầu bạn mùa Covid-19</h4>
                        <span><i className="fas fa-money-bill" /> Giá: 500,000vnđ</span>
                        <span><i className="fas fa-location" /> Khu vực: Gò vấp</span>
                    </div>
                </article>
                <article className="art-thumb-left border-2">
                    <div className="thumbnail">
                        <a href="#">
                            <img src="https://cuoifly.tuoitre.vn/300/188/ttc/r/2020/06/19/cafe-1592531610-26x17.jpg" />
                        </a>
                    </div>
                    <div className="info">
                        <h4>Thằng Vàng thả thính rất đúng bài nhưng vẫn sai phần giao diện</h4>
                        <span><i className="fas fa-money-bill" /> Giá: 500,000vnđ</span>
                        <span><i className="fas fa-location" /> Khu vực: Gò vấp</span>
                    </div>
                </article>
                <article className="art-thumb-left border-2">
                    <div className="thumbnail">
                        <a href="#">
                            <img src="https://cuoifly.tuoitre.vn/300/188/ttc/r/2020/06/24/bcs-fb-1-1592985440-26x17.jpg" />
                        </a>
                    </div>
                    <div className="info">
                        <h4>Hãng BCS Nhật Bản dạy tình dục an toàn bằng phim hoạt hình</h4>
                        <span><i className="fas fa-money-bill" /> Giá: 500,000vnđ</span>
                        <span><i className="fas fa-location" /> Khu vực: Gò vấp</span>
                    </div>
                </article>
            </section>
            <Footer/>
            <div className="bottom-bar">
                <Latest/>
                <Post/>
            </div>
            <LoginModal/>
            <RegisterModal/>
            <LatestContentModal/>
            <SearchModal/>
            <PostModal/>
        </Fragment>
    )
}

export default Main
