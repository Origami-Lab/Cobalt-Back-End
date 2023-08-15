<?php
namespace App\Dto;

final class Experiments2moleculesInput {
    
    /**
     * @var int
     */
    public $experimentId;
    
    /**
     * @var int|null
     */
    public $moleculeId;
    
    /**
     * @var string|null
     */
    public $molecule;
    
    /**
     * @var string|null
     */
    public $fullmolecule;
}