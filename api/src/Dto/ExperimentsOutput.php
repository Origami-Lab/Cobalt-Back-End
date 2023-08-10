<?php
namespace App\Dto;

final class ExperimentsOutput {
    
    /**
     * @var int
     */
    public $id;
    
    /**
     * @var string|null
     */
    public $title;
    
    /**
     * @var string
     */
    public $author;
    
    /**
     * @var string
     */
    public $status;
    
    /**
     * @var string|null
     */
    public $startdate;
    
    /**
     * @var string|null
     */
    public $duedate;
    
    /**
     * @var string|null
     */
    public $startDate;
    
    /**
     * @var string|null
     */
    public $dueDate;
    
    /**
     * @var string|null
     */
    public $datetime;
    
    /**
     * @var string|null
     */
    public $userid;
    
    /**
     * @var Array|null
     */
    public $experiments2labels;
    /**
     * @var Array|null
     */
    public $experiments2molecules;
    /**
     * @var string|null
     */
    public $padid;
}