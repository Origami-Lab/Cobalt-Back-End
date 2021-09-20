<?php
namespace App\Dto;

final class Experiments2labelsOutput {
    
    /**
     * @var int
     */
    public $id;
    
    /**
     * @var int
     */
    public $experimentId;
    
    /**
     * @var int
     */
    public $labelId;
    
    /**
     * @var string|null
     */
    public $label;
    
    /**
     * @var string|null
     */
    public $color;
}