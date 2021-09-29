<?php
namespace App\Dto;

final class Experiments2labelsInput {
    
    /**
     * @var int
     */
    public $experimentId;
    
    /**
     * @var int|null
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