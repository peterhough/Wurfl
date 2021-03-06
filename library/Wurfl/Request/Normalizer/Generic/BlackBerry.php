<?php
namespace Wurfl\Request\Normalizer\Generic;

/**
 * Copyright (c) 2012 ScientiaMobile, Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * Refer to the COPYING.txt file distributed with this package.
 *
 * @category   WURFL
 * @package    \Wurfl\Request\Normalizer\UserAgentNormalizer_Generic
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @author     Fantayeneh Asres Gizaw
 * @version    $id$
 */
/**
 * User Agent Normalizer - returns the substring starting from "BlackBerry"
 * @package    \Wurfl\Request\Normalizer\UserAgentNormalizer_Generic
 */
class BlackBerry implements \Wurfl\Request\Normalizer\NormalizerInterface  {

    public function normalize($userAgent) {
        $userAgent = str_ireplace('blackberry', 'BlackBerry', $userAgent);
        $pos = strpos($userAgent, 'BlackBerry');
        if ($pos !== false && $pos > 0) {
            $userAgent = substr($userAgent, $pos);
        }
        return $userAgent;
    }
}