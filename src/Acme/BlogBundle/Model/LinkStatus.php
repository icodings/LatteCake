<?php

/**
 * This file is part of the desarrolla2/blog-bundle project.
 *
 * Copyright (c)
 * Daniel González Cerviño <daniel@desarrolla2.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.
 */

namespace Desarrolla2\Bundle\BlogBundle\Model;

/**
 *
 * Description of LinkStatus
 *
 * @author : Daniel González Cerviño <daniel@desarrolla2.com>
 * @file : LinkStatus.php , UTF-8
 * @date : Mar 26, 2013 , 7:00:15 PM
 */
class LinkStatus
{
    /**
     * The entity was created
     */

    const CREATED = 0;

    /**
     * The entity was publised
     */
    const PUBLISHED = 1;

    /**
     *
     */
    const REMOVED = 50;

}
