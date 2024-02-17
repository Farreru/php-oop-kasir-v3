<footer>

</footer>

</body>

<script src="../../assets/js/bootstrap.min.js"></script>

<script>
    var currentURL = window.location.pathname;
    var regex = /\/([^\/]+)\/$/;
    var match = currentURL.match(regex);

    if (match) {
        var extracted = match[1];

        var navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(function(navLink) {

            var href = navLink.getAttribute('href');

            var matchHref = href.match(regex);
            if (matchHref) {
                var extractedHref = matchHref[1];

                if (extracted == extractedHref) {
                    navLink.classList.add('active');
                }
            }
        });
    }
</script>


</html>