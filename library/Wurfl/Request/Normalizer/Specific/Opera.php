<?php
namespace Wurfl\Request\Normalizer\Specific;

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
 * @package    \Wurfl\Request\Normalizer\UserAgentNormalizer_Specific
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @author     Fantayeneh Asres Gizaw
 * @version    $id$
 */
/**
 * User Agent Normalizer
 * Return the safari user agent stripping out
 *     - all the chararcters between U; and Safari/xxx
 *
 *  e.g Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_4_11; fr) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.1 Safari/525.18
 *         becomes
 *         Mozilla/5.0 (Macintosh Safari/525
 * @package    \Wurfl\Request\Normalizer\UserAgentNormalizer_Specific
 */
class Opera implements \Wurfl\Request\Normalizer\NormalizerInterface {

    public function normalize($userAgent) {
        // Repair Opera user agents using fake version 9.80
        // Normalize: Opera/9.80 (X11; Linux x86_64; U; sv) Presto/2.9.168 Version/11.50
        // Into:      Opera/11.50 (X11; Linux x86_64; U; sv) Presto/2.9.168 Version/11.50
        if (\Wurfl\Handlers\Utils::checkIfStartsWith($userAgent, 'Opera/9.80')) {
            if (preg_match('#Version/(\d+\.\d+)#', $userAgent, $matches)) {
                $userAgent = str_replace('Opera/9.80', 'Opera/'.$matches[1], $userAgent);
            }
        }
        return $userAgent;
    }
}