# Usage

## Create the enumeration
Just use the `Enum\EnumTrait` trait on a class:

```php
use Enum\EnumTrait;

/** Specifies the day of the week. */
final class DayOfWeek {
  use EnumTrait;

  const sunday = 0;
  const monday = 1;
  const tuesday = 2;
  const wednesday = 3;
  const thursday = 4;
  const friday = 5;
  const saturday = 6;
}
```

This trait adds a private constructor to the enumerated type: it prohibits its instantiation.

Thus, the obtained enumeration can only contain static members.
You should only use [scalar constants](https://www.php.net/manual/en/function.is-scalar.php), and possibly static methods.

## Work with the enumeration
Check whether a value is defined among the enumerated type:

```php
DayOfWeek::isDefined(DayOfWeek::sunday); // true
DayOfWeek::isDefined(123); // false
```

Ensure that a value is defined among the enumerated type:

```php
DayOfWeek::assert(DayOfWeek::monday); // DayOfWeek::monday
DayOfWeek::assert(123); // (throws \UnexpectedValueException)

DayOfWeek::coerce(DayOfWeek::monday); // DayOfWeek::monday
DayOfWeek::coerce(123); // null
DayOfWeek::coerce(123, DayOfWeek::tuesday); // DayOfWeek::tuesday
```

Get the zero-based position of a value in the enumerated type declaration:

```php
DayOfWeek::getIndex(DayOfWeek::wednesday); // 3
DayOfWeek::getIndex(123); // -1
```

Get the name associated to an enumerated value:

```php
DayOfWeek::getName(DayOfWeek::thursday); // "thursday"
DayOfWeek::getName(123); // "" (empty)
```

Get information about the enumerated type:

```php
DayOfWeek::getEntries();
// ["sunday" => 0, "monday" => 1, "tuesday" => 2, "wednesday" => 3, "thursday" => 4, "friday" => 5, "saturday" => 6]

DayOfWeek::getNames();
// ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"]

DayOfWeek::getValues();
// [0, 1, 2, 3, 4, 5, 6]
```
