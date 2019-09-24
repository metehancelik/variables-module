<?php namespace Anomaly\VariablesModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\VariablesModule\Variable\Command\GetValuePresenter;
use Anomaly\VariablesModule\Variable\Command\GetVariableGroup;
use Anomaly\VariablesModule\Variable\Command\GetVariableValue;

/**
 * Class VariablesModulePlugin
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class VariablesModulePlugin extends Plugin
{

    /**
     * Get the functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'variable',
                function ($group, $field) {
                    return dispatch_now(new GetValuePresenter($group, $field));
                }
            ),
            new \Twig_SimpleFunction(
                'variable_value',
                function ($group, $field, $default = null) {
                    return dispatch_now(new GetVariableValue($group, $field, $default));
                }
            ),
            new \Twig_SimpleFunction(
                'variable_group',
                function ($group) {
                    return decorate(dispatch_now(new GetVariableGroup($group)));
                }
            ),
        ];
    }
}
