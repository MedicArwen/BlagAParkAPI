<?php
// api/src/Entity/ParkingPlaceDispos.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Un utilisateur de l'application Blagapark.
 *
 * @ORM\Entity
 */
class ParkingPlaceDispo
{
    /**
     * @var int l'identifiant du favori de l'utilisateur.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
     /* @ORM\Column(type="date")
     * @var string la place a-t-elle été supprimée?
     */
    public $startDate;
     /* @ORM\Column(type="date")
     * @var string la place a-t-elle été supprimée?
     */
    public $endDate;
     /* @ORM\Column(type="time")
     * @var string la place a-t-elle été supprimée?
     */
    public $startHour;
     /* @ORM\Column(type="time")
     * @var string la place a-t-elle été supprimée?
     */
    public $endHour;
    
    
    
    /**
     * @var ParkingPlace utilisateur qui a créé le favoris.
     *
     * @ORM\ManyToOne(targetEntity="ParkingPlace", inversedBy="ParkingPlaceDispos")
     */
    public $ParkingPlace;
     public function getId(): ?int
    {
        return $this->id;
    }
}
?>