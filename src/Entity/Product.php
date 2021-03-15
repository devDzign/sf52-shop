<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;


/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidV4Generator::class)
     */
    private ?Uuid $id= null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private string $moreInformations;

    /**
     * @ORM\Column(type="float")
     */
    private float $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private Bool $isBestSeller = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private Bool $isNewArrival;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private Bool $isFeatured;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private Bool $isSpecialOffer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $image;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="products")
     */
    private Collection $categories;

    /**
     * @ORM\OneToMany(targetEntity=RelatedProduct::class, mappedBy="product")
     */
    private $relatedProducts;

    /**
     * @ORM\OneToMany(targetEntity=ReviewsProduct::class, mappedBy="product")
     */
    private $reviewsProducts;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $tags;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->relatedProducts = new ArrayCollection();
        $this->reviewsProducts = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    /**
     * @return Uuid|null
     */
    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMoreInformations(): ?string
    {
        return $this->moreInformations;
    }

    public function setMoreInformations(?string $moreInformations): self
    {
        $this->moreInformations = $moreInformations;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getIsBestSeller(): ?bool
    {
        return $this->isBestSeller;
    }

    public function setIsBestSeller(bool $isBestSeller): self
    {
        $this->isBestSeller = $isBestSeller;

        return $this;
    }

    public function getIsNewArrival(): ?bool
    {
        return $this->isNewArrival;
    }

    public function setIsNewArrival(?bool $isNewArrival): self
    {
        $this->isNewArrival = $isNewArrival;

        return $this;
    }

    public function getIsFeatured(): ?bool
    {
        return $this->isFeatured;
    }

    public function setIsFeatured(?bool $isFeatured): self
    {
        $this->isFeatured = $isFeatured;

        return $this;
    }

    public function getIsSpecialOffer(): ?bool
    {
        return $this->isSpecialOffer;
    }

    public function setIsSpecialOffer(?bool $isSpecialOffer): self
    {
        $this->isSpecialOffer = $isSpecialOffer;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection|RelatedProduct[]
     */
    public function getRelatedProducts(): Collection
    {
        return $this->relatedProducts;
    }

    public function addRelatedProduct(RelatedProduct $relatedProduct): self
    {
        if (!$this->relatedProducts->contains($relatedProduct)) {
            $this->relatedProducts[] = $relatedProduct;
            $relatedProduct->setProduct($this);
        }

        return $this;
    }

    public function removeRelatedProduct(RelatedProduct $relatedProduct): self
    {
        if ($this->relatedProducts->removeElement($relatedProduct)) {
            // set the owning side to null (unless already changed)
            if ($relatedProduct->getProduct() === $this) {
                $relatedProduct->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ReviewsProduct[]
     */
    public function getReviewsProducts(): Collection
    {
        return $this->reviewsProducts;
    }

    public function addReviewsProduct(ReviewsProduct $reviewsProduct): self
    {
        if (!$this->reviewsProducts->contains($reviewsProduct)) {
            $this->reviewsProducts[] = $reviewsProduct;
            $reviewsProduct->setProduct($this);
        }

        return $this;
    }

    public function removeReviewsProduct(ReviewsProduct $reviewsProduct): self
    {
        if ($this->reviewsProducts->removeElement($reviewsProduct)) {
            // set the owning side to null (unless already changed)
            if ($reviewsProduct->getProduct() === $this) {
                $reviewsProduct->setProduct(null);
            }
        }

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(?string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
