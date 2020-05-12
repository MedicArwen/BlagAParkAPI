<?php
// api/src/Entity/Favori.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Une place favorite d'un utilisateur de l'application Blagapark. Cela lui
 * permet d'avoir un raccourci pour la retrouver plus rapidement en cas de 
 * locations régulières.
 *
 * @ORM\Entity
 * @ApiResource
 */
class Favori
{
     /**
     * @var int l'identifiant du favori de l'utilisateur.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /*-------------------------->  ASSOCIATIONS <-----------------------------*/  
    /**
     * @var User utilisateur qui a créé le favoris.
     * @ORM\ManyToOne(targetEntity="UserBlagapark", inversedBy="Favoris")
     */
    public $UserBlagapark;
     /**
     * @var ParkingPlace Place qui a été mise en favori.
     * @ORM\ManyToOne(targetEntity="ParkingPlace", inversedBy="Favoris")
     */
    public $ParkingPlace;
    
    /*------------------------>  CONSTRUCTEUR(S) <----------------------------*/
    public function __construct(UserBlagapark $pUserBlagapark, ParkingPlace $pParkingPlace)
    {
        $this->ParkingPlace = $pParkingPlace;
        $this->UserBlagapark = $pUserBlagapark;
    }
            
    /*----------------------->  GETTERS ET SETTERS <--------------------------*/
     public function getId(): ?int
    {
        return $this->id;
    }
}
?>