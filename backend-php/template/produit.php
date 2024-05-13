<div class="font-[sans-serif]">
    <div class="p-4 mx-auto lg:max-w-6xl max-w-xl md:max-w-full">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-12">Tous nos produits <?= $productCategory ?></h2>

        <?php foreach ($productAllSelect as $product) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-gray-100 rounded-2xl p-6 cursor-pointer hover:-translate-y-2 transition-all relative">
                    <div class="bg-gray-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18px" class="fill-gray-800 inline-block" viewBox="0 0 64 64">
                            <path d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z" data-original="#000000"></path>
                        </svg>
                    </div>
                    <div class="w-2/3 h-[220px] overflow-hidden mx-auto aspect-w-16 aspect-h-8">
                        <img src="https://readymadeui.com/images/coffee1.webp" alt="Product 1" class="h-full w-full object-contain" />
                    </div>
                    <div class="text-center mt-4">
                        <h3 class="text-lg font-extrabold text-gray-800"><?= $product->name ?></h3>
                        <h4 class="text-2xl text-gray-800 font-bold mt-4"><?= $product->price ?> <span class="text-gray-400 ml-2 font-medium"><?= $product?->pound ?></span>
                        </h4>
                        <button type="button" class="w-full flex items-center justify-center gap-3 mt-6 px-4 py-2.5 bg-transparent hover:bg-gray-200 text-base text-[#333] border-2 font-semibold border-[#333] rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 512 512">
                                <path d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0" data-original="#000000"></path>
                            </svg>
                            Ajouter au panier</button>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
    </div>
