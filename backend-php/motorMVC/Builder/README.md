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

  - Les arguments spécifiques aux balises inputs/textarea/select

  | Options Arguments | Type | Description |
  | :---: | :---: | :--- |
  | class-label-group | string | Pour modifier l'apparence du conteneur contenant les éléments label et input. Exp: ['class-label-group' => 'ma-class ma-class2 ma-class3']|
  | class-label | string | Pour modifier l'apparence du label. Exp: ['class-label' => 'ma-class ma-class2 ma-class3']|
  | class | string | Pour spécifier le style de l'input. Exp: ['class' => 'ma-class ma-class2 ma-class3'] |
  | disabled | string | Pour désactiver l'input. Exp: ['disabled' => 1] |
  | placeholder | string | Pour définir le placeholder. Exp: ['placeholder' => 'mon place holder' ] |
  | attributes | array | Pour définir toutes sortes d'attributs. Vous trouverez tous les attributs dont vous avez besoin sûr : https://developer.mozilla.org/fr/docs/Web/HTML/Attributes. Voici un exemple d'utilisation pour un champ de données dates, je souhaite rajouter un attribut value et un attribut min et max. Exp: ['attributes' => ['value' => 2024-04-10', 'min' => '2024-04-08', 'max' => '2024-04-14']]  |

  - Les arguments spécifiques aux balises textarea

  | Options Arguments | Type | Description |
  | :---: | :---: | :--- |
  | value-area | null | pour définir la texte contenu dans textarea |

  - Les arguments spécifiques aux balises select

  | Options Arguments | Type | Description |
  | :---: | :---: | :--- |
  | select-array-multi = true | bool |  si vous utiliser la balise select l'option select-array-multi = true permet de passé un array multidimensionnel à utilisé avec options-keys |
  | options-keys = ['keyValue'=>'value_match','keyText'=> 'text_match'] | array | pour definir le style de l'input |
  | options-selected | string | Dans le cas où une option doit être sélectionnée par défaut. |
  | options-select-array | array | Passé le tableau pour créer les options du Select. Tout type de tableau peut être passé : sous forme de liste, associatif et multidimensionnel. Ajouter simplement le paramètre nécessaire selon le type de tableau. |

