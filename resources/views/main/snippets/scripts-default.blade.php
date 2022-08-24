<!-- BEGIN: SLICK -->
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<!-- BEGIN: SLICK -->

<script type="text/javascript">
    $(window).ready(function(){
        loadImage();
    });

    function showHideChild(element){
        const parent    = $(element);
        if(parent.hasClass('nowOff')){
            parent.removeClass('nowOff').addClass('nowOn');
            parent.next().css('display', 'block');
        }else {
            parent.removeClass('nowOn').addClass('nowOff');
            parent.next().css('display', 'none');
        }
    }

    function loadImage(){
        $(document).find('img[data-src]').each(function(){
            $(this).attr('src', $(this).attr('data-src'));
        });
    }

    /* go to Top */
    mybutton 					    = document.getElementById("gotoTop");
    window.onscroll                 = function() {scrollFunction()};
    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display 	= "block";
        } else {
            mybutton.style.display 	= "none";
        }
    }
    function gotoTop() {
        document.documentElement.scrollTop          = 0;
    }
</script>