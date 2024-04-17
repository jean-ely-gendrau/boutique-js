<section>
  <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

    <div class="bg-gray-800 pt-3">
      <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
        <h1 class="font-bold pl-2">Analytics</h1>
      </div>
    </div>

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