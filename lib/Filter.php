<?php

/**
 * PrivateBin
 *
 * a zero-knowledge paste bin
 *
 * @link      https://github.com/PrivateBin/PrivateBin
 * @copyright 2012 Sébastien SAUVAGE (sebsauvage.net)
 * @license   https://www.opensource.org/licenses/zlib-license.php The zlib/libpng License
 * @version   1.5.1
 */

namespace PrivateBin;

use Exception;

/**
 * Filter
 *
 * Provides data filtering functions.
 */
class Filter
{
    /**
     * format a given time string into a human readable label (localized)
     *
     * accepts times in the format "[integer][time unit]"
     *
     * @access public
     * @static
     * @param int $value
     * @param string unit
     * @throws Exception
     * @return string
     */
    public static function formatHumanReadableTime($value, $unit = 's')
    {
        if (!is_numeric($value)) {
            throw new Exception('Invalid time value');
        }
        if ($unit === 's') {
            $unit = I18n::_('seconds');
        } elseif ($unit === 'm') {
            $unit = I18n::_('minutes');
            $value /= 60;
        } elseif ($unit === 'h') {
            $unit = I18n::_('hours');
            $value /= 3600;
        } elseif ($unit === 'd') {
            $unit = I18n::_('days');
            $value /= 86400;
        } elseif ($unit === 'w') {
            $unit = I18n::_('weeks');
            $value /= 604800;
        } elseif ($unit === 'M') {
            $unit = I18n::_('months');
            $value /= 2628000;
        } elseif ($unit === 'y') {
            $unit = I18n::_('years');
            $value /= 31536000;
        }
        return number_format($value, 0, '.', ' ') . ' ' . $unit;
    }
    

    /**
     * format a given number of bytes in IEC 80000-13:2008 notation (localized)
     *
     * @access public
     * @static
     * @param  int $size
     * @return string
     */
    public static function formatHumanReadableSize($size)
    {
        $iec = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
        $i   = 0;
        while (($size / 1024) >= 1) {
            $size = $size / 1024;
            ++$i;
        }
        return number_format($size, ($i ? 2 : 0), '.', ' ') . ' ' . I18n::_($iec[$i]);
    }
}
