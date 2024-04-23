<div>
    <?php

    // use App\Boutique\Models\Products;
// use App\Boutique\Manager\BddManager;
    
    // $categoryName = $params["categoryName"];
// $pageURL = "999";
    
    // if ($categoryName === "cafe") {
//     $categoryName = '0';
//     $pageURL = 'café';
    
    // } elseif ($categoryName === "the") {
//     $categoryName = '1';
//     $pageURL = 'thé';
// }
    
    // $bddManager = new BddManager();
// $link = $bddManager->linkConnect();
    
    // $rankObject = new Products($bddManager);
// $rankObject->produitLeak($categoryName, $pageURL);
    
    $pageURL = "999";

    if ($categoryName === "cafe") {
        $pageURL = 'café';

    } elseif ($categoryName === "the") {
        $pageURL = 'thé';
    }

    if ($categoryName == "cafe") {
        $counterSubCat0 = "0";
        $nameSubCat0 = "Corsé";

        $counterSubCat1 = "1";
        $nameSubCat1 = "Moyen";

        $counterSubCat2 = "2";
        $nameSubCat2 = "Faible";
        $type = "Choisissez la force de votre ";

    } else if ($categoryName == "the") {
        $counterSubCat0 = "3";
        $nameSubCat0 = "Noir";

        $counterSubCat1 = "4";
        $nameSubCat1 = "Vert";

        $counterSubCat2 = "5";
        $nameSubCat2 = "Blanc";
        $type = "Choisissez votre feuille de ";
    }

    ?>

    <div class="mx-auto flex justify-start max-w-6x1">
        <h2 class="bg-gray-100 ml-10 p-2 rounded-xl">Meilleurs ventes de <?= $pageURL ?></h2>
    </div>

    <?php
    foreach ($mostSell as $sellMost):
        $imageData = json_decode($sellMost["images"], true);
        $sellMost["images"] = $imageData;
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
            <img id="<?= $sellMost['id_product'] ?>" class="article-image"
                src="http://<?= $serverName ?>/assets/images/<?= $sellMost['images']['main'] ?>"
                alt="<?= $sellMost["name"] ?>">
            <p id="<?= $sellMost['id_product'] ?>" class="mt-3 font-bold article-name"><?= $sellMost["name"] ?>"</p>
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
            <select name="counterSubCat" id="counterSubCat" onchange="checkSelection()">
                <option value="99">---</option>
                <option value="<?= $counterSubCat0 ?>"><?= $nameSubCat0 ?></option>
                <option value="<?= $counterSubCat1 ?>"><?= $nameSubCat1 ?></option>
                <option value="<?= $counterSubCat2 ?>"><?= $nameSubCat2 ?></option>
            </select>
            <select name="Filtre" id="prix" onchange="filterPrice()">
                <option value="default">---</option>
                <option value="asc">Ascendent</option>
                <option value="desc">Descendent</option>
            </select>
            <button id="submitSubCat" type="submit"
                class="w-48 mt-4 px-4 py-3 bg-[#333] hover:bg-[#222] text-white rounded-full">allons voir</button>
            <div id="text"></div>
        </form>

    </div>


    <div id="resultat">
        <?php

        if (isset($counterSubCat)):

            foreach ($subCat as $catSub):
                ?>

                <div class="mx-auto flex justify-start max-w-6x1">
                    <h2 class="bg-gray-100 ml-10 p-2 rounded-xl"><?= $catSub["description"] ?>"</h2>
                </div>

            <?php endforeach;

            foreach ($products as $product):
                $imageData = json_decode($product['images'], true);
                $product['images'] = $imageData;

                ?>

                <div class='bg-gray-100 w-60 h-80 inline-block relative text-center m-2.5 rounded-x1'>
                    <div
                        class='bg-grav-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='18px' class='fill-gray-800 inline-block'
                            viewBox='0 0 64 64'>
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
                    <img id="<?= $product['id_product'] ?>" class="article-image"
                        src="http://<?= $serverName ?>/assets/images/<?= $product['images']['main'] ?>"
                        alt="<?= $product["name"] ?>">
                    <p id="<?= $product['id_product'] ?>" class="mt-3 font-bold article-name"><?= $product["name"] ?></p>
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