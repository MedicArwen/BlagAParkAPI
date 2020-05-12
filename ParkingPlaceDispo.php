<?php
// api/src/Entity/ParkingPlaceDispos.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Les disponibilités d'une place de parking
 * la plage de disponibilité est composée d’une date de début, d’une date de fin 
 * et d’une période de la journée. Exemple : du lundi au vendredi, de 8h à 17h. 
 * Pour une journée complète, on indique du lundi au mardi, de 0h à 23h59. 
 * On ne peut pas faire commencer une période de disponibilité dans le passé.
 * Les périodes peuvent se chevaucher et donc se superposer. 
 *
 * @ORM\Entity
 * @ApiResource
 */
class ParkingPlaceDispo
{
    /**
     * @var int Identifiant unique de la disponibilité de la place.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
     /* @ORM\Column(type="date")
     *  @var DateTime  Date de début de la période de disponibilité.
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    public $startDate;
     /* @ORM\Column(type="date")
     *  @var DateTime  Date de fin de la période de disponibilité.
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    public $endDate;
     /* @ORM\Column(type="time")
     *  @var DateTime  Heure de début de la période de disponibilité.
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    public $startHour;
     /* @ORM\Column(type="time")
     *  @var DateTime  Heure de fin de la période de disponibilité.
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    public $endHour;
    
    /*-------------------------->  ASSOCIATIONS <-----------------------------*/      
    /**
     * @var ParkingPlace Place de Parking dont l'entité définie une plage de disponibilité.
     * @ORM\ManyToOne(targetEntity="ParkingPlace", inversedBy="ParkingPlaceDispos")
     */
    public $ParkingPlace;

    public function __construct(ParkingPlace $pParkingPlace, DateTime $pStartDate, DateTime $pEndDate, DateTime $pStartHour,DateTime $pEndHour)
    {
        //Caractéristiques de la place
        $this->startDate =$pStartDate;
        $this->endDate =$pEndDate;
        $this->startHour =$pStartHour;
        $this->endHour =$pEndHour;
 
        // Associations
        $this->ParkingPlace = $pParkingPlace;
        
    }
    /*----------------------->  GETTERS ET SETTERS <--------------------------*/    
     public function getId(): ?int
    {
        return $this->id;
    }
}
?>