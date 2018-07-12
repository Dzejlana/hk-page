<?php
class PersistenceManager{
  private $pdo;
  public function __construct(){
  $host = '127.0.0.1';
$db   = 'shopbaza';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$this->pdo = new PDO($dsn, $user, $pass, $opt);
}

public function add_items ($tabletable) {
  $stnt=$this->pdo->prepare("INSERT INTO tabletable(name, description, price) VALUES(:name, :description, :price)");
  $stnt->execute(["name" => $tabletable["name"], "description" => $tabletable["description"], "price" => $tabletable["price"]
]);


}

/* Update an existing item with new data (takes item as a parameter) */
	public function update_item($tabletable) {
		$stmt = $this->pdo->prepare("UPDATE tabletable_items SET name=:name,description = :desc, price = :price WHERE id = :id");
		$stmt->execute(array(
			"name" => $tabletable["name"],
			"description" => $tabletable["description"],
			"price" => $ite$tabletablem["price"]
		));
		/* rowCount() returns the number of rows affected by the last query; if it is 0, it means there was nothing to update */
		$count = $stmt->rowCount();
		/* return either the edited item or NULL, depending on rowCount() */
		if ($count > 0)
			return $tabletable;
		else
			return NULL;
	}
}

 ?>
