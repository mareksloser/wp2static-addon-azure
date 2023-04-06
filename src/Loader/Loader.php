<?php

declare(strict_types=1);


namespace Msloser\Wp2staticAddonAzure\Loader;


class Loader
{
    protected array $actions;
    protected array $filters;

    public function __construct() {
        $this->actions = [];
        $this->filters = [];
    }

    public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ): void
    {
        $this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
    }

    public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ): void
    {
        $this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
    }

    private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ): array
    {
        $hooks[] = array(
            'hook'          => $hook,
            'component'     => $component,
            'callback'      => $callback,
            'priority'      => $priority,
            'accepted_args' => $accepted_args
        );

        return $hooks;
    }

    public function run(): void
    {
        foreach ( $this->filters as $hook ) {
            add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
        }

        foreach ( $this->actions as $hook ) {
            add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
        }
    }
}