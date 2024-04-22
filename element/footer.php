    </main>
    <!-- END MAIN -->

    <!-- START FOOTER -->
    <footer class="bg-white dark:rounded-lg shadow dark:border dark:bg-gray-800 dark:border-gray-700 dark:mx-2">
        <div class="flex flex-row justify-around">
            <img src="http://<?= $serverName ?>/assets/images/icon/instagram.svg" alt="" class="icon" />
            <img src="http://<?= $serverName ?>/assets/images/icon/pinterest.svg" alt="" class="icon" />
            <img src="http://<?= $serverName ?>/assets/images/icon/twitter.svg" alt="" class="icon" />
            <img src="http://<?= $serverName ?>/assets/images/icon/youtube.svg" alt="" class="icon" />
            <img src="http://<?= $serverName ?>/assets/images/icon/gmail.svg" alt="" class="icon" />
        </div>
        <div class="flex flex-row justify-center dark:text-white">
            <p><a href="#" class="mr-2">CGU</a></p>
            <p><a href="#" class="ml-2">CGV</a></p>
        </div>
        <p class="text-center dark:text-white">©Copyright 2024. Tous droits non reservées</p>
    </footer>
    <!-- END FOOTER -->


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

    </html>