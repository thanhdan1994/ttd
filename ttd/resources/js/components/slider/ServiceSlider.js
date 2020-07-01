import React, {Component} from "react";
import Slider from "react-slick";

export default class Service extends Component {
    render() {
        const settings = {
            variableWidth: true,
            slidesToScroll: 3
        };
        return (
            <Slider ul className="slide-tags" {...settings}>
                <li className="slide-tags-item">
                    <img src="https://cuoifly.tuoitre.vn/60/0/ttc/r/2020/06/06/ezlaimixyae8vbd-1591419542-16x9.jpg>" alt="" />
                    <a href="/chu-de/an-do-2082.html"> #ấn độ</a>
                </li>
                <li className="slide-tags-item">
                    <img src="https://cuoifly.tuoitre.vn/60/0/ttc/r/2020/05/28/cau-be-khoc-vi-duoc-an-ga-ran-sau-hai-thang-cach-ly-1590652251-16x9.jpg>" alt="" />
                    <a href="/chu-de/cach-ly-6957.html"> #cách ly</a>
                </li>
                <li className="slide-tags-item">
                    <img src="https://cuoifly.tuoitre.vn/60/0/ttc/r/2020/06/13/thieu-mau-1592059344-16x9.jpg>" alt="" />
                    <a href="/chu-de/covid19-7492.html"> #covid-19</a>
                </li>
                <li className="slide-tags-item">
                    <img src="https://cuoifly.tuoitre.vn/60/0/ttc/r/2020/03/13/cach-li-1584068298-16x9.jpg>" alt="" />
                    <a href="/chu-de/benh-vien-da-chien-9171.html"> #bệnh viện dã chiến</a>
                </li>
                <li className="slide-tags-item">
                    <img src="https://cuoifly.tuoitre.vn/60/0/ttc/r/2020/06/18/cach-ly-lon-nhat-the-gioi-1592473350-16x9.jpg>" alt="" />
                    <a href="/chu-de/lon-nhat-the-gioi-14561.html"> #lớn nhất thế giới</a>
                </li>
            </Slider>
        )
    }
}
