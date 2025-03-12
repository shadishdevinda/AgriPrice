<style>
    .footer {
        background-image: url(images/bg_4.jpg);
        background-size: cover;
        background-position: center;
        color: #fff;
        padding: 40px 0;
        position: relative;
    }

    .footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Dark overlay for better text visibility */
    }

    .footer-container {
        position: relative;
        z-index: 1;
    }

    .footer-logo {
        font-size: 24px;
        font-weight: bold;
        color: #ffcc00;
        margin-bottom: 15px;
    }

    .footer p {
        color: #ddd;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .footer-social a {
        color: #fff;
        margin-right: 15px;
        font-size: 20px;
        transition: color 0.3s ease-in-out;
    }

    .footer-social a:hover {
        color: #ffcc00;
    }

    .footer-widget h2 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #fff;
    }

    .footer-widget ul {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .footer-widget ul li {
        margin-bottom: 8px;
    }

    .footer-widget ul li a {
        color: #ddd;
        text-decoration: none;
        font-size: 14px;
        display: block;
        padding: 5px 0;
        transition: color 0.3s ease-in-out;
    }

    .footer-widget ul li a:hover {
        color: #ffcc00;
    }

    .footer-contact li {
        margin-bottom: 10px;
        color: #ddd;
    }

    .footer-contact li span {
        margin-right: 10px;
    }

    .footer-bottom {
        padding: 15px 0;
        text-align: center;
        font-weight: bold;
        color: rgb(0, 0, 0);
        margin-top: 40px;
    }

    @media (max-width: 768px) {
        .footer-widget {
            text-align: center;
        }

        .footer-social {
            justify-content: center;
        }
    }
</style>

<footer class="footer img" style="background-image: url(images/bg_4.jpg);">
    <div class="container footer-container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-widget">
                    <h2 class="footer-logo"><a href="#">Farmland</a></h2>
                    <p>Far far away, behind the word mountains, far from the countries.</p>
                    <div class="footer-social">
                        <a href="#"><span class="fa fa-twitter"></span></a>
                        <a href="#"><span class="fa fa-facebook"></span></a>
                        <a href="#"><span class="fa fa-instagram"></span></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-widget">
                    <h2 class="ftco-heading-2">Explore</h2>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}"><span class="fa fa-chevron-right mr-2"></span>Home</a></li>
                        <li><a href="#services"><span class="fa fa-chevron-right mr-2"></span>Services</a></li>
                        <li><a href="#contact"><span class="fa fa-chevron-right mr-2"></span>Contact Us</a></li>
                        <li><a href="#about"><span class="fa fa-chevron-right mr-2"></span>About</a></li>
                        <li><a href="{{ route('vegetables.index') }}"><span class="fa fa-chevron-right mr-2"></span>Vegetables Prices</a></li>
                        <li><a href="{{ route('fruits.index') }}"><span class="fa fa-chevron-right mr-2"></span>Fruits Prices</a></li>
                        <li><a href="{{ route('advices.vegetables.index') }}"><span class="fa fa-chevron-right mr-2"></span>Vegetable Advices</a></li>
                        <li><a href="{{ route('advices.fruits.index') }}"><span class="fa fa-chevron-right mr-2"></span>Fruit Advices</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-widget">
                    <h2 class="ftco-heading-2">Contact Us</h2>
                    <ul class="footer-contact">
                        <li><span class="fa fa-map marker"></span>203 Fake St. Mountain View, San Francisco, California, USA</li>
                        <li><a href="#"><span class="fa fa-phone"></span>+2 392 3929 210</a></li>
                        <li><a href="#"><span class="fa fa-paper-plane"></span><span class="__cf_email__" data-cfemail="d4bdbab2bb94adbba1a6b0bbb9b5bdbafab7bbb9">[email&#160;protected]</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p class="mb-0">Copyright ©
                <script data-cfasync="false" src="js/email-decode.min.js"></script>
                <script>
                    document.write(new Date().getFullYear());
                </script> AgriPrice. All rights reserved
            </p>
        </div>
    </div>
</footer>
