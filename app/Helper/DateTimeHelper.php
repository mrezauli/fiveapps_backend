<?php

namespace App\Helper;


use Carbon\Carbon;

class DateTimeHelper
{
  /**
   * @param $dateTime
   * @return false|string
   */
  public static function dateTimeDefaultFormatter($dateTime)
  {
    return date('F d, Y h:i A', strtotime($dateTime));
  }


  /**
   * @param $dateTime
   * @return false|string
   */
  public static function dateDefaultFormatter($dateTime)
  {
    return date('d-m-Y', strtotime($dateTime));
  }


  /**
   * @param $dateTime
   * @return false|string
   */
  public static function dateFormatter1($dateTime)
  {
    return date('d F', strtotime($dateTime));
  }

  /**
   * @param $dateTime
   * @return false|string
   */
  public static function dateFormatter2($dateTime)
  {
    return date('d F, Y', strtotime($dateTime));
  }

  /**
   * @param $dateTime
   * @return false|string
   */
  public static function dateFormatter3($dateTime)
  {
    return date('Y-m-d', strtotime($dateTime));
  }

  /**
   * @param $dateTime
   * @return false|string
   */
  public static function dayFormatter1($dateTime)
  {
    return date('l', strtotime($dateTime));
  }

  /**
   * @param $dateTime
   * @return false|string
   */
  public static function timeDefaultFormatter($dateTime)
  {
    return date('h:i A', strtotime($dateTime));
  }

  /**
   * @param $dateTime
   * @return false|string
   */
  public static function timeFormatter1($dateTime)
  {
    return date('h:i:s A', strtotime($dateTime));
  }

  /**
   * @param $dateTime
   * @return false|string
   */
  public static function timeFormatter2($dateTime)
  {
    return date('H:i:s', strtotime($dateTime));
  }


  /**
   * @param $minutes
   * @return string
   */
  public static function getHoursFromMinutes($minutes): string
  {
    return number_format(($minutes / 60), 2);
  }


  /**
   * @param $target
   * @param string $format
   * @return false|string
   */
  public static function dateFormatter($target, string $format = 'F d, Y')
  {
    return date($format, strtotime($target));
  }


  /**
   * @param $time
   * @return int
   */
  public static function getLateInMinute($time, $inTime): int
  {
    if (DateTimeHelper::timeFormatter2($time) > DateTimeHelper::timeFormatter2($inTime)) {
      $endTime = Carbon::parse($time);
      $startTime = Carbon::parse(self::dateFormatter3($time) . ' ' . $inTime);
      $totalDuration = $endTime->diffInMinutes($startTime);
      return $totalDuration;
    }
    return 0;
  }

  /**
   * @param $time1
   * @param $time2
   * @return int
   */
  public static function getDiffMinute($time1, $time2): int
  {
    if (DateTimeHelper::timeFormatter2($time1) > DateTimeHelper::timeFormatter2($time2)) {
      $endTime = Carbon::parse($time1);
      $startTime = Carbon::parse($time2);
    } else {
      $endTime = Carbon::parse($time2);
      $startTime = Carbon::parse($time1);
    }
    $totalDuration = $endTime->diffInMinutes($startTime);
    return $totalDuration;
  }


  /**
   * @param $time1
   * @param $time2
   * @return string
   */
  public static function getDiffTime($time1, $time2, $format = 'H:i:s')
  {
    if (DateTimeHelper::timeFormatter2($time1) > DateTimeHelper::timeFormatter2($time2)) {
      $endTime = Carbon::parse($time1);
      $startTime = Carbon::parse($time2);
    } else {
      $endTime = Carbon::parse($time2);
      $startTime = Carbon::parse($time1);
    }
    $totalDuration = $endTime->diffInSeconds($startTime);
    return gmdate($format, $totalDuration);
  }


  /**
   * @param $time
   * @return int
   */
  public static function getAdvanceOutMinute($time, $outTime): int
  {
    if (DateTimeHelper::timeFormatter2($time) < DateTimeHelper::timeFormatter2($outTime)) {
      $startTime = Carbon::parse($time);
      $endTime = Carbon::parse(self::dateFormatter3($time) . ' ' . $outTime);
      $totalDuration = $endTime->diffInMinutes($startTime);
      return $totalDuration;
    }
    return 0;
  }

}
