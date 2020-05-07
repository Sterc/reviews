<?php

/**
 * Reviews
 *
 * Copyright 2018 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

$package = 'Reviews';

$settings = ['user_name', 'user_email'];

$success = false;

switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
        foreach ($settings as $key) {
            if (isset($options[$key])) {
                $setting = $object->xpdo->getObject('modSystemSetting', [
                    'key' => strtolower($package) . '.' . $key
                ]);

                if (!$setting) {
                    $setting = $object->xpdo->newObject('modSystemSetting');
                    $setting->set('key', strtolower($package) . '.' . $key);
                }

                $setting->set('value', $options[$key]);
                $setting->save();
            }
        }

        $success = true;

        break;
    case xPDOTransport::ACTION_UNINSTALL:
        $success = true;

        break;
}

return $success;
