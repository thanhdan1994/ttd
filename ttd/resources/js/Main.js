import React, { Fragment } from "react";
import { Route } from "react-router-dom";
import Header from "./components/Header";
import Footer from "./components/Footer";
import LoginModal from "./components/modals/LoginModal";
import RegisterModal from "./components/modals/RegisterModal";
import Post from "./components/Items/Post";
import MyProducts from "./components/Items/MyProducts";
import SearchModal from "./components/modals/SearchModal";
import HomeContainer from "./containers/HomeContainer";
import DetailContainer from "./containers/DetailContainer";
import BookmarkContainer from "./containers/BookmarkContainer";
import NearbyContainer from "./containers/NearbyContainer";
import Menu from "./components/Items/Menu";
import Notification from "./components/Items/Notification";
import MyProductsContainer from "./containers/MyProductsContainer";
import FlashNotification from "./components/Items/FlashNotification";
import CategoryProductsContainer from "./containers/CategoryProductsContainer";

function Main() {
    return (
        <Fragment>
            <Header/>
            <Route exact path="/" component={HomeContainer}/>
            <Route exact path="/:slug/:id" component={DetailContainer}/>
            <Route path="/nearby" component={NearbyContainer}/>
            <Route path="/bookmarks" component={BookmarkContainer}/>
            <Route path="/my-products" component={MyProductsContainer}/>
            <Route path='/categories/:id/products' component={CategoryProductsContainer}/>
            <Footer/>
            <div className="bottom-bar">
                <Notification />
                <Post/>
                <MyProducts />
                <Menu />
            </div>
            <LoginModal/>
            <RegisterModal/>
            <SearchModal/>
            <FlashNotification />
        </Fragment>
    )
}
export default Main
