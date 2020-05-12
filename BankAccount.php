<?php
// api/src/Entity/BankAccount.php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Pour récupérer l’argent gagné lors de locations, le bailleur doit saisir les 
 * informations bancaires pour que l’on puisse faire (manuellement) un virement.
 * Il peut également renseigner son compte PayPal.
 *
 * @ORM\Entity
 * @ApiResource
 */
class BankAccount
{
   /**
     * @var int Identifiant des données bancaires.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
     /* @ORM\Column(type="string")
     *  @Assert\email
     *  @var string Adresse email associée au compte Paypal de l'utilisateur.
     */
    public $emailPayPal;
     /* @ORM\Column(type="string")
     *  @Assert\Iban
     *  @var string IBAN du compte de l'utilisateur.
     */
    public $IBAN;
     /* @ORM\Column(type="string")
     *  @var string BIC associé à l'IBAN du compte utilisateur.
     * @Assert\Bic
     */
    public $BIC;

    
     /*------------------------->  ASSOCIATIONS <-----------------------------*/
     /* @var UserBlagapark Utilisateur associé dont c'est les coordonnées bancaires.
     * @ORM\OneToOne(targetEntity="UserBlagapark", inversedBy="BankAccount")
     * @Assert\NotBlank
     * @Assert\NotNull
     */
      public $UserBlagapark;
      
    /*------------------------>  CONSTRUCTEUR(S) <----------------------------*/
        public function __construct(UserBlagapark $pUserBlagapark)
    {
        // Données de base du compte bancaire
        $this->emailPayPal = "";
        $this->IBAN = "";
        $this->BIC = "";  
        // Associations 
        $this->UserBlagapark = $pUserBlagapark;
    }
      
    /*----------------------->  GETTERS ET SETTERS <--------------------------*/      
     public function getId(): ?int
    {
        return $this->id;
    }
    
}
?>