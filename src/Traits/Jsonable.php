<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 15/08/17
 * Time: 10:25
 */

namespace Girolando\CieloCheckout\Traits;


use Girolando\CieloCheckout\Contracts\JsonableContract;

trait Jsonable
{

    private function generatePlainObject($instance)
    {
        $properties = get_class_vars(get_class($instance));
        $plainObject = new \stdClass();

        foreach($properties as $property => $value) {
            if(is_array($instance->$property)) {
                foreach($instance->$property as $subProperty => $subValue) {
                    if($subValue instanceof JsonableContract) {
                        $plainObject->$property[] = $subValue->toPlainObject();
                        continue;
                    }
                    $plainObject->$property[] = $subValue;
                }
                continue;
            }

            if($instance->$property instanceof JsonableContract) {
                $plainObject->$property = $instance->$property->toPlainObject();
                continue;
            }
            $plainObject->$property = $instance->$property;
        }
        return $plainObject;
    }

    /** Generates and return a plain object representing this class and its properties
     * @return \stdClass
     */
    public function toPlainObject()
    {
        $plainObject = $this->generatePlainObject($this);
        return $plainObject;
    }


    /** Generates and return a string representing the JSON of this instance.
     * @return string
     */
    public function toJson()
    {
        $plain = $this->toPlainObject();
        return json_encode($plain);
    }
}