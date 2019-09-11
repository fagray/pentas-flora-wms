<?php 

namespace App\Interfaces;

interface SortAndFilterInterface {

    public function sort($columnToBeSorted);
    public function filter($columnToBeFiltered);
    public function sortAndFilter($columnToBeSorted,$columnToBeFiltered);

}