<?php

namespace Fjord\Crud\Fields\Relations;

use Fjord\Crud\OneRelationField;

class MorphOne extends OneRelationField
{
    use Concerns\ManagesRelation;

    /**
     * Properties passed to Vue component.
     *
     * @var array
     */
    protected $props = [
        'type' => 'morphOne'
    ];

    /**
     * Required attributes.
     *
     * @var array
     */
    protected $required = [
        'title',
        'model',
        'preview'
    ];

    /**
     * Available Field attributes.
     *
     * @var array
     */
    protected $available = [
        'title',
        'model',
        'hint',
        'edit',
        'preview',
        'confirm',
        'sortable',
        'orderColumn',
        'query'
    ];

    /**
     * Default Field attributes.
     *
     * @var array
     */
    protected $defaults = [
        'confirm' => false,
        'sortable' => false,
        'orderColumn' => 'order_column'
    ];

    /**
     * Set relation attributes.
     *
     * @param mixed $relation
     * @return self
     */
    protected function setRelationAttributes($relation)
    {
        if (!$this->getModelConfig($this->related)) {
            $this->throwMissingConfigException();
        }

        $this->attributes['foreign_key'] = $relation->getForeignKeyName();
        $this->attributes['morph_type_value'] = $this->model;
        $this->attributes['morph_type'] = $relation->getMorphType();
        $this->attributes['local_key_name'] = $relation->getLocalKeyName();
    }
}
