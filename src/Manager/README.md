# README SECTION MANAGER

## BddManager

Avant toutes connexions à la base de données vérifier le fichier '/config/config.json' à la racine du projet;
que toutes les informations de connexion sont exactes.

## Instancier une connexion à la base de données

> [!TIP]
> Dans la plupart des cas référait vous à la partie CrudManager qui étend les méthodes de BddManager.

Si l'implémentation de la class CrudManager ne répond pas à votre demande procéder ainsi.

```php
// Instance de la class BddManager
$connexion = new BddManager();

// Utilise la méthode linkConnect (connexion à la bdd),
// on enchaine avec la méthode prepare qui fait partie des méthodes de l'objet PDO
$req = $connexion
          ->linkConnect()
          ->prepare(
            'SELECT * FROM NOM_DE_TABLE'
            );

// Exécution de la requête, 'execute return bool', on peut donc vérifier si c'est Vrai avant fetchAll()
$result =['aucun résultat'];

if($req->execute($search)){
  $result = $req->fetchAll();
}
```
### Détail des méthods de la class

1. __construct()

Cette méthode prend un paramètre qui peut être omis, le paramètre config devra être un objet json de ce type
```json
{
      "dsn": "mysql",
      "bdd": "nom-de-bdd",
      "host": "localhost",
      "username": "root",
      "password": "",
      "port": "3306",
      "charset": "utf8mb4"
}
```

> [!IMPORTANT]
> $config = null est un paramètre optionnel, à utiliser si on souhaite, se connecter à une autre base de données. 
> En lui transmettant les paramètres de connexion

```php
  public function __construct($config = null)
  {
    if (empty($config)):
      // Si la config est null on charge le fichier à partir du dossier config
      $configs = json_decode(
        file_get_contents(
          __DIR__ . DIRECTORY_SEPARATOR . '../../config/config.json',
        ),
      );
      $config = $configs->database->pdo;
    endif;

    $this->dsn = "{$config->dsn}:dbname={$config->bdd};host={$config->host};port={$config->port}";
    $this->username = $config->username;
    $this->password = $config->password;
    $this->connect();
  }
```

2. linkConnect()

- Cette méthode retourne une instance de la class de connexion PDO
- Cela permet d'exécuter de communiquer à la base de données
- Afin de faire des requêtes SELECT/INSERT/UPDATE/DELETE

```php
 public function linkConnect()
  {
        return $this->link;
  }
```

3. connect()

Cette méthode instancie l'objet PHP PDO avec les propriétés définies par notre objet BddManager

```php
  private function connect()
  {
      $this->link = new \PDO($this->dsn, $this->username, $this->password);
  }
```

## CrudManager

1. __construct()

Cette méthode prend 2 paramètres obligatoires et un optionnel

- string $tableName   (nom de la table)
- string $objectClass (objet du modèle de données a utilisé)
- $configDatabase = null (optionnel pour une connexion externe)

```php
    public function __construct(
        string $tableName,
        string $objectClass,
        $configDatabase = null,
    ) {
        parent::__construct($configDatabase);
        $this->_tableName = $tableName;
        $this->_objectClass = $objectClass;
        $this->_dbConnect = $this->linkConnect();
    }
```
2. getConnectBdd()

Cette méthode peut-être appeler pour retourner un objet de connexion PDO afin de crée de nouvelle requêtes personnaliser à la base de données auquel la class CrudManager ne peut répondre.

```php
    public function getConnectBdd(): object
    {
        return $this->_dbConnect;
    }
```

3. getByLike()

La méthode getByLike est juste un exemple. Si le commentaire est rouge, c'est simplement dû à un addon ou la configuration de l'IDE (vs code)

```php
public function getByLike(mixed $search, string $columnLike): array
    {

    }
```

4. getById()

Cette méthode prend un paramètre obligatoire, elle permet d'aller chercher un élément dans la base de données selon l'id.

* paramètres 
    - string id

> [!WARNING]
> Cette méthode est à modifier pour réponde à l'implémentation du NATURAL JOIN 

Il faudra certainement modifier les paramètres transmis pour s'adapter ce que l'on souhaite 
chercher dans la base de données, id_user,id_product,id_order,id_catagory
peu être que l'on pourrait ajouter un switch à l'intérieur avec une valeur transmise en paramètre pour faire le choix.

```php
    public function getById(string $id): object
```

5. getAll()

Cette méthode prend un paramètre optionnel, elle permet de récupérer tous les résultats de la table instancié par le constructeur.

* paramètres :
    - ?array $select = null

> [!TIP]
> Exemple pour sélectionner que le nom est la description da la table category.
> On passe un tableau en paramètres ['name','description']
> Juste le nom : ['name']

```php
 public function getAll(?array $select = null): array
```

6. getByEmail()

Cette méthode prend un paramètre obligatoire, elle permet de retourner les résultats par rapport au mail de l'utilisateur.

* paramètres :
    - string $email (email de l'utilisateur)

```php
 public function getByEmail(string $email): object
```

7. create()

Cette méthode prend deux paramètres obligatoires, elle permet de créer un enregistrement sur la table initialisé par le constructeur.

* paramètres :
    - object $objectClass (class modèles de données instanciées avec les données à enregistrer)
    - array $param (paramètre de la class modèle à enregistrer dans la bdd exemple ['name','description','price','quantity','images'])

```php
  public function create(object $objectClass, array $param): void
```

7. update()

Cette méthode prend deux paramètres obligatoires, elle permet de modifier un enregistrement sur la table initialisé par le constructeur.

* paramètres :
    - object $objectClass (class modèles de données instanciées avec les données à mettre à jour)
    - array $param (paramètre de la class modèle à enregistrer 
      dans la bdd exemple avec id_product obligatoire pour la mise à jour
      ['id_product','name','description','price','quantity','images'])

> [!WARNING]
> Cette méthode est à modifier pour réponde à l'implémentation du NATURAL JOIN 

Il faudra certainement modifier les paramètres transmis pour s'adapter ce que l'on souhaite 
mettre à jour dans la base de données, id_user,id_product,id_order,id_catagory
peu être que l'on pourrait ajouter un switch à l'intérieur avec une valeur transmise en paramètre pour faire le choix.

```php
  public function update(object $objectClass, array $param): void
```

7. delete()

Cette méthode prend deux paramètres obligatoires, elle permet de supprimer un enregistrement sur la table initialisé par le constructeur.

* paramètres :
    - object $objectClass (class modèles de données instanciées avec l'id seulement des données à supprimer)
    - array $param (paramètre de la class modèle à enregistrer 
      dans la bdd exemple avec id_product obligatoir pour la suppression
      ['id_product'])

> [!WARNING]
> Cette méthode est à modifier pour réponde à l'implémentation du NATURAL JOIN 

Il faudra certainement modifier les paramètres transmis pour s'adapter ce que l'on souhaite 
supprimer dans la base de données, id_user,id_product,id_order,id_catagory
peu être que l'on pourrait ajouter un switch à l'intérieur avec une valeur transmise en paramètre pour faire le choix.

```php
  public function update(object $objectClass, array $param): void
```