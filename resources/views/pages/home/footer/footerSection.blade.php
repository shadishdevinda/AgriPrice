
<style>
.ftco-footer-widget {
    color: #fff;
}
.ftco-footer-widget h2 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #fff;
}
.ftco-footer-widget ul {
    padding: 0;
    margin: 0;
    list-style: none;
}
.ftco-footer-widget ul li {
    position: relative;
    margin-bottom: 8px;
}
.ftco-footer-widget ul li a {
    color: #ddd;
    text-decoration: none;
    font-size: 14px;
    display: block;
    padding: 5px 10px;
    transition: color 0.3s ease-in-out;
}
.ftco-footer-widget ul li a:hover {
    color: #ffcc00;
}
.dropdown {
    position: relative;
}
.dropdown-list {
    position: relative;
    margin-left: 20px;
    display: none; 
}
.dropdown-list li {
    padding: 2px 10px;
}
.dropdown-list li a {
    font-size: 13px;
    width: 200px;
    color: #bbb;
    display: block;
    transition: color 0.3s ease-in-out;
}
.dropdown-list li a:hover {
    color: #ffcc00;
}
.dropdown:hover .dropdown-list {
    display: block;
}

@media (max-width: 768px) {
    .ftco-footer-widget {
        text-align: center;
    }

    .ftco-footer-widget ul {
        display: inline-block;
    }

    .dropdown {
        position: relative;
    }

    .dropdown-list {
        position: relative;
        display: none;
    }

    .dropdown:hover .dropdown-list {
        display: block;
    }
}



</style>

<footer class="ftco-footer">
    <div class="container">
        <div class="row mb-5 justify-content-between">
            <div class="col-sm-12 col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2 logo"><a href="#">Farmland</a></h2>
                    <p>Far far away, behind the word mountains, far from the countries.</p>
                    <ul class="ftco-footer-social list-unstyled mt-2">
                        <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-2">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Explore</h2>
                    <ul class="list-unstyled">
                        <div class="dropdown">
                            <li><a href="{{ route('home') }}"><span class="fa fa-chevron-right mr-2"></span>Home</a></li>
                        <ul class="dropdown-list">
                            <li><a href="#services"><span class="fa fa-chevron-right mr-2"></span>Services</a></li>
                            <li><a href="#contact"><span class="fa fa-chevron-right mr-2"></span>Contact Us</a></li>
                            <li><a href="#about"><span class="fa fa-chevron-right mr-2"></span>About</a></li>
                        </ul>
                        </div>
                        <li><a href="{{ route('vegetables.index') }}"><span class="fa fa-chevron-right mr-2"></span>Vegetables Prices</a></li>
                        <li><a href="{{ route('fruits.index') }}"><span class="fa fa-chevron-right mr-2"></span>Fruits Prices</a></li>
                        <div class="dropdown">
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Crops Advices</a></li>
                        <ul class="dropdown-list">
                            <li><a href="{{ route('advices.vegetables.index') }}"><span class="fa fa-chevron-right mr-2"></span>Vegetable Advices</a></li>
                            <li><a href="{{ route('advices.fruits.index') }}"><span class="fa fa-chevron-right mr-2"></span>Fruit Advices</a></li>
                        </ul>
                        </div>
                        
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Have a Questions?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon fa fa-map marker"></span><span class="text">203 Fake St.
                                    Mountain View, San Francisco, California, USA</span></li>
                            <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+2
                                        392 3929 210</span></a></li>
                            <li><a href="#"><span class="icon fa fa-paper-plane pr-4"></span><span
                                        class="text"><span class="__cf_email__"
                                            data-cfemail="d4bdbab2bb94adbba1a6b0bbb9b5bdbafab7bbb9">[email�&nbsp;protected]</span></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid px-0 py-5 bg-black">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="mb-0" style="text-align: center; color: rgba(255,255,255,.5);">Copyright ©
                        <script data-cfasync="false" src="js/email-decode.min.js"></script>
                        <script>
                            document.write(new Date().getFullYear());
                        </script> Colorlib Theme. <i
                            class="color-danger" aria-hidden="true"></i>All rights reserved
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>