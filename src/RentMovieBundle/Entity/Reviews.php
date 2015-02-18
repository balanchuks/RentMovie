<<<<<<< HEAD
<?php

namespace RentMovieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reviews
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Reviews
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="ratingReviews", type="integer")
     */
    private $ratingReviews;

    /**
     * @var string
     *
     * @ORM\Column(name="movieReview", type="string", length=255)
     */
    private $movieReview;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $login;

    /**
     * @var integer
     *
     * @ORM\Column(name="movieId", type="integer")
     */
    private $movieId;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set reviewId
     *
     * @param integer $reviewId
     * @return Reviews
     */
    public function setReviewId($reviewId)
    {
        $this->reviewId = $reviewId;

        return $this;
    }

    /**
     * Get reviewId
     *
     * @return integer 
     */
    public function getReviewId()
    {
        return $this->reviewId;
    }

    /**
     * Set ratingReviews
     *
     * @param integer $ratingReviews
     * @return Reviews
     */
    public function setRatingReviews($ratingReviews)
    {
        $this->ratingReviews = $ratingReviews;

        return $this;
    }

    /**
     * Get ratingReviews
     *
     * @return integer 
     */
    public function getRatingReviews()
    {
        return $this->ratingReviews;
    }

    /**
     * Set movieReview
     *
     * @param string $movieReview
     * @return Reviews
     */
    public function setMovieReview($movieReview)
    {
        $this->movieReview = $movieReview;

        return $this;
    }

    /**
     * Get movieReview
     *
     * @return string 
     */
    public function getMovieReview()
    {
        return $this->movieReview;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return Reviews
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set movieId
     *
     * @param integer $movieId
     * @return Reviews
     */
    public function setMovieId($movieId)
    {
        $this->movieId = $movieId;

        return $this;
    }

    /**
     * Get movieId
     *
     * @return integer 
     */
    public function getMovieId()
    {
        return $this->movieId;
    }
}
=======
<?php

namespace RentMovieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reviews
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Reviews
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="ratingReviews", type="integer")
     */
    private $ratingReviews;

    /**
     * @var string
     *
     * @ORM\Column(name="movieReview", type="string", length=255)
     */
    private $movieReview;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $login;

    /**
     * @var integer
     *
     * @ORM\Column(name="movieId", type="integer")
     */
    private $movieId;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set reviewId
     *
     * @param integer $reviewId
     * @return Reviews
     */
    public function setReviewId($reviewId)
    {
        $this->reviewId = $reviewId;

        return $this;
    }

    /**
     * Get reviewId
     *
     * @return integer 
     */
    public function getReviewId()
    {
        return $this->reviewId;
    }

    /**
     * Set ratingReviews
     *
     * @param integer $ratingReviews
     * @return Reviews
     */
    public function setRatingReviews($ratingReviews)
    {
        $this->ratingReviews = $ratingReviews;

        return $this;
    }

    /**
     * Get ratingReviews
     *
     * @return integer 
     */
    public function getRatingReviews()
    {
        return $this->ratingReviews;
    }

    /**
     * Set movieReview
     *
     * @param string $movieReview
     * @return Reviews
     */
    public function setMovieReview($movieReview)
    {
        $this->movieReview = $movieReview;

        return $this;
    }

    /**
     * Get movieReview
     *
     * @return string 
     */
    public function getMovieReview()
    {
        return $this->movieReview;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return Reviews
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set movieId
     *
     * @param integer $movieId
     * @return Reviews
     */
    public function setMovieId($movieId)
    {
        $this->movieId = $movieId;

        return $this;
    }

    /**
     * Get movieId
     *
     * @return integer 
     */
    public function getMovieId()
    {
        return $this->movieId;
    }
}
>>>>>>> 712257b3fe4b5c6231415b7dff637f0c2b9915dc
