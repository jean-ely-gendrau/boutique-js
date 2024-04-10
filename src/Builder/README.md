# FormBuilder

Cette class permet de générer des formulaire 

## List des méthodes

| Méthod | Arguments | Description |
| :---: | :---: | :--- |
| setClassForm | string $class_form | Pour définir la classe du formulaire. |
| setClassActionGroup | string $class_action_group | Pour spécifier la class du conteneur des boutons et les liens en bas du formulaire. |
| setMethod | string $method | Pour spécifier la méthode du formulaire GET\|POST |
| setAction | string $action | Si la valeur n'est pas définie pour la page de traitement du formulaire, les données seront redirigées vers la même page. |
| addElementAction | string $type, string $id, string $name, opt array $options | Si vous souhaitez ajouter des boutons ou des liens en bas du formulaire. |
| addField | string $type, string $id, string $name, string $label, opt array $options | Pour inclure des champs de formulaire, il est possible de choisir parmi les types de champs suivants : textarea, select, text, password, email, image, date, month, number, checkbox, range, reset, file. |


### Paramètres des méthodes

1. addField()

  -Les arguments pour les inputs/textarea/select

  | Options Arguments | Type | Description |
  | :---: | :---: | :--- |
  | class-label-group | string | Pour modifier l'apparence du conteneur contenant les éléments label et input. |
  | class-label | string | Pour modifier l'apparence du label |
  | class | string | Pour spécifier le style de l'input. |
  | disabled | string | Pour désactiver l'input. |
  | placeholder | string | Pour définir le placeholder |
  | attribute | array | pour définir toute sorte d'attibut |

  -Les arguments pour les textarea

  | Options Arguments | Type | Description |
  | :---: | :---: | :--- |
  | value-area | null | pour définir la texte contenu dans textarea |

  -Les arguments pour les select

  | Options Arguments | Type | Description |
  | :---: | :---: | :--- |
  | select-array-multi = true | bool |  si vous utiliser la balise select l'option select-array-multi = true permet de passé un array multidimensionnel à utilisé avec options-keys |
  | options-keys = ['keyValue'=>'value_match','keyText'=> 'text_match'] | array | pour definir le style de l'input |
  | options-selected | string | si une option dois être selectionner par défault |
  | options-select-array | array | Pour définir toutes sortes d'attributs. Vous trouverez tous les attributs dont vous avez besoin sûr : https://developer.mozilla.org/fr/docs/Web/HTML/Attributes.

Voici un exemple d'utilisation pour un champ de données dates, je souhaite rajouter un attribut value et un attribut min et max : ['attributes' => ['value' => 2024-04-10', 'min' => '2024-04-08', 'max' => '2024-04-14']] |

