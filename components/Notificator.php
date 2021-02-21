<?php
namespace app\components;

use Yii;
use yii\base\Component;

/**
 * Уведомления на почту.
 *
 * @author Streletz
 *        
 */
class Notificator extends Component
{

    public function __construct()
    {}

    /**
     * Отправка уведомления на почту.
     *
     * @param string $to
     *            Email получателя.
     * @param string $subject
     *            Тема письма.
     * @param string $body
     *            Текст письма.
     */
    public function email($to, $subject, $body)
    {
		try {
			Yii::$app->mailer->compose()
			->setTo($to)
			->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
			->setSubject($subject)
			->setTextBody($body)
			->send();
		} catch (Exception $ex){
			Yii::error($ex->message ,__METHOD__);
		}
    }
}

