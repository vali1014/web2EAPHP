<?php
class Helyszin {
    public $id;
    public $nev;
    public $megyeid;
    public $megyenev;

    public function __construct($id, $nev, $megyeid, $megyenev) {
        $this->id = $id;
        $this->nev = $nev;
        $this->megyeid = $megyeid;
        $this->megyenev = $megyenev;
    }
}

class Megye {
    public $id;
    public $nev;
    public $regio;

    public function __construct($id, $nev, $regio) {
        $this->id = $id;
        $this->nev = $nev;
        $this->regio = $regio;
    }
}
