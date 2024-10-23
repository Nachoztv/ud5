<?php
namespace Com\Daw2\Models;

class PobPontevModel{
    private $filename;

    /**
     * @param $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }
public function pobPontevedra(){
        $csv = file($this->filename);

        $data = [];
        foreach ($csv as $line) {
            $data[] = str_getcsv($line,';');
        }
        return $data;
}

}
