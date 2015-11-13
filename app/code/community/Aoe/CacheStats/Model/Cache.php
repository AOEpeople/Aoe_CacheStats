<?php

class Aoe_CacheStats_Model_Cache extends Mage_Core_Model_Cache
{
    CONST TYPE_LOAD_HIT = 'h';
    CONST TYPE_LOAD_MISS = 'm';
    CONST TYPE_SAVE = 's';
    CONST TYPE_REMOVE = 'r';
    CONST TYPE_FLUSH = 'f';
    CONST TYPE_CLEAN = 'c';

    protected $log = '';

    protected $pid;

    protected function getPid()
    {
        if (is_null($this->pid)) {
            $this->pid = getmypid();
        }
        return $this->pid;
    }

    public function load($id)
    {
        $start = microtime(true) * 1000;
        $res = parent::load($id);
        $this->appendLog(
            ($res === false) ? self::TYPE_LOAD_MISS : self::TYPE_LOAD_HIT,
            $id,
            round(microtime(true) * 1000 - $start)
        );
        return $res;
    }

    public function save($data, $id, $tags = array(), $lifeTime = null)
    {
        $start = microtime(true) * 1000;
        $res = parent::save($data, $id, $tags, $lifeTime);
        $this->appendLog(
            self::TYPE_SAVE,
            $id,
            round(microtime(true) * 1000 - $start)
        );
        return $res;
    }

    public function remove($id)
    {
        $start = microtime(true) * 1000;
        $res = parent::remove($id);
        $this->appendLog(
            self::TYPE_REMOVE,
            $id,
            round(microtime(true) * 1000 - $start)
        );
        return $res;
    }

    public function flush()
    {
        $start = microtime(true) * 1000;
        $res = parent::flush();
        $this->appendLog(
            self::TYPE_FLUSH,
            '',
            round(microtime(true) * 1000 - $start)
        );
        return $res;
    }

    public function clean($tags=array())
    {
        $start = microtime(true) * 1000;
        $res = parent::clean($tags);
        $this->appendLog(
            self::TYPE_CLEAN,
            implode(';',$tags),
            round(microtime(true) * 1000 - $start)
        );
        return $res;
    }


    protected function appendLog($type, $id, $duration)
    {
        $this->log .= sprintf("%s,%s,%s,%s,%s\n",
            date(DATE_ISO8601),
            $this->getPid(),
            $type,
            $id,
            $duration
        );
    }

    public function __destruct()
    {
        if ($this->log) {
            file_put_contents(Mage::getBaseDir('var') . '/log/aoe_cachestats.log', $this->log, FILE_APPEND);
            $this->log = '';
        }
    }

}