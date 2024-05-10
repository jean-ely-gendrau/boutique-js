<section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
  <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Statistique générale</h2>


    <div class="flex flex-wrap">
      <?php foreach ($panelAdmin as $panelArray) : ?>
        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
          <!--Metric Card-->
          <div class="bg-gradient-to-b from-<?= $panelArray['color'] ?>-200 to-<?= $panelArray['color'] ?>-100 border-b-4 border-<?= $panelArray['color'] ?>-600 rounded-lg shadow-xl p-5">
            <div class="flex flex-row items-center">
              <div class="flex-shrink pr-4">
                <div class="rounded-full p-5 bg-<?= $panelArray['color'] ?>-600"><i class="<?= $panelArray['icon-block'] ?> fa-2x fa-inverse"></i></div>
              </div>
              <div class="flex-1 text-right md:text-center">
                <h2 class="font-bold uppercase text-gray-600"><?= $panelArray['title'] ?></h2>
                <p class="font-bold text-3xl"><?= $panelArray['value'] ?><?= isset($panelArray['isMove']) ? '<span class="text-' . $panelArray['color'] . '-500"><i class="' . $panelArray['isMove'] . '"></i></span>' : '' ?></p>
              </div>
            </div>
          </div>
          <!--/Metric Card-->
        </div>
      <?php endforeach; ?>
    </div>


    <div class="flex flex-row flex-wrap flex-grow mt-2">




    </div>
  </div>
</section>