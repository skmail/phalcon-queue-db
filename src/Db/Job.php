<?php namespace Phalcon\Queue\Db;

use Phalcon\Queue\Db;
use Phalcon\Queue\Db\Model as JobModel;

/**
 * Job from the DB backend
 */
class Job extends \Phalcon\Queue\Beanstalk\Job
{
    /** @var JobModel */
    protected $model;

    /**
     * Used internally, for testing.
     * Not public to comply with the original Job class signature
     * @var string
     */
    protected $tube = 'default';

    public function __construct(Db $queue, $id, $body, $model = null)
    {
        parent::__construct($queue, $id, $body);
        if ($model instanceof JobModel) {
            $this->model = $model;
        }
    }

    public function __get($prop) {
        $getter = 'get'.ucfirst($prop);
        if (method_exists($this, $getter)) {
            return $this->$getter();
        } else {
            throw new \BadMethodCallException()
        }
    }

    public static function fromModel(Db $queue, JobModel $model)
    {
        return new static($queue, $model->id, $model->body, $model);
    }

    public function getModel()
    {
        if ($this->model instanceof JobModel) {
            return $this->model;
        } else {
            return $this->model = JobModel::find($this->getId());
        }
    }

    public function getId()
    {
        parent::getId(); // TODO: Change the autogenerated stub
    }

    public function getBody()
    {
        parent::getBody(); // TODO: Change the autogenerated stub
    }

    public function delete()
    {
        parent::delete(); // TODO: Change the autogenerated stub
    }

    public function release($priority = 100, $delay = 0)
    {
        parent::release($priority, $delay); // TODO: Change the autogenerated stub
    }

    public function bury($priority = 100)
    {
        parent::bury($priority); // TODO: Change the autogenerated stub
    }

    public function touch()
    {
        parent::touch(); // TODO: Change the autogenerated stub
    }

    public function kick()
    {
        parent::kick(); // TODO: Change the autogenerated stub
    }

    public function stats()
    {
        parent::stats(); // TODO: Change the autogenerated stub
    }

    public function __wakeup()
    {
        parent::__wakeup(); // TODO: Change the autogenerated stub
    }
}
