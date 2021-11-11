<?php

class Task
{
    public const STATUS_NEW = 'status_new';
    public const STATUS_CANCELED = 'status_canceled';
    public const STATUS_INWORK = 'status_inwork';
    public const STATUS_DONE = 'status_done';
    public const STATUS_FAILED = 'status_failed';

    public const ACTION_CANCEL = 'action_cancel';
    public const ACTION_RESPOND = 'action_respond';
    public const ACTION_PERFORMED = 'action_performed';
    public const ACTION_REFUSE = 'action_refuse';

    public $idApplicant;
    public $idEmployer;
    public $status;

    // массив из доступных статусов
    public $avaliabeStatus = 
    [
        self::STATUS_NEW => 'Новое',
        self::STATUS_CANCELED => 'Отменено',
        self::STATUS_INWORK => 'В работе',
        self::STATUS_DONE => 'Выполнено',
        self::STATUS_FAILED => 'Провалено'
    ];

    // массив из доступных действий
    public $avaliabeActions =
    [
        self::ACTION_CANCEL => 'Отменить',
        self::ACTION_RESPOND => 'Откликнуться',
        self::ACTION_PERFORMED => 'Выполнено',
        self::ACTION_REFUSE => 'Отказаться'
    ];

    // массив, где ключ - выполняемое действие, значение - статус, в котороый перейдет задания после выполнения действия
    public $statusAfterAction =
    [
        self::ACTION_CANCEL => self::STATUS_CANCELED,
        self::ACTION_RESPOND => self::STATUS_INWORK,
        self::ACTION_PERFORMED => self::STATUS_DONE,
        self::ACTION_REFUSE => self::STATUS_FAILED
    ];

    // массив, где ключ - возможный статус, значение - массив действий при данном статусе
    public $actionDependentStatus =
    [
        self::STATUS_NEW => [self::ACTION_CANCEL, self::ACTION_RESPOND],
        self::STATUS_INWORK => [self::ACTION_PERFORMED, self::ACTION_REFUSE]
    ];

    // конструктор класса, принимает id заказчика и исполнителя, создает задание, присваивает статус Новое
    public function __construct($idEmployer, $idApplicant)
    {
        $this->idApplicant = $idApplicant;
        $this->idEmployer = $idEmployer;
        $this->status = self::STATUS_NEW;
    }
    // метод getStatus определяет текущий статус задания
    public function getStatus()
    {
        return $this->status;
    }

    //метод getAvailableAction определяет список из всех возможных действий
    public function getAvailableActions() {
        foreach ($this->avaliabeActions as $k => $actions) {
            echo $actions;
        }
    }

    //метод возвращает список доступных действий в текущем статусе;
    public function getAvailableStatus() {
        $actions = $this->actionDependentStatus[$this->status];
        for ($i=0; $i < count($actions); $i++) {
            echo $this->avaliabeActions[$actions[$i]];
        }
    }
    
    //метод getAvailableStatus определяет список из всех возможных статусов
    public function getAvailableStatuses() {
        foreach ($this->avaliabeStatus as $k => $status) {
            echo $status;
        }
    }

    //метод возвращает имя статуса, в который перейдёт задание после выполнения конкретного действия;
    public function getNextStatus(string $action) {
        return $this->avaliabeStatus[$this->statusAfterAction[$action]];
    }
}

$task = new Task(25, 44);
echo "все доступные статусы: ";
$task->getAvailableStatuses();
echo "<br>";

echo "все доступные действия: ";
$task->getAvailableActions();
echo "<br>";

echo "статус, в который перейдёт задание после выполнения конкретного действия: ";
print_r($task->getNextStatus('action_performed'));
echo "<br>";

echo "список доступных действий в текущем статусе :";
$task->getAvailableStatus();
echo "<br>";