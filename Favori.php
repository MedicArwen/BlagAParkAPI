<?php
// api/src/Entity/Favori.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Une place favorite d'un utilisateur de l'application Blagapark. Cela lui
 * permet d'avoir un racourci pour la retrouver plus rapidement en cas de 
 * locations régulières.
 *
 * @ORM\Entity
 */
class Favori
{
        /**
     * @var int l'identifiant du favori de l'utilisateur.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @var User utilisateur qui a créé le favoris.
     *
     * @ORM\ManyToOne(targetEntity="UserBlagapark", inversedBy="Favoris")
     */
    public $UserBlagapark;
     public function getId(): ?int
    {
        return $this->id;
    }
}
?>