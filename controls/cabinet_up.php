<?php 
class CUpAction {
	public $id;
	public $title;
	public function __construct() {
		//получить id  ипроверить, есть ли право поднимать это объявлени
		//если есть поднять если нет вывести сообщение об ошибке
		$this->id = $id = @$_GET["edit_id"];
		$phone = @$_SESSION["phone"];
		if ($id && $phone) {
			$row = dbrow("SELECT id, title FROM main WHERE id = {$id} AND phone = '{$phone}'");
			$id = (int)@$row["id"];
			$this->title = @$row["title"];
			if (!$id) {
				$_SESSION["ok_msg"] = "У вас нет прав на действие с этим объявлением";
				utils_302("/cabinet?status=1"); 
			}
			if (a($_SESSION, "ccode") && a($_POST, "cp") === @$_SESSION["ccode"]) {
				$cmd = "SELECT max(delta) + 2 FROM main";
				$d = dbvalue($cmd);
				query("UPDATE main SET delta = {$d} WHERE id = $id", $nR, $aR);
				if ($aR) {
					$_SESSION["ok_msg"] = "Ваше объявление поднято в результатах поиска";
					$date = date('Y-m-d');
					query("INSERT INTO stat_up (_date, _count) VALUES ('{$date}', 1) ON DUPLICATE KEY UPDATE _count = _count + 1");
					utils_302("/cabinet?status=0"); //Все ок
				} else {
					$_SESSION["ok_msg"] = "Не удалось поднять объявление в результатах поиска. Попробуйте позже";
					utils_302("/cabinet?status=2"); //Не удалось поднять сообщение
				}
			}
		}
	}
}

$upform = new CUpAction();
