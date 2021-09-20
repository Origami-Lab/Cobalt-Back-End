<?php
namespace App\Dto;

final class LabelsOutput {
    
    /**
     * @var int
     */
    public $id;
    
    /**
     * @var string
     */
    public $label;
    
    /**
     * @var string
     */
    public $color;
    
    /**
     * @var Array|null
     */
    public $experiments2labels;
}