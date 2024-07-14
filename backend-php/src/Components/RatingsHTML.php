<?php

namespace App\Boutique\Components;

class RatingsHTML
{

  /**
   * countRating
   *
   * @var int
   */
  private $countRating;

  /**
   * sumRating
   *
   * @var int
   */
  private $sumRating;

  /**
   * averageRating
   *
   * @var int
   */
  private $averageRating;

  /**
   * ratings
   *
   * @var object
   */
  private $ratings;

  public function __construct(array $ratings)
  {
    $arrayColRating = array_column((array) $ratings, 'rating'); // Extraction de la colonne 'rating' du tableau
    $this->countRating = count((array) $ratings); // Comptage du nombre de notes
    $this->sumRating = array_sum((array) $arrayColRating); // Somme de toutes les notes
    $this->averageRating = $this->sumRating / $this->countRating; // Calcul de la moyenne des notes

    // Initialise $this->ratings avec les notes de 1 à 5 initialisées à 0,
    // puis remplace par les valeurs réelles des notes présentes dans $arrayColRating.
    $this->ratings = array_replace_recursive(array_fill(1, 5, 0), array_count_values($arrayColRating));
  }

  public function render()
  {

    $heredocRating = $this->generateProgressionBars();

    return <<<HTML
      <div class="mt-8 max-w-md">
          <h3 class="text-lg font-bold text-gray-900 dark:text-white">Notations({$this->countRating})</h3>
          <div class="space-y-3 mt-4">
            {$heredocRating}
          </div>
      </div>
    HTML;
  }

  /**
   * Method generateProgressionBars
   * 
   * Cette méthode génère l'intégralité des barres de progression pour chaque note.
   * 
   * @return string Le HTML génèré des barres de notation
   */
  private function generateProgressionBars(): string
  {
    $string = ""; // Chaîne de sortie

    // Parcourt le tableau $this->ratings selon le nombre d'occurrences
    foreach ($this->ratings as $ratingNumber => $numberRating) {
      // Concatène le résultat de ratingSum à la chaîne de sortie
      $string .= $this->generateProgressionBar($ratingNumber, $numberRating);
    }

    return $string; // Chaîne concaténée
  }

  /**
   * Method generateProgressionBar
   *
   * @param int $ratingNumber [L'indice de la note en cours de génération (1, 2, 3, 4 ou 5).]
   * @param int $numberRating [Le nombre total de votes pour la note en cours de génération.]
   *
   * @return string
   */
  private function generateProgressionBar(int $ratingNumber, int $numberRating): string
  {
    $percentRating = ($numberRating / $this->countRating) * 100; // Calcul de la moyenne de chaque barre

    $cssRating = "w-[{$percentRating}%]"; // Class CSS dynamique qui contrôle la taille de la barre de progression

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
