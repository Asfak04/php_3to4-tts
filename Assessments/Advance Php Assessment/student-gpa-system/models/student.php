<?php

class Student {
    public $name;
    public $marks; // associative array
    public $gpa;

    public function __construct($name, $marks, $gpa) {
        $this->name = $name;
        $this->marks = $marks;
        $this->gpa = $gpa;
    }


    public function toCSVRow() {
        $row = [$this->name];

        foreach ($this->marks as $subject => $mark) {
            $row[] = "$subject: $mark";
        }

        $row[] = $this->gpa;
        return $row;
    }
}
?>