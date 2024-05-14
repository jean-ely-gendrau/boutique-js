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
            <div id='<?= $sellMost['id'] ?>'
                class='favorites bg-gray-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4'>
                <svg class='fill-gray-800 inline-block' width='22px' viewBox='0 0 192 192'
                    xmlns='http://www.w3.org/2000/svg' xml:space='preserve' fill='none'>
                    <g id='SVGRepo_bgCarrier' stroke-width='0'></g>
                    <g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g>
                    <g id='SVGRepo_iconCarrier'>
                        <path
                            d='M60.732 29.7C41.107 29.7 22 39.7 22 67.41c0 27.29 45.274 67.29 74 94.89 28.744-27.6 74-67.6 74-94.89 0-27.71-19.092-37.71-38.695-37.71C116 29.7 104.325 41.575 96 54.066 87.638 41.516 76 29.7 60.732 29.7z'
                            style='clip-rule:evenodd;display:inline;fill:none;stroke:rgb(235, 55, 55);stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2;stroke-dasharray:none;stroke-opacity:1'>
                        </path>
                    </g>
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
                    <div id='<?= $sqlProduit['id'] ?>'
                        class='favorites bg-gray-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4'>
                        <svg class='fill-gray-800 inline-block' width='22px' viewBox='0 0 192 192'
                            xmlns='http://www.w3.org/2000/svg' xml:space='preserve' fill='none'>
                            <g id='SVGRepo_bgCarrier' stroke-width='0'></g>
                            <g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g>
                            <g id='SVGRepo_iconCarrier'>
                                <path
                                    d='M60.732 29.7C41.107 29.7 22 39.7 22 67.41c0 27.29 45.274 67.29 74 94.89 28.744-27.6 74-67.6 74-94.89 0-27.71-19.092-37.71-38.695-37.71C116 29.7 104.325 41.575 96 54.066 87.638 41.516 76 29.7 60.732 29.7z'
                                    style='clip-rule:evenodd;display:inline;fill:none;stroke:rgb(235, 55, 55);stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2;stroke-dasharray:none;stroke-opacity:1'>
                                </path>
                            </g>
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
                    <div id='{$productItem->id}'
                        class='favorites bg-gray-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4'>
                        <svg class='fill-gray-800 inline-block' width='22px' viewBox='0 0 192 192'
                            xmlns='http://www.w3.org/2000/svg' xml:space='preserve' fill='none'>
                            <g id='SVGRepo_bgCarrier' stroke-width='0'></g>
                            <g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g>
                            <g id='SVGRepo_iconCarrier'>
                                <path
                                    d='M60.732 29.7C41.107 29.7 22 39.7 22 67.41c0 27.29 45.274 67.29 74 94.89 28.744-27.6 74-67.6 74-94.89 0-27.71-19.092-37.71-38.695-37.71C116 29.7 104.325 41.575 96 54.066 87.638 41.516 76 29.7 60.732 29.7z'
                                    style='clip-rule:evenodd;display:inline;fill:none;stroke:rgb(235, 55, 55);stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2;stroke-dasharray:none;stroke-opacity:1'>
                                </path>
                            </g>
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