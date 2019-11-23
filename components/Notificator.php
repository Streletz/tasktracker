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
        Yii::$app->mailer->compose()
        ->setTo($to)
        ->setFrom(['makartsev.e@yandex.ru' => Yii::$app->name])
        ->setSubject($subject)
        ->setTextBody($body)
        ->send();
    }
}

