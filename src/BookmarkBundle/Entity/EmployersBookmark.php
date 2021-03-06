<?php

namespace BookmarkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmployersBookmark
 *
 * @ORM\Table(name="employers_bookmark")
 * @ORM\Entity(repositoryClass="BookmarkBundle\Repository\EmployersBookmarkRepository")
 */
class EmployersBookmark
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Employer", inversedBy="bookmarks")
     * @ORM\JoinColumn(name="employer_id", referencedColumnName="id")
     */

    private $bookmarkingEmployer;

    /**
     * One Product has One Shipment.
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\Freelancer")
     * @ORM\JoinColumn(name="freelancer_id", referencedColumnName="id")
     */
    private $bookmarkedFreelancer;

    /**
     * @return mixed
     */
    public function getBookmarkedFreelancer()
    {
        return $this->bookmarkedFreelancer;
    }

    /**
     * @param mixed $bookmarkedFreelancer
     */
    public function setBookmarkedFreelancer($bookmarkedFreelancer)
    {
        $this->bookmarkedFreelancer = $bookmarkedFreelancer;
    }

    /**
     * @return mixed
     */

    public function getBookmarkingEmployer()
    {
        return $this->bookmarkingEmployer;
    }

    /**
     * @param mixed $bookmarkingEmployer
     */
    public function setBookmarkingEmployer($bookmarkingEmployer)
    {
        $this->bookmarkingEmployer = $bookmarkingEmployer;
    }




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

