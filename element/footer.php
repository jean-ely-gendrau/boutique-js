</main>
<!-- END MAIN -->

<!-- START FOOTER -->
<footer class="bg-white dark:rounded-lg shadow dark:border dark:bg-gray-800 dark:border-gray-700 dark:mx-2 mx-auto w-full">
    <div class="mb-6 border-b-4 border-black">
        <ul class="my-6 flex flex-row justify-around">
            <li class="border-r-2 border-black w-[25%] text-center">
                <img src="http://<?= $serverName ?>/assets//images//icon//icon_creditcard.png" alt="Icon de carte de crédit" class="mx-auto w-20">
                <p class="text-xl font-semibold">PAIEMENT 100% SÉCURISÉ</p>
                <p>CB, Visa, Mastercard<br>Paypal</p>
            </li>   
            <li class="border-r-2 border-black w-[25%] text-center">
                <img src="http://<?= $serverName ?>/assets//images//icon//icon_delivery.png" alt="Icon de livraison" class="mx-auto w-20">
                <p class="text-xl font-semibold">LIVRAISON EXPRESS</p>
                <p>Colissimo - La poste<br>Livraison sous 48H</p> 
            </li>
            <li class="border-r-2 border-black w-[25%] text-center">
                <img src="http://<?= $serverName ?>/assets//images//icon//icon_email2.png" alt="Icon d'email" class="mx-auto w-20">
                <p class="text-xl font-semibold">CONTACTEZ-NOUS</p>
                <p>04.04.04.04.04<br>coucou@teacoffee.com</p>  
            </li>
            <li class="w-[25%] text-center">
                <img src="http://<?= $serverName ?>/assets//images//icon//icon_warranty.png" alt="Icon de garantie" class="mx-auto w-20">
                <p class="text-xl font-semibold">GARANTIES</p>
                <p>Qualité fraicheur<br>Un savoir faire artisanal</p>                
            </li>
        </ul>
    </div>
    <div class="mb-6 border-b-4 border-black flex flex-row justify-around">
        <div >
            <img src="" alt="">
            <p>Paiement sécurisé</p>
        </div>
        <div>
            <img src="http://<?= $serverName ?>/assets//images//icon//icon_delivery_anim.gif" alt="">
            <p>Livraison sous 48h</p>
        </div>
        <div>
            <!-- <img src="" alt=""> -->
            wzrwaorf
            <p>Nous contacter</p>

        </div>
        <div>
            <img src="" alt="">
            <p>Garantie qualité</p>
        </div>

    </div>
    <!-- text-align: center;
    padding-top: 32px;
    font-size: .75rem;
    letter-spacing: .6px;
    line-height: 1.2;
    cursor: pointer; -->
    <!-- <div class="flex flex-row justify-around">
        <img src="http://<?= $serverName ?>/assets/images/icon/instagram.svg" alt="" class="cursor-pointer" />
        <img src="http://<?= $serverName ?>/assets/images/icon/pinterest.svg" alt="" class="cursor-pointer" />
        <img src="http://<?= $serverName ?>/assets/images/icon/twitter.svg" alt="" class="cursor-pointer" />
        <img src="http://<?= $serverName ?>/assets/images/icon/youtube.svg" alt="" class="cursor-pointer" />
        <img src="http://<?= $serverName ?>/assets/images/icon/gmail.svg" alt="" class="cursor-pointer" />
    </div> -->
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<script src="http://<?= $serverName ?>/assets/js/flowbite.min.js"></script>
<script type="module" src="http://<?= $serverName ?>/assets/js/teaCoffee.module.js"></script>
<script src="http://<?= $serverName ?>/assets/js/script.js"></script>
<script src="http://<?= $serverName ?>/assets/js/produit.js"></script>
<script src="http://<?= $serverName ?>/assets/js/accueil-carousel.js"></script>
<script src="http://<?= $serverName ?>/assets/js/filters.js"></script>
</body>

</html>