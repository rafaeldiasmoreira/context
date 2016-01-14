<?php

namespace Context\DataWrapper;

abstract class Base implements \ArrayAccess
{
    /**
     * Base constructor - you may use an array to initialize the dataWrapper
     *
     * @param array $data
     */
    public function __construct(array $data = array())
    {
        if (!empty($data)) {
            $ref = new \ReflectionObject($this);
            foreach ($ref->getProperties() as $property) {
                try {
                    $value = $this->getValue($data, $property->getName());
                    $property->setAccessible(true);
                    $property->setValue($this, $value);
                } catch (\Exception $e) {
                    // does nothing when we don't have a certain property in the $data array
                }
            }
        }
    }

    /**
     * Getter and Setters
     *
     * @param string $name
     * @param array $args
     */
    public function __call($name, array $args)
    {
        if (in_array(substr($name, 0, 3), array('get', 'set'))) {
            $property = lcfirst(substr($name, 3));
            $ref = new \ReflectionObject($this);

            if ($ref->hasProperty($property)) {
                $property = $ref->getProperty($property);
                $property->setAccessible(true);
                switch (substr($name, 0, 3)) {
                    case 'get':
                        return $property->getValue($this);
                    case 'set':
                    default:
                        $property->setValue($this, $args[0]);
                        return $this;
                }
            }

            throw new \InvalidArgumentException(sprintf('Property %s does not exists', $property));
        }

        throw new \InvalidArgumentException('Method does not exists');
    }

    /**
     * Export dataWrapper values as an array
     *
     * @return array
     */
    public function toArray()
    {
        $ref = new \ReflectionObject($this);
        $export = array();

        foreach ($ref->getProperties() as $property) {
            $property->setAccessible(true);
            $name = strtolower(preg_replace('@([A-Z])@', '_\1', $property->getName()));
            $export[$name] = $property->getValue($this);

            if ($export[$name] instanceof self) {
                $export[$name] = $export[$name]->toArray();
            }

            if ($export[$name] instanceof \DateTime) {
                $export[$name] = $export[$name]->format('Y-m-d');
            }
        }

        return $export;
    }

    /**
     * Export dataWrapper values as an array in studly caps format.
     *
     * @return array
     */
    public function toStudlyCapsArray()
    {
        $export = $this->toArray();

        $result = array();
        foreach ($export as $key => $value) {
            $result[ucfirst($this->toCamelCase($key))] = $value;
        }

        return $result;
    }

    /**
     * ToArray with unset null fields
     *
     * @return array
     */
    public function toCleanArray()
    {
        $export = $this->toArray();

        $cleanExport = array();
        foreach ($export as $key => $value) {
            if ($value) {
                $cleanExport[$key] = $value;
            }
        }

        return $cleanExport;
    }

    /**
     * Extract dataWrapper $property value from $data
     *
     * @param array $data
     * @param string $property
     * @return 
     */
    private function getValue(array $data, $property)
    {
        if (isset($data[$property])) {
            return $data[$property];
        }

        $property = strtolower(preg_replace('@([A-Z])@', '_\1', $property));
        if (isset($data[$property])) {
            return $data[$property];
        }

        throw new \OutOfBoundsException('');
    }

    /**
     * Convert from undescore to camel case
     *
     * @param string $name
     * @return void
     */
    private function toCamelCase($name)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $name))));
    }

    /**
     * @param string $offset 
     * @return mixed
     */
    public function offsetGet($offset)
    {
        $property = $this->toCamelCase($offset);
        return call_user_func(array($this, 'get' . ucfirst($property)));
    }

    /**
     * @param string $offset
     * @param mixed $value
     * @return mixed
     */
    public function offsetSet($offset, $value)
    {
        $property = $this->toCamelCase($offset);
        return call_user_func(array($this, 'set' . ucfirst($property)), $value);
    }

    /**
     * @param string
     * @return mixed
     */
    public function offsetExists($offset)
    {
        $property = $this->toCamelCase($offset);
        return (new \ReflectionObject($this))->hasProperty($property);
    }

    /**
     * @param string offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        $this->offsetSet($offset, null);
    }
}
