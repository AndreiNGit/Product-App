<?php

interface Crud 
{
    public function create();
    public function read();
    //Update not required in this project
    //public function update($values);
    public function delete();
}