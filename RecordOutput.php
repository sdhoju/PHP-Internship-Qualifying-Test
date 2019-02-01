<?php 

class RecordOutput{

    protected $records = array();
    
    protected $format;
    public function format()
    {
        echo $this->format->start();
        foreach ($this->records as $record) {
        echo     $this->format->formatRecord($record);
        }
        echo $this->format->finish();
    }
    public function setRecords(array $records)
    {
        $this->records = $records;
    }
    public function setFormat(FormatInterface $format)
    {
        $this->format = $format;
    }
}


interface FormatInterface
{
    public function start();

    public function formatRecord($record);

    public function finish();
}
