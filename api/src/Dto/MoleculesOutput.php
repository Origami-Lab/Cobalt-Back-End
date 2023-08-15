<?php
namespace App\Dto;

final class MoleculesOutput {
    
    /**
     * @var int
     */
    public $id;
    
    /**
     * @var string
     */
    public $molecule;
    /**
     * @var string
     */
    public $fullmolecule;
    /**
     * @var Array|null
     */
    public $experiments2molecules;
}