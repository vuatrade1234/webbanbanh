<div class="main__slice">
            <div class="slider">
                <div class="slide active" style="background-image:url(images/8-thang-3-120219-banner-short.jpg)">
                    <div class="container">
                        <div class="caption1">
                            <h1>Bánh ngọt tươi mới mỗi ngày!</h1>
                            <h1 style="margin-left: 120px; margin-top: 10px;">GIẢM 30%</h1>
                            <p style="margin-left: 120px;">Chất lượng là niềm tự hào của chúng tôi, bánh ngọt là niềm đam mê của bạn!</p>
                            <a href="productbycat.php?catid=7" class="btn btn--default">Xem ngay</a>

                        </div>
                    </div>
                </div>
                <div class="slide active" style="background-image:url(images/bannerbanhngot.jpg)">
                    <div class="container">
                        <div class="caption2">
                            <h1>Bánh ngọt, tình yêu và hạnh phúc trên mỗi dĩa!</h1>
                            <p>DUY NHẤT NGÀY 8/3</p>
                            <a href="detail.php?proid=39" class="btn btn--default">Xem ngay</a>

                        </div>
                    </div>
                </div>
                <div class="slide active" style="background-image:url(images/banh-dong-xu-1400x700.png)">
                    <div class="container">
                        <div class="caption3">
                            <h1>Bánh đồng tiền</h1>
                            <p>Món quà ngọt ngào cho bất kỳ dịp nào!</p>
                            <a href="productbycat.php?catid=11" class="btn btn--default">Xem ngay</a>

                        </div>
                    </div>
                </div>
            </div>
            <!-- controls  -->
            <div class="controls">
                <div class="prev">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="next">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
            <!-- indicators -->
            <div class="indicator">
            </div>
        </div>
<script>
	$(document).ready(function() {
    var currentSlide = 0;
    var slides = $('.slider .slide');
    var numSlides = slides.length;

    function goToSlide(n) {
        slides.eq(currentSlide).removeClass('active');
        currentSlide = (n+numSlides)%numSlides;
        slides.eq(currentSlide).addClass('active');
    }

    function nextSlide() {
        goToSlide(currentSlide+1);
    }

    function prevSlide() {
        goToSlide(currentSlide-1);
    }

    $('.controls .next').click(nextSlide);
    $('.controls .prev').click(prevSlide);

    setInterval(nextSlide, 5000); // Change slide every 5 seconds
});

</script>