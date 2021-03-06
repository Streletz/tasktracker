<?php
namespace app\components;

use Yii;
use yii\base\Component;

/**
* Собственные средства отладки.
*
* @author Streletz
*
*/
class DebugUtils extends Component
{
	public function __construct()
	{
	}
	
	/**
	* Вывод отладочной информации посредством var_dump в читабельном виде.
	* 
	* @param {object} $data Данные, которые надо вывести.
	* 
	* @return
	*/
	public function printDebug($data){
		echo '<pre>';
		var_dump($data);
		echo '</pre>';
	}
}
?>