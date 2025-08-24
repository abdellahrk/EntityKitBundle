<?php
/*
 * Copyright (c) 2025.
 *
 * This file is part of the Entity Kit Bundle project
 * @author Abdellah Ramadan <ramadanabdel24@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace Rami\EntityKitBundle\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class EntityCountException extends \Exception
{
    protected $code = Response::HTTP_CONFLICT;

    protected $message = 'This entity is a singleton. Entity has already been created.';

}