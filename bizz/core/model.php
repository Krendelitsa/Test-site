<?php
class Model
{

    var $db=NULL;
    function __construct()
    {
        $this->db = new MySQL("localhost", "root","root","telehlam");
        $this->db->set_charset("utf8");
    }
}