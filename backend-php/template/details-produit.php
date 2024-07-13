<section id="<?= $detail->id ?>" class="produit bg-gray-50 dark:bg-gray-900">
  <div class="font-[sans-serif] flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
    <div class="flex justify-center w-full bg-white rounded-lg shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700 mx-2">
      <div class="p-6 lg:max-w-7xl max-w-2xl max-lg:mx-auto">
        <div class="grid items-start grid-cols-1 lg:grid-cols-5 gap-12">
          <!-- // Images du produit -->
          <div class="lg:col-span-3 bg-gray-100 w-full text-center h-full rounded-xl">
            <div class="lg:sticky top-20 p-8 ">
              <img src="<?= $src ?>" alt="detail" class="w-4/5 rounded object-cover" />
              <hr class="border-white dark:border-gray-900 border-2 my-6" />
              <div class="flex flex-wrap gap-x-12 gap-y-6 justify-center mx-auto">
                <img src="<?= $src ?>" alt="detail1" class="w-24 cursor-pointer" />
                <img src="<?= $src ?>" alt="detail2" class="w-24 cursor-pointer" />
                <img src=<?= $src ?> alt="detail3" class="w-24 cursor-pointer" />
                <img src=<?= $src ?> alt="detail4" class="w-24 cursor-pointer" />
              </div>
            </div>
          </div>
          <div class="lg:col-span-2">
            <!-- // Nom et prix -->
            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">
              <?= $detail->name ?>
            </h2>
            <div class="flex flex-wrap gap-4 mt-4">
              <p class="text-gray-900 dark:text-white text-xl font-bold">
                <?= $detail->price ?>€
              </p>
              <p class="text-gray-400 dark:text-white text-xl">
                <strike><?= $detail->price ?>€</strike><span class="text-sm ml-1">Taxe inclus</span>
              </p>
            </div>
            <!-- //Notation -->
            <div id="<?= $detail->average_rating ?>" class="rating flex space-x-2 mt-4">
              <svg id="score1" class="w-5 fill-[#CED5D8] dark:fill-gray-900" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
              </svg>
              <svg id="score2" class="w-5 fill-[#CED5D8] dark:fill-gray-900" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
              </svg>
              <svg id="score3" class="w-5 fill-[#CED5D8] dark:fill-gray-900" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
              </svg>
              <svg id="score4" class="w-5 fill-[#CED5D8] dark:fill-gray-900" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
              </svg>
              <svg id="score5" class="w-5 fill-[#CED5D8] dark:fill-gray-900" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
              </svg>
            </div>
            <!-- // Description -->
            <div class="mt-8">
              <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                A Propos de ce produit :
              </h3>
              <ul class="space-y-3 list-disc mt-4 pl-4 text-sm text-gray-900 dark:text-white">
                <li><?= $detail->description ?></li>
              </ul>
            </div>
            <!-- // Nombre de retour utilisateur -->
            <div class="mt-8 max-w-md">
              <h3 class="text-lg font-bold text-gray-900 dark:text-white">Notations(<?= count($detail->ratings) ?>)</h3>
              <div class="space-y-3 mt-4">
                <div class="flex items-center">
                  <p class="text-sm text-gray-900 dark:text-white font-bold">5.0</p>
                  <svg class="w-5 fill-gray-800 dark:fill-white ml-1" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                    <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                  </svg>
                  <div class="bg-gray-300 dark:bg-gray-700 rounded w-full h-2 ml-3">
                    <div class="w-2/3 h-full rounded bg-gray-800 dark:bg-white"></div>
                  </div>
                  <p class="text-sm text-gray-900 dark:text-white font-bold ml-3">66%</p>
                </div>
                <div class="flex items-center">
                  <p class="text-sm text-gray-900 dark:text-white font-bold">4.0</p>
                  <svg class="w-5 fill-gray-800 dark:fill-white ml-1" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                    <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                  </svg>
                  <div class="bg-gray-300 dark:bg-gray-700 rounded w-full h-2 ml-3">
                    <div class="w-1/3 h-full rounded bg-gray-800 dark:bg-white"></div>
                  </div>
                  <p class="text-sm text-gray-900 dark:text-white font-bold ml-3">33%</p>
                </div>
                <div class="flex items-center">
                  <p class="text-sm text-gray-900 dark:text-white font-bold">3.0</p>
                  <svg class="w-5 fill-gray-800 dark:fill-white ml-1" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                    <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                  </svg>
                  <div class="bg-gray-300 dark:bg-gray-700 rounded w-full h-2 ml-3">
                    <div class="w-1/6 h-full rounded bg-gray-800 dark:bg-white"></div>
                  </div>
                  <p class="text-sm text-gray-900 dark:text-white font-bold ml-3">16%</p>
                </div>
                <div class="flex items-center">
                  <p class="text-sm text-gray-900 dark:text-white font-bold">2.0</p>
                  <svg class="w-5 fill-gray-800 dark:fill-white ml-1" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                    <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                  </svg>
                  <div class="bg-gray-300 dark:bg-gray-700 rounded w-full h-2 ml-3">
                    <div class="w-1/12 h-full rounded bg-gray-800 dark:bg-white"></div>
                  </div>
                  <p class="text-sm text-gray-900 dark:text-white font-bold ml-3">8%</p>
                </div>
                <div class="flex items-center">
                  <p class="text-sm text-gray-900 dark:text-white font-bold">1.0</p>
                  <svg class="w-5 fill-gray-800 dark:fill-white ml-1" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                    <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                  </svg>
                  <div class="bg-gray-300 dark:bg-gray-700 rounded w-full h-2 ml-3">
                    <div class="w-[6%] h-full rounded bg-gray-800 dark:bg-white"></div>
                  </div>
                  <p class="text-sm text-gray-900 dark:text-white font-bold ml-3">6%</p>
                </div>
              </div>
              <!-- // Dernier retour utilisateur -->
              <div id="accordion-collapse" data-accordion="collapse" class="flex items-start flex-col mt-8 gap-5">
                <h2 id="accordion-collapse-head-comments" class="w-full">
                  <button type="button" class="flex items-center justify-between w-full p-5 mt-8 px-4 py-2 bg-transparent border-2 border-gray-800 dark:border-white text-gray-900 dark:text-white font-bold rounded" data-accordion-target="#accordion-collapse-comments" aria-expanded="false" aria-controls="accordion-collapse-comments">
                    <span class="text-center">Afficher tout les commentaires(<?= count($detail->comments) ?>)</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                    </svg>
                  </button>
                </h2>
                <div id="accordion-collapse-comments" class="hidden" aria-labelledby="accordion-collapse-head-comments">

                  <?php
                  if (count($detail->comments) > 0) :
                    foreach ($detail->comments as $keyComment =>  $comment) :
                  ?>
                      <div>
                        <img src="https://readymadeui.com/team-2.webp" class="w-12 h-12 rounded-full border-2 border-white dark:border-gray-900" />
                        <div class="ml-3">
                          <h4 class="text-sm font-bold"><?= $comment->full_name ?></h4>
                          <div class="flex space-x-1 mt-1">
                            <svg class="w-4 fill-gray-800 dark:fill-white" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                              <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                            </svg>
                            <svg class="w-4 fill-gray-800 dark:fill-white" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                              <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                            </svg>
                            <svg class="w-4 fill-gray-800 dark:fill-white" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                              <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                            </svg>
                            <svg class="w-4 fill-[#CED5D8] dark:fill-gray-900" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                              <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                            </svg>
                            <svg class="w-4 fill-[#CED5D8] dark:fill-gray-900" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                              <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                            </svg>
                            <p class="text-xs !ml-2 font-semibold">2 mins ago</p>
                          </div>
                          <p class="text-xs mt-4">
                            <?= $comment->comment ?>
                          </p>
                        </div>
                      </div>

                  <?php endforeach;
                  endif; ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>