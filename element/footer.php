    </main>
    <!-- END MAIN -->

    <!-- START FOOTER -->
    <footer>
        <div class="flex flex-row justify-around">
            <img src="http://<?= $serverName ?>/assets/images/icon/instagram.svg" alt="" class="icon" />
            <img src="http://<?= $serverName ?>/assets/images/icon/pinterest.svg" alt="" class="icon" />
            <img src="http://<?= $serverName ?>/assets/images/icon/twitter.svg" alt="" class="icon" />
            <img src="http://<?= $serverName ?>/assets/images/icon/youtube.svg" alt="" class="icon" />
            <img src="http://<?= $serverName ?>/assets/images/icon/gmail.svg" alt="" class="icon" />
        </div>
        <div class="flex flex-row justify-center">
            <p><a href="#" class="mr-2">CGU</a></p>
            <p><a href="#" class="ml-2">CGV</a></p>
        </div>
        <p class="text-center">©Copyright 2024. Tous droits non reservées</p>
    </footer>
    <!-- END FOOTER -->

<<<<<<< HEAD
    <!-- START ADD JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <script src="http://<?= $serverName ?>/assets/js/flowbite.min.js"></script>
    <script src="http://<?= $serverName ?>/assets/js/script.js"></script>
    <script>
        /*Toggle dropdown list*/
        function toggleDD(myDropMenu) {
            document.getElementById(myDropMenu).classList.toggle("invisible");
        }
        /*Filter dropdown options*/
        function filterDD(myDropMenu, myDropMenuSearch) {
            var input, filter, ul, li, a, i;
            input = document.getElementById(myDropMenuSearch);
            filter = input.value.toUpperCase();
            div = document.getElementById(myDropMenu);
            a = div.getElementsByTagName("a");
            for (i = 0; i < a.length; i++) {
                if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        }
        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
                var dropdowns = document.getElementsByClassName("dropdownlist");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (!openDropdown.classList.contains('invisible')) {
                        openDropdown.classList.add('invisible');
                    }
                }
            }
        }
    </script>
    <!-- STOP ADD JS -->

    </body>

=======

    <!-- ADD JS -->
    <script>
        function onSubmit(token) {
            document.getElementById("verif").submit();
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <script src="http://<?= $serverName ?>/assets/js/flowbite.min.js"></script>
    <script type="module" src="http://<?= $serverName ?>/assets/js/teaCoffee.module.js"></script>
    <script src="http://<?= $serverName ?>/assets/js/script.js"></script>

    </body>

>>>>>>> main
    </html>