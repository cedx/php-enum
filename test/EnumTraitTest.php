<?php declare(strict_types=1);
namespace Enum;

use function PHPUnit\Framework\{assertThat, equalTo, isEmpty, isFalse, isNull, isTrue};
use PHPUnit\Framework\TestCase;

/** A sample enumeration. */
final class SampleEnum {
	use EnumTrait;

	/** The first enumerated value. */
	const zero = false;

	/** The second enumerated value. */
	const one = 1;

	/** The third enumerated value. */
	const two = "TWO";

	/** The fourth enumerated value. */
	const three = 3.0;

	/** A protected enumerated value that should be ignored. */
	protected const protectedValue = null;

	/** A private enumerated value that should be ignored. */
	private const privateValue = null;
}

/** @testdox Enum\EnumTrait */
class EnumTraitTest extends TestCase {

	/** @testdox constructor */
	function testConstructor(): void {
		// It should create types that are not instantiable.
		if ($constructor = (new \ReflectionClass(SampleEnum::class))->getConstructor()) {
			assertThat($constructor->isFinal(), isTrue());
			assertThat($constructor->isPrivate(), isTrue());
		}
	}

	/** @testdox ::assert() */
	function testAssert(): void {
		// It should return the specified value if it is a known one.
		assertThat(SampleEnum::assert(false), equalTo(SampleEnum::zero));
		assertThat(SampleEnum::assert(1), equalTo(SampleEnum::one));
		assertThat(SampleEnum::assert("TWO"), equalTo(SampleEnum::two));
		assertThat(SampleEnum::assert(3.0), equalTo(SampleEnum::three));

		// It should throw an exception if it is an unknown value.
		$this->expectException(\UnexpectedValueException::class);
		SampleEnum::assert("");
	}

	/** @testdox ::coerce() */
	function testCoerce(): void {
		// It should return the specified value if it is a known one.
		assertThat(SampleEnum::coerce(false), equalTo(SampleEnum::zero));
		assertThat(SampleEnum::coerce(1), equalTo(SampleEnum::one));
		assertThat(SampleEnum::coerce("TWO"), equalTo(SampleEnum::two));
		assertThat(SampleEnum::coerce(3.0), equalTo(SampleEnum::three));

		// It should return the default value if it is an unknown one.
		assertThat(SampleEnum::coerce(""), isNull());
		assertThat(SampleEnum::coerce(1.0), isNull());
		assertThat(SampleEnum::coerce("two", SampleEnum::zero), equalTo(SampleEnum::zero));
		assertThat(SampleEnum::coerce(3.1, SampleEnum::two), equalTo(SampleEnum::two));
	}

	/** @testdox ::isDefined() */
	function testIsDefined(): void {
		// It should return `false` for unknown values.
		assertThat(SampleEnum::isDefined(""), isFalse());
		assertThat(SampleEnum::isDefined(1.0), isFalse());
		assertThat(SampleEnum::isDefined("two"), isFalse());
		assertThat(SampleEnum::isDefined(3.1), isFalse());

		// It should return `true` for known values.
		assertThat(SampleEnum::isDefined(false), isTrue());
		assertThat(SampleEnum::isDefined(1), isTrue());
		assertThat(SampleEnum::isDefined("TWO"), isTrue());
		assertThat(SampleEnum::isDefined(3.0), isTrue());
	}

	/** @testdox ::getEntries() */
	function testGetEntries(): void {
		// It should return the pairs of names and values of the enumerated constants.
		assertThat(SampleEnum::getEntries(), equalTo(["zero" => false, "one" => 1, "two" => "TWO", "three" => 3.0]));
	}

	/** @testdox ::getIndex() */
	function testGetIndex(): void {
		// It should return `-1` for unknown values.
		assertThat(SampleEnum::getIndex(0), equalTo(-1));
		assertThat(SampleEnum::getIndex(1.0), equalTo(-1));
		assertThat(SampleEnum::getIndex("two"), equalTo(-1));
		assertThat(SampleEnum::getIndex(3.1), equalTo(-1));

		// It should return the index of the enumerated constant for known values.
		assertThat(SampleEnum::getIndex(false), equalTo(0));
		assertThat(SampleEnum::getIndex(1), equalTo(1));
		assertThat(SampleEnum::getIndex("TWO"), equalTo(2));
		assertThat(SampleEnum::getIndex(3.0), equalTo(3));
	}

	/** @testdox ::getName() */
	function testGetName(): void {
		// It should return an empty string for unknown values.
		assertThat(SampleEnum::getName(0), isEmpty());
		assertThat(SampleEnum::getName(1.0), isEmpty());
		assertThat(SampleEnum::getName("two"), isEmpty());
		assertThat(SampleEnum::getName(3.1), isEmpty());

		// It should return the name for known values.
		assertThat(SampleEnum::getName(false), equalTo("zero"));
		assertThat(SampleEnum::getName(1), equalTo("one"));
		assertThat(SampleEnum::getName("TWO"), equalTo("two"));
		assertThat(SampleEnum::getName(3.0), equalTo("three"));
	}

	/** @testdox ::getNames() */
	function testGetNames(): void {
		// It should return the names of the enumerated constants.
		assertThat(SampleEnum::getNames(), equalTo(["zero", "one", "two", "three"]));
	}

	/** @testdox ::getValues() */
	function testGetValues(): void {
		// It should return the values of the enumerated constants.
		assertThat(SampleEnum::getValues(), equalTo([false, 1, "TWO", 3.0]));
	}
}
