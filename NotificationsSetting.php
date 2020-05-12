<?php
// api/src/Entity/NotificationsSetting.php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * L’utilisateur choisi quelles notifications il veut recevoir par email. Les 
 * notifications smartphone se configure dans les paramètres de l’application 
 * dans le smartphone. Il peut donc choisir d’être notifié de :
    	Les nouveautés sur l’application (nouvelles fonctions et mises à jour)
    	Bons plans et cadeaux de partenaires
    	Messages privés via l’application
    	Evénement associés à ses places de parking mises en location.
 *
 * @ORM\Entity
 * @ApiResource
 */
class NotificationsSetting
{
   /**
     * @var int Identifiant automatiquement généré des réglages de notification d'un utilisateur.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
     /**
     * @ORM\Column(type="boolean")
     * @var boolean Accord pour notification email des News et des mises à jour.
     */
    public $notifyNews;
     /**
     * @ORM\Column(type="boolean")
     * @var boolean Accord pour notification email des cadeaux et promotions.
     */
    public $notifyGiftPromos;
     /**
     * @ORM\Column(type="boolean")
     * @var boolean Accord pour notification email des messages privés.
     */
    public $notifyPrivateMessages;
     /**
     * @ORM\Column(type="boolean")
     * @var boolean Accord pour notification email des evénements associés à ses places de parking mises en location.
     */
    public $notifyEventPlace;    

    
     /*------------------------->  ASSOCIATIONS <-----------------------------*/
     /* @var UserBlagapark Utilisateur associé dont c'est les coordonnées bancaires.
     * @ORM\OneToOne(targetEntity="UserBlagapark", inversedBy="NotificationsSetting")
     * @Assert\NotBlank
     * @Assert\NotNull
     */
      public $Owner;
      
      
    /*------------------------>  CONSTRUCTEUR(S) <----------------------------*/
        public function __construct(UserBlagapark $pUserBlagapark)
    {
        // Configuration des notifications
        $this->notifyNews = true;
        $this->notifyGiftPromos = true;
        $this->notifyPrivateMessages = true;
        $this->notifyEventPlace = true;
        // ASSOCIATION(S)
        $this->Owner = $pUserBlagapark;
    }
      
    /*----------------------->  GETTERS ET SETTERS <--------------------------*/      
     public function getId(): ?int
    {
        return $this->id;
    }
    
}
?>