</div>
<?php 
/*

<div>
    <?php if ($categoryName == '1') {
        $pageURL = 'café';

        $type = 'Choisissez la force de votre ';
    } elseif ($categoryName == '2') {
        $pageURL = 'thé';

        $type = 'Choisissez votre feuille de ';
    } else {
        $pageURL = 'Autres';
        $type = 'Choisissez une sous catégorie';
    } ?>

    <div class="mx-auto flex justify-start max-w-6x1">
        <h2 class="bg-gray-100 ml-10 p-2 rounded-xl">Meilleurs ventes de <?= $pageURL ?></h2>
    </div>

    <?php foreach ($mostSell as $sellMost): ?>
        <!-- // $imageData = json_decode($sellMost["images"], true);
        // $sellMost["images"] = $imageData; -->

        <div class="bg-gray-100 w-60 h-80 inline-block relative text-center m-2.5 rounded-x1">
            <div
                class="bg-grav-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="18px" class="fill-gray-800 inline-block" viewBox="0 0 64 64">
                    <path d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0
                    2.06
                    0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0
                    1
                    26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                        data-original="#000000">
                    </path>
                </svg>
            </div>
            <img id="<?= $sellMost['id'] ?>" class="article-image"
                src="http://<?= $serverName ?>/assets/images/<?= $sellMost['url_image'] ?>" alt="<?= $sellMost['name'] ?>">
            <p id="<?= $sellMost['id'] ?>" class="mt-3 font-bold article-name"><?= $sellMost['name'] ?>"</p>
            <div class="flex justify-center">
                <p class="mt-3 font-bold mr-2"><?= $sellMost['price'] ?>€</p>
                <p class="mt-3 font-medium text-gray-300"><?= $sellMost['price'] ?>€</p>
            </div>
            <div>
                <a href="addtobasket/<?= $sellMost['id'] ?>">
                    <button type="button" class="w-48 mt-4 px-4 py-3 bg-[#333] hover:bg-[#222] text-white rounded-full">Add
                        to
                        cart</button>
                </a>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="mx-auto flex max-w-6xl">
        <form method="post" class="flex items-center">
            <label class="mb-2 text-sm font-medium text-gray-900 dark:text-white"
                for="counterSubCat"><?= $type . $pageURL ?>:</label>
            <select name="counterSubCat" id="counterSubCat"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="subCatDefault">---</option>
                <?php foreach ($NameSubCat as $subCatName): ?>
                    <option value="<?= $subCatName['id'] ?>"><?= $subCatName['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <button type="button"
                class="filters text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800"
                id="expensive" value="expensive">Plus cher</button>
            <button type="button"
                class="filters text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800"
                id="cheaper" value="cheaper">Moins cher</button>
            <button type="button"
                class="filters text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800"
                id="bestSeller" value="bestSeller">Top des ventes</button>
            <button type="button"
                class="filters text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800"
                id="bestRated" value="bestRated">Mieux noté</button>
            <button type="button"
                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900"
                id="clear">Clear</button>
        </form>
    </div>

    <p id="paramsResarch"></p>
    <div id="resultat">
        <?php
        // affiche 10 produit
        foreach ($produitSql as $sqlProduit):
            // $imageData = json_decode($sqlProduit['images'], true);
            // $sqlProduit['images'] = $imageData;
            if (!empty($sqlProduit)): ?>

                <div class="bg-gray-100 w-60 h-80 inline-block relative text-center m-2.5 rounded-x1'">
                    <div
                        class="bg-grav-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4">
                        <svg xmlns="http://www.w3.org/2000/svg' width='18px' class='fill-gray-800 inline-block'
                        viewBox='0 0 64 64">
                            <path d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0
                            2.06
                            0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5
                            div0
                            1
                            26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                            data-original="#000000">
                            </path>
                        </svg>
                    </div>
                    <img id="<?= $sqlProduit['id'] ?>" class="article-image"
                        src="http://<?= $serverName ?>/assets/images/<?= $sqlProduit['url_image'] ?>"
                        alt="<?= $sqlProduit['name'] ?>">
                    <p id="<?= $sqlProduit['id'] ?>" class="mt-3 font-bold article-name"><?= $sqlProduit['name'] ?></p>
                    <div class="flex justify-center">
                        <p class="mt-3 font-bold mr-2"><?= $sqlProduit['price'] ?>€</p>
                        <p class="mt-3 font-medium text-gray-300"><?= $sqlProduit['price'] ?>€</p>
                    </div>
                    <div>
                        <a href="addtobasket/<?= $sqlProduit['id'] ?>">
                            <button type="button"
                                class="w-48 mt-4 px-4 py-3 bg-[#333] hover:bg-[#222] text-white rounded-full">Add
                                to
                                cart</button>
                        </a>
                    </div>
                </div>

                <?php endif;
            if (empty($sqlProduit) && empty($sellMost)): ?>

                <img src="http://<?= $serverName ?>/assets/images/oups.jpg" alt="Oups tout est vide repassez plus tard">

                <?php endif;
        endforeach;

        if (isset($counterSubCat)):
            foreach ($subCat as $catSub): ?>

                <div class="mx-auto flex justify-start max-w-6x1">
                    <h2 class="bg-gray-100 ml-10 p-2 rounded-xl"><?= $catSub['description'] ?>"</h2>
                </div>

            <?php endforeach;

            // affiche apres filtrage
            foreach ($products as $product): ?>
                <!-- // $imageData = json_decode($product['images'], true);
                // $product['images'] = $imageData;
                 -->

                <div class="bg-gray-100 w-60 h-80 inline-block relative text-center m-2.5 rounded-x1'">
                    <div
                        class="bg-grav-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4">
                        <svg xmlns="http://www.w3.org/2000/svg' width='18px' class='fill-gray-800 inline-block'
                            viewBox='0 0 64 64">
                            <path d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0
                            2.06
                            0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5
                            0 0
                            1
                            26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                data-original="#000000">
                            </path>
                        </svg>
                    </div>
                    <!-- <img id="<?= $product['id'] ?>" class="article-image"
                        src="http://<?= $serverName ?>/assets/images/<?= $product['images']['main'] ?>"
                        alt="<?= $product['name'] ?>"> -->
                    <p id="<?= $product['id'] ?>" class="mt-3 font-bold article-name"><?= $product['name'] ?></p>
                    <div class="flex justify-center">
                        <p class="mt-3 font-bold mr-2"><?= $product['price'] ?>€</p>
                        <p class="mt-3 font-medium text-gray-300"><?= $product['price'] ?>€</p>
                    </div>
                    <div>
                        <a href="addtobasket/<?= $product['id'] ?>">
                            <button type="button"
                                class="w-48 mt-4 px-4 py-3 bg-[#333] hover:bg-[#222] text-white rounded-full">Add
                                to
                                cart</button>
                        </a>
                    </div>
                </div>

                <?php endforeach;
        endif;
        ?>
    </div>
</div>

*/