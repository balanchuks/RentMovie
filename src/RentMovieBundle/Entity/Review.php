<?php

namespace RentMovieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Review
 *
 * @ORM\Table(name="review", indexes={@ORM\Index(name="IDX_794381C67F98CD1C", columns={"clientid"}), @ORM\Index(name="IDX_794381C6EEF9E56", columns={"movieid"})})
 * @ORM\Entity
 */
class Review
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ratingreviews", type="integer", nullable=true)
     */
    private $ratingreviews;

    /**
     * @var string
     *
     * @ORM\Column(name="moviereviews", type="string", length=255, nullable=true)
     */
    private $moviereviews;

    /**
     * @var integer
     *
     * @ORM\Column(name="reviewid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="review_reviewid_seq", allocationSize=1, initialValue=1)
     */
    private $reviewid;

    /**
     * @var \RentMovieBundle\Entity\Movies
     *
     * @ORM\ManyToOne(targetEntity="RentMovieBundle\Entity\Movies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="movieid", referencedColumnName="movieid")
     * })
     */
    private $movieid;

    /**
     * @var \RentMovieBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="RentMovieBundle\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clientid", referencedColumnName="clientid")
     * })
     */
    private $clientid;



    /**
     * Set ratingreviews
     *
     * @param integer $ratingreviews
     * @return Review
     */
    public function setRatingreviews($ratingreviews)
    {
        $this->ratingreviews = $ratingreviews;

        return $this;
    }

    /**
     * Get ratingreviews
     *
     * @return integer 
     */
    public function getRatingreviews()
    {
        return $this->ratingreviews;
    }

    /**
     * Set moviereviews
     *
     * @param string $moviereviews
     * @return Review
     */
    public function setMoviereviews($moviereviews)
    {
        $this->moviereviews = $moviereviews;

        return $this;
    }

    /**
     * Get moviereviews
     *
     * @return string 
     */
    public function getMoviereviews()
    {
        return $this->moviereviews;
    }

    /**
     * Get reviewid
     *
     * @return integer 
     */
    public function getReviewid()
    {
        return $this->reviewid;
    }

    /**
     * Set movieid
     *
     * @param \RentMovieBundle\Entity\Movies $movieid
     * @return Review
     */
    public function setMovieid(\RentMovieBundle\Entity\Movies $movieid = null)
    {
        $this->movieid = $movieid;

        return $this;
    }

    /**
     * Get movieid
     *
     * @return \RentMovieBundle\Entity\Movies 
     */
    public function getMovieid()
    {
        return $this->movieid;
    }

    /**
     * Set clientid
     *
     * @param \RentMovieBundle\Entity\Client $clientid
     * @return Review
     */
    public function setClientid(\RentMovieBundle\Entity\Client $clientid = null)
    {
        $this->clientid = $clientid;

        return $this;
    }

    /**
     * Get clientid
     *
     * @return \RentMovieBundle\Entity\Client 
     */
    public function getClientid()
    {
        return $this->clientid;
    }
}
