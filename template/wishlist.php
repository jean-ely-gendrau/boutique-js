<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
        <div
            class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-full xl:p-0 dark:bg-gray-800 dark:border-gray-700 mx-2 h-full">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-gray-500 dark:text-gray-400 text-lg md:text-xl lg:text-2xl">Here are you favorite
                    products</h1>
                <?php /* var_dump($produitFavoris);*/
                foreach ($produitFavoris as $favori): ?>
                    <p> <?= $favori->name ?> </p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>