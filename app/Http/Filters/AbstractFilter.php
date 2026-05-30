<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter implements FilterInterface
{
    /** @var array */
    private $params = [];

    /**
     * AbstractFilter constructor.
     *
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    abstract protected function getCallbacks(): array;

    public function apply(Builder $builder)
    {
        $this->before($builder);

        foreach ($this->getCallbacks() as $name => $callback) {
            if (isset($this->params[$name])) {
                call_user_func($callback, $builder, $this->params[$name]);
            }
        }
    }

    /**
     * @param Builder $builder
     */
    protected function before(Builder $builder)
    {
        $this->default($builder);
    }

    /**
     * @param string $key
     * @param mixed|null $default
     *
     * @return mixed|null
     */
    protected function getQueryParam(string $key, $default = null)
    {
        return $this->params[$key] ?? $default;
    }

    /**
     * @param string[] $keys
     *
     * @return AbstractFilter
     */
    protected function removeQueryParam(string ...$keys)
    {
        foreach ($keys as $key) {
            unset($this->params[$key]);
        }

        return $this;
    }
}
