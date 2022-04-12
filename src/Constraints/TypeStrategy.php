<?php


namespace Demoniqus\StrategyBundle\Constraints;


use Demoniqus\StrategyBundle\Model\Strategy\StrategyInterface as AbstractStrategyInterface;

use Demoniqus\StrategyBundle\Interfaces\StrategyInterface;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
final class TypeStrategy extends Callback
{
//region SECTION: Fields


//endregion Fields

//region SECTION: Constructor
    public function __construct($callback = null, array $groups = null, $payload = null, array $options = [])
    {
        $callback = self::getCallback();
        parent::__construct($callback, $groups, $payload, $options);
    }
//endregion Constructor
//region SECTION: Private
    private static function getCallback(): \Closure
    {
        return function ($object, ExecutionContextInterface $context, $payload) {
            /** @var AbstractStrategyInterface $object */
            $strategyName = $object->getName();
            /** @var StrategyInterface $strategyName */
            if ($object->getType() !== $strategyName::getType()) {
                $context->buildViolation(sprintf('Expected argument of type "%s", "%s" given', $strategyName::getType(), $object->getType()))
                    ->atPath('type')
                    ->addViolation();
            }
        };
    }
//endregion Private
}
///**
// * @Annotation
// * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
// */
//#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
//final class TypeStrategy extends Constraint
//{
////region SECTION: Fields
//    public const IS_NOT_STRATEGY_TYPE = 'de13c2ae0e880ae8b56689f954a97b67';
//
//    protected static $errorNames = [
//        self::IS_NOT_STRATEGY_TYPE => 'IS_NOT_STRATEGY_TYPE',
//    ];
//
//    public $message = 'This strategy has invalid type';
//
////endregion Fields
//
////region SECTION: Constructor
//    public function __construct($options = null,string $message = null,  array $groups = null, $payload = null)
//    {
//        parent::__construct($options, $groups, $payload);
//        $this->message = $message ?? $this->message;
//    }
////endregion Constructor
//}