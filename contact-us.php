<?php 
	ob_start();
	session_start();
	$pageTitle = 'تواصل معنا';
	include 'init.php';
?>
<div class="container main-contact-us mt-5">
    <div class="main-title text-center"><h1 class="text-center">تواصل معنا</h1></div>
    <div class="row mt-5">
        <div class="col-6">
            <div class="section-contact">
                <h2 class="fw-bold">الاتصال بنا</h2>
                <p>
                    <i class="fa-solid fa-map-marker-alt"></i>
                    <span>القاهرة , مصر</span>
                </p>
                <p>
                    <i class="fa-solid fa-envelope"></i>
                    <span><a href="mailto:3a.sala7@gmail.com">info@gmail.com</a></span>
                </p>
                <p>
                    <i class="fa-solid fa-phone"></i>
                    <span>+212 658 987 6543</span>
                </p>
            </div>
            <div class="social-links justify-content-start">
                <ul>
                    <li><i class="fa-brands fa-facebook-f"></i></li>
                    <li><i class="fa-brands fa-twitter"></i></li>
                    <li><i class="fa-brands fa-instagram"></i></li>
                    <li><i class="fa-brands fa-whatsapp"></i></li>
                </ul>
            </div>
        </div>
        <div class="col-6">
            <div class="section-contact section-mail">
                <h3 class="fw-bold">التواصل عبر الإنترنت</h3>
                <div class="form mt-5">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">الأسم</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">البريد الألكتروني</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingPassword" placeholder="text">
                        <label for="floatingPassword">رقم الموبايل</label>
                    </div>
                    <div class="form-floating mt-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">الرسالة</label>
                    </div>
                    <div class="btn-submit mt-3">
                        <a class="btn btn-secondary" href=""><span class="fw-bold">أرسال</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include $tpl . 'footer.php';
ob_end_flush(); 
?>