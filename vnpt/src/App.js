import "./App.css";
import { BrowserRouter, Routes, Route } from "react-router-dom";
// Component
// Header
import Header from "./views/Header";
// Banner
import BannerTop from "./views/BannerTop";
// HomePage
import HomePage from "./views/HomePage";
// Footer
import Footer from "./views/Footer";
// ChatBot
import ChatBot from "./views/ChatBot";
// ProductByIDServices
import ProductByIDServices from "./views/ProductByIDServices";
function App() {
  return (
    <BrowserRouter>
      <div className="container-fluid p-0">
        <Header />
        <BannerTop />
        <Routes>
          <Route path="/" element={<HomePage />} />
          <Route path="/services/:id" element={<ProductByIDServices />} />
        </Routes>
        <Footer />
        <ChatBot />
      </div>
    </BrowserRouter>
  );
}

export default App;
