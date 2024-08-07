<section>
    <div class="flex flex-col mx-auto text-center md:max-[55rem]">
      <div class="bg-white mx-auto rounded-lg shadow dark:border md:w-[55rem] md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <div>
                <h1 class="text-3xl my-4 text-gray-700 dark:text-gray-200">Bienvenue <?php echo $profil["full_name"] ?></h1>
                <div>
                    <p>votre adresse mail est : <?php echo $profil["email"] ?></p>
                    <p>votre date de naissance est : <?php echo $profil["birthday"] ?></p>
                    <p>votre adresse est : <?php echo $profil["adress"] ?></p>

                </div>
            </div>
            
            <div class="items-center">
                <a href="modification"
                    class="mx-auto flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                        src="https://<?= $serverName ?>/assets/images/image_modification.jpg" alt="image_modification_profil">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Modification de profil</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Vous pouvez modifier votre profil ici.</p>
                    </div>
                </a>
            
            
                <a href="historique"
                    class="mx-auto flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                        src="https://<?= $serverName ?>/assets/images/image_historique.jpg" alt=" image_historique_achat">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Historique d'achat</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Vous pouvez voire votre historique ici et
                            l'etat de vos livraisons.</p>
                    </div>
                </a>
            
            
                <a href="panier"
                    class="mx-auto flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                        src="https://<?= $serverName ?>/assets/images/image_panier.jpg" alt="image_panier">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Consulter votre panier</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Vous pouvez voire votre panier ici.</p>
                    </div>
                </a>
            
                <a href="wishlist"
                    class="mx-auto flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                        src="https://<?= $serverName ?>/assets/images/wishlist.jpg" alt="image_panier">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Vos produits favoris.</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Ici se trouvent les produits que vous avez
                            ajoutés à la liste de favoris.</p>
                    </div>
                </a>
            </div>
        </div>
      </div>
    </div>
</section>







