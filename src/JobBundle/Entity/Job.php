<?php

namespace JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Job
 *
 * @ORM\Table(name="job")
 * @ORM\Entity(repositoryClass="JobBundle\Repository\JobRepository")
 */
class Job
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @var float
     *
     * @ORM\Column(name="minSalary", type="float")
     */
    private $minSalary;

    /**
     * @var float
     *
     * @ORM\Column(name="maxSalary", type="float")
     */
    private $maxSalary;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="string", length=255)
     */

    private $tags;



    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Employer")
     * @ORM\JoinColumn(name="employer_id",referencedColumnName="id")
     */
    private $employer_id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Job
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Job
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Job
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Job
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set minSalary
     *
     * @param float $minSalary
     *
     * @return Job
     */
    public function setMinSalary($minSalary)
    {
        $this->minSalary = $minSalary;

        return $this;
    }

    /**
     * Get minSalary
     *
     * @return float
     */
    public function getMinSalary()
    {
        return $this->minSalary;
    }

    /**
     * Set maxSalary
     *
     * @param float $maxSalary
     *
     * @return Job
     */
    public function setMaxSalary($maxSalary)
    {
        $this->maxSalary = $maxSalary;

        return $this;
    }

    /**
     * Get maxSalary
     *
     * @return float
     */
    public function getMaxSalary()
    {
        return $this->maxSalary;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Job
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set tags
     *
     * @param string $tags
     *
     * @return Job
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return mixed
     */
    public function getEmployerId()
    {
        return $this->employer_id;
    }

    /**
     * @param mixed $employer_id
     */
    public function setEmployerId($employer_id)
    {
        $this->employer_id = $employer_id;
    }

}

