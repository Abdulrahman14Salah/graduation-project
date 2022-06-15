<div class="footer">
  <!-- Remove the container if you want to extend the Footer to full width. -->
<div class="mt-5">
  <!-- Footer -->
  <footer
    class="text-center text-lg-start text-dark fw-bold"
    style="background-color: #ddd; color:#333"; 
  >
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Links -->
      <section class="links-footer">
        <!--Grid row-->
        <div class="row">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
          <img class="mb-3" src="uploads/logo1.png" alt="" />
            <p>
            مرحبا بكم في سيراميكا للسيراميك والبورسلين
تعد سيراميكا واحدة من أكبر شركات السيراميك والبورسلين في مصر ، مع مواقع استراتيجية في جميع أنحاء القاهرة الكبرى والجيزة. نخدم عملائنا منذ عام 1948.
            </p>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none" />
          <?php 
          $allS = getAllFrom("*", "categories", "where parent = 0", "", "ID", "ASC LIMIT 4");
          
          ?>
          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3 categories-links">
            <h3 class="text-uppercase mb-4 fw-bold">الأقسام</h3>
            <?php 
            foreach ($allS as $c) {
              echo '
              <p>
                <a class="text-dark fw-bold" href="categories.php?pageid=' . $c['ID'] .'">'. $c['Name'] . '</a>
              </p>';
            };?>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3 tell">
            <h3 class="text-uppercase mb-4 fw-bold">وسائل التواصل</h3>
            <p><i class="fas fa-home mr-3"></i>القاهرة , مصر</p>
            <p><i class="fas fa-envelope mr-3"></i>info@gmail.com</p>
            <p><i class="fas fa-phone mr-3"></i>201121600780+</p>
            <p><i class="fas fa-print mr-3"></i>201558211760+</p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto my-3">
            <div><h3 class="text-uppercase mb-4 fw-bold">تابعنا</h3></div>
            <div class="social-links">
              <ul>
                <li><i class="fa-brands fa-facebook-f"></i></li>
                <li><i class="fa-brands fa-twitter"></i></li>
                <li><i class="fa-brands fa-instagram"></i></li>
                <li><a href="http://web.whatsapp.com/send?phone=2001121600780"><i class="fa-brands fa-whatsapp"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <!--Grid row-->
      </section>
      <!-- Section: Links -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
      © 2022 Copyright:
      <a class="text-dark fw-bold text-decoration-none" href="https://arqamweb.com/">ArqamWeb.com</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
</div>
<!-- End of .container -->
</div>
		<script src="<?php echo $js ?>popper.min.js"></script>
		<script src="<?php echo $js ?>bootstrap.min.js"></script>
		<script src="<?php echo $js ?>all.min.js"></script>
		<script src="<?php echo $js ?>main.js"></script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
      var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
      (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
      s1.async=true;
      s1.src='https://embed.tawk.to/62aa1d7d7b967b117994bc8e/1g5k86dal';
      s1.charset='UTF-8';
      s1.setAttribute('crossorigin','*');
      s0.parentNode.insertBefore(s1,s0);
      })();
    </script>
<!--End of Tawk.to Script-->
	</body>
</html>