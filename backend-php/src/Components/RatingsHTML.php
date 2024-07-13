<?php

namespace App\Boutique\Components;

class RatingsHTML
{

  public static function templateRating($detail = null)
  {

    if ($detail === null) return null;

    $countRating = count($detail);

    $heredocRating = self::forRating(array_count_values(array_column((array) $detail, 'rating')));

    return <<<HTML
      <div class="mt-8 max-w-md">
          <h3 class="text-lg font-bold text-gray-900 dark:text-white">Notations({$countRating})</h3>
          <div class="space-y-3 mt-4">
            {$heredocRating}
          </div>
      </div>
    HTML;
  }

  private static function forRating($detail): string
  {
    $heredocOut = "";
    $rating = array_replace_recursive(array_fill(1, 5, 0), $detail);

    foreach ($rating as $ratingNumber => $countRating) {
      $heredocOut .= self::ratingSum($ratingNumber, $countRating);
    }

    return $heredocOut;
  }

  private static function ratingSum(int $ratingNumber, int $countRating): string
  {
    $percentRating = ($countRating / 5) * 100;

    $cssRating = "w-[{$percentRating}%]";
    return
      <<<HTML
      <div class="flex items-center">
        <p class="text-sm text-gray-900 dark:text-white font-bold">{$ratingNumber}.0</p>
        <svg class="w-5 fill-gray-800 dark:fill-white ml-1" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
          <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
        </svg>
        <div class="bg-gray-300 dark:bg-gray-700 rounded w-full h-2 ml-3">
          <div class="h-full rounded bg-gray-800 dark:bg-white {$cssRating}"></div>
        </div>
        <p class="text-sm text-gray-900 dark:text-white font-bold ml-3">{$percentRating}%</p>
      </div>
    HTML;
  }
}
