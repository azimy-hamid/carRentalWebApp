<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 2,
        spaceBetween: 30,
        autoplay: {
            delay: 7000
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
</script>

<script>

    AOS.init({
        offset: 100, 
        duration: 500, 
        easing: 'ease-in-out', 
        once: true, 
        debounceDelay: 50, 
        disable: 'mobile', 
    });
</script>