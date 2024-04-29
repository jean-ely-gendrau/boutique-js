<div>
    <?php

    if ($categoryName == "2") {
        $pageURL = 'café';

        $type = "Choisissez la force de votre ";

    } else if ($categoryName == "1") {
        $pageURL = 'thé';

        $type = "Choisissez votre feuille de ";

    } else {
        $pageURL = "Autres";
        $type = "Choisissez une sous catégorie";
    }

    ?>

    <div class="mx-auto flex justify-start max-w-6x1">
        <h2 class="bg-gray-100 ml-10 p-2 rounded-xl">Meilleurs ventes de <?= $pageURL ?></h2>
    </div>

    <?php
    foreach ($mostSell as $sellMost):
        // $imageData = json_decode($sellMost["images"], true);
        // $sellMost["images"] = $imageData;
        ?>

        <div class="bg-gray-100 w-60 h-80 inline-block relative text-center m-2.5 rounded-x1">
            <div
                class="bg-grav-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="18px" class="fill-gray-800 inline-block" viewBox="0 0 64 64">
                    path d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0
                    2.06
                    0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 div0
                    1
                    26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                    data-original="#000000">
                    </path>
                </svg>
            </div>
            <!-- <img id="<?= $sellMost['id'] ?>" class="article-image"
                src="http://<?= $serverName ?>/assets/images/<?= $sellMost['images']['main'] ?>"
                alt="<?= $sellMost["name"] ?>"> -->
            <p id="<?= $sellMost['id'] ?>" class="mt-3 font-bold article-name"><?= $sellMost["name"] ?>"</p>
            <div class="flex justify-center">
                <p class="mt-3 font-bold mr-2"><?= $sellMost["price"] ?>€</p>
                <p class="mt-3 font-medium text-gray-300"><?= $sellMost["price"] ?>€</p>
            </div>
            <div>
                <button type="button" class="w-48 mt-4 px-4 py-3 bg-[#333] hover:bg-[#222] text-white rounded-full">Add to
                    cart</button>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="mx-auto flex justify-start max-w-6x1">
        <form method="post">
            <label for="counterSubCat"><?= $type . $pageURL ?>: </label>
            <select name="counterSubCat" id="counterSubCat" onchange="filterPrice()">
                <option value="subCatDefault">---</option>
                <?php foreach ($NameSubCat as $subCatName): ?>
                    <option value="<?= $subCatName['id'] ?>"><?= $subCatName['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <select name="Filtre" id="orderBy" onchange="filterPrice()">
                <option value="orderByDefault">---</option>
                <option value="asc">Ascendent</option>
                <option value="desc">Descendent</option>
            </select>
            <div id="text"></div>
        </form>

    </div>

    <div id="resultat">
        <?php

        // affiche 10 produit
        foreach ($produitSql as $sqlProduit):
            // $imageData = json_decode($sqlProduit['images'], true);
            // $sqlProduit['images'] = $imageData;
            if (!empty($sqlProduit)):
                ?>

                <div class="bg-gray-100 w-60 h-80 inline-block relative text-center m-2.5 rounded-x1'">
                    <div
                        class="bg-grav-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4">
                        <svg xmlns="http://www.w3.org/2000/svg' width='18px' class='fill-gray-800 inline-block'
                        viewBox='0 0 64 64">
                            path d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0
                            2.06
                            0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5
                            div0
                            1
                            26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                            data-original="#000000">
                            </path>
                        </svg>
                    </div>
                    <!-- <img id="<?= $sqlProduit['id'] ?>" class="article-image"
                    src="http://<?= $serverName ?>/assets/images/<?= $sqlProduit['images']['main'] ?>"
                    alt="<?= $sqlProduit["name"] ?>"> -->
                    <p id="<?= $sqlProduit['id'] ?>" class="mt-3 font-bold article-name"><?= $sqlProduit["name"] ?></p>
                    <div class="flex justify-center">
                        <p class="mt-3 font-bold mr-2"><?= $sqlProduit["price"] ?>€</p>
                        <p class="mt-3 font-medium text-gray-300"><?= $sqlProduit["price"] ?>€</p>
                    </div>
                    <div>
                        <button type="button" class="w-48 mt-4 px-4 py-3 bg-[#333] hover:bg-[#222] text-white rounded-full">Add
                            to
                            cart</button>
                    </div>
                </div>

                <?php
            endif;
            if (empty($sqlProduit) && empty($sellMost)):
                ?>

                <img src="http://<?= $serverName ?>/assets/images/oups.jpg" alt="Oups tout est vide repassez plus tard">

                <?php
            endif;
        endforeach;

        if (isset($counterSubCat)):

            foreach ($subCat as $catSub):
                ?>

                <div class="mx-auto flex justify-start max-w-6x1">
                    <h2 class="bg-gray-100 ml-10 p-2 rounded-xl"><?= $catSub["description"] ?>"</h2>
                </div>

            <?php endforeach;

            // affiche apres filtrage
            foreach ($products as $product):
                // $imageData = json_decode($product['images'], true);
                // $product['images'] = $imageData;
        
                ?>

                <div class="bg-gray-100 w-60 h-80 inline-block relative text-center m-2.5 rounded-x1'">
                    <div
                        class="bg-grav-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4">
                        <svg xmlns="http://www.w3.org/2000/svg' width='18px' class='fill-gray-800 inline-block'
                            viewBox='0 0 64 64">
                            path d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0
                            2.06
                            0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5
                            div0
                            1
                            26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                            data-original="#000000">
                            </path>
                        </svg>
                    </div>
                    <!-- <img id="<?= $product['id'] ?>" class="article-image"
                        src="http://<?= $serverName ?>/assets/images/<?= $product['images']['main'] ?>"
                        alt="<?= $product["name"] ?>"> -->
                    <p id="<?= $product['id'] ?>" class="mt-3 font-bold article-name"><?= $product["name"] ?></p>
                    <div class="flex justify-center">
                        <p class="mt-3 font-bold mr-2"><?= $product["price"] ?>€</p>
                        <p class="mt-3 font-medium text-gray-300"><?= $product["price"] ?>€</p>
                    </div>
                    <div>
                        <button type="button" class="w-48 mt-4 px-4 py-3 bg-[#333] hover:bg-[#222] text-white rounded-full">Add
                            to
                            cart</button>
                    </div>
                </div>

                <?php
            endforeach;
        endif;

        ?>
    </div>
</div>