# FormBuilder

Cette class permet de générer des formulaire 

## List des méthodes

| Méthod | Arguments | Description |
| :---: | :---: | :--- |
| setClassForm | string $class_form | pour définir la class du formulaire |
| setClassActionGroup | string $class_action_group | pour définir la class du container des boutton et link au bas du formulaire |
| setMethod | string $method | pour definir la méthode du formulaire GET\|POST |
| setAction | string $action | pour définir la page de traitement du formulaire, si la valeur n'est pas définie les données seront traîter sur la même page |
| addElementAction | string $type, string $id, string $name, opt array $options | pour ajouter des boutton ou des liens en bes de formulaire |
| addField | string $type, string $id, string $name, string $label, opt array $options | pour ajouter des champs de formulaire, les type de champs prise en charge :   textarea,select,text,password,email,image,date,month,number,radio,checkbox,range,reset |
| addElementAction |  | pour ajouter des boutton ou des liens en bes de formulaire |

### Paramètres des méthodes

1. addField()

  -Les arguments pour les inputs/textarea/select

  | Options Arguments | Type | Description |
  | :---: | :---: | :--- |
  | class-label-group | string | pour changer le style du container label input |
  | class-label | string | pour changer le style du label |
  | class | string | pour definir le style de l'input |
  | disabled | string | pour desactiver l'input |
  | placeholder | string | pour définir le placeholder |
  | attribute | array | pour définir toute sorte d'attibut |

  -Les arguments pour les textarea

  | Options Arguments | Type | Description |
  | value-area | null | pour définir la texte contenu dans textarea |

  -Les arguments pour les select

  | Options Arguments | Type | Description |
  | select-array-multi = true | bool |  si vous utiliser la balise select l'option select-array-multi = true permet de passé un array multidimensionnel à utilisé avec options-keys |
  | options-keys = ['keyValue'=>'value_match','keyText'=> 'text_match'] | array | pour definir le style de l'input |
  | options-selected | string | si une option dois être selectionner par défault |
  | options-select-array | array | Passé le tableau pour créer les options du select |

