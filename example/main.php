<?php
declare(strict_types=1);
use Enum\{EnumTrait};

/**
 * Specifies the day of the week.
 */
final class DayOfWeek {
  use EnumTrait;

  public const SUNDAY = 0;
  public const MONDAY = 1;
  public const TUESDAY = 2;
  public const WEDNESDAY = 3;
  public const THURSDAY = 4;
  public const FRIDAY = 5;
  public const SATURDAY = 6;
}

/**
 * Works with the enumeration.
 */
function main(): void {
  // Check whether a value is defined among the enumerated type.
  DayOfWeek::isDefined(DayOfWeek::SUNDAY); // true
  DayOfWeek::isDefined('foo'); // false

  // Ensure that a value is defined among the enumerated type.
  DayOfWeek::assert(DayOfWeek::MONDAY); // DayOfWeek::MONDAY
  DayOfWeek::assert('foo'); // (throws \UnexpectedValueException)

  DayOfWeek::coerce(DayOfWeek::MONDAY); // DayOfWeek::MONDAY
  DayOfWeek::coerce('bar'); // null
  DayOfWeek::coerce('baz', DayOfWeek::TUESDAY); // DayOfWeek::TUESDAY

  // Get the zero-based position of a value in the enumerated type declaration.
  DayOfWeek::getIndex(DayOfWeek::WEDNESDAY); // 3
  DayOfWeek::getIndex('foo'); // -1

  // Get the name associated to an enumerated value.
  DayOfWeek::getName(DayOfWeek::THURSDAY); // "THURSDAY"
  DayOfWeek::getName('foo'); // "" (empty)

  // Get information about the enumerated type.
  DayOfWeek::getEntries();
  // ["SUNDAY" => 0, "MONDAY" => 1, "TUESDAY" => 2, "WEDNESDAY" => 3, "THURSDAY" => 4, "FRIDAY" => 5, "SATURDAY" => 6]

  DayOfWeek::getNames();
  // ["SUNDAY", "MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY"]

  DayOfWeek::getValues();
  // [0, 1, 2, 3, 4, 5, 6]
}
