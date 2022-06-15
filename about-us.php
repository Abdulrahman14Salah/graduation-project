<?php 
	ob_start();
	session_start();
	$pageTitle = 'من نحن';
	include 'init.php';
?>
<div class="container main-about-us mt-5">
    <div class="row">
        <div class="col-lg-6">
            <div class="box-section">
            <h1 class="fw-bold">معلومات عنا</h1>
            <p class="lead">محجوب هو متجر واحد متميز عن غيره في السوق من خلال الحصول على مذاق رائع في اختيار المنتجات وله علامات تجارية عالمية حصرية من السيراميك والبورسلان في العالم

    مع سجل حافل ومكانة قيادية في السوق ، تم تأسيس محجوب من قبل السيد عبد العزيز محجوب كشركة مصرية راسخة لتجارة واستيراد السيراميك والبورسلين والأدوات الصحية

    بعد مرور 70 عامًا على تلبية احتياجات العملاء وتقديم خدمات استثنائية ، أصبحت محجوب الآن أربع صالات عرض رائعة في مواقع استراتيجية حول القاهرة الكبرى وأصبحت شركة رائدة في عالم السيراميك والبورسلان في مصر
            </p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="img img-fluid mt-5 pt-5"><img src="uploads/about-us.svg" alt=""></div>
        </div>
    </div>
    <div class="custom-hr"></div>
    <div class="row flex-lg-row-reverse">
        <div class="col-lg-6">
            <div class="box-section">
                <h1 class="fw-bold">أهدافنا</h1>
                <p class="lead">
                    توسيع أعمالنا في القاهرة الكبرى ومصر ؛ بدءاً بثلاث صالات عرض جديدة معلقة قيد الإنشاء

                    نسعى لتجاوز توقعات العملاء في جميع الأوقات من خلال تقديم مجموعة واسعة من المنتجات وخدمة استثنائية لإكمال تجربة سعيدة في محجوب

                    تقديم علامات تجارية محلية وعالمية جديدة في السوق وتقديم خدمات متقدمة لراحة العملاء واحتياجاتهم

                    لتزويد عملائنا بتجربة تسوق راقية للحمامات والسيراميك والبورسلين
                </p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="img"><img src="uploads/about-us.png" alt=""></div>
        </div>
    </div>
    <div class="custom-hr"></div>
    <div class="row">
        <div class="col-lg-6">
            <div class="box-section">
            <h1 class="fw-bold">مهمتنا</h1>
            <p class="lead">
            أن نقدم لزبائننا أرقى و أحدث التصميمات و الصيحات العالمية في عالم السيراميك و البورسلين ، ليكون زبوننا راضياً بما يشاهده تحت سقف معارضنا، و يختار ما يناسبه و كأنه يراه في منزله .

تأمين كل ما يحتاجه العاملين من دعم و معرفة لتطوير قدرتهم على تقديم أفضل الحلول والخدمات لزبائننا ، وليكون تسوق البورسلين و السيراميك تجربة جديدة و فريدة لم نعهدها من قبل .

المتابعة في بناء نظام مؤسساتي يضمن جودة عالية في التسليم و خدمة ما بعد البيع، و يعزز الاستمرار في النمو و التوسع.

الحفاظ على التواصل مع الأسواق العالمية و المحافظة على أفضل العلاقات مع الشركات و المصنعين الرواد في الصناعة، كي نعزز فلسفتنا في توفير الجديد و المبتكر لزبائننا.
            </p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="img"><img class="mt-2" src="uploads/mission-png-3.png" alt=""></div>
        </div>
    </div>
    <div class="custom-hr"></div>
    <div class="row flex-lg-row-reverse">
        <div class="col-lg-6">
            <div class="box-section">
            <h1 class="fw-bold">رؤيتنا</h1>
            <p class="lead">
                نسعى في محجوب إلى توسيع شبكتنا من صالات العرض الراقية وبناء ولاء العملاء على أهدافنا والأهداف الأساسية التي تحدد موقعنا في السوق.
            </p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="img"><img class="vision mt-2" src="uploads/Vision-1.png" alt=""></div>
        </div>
    </div>
</div>

<?php 
include $tpl . 'footer.php';
ob_end_flush(); 
?>