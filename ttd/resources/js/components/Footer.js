import React from "react";

function Footer() {
    return (
        <footer className="footer">
            <div className="container">
                <div className="text-center mt-3">
                    <h5 className="text-uppercase mb-0" style={{fontWeight: 700}}>Tuổi trẻ cười online</h5>
                    <ul className="list-logo p-0" style={{borderBottom: 'none'}}>
                        <li><a href="https://tuoitre.vn/" title="Tin tức, tin nóng, đọc báo điện tử - Tuổi Trẻ Online"><img src="https://cdncuoi.tuoitre.vn/ttc/sources/mimg/icon/icon-tto.svg" alt="" /></a></li>
                        <li><a href="https://cuoituan.tuoitre.vn/" title="Báo Chí - Tạp Chí - Đọc Báo - Tuổi Trẻ Cuối Tuần - TTO"><img src="https://cdncuoi.tuoitre.vn/ttc/sources/mimg/icon/icon-ttct.svg" alt="" /></a></li>
                        <li><a href="https://tv.tuoitre.vn/" title="Video tin tức, video tin nóng - Tuổi Trẻ Video Online"><img src="https://cdncuoi.tuoitre.vn/ttc/sources/mimg/icon/icon-tttivi.svg" alt="" /></a></li>
                    </ul>
                </div>
                <a className="logo-footer" href="/" title="Tuổi Trẻ Cười"><img src="https://cdncuoi.tuoitre.vn/ttc/sources/mimg/logo-footer.svg" alt="" /></a>
                <ul className="list-social">
                    <li><a href="https://www.facebook.com/tuoitrecuoi/" title="Tuổi Trẻ Cười"><i className="icon icon-facebook" /></a></li>
                    <li><a href="https://www.instagram.com/tuoitrecuoi.official/" title="Tuổi Trẻ Cười"><i className="icon icon-instagram" /></a></li>
                    <li><a href="https://www.youtube.com/channel/UCuZFuykrlN9GUhobrTvP0Bg/videos" title="Tuổi Trẻ Cười"><i className="icon icon-youtube" /></a></li>
                </ul>
                <dl>
                    <dt>HỢP TÁC NỘI DUNG</dt>
                    <dd><a href="mailto:cuoi@tuoitre.com.vn"><i className="fas fa-envelope" /> cuoi@tuoitre.com.vn</a></dd>
                </dl>
                <dl>
                    <dt>ĐƯỜNG DÂY NÓNG</dt>
                    <dd><a href="tel:0918033133"><i className="fas fa-phone" /> <strong>0918.033.133 </strong></a>
                    </dd>
                    <dd><a href="tel:02838440538"><i className="fas fa-phone-square" /> (84.28) <strong>
                        38.440.538</strong></a></dd>
                </dl>
                <dl>
                    <dt>LIÊN HỆ QUẢNG CÁO</dt>
                    <dd><a href="tel:0963020919"><i className="fas fa-phone" /> <strong>0963.0209.19</strong></a>
                    </dd>
                    <dd><a href="mailto:cuoi@tuoitre.com.vn"><i className="fas fa-envelope" />
                        sales.cuoi@tuoitre.com.vn</a>
                    </dd>
                </dl>
                <a className="btn-price-ads">Bảng giá quảng cáo</a>
            </div>
            <div className="bottom-footer">
                <div className="container">
                    <address>
                        Số 60A, Hoàng Văn Thụ, Phường 9, Quận Phú Nhuận, Thành phố Hồ Chí Minh, Việt Nam
                    </address>
                    <p>© Copyright 2019 TuoiTreCuoi Online, All rights reserved <br /> ® Tuổi Trẻ Cuoi Online giữ bản quyền
                        nội dung trên website này</p>
                </div>
            </div>
        </footer>
    )
}

export default Footer
