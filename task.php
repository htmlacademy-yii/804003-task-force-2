<?php

class Task
{
    private const STATUS_NEW = 'status_new';
    private const STATUS_CANCELED = 'status_canceled';
    private const STATUS_INWORK = 'status_inwork';
    private const STATUS_DONE = 'status_done';
    private const STATUS_FAILED = 'status_failed';

    private const ACTION_CANCEL = 'action_cancel';
    private const ACTION_RESPOND = 'action_respond';
    private const ACTION_PERFORMED = 'action_performed';
    private const ACTION_REFUSE = 'action_refuse';

    private $idApplicant;
    private $idEmployer;
    private $status;

    // массив из доступных статусов
    private $avaliabeStatuses = 
    [
        self::STATUS_NEW => 'Новое',
        self::STATUS_CANCELED => 'Отменено',
        self::STATUS_INWORK => 'В работе',
        self::STATUS_DONE => 'Выполнено',
        self::STATUS_FAILED => 'Провалено'
    ];

    // массив из доступных действий
    private $avaliabeActions =
    [
        self::ACTION_CANCEL => 'Отменить',
        self::ACTION_RESPOND => 'Откликнуться',
        self::ACTION_PERFORMED => 'Выполнено',
        self::ACTION_REFUSE => 'Отказаться'
    ];

    // массив, где ключ - выполняемое действие, значение - статус, в котороый перейдет задания после выполнения действия
    private $statusAfterAction =
    [
        self::ACTION_CANCEL => self::STATUS_CANCELED,
        self::ACTION_RESPOND => self::STATUS_INWORK,
        self::ACTION_PERFORMED => self::STATUS_DONE,
        self::ACTION_REFUSE => self::STATUS_FAILED
    ];

    // массив, где ключ - возможный статус, значение - массив действий при данном статусе
    private $actionDependentStatus =
    [
        self::STATUS_NEW => [self::ACTION_CANCEL, self::ACTION_RESPOND],
        self::STATUS_INWORK => [self::ACTION_PERFORMED, self::ACTION_REFUSE]
    ];

    // конструктор класса, принимает id заказчика и исполнителя, создает задание, присваивает статус Новое
    public function __construct(int $idEmployer, int $idApplicant, string $status = self::STATUS_NEW)
    {
        $this->idApplicant = $idApplicant;
        $this->idEmployer = $idEmployer;
        $this->status = $status;
    }

    // метод getStatus определяет текущий статус задания
    public function getStatus()
    {
        return $this->status;
    }

    //метод getAvailableAction определяет список из всех возможных действий
    public function getAvailableActions() 
    {
        return $this->avaliabeActions;
    }

    //метод возвращает список доступных действий в текущем статусе;
    public function getAvailableStatuses() 
    {
        $actions = $this->actionDependentStatus[$this->status];
        for ($i=0; $i < count($actions); $i++) {
            echo $this->avaliabeActions[$actions[$i]];
        }
    }
    
    //метод getAllStatuses определяет список из всех возможных статусов
    public function getAllStatuses() 
    {
        return $this->avaliabeStatuses;
    }

    //метод возвращает имя статуса, в который перейдёт задание после выполнения конкретного действия;
    public function getNextStatus(string $action) 
    {
        return $this->avaliabeStatuses[$this->statusAfterAction[$action]];
    }
}