<script>
(function () {
    "use strict";
    var menu = document.querySelector('body>header>div>div>div');
    var croix = document.querySelectorAll('body>header>div>div>div>span');
    var nav = document.querySelector('body>header>nav');
    var i = true;

    function anime(evt) {
        croix[0].classList.toggle("un");
        croix[1].classList.toggle("deux");
        croix[2].classList.toggle("trois");
        nav.classList.toggle('visible');
        if (i) {
            document.querySelector('body>header>div').style.position = "fixed";
            document.querySelector('body').style.overflowY = "hidden";
            i = false;
        } else {
            document.querySelector('body>header>div').style.position = "static";
            document.querySelector('body').style.overflowY = "auto";
            i = true;
        }
    }

    menu.addEventListener("click", anime);
}());
</script>
