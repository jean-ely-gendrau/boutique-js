<section>
    <div class="flex flex-col mx-auto text-center md:max-[55rem]">
      <div class="bg-white mx-auto rounded-lg shadow dark:border md:w-[55rem] md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-3xl my-4 text-gray-700 dark:text-gray-200">Continuez votre shopping chez <span class="text-green-600">Tea'</span><span class="text-amber-700">Coffee</span></h1>

          <p class="text-md md:text-xl text-center text-gray-700 dark:text-gray-200">Bonjour <span class=""><?= $client->full_name ?></span>, nous avons remarqué que vous avez quitté votre panier sans finaliser votre commande. Votre panier est toujours prêt et les articles que vous avez sélectionnés vous attendent.</p>

          <button class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded"><a href="../panier">Revenir à mon panier</a></button>
          
          <p class="text-md md:text-xl text-center text-gray-700 dark:text-gray-200">Si vous avez besoin de plus de temps pour réfléchir ou si vous souhaitez ajouter d'autres articles, n'hésitez pas à regarder notre sélection d'articles.</p></p>
          <!-- Slide de produit recommander -->
          <div class="block mx-auto">
            <?= $products ?>

          </div>
          <p class="mt-12 text-md md:text-xl text-center text-gray-700 dark:text-gray-200">Si vous avez des questions ou des préoccupations, n'hésitez pas à nous <a class="text-gray-700 dark:text-gray-200 underline hover:no-underline" href="/contact">contacter</a>. Notre équipe est là pour vous aider.</p>
        </div>
      </div>
    </div>
</section>
