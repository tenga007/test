<?php

namespace app\modules\notifier\models\db;

use app\modules\notifier\models\CanNotCreateIntegratorException;
use app\modules\notifier\models\IntegratorInterface;
use app\modules\notifier\models\SmsIntegratorFactory;
use app\modules\notifier\models\TelegramIntegratorFactory;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "notifier".
 *
 * @property int $id
 * @property int $integrator
 * @property int $status
 * @property string $text
 * @property string|null $created_at
 * @property string|null $sended_at
 */
class Notifications extends \yii\db\ActiveRecord
{
    const STATUS_WAIT = 0;
    const STATUS_SENDED = 1;
    const STATUS_ERROR = -1;

    public const INTEGRATOR_SMS = 0;
    public const INTEGRATOR_TELEGRAM = 1;

    private $_integrator;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => 'sended_at',
                'value' => new Expression('NOW()'),
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['integrator', 'text'], 'required'],
            [['integrator', 'status'], 'integer'],
            [['integrator'], 'in', 'range' => [self::INTEGRATOR_SMS, self::INTEGRATOR_TELEGRAM]],
            [['status'], 'in', 'range' => [self::STATUS_WAIT, self::STATUS_SENDED, self::STATUS_ERROR]],
            [['created_at', 'sended_at'], 'safe'],
            [['text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'integrator' => 'Integrator',
            'status' => 'Status',
            'text' => 'Text',
            'created_at' => 'Created At',
            'sended_at' => 'Sended At',
        ];
    }

    public static function getIntegrators(): array
    {
        return [
            self::INTEGRATOR_SMS => 'Sms',
            self::INTEGRATOR_TELEGRAM => 'Telegram',
        ];
    }

    public static function getStatuses(): array
    {
        return [
            self::STATUS_ERROR => 'error',
            self::STATUS_WAIT => 'wait',
            self::STATUS_SENDED => 'sended',
        ];
    }

    /**
     * @throws CanNotCreateIntegratorException
     */
    public function getIntegrator(): IntegratorInterface
    {
        if (!$this->_integrator) {
            switch ($this->integrator) {
                case self::INTEGRATOR_SMS:
                    $integrator = new SmsIntegratorFactory();
                    break;
                case self::INTEGRATOR_TELEGRAM:
                    $integrator = new TelegramIntegratorFactory();
                    break;
                default:
                    throw new CanNotCreateIntegratorException('Can\'t create integrator');
            }
            $this->_integrator = $integrator->createIntegrator();
        }
        return $this->_integrator;
    }

    public function sendNotification(): bool
    {
        try {
            $result = $this->getIntegrator()->send($this->text);
        } catch (CanNotCreateIntegratorException $e) {
            $result = false;
        }

        $this->updateAttributes(['status' => $result ? self::STATUS_SENDED : self::STATUS_ERROR]);
        return $result;
    }
}
