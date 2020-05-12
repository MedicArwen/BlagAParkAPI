<?php
// api/src/Entity/BankTransaction.php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Une transaction entre deux utilisateurs Blagapark. Elle consiste forcément à
 * un transfert d'un compte blagapark à un autre d'un montant. Il faut s'assurer
 * que la transaction ne soit pas dupliquée ni injectable sans avoir une 
 * vérification.
 *
 * @ORM\Entity
 * @ApiResource
 */
class BankTransaction
{
   /**
     * @var int Identifiant automatiquement généré de la transaction bancaire.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
   
     /* @ORM\Column(type="date")
     *  @Assert\DateTime
     *  @Assert\NotBlank
     *  @var DateTime Date de la création de la transaction au format "Y-m-d H:i:s".
     */
    public $dateTransaction;
     /* @ORM\Column(type="float")
     *  @var float Montant de la transaction?
     *  @Assert\GreaterThanOrEqual(0)
     *  @Assert\NotBlank
     */
    public $amount;
     /* @ORM\Column(type="smallint")
     *  @var int Code de la transaction (0 = un locataire paie une place au bailleur 1 = un bailleur rembourse un locataire)
     */
    public $descriptionCode;
     /* @ORM\Column(type="boolean")
     *  @var boolean Le paiement a-t-il été fait comptant ou via le compte Blagapark?
     */
    public $isPaidWithBlagaparkAccount;
 
    
     /*------------------------->  ASSOCIATIONS <-----------------------------*/
     /**
     * @var ReservationPlace Reservation d'une place à laquelle est liée la transaction bancaire.
     * @ORM\OneToOne(targetEntity="ReservationPlace", inversedBy="Transaction")
     * @Assert\NotBlank
     * @Assert\NotNull
     */
      public $ReservationPlace;
     /**
     * @var UserBlagapark Utilisateur qui est dans la transaction en tant que locataire.
     * @ORM\ManyToOne(targetEntity="UserBlagapark", inversedBy="TransactionsLocataire")
     * @Assert\NotBlank
     * @Assert\NotNull
     */
      public $Locataire;
     /**
     * @var UserBlagapark Utilisateur qui est dans la transaction en tant que bailleur.
     * @ORM\ManyToOne(targetEntity="UserBlagapark", inversedBy="TransactionsBailleur")
     * @Assert\NotBlank
     * @Assert\NotNull
     */
      public $Bailleur;
      
    /*------------------------>  CONSTRUCTEUR(S) <----------------------------*/
        public function __construct(UserBlagapark $pLocataire, \App\Entity\UserBlagapark $pBailleur,
                App\Entity\ReservationPlace $pReservationPlace,float $pAmmount, int $pDescriptionCode,bool $pIsPaidWithBlagaparkAccount)
    {
        // vérification de la légitimité de la transaction
        // TODO
        //Détails de la transaction
        $this->amount = $pAmmount;
        $this->descriptionCode = $pDescriptionCode;
        $this->isPaidWithBlagaparkAccount = $pIsPaidWithBlagaparkAccount;        
        // Associations 
        $this->ReservationPlace = $pReservationPlace;
        $this->Bailleur = $pBailleur;
        $this->Locataire = $pLocataire;
        // Horodatage de la création
        $this->dateTransaction = new \DateTime("now");
       
        
    }
      
    /*----------------------->  GETTERS ET SETTERS <--------------------------*/      
     public function getId(): ?int
    {
        return $this->id;
    }
    
    }
?>