<?php

namespace AloneBundle\Repository;
use AloneBundle\Entity\DevBlog;

/**
 * DevBlogRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DevBlogRepository extends \Doctrine\ORM\EntityRepository
{

    public function previous(DevBlog $blog)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT u
            FROM AloneBundle:DevBlog u
            WHERE u.id = (SELECT MAX(us.id) FROM AloneBundle:DevBlog us WHERE us.id < :id )'
            )
            ->setParameter(':id', $blog->getId())
            ->getOneOrNullResult();
    }

    public function next(DevBlog $blog)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT u
            FROM AloneBundle:DevBlog u
            WHERE u.id = (SELECT MIN(us.id) FROM AloneBundle:DevBlog us WHERE us.id > :id )'
            )
            ->setParameter(':id', $blog->getId())
            ->getOneOrNullResult();
    }

}
