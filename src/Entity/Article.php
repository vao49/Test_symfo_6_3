<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(name="FK_ARTICLE_MARQUE", columns={"ID_MARQUE"}), @ORM\Index(name="FK_ARTICLE_TYPEBIERE", columns={"ID_TYPE"}), @ORM\Index(name="FK_ARTICLE_COULEUR", columns={"ID_COULEUR"})})
 * @ORM\Entity
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_ARTICLE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_ARTICLE", type="string", length=60, nullable=false)
     */
    private $nomArticle;

    /**
     * @var float
     *
     * @ORM\Column(name="PRIX_ACHAT", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixAchat;

    /**
     * @var int|null
     *
     * @ORM\Column(name="VOLUME", type="integer", nullable=true)
     */
    private $volume;

    /**
     * @var float|null
     *
     * @ORM\Column(name="TITRAGE", type="float", precision=10, scale=0, nullable=true)
     */
    private $titrage;

    /**
     * @var \Typebiere
     *
     * @ORM\ManyToOne(targetEntity="Typebiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_TYPE", referencedColumnName="ID_TYPE")
     * })
     */
    private $idType;

    /**
     * @var \Couleur
     *
     * @ORM\ManyToOne(targetEntity="Couleur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_COULEUR", referencedColumnName="ID_COULEUR")
     * })
     */
    private $idCouleur;

    /**
     * @var \Marque
     *
     * @ORM\ManyToOne(targetEntity="Marque")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_MARQUE", referencedColumnName="ID_MARQUE")
     * })
     */
    private $idMarque;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Ticket", mappedBy="idArticle")
     */
    private $annee = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->annee = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdArticle(): ?int
    {
        return $this->idArticle;
    }

    public function getNomArticle(): ?string
    {
        return $this->nomArticle;
    }

    public function setNomArticle(string $nomArticle): static
    {
        $this->nomArticle = $nomArticle;

        return $this;
    }

    public function getPrixAchat(): ?float
    {
        return $this->prixAchat;
    }

    public function setPrixAchat(float $prixAchat): static
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(?int $volume): static
    {
        $this->volume = $volume;

        return $this;
    }

    public function getTitrage(): ?float
    {
        return $this->titrage;
    }

    public function setTitrage(?float $titrage): static
    {
        $this->titrage = $titrage;

        return $this;
    }

    public function getIdType(): ?Typebiere
    {
        return $this->idType;
    }

    public function setIdType(?Typebiere $idType): static
    {
        $this->idType = $idType;

        return $this;
    }

    public function getIdCouleur(): ?Couleur
    {
        return $this->idCouleur;
    }

    public function setIdCouleur(?Couleur $idCouleur): static
    {
        $this->idCouleur = $idCouleur;

        return $this;
    }

    public function getIdMarque(): ?Marque
    {
        return $this->idMarque;
    }

    public function setIdMarque(?Marque $idMarque): static
    {
        $this->idMarque = $idMarque;

        return $this;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getAnnee(): Collection
    {
        return $this->annee;
    }

    public function addAnnee(Ticket $annee): static
    {
        if (!$this->annee->contains($annee)) {
            $this->annee->add($annee);
            $annee->addIdArticle($this);
        }

        return $this;
    }

    public function removeAnnee(Ticket $annee): static
    {
        if ($this->annee->removeElement($annee)) {
            $annee->removeIdArticle($this);
        }

        return $this;
    }

}